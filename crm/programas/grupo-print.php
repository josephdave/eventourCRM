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
<h1 style=" <?php if($_GET['txt']==1){echo 'font-size:20px;';}?>text-align:center;"><strong>CONTRATO DE PRESTACION DE  SERVICIOS TURISTICOS</strong></span></h1>

<p>Entre los suscritos a saber VICTORIA EUGENIA  LUNA RIVERA, mayor de edad y vecina del Municipio de Cali identificada con  cédula de ciudadanía No. 31.291.918 expedida en Cali, quien obra en  Representación de EVENTOUR SPORT S.A.S. por una parte y quien en adelante se  denominará <strong>EVENTOUR SPORT S.A.S </strong>y<strong> </strong><strong><?php echo strtoupper($cliente['acudiente1_nombre']." ".$cliente['acudiente1_apellido']);?></strong> mayor de edad  de esta vecindad identificada con cédula de ciudadanía <?php echo strtoupper($cliente['acudiente1_tipodoc']);?>, <strong>No. <?php echo strtoupper($cliente['acudiente1_documento']);?></strong>, por la otra parte, obrando en nombre de <strong><?php echo strtoupper($cliente['nombres']." ".$cliente['apellidos']);?>,</strong> en calidad de acudiente quien para los efectos de este  convenio se denominará <strong>EL CLIENTE</strong>, se ha celebrado el presente Contrato  Individual de Prestación de Servicios Turísticos que se regirá  por la Ley del Turismo  y sus disposiciones Complementarias, Ley 300  de 1996, Ley 679 de 2001, Ley 1336 de 2009, Decreto 053 de 2002, las leyes  civiles y comerciales colombianas y en especial por las siguientes  consideraciones y cláusulas:</p>
<p align="center"><strong>CONSIDERACIONES </strong></p>
<p>Declara <strong>EVENTOUR SPORT SAS </strong> por conducto de su representante legal:</p>
<ul>
  <li>Que es una persona jurídica debidamente  constituida conforme a las Leyes de Colombia y tiene su domicilio en Cali.  </li>
  <li>Que es una Agencia de Viajes y turismo y miembro de la  Asociación Colombiana de Agencia de Viajes ANATO. </li>
  <li>Que se encuentra inscrita como agencia de  Viajes y Turismo con Registro Nacional del Turismo con el No. 16310</li>
  <li>Que su Representante Legal cuenta con todas  las facultades para obligarse en los términos del presente contrato. Dichas  facultades no le han sido limitadas, modificadas o revocadas en ninguna forma.</li>
  <li>Que dentro de su objeto social y actividad  económica se encuentra facultada para la promoción,  organización y realización de planes de viaje por vía aérea, terrestre,  marítima o submarina, a lugares situados dentro del territorio nacional o del  exterior.</li>
  <li>Que es su deseo celebrar con <strong>EL CLIENTE</strong> el presente contrato de  prestación de servicios turísticos de conformidad con las cláusulas que más  adelante se enuncian.</li>
</ul>
<p><strong>EL CLIENTE</strong> declara que es su deseo e intención contratar los  servicios que presta <strong>EVENTOUR SPORT SAS. </strong>y celebra por su decisión el presente contrato: por lo tanto queda obligado  en todos y cada uno de los términos y condiciones establecidos en éste para el  grupo de viaje denominado PROGRAMA <?php echo $producto['grupo']?></p>
<p>Siendo así, a su vez declara:</p>
<p>Que cuenta con la capacidad legal suficiente para obligarse en los  términos del presente contrato, a efecto de adquirir los servicios turísticos  prestados por <strong>EVENTOUR SPORT SAS.,</strong> en  sus términos y condiciones.<br>
Que los datos que presenta son verdaderos.</p>
<p><strong>CLÁUSULAS </strong></p>
<p><strong>PRIMERA.- </strong>A través del presente contrato <strong>EVENTOUR SPORT SAS </strong>se obliga a prestar AL CLIENTE, los servicios  turísticos contenidos en la oferta  mercantil con destino a <strong><?php echo $producto['destino'];?></strong>.  Los siguientes servicios incluidos en el programa:</p>
	
	
	<?php echo str_replace("<div>&nbsp;</div>","",str_replace("<p>&nbsp;</p>","",$producto['incluye']));?>
