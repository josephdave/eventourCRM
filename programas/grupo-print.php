<?php 

$plan=$_REQUEST['plan'];

require_once("../control/control.php");

$control = new Control();

$accion=$_REQUEST['accion'];

$firma =$_REQUEST['firma'];

if(isset($firma)){
	$cliente = $control->datosViajero($firma);
	$producto=$control->datosProducto($cliente['id_grupo']);
}

$plan=$cliente['id_grupo'];

$asistentcia = $control->datosAsistencia($producto['asistencia_id']);

//var_dump($asistentcia);

if($asistentcia['cancelacion']==1){
	$multicausa=true;
}else{
	$multicausa=false;
}

//var_dump($multicausa);

setlocale(LC_ALL, 'es_ES');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
<title>Programa completo - EVENTOURSPORT</title>
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
	<?php if($_GET['txt']==1){echo    
	"font-size:14px; ;	text-align: justify;";
}?>
	}
	</style>
	
</head>

<body id="home">
<h1 style=" <?php if($_GET['txt']==1){echo 'font-size:20px;';}?>text-align:center;"><strong>CONTRATO DE PRESTACIÓN DE  SERVICIOS TURÍSTICOS</strong></span></h1>

<p>Entre los suscritos a saber RICARDO LUNA RIVERA, mayor de edad y vecino del Municipio de Cali identificado con cédula de ciudadanía No. 16.820.099 expedida en Cali, quien obra en Representación de <strong>EVENTOUR SPORT S.A.S.</strong> por una parte y quien en adelante se  denominará <strong>EVENTOURS </strong>y<strong> </strong><strong><?php echo strtoupper($cliente['acudiente1_nombre']." ".$cliente['acudiente1_apellido']);?></strong> mayor de edad  de esta vecindad identificada con cédula de ciudadanía <?php echo strtoupper($cliente['acudiente1_tipodoc']);?>, <strong>No. <?php echo strtoupper($cliente['acudiente1_documento']);?></strong>, por la otra parte, obrando en nombre de <strong><?php echo strtoupper($cliente['nombres']." ".$cliente['apellidos']);?>,</strong> en calidad de acudiente quien para los efectos de este  convenio se denominará <strong>EL CLIENTE</strong>, se ha celebrado el presente Contrato  Individual de Prestación de Servicios Turísticos que se regirá  por la Ley del Turismo  y sus disposiciones Complementarias, Ley 300  de 1996, Ley 679 de 2001, Ley 1336 de 2009, Decreto 053 de 2020, <strong>Decreto 557 de 2020</strong>, las leyes  civiles y comerciales colombianas y en especial por las siguientes  consideraciones y cláusulas:</p>
<p align="center"><strong>CONSIDERACIONES </strong></p>
<p>Declara <strong>EVENTOURS </strong> por conducto de su representante legal:</p>
<ul>
  <li>Que es una persona jurídica debidamente  constituida conforme a las Leyes de Colombia y tiene su domicilio en Cali.  </li>
  <li>Que es una Agencia de Viajes y turismo y miembro de la  Asociación Colombiana de Agencia de Viajes ANATO. </li>
  <li>Que se encuentra inscrita como agencia de  Viajes y Turismo con Registro Nacional del Turismo con el No. 16310</li>
  <li>Que su Representante Legal cuenta con todas  las facultades para obligarse en los términos del presente contrato. Dichas  facultades no le han sido limitadas, modificadas o revocadas en ninguna forma.</li>
  <li>Que dentro de su objeto social y actividad  económica se encuentra facultada para la promoción,  organización y realización de planes de viaje por vía aérea, terrestre,  marítima o submarina, a lugares situados dentro del territorio nacional o del  exterior.</li>
  <li>Que es su deseo celebrar con <strong>EL CLIENTE</strong> el presente contrato de  prestación de servicios turísticos de conformidad con las cláusulas que más  adelante se enuncian.</li>
</ul>
<p><strong>EL CLIENTE</strong> declara que es su deseo e intención contratar los  servicios que presta <strong>EVENTOURS </strong>y celebra por su decisión el presente contrato: por lo tanto queda obligado  en todos y cada uno de los términos y condiciones establecidos en éste para el  grupo de viaje denominado PROGRAMA <?php echo $producto['grupo']?> <?php echo date("Y",strtotime($producto['f_salida']));?></p>
<p>Siendo así, a su vez declara:</p>
<p>Que cuenta con la capacidad legal suficiente para obligarse en los  términos del presente contrato, a efecto de adquirir los servicios turísticos  prestados por <strong>EVENTOURS.,</strong> en  sus términos y condiciones.<br>
Que los datos que presenta son verdaderos.</p>


<p><strong>EL CLIENTE</strong> declara que:</p>
<ul>
  <li>En su calidad de familiar responsable de <strong><?php echo strtoupper($cliente['nombres']." ".$cliente['apellidos']);?></strong> autoriza a que participe en el grupo de viaje y las actividades objeto del presente contrato.</li>
  <li>Que es su deseo e intención contratar los servicios que presta <strong>EVENTOURS</strong> y celebra por su decisión el presente contrato.</li>
  <li>Por lo anterior queda obligado en todos y cada uno de los términos y condiciones establecidos en éste para el grupo de viaje denominado  <?php echo $producto['grupo']?> <?php echo date("Y",strtotime($producto['f_salida']));?>.</li>
  <li>Que cuenta con la capacidad legal suficiente para obligarse en los términos del presente contrato, a efecto de adquirir los servicios turísticos prestados por <strong>EVENTOURS</strong>., en sus términos y condiciones.</li>
  <li>Que los datos que presenta son verdaderos.</li>
</ul>


<p><strong>CLÁUSULAS </strong></p>
<p><strong>PRIMERA.- </strong>A través del presente contrato <strong>EVENTOURS </strong>se obliga a prestar AL CLIENTE, los servicios  turísticos contenidos en la oferta  mercantil con destino a <strong><?php echo $producto['destino'];?></strong>, <?php 
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  $meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  
  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
          echo "del ".$salida->format("j")." de ".$meses[$salida->format("n")]." al ".$llegada->format("j")." de ".$meses[$llegada->format("n")]." de ".$llegada->format("Y");
?>.  Los siguientes servicios incluidos en el programa:</p>
	
	<div style="font-size: 80%">
	<?php echo str_replace("<div>&nbsp;</div>","",str_replace("<p>&nbsp;</p>","",$producto['incluye']));?></div><p align="center" style="text-align:center">Para mayor infomación remitirse al  programa digital:<br>
(<a href="https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $plan ?>" target="_blank">https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $plan ?></a>)</p>
<br>
<p><strong><u>SEGUNDA.</u></strong><strong>- </strong>SERVICIOS NO INCLUIDOS- <strong>EVENTOURS </strong>se obliga a prestar única y exclusivamente los  servicios contemplados en el programa. La propuesta no incluye: Servicio de  lavandería, llamadas de larga distancia. Ni gastos no especificados en el  contrato.<br>
<strong>PARAGRAFO 1ro: </strong>ACOMODACION- La acomodación será de acuerdo con la descrita en el programa. Cuando ésta sea diferente, por decisión de los viajeros ó porque la cantidad total no alcance a lo establecido en el programa, <strong>EL CLIENTE</strong>, deberá asumir el sobrecosto que esa acomodación genere. El ROOMING LIST debe ser suministrado únicamente por el Comité de Padres ó por quien determine el Comité.</p>
<p><strong><u>TERCERA</u></strong><strong>.- </strong>Las partes convienen que el precio unitario  por usuario, esta descrito en el programa por valor de <strong><?php 
	$total=$producto['valor_terrestre']+$producto['valor_aereo'];
	echo $producto['MONEDA']." ".$total;?></strong>, suma que será cancelada a <strong>EVENTOURS</strong>, por cada uno de <strong>LOS CLIENTES</strong>, en el momento en que manifiesten su voluntaria y libre adhesión  a el programa. Este precio deberá pagarse con total  observancia de lo pactado en el siguiente calendario de pagos, con el fin de evitar la cancelación de las reservas aéreas y  hoteleras.<br>
