<?php
/***** EDIT BELOW LINES *****/
$DB_Server = "localhost"; // MySQL Server
$DB_Username = "eventour_databas"; // MySQL Username
$DB_Password = "h3tabew3"; // MySQL Password
$DB_DBName = "eventour_crm"; // MySQL Database Name
$DB_TBLName = "viajero"; // MySQL Table Name
$xls_filename = 'export_'.date('Y-m-d').'.xls'; // Define Excel (.xls) file name
 
/***** DO NOT EDIT BELOW LINES *****/
// Create MySQL connection
$sql = "SELECT producto.grupo as GRUPO, otro as SUBPROGRAMA, producto.origen AS ORIGEN,producto.destino as DESTINO,producto.f_salida as FECHA_SALIDA, UPPER(`apellidos`) as APELLIDOS,  UPPER(`nombres`) as NOMBRES,`documento` as DOCUMENTO, `no_documento` as NUMERO_DOCUMENTO, `fnacimiento` as FECHA_NACIMIENTO, `email` as EMAIL, `telefono` as TELEFONO, `celular` as CELULAR,  UPPER(`acudiente1_nombre`) as NOMBRE_ACUDIENTE, UPPER(`acudiente1_apellido`) as ACUDIENTE_APELLIDO, `acudiente1_telefono` as ACUDIENTE_TELEFONO, `acudiente1_email`as ACUDIENTE_EMAIL, UPPER(`acudiente2_nombre`) as ACUDIENTE2_NOMBRE, UPPER(`acudiente2_apellido`) as ACUDIENTE2_APELLIDO, `acudiente2_telefono` as ACUDIENTE2_TELEFONO, `acudiente2_email` as ACUDIENTE2_EMAIL, UPPER(`facturacion_nombre`) NOMBRE_FACTURACION, `facturacion_documento` FACTURACION_DOCUMENTO, `facturacion_nodocumento` as FACTURACION_NUMERO_DOCUMENTO, `facturacion_direccion` as FACTURACION_DIRECCION, `facturacion_email` as FACTURACION_EMAIL, `fregistro` as FECHA_REGISTRO, viajero.estado as ESTADO, ifnull(observaciones_v, '') as OBSERVACIONES  FROM producto, `viajero`
LEFT JOIN (SELECT GROUP_CONCAT(observaciones_viajero.comentario SEPARATOR ';') as observaciones_v, observaciones_viajero.viajeroid  FROM `observaciones_viajero` WHERE 1 GROUP BY observaciones_viajero.viajeroid) as obs  
ON obs.viajeroid = viajero.id
WHERE id_grupo = producto.id ";
if($_GET['grupo']==0)
{"";}else{
$sql.="and id_grupo = '".$_GET['grupo']."'";
}
$sql.=" order by grupo, apellidos, nombres ";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
// Select database
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
// Execute query
$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
 
// Header info settings
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$xls_filename");
header("Pragma: no-cache");
header("Expires: 0");
 
/***** Start of Formatting for Excel *****/
// Define separator (defines columns in excel &amp; tabs in word)
$sep = "\t"; // tabbed character
 
// Start of printing column names as names of MySQL fields
for ($i = 0; $i<mysql_num_fields($result); $i++) {
  echo mysql_field_name($result, $i) . "\t";
}
print("\n");
// End of printing column names
 
// Start while loop to get data
while($row = mysql_fetch_row($result))
{
  $schema_insert = "";
  for($j=0; $j<mysql_num_fields($result); $j++)
  {
    if(!isset($row[$j])) {
      $schema_insert .= "NULL".$sep;
    }
    elseif ($row[$j] != "") {
      $schema_insert .= "$row[$j]".$sep;
    }
    else {
      $schema_insert .= "".$sep;
    }
  }
  $schema_insert = str_replace($sep."$", "", $schema_insert);
  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
  $schema_insert .= "\t";
  print(trim($schema_insert));
  print "\n";
}
?>