<p align="center" style="text-align:center">Para mayor infomación remitirse al  programa digital:<br>
(<a href="https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $plan ?>" target="_blank">https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $plan ?></a>)</p>
<br>
<p><strong><u>SEGUNDA.</u></strong><strong>- </strong>SERVICIOS NO INCLUIDOS- <strong>EVENTOUR SPORT</strong> se obliga a prestar única y exclusivamente los  servicios contemplados en el programa. La propuesta no incluye: Servicio de  lavandería, llamadas de larga distancia. Ni gastos no especificados en el  contrato.<br>
<strong>PARAGRAFO 1ro: </strong>ACOMODACION- La acomodación será de acuerdo  con lo descrito en el programa. Cuando ésta sea diferente a lo establecido en  el programa, <strong>EL CLIENTE</strong>, deberá  asumir el sobrecosto que esa acomodación genere.</p>
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
    <?php if ($producto['nombre_tarifa2'] != '' ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa2']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa3'] != '' ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa3']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa4'] != ''){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa4']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa5'] != '' ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa5']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa6'] != '' ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa6']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa7'] != ''){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa7']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa8'] != '' ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa8']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa9'] != '' ){?>
    <th valign="top"><p align="center"><strong><?php echo  $moneda." ".$producto['nombre_tarifa9']; ?></strong></p></th>
    <?php } ?>
    <?php if ($producto['nombre_tarifa10'] != '' ){?>
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
<table  border="1" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC" style="font-size:80%"> <tr><td ><strong>CUOTA NO</strong></td><td><strong>FECHA LIMITE</strong></td><td><strong>AEREA</strong></td><td><strong>TERRESTRE</strong></td>     </tr>  <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado5=$control->consultaCalendarioPagos($plan);
							while ($fi5 = mysql_fetch_array($resultado5, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo "CUOTA ".$fi5['id'];?></td>
        <td><?php echo $fi5['fecha'];?></td>
        <?php if($fi5['aerea']<=1 && $fi5['aerea'] != 0){?>
		<td><?php echo " ".($fi5['aerea']*100)."%";?></td>
		<?php }else if($fi5['aerea'] == 0){?>
        <td>0</td>
		<?php }else{?>
        <td><?php echo $producto['MONEDA']." ".$fi5['aerea'];?></td>
        <?php } ?>
        <?php if($fi5['terrestre']<=1 && $fi5['terrestre']!=0){?>
		<td><?php echo " ".($fi5['terrestre']*100)."%";?></td>
        <?php }else if($fi5['terrestre'] == 0){?>
        <td>0</td>
		<?php }else{?>
        <td><?php echo $producto['MONEDA']." ".$fi5['terrestre'];?></td>
        <?php } ?>
      </tr>
<?php } ?> </table>
<p><strong>PARAGRAFO 1ro: </strong>Este precio se sostendrá si el depósito  inicial se realiza hasta la fecha limite pactada como cuota primera y con el  contrato debidamente firmado. En caso de no darse estas condiciones, <strong>EL CLIENTE </strong>queda sujeto a disponibilidad  de tarifa aérea, y hotelera.<br>
<strong>PARAGRAFO 2do: </strong>El primer depósito se abonará al precio total  pactado en la presente cláusula. Esta suma será asumida por concepto de  depósito y será tomada como garantía para la reserva de los cupos aéreos y  hoteleros. Estos depósitos no serán reembolsables, ni endosables, ni  transferibles.<br>
<strong>PARAGRAFO 3ro: </strong>El pago del plan turístico deberá ser aportado  de acuerdo con las formas de pago indicadas en el presente contrato, en las fechas establecidas. En caso de incumplir con el pago, el viajero correrá el riesgo de perder  sus cupos aéreos y hoteleros. En caso de que <strong>EL CLIENTE</strong> pierda su reserva,   solo podrá reintegrarse al viaje siempre y cuando <strong>EVENTOUR SPORT</strong> logré conseguir nuevamente el cupo tanto aéreo como  hotelero, caso en el cual deberá <strong>EL  CLIENTE</strong> asumir el sobrecosto de la diferencia en la tarifa aérea y/o la  acomodación en el hotel que se genere en razón de su incumplimiento.</p>
<p><strong><u>CUARTA</u></strong><strong>.</strong>- <strong>DERECHO  DE RETRACTO. EL CLIENTE </strong>tendrán cinco (5) días hábiles contados a partir de  la celebración del presente contrato y/o pago de la primera cuota para ejercer  el derecho de retracto de que trata el artículo 47 de la Ley 1480 de 2011, caso  en el cual se resolverá el presente contrato y <strong>EVENTOUR SPORT </strong>deberá reintegrar el 100% del dinero que <strong>EL CLIENTE </strong>hubiese pagado. La  devolución del dinero pagado no podrá exceder de treinta (30) días calendario  desde el momento en que ejerció el derecho de retracto.</p>
<p><u><strong>QUINTA</strong></u><strong>. </strong>- COMPROMISOS DE EVENTOUR SPORT</p>
<ul>
  <li><strong>EVENTOUR SPORT, </strong>deberá pagar y reservar por los tiquetes de  ida y regreso, Hotel seleccionado para el grupo y todos los proveedores que se  requieren para que las actividades, diurnas y nocturnas, ofrecidas sean  realizadas de manera exitosa.</li>
  <li><strong>EVENTOUR SPORT </strong>enviará vía correo electrónico, ocho (08) días  previos al viaje, un Boletín de salida con la siguiente información: aerolínea  e itinerario de vuelo, documentos necesarios para ingresar al país,  identificación de acompañante, programación de actividades en destino, manual  de convivencia y conducta.</li>
  <li><strong>EVENTOUR SPORT </strong>realizará todas las reuniones relativas a la  excursión que <strong>EL CLIENTE</strong> requiera de  manera individual o grupal.</li>
  <li><strong>EVENTOUR SPORT </strong>enviará BOLETINES INFORMATIVOS que considere  de importancia, antes, durante y después del viaje.</li>
  <li><strong>EVENTOUR SPORT </strong>deberá mantener canales de comunicación  idóneos que le permita a EL CLIENTE mantenerse informado sobre el desarrollo  del programa del viaje, siempre y cuando las condiciones técnicas y/o  geográficas y/o de otro tipo se lo permitan.</li>
  <li><strong>EVENTOUR SPORT </strong>no permitirá el ingreso  al programa de viaje a personas que no hayan  contratado servicios con <strong>EVENTOUR SPORT</strong></li>
  <li><strong>EVENTOUR SPORT </strong>apoyará a todos sus viajeros en caso de  calamidad, accidente, enfermedad, desastre o siniestro.</li>
  <li><strong>EVENTOUR SPORT </strong>asignará para el acompañamiento del grupo, un  funcionario adulto por cada 20 viajeros, durante todo el viaje, es decir, desde  la salida de la ciudad de origen y hasta el regreso.</li>
  <li><strong> EVENTOUR SPORT </strong>asignará un funcionario de su planta, para coordinar con el  departamento de grupos del hotel, la asistencia y respuesta a los  requerimientos del grupo durante su permanencia en el hotel.</li>
  <li><strong>EVENTOUR SPORT </strong>debe cumplir y prestar a cabalidad todos los  servicios ofrecidos al grupo y detallados anteriormente en el Programa.</li>
  <li><strong>EVENTOUR SPORT </strong>está en la obligación de informar a los  pasajeros de los requisitos exigidos por las autoridades en cada destino, como  vacunas, documentación personal necesaria para el desplazamiento en destinos  nacionales e internacionales, sin embargo declinamos toda responsabilidad en  caso de que las autoridades del país o países visitados, nieguen al pasajero el  ingreso al mismo, evento en el cual el pasajero no tendrá derecho al reintegro  del valor de los servicios no utilizados. </li>
  <li><strong>EVENTOUR SPORT</strong> brindará de  manera individual a <strong>EL CLIENTE</strong> la  cobertura de servicios médicos prestados por <strong>LA COMPAÑIA DE ASISTENCIA MEDICA </strong>seleccionada para el programa y detallados, durante todos  los días que el  programa de viaje dure.</li>
</ul>
<p><u><strong>SEXTA</strong>.</u>- COMPROMISOS DEL CLIENTE </p>
<ul>
  <li>Aportar  a EVENTOUR SPORT la información y  documentación del viajero que les sea expresamente requerida. </li>
  <li>Pagar  a EVENTOUR SPORT, el paquete turístico  completo, descrito en el programa. (No se acepta el pago de únicamente Porción  Terrestre o solo Tiquete)</li>
  <li>EL CLIENTE debe reservar, confirmar, y pagar la cuota  establecida en el calendario de pagos. Se  sujetará a las condiciones y restricciones descritas en la CLAUSULA TERCERA del  presente contrato. </li>
  <li>Asistir  a todas las reuniones informativas que, para asegurar el éxito del viaje  programe EVENTOUR SPORT.</li>
  <li>El viajero debe cumplir con todas las  normas  descritas en el MANUAL DE  CONVIVENCIA Y CONDUCTA<strong> (VER ANEXO 1)</strong></li>

  <li>El  viajero no está autorizado para alquilar motos acuáticas, ni terrestres ni  ningún tipo de vehículo. </li>
  <li>Acatar  y cumplir las normas de la legislación del país visitado que sean impartidas  por las autoridades de policía y/o las autoridades competentes en los  diferentes lugares del país. </li>
  <li>Hacerse  responsables por los perjuicios que por culpa del viajero se causen a EVENTOUR SPORT  y/o diferentes proveedores turísticos, en razón a la inobservancia del código  de conducta del usuario. </li>
  <li>Informar  a EVENTOUR SPORT si el viajero padece algún tipo de condicion media preexistente, especial o  de alimentación. EVENTOUR SPORT no se hace responsable en caso de que los datos  suministrados no sean actuales y/o veraces y queda exonerado de cualquier tipo  de responsabilidad que se derive por los perjuicios que en virtud de esa  información se causen al viajero. </li>
  <li>Cumplir  con los requisitos migratorios que exigen los gobiernos de Colombia y el pais destino al  momento del viaje. </li>
  <li>El  viajero es responsable de presentar todos los documentos requeridos para salir  del país. En caso de ser menor de 18 años, deberán presentar el día de la  salida ante la Unidad Administrativa Especial de Migración Colombia, un permiso  original de salida del país de los padres, autenticado ante notario público y su  registro civil de nacimiento original, reciente y en buen estado. </li>
  <li>El Pasajero es responsable del equipaje y  demás pertenecías personales que lleve consigo y <strong>EVENTOUR SPORT, </strong>no se hará responsable en caso de pérdida de los  mismos.</li>
  <li>Es compromiso del viajero enviar copia  escaneada de la documentación necesaria para salir del país.  <strong>EVENTOUR  SPORT</strong> se hace responsable de revisarlos hasta máximo 30 días antes del  viaje, exceptuando casos especiales, donde el viajero este sujeto a entrega de  cedula o contraseña días antes de viajar. </li>
</ul>
<p><u><strong>SEPTIMA</strong></u>.- COMPROMISOS DEL GRUPO</p>
<ul>
  <li>El GRUPO <strong>debe  estar integrado por una cantidad</strong> mínima de 20 pasajeros <strong>o más personas viajando juntas, en la misma  ruta, fechas y vuelos. </strong></li>
  <li>No se considerará <strong>GRUPO </strong>y no gozará de los beneficios de <strong>GRUPO</strong>, la cantidad de viajeros que no cumpla con estos requisitos.<strong></strong></li>
  <li><strong>EL GRUPO</strong> debe suministrar a <strong>EVENTOUR SPORT</strong> el listado oficial de los viajeros potenciales que  puedan participar del viaje. Cualquier persona que no pertenezca a dicho  comunicado deber ser consultado ante el comité de padres de familia. </li>
  <li>Suministrar a <strong>EVENTOUR SPORT</strong>, mínimo cuarenta y cinco (45) días antes del viaje,  los datos de la (s) persona (s) que será (n) el (los) Tour Conductor o en su  defecto, forma en que el (los) Tour Conductor serán utilizados por parte del  grupo.<strong></strong></li>
  <li>Enviar a <strong>EVENTOUR  SPORT</strong> mínimo cuarenta y cinco días (45) antes del viaje, el listado con la  acomodación del grupo, por habitaciones según el archivo que <strong>EVENTOUR SPORT</strong> le suministre a <strong>EL GRUPO.</strong></li>
  <li>En caso de que un grupo de viajeros o la totalidad  del grupo decida incluir una actividad distinta a las descritas en el PROGRAMA,  y adicionar el costo de dicha actividad al precio de venta, <strong>EL GRUPO</strong> deberá enviar un listado vía  correo electrónico, informando a <strong>EVENTOUR  SPORT </strong>las personas a las cuales se les deberá cargar el valor extra.</li>
  <li>Los viajeros que durante el viaje decidan tomar actividades adicionales que no esten descritas  en el programa tendran un costo adicional, y su pago deberá ser realizado en dolares en efectivo.</li>
</ul>
<p><u><strong>OCTAVA</strong>.</u>- CAMBIOS, CANCELACIONES Y REEMBOLSOS:</p>
<p>Una vez abonada una o cualquier cantidad de cuotas del plan establecido, los valores no serán reembolsables, salvo en  aquellos casos de fuerza mayor o caso fortuito entiendase como: circunstancia que, por no poder ser prevista o evitada, imposibilita absolutamente al cumplimiento de dicha obligación, <strong>EVENTOUR SPORT</strong> realizará un  análisis previo de la procedencia de la  solicitud. Toda solicitud de devolución debe realizarse mediante comunicación escrita  del titular de la factura, dirigida a EVENTOUR SPORT al correo info@eventours.travel, explicando los motivos que inducen a la cancelación, adjuntando los  documentos que la sustenten. En caso de que haya lugar a algún tipo de  devolución de dinero, se realizará, en el momento en el que la aerolínea, el hotel  y/o los demás proveedores se pronuncien sobre el particular. El valor que se ha  de reembolsar por concepto de servicios incluidos en el plan y no utilizados,  está sujeto a la aplicación de los descuentos por penalidades, por gastos  administrativos o por cobros de no show de acuerdo con las condiciones  particulares de cancelación de cada aerolínea, hotel u operador, según sean  aplicables.</p>
<p>En caso de  reembolso, cumpliendo con el contenido del Decreto 2438 de 2010, las partes  acuerdan que la suma del<strong> 20% </strong>del  total del valor del programa, <strong>no será  reembolsable</strong>, ni transferible, ni endosable, <strong>en ningún caso</strong>, ya que será abonado a gastos administrativos,  financieros y de reservas aéreas y hoteleras.</p>
<p>En caso de  cancelación: </p>
<ul>
<li>30 días antes del viaje no  hay lugar a reembolso.</li>
<li>60 días antes del viaje,  reembolsable hasta 50% del valor total del programa.</li>
<li>90 días antes del viaje,  reembolsable hasta 80% del valor total del programa.</li>
</ul>	
<?php if($multicausa){?>
	<ul>
<li>En caso de no aplicar a reembolso, <strong>EVENTOUR SPORT</strong>, incluye en este  programa un <strong>Seguro de Cancelación  Multicausa </strong>que hace parte de las coberturas del Seguro de viaje <strong>APRIL  Travel Assistance, </strong>que reconocerá al asegurado hasta el  límite contratad=o y de acuerdo con las 14 causales cubiertas por el seguro. El  viajero podrá consultar las 14 causales que cubren el reembolso de los  servicios terrestres de este programa y sus condiciones, en la sección de  Seguro de Asistencia.<br>
    <br>
    <strong>    CANCELACION DE VIAJE MULTICAUSA 2.000 USD:</strong><br>
  <ol>
    <li>Fallecimiento del asegurado.  - Aplica para el beneficiaro 100% - No aplica  preexistencias</li>
    <li>Incapacidad total o temporal por enfermedad o  accidente del beneficiario -<strong> Aplica para el beneficiaro 90% - Evento producido  30 dias antes del inicio de viaje.</strong></li>
    <li>Fallecimiento o incapacidad total temporal o  incapacidad total de familiar (Primer y segundo grado) - <strong>Aplica para el  beneficiaro 90%</strong></li>
    <li>Desastres naturales - <strong>Aplica para el beneficiaro  90%</strong></li>
    <li>Haber sido designado jurado de votación o haber  sido citado a un juzgado -<strong> Aplica para el beneficiaro 90%</strong></li>
    <li>Requerimiento legal antes del inicio del viaje -  <strong>Aplica para el beneficiaro 90%</strong></li>
    <li>Pérdida de pasaporte que imposibiliten viajar a  beneficiario y/o acompañante -<strong> Aplica perdida 8 días antes del inicio de viaje</strong></li>
    <li>Afectación de la vivienda o empresa del  asegurado -<strong> Aplica para el beneficiaro 90%</strong></li>
    <li>Cancelación de boda de (los) asegurado(s) -<strong> Aplica para el beneficiaro 90%</strong></li>
    <li>Despido laboral del asegurado - <strong>Aplica para el  beneficiaro 90% - Evento producido 30 dias antes del inicio de viaje</strong>.</li>
    <li>Cambio de trabajo del asegurado -<strong> Aplica para el  beneficiaro 90%</strong></li>
    <li>Atención de emergencia por parte de la asegurada  o de la conyugue -<strong> Aplica para el beneficiaro 90%</strong></li>
    <li>incapacidad total, temporal o permanente por  accidente o enfermedad de uno de los acompañantes de viaje <strong>-Aplica para el  beneficiaro 90%</strong></li>
    <li>Secuestro del asegurado o familiar - <strong>Aplica para  el beneficiaro 90% - Evento producido 30 dias antes del inicio de viaje</strong>.<br>
    </li>
  </ol>
  <br>
      *Exclusiones detalladas en el <strong>(ANEXO 2)</strong> del presente contrato
</ul>
	<?php }?>
<ul>
  <li>En caso de no haber lugar al  reembolso, el viajero podrá ceder o traspasar la parte correspondiente a otro  usuario, siempre y cuando no se encuentre en la lista de inscritos del programa  de viaje, ni haya efectuado ningún pago. Si el tiquete aun no está emitido, <strong>EL CLIENTE</strong> deberá asumir la suma de  US75 de penalidad por cambio de nombre del titular. Una vez emitido el tiquete aéreo,  deberá asumir el monto pactado por la aerolínea. </li>
</ul>
<ul>
  <li><strong>EVENTOUR SPORT </strong>se reservará el derecho de cancelar el viaje,  en caso de que no se reúna el número mínimo de usuarios previsto en el presente  contrato para que se configure un grupo. En ese caso, <strong>EVENTOUR SPORT </strong>reembolsará íntegramente lo que haya recibido de <strong>EL CLIENTE. </strong></li>
  <li><strong>EVENTOUR SPORT </strong>tiene la facultad de retirar del viaje a quien  por falta grave de carácter moral y/o disciplinario, atente contra la seguridad  y/o tranquilidad del viaje<strong>, sin derecho  a reembolso</strong>, debiendo abandonar el destino según el caso. <strong>EL CLIENTE</strong> debe asumir los costos  adicionales que se deriven por la causa de su conducta, como se especifica en el MANUAL DE CONDUCTA Y CONVIVENCIA del<strong> ANEXO 1</strong> del presente contrato. </li>
  <li><strong>EVENTOUR SPORT </strong>y/o los operadores turísticos,  no se hacen responsables frente a la contravención de normas, leyes y/o asuntos  legales u otros inconvenientes, en que pueda verse involucrado el viajero en  otro país, casos en que el viajero será obligado a retirarse del programa de  viaje por tales motivos, y no le serán reembolsados los servicios no tomados.</li>
</ul>
<ul>
  <li>El viajero que se vea  obligado a retirarse del viaje, por motivos personales no tendrá derecho al  reintegro de los servicios no tomados, ocasionando un cobro de no show de  acuerdo a las condiciones de la aerolínea y las condiciones de cada hotel y/o  operador. <strong>EL CLIENTE</strong> debe asumir los  costos en penalidades por cambios de vuelo en caso de modificación en su fecha  de regreso.  </li>
  <li><strong>De los tiquetes Aéreos:</strong> los tiquetes  con tarifas de Grupo <u>no son reembolsables</u>. En caso de no viajar y  haberlo pagado en su totalidad, pueden ser utilizados a nombre del titular,  para futuros viajes en rutas internacionales, de la misma aerolínea, con una  vigencia máxima de 1 año, previo pago de la penalidad por cambio fecha de  viaje, más el costo de la tasa administrativa y de la diferencia de tarifa, a  que hubiese lugar. </li>
</ul>
<ul>
  <li>El porcentaje permitido de cambios en grupos  antes de la emisión en las fechas de ida y vuelta será del 20% del total del  grupo, autorización que estará sujeta a la disponibilidad de cupo<u> manteniendo un rango máximo de 3 días a la fecha en común con el grup</u>o y <u>solo  en la salida o en el regreso</u>. Todo cambio antes de la emisión estará sujeto  a la disponibilidad de cupo en la clase correspondiente y a re cotización de la  tarifa.</li>
</ul>
<ul>
  <li>Después de emitidos los tiquetes, los cambios  de nombre podrán conservar la tarifa del grupo, si y sólo si se mantienen los  itinerarios originales.  Estos cambios  están sujetos al pago de penalidades correspondientes.</li>
</ul>
<ul>
  <li>Después de emitidos los tiquetes, los cambios  de ruta, vuelos o fechas deberán manejarse por medio de la reexpedición de los  boletos (tiquetes) tomando como base las tarifas publicadas de pasajeros  individuales vigentes para ese itinerario. Estos cambios están sujetos al pago de penalidades  correspondientes.</li>
</ul>

<p><strong><u>NOVENA</u></strong><strong>.- CESION DE DERECHOS:</strong></p>
<p><strong>EL CLIENTE</strong> autoriza a través del presente contrato a <strong>EVENTOUR SPORT, </strong>a usar la imagen, fotos y testimonios de <strong>EL CLIENTE</strong> con fines de emitir,  publicar, divulgar y promocionar sus planes de viaje y promociones turísticas  en cualquiera de los destinos que desarrollen sus planes de viaje. </p>
<p>Tal utilización  podrá realizarse mediante la divulgación a través de su reproducción, en medios  audiovisuales, a través de los medios existentes, incluidos aquellos de acceso  remoto, conocidos como Internet y redes sociales, para los fines promocionales e  informativos de <strong>EVENTOUR SPORT.</strong></p>
<p><strong>EL CLIENTE</strong> entiende y acepta que no recibirá ningún tipo de compensación,  bonificación o pago de ninguna naturaleza y reconoce además que no existe  ninguna expectativa sobre los eventuales efectos económicos de la divulgación,  sobre el tipo de campaña publicitaria que pueda realizar <strong>EVENTOUR SPORT.</strong></p>
<p>La vigencia de  esta autorización corresponde al término establecido en la ley 23 de 1982,  durante el cual <strong>EVENTOUR SPORT</strong> es  titular de los derechos sobre las piezas a publicar. </p>
<p><strong><u>DECIMA</u></strong><strong>.- CLAUSULAS DE RESPONSABILIDAD:</strong></p>
<ul>
  <li><strong>EVENTOUR SPORT, </strong>con Registro Nacional de Turismo vigente No.  16310, en su calidad de agente de viajes y turismo y sus operadores en el  destino, organizadores de este programa, declaramos explícitamente que actuamos  como intermediarios entre los pasajeros, por una parte, y las entidades  llamadas a proporcionar los servicios descritos en los diferentes itinerarios,  por la otra parte, responsabilizándonos del cumplimiento de los servicios  mencionados en este programa. </li>
  <li><strong>EVENTOUR SPORT </strong>y sus operadores tienen la prerrogativa de  hacer cambios en el itinerario, fecha de viaje, hoteles, transporte y los demás  servicios, por otros de igual o superior categoría, que sean necesarios para  garantizar el éxito de la excursión, en casos particulares en los que, por  causa del hotel y operadores turísticos, se presenten fallas en la prestación  del servicio.</li>
  <li><strong>EVENTOUR SPORT </strong>y sus operadores, declinan toda  responsabilidad y gastos extras por retrasos, huelgas, terremotos, huracanes,  avalanchas o demás causas de fuerza mayor, así como cualquier pérdida, daño,  accidente o irregularidad que pudiera ocurrir a los pasajeros y sus  pertenencias, cuando estos sean motivados por terceros, y por tanto ajenos al  control del Operador y sus afiliados. Igualmente quedamos exentos de cualquier  perjuicio por modificación o retraso en los itinerarios aéreos que se incluyan  en los diferentes programas.</li>
  <li><strong>EVENTOUR SPORT </strong>no asume responsabilidad alguna frente al  usuario o viajero por el servicio de transporte aéreo, salvo que se trate de  vuelos fletados y de acuerdo con lo especificado en el contrato de transporte.  La prestación de tal servicio se rige por las normas legales aplicables al  servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones  imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los  derechos del usuario y los procedimientos para hacer efectivas las devoluciones  de dinero a que estos hechos den lugar, se regirán por las disposiciones  legales pertinentes y en particular por las contenidas en el Reglamento  Aeronáutico Colombiano (RAC). Cuando en razón a la tarifa o por cualquier otro  motivo existan restricciones para efectuar modificaciones a la reserva aérea,  endosos o reembolsos; tales limitaciones deberán ser informadas al usuario.</li>
  <li><strong>EVENTOUR SPORT </strong>y/o la Aerolínea no podrán ser demandados por  retrasos o cancelaciones de vuelos debido a fenómenos de la naturaleza, o a  cualquier otra causa fuera del control nuestro.</li>
  <li><strong>EVENTOUR SPORT </strong>informa que<strong> </strong>tanto las tasas de combustible, aeropuertos e impuestos  gubernamentales pueden sufrir ajustes, antes de la emisión de los tiquetes  electrónicos o de la  utilización del alojamiento en los hoteles. En este caso los viajeros estarán  obligados a cubrir la diferencia que resulte liquidada.</li>
  <li><strong>De los Tiquetes Aéreos: </strong>El valor del tiquete está compuesto por la tarifa aérea y el valor de  los impuestos de Combustible (Q), IVA, tasas de salida de cada territorio,  tasas de aeropuertos, de turismo, Fees administrativos, y algunos otros de  acuerdo a cada país. Estos pueden variar con las legislaciones de esos países  que se visiten, por lo tanto el valor de estos impuestos pueden sufrir  variaciones y sus precios solo se garantizaran con la expedición definitiva de  todos los tiquetes del grupo,  cuya expedición se efectuará en una sola fecha para todos, como lo estipulan las aerolíneas en las tarifas  para grupos. Los tiquetes del grupo solo podrán ser expedidos por <strong>EVENTOUR SPORT </strong>de acuerdo a las  cláusulas del convenio firmado con la aerolínea en el momento de cotizar y  confirmar el grupo.</li>
  <li>Las tarifas de este grupo tienen un precio y  condiciones especiales, por lo tanto no pueden combinarse con otras promociones  o beneficios, tales como tiquetes de millas, etc. y solo podrán ser expedidos  por <strong>EVENTOUR SPORT. </strong></li>
  <li><strong>De la Porción Terrestre:</strong> Todos los servicios incluidos en la Porción Terrestre están tarifados  en dólares porque son proveídos por empresas establecidas en el exterior, pero  como debemos recaudarlos en pesos Colombianos, deben liquidarse a la TRM (tasa  representativa del mercado) del día de su pago. Para efectos legales, las  Agencias de viajes y turismo, estamos obligados a comprar divisas y a pagar  impuestos sobre las mismas, porque debemos pagar servicios a empresas  internacionales, que tienen cuentas de bancos en el exterior. Por esta razón  estamos autorizadas por el gobierno para cobrar un fee bancario del 2%, sobre  el total de los servicios terrestres en dólares.</li>
</ul>
<p><strong>DECIMA PRIMERA.- CESION DEL CONTRATO: </strong>Queda prohibido a <strong>EVENTOUR SPORT </strong>ceder total o  parcialmente la ejecución del presente contrato a un tercero, salvo previa  autorización de <strong>EL CLIENTE. </strong>Igualmente,  queda prohibido a los integrantes de <strong>EL  GRUPO </strong>ceder total o parcialmente los cupos aéreos y hoteleros con los que  cuenta, salvo autorización expresa de <strong>EVENTOUR SPORT</strong>.</p>
<p><strong>DECIMA SEGUNDA.- RESERVA Y CONFIDENCIALIDAD: </strong>Toda la información, que se entreguen las partes, durante la negociación, ejecución  y liquidación del presente contrato  será de carácter confidencial y sólo  podrá ser utilizada para el propósito de establecer, negociar y mantener los  servicios contratados, quedándole prohibido a la parte que recibe la  información compartirla con terceros.</p>
<p><strong>DECIMA TERCERA.- TERMINACION DEL CONTRATO. </strong>El presente  contrato podrá darse por terminado por una de las siguientes causales:</p>
<ul>
	<li>Mutuo acuerdo entre las partes</li>
	<li>Incumplimiento de las obligaciones incluidas en el presente contrato  por las partes.</li>
</ul>
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
    <li>Los viajeros deben seguir reglas de seguridad e higiene en todas las  actividades. Usar los equipos adecuados para ello, en la práctica de algunos  deportes o actividades.</li>
    <li>Todos los miembros de los grupos de jóvenes deben seguir las normas de  seguridad y políticas de uso, establecidas por cada empresa operadora de  servicios turísticos del país o países, visitados en este programa de viaje. </li>
   
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
Retirar del tour o grupo de viaje, a quien por causa grave de carácter  moral o disciplinario debidamente comprobada, atente contra las normas aquí  establecidas el éxito del mismo, sin derecho a reembolso de sus servicios de  acuerdo con las Políticas de Reembolso establecidas en la Cláusula Número 5 de  las <strong><em>CLAUSULAS  DE RESPONSABILIDAD</em></strong> incluidas en el PROGRAMA DE VIAJE.</p>
	
	<?php if($multicausa){?>
<p align="center"><strong>ANEXO 2</strong><br>
<strong>EXCLUSIONES CANCELACIÓN MULTICAUSA - APRIL</strong></p>
 El presente anexo cubre única y exclusivamente las  circunstancias relacionadas de manera expresa y taxativa en la condición Cuarta  (IV), es decir, que los eventos que no se encuentran relacionados, no son  objeto de cobertura por lo tanto, los hechos originados directa o  indirectamente o que se deriven de la siguiente relación no se encuentran  cubiertos por el presente anexo: <br>
<ul>
  <li>V.1. Cualquier evento ocurrido con anterioridad a la emisión  del Plan de Asistencia. </li>
  <li>V.2. Las enfermedades defectos o lesiones derivadas de  padecimientos crónicos o de las padecidas con anterioridad a la compra del  viaje y su seguro, preexistentes y/o congénitas (conocidas o no por el  asegurado).</li>
  <li>V.3. La muerte producida por suicidio y las lesiones y  secuelas que se ocasionen en su tentativa estando el asegurado en uso o no de  sus facultades mentales.</li>
  <li>V.4. La muerte o lesiones originadas directa o  indirectamente por hechos punibles o acciones dolosas del asegurado</li>
  <li>V.5. Los gastos por enfermedad o estado patológico  producidos por la ingestión voluntaria de drogas, sustancias toxicas,  narcóticos o medicamentos adquiridos sin prescripción médica bebidas  embriagantes, drogas alucinógenas, ni por enfermedades mentales.</li>
  <li>V.6. Lo relativo y derivado de prótesis, anteojos y gastos  de asistencia por embarazo ya que son situaciones previas y conocidas por el  asegurado.</li>
  <li>V.7. Los eventos que pueden ocurrir a consecuencia de  entrenamientos, prácticas o participación activa en competencias deportivas  (profesionales o amateurs).</li>
  <li>V.8. Los eventos que puedan ocurrir a consecuencia de  prácticas de deportes peligrosos tales como: motociclismo, automovilismo,  boxeo, polo, sky acuático, aladeltismo, alpinismo, sky. sin embargo, los  eventos de deporte invernales estarán cubiertos siempre que los mismo sucedan  en pistas reglamentarias y autorizadas. </li>
  <li>V.9. Guerra (declarada o no) guerra civil, hechos o  actuaciones de las fuerzas armadas o de hechos de las fuerzas o cuerpos de  seguridad, manifestaciones, insurrecciones, asonadas, motines o tumultos  populares, actos terroristas, amit, rebelión, insurrección, poder usurpado,  huelgas, levantamientos populares o militares, subversión, disturbios  políticos, explosiones y/o la participación del asegurado en los mismos.</li>
  <li>V.10. Actos de la naturaleza de carácter catastrófico  relativo a caída de cuerpos siderales, así como cualquier hecho derivado de  energía nuclear radioactiva.</li>
  <li>V.11. Dolo o culpa grave del asegurado o sus familiares.</li>
  <li>V.12. Si el pasajero asegurado se encuentra sirviendo en  labores militares en las fuerzas armadas o de policía de cualquier país o  autoridad internacional.</li>
  <li>V.13. Hurto simple o hurto calificado en la vivienda y/o  empresa de propiedad del asegurado. </li>
  <li>V.14. Cuando el viaje no se puede hacer o culminar por  decisión de las autoridades migratorias.</li>
  <li>V.15. Devolución al País de origen por motivos delictivo. </li>
  <li>V.16. Errores de Emisión del organismo de viajes. </li>
  <li>V.17. Aplica únicamente para 1 viaje programado, si este se  cancela deberá tomar un nuevo seguro para el nuevo viaje</li>
</ul>
	<?php } ?>
<br pagebreak="true"/> 	
<p>El presente contrato se firma a los <strong><?php echo strftime("%d",strtotime($cliente['fregistro']));?></strong> dias del mes de <?php echo strftime("%B",strtotime($cliente['fregistro']));?> del año <?php echo strftime("%Y",strtotime($cliente['fregistro']));?>.</p>
<?php if($_GET['txt']!=1){?>
<p><img src="https://eventoursport.travel/crm/imagenes/firma.jpg"  alt="" width="350"/></p><?php } ?>
<p>FIRMA REPRESENTANTE LEGAL <br>
<strong>VICTORIA EUGENIA LUNA - CC. 31.291.918<br>
EVENTOUR SPORT</strong></p>
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