# Despliegue de eventour_crm

Este documento existe por una razón concreta: **el entorno local corre PHP 8.3
y el servidor de producción corre PHP 5.6.40**. El mismo código tiene que
funcionar en los dos. Un descuido aquí no produce un bug: produce un
**error 500 en todo el CRM**.

Última verificación completa: **2026-09-08** (despliegue real ejecutado y
comprobado; ver §9).

---

## 1. Los dos entornos

|                     | Local                          | Producción                              |
|---------------------|--------------------------------|-----------------------------------------|
| PHP                 | 8.3 (XAMPP)                    | **5.6.40** (`/opt/alt/php56/usr/bin/php`) |
| Handler web         | Apache                         | LiteSpeed + CloudLinux PHP Selector      |
| Ruta                | `D:\xampp\htdocs\eventour_crm` | `/home/eventour/public_html/crm`         |
| Base de datos       | MariaDB local, `root` sin clave| MariaDB 10.5.26, usuario `eventour_databas` |
| API MySQL           | `mysqli` (vía shim)            | `mysql_*` nativo                         |
| Errores en pantalla | Sí                             | **No**                                   |
| Host                | —                              | `eventour@104.255.192.171` (A2 Hosting)  |
| URL                 | `localhost/eventour_crm`       | `https://eventoursport.travel/crm/`      |

El servidor **sí tiene PHP 8.3 instalado**, pero el selector está en 5.6 para
toda la cuenta, y esa cuenta también sirve `eventoursport.com`,
`lunasdemielgratis.com`, `traveltracer` y un WordPress en `eventours.travel`.
Cambiar la versión de la cuenta los afectaría a todos. Ver §10.

---

## 2. Cómo conviven las dos versiones

### 2.1 El shim de MySQL

`control/mysql_shim.php` reimplementa `mysql_*` sobre `mysqli_*`. Todo el
cuerpo está dentro de:

```php
if (!function_exists('mysql_connect')) { ... }
```

En 5.6 la extensión `mysql` existe, la condición es falsa y **no se define
nada**: producción usa las funciones nativas. En 8.3 la extensión no existe,
el bloque se activa y el código legado sigue funcionando sin tocarlo.

> ### ⚠️ La trampa que ya nos mordió
>
> **PHP parsea el archivo completo ANTES de evaluar el `if`.** El guard
> `function_exists()` protege la *ejecución*, no la *sintaxis*.
>
> El shim tenía `$map[$mode] ?? MYSQLI_BOTH`. El operador `??` es PHP 7.0+.
> En 5.6 eso es `Parse error: syntax error, unexpected '?'`, y como
> `config.php` y `control/control.php` hacen `require_once` del shim,
> **el sitio entero habría devuelto 500**. Corregido.
>
> Dentro de `mysql_shim.php` está prohibido: `??`, `[]` para arrays,
> `...spread`, tipos de retorno, arrow functions, `?->`, promoción de
> propiedades en el constructor, `match`, enums, named arguments.

La misma regla aplica, en menor grado, a cualquier archivo que se despliegue:
el paso 3 de `deploy.sh` lo verifica contra el intérprete 5.6 real.

### 2.2 Credenciales: un solo punto

Antes las credenciales estaban repetidas en 5 archivos y dos de ellos ya
apuntaban a la base local — desplegarlos habría dejado producción sin BD.

Ahora hay un único archivo:

- **`db_config.php`** — versionado, contiene los valores de **producción**,
  se despliega tal cual. También fija `error_reporting` según `$APP_ENV`.
- **`config.local.php`** — **ignorado por git, jamás se despliega**. Sobrescribe
  lo que haga falta en local (`root`, clave vacía, `$APP_ENV='local'`).

Consumidores: `config.php`, `control/control.php`, `excel.php`, `viajero.php`,
`core/Config.php`.

`db_config.php` expone los valores como variables (`$DB_HOST`…) y como
constantes (`DB_HOST`…). Las constantes existen porque `core/Config.php` las
usa dentro de un inicializador de propiedad estática, donde no se pueden usar
variables.

**Nunca** edites `db_config.php` para trabajar en local. Edita `config.local.php`.

### 2.3 Errores en pantalla

No pongas `ini_set('display_errors', 1)` ni `error_reporting(E_ALL)` en ningún
archivo. Lo decide `db_config.php` a partir de `$APP_ENV`. `deploy.sh` aborta
si encuentra un `display_errors=1` fuera de ese archivo.

---

## 3. Librerías que NO funcionan en 8.3

Estas son legado y sólo parsean en 5.6. **Funcionan en producción y están rotas
en local.** No las "arregles" a menos que vayas a migrar de verdad:

| Archivo | Motivo |
|---|---|
| `impresion/tcpdf.php`, `barcodes.php`, `datamatrix.php`, `pdf417.php`, `tcpdf_filters.php`, `tcpdf_parser.php`, `pdf/example_009.php` | acceso a strings con `{}` (eliminado en 8.0) |
| `phpMyEdit.class.php`, `phpMyEditSetup.php` | acceso a strings con `{}` |
| `mail/PHPMailerAutoload.php` | `__autoload()` (eliminado en 8.0) |

