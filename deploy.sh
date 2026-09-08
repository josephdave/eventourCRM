#!/usr/bin/env bash
# Despliegue eventour_crm  ->  produccion (A2 Hosting, PHP 5.6.40)
#
# Contexto: local corre PHP 8.3, produccion corre PHP 5.6.40. El codigo debe
# parsear en AMBAS. Este script lo verifica contra el interprete 5.6 REAL del
# servidor antes de copiar nada. Ver DESPLIEGUE.md.
#
# Uso:
#   ./deploy.sh check     Solo verifica (lint 5.6 + estado). No copia nada.
#   ./deploy.sh diff      Muestra que archivos cambiarian. No copia nada.
#   ./deploy.sh deploy    Verifica, respalda y despliega (pide confirmacion).
set -euo pipefail
# Sin esto un fallo con `set -e` (p.ej. un `read` en EOF) aborta en silencio.
trap 'c=$?; echo "ERROR: deploy.sh aborto con codigo $c (linea $LINENO)" >&2; exit $c' ERR

SSH_USER=eventour
SSH_HOST=104.255.192.171
SSH_PORT=22
REMOTE_DIR=/home/eventour/public_html/crm
BACKUP_DIR=/home/eventour/backups_crm
SITE_URL=https://eventoursport.travel/crm/index.php
SSH_KEY="${EVENTOUR_SSH_KEY:-$HOME/.ssh/eventour}"

LOCAL_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$LOCAL_DIR"

RED=$'\033[31m'; GRN=$'\033[32m'; YEL=$'\033[33m'; BLD=$'\033[1m'; RST=$'\033[0m'
ok(){   echo "${GRN}  ok${RST}  $*"; }
warn(){ echo "${YEL}  !!${RST}  $*"; }
die(){  echo "${RED}${BLD}ABORTADO:${RST} $*" >&2; exit 1; }
step(){ echo; echo "${BLD}== $*${RST}"; }

[ -f "$SSH_KEY" ] || die "no encuentro la llave SSH en $SSH_KEY (exporta EVENTOUR_SSH_KEY=/ruta)"
# accept-new: acepta la huella la primera vez, pero alerta si cambia despues.
SSH_OPTS="-i $SSH_KEY -p $SSH_PORT -o BatchMode=yes -o StrictHostKeyChecking=accept-new -o ConnectTimeout=15"
SSH="ssh $SSH_OPTS ${SSH_USER}@${SSH_HOST}"

MODE="${1:-check}"
ASSUME_YES=0
case "${2:-}" in --yes|-y) ASSUME_YES=1 ;; esac

# ---------------------------------------------------------------- 1. git
step "1/6  Estado del repositorio"
if [ -n "$(git status --porcelain)" ]; then
    if [ "$MODE" = "deploy" ]; then
        git status --short
        die "hay cambios sin commitear. Commitea antes de desplegar."
    fi
    warn "arbol sucio (permitido en modo '$MODE')"
else
    ok "arbol limpio en $(git rev-parse --abbrev-ref HEAD) @ $(git rev-parse --short HEAD)"
fi

# ---------------------------------------------------------------- 2. secretos
step "2/6  Secretos y credenciales"
grep -q '^/config.local.php$' .gitignore || die "config.local.php no esta en .gitignore"
if git ls-files --error-unmatch config.local.php >/dev/null 2>&1; then
    die "config.local.php esta trackeado en git. Sacalo: git rm --cached config.local.php"
fi
ok "config.local.php ignorado y no trackeado"
# db_config.php debe llevar credenciales de PRODUCCION (es lo que se despliega)
if grep -qE "DB_USER *= *'root'|DB_PASS *= *''" db_config.php; then
    die "db_config.php tiene credenciales LOCALES. Debe llevar las de produccion; los overrides van en config.local.php"
fi
grep -q "APP_ENV = 'produccion'" db_config.php || die "db_config.php no fija \$APP_ENV='produccion'"
ok "db_config.php apunta a produccion"
# ningun archivo a desplegar debe reactivar display_errors
if git grep -nE "ini_set\(['\"]display_errors['\"], *['\"]?1" -- '*.php' | grep -v '^db_config.php:'; then
    die "hay display_errors=1 fuera de db_config.php (arriba). Quitalo antes de desplegar."
fi
ok "sin display_errors sueltos"

# ---------------------------------------------------------------- 3. lint 5.6
step "3/6  Lint con el PHP 5.6 real del servidor"
LINT_OUT=$(git ls-files -z '*.php' | tar czf - --null -T - | $SSH '
  set -e
  T=$(mktemp -d ~/.deploy_lint.XXXXXX)
  trap "rm -rf $T" EXIT
  cd "$T" && tar xzf -
  find . -name "*.php" | sort | while read -r f; do
    out=$(/opt/alt/php56/usr/bin/php -d display_errors=1 -l "$f" 2>&1)
    case "$out" in *"No syntax errors"*) ;; *) echo "PHP56 $f :: $(echo "$out" | grep -iE "parse error|fatal error" | head -1)";; esac
  done
')
if [ -n "$LINT_OUT" ]; then
    echo "$LINT_OUT"
    die "hay archivos que NO parsean en PHP 5.6. Produccion quedaria caida (error 500)."
