<?php
require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/control/mysql_shim.php';

$mysql_host     = $DB_HOST;
$mysql_database = $DB_NAME;
$mysql_user     = $DB_USER;
$mysql_password = $DB_PASS;

mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_select_db($mysql_database);
