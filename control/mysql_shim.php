<?php
// Shim de compatibilidad: mapea mysql_* a mysqli_* para PHP 7+/8.x.
//
// REGLA CRITICA: este archivo se despliega tal cual al servidor de
// produccion, que corre PHP 5.6. PHP parsea el archivo COMPLETO antes de
// evaluar el if(), asi que el guard function_exists() NO protege contra
// sintaxis moderna. Prohibido aqui: ?? , [] para arrays, ...spread,
// tipos de retorno, arrow fn, ?-> , constructor property promotion.
// Verificar siempre con:  php5.6 -l control/mysql_shim.php
if (!function_exists('mysql_connect')) {

    $GLOBALS['_shim_mysqli_link'] = null;

    function mysql_connect($host, $user, $pass) {
        $link = mysqli_connect($host, $user, $pass);
        if (!$link) return false;
        $GLOBALS['_shim_mysqli_link'] = $link;
        return $link;
    }

    function mysql_select_db($db, $link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return mysqli_select_db($link, $db);
    }

    function mysql_query($query, $link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return mysqli_query($link, $query);
    }

    function mysql_close($link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return mysqli_close($link);
    }

    function mysql_fetch_array($result, $mode = MYSQL_BOTH) {
        // Sin ?? ni [] : este archivo debe PARSEAR en PHP 5.6 aunque el
        // bloque nunca se ejecute alli (PHP parsea antes de evaluar el if).
        $map = array(MYSQL_ASSOC => MYSQLI_ASSOC, MYSQL_NUM => MYSQLI_NUM, MYSQL_BOTH => MYSQLI_BOTH);
        $m = isset($map[$mode]) ? $map[$mode] : MYSQLI_BOTH;
        return mysqli_fetch_array($result, $m);
    }

    function mysql_fetch_row($result) {
        return mysqli_fetch_row($result);
    }

    function mysql_num_rows($result) {
        return mysqli_num_rows($result);
    }

    function mysql_insert_id($link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return mysqli_insert_id($link);
    }

    function mysql_real_escape_string($str, $link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return mysqli_real_escape_string($link, $str);
    }

    function mysql_affected_rows($link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return mysqli_affected_rows($link);
    }

    function mysql_error($link = null) {
        $link = $link ?: $GLOBALS['_shim_mysqli_link'];
        return $link ? mysqli_error($link) : mysqli_connect_error();
    }

    if (!defined('MYSQL_ASSOC')) define('MYSQL_ASSOC', 1);
    if (!defined('MYSQL_NUM'))   define('MYSQL_NUM',   2);
    if (!defined('MYSQL_BOTH'))  define('MYSQL_BOTH',  3);
}
