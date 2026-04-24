<?php 
require_once("../control/control.php");
setlocale(LC_TIME, "es_ES");
$control = new Control();
$firma =$_REQUEST['firma'];

if(isset($firma)&& $firma != ""){
	$cliente = $control->datosViajero($firma);
	$producto=$control->datosProducto($cliente['id_grupo']);
}else{
$producto=$control->datosProducto($_REQUEST['programa']);
}

?>
<!doctype html>
<html>
<head>

  <style>
	h2{
	text-transform:uppercase;
	}
	p{
	text-align:justify;
	}
	li{text-align:justify;}
	body{
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	}
	</style>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p><strong style="text-align: center">AUTORIZACIÓN PERMISO DE SALIDA DEL PAÍS PARA NIÑOS NIÑAS Y ADOLESCENTES</strong></p>
<p><br>Ciudad y fecha: <?php if($producto==null){ echo "_____________";}else{echo $producto['origen'];}?> - <?php echo $date = date('d/m/Y', time());?></p>
<p>De conformidad con lo establecido en el parágrafo 1° del artículo 110 de la Ley 1098 del 08 de noviembre de 2006 “Código de la Infancia y la Adolescencia”, y demás normas concordantes, AUTORIZO la salida de Colombia de mi  hijo(a) : </p><p><strong>Nombres y Apellidos:<?php if($producto==null){ echo "_________________";}else{echo $cliente['nombres']." ".$cliente['apellidos'];}?><br>Número de identificación del menor: </strong><?php if($producto==null){ echo "_________________";}else{echo $cliente['no_documento'];}?><br><strong>País de destino final del  menor:</strong><?php if($producto==null){ echo "_________________";}else{echo $producto['destino'];}?><br><strong>Propósito de viaje del  menor:
  </strong><?php if($producto==null){ echo "________________";}else{?>EXCURSION DE ULTIMO GRADO<?php }?><br>
  <br><strong>Fecha de salida del país del  menor: </strong>
   <?php 
   if($producto==null){ echo "________________";}else{
    setlocale(LC_ALL,"es_ES");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    echo $meses[date('n', strtotime($producto['f_salida']))-1];
echo ''.strftime(" de %Y", strtotime($producto['f_salida'])).'<br/>';
   }
   ?>
   <br><strong>Fecha de regreso o entrada al país del  menor: </strong>
<?php 
if($producto==null){ echo "________________";}else{
  setlocale(LC_ALL,"es_ES");
  echo $meses[date('n', strtotime($producto['f_llegada']))-1];
echo ''.strftime(" de %Y", strtotime($producto['f_llegada'])).'<br/>';
}
   ?>
</p><p><strong>Acompañante:</strong><?php if($cliente['id_grupo']== 141){echo "__________________";}else{?> FUNCIONARIO EVENTOUR SPORT<?php }?></p><p><strong>Hago constar igualmente, que a la fecha ejerzo sin ningún tipo de limitación, la patria potestad.<br>
  OTORGANTE (S):</strong><br>
 </p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><?php echo strtoupper($cliente['acudiente1_nombre']." ".$cliente['acudiente1_apellido'])." <br/> CEDULA:___________________";?></p>
      <p>&nbsp;</p>
      <p><br>
        Firma: _______________________________ </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Huella: ______________________________ </p>
      <p></p>
    <p></p></td>
    <td><?php if($cliente['acudiente2_nombre'] != "" || $cliente['id_grupo']== 141){ ?>
    
    <?php if($cliente['id_grupo']== 141){echo " ACUDIENTE 2:___________________";}?>
      <?php echo strtoupper($cliente['acudiente2_nombre']." ".$cliente['acudiente2_apellido'])." <br/> CEDULA:_____________________";?>
      <p>&nbsp;</p>
      <p><br>
      Firma: _______________________________ </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Huella: ______________________________ </p>
      <p></p>
    <p></p>
    <?php } ?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
