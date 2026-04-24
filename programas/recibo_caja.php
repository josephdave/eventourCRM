<?php 

$plan=$_REQUEST['plan'];

require_once("../control/control.php");

$control = new Control();

$producto=$control->datosProducto($plan);

$asistentcia = $control->datosAsistencia($producto['asistencia_id']);

if($asistencia['cancelacion']==1){
	$multicausa=true;
}else{
	$multicausa=false;
}


setlocale(LC_ALL, 'es_ES');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Programa completo - EVENTOURSPORT</title>
	

	
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body id="home" style="text-align: justify">
<table cellspacing="0" cellpadding="0">

  <tr>
    <td colspan="5" width="33%" valign="top"><img src="http://www.eventours.travel/wp-content/uploads/2018/03/EventourS-Logo-300x107.png" width="150px"></td>
    <td width="33%" align="center"><strong>Nit:  900199006-3<br>
Sucursal: Principal<br>
Dir:  Avda  5 C  Norte  23DN 35 <br>
Tels:  6604000    </strong></td>
    <td colspan="8" align="right" width="33%">EVENTOUR  SPORT SAS<br>
      Recibos de  Caja    No. 21118</td>
  </tr>
  <tr>
    <td colspan="8" >&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8" >Tercero: 94429986  AGUILAR  DONNEYS GUSTAVO EDUARDO<br>Direccion: Calle  9B  32A-19</td>
    <td colspan="3">Fecha  :</td>
    <td colspan="3"><strong>10/05/2019</strong></td>
  </tr>
  <tr>
    <td colspan="14" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="14" >Observacion: Abono  Porcion  Terrestre   USD  $304x3293.62(TRM)  Producto: COLEGIO  PIO  XII -  Viajero(s):  SOFIA AGUILAR  CONSTAIN  - id:5331<br>
      -------------------------------------------------------------------------------------------</td>
  </tr>
	</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="7%"><strong>Cliente</strong></td>
      <td width="39%"><strong>Observacion</strong></td>
      <td width="11%">#Doc</td>
      <td width="13%">Refe</td>
      <td width="14%"><strong>CONCEPTO</strong></td>
      <td width="16%">APLICADO</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>BANCOLOMBIA CONSIG<br>
REFERENCIADA   Abono<br>
Porcion Terrestre    USD<br>
$304x3293.62(TRM)<br>
Producto: COLEGIO  PIO XII  - Viajero(s):  SOFIA AGUILAR  CONSTAIN - id:5331</td>
      <td>&nbsp;</td>
      <td valign="middle">Valor:</td>
      <td valign="middle">1.000.000,00</td>
      <td valign="middle">1.000.000,00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Banco</strong></td>
      <td><strong>Descripcion</strong></td>
      <td><strong>Tarjeta</strong></td>
      <td><strong>Autoriz</strong></td>
      <td><strong>Consig En:</strong></td>
      <td><strong>Valor</strong></td>
    </tr>
    <tr>
      <td>99</td>
      <td>EFECTIVO</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">Un Millon    De  Pesos 00/100</td>
    </tr>
  </tbody>
</table>
</body>
</html>