<p><strong>VALOR DEL PROGRAMA</strong></p>
<table border="1" cellspacing="0" cellpadding="2" style="font-size:80%">
  <tr>
    <th valign="top"><p align="center"><strong>VALOR DEL PLAN POR PERSONA</strong></p></th>
    <th valign="top"><p align="center">
      <strong>
      <?php if ($producto['nombre_tarifa1'] != '' && $producto['nombre_tarifa1'] != 'Programa'){ echo $producto['nombre_tarifa1']; }else{ ?>
      Valor
      <?php } ?></strong>
    </p></th>
    <?php if ($producto['nombre_tarifa2'] != '' &&  strpos(strtolower($producto['nombre_tarifa2']),"interno")===false){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa2']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa3'] != '' &&  strpos(strtolower($producto['nombre_tarifa3']),"interno")===false ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa3']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa4'] != '' &&  strpos(strtolower($producto['nombre_tarifa4']),"interno")===false){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa4']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa5'] != '' &&  strpos(strtolower($producto['nombre_tarifa5']),"interno")===false){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa5']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa6'] != '' &&  strpos(strtolower($producto['nombre_tarifa6']),"interno")===false){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa6']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa7'] != '' &&  strpos(strtolower($producto['nombre_tarifa7']),"interno")===false){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa7']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa8'] != '' &&  strpos(strtolower($producto['nombre_tarifa8']),"interno")===false){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa8']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa9'] != '' &&  strpos(strtolower($producto['nombre_tarifa9']),"interno")===false ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa9']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa10'] != '' &&  strpos(strtolower($producto['nombre_tarifa10']),"interno")===false ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa10']; ?></strong></p></th>
    <?php } ?>
  </tr>
  <tr>
    <td valign="top"><p><strong>Porción terrestre </strong></p></td>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre']?></p></td>
    <?php if ($producto['nombre_tarifa2'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa2']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa3'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa3']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa4'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa4']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa5'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa5']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa6'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa6']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa7'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa7']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa8'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa8']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa9'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa9']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa10'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_terrestre_tarifa10']?></p></td>
    <?php } ?>
  </tr>
  <tr>
    <td valign="top"><p><strong>Tiquete aéreo </strong></p></td>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo']?></p></td>
    <?php if ($producto['nombre_tarifa2'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa2']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa3'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa3']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa4'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa4']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa5'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa5']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa6'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa6']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa7'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa7']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa8'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa8']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa9'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa9']?></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa10'] != ''){?>
    <td valign="top"><p align="right"><?php echo $moneda." ".$producto['valor_aereo_tarifa10']?></p></td>
    <?php } ?>
  </tr>
  <tr>
    <td valign="top"><p><strong>VALOR TOTAL DEL PROGRAMA</strong></p></td>
    <td valign="top"><p align="right">
      <strong>
<?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
<?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></strong></p></td>
    <?php if ($producto['nombre_tarifa2'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa2']+$producto['valor_terrestre_tarifa2'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa3'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa3']+$producto['valor_terrestre_tarifa3'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa4'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa4']+$producto['valor_terrestre_tarifa4'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa5'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa5']+$producto['valor_terrestre_tarifa5'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa6'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa6']+$producto['valor_terrestre_tarifa6'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa7'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa7']+$producto['valor_terrestre_tarifa7'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa8'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa8']+$producto['valor_terrestre_tarifa8'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa9'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa9']+$producto['valor_terrestre_tarifa9'])?></strong></p></td>
    <?php } ?>
    <?php if ($producto['nombre_tarifa10'] != ''){?>
    <td valign="top"><p align="right"><strong>
      <?php $moneda=$producto['MONEDA']; echo $moneda."  ";?>
      <?php echo ($producto['valor_aereo_tarifa10']+$producto['valor_terrestre_tarifa10'])?></strong></p></td>
    <?php } ?>
  </tr>
</table>
<p><strong>CALENDARIO DE PAGOS</strong><br> 
<table border="1" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC" style="font-size:80%; text-align:center; margin:auto;"> 
  <tr style="background: #0b3040; color:#fff;">
    <td><strong>CUOTA</strong></td>
    <td><strong>FECHA DE PAGO</strong></td>
    <td><strong>TIQUETE (TKT)</strong></td>
    <td><strong>TERRESTRE (PT)</strong></td>
    <td><strong>TKT + PT</strong></td>
  </tr>
  <?php 
    $totaltik = 0;
    $totalpt = 0;

    $resultado5 = $control->consultaCalendarioPagos($plan);
    while ($fi5 = mysql_fetch_array($resultado5, MYSQL_ASSOC)) {
  ?>
  <tr>
    <td><?php echo "".$fi5['id']; ?></td>
    <td><?php 
        $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
        $formatter->setPattern('dd-MMM-yyyy');
        echo $formatter->format(new DateTime($fi5['fecha'])); 
    ?></td>
    <?php if ($fi5['aerea'] <= 1 && $fi5['aerea'] != 0) { ?>
      <td><?php echo " ".($fi5['aerea'] * 100)."%"; ?></td>
    <?php } else if ($fi5['aerea'] == 0) { ?>
      <td>0</td>
    <?php } else { ?>
      <td><?php 
        $total_aerea += $fi5['aerea'];
        echo $producto['MONEDA']." ".$fi5['aerea']; 
      ?></td>
    <?php } ?>
    <?php if ($fi5['terrestre'] <= 1 && $fi5['terrestre'] != 0) { ?>
      <td><?php echo " ".($fi5['terrestre'] * 100)."%"; ?></td>
    <?php } else if ($fi5['terrestre'] == 0) { ?>
      <td>0</td>
    <?php } else { ?>
      <td><?php 
        $total_terreste += $fi5['terrestre'];
        echo $producto['MONEDA']." ".$fi5['terrestre']; 
      ?></td>
      <td><?php 
        echo $producto['MONEDA']." ".($fi5['terrestre'] + $fi5['aerea']); 
      ?></td>
    <?php } ?>
  </tr>
  <?php } ?>
 <tr style="background: #0b3040; color:#fff;">
    <td colspan="2"><strong>TOTAL PROGRAMA:</strong></td>
    <td><strong><?php echo $producto['MONEDA']." ".$total_aerea; ?></strong></td>
    <td><strong><?php echo $producto['MONEDA']." ".$total_terreste; ?></strong></td>
    <td><strong><?php echo $producto['MONEDA']." ".($total_aerea + $total_terreste); ?></strong></td>
  </tr>
</table>
<p><strong>PARAGRAFO 1ro: </strong>Este precio se sostendrá si el depósito  inicial se realiza hasta la fecha limite pactada como cuota primera y con el  contrato debidamente firmado. En caso de no darse estas condiciones, <strong>EL CLIENTE </strong>queda sujeto a disponibilidad  de tarifa aérea, y hotelera.<br>
<strong>PARAGRAFO 2do: </strong>El primer depósito se abonará al precio total  pactado en la presente cláusula. Esta suma será asumida por concepto de  depósito y será tomada como garantía para la reserva de los cupos aéreos y  hoteleros. Estos depósitos no serán reembolsables, ni endosables, ni  transferibles.<br>
<strong>PARAGRAFO 3ro: </strong>El pago del plan turístico deberá ser aportado  de acuerdo con las formas de pago indicadas en el presente contrato, en las fechas establecidas. En caso de incumplir con el pago, el viajero correrá el riesgo de perder  sus cupos aéreos y hoteleros. En caso de que <strong>EL CLIENTE</strong> pierda su reserva,   solo podrá reintegrarse al viaje siempre y cuando <strong>EVENTOURS</strong> logré conseguir nuevamente el cupo tanto aéreo como  hotelero, caso en el cual deberá <strong>EL  CLIENTE</strong> asumir el sobrecosto de la diferencia en la tarifa aérea y/o la  acomodación en el hotel que se genere debido a su incumplimiento.</p>
<?php if($producto['MONEDA']!="COP"){?>  <p><strong>PARÁGRAFO  4to: </strong>El  valor se encuentra determinado en dólares americanos<strong> </strong>por lo tanto  corresponderá al valor en pesos que determine la TRM del día del pago  efectivo.  En caso de realizarse algún  tipo de reembolso derivado del derecho de retracto y/o de cualquier otra causal  que implique devolución del valor pagado, EVENTOURS reconocerá el valor de la  devolución en pesos a la TRM de la FECHA PAGO.</p><?php } ?>
<p><strong><u>CUARTA</u></strong><strong>.</strong>- <strong>DERECHO  DE RETRACTO. EL CLIENTE </strong>tendrán cinco (5) días hábiles contados a partir de  la celebración del presente contrato y/o pago de la primera cuota para ejercer  el derecho de retracto de que trata el artículo 47 de la Ley 1480 de 2011, caso  en el cual se resolverá el presente contrato y <strong>EVENTOURS</strong> deberá reintegrar el 100% del dinero que <strong>EL CLIENTE </strong>hubiese pagado. La  devolución del dinero pagado no podrá exceder de treinta (30) días calendario,  desde el momento en que ejerció el derecho de retracto.</p>
<p><u><strong>QUINTA</strong></u><strong>. </strong>- COMPROMISOS DE EVENTOURS</p>
<ul>
  <li><strong>EVENTOURS, </strong>deberá pagar y reservar por los tiquetes de  ida y regreso, el hotel seleccionado para el grupo y todos los proveedores que se requieren para que las actividades, diurnas y nocturnas ofrecidas sean  realizadas de manera exitosa.</li>
  <li><strong>EVENTOURS</strong> enviará vía correo electrónico, quince (15) días  previos al viaje, un Boletín de salida con la siguiente información: aerolínea  e itinerario de vuelo, documentos necesarios para ingresar al país,  identificación de acompañante, programación de actividades en destino, manual  de convivencia y conducta.</li>
  <li><strong>EVENTOURS</strong> realizará todas las reuniones relativas a la  excursión que <strong>EL CLIENTE</strong> requiera, de  manera grupal.</li>
  <li><strong>EVENTOURS</strong> enviará BOLETINES INFORMATIVOS que considere  de importancia, antes, durante y después del viaje.</li>
  <li><strong>EVENTOURS</strong> deberá mantener canales de comunicación que le permita a EL CLIENTE mantenerse informado sobre el desarrollo  del programa del viaje, siempre y cuando las condiciones técnicas y/o  geográficas y/o de otro tipo se lo permitan.</li>
  <li><strong>EVENTOURS</strong> no permitirá el ingreso  al programa de viaje a personas que no hayan  contratado servicios con <strong>EVENTOUR SPORT SAS</strong></li>
  <li><strong>EVENTOURS</strong> apoyará a todos sus viajeros en caso de  calamidad, accidente, enfermedad, desastre o siniestro.</li>
  <li><strong>EVENTOURS </strong> asignará para el acompañamiento del grupo, un funcionario adulto en proporción a uno por cada 5 viajeros en destino.</li>
  <li><strong> EVENTOURS</strong> asignará un funcionario de su planta, para coordinar con el  departamento de grupos del hotel, la asistencia y respuesta a los  requerimientos del grupo durante su permanencia en el hotel.</li>
  <li><strong>EVENTOURS</strong> debe cumplir y prestar a cabalidad todos los  servicios ofrecidos al grupo y detallados anteriormente en el Programa.</li>
  <li><strong>EVENTOURS</strong> está en la obligación de informar a los  pasajeros de los requisitos exigidos por las autoridades en cada destino, como  vacunas, documentación personal necesaria para el desplazamiento en destinos  nacionales e internacionales, sin embargo declinamos toda responsabilidad en  caso de que las autoridades del país o países visitados, nieguen al pasajero el  ingreso al mismo, evento en el cual el pasajero no tendrá derecho al reintegro  del valor de los servicios no utilizados. </li>
  <li><strong>EVENTOURS </strong>brindará  de manera individual a <strong>EL CLIENTE </strong>la  cobertura de servicios médicos prestados por <strong>LA COMPAÑIA DE ASISTENCIA MEDICA </strong>seleccionada para el programa y detallados, durante  todos los días que  el programa de viaje dure.</li>
  <li><strong>EVENTOURS </strong>omo agencia operadora y organizadora logística del viaje que realiza la persona inscrita en este contrato, se encargará de cubrir los gastos por concepto de medicamentos para el pasajero, en caso de que lo requiera y sean recetados por el médico que lo atienda, durante el viaje; sin embargo, y en el mismo orden de ideas, <strong>EVENTOURS </strong>también será la entidad autorizada y encargada para solicitar reintegros y reembolsos por estos conceptos ante Assist Card una vez haya finalizado el viaje.</li>
</ul>
<p><u><strong>SEXTA</strong>.</u>- COMPROMISOS DEL CLIENTE </p>
<ul>
  <li>Aportar  a EVENTOURS la información y  documentación del viajero que les sea expresamente requerida. </li>
  <li>Es compromiso incondicional de EL CLIENTE informar a EVENTOUR SPORT SAS con certificación médica, expedida como máximo 10 días antes de la fecha del viaje, si el viajero tiene restricciones de salud especiales que, de no ser cumplidas, puedan poner es riesgo la salud y el bienestar durante su viaje. En caso de que los datos suministrados no sean actuales y/o veraces EVENTOUR SPORT SAS queda exonerado de cualquier tipo de responsabilidad que se derive por los perjuicios que en virtud de esa información se causen al viajero</li>
  <li> Pagar  a EVENTOURS, el paquete turístico  completo, descrito en el programa. (No se acepta el pago de únicamente Porción  Terrestre o solo Tiquete)</li>
  <li>EL CLIENTE debe reservar, confirmar, y pagar la cuota  establecida en el calendario de pagos. Se  sujetará a las condiciones y restricciones descritas en la CLAUSULA TERCERA del  presente contrato. </li>
  <li>Asistir  a todas las reuniones informativas que, para asegurar el éxito del viaje que programe EVENTOURS.</li>
  <li>El viajero debe cumplir con todas las  normas  descritas en el <strong>MANUAL DE  CONDUCTA Y CONVIVENCIA<strong> (VER ANEXO 1)</strong></li>
  <li>El  viajero no está autorizado para alquilar y/o conducir motos acuáticas, ni terrestres ni  ningún tipo de vehículo motorizado. </li>
  <li>Acatar  y cumplir las normas de la legislación del país visitado que sean impartidas  por las autoridades de policía y/o las autoridades competentes en los  diferentes lugares del país. </li>
  <li>Hacerse responsables por los perjuicios que, por culpa del viajero, se causen a EVENTOUR SPORT SAS y/o a diferentes proveedores turísticos, en razón a la inobservancia del código de conducta del usuario</li>
  <li>Informar  a EVENTOURS si el viajero padece algún tipo de <strong>condición médica preexistente,</strong> especial o  de alimentación. EVENTOURS no se hace responsable en caso de que los datos  suministrados no sean actuales y/o veraces y queda exonerado de cualquier tipo  de responsabilidad que se derive por los perjuicios que en virtud de esa  información se causen al viajero. </li>
  <li>Cumplir  con los requisitos migratorios que exigen los gobiernos de Colombia y <strong>el país del destino,</strong> al  momento del viaje. </li>
  <li>El  viajero es responsable de presentar todos los documentos requeridos para salir  del país. En caso de ser menor de 18 años, deberán presentar el día de la  salida ante la Unidad Administrativa Especial de Migración Colombia, un permiso  original de salida del país de los padres, autenticado ante notario público y su  registro civil de nacimiento original, reciente y en buen estado. </li>
  <li>El Pasajero es responsable del equipaje y  demás pertenecías personales que lleve consigo y <strong>EVENTOURS </strong>no se hará responsable en caso de pérdida de los  mismos.</li>
  <li>EL <strong>CLIENTE</strong> DEBE enviar copia escaneada de la documentación del viajero, necesaria para salir del país. <strong>EVENTOURS</strong> se hace responsable de revisarlos hasta máximo 30 días antes del viaje, exceptuando casos especiales, donde el viajero este sujeto a entregar cedula o contraseña, <strong>de acuerdo con su caso, días antes</strong> de viajar.</li>
	 
															  
	
  <li> El GRUPO <strong>debe  estar integrado por una cantidad</strong> mínima <strong>de 20 pasajeros</strong> <strong>o más personas viajando juntas, en la misma  ruta, fechas y vuelos.</strong></li>
  <li>No se considerará <strong>GRUPO </strong>y no gozará de los beneficios de <strong>GRUPO</strong>, la cantidad de viajeros que no cumpla con estos requisitos.<strong></strong></li>
  <li><strong>EL GRUPO</strong> debe suministrar a <strong>EVENTOURS</strong> el listado oficial de los viajeros potenciales que  puedan participar del viaje. Cualquier persona que no pertenezca a dicho  comunicado <strong>debe estar autorizado</strong> por escrito por el comité de padres de familia. </li>

  <li><strong>EL GRUPO debe</strong> enviar a <strong>EVENTOURS</strong> mínimo sesenta días (60) antes del viaje, el listado con los nombres y la  acomodación de habitaciones del grupo, por habitaciones <strong>en un formato</strong> que <strong>EVENTOURS</strong> le <strong>suministrará</strong> a <strong>EL GRUPO.</strong> cualquier modificación después de esa fecha, acarreará una multa relativa al cambio solicitado.</li>
  <li>En caso de que un grupo de viajeros o la totalidad del grupo decida incluir una actividad distinta a las descritas en el PROGRAMA, y adicionar el costo de dicha actividad al precio de venta, <strong>EL GRUPO</strong> deberá enviar un listado vía correo electrónico, informando a EVENTOURS el nombre de LOS CLIENTES a los cuales se les deberá cargar el valor extra.</li>
  <li> Los viajeros que durante el viaje decidan tomar actividades adicionales que no estén descritas en el programa tendrán un costo adicional, y su pago deberá ser efectuado en dólares en efectivo.</li>
</ul>
<p><u><strong>SEPTIMA</strong>.</u>- <strong>CAMBIOS, CANCELACIONES Y REEMBOLSOS:</strong></p>
<p>Una vez abonada una o cualquier cantidad de cuotas del plan establecido, los valores no serán reembolsables, salvo en  aquellos casos de fuerza mayor o caso fortuito entiéndase como: circunstancia que, por no poder ser prevista o evitada, imposibilita absolutamente al cumplimiento de dicha obligación, <strong>EVENTOURS</strong> realizará un  análisis previo de la procedencia de la  solicitud. En razón a que la OMS declaro el 11 de Marzo de 2020 el  brote de coronavirus COVID -19 como una pandemia, el ministerio de salud y  protección social expidió la resolución 385 del 12 de marzo que declaró la  emergencia sanitaria, por la cual se adoptaron medidas para proteger a los  usuarios de servicios turísticos,
por esto, el 15 de abril de 2020, se publicó el <strong>Decreto  557</strong>, que en el <strong>artículo 4°</strong> titulado como <strong>Derecho de  retracto,</strong> <strong>desistimiento y otras circunstancias de reembolso,</strong> indica que en  los eventos en que los prestadores de servicios turísticos con Registro Nacional  de Turismo vigente, reciban solicitudes de retracto, desistimiento y otras  circunstancias relacionadas con la solicitud de reembolso, podrán realizar,  durante la vigencia de la Emergencia Sanitaria, y hasta por un año más, reembolsos a los usuarios <u>en servicios que los mismos operadores de  servicios presten</u>.</p>
<p>Toda solicitud de devolución debe realizarse mediante  comunicación escrita del titular de la factura, dirigida a <strong>EVENTOURS </strong>al correo <a href="mailto:juvenil@eventours.travel">juvenil@eventours.travel </a>explicando los motivos que inducen a la cancelación, adjuntando los  documentos que la sustenten. En caso de que haya lugar a algún tipo de  devolución de dinero, se realizará, en el momento en el que la aerolínea, el  hotel y/o los demás proveedores se pronuncien sobre el particular. El valor  que se ha de reembolsar por concepto de servicios incluidos en el plan y no utilizados, está sujeto a la aplicación de los descuentos por  penalidades, por gastos administrativos o por cobros de no show de acuerdo con  las condiciones particulares de cancelación de cada aerolínea, hotel u  operador, según sean aplicables.</p>
<p>En caso de reembolso, cumpliendo con el contenido del  Decreto 2438 de 2010  Artículo 6, las partes acuerdan que la suma    del <strong>20%</strong> del  total del valor del programa, <strong>no será reembolsable</strong>, ni transferible, ni endosable, <strong>en ningún caso,</strong> de acuerdo con los términos y condiciones  estipulados por operadores en destino, hoteles, atractivos turísticos,  servicios de asistencia y aerolíneas en razón a que, serán descontados para asumir gastos administrativos y  financieros por las cancelaciones.</p>


<?php if(strpos($producto['parametros'],'sinasistencia') === false){
            
            $asistencia=$control->datosAsistencia($producto['asistencia_id']);
                //var_dump($asistencia);
            ?>
    <p>En caso de no aplicar a reembolso, para proteger la inversión de sus clientes, <strong>EVENTOURS</strong>, incluye en este programa un <strong>Seguro de Cancelación o interrupción de viaje, </strong> que  hace parte de los beneficios que ofrece la compañía de asistencia al viajero <strong>ASSIT CARD,</strong> que reconocerá al asegurado el valor de la penalidad descontada hasta el límite contratado, amparado en cualquiera de las 21 causales indicadas a continuación y que tendrán vigencia desde el mismo momento del primer abono efectuado al plan de viaje. El viajero podrá leer los términos y condiciones que se requieren para cubrir el valor de la penalidad por la <strong>Cancelación e interrupción de viaje</strong> de los servicios terrestres de este programa, en la sección de <strong>Seguro de Asistencia.</strong>    </p>
    <p><strong><?php echo $asistencia['nombre'];?>:</strong></p>
    <ol>
      <li>Muerte, accidente o enfermedad del Titular                                                              100%</li>
      <li>Muerte o internación hospitalaria por accidente o enfermedad de  cónyuge, padres, hijos o hnos.      100%</li>
      <li>Notificación fehaciente para comparecer ante la justicia                                         100%</li>
      <li>Complicación graves en el embarazo (titular o cónyuge)                                        100%</li>
      <li>Parto prematuro (titular o cónyuge)                                                                           100%</li>
      <li>Despido laboral por causa no disciplinaria                                                                100%</li>
      <li>Entrega de niño en adopción o guardia/custodia                                                      100%</li>
      <li>Llamada para trasplante de órganos                                                                         100%</li>
      <li>Daños graves por incendio, robo o fuerza de la naturaleza en residencia  habitual /comercial               85%</li>
      <li>Convocatoria mesa electoral                                                                                      85%</li>
      <li>Cancelación de boda                                                                                                  85%</li>
      <li>Secuestro titular/familiar directo                                                                                85%</li>
      <li>Desastre natural (En origen o destino)                                                                      85%</li>
      <li>Incorporación a un nuevo puesto de trabajo                                                             85%</li>
      <li>Convocatoria oficial por trámites de divorcio                                                            85%</li>
      <li>Traslado forzoso de lugar de trabajo                                                                         85%</li>
      <li>Incorporación a Fuerzas Armadas                                                                            85%</li>
      <li>Robo de documentación que imposibilite iniciar el viaje                                          85%</li>
      <li>Concesión de becas oficiales que impidan la realización del viaje                         85%</li>
      <li>Rechazo o demora de Visado                                                                                    85%</li>
      <li>Cancelación de acompañante del titular por alguno de los motivos  anteriores     85%</li>
    </ol>
    <p>&nbsp;</p>
    <p><strong>*Importante:</strong> Los seguros  indicados están amparados por pólizas contratadas con compañías de seguros y  aplican las exclusiones de uso habitual y/o legal para este tipo de coberturas  y aprobadas por el Organismo Contralor de Seguros del país en el que se emita  la Tarjeta ASSIST CARD</p>
    <p>Las condiciones generales a las que se  limita ASSIST CARD están a disposición del público y pueden ser consultadas en  cualquier momento sin obligación de compra, consultándonos telefónicamente o en  nuestra sección SEGURO DE ASISTENCIA. Algunos  productos contemplan limitaciones por edad. Las enfermedades preexistentes  tienen exclusiones y limitaciones en los beneficios. Consulte las que  corresponden al producto por usted elegido  en la sección SEGURO DE ASISNTENCIA. ASSIST CARD se reserva  el derecho de introducir modificaciones en los alcances  y descripciones del servicio. Consulte al momento de la  contratación. El seguro de cancelación de Assist Card bajo las 21 Causales de Cancelación, solo aplica para ciudadanos colombianos viajando desde Colombia.</p>
  </ul>

  <?php } ?>
<ul> <li> En caso de no haber lugar al reembolso, el viajero podrá ceder o traspasar la parte correspondiente a otro usuario, siempre y cuando no se encuentre en la lista de inscritos del programa de viaje, ni haya efectuado ningún pago. Si el tiquete aún no está emitido, EL CLIENTE deberá asumir la suma de USD 120 de penalidad por cambio de nombre del titular. Una vez emitido el tiquete aéreo, deberá asumir el monto pactado por la aerolínea.</li>
    <li><strong>EVENTOURS </strong>se reservará el derecho de cancelar  el viaje, en caso de que no se registren el número mínimo de viajeros (20)  descritos en el presente contrato para que se configure un grupo. En este caso,  EVENTOURS se reserva el derecho de agrupar a los inscritos con otro grupo de  viajeros que participen del mismo programa, en la misma fecha, itinerarios de  vuelos y servicios ofrecidos.</li>
    <li><strong>EVENTOURS </strong>tiene la facultad de retirar del viaje a quien por falta grave de carácter moral y/o disciplinario, atente contra la seguridad y/o tranquilidad del viaje, sin derecho a reembolso, debiendo abandonar el destino según el caso. EL CLIENTE debe asumir los costos adicionales que se deriven por la causa de su conducta, como se especifica en el MANUAL DE CONDUCTA Y CONVIVENCIA del ANEXO 1 del presente contrato.</li>
</ul>
<ul>
  <li><strong>EVENTOURS</strong> y/o los operadores turísticos,  no se hacen responsables frente a la contravención de normas, leyes y/o asuntos  legales u otros inconvenientes, en que pueda verse involucrado el viajero en  otro país, casos en que el viajero será obligado a retirarse del programa de  viaje por tales motivos, y no le serán reembolsados los servicios no tomados.</li>

  <li>El viajero que se vea  obligado a retirarse del viaje, por motivos personales no tendrá derecho al  reintegro de los servicios no tomados, ocasionando un cobro de no show de  acuerdo a las condiciones de la aerolínea y las condiciones de cada hotel y/o  operador. <strong>EL CLIENTE</strong> debe asumir los  costos en penalidades por cambios de vuelo en caso de modificación en su fecha  de regreso. 
    <br>
  </li>
<br>
<strong>DE LOS TIQUETES AÉREOS:</strong><br>
    <p><strong>Restricciones:</strong></p>
    <ul>
      <li>Si el grupo viaja en vuelos de itinerario de aerolínea regular y el viajero no se presenta al vuelo, el boleto solo podrá ser utilizado a nombre del titular, para futuros viajes en rutas internacionales, de la misma aerolínea, con una vigencia máxima de 1 año, solamente si los términos y condiciones del contrato de transporte grupal de la aerolínea utilizada lo permita, previo pago de la penalidad por cambio  fecha de viaje, más el costo de la tasa administrativa y de la diferencia de tarifa, a que hubiere lugar.<li>
      <br>
    <p><strong>Cambios:</strong></p>
    <ul>
      <li>Si por alguna razón existe un cambio de nombre del viajero, este debe ser informado, por lo menos 30 días antes de la salida del vuelo y dicho cambio tendrá un costo de USD 100 más IVA, a la TRM del día en que se efectúe el cambio.<li>
      <li>El precio incluye las tasas de combustible, aeropuertos e impuestos gubernamentales, y estos cargos pueden sufrir ajustes, antes de la emisión de los tiquetes electrónicos, por decretos de las autoridades aeronáuticas, caso en el cual EL CLIENTE estarán obligados a cubrir la diferencia que resulte por esta decisión.</li>
      <li>El boleto tendrá vigencia a partir de la fecha del primer pago; si el pasajero no se presenta en la fecha señalada para su vuelo y no solicitó ningún cambio antes de la salida del vuelo, la vigencia del boleto terminará en esa misma fecha y no aplicará ningún tipo de reembolso o acreditación.</li>
      <li>Una vez realizado el pago de la primera cuota, no se permiten reducciones. Las condiciones de las tarifas aéreas grupales son: No reembolsables, No cancelables y puede ser endosables, solamente hasta 30 días antes del viaje.</li>
      <li>Una vez iniciado el viaje no se podrá hacer cambio de nombre.</li>
      <li>El porcentaje máximo permitido para cambios de nombres del grupo será del 20% del total del grupo y solamente antes de la fecha de emisión, que es 30 días antes de la fecha de viaje.</li>
    </ul>
</ul>
<p><strong><u>OCTAVA</u></strong><strong>.- CESION DE DERECHOS:</strong></p>
<p><strong>EL CLIENTE</strong> autoriza a través del presente contrato a <strong>EVENTOURS, </strong>a usar la imagen, fotos y testimonios de <strong>EL CLIENTE</strong> con fines de emitir,  publicar, divulgar y promocionar sus planes de viaje y promociones turísticas  en cualquiera de los destinos que desarrollen sus planes de viaje. </p>
<p>Tal utilización  podrá realizarse mediante la divulgación a través de su reproducción, en medios  audiovisuales, a través de los medios existentes, incluidos aquellos de acceso  remoto, conocidos como Internet y redes sociales, para fines promocionales e  informativos de <strong>EVENTOURS.</strong></p>
<p><strong>EL CLIENTE</strong> entiende y acepta que no recibirá ningún tipo de compensación,  bonificación o pago de ninguna naturaleza y reconoce además que no existe  ninguna expectativa sobre los eventuales efectos económicos de la divulgación,  sobre el tipo de campaña publicitaria que pueda realizar <strong>EVENTOURS.</strong></p>
<p>La vigencia de  esta autorización corresponde al término establecido en la ley 23 de 1982,  durante el cual <strong>EVENTOURS</strong> es  titular de los derechos sobre las piezas a publicar. </p>
<p><strong><u>NOVENA</u></strong><strong>.- CLAÚSULAS DE RESPONSABILIDAD:</strong></p>
<ul>
  <li><strong>EVENTOURS, </strong>con Registro Nacional de Turismo vigente No.  16310, en su calidad de agente de viajes y turismo y sus operadores en el  destino, organizadores de este programa, declaramos explícitamente que actuamos  como intermediarios entre los pasajeros, por una parte, y las entidades  llamadas a proporcionar los servicios descritos en los diferentes itinerarios,  por la otra parte, responsabilizándonos del cumplimiento de los servicios  mencionados en este programa. </li>
  <li><strong>EVENTOURS</strong> y sus operadores tienen la prerrogativa de  hacer cambios en el itinerario, fecha de viaje, hoteles, transporte y los demás  servicios, por otros de igual o superior categoría, que sean necesarios para  garantizar el éxito de la excursión, en casos particulares en los que, por  causa del hotel y operadores turísticos, se presenten fallas en la prestación  del servicio.</li>
  <li><strong>EVENTOURS </strong>y sus operadores, declinan toda  responsabilidad y gastos extras por retrasos, huelgas, terremotos, huracanes,  avalanchas o demás causas de fuerza mayor, así como cualquier pérdida, daño,  accidente o irregularidad que pudiera ocurrir a los pasajeros y sus  pertenencias, cuando estos sean motivados por terceros, y por tanto ajenos al  control del Operador y sus afiliados. Igualmente quedamos exentos de cualquier  perjuicio por modificación o retraso en los itinerarios aéreos que se incluyan  en los diferentes programas.</li>
    <p><strong>EVENTOURS</strong> y sus operadores, no se harán responsables ante la imposibilidad de  prestar sus servicios o el retraso en el cumplimiento de sus obligaciones  derivada de actos, hechos, omisiones o accidentes que escapan de su control,  señalando de forma enunciativa más no limitativa: caso fortuito o fuerza mayor  declarado por la autoridad gubernamental correspondiente, inclemencias del  tiempo, restricciones de cuarentena, desastres naturales que limiten su  capacidad de respuesta, guerras, huelgas, cierres de aerolíneas o afectaciones  derivadas de los terceros contratados por <strong>EVENTOURS</strong> o sus operadores siempre  que se demuestre que éste hizo todo lo posible que está a su alcance para  subsanar la falta y proporcionar el servicio. <strong>EVENTOURS</strong> notificará por  escrito a <strong>EL CLIENTE</strong> el impedimento dentro de los 10 (diez) días  naturales siguientes a que se tenga conocimiento de su existencia. No quedan  comprendidas dentro de estas causas los conflictos obrero-patronales que surjan  entre cualquiera de las partes y sus trabajadores, ni tampoco los conflictos  administrativos o judiciales de cualquier orden. Una vez que hayan cesado los  efectos del impedimento, <strong>EVENTOURS</strong> se obliga a prestar los servicios  turísticos, quedando sujetos a la disponibilidad ocupacional en los vuelos y  hospedajes respectivos, por lo que la <strong>EL CLIENTE</strong> está de acuerdo que <strong>EVENTOURS</strong> podrá tomar las medidas necesarias para prestar el servicio, señalando de forma  enunciativa: cambio de las actividades originales, fechas, hoteles,  itinerarios, horarios, aerolíneas o, en su caso, destino, manteniendo la  calidad de los servicios originalmente contratados, siempre y cuando <strong>EVENTOURS</strong> no deba incurrir en gastos extras con los proveedores. Los gastos extras que se  generen con motivo de la prestación del servicio serán cubiertos por <strong>EL  CLIENTE</strong> quien adicionalmente acepta que en caso de requerir la devolución  del pago que realizó por la prestación del servicio, podrá ser devuelto  mediante bonos que permitan la adquisición de cualquier servicio de <strong>EVENTOURS</strong> en el mismo lugar en el que fue contratado, en este caso en Cancún, el cual podrá  ser transferible a un tercero y tendrá vigencia de un (1) año a partir de la  expedición del bono respetivo.</p>
  </li>
  <li><strong>EVENTOURS</strong> y/o la Aerolínea no podrán ser demandados por  retrasos o cancelaciones de vuelos debido a fenómenos de la naturaleza, o a  cualquier otra causa fuera del control nuestro.</li>
  <li><strong>EVENTOURS </strong>informa que<strong> </strong>tanto las tasas de combustible, aeropuertos e impuestos  gubernamentales pueden sufrir ajustes, antes de la emisión de los tiquetes  electrónicos o de la  utilización del alojamiento en los hoteles. En este caso los viajeros estarán  obligados a cubrir la diferencia que resulte liquidada.</li>

    <p><strong>De los Tiquetes  Aéreos: </strong>El valor del tiquete está compuesto por la  tarifa aérea y el valor de los impuestos de Combustible (Q), IVA, tasas de  salida de cada territorio, tasas de aeropuertos, de turismo, Fees  administrativos, y algunos <strong>otros de acuerdo con cada país.<strong> Estos pueden variar  con las legislaciones de esos países que se visiten, por lo tanto, el valor de  estos impuestos puede sufrir variaciones y sus precios solo se garantizaran con  la expedición definitiva de todos los tiquetes del grupo, cuya expedición se  efectuará en una sola fecha para todos, como lo estipulan las aerolíneas en las  tarifas para grupos. Los tiquetes del grupo solo podrán ser expedidos por <strong>EVENTOURS</strong> de acuerdo con las cláusulas del convenio firmado  con la aerolínea en el momento de cotizar y confirmar el  grupo.</p>
  </li>
  <li>Las tarifas de este grupo tienen un precio y  condiciones especiales, por lo tanto, no pueden combinarse con otras promociones  o beneficios, tales como tiquetes de millas, etc. y solo podrán ser expedidos  por <strong>EVENTOURS. </strong></li>
  <li><strong>De la Porción Terrestre:</strong> Todos los servicios incluidos en la Porción Terrestre están tarifados  en dólares porque son proveídos por empresas establecidas en el exterior, pero  como debemos recaudarlos en pesos Colombianos, deben liquidarse a la TRM (tasa  representativa del mercado) del día de su pago. Para efectos legales, las  Agencias de viajes y turismo, estamos obligados a comprar divisas y a pagar  impuestos sobre las mismas, porque debemos pagar servicios a empresas  internacionales, que tienen cuentas de bancos en el exterior. Por esta razón  estamos autorizadas por el gobierno para cobrar un fee bancario del 2%, sobre  el total de los servicios terrestres en dólares.</li>
  <li>Las diferencias en el cambio de divisas que se  presenten con ocasión del pago de servicios o en los casos en los cuales se  determine la devolución de recursos están a cargo exclusivamente de <strong>EL  CLIENTE</strong>.<strong></strong>  </li>
</ul>
<p><strong>DECIMA.- CESION DEL CONTRATO: </strong>Queda prohibido a <strong>EVENTOURS </strong>ceder total o  parcialmente la ejecución del presente contrato a un tercero, salvo previa  autorización de <strong>EL CLIENTE. </strong>Igualmente,  queda prohibido a los integrantes de <strong>EL  GRUPO </strong>ceder total o parcialmente los cupos aéreos y hoteleros con los que  cuenta, salvo autorización expresa de <strong>EVENTOURS</strong>.</p>
<p><strong>DECIMA PRIMERA.- RESERVA Y CONFIDENCIALIDAD: </strong>Toda la información, que se entreguen las partes, durante la negociación, ejecución  y liquidación del presente contrato  será de carácter confidencial y sólo  podrá ser utilizada para el propósito de establecer, negociar y mantener los  servicios contratados, quedándole prohibido a la parte que recibe la  información compartirla con terceros.</p>
<p><strong>DÉCIMA SEGUNDA. – PROTECCIÓN  DE DATOS PERSONALES: EL CLIENTE</strong> como  titular de los datos personales suministrados para la elaboración y ejecución  del presente contrato y en cumplimiento de la Ley 1581 de 2012; el Decreto 1377  de 2013 y demás normas concordantes, autoriza de manera previa, expresa e  informada a <strong>EVENTOURS</strong>. para que, directamente o a través de sus  empleados, asesores y/o terceros encargados del tratamiento de datos recolecte,  use, procese, circule, actualice, transmita y/o elimine total o parcialmente la  información entregada en virtud del desarrollo de las actividades contempladas  en el presente contrato  especialmente  para fines administrativos y operativos encaminados a realizar las reservas,  acomodaciones y demás actividades propias de los servicios contratados, mantenerme  informado de los avances de las actividades y de la posibilidad de ampliación  de sus servicios conforme con las políticas descritas en el Manual de Políticas  para el tratamiento de datos personales de EVENTOURS y que EL CLIENTE declara  conocer. </p>
<p><strong>DECIMA TERCERA.- TERMINACION DEL CONTRATO. </strong>El presente  contrato podrá darse por terminado por una de las siguientes causales:</p>
<ul>
	<li>Mutuo acuerdo entre las partes</li>
	<li>Incumplimiento de las obligaciones incluidas en el presente contrato  por las partes.</li>
</ul>
<p><strong>DECIMA CUARTA</strong>. - <strong>DECLARACIÓN DE ORIGEN DE  FONDOS</strong>.<br>
Me  permito realizar las siguientes declaraciones sobre la fuente y origen de  fondos y actividades licitas:</p>
<ol>
  <li>Declaro que mis bienes y recursos  provienen de actividades lícitas, de conformidad con la normatividad Colombiana.</li>
  <li>Que no admitiré que terceros  efectúen depósitos en mis cuentas con fondos provenientes de las actividades ilícitas contempladas en el código Penal Colombiano o en cualquier otra  norma que lo adicione; ni efectuaré
  transacciones destinadas a tales actividades o a favor de personas  relacionadas con las mismas.</li>
  <li>Que todas las actividades e  ingresos que se perciben provienen de actividades licitas.</li>
  <li>Que no me (nos) encontramos en  ninguna lista de reporte internacional o bloqueado por actividades de narcotráfico, lavado de activos, o delitos asociados al turismo sexual  en menores de edad.</li>
  <li>Que en mi (nuestra) contra no se  adelanta ningún proceso en instancias nacionales o internacionales por ninguno de los aspectos anteriores.</li>
  <li>Autorizo a resolver cualquier  acuerdo, beneficio, subsidio, negocio o contrato celebrado con la empresa</li>
  <li>En caso de infracción de cualquiera de los numerales  contenidos en este documento estoy eximiendo  a <strong>Eventour Sport SAS</strong> de toda responsabilidad que se derive por información errónea, falsa o inexacta que yo hubiere proporcionado en este documento, o de la violación de este. </li>
<li>Me comprometo a informar  oportunamente, cualquier cambio de la composición accionaria en caso de ser una  sociedad comercial.</li>
</ol>
<p><strong>DÉCIMA QUINTA. -  CONTROVERSIAS.  </strong>Las diferencias que ocurran entre las partes  con ocasión de la celebración, ejecución, terminación, liquidación e  interpretación del presente contrato serán solucionadas mediante la utilización  de cualquier mecanismo alternativo de solución de controversias.  En primer lugar, se invitará a suscribir un  contrato de transacción, de no llegar a un acuerdo dentro del mes calendario  siguiente, se solucionará mediante la citación a cualquier centro de  conciliación debidamente autorizado en la ciudad de Cali, y de resultar fallida  dicha conciliación se entenderá agotada esta etapa y las partes quedarán en  libertad de acudir a la jurisdicción ordinaria.  </p>
<p><strong>DÉCIMA </strong><strong>SEXTA</strong><strong>. –</strong> <strong>DIRECCIÓN  DE NOTIFICACIONES: </strong>Cualquier solicitud, comunicación, notificación, certificación o  información, que por razón del cumplimiento y/o ejecución del presente contrato  deba una parte enviar a la otra, se entenderá debidamente cumplida y satisfecha  cuando se envíe a los siguientes correos electrónicos. </p>
<div style="font-size: 80%">
  <p align="center"><strong>ANEXO 1.</strong></p>
<p align="center"><strong><u>MANUAL  DE CONDUCTA Y CONVIVENCIA PARA GRUPOS </u></strong></p>
<p>La Ley 300 de 1996 o Ley general del turismo preceptúa que la industria  turística se regirá por los principios allí establecidos; y contiene en el  numeral 8, una prerrogativa en favor del organizador y los operadores  turísticos, que lo autoriza a retirar de un programa de viaje, a quien por  causa grave de carácter moral o disciplinario, debidamente comprobada, atente  contra el éxito del mismo.</p>
<p>Por los derechos que nos concede el Ministerio de Desarrollo y dicha  ley, en calidad de Agentes de Viajes y Operadores de Turismo con <strong>Registro Nacional de Turismo N° 16310,</strong> hemos desarrollado este Manual de Conducta y Convivencia, que regirá para todos  los integrantes o participantes de los grupos que viajan con nuestra empresa,  quienes deberán estar dispuestos a acatarlo y a comportarse de conformidad con  las normas y guías aquí establecidas, las cuales están fundamentadas en las  siguientes situaciones:</p>
<p align="center"><strong>PRECEPTOS  PARA EL COMPORTAMIENTO EN GRUPOS</strong></p>
<strong>1. ALCOHOL, DROGAS, Y  SUSTANCIAS PROHIBIDAS</strong>

  <ol>
    <li>En TODAS las actividades organizadas, promovidas, e incluidas en los  servicios turísticos ofrecidos por nuestra empresa, está claramente prohibida  por la ley, la posesión, distribución, el consumo, o estar bajo la influencia  de drogas ilegales o sustancias ilegales. </li>
    <li>En alto estado de ebriedad no está permitido abordar vuelos comerciales,  ingresar a restaurantes, buses de turismo o participar en algunas de las  actividades organizadas, promovidas o incluidas en los servicios ofrecidos por  nuestra empresa, en las que participan los integrantes del grupo, otros  viajeros o huéspedes. </li>
    <li>No está permitido fumar o consumir bebidas alcohólicas a bordo de vuelos  comerciales, en aeropuertos y algunas secciones de los hoteles como  restaurantes, buses de turismo, o en algunas de las actividades organizadas.</li>
  </ol>
<p>
<strong>2. POLITICA DE MANEJO  DE INTIMIDACION Y CONFLICTOS</strong></p>
<p>Las agresiones físicas o verbales son conductas que violan la dignidad  de las personas y serán inaceptables los siguientes comportamientos: </p>

  <ol>
    <li>Conductas que violen la dignidad personal o creen un ambiente  intimidatorio, degradante, u hostil, incluyendo contacto físico no deseado,  pegar, pelear o, bromas inapropiadas.</li>
    <li>Comunicación inapropiada (verbal, gestual o escrita) incluyendo  insultos, ofensas y vocabulario soez.</li>
    <li>Atentar, mover, o deteriorar los bienes inmuebles y equipos de servicios  de los aviones, aeropuertos, hoteles, autobuses y otros medios de transportes  turísticos.</li>
  </ol>
<p>
<strong>3. LA MANILLA DE  SEGURIDAD</strong></p>
<p>A  partir del momento en que nuestro personal asigne a cada viajero esta manilla  en el aeropuerto, antes de la salida, el viajero debe tener en cuenta,  que su uso, es estrictamente obligatorio y  bajo los siguientes parámetros: </p>
<ol>
  
    <li>No puede ser removida, antes de su regreso a la ciudad de  origen.</li>
    <li>Para quitársela debe ser cortada por uno de nuestros  funcionarios</li>
    <li>Retirar su manilla cortándola de manera inconsulta y por su propia  voluntad. </li>
    <li>Halar una de las partes  de la  manilla de un compañero del grupo, para   producir daño físico a otro integrante del grupo o para deteriorar su  manilla. </li>
    <li>El estudiante que retire o pierda su manilla debe pagar un costo de US20  por su reposición. </li>
</ol>

<p><strong>4. ASISTENCIA Y  PUNTUALIDAD</strong></p>
<p>La asistencia y puntualidad para presentarse en aeropuertos, hoteles y  tours es esencial para la seguridad y disfrute de los servicios adquiridos.  Deben presentarse 10 minutos antes en el lugar acordado, para la salida. Se han  establecido penalidades sin derecho a devoluciones en servicios por  inasistencias no justificadas. </p>
<strong>5. PERTENENCIAS  PERSONALES Y CAJILLAS DE SEGURIDAD</strong>
<p>Todos los hoteles cuentan con cajillas de seguridad en todas las  habitaciones, dentro de las  cuales deben  permanecer todos los objetos valiosos personales. Ningún Hotel y/o operadores  de servicios turísticos se hacen responsables por sumas de dinero, documentos  personales, pasaportes, joyas, teléfonos inteligentes u otros artículos de  valor, dejados fuera de las mismas o en otras instalaciones, por los huéspedes. </p>
<p>6.<strong>PRESENTACION  PERSONAL Y USO DE EQUIPOS DE SEGURIDAD</strong></p>
<p>Cumplir con el protocolo de vestimenta presentado por el Hotel o  establecimientos visitados, regla que debe cumplirse para evitarse  incomodidades de última hora.</p>
<p><strong>7.NORMAS Y POLITICAS  DE AEROPUERTOS, AEROLINEAS Y HOTELES</strong></p>

  <ol>
    <li>Los viajeros deben seguir reglas de seguridad e higiene en todas las actividades. Usar los equipos adecuados para ello, en la práctica de algunos deportes o actividades.</li>
    <li>Todos los miembros de los grupos de jóvenes deben seguir las normas de seguridad y políticas de uso, establecidas por cada empresa operadora de servicios turísticos del país o países, visitados en este programa de viaje.</li>
   
  </ol>

	<p> <strong>8. CONDUCTA EN EL  TRASLADO EN LOS AUTOBUSES A AEROPUERTOS, HOTELES Y TOUR</strong></p>
     <ol>
  
    <li>Durante el recorrido, todos los viajeros tienen la obligación de  permanecer sentados para su seguridad y protección.</li></ol>

 <p> <strong>9.NORMAS EN LA ZONAS  DE PLAYA, PISCINAS, RECREATIVAS Y DEPORTIVAS</strong></p>

  
  <ol>
    <li>Por ningún motivo se permiten personas en alto estado de embriaguez y  juegos o bromas que atenten contra la integridad física en dichas zonas. Su  horario está determinado por las políticas de seguridad del hotel que les serán  informadas al ingreso al mismo. </li>
    <li>Los viajeros deben hacer buen uso de los equipos e implementos  deportivos ubicados en las  instalaciones  como Gimnasios, Spas, Playas, Canchas deportivas, como en las diferentes  actividades recreativas, solamente acompañado de instructores, recreacionistas  y personal de seguridad dispuesto para estas.</li>
  </ol>

<p>De presentarse algunas de las sitaciones mencionadas que violen contra  las normas establecidas, apelaremos a:</p>
<p><strong><em><u>PRIMER LLAMADO</u></em></strong><br>
Exigiremos: Restaurar las relaciones que hayan sido afectadas a través  de actos de reparación y reconciliación. Al igual que restaurar  los daños materiales causados a las instalaciones físicas de proveedores de  servicios turísticos, causados por estos actos en concordancia con las  políticas de cada una de las partes involucradas.</p>
<p><strong><em><u>SEGUNDO LLAMADO</u></em></strong><br>
Suspensión de las actividad y de bebidas alcohólicas en todas las áreas  del hotel, discotecas, tours y lugares de visitas turísticas.</p>
<p><strong><em><u>TERCER LLAMADO</u></em></strong><br>
Retirar del tour o grupo de viaje, a quien por causa grave de carácter  moral o disciplinario debidamente comprobada, atente contra las normas aquí  establecidas el éxito del mismo, sin derecho a reembolso de sus servicios de  acuerdo con las Políticas de Reembolso establecidas en la Cláusula Número 5 de  las <strong><em>CLAUSULAS  DE RESPONSABILIDAD</em></strong> incluidas en el PROGRAMA DE VIAJE.</p></div><?php if($multicausa){?><?php } ?>
	<!--<br pagebreak="true"/>--><p>El presente contrato se firma a los <strong><?php echo strftime("%d",strtotime($cliente['fregistro']));?></strong> dias del mes de <?php echo strftime("%B",strtotime($cliente['fregistro']));?> del año <?php echo strftime("%Y",strtotime($cliente['fregistro']));?>.</p>
<?php if($_GET['txt']!=1){?>
<p><img src="https://eventoursport.travel/crm/imagenes/firma.jpg"  alt="" width="350"/></p><?php } ?>
<p>FIRMA REPRESENTANTE LEGAL <br>
<strong>RICARDO LUNA RIVERA - CC. 16.820.099<br>
EVENTOUR SPORT SAS</strong></p>
<?php if(false){ 
	//if($_GET['txt']!=1){?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br>
  <strong>FIRMA RESPONSABLE <br>
</strong><strong><?php echo strtoupper($cliente['acudiente1_nombre']." ".$cliente['acudiente1_apellido']);?> </strong> -  <?php echo strtoupper($cliente['acudiente1_tipodoc']);?> <strong>No. <?php echo strtoupper($cliente['acudiente1_documento']);?></strong> <br></p>
<?php } ?>

</body>
</html>