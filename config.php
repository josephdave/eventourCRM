<?php
require_once __DIR__ . '/control/mysql_shim.php';

$mysql_host = "localhost";
$mysql_database = "eventour_crm";
$mysql_user = "root";
$mysql_password = "";

mysql_connect($mysql_host,$mysql_user,$mysql_password);
mysql_select_db($mysql_database);
?>