# Despliegue de eventour_crm

Este documento existe por una razón concreta: **el entorno local corre PHP 8.3
y el servidor de producción corre PHP 5.6.40**. El mismo código tiene que
funcionar en los dos. Un descuido aquí no produce un bug: produce un
**error 500 en todo el CRM**.

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
Cambiar la versión de la cuenta los afectaría a todos. Ver §7.

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
> **el sitio entero habría devuelto 500**. Ya está corregido.
>
> Dentro de `mysql_shim.php` está prohibido: `??`, `[]` para arrays,
> `...spread`, tipos de retorno, arrow functions, `?->`, promoción de
> propiedades en el constructor, `match`, enums, named arguments.

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
- `.git/`, `deploy.sh`, `DESPLIEGUE.md`, `.deployignore` — desarrollo.
- `documentos/`, `documentos_asistencia/`, `documentos_proveedores/`,
  `documentos_sagrlaft/`, `imagenes/productos/`, `impresion/pdf/`,
  `uploader2/uploades/` — **datos vivos, propiedad del servidor** (4.4 GB de
  pasaportes y documentos de viajeros). No existen completos en local.

rsync corre **sin `--delete`**: nunca borra nada en producción.

También corre con `--no-perms --chmod=D755,F644` a propósito: el árbol local
vive en `/mnt/d` (WSL sobre Windows), donde todo aparece con permisos `0777`.
Con `-a` normal, un despliegue dejaría todo el servidor en 777.

---

## 5. Procedimiento

Requisito único: la llave SSH descifrada.

```bash
# Una sola vez: descifrar la llave (passphrase en certs/keys.md)
openssl rsa -in "certs/eventour (1)" -out ~/.ssh/eventour
chmod 600 ~/.ssh/eventour
```

Después:

```bash
./deploy.sh check    # verifica; no copia nada
./deploy.sh diff     # muestra qué cambiaría; no copia nada
./deploy.sh deploy   # respalda y despliega (pide confirmación)
```

`deploy.sh` hace, en orden:

1. **Repositorio limpio** — en modo `deploy` aborta si hay cambios sin commitear.
2. **Secretos** — que `config.local.php` esté ignorado y no trackeado, que
   `db_config.php` lleve credenciales de producción y `$APP_ENV='produccion'`,
   que no haya `display_errors` sueltos.
3. **Lint con el PHP 5.6 real del servidor** — empaqueta los 421 `.php`
   trackeados, los manda a un temporal remoto y corre `/opt/alt/php56/usr/bin/php -l`
   sobre cada uno. **Si alguno no parsea, aborta.** Este es el paso que impide
   tumbar producción.
4. **Estado del servidor** — versión de PHP del selector, que no exista
   `config.local.php` en producción, y que estén los `.htaccess` de
   endurecimiento.
5. **Diff** — `rsync --dry-run` y conteo.
6. **Respaldo + despliegue** — comprime el código (sin los 4.4 GB de datos) en
   `/home/eventour/backups_crm/crm-codigo-FECHA.tar.gz`, sincroniza, y verifica
   que el sitio devuelva HTTP 200 y no muestre errores PHP.

### Rollback

```bash
ssh -i ~/.ssh/eventour eventour@104.255.192.171 \
  "cd /home/eventour/public_html/crm && tar xzf /home/eventour/backups_crm/crm-codigo-FECHA.tar.gz"
```

---

## 6. Regla de oro: producción también es una fuente

**El servidor no tiene git.** Se han hecho cambios directamente ahí que no
estaban en el repo — incluido un parche de seguridad. Antes de desplegar,
comprueba que no vas a pisar algo:

```bash
./deploy.sh diff
```

Si un archivo aparece como modificado y **tú no lo tocaste**, alguien lo editó
en el servidor. Tráelo al repo antes de sobrescribirlo:

```bash
scp -i ~/.ssh/eventour eventour@104.255.192.171:/home/eventour/public_html/crm/ARCHIVO ./ARCHIVO
git add ARCHIVO && git commit -m "Backport de cambio hecho en produccion"
```

---

## 7. Camino futuro: unificar en 8.3

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