Consecuencia práctica: **la impresión de PDF y las pantallas de phpMyEdit
(`viajero.php`) no se pueden probar en local.** Hay que probarlas en el
servidor. Es la asimetría que queda; no la ignores al hacer QA.

---

## 4. Qué nunca se despliega

Definido en `.deployignore` y aplicado por rsync:

- `config.local.php`, `certs/` — secretos.
- `.git/`, `deploy.sh`, `docs/`, `.deployignore` — desarrollo.
- `documentos/`, `documentos_asistencia/`, `documentos_proveedores/`,
  `documentos_sagrlaft/`, `imagenes/productos/`, `impresion/pdf/`,
  `uploader2/uploades/` — **datos vivos, propiedad del servidor**.

Sobre ese último punto, medido el 2026-09-08:

| Carpeta | Producción | Local | Sólo en producción |
|---|---:|---:|---:|
| `documentos` | 5.857 | 1 | **5.856** |
| `impresion/pdf` | 2.614 | 90 | **2.524** |
| `documentos_proveedores` | 444 | 435 | 9 |

**8.389 archivos existen sólo en el servidor. Cero existen sólo en local.** Son
pasaportes, identidades y contratos firmados. Sincronizar esas carpetas con
`--delete` los borraría. Por eso rsync corre **sin `--delete`** y además las
excluye: dos capas de protección.

rsync también corre con `--no-perms --no-owner --no-group --chmod=D755,F644`.
El árbol local vive en `/mnt/d` (WSL sobre Windows), donde todo aparece con
permisos `0777`; con un `-a` normal, un despliegue dejaría el servidor en 777.

---

## 5. Procedimiento

Requisito único: la llave SSH descifrada.

```bash
# Una sola vez: descifrar la llave (passphrase en certs/keys.md)
openssl rsa -in "certs/eventour (1)" -out ~/.ssh/eventour
chmod 600 ~/.ssh/eventour
```

Si prefieres otra ruta, exporta `EVENTOUR_SSH_KEY=/ruta/a/la/llave`.

```bash
./deploy.sh check          # verifica; no copia nada
./deploy.sh diff           # muestra qué cambiaría; no copia nada
./deploy.sh deploy         # respalda y despliega (pide confirmación)
./deploy.sh deploy --yes   # sin confirmación interactiva (CI, tuberías)
```

`deploy.sh` hace, en orden:

1. **Repositorio limpio** — en modo `deploy` aborta si hay cambios sin commitear.
2. **Secretos** — que `config.local.php` esté ignorado y no trackeado, que
   `db_config.php` lleve credenciales de producción y `$APP_ENV='produccion'`,
   que no haya `display_errors` sueltos.
3. **Lint con el PHP 5.6 real del servidor** — empaqueta los `.php` trackeados,
   los manda a un temporal remoto y corre `/opt/alt/php56/usr/bin/php -l` sobre
   cada uno. **Si alguno no parsea, aborta.** Este es el paso que impide tumbar
   producción.
4. **Estado del servidor** — versión de PHP del selector, que no exista
   `config.local.php` en producción, y que estén los `.htaccess` de
   endurecimiento.
5. **Diff** — `rsync --dry-run` y conteo.
6. **Respaldo + despliegue** — comprime el código (sin los ~5 GB de datos, unos
   37 MB) en `/home/eventour/backups_crm/crm-codigo-FECHA.tar.gz`, sincroniza, y
   verifica que el sitio devuelva HTTP 200 y no muestre errores PHP.

El respaldo del paso 6 es adicional al sistema de backups del hosting; cuesta
segundos y permite revertir sólo el código sin tocar los datos.

### Rollback

```bash
ssh -i ~/.ssh/eventour eventour@104.255.192.171 \
  "cd /home/eventour/public_html/crm && tar xzf /home/eventour/backups_crm/crm-codigo-FECHA.tar.gz"
```

---

## 6. Antes de desplegar: producción también es una fuente

**El servidor no tiene git.** Se han hecho cambios directamente ahí que no
estaban en el repo — incluido un parche de seguridad de `upload.php` del
2026-08-12, tras un incidente el 2026-08-10 (escritura de archivo sin
autenticar). La copia local seguía siendo la vulnerable; desplegarla habría
reintroducido el fallo. Ya está backporteado.

Por eso, antes de cada despliegue:

```bash
./deploy.sh diff
```

Si un archivo aparece como modificado y **tú no lo tocaste**, alguien lo editó
en el servidor. Tráelo al repo antes de sobrescribirlo:

```bash
scp -i ~/.ssh/eventour eventour@104.255.192.171:/home/eventour/public_html/crm/ARCHIVO ./ARCHIVO
git add ARCHIVO && git commit -m "Backport de cambio hecho en produccion"
```

Estado al 2026-09-08: local y producción están **idénticos en código** (0
archivos con contenido distinto, verificado por md5 sobre 998 archivos).

