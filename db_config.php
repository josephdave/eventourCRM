<?php
// Punto UNICO de configuracion de base de datos.
//
// Los valores de este archivo son los de PRODUCCION y se despliegan tal cual.
// Para trabajar en local NO se edita este archivo: se crea config.local.php
// (ignorado por git, nunca se sube) sobrescribiendo lo que haga falta.
//
// Sintaxis limitada a PHP 5.6: el servidor corre 5.6.40.

$DB_HOST = 'localhost';
$DB_NAME = 'eventour_crm';
$DB_USER = 'eventour_databas';
$DB_PASS = 'h3tabew3';

// Entorno: 'produccion' o 'local'. Controla si se muestran errores.
$APP_ENV = 'produccion';

if (file_exists(__DIR__ . '/config.local.php')) {
    require __DIR__ . '/config.local.php';
}

// Errores visibles solo fuera de produccion.
if ($APP_ENV === 'produccion') {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Constantes: necesarias donde no se pueden usar variables
// (p.ej. inicializadores de propiedades estaticas en core/Config.php).
if (!defined('DB_HOST')) define('DB_HOST', $DB_HOST);
if (!defined('DB_NAME')) define('DB_NAME', $DB_NAME);
if (!defined('DB_USER')) define('DB_USER', $DB_USER);
if (!defined('DB_PASS')) define('DB_PASS', $DB_PASS);
if (!defined('APP_ENV')) define('APP_ENV', $APP_ENV);