fi
ok "los $(git ls-files '*.php' | wc -l | tr -d ' ') archivos PHP parsean en 5.6.40"

# ---------------------------------------------------------------- 4. servidor
step "4/6  Estado del servidor"
$SSH "test -d $REMOTE_DIR" || die "no existe $REMOTE_DIR"
REMOTE_PHP=$($SSH "/usr/bin/selectorctl --user-current --interpreter=php 2>/dev/null | awk '{print \$2}'")
ok "PHP web en produccion: ${REMOTE_PHP:-desconocido}"
[ "${REMOTE_PHP%%.*}" = "5" ] || warn "el servidor ya NO corre PHP 5.x — revisa DESPLIEGUE.md antes de seguir"
if $SSH "test -f $REMOTE_DIR/config.local.php"; then
    die "existe config.local.php EN PRODUCCION. Borralo: usaria credenciales locales."
fi
ok "sin config.local.php en produccion"
for d in documentos documentos_asistencia documentos_proveedores documentos_sagrlaft imagenes impresion/pdf uploader2/uploades; do
    if $SSH "test -f $REMOTE_DIR/$d/.htaccess"; then
        ok ".htaccess presente en $d"
    else
        warn "FALTA el .htaccess de endurecimiento en $d  (copialo desde el repo)"
    fi
done

# ---------------------------------------------------------------- 5. diff
step "5/6  Cambios que se aplicarian"
# -rltz en vez de -a a proposito: el arbol local vive en /mnt/d (WSL sobre
# Windows) donde TODO aparece con permisos 0777. Sincronizar permisos dejaria
# el servidor en 777. Con --no-perms los archivos ya existentes conservan sus
# permisos y --chmod solo aplica a los archivos nuevos.
RSYNC_BASE=(rsync -rltz --no-perms --no-owner --no-group --chmod=D755,F644
            --itemize-changes --exclude-from=.deployignore
            -e "ssh $SSH_OPTS")
# </dev/null es OBLIGATORIO: rsync sobre ssh consume el stdin del script y
# dejaria el 'read' de confirmacion de mas abajo en EOF, lo que con `set -e`
# aborta el despliegue en silencio. Ademas se corre una sola vez y se cachea.
DRY=$("${RSYNC_BASE[@]}" --dry-run ./ "${SSH_USER}@${SSH_HOST}:${REMOTE_DIR}/" </dev/null)
echo "$DRY" | grep -E '^[<>ch*]' || true
echo
CHANGED=$(echo "$DRY" | grep -cE '^[<>ch]' || true)
ok "$CHANGED archivo(s) a transferir"

if [ "$MODE" != "deploy" ]; then
    step "Modo '$MODE': no se copio nada."
    exit 0
fi
[ "$CHANGED" -gt 0 ] || { step "Nada que desplegar."; exit 0; }

echo
if [ "$ASSUME_YES" = "1" ]; then
    ok "confirmacion omitida (--yes)"
elif [ -r /dev/tty ]; then
    # Se lee de /dev/tty, no de stdin: stdin puede venir de una tuberia.
    read -r -p "${BLD}Desplegar a PRODUCCION? (escribe: si)${RST} " R </dev/tty || R=""
    [ "$R" = "si" ] || die "cancelado por el usuario"
else
    die "sin terminal para confirmar. Usa: ./deploy.sh deploy --yes"
fi

# ---------------------------------------------------------------- 6. deploy
step "6/6  Respaldo y despliegue"
STAMP=$(date +%Y%m%d-%H%M%S)
# Respalda solo CODIGO (los datos pesan 4.4G y no se tocan).
$SSH "mkdir -p $BACKUP_DIR && cd $REMOTE_DIR && \
  tar czf $BACKUP_DIR/crm-codigo-$STAMP.tar.gz \
    --exclude=./documentos --exclude=./documentos_asistencia \
    --exclude=./documentos_proveedores --exclude=./documentos_sagrlaft \
    --exclude=./imagenes --exclude=./impresion/pdf \
    --exclude=./uploader2/uploades --exclude=./eventour_crm.zip . 2>/dev/null; \
  ls -lh $BACKUP_DIR/crm-codigo-$STAMP.tar.gz"
ok "respaldo: $BACKUP_DIR/crm-codigo-$STAMP.tar.gz"

"${RSYNC_BASE[@]}" ./ "${SSH_USER}@${SSH_HOST}:${REMOTE_DIR}/" </dev/null
ok "archivos sincronizados"

# Verificacion post-despliegue
CODE=$(curl -s -o /dev/null -w '%{http_code}' -m 30 "$SITE_URL" || echo "000")
if [ "$CODE" = "200" ]; then
    ok "el sitio responde HTTP 200"
else
    echo "${RED}${BLD}El sitio responde HTTP $CODE${RST}"
    echo "Revertir con:"
    echo "  $SSH \"cd $REMOTE_DIR && tar xzf $BACKUP_DIR/crm-codigo-$STAMP.tar.gz\""
    exit 1
fi
if curl -s -m 30 "$SITE_URL" | grep -qiE "parse error|fatal error|warning:|notice:"; then
    warn "la pagina muestra errores PHP visibles — revisa \$APP_ENV en db_config.php"
fi
step "${GRN}Despliegue completo.${RST}"