---

## 7. Cómo probar antes de tocar producción

El servidor permite montar una copia de staging fuera del docroot, con el
intérprete real. Es la única forma de probar 5.6 sin exponer nada:

```bash
git archive HEAD | ssh -i ~/.ssh/eventour eventour@104.255.192.171 \
  'rm -rf ~/staging_crm && mkdir -p ~/staging_crm && cd ~/staging_crm && tar xf -'
```

Y ahí dentro:

```bash
# Sintaxis
/opt/alt/php56/usr/bin/php -l ARCHIVO.php

# Renderizar una página con el handler CGI real
REDIRECT_STATUS=1 SCRIPT_FILENAME=$PWD/index.php REQUEST_METHOD=GET \
  /opt/alt/php56/usr/bin/php-cgi
```

Borra `~/staging_crm` al terminar. **Nunca** lo pongas dentro de `public_html`.

---

## 8. Lecciones del primer despliegue

El primer intento **terminó sin desplegar y sin mensaje alguno**, código de
salida 1. Producción quedó intacta, pero un fallo mudo en una herramienta de
despliegue es más peligroso que el fallo mismo: si no lo hubiéramos revisado,
habríamos creído que el despliegue salió bien.

Causa: `rsync` sobre ssh consume el stdin del script. Al llegar al `read` de
confirmación ya había EOF, `read` devolvía 1 y `set -e` mataba el script en
silencio.

Correcciones aplicadas (commit `96b6476`):

- `rsync` se invoca con `</dev/null` y el dry-run se cachea en vez de correrse
  dos veces.
- La confirmación se lee de `/dev/tty`, no de stdin, con `--yes` para uso no
  interactivo y error explícito si no hay terminal.
- El parseo de argumentos usaba `[ ] || [ ] && VAR=1`, que devuelve 1 cuando
  ambos tests fallan y con `set -e` aborta igual. Reemplazado por `case`.
- Se añadió un `trap ERR` que reporta código de salida y línea.

**Regla:** después de `./deploy.sh deploy`, comprueba el código de salida. Un
despliegue correcto termina en `0` y con la línea `Despliegue completo`.

---

## 9. Verificación del despliegue del 2026-09-08

Lo comprobado tras el despliegue real, como plantilla de qué revisar:

| Comprobación | Resultado |
|---|---|
| Código de salida de `deploy.sh` | `0`, "Despliegue completo" |
| Respaldo generado | `crm-codigo-20260908-171555.tar.gz`, 37 MB |
| Archivos transferidos | 16 |
| `index.php` antes vs. después | **byte a byte idéntico** (3.571 b), salvo el id de sesión |
| Errores PHP visibles | 0 en todos los endpoints |
| Endpoints | `index.php` 200 · `logged.php` 302 · `dashboard.php` 302 · `registro.php` 200 · `api.php` 200 |
| Login con credenciales inválidas | 200, sin fugas ni errores |
| `APP_ENV` en producción | `produccion`, `error_reporting=0`, `display_errors=0` |
| `config.local.php` en producción | ausente (correcto) |
| Conexión a BD desde el código desplegado | OK — 4.387 viajeros, 237 productos |
| Extensión MySQL en uso | nativa (shim inactivo, como debe ser en 5.6) |
| Permisos de los archivos nuevos | `644` (no 777) |
| Carpetas de datos | intactas: 5.857 / 2.614 / 444 archivos |
| Código local vs. producción | 0 diferencias sobre 998 archivos |

---

## 10. Camino futuro: unificar en 8.3

Si algún día se quiere cerrar la brecha, **no** cambies la versión de la cuenta
(rompería los otros sitios). Se puede fijar 8.3 sólo para `/crm` con un
`.htaccess` propio en `public_html/crm/`. Requisitos previos:

1. Reemplazar TCPDF por una versión compatible con 8.x.
2. Reemplazar `mail/PHPMailerAutoload.php` por PHPMailer 6 con Composer.
3. Sustituir o retirar phpMyEdit (`viajero.php`).
4. Recorrer el código en busca de `mysql_*` que el shim no cubra y de
   comportamientos que 8.x cambió (comparaciones string/número, `{}` en strings,
   parámetros opcionales antes de obligatorios).

Mientras tanto, el shim + este proceso son lo que mantiene los dos entornos
vivos a la vez.

---

## 11. Pendiente

**Rotar la clave de la BD `eventour_databas`.** Estuvo dentro de
`eventour_crm.zip`, que se sirvió públicamente sin autenticación en
`https://eventoursport.travel/crm/eventour_crm.zip` desde el 2026-04-23 hasta
el 2026-09-08 (522 MB, 4.361 archivos, incluida `config.php` en claro). El zip
ya está borrado, pero la clave estuvo expuesta unos cuatro meses y medio.

Al rotarla: actualizar `db_config.php`, redesplegar, y actualizar
`config.local.php` sólo si también cambias la base local. Conviene rotar
igualmente el passphrase de la llave SSH, que es casi la misma cadena.
