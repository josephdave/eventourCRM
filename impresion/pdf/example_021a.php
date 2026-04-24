<?php 

$handle =fopen('http://localhost/b100/cert_disp_final_pdf.php?contrato=2898&periodo=1&anio=2012' , "r");
//pull down the contents of that page
$contents = stream_get_contents($handle);
//close the connection
fclose($handle);

echo $contents;

?>