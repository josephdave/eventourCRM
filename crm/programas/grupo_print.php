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
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr> <td width="100%"><h1 style="font-size:190%"><?php	$salida = new DateTime($producto['f_salida']);			echo strtoupper( ucwords( $producto['grupo']))." ".$salida->format("Y");?></h1> <h2>Programa  de viaje </h2></td></tr>
</table>    
	  
<div id="featured"><?php if($plan == 133){?>
			  <table width="100%" border="1" cellpadding="0">
			    <tr>
			      <td valign="top"><p><strong>Fecha de Viaje</strong></p></td>
			      <td valign="top"><p align="center"><?php 
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
					$salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
					  $datediff = strtotime($producto['f_llegada'])- strtotime($producto['f_salida']);  $dias= floor($datediff/(60*60*24))+1;
					
					
					echo "".$salida->format("j")." de ".$meses[$salida->format("n")]." de ".$llegada->format("Y")?></p></td>
		 </tr>
				  <tr>
				    <td valign="top"><p><strong>Destino</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $producto['destino']?></p></td>
			      </tr>
				  <tr>
				    <td valign="top"><p><strong>Nombre del Hotel</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $control->nombreHoteles($plan);
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr>
			  </table><?php } else { ?>
			  <table width="100%" border="1" cellpadding="0">
			    <tr>
			      <td valign="top"><p><strong>Fecha de Viaje</strong></p></td>
			      <td valign="top"><p align="center"><?php 
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
					$salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
					  $datediff = strtotime($producto['f_llegada'])- strtotime($producto['f_salida']);  $dias= floor($datediff/(60*60*24))+1;
					
					
					echo "del ".$salida->format("j")." de ".$meses[$salida->format("n")]." al ".$llegada->format("j")." de ".$meses[$llegada->format("n")]." de ".$llegada->format("Y")?></p></td>
		 </tr>
				  <tr>
				    <td valign="top"><p><strong>Destino</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $producto['destino']?></p></td>
			      </tr>
				  <tr>
				    <td valign="top"><p><strong>Tiempo de Estancia</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</p></td>
			      </tr><?php if ($control->nombreHoteles($plan) != ""){?>
				  <tr>
				    <td valign="top"><p><strong>Nombre del Hotel</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $control->nombreHoteles($plan);
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr><?php } ?>
				  <!--<tr>
				    <td valign="top"><p><strong>Valor del Programa</strong></p></td>
				    <td valign="top"><p align="center"><?php $moneda=$producto['MONEDA']; echo $moneda;?> <?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></p></td>
			      </tr>-->
</table><?php } ?>
			  <h3>Información General del Programa			  </h3>
			
<h2>Servicios Incluidos</h2>
			    <?php echo str_replace("<div>&nbsp;</div>","",str_replace("<p>&nbsp;</p>","",$producto['incluye']));?>
						    
<h2>Valor del Programa</h2>
 <?php if($producto['calendario_pagos'] != ""){ ?>
			     <?php echo $producto['calendario_pagos']; ?>
 <?php }else{ ?>
 <div style="text-align:center">
<table border="1" cellpadding="0" width="600" style="font-size:80%">
			          <tr>
			            <th valign="top"><p align="center"><strong>VALOR DEL PLAN POR PERSONA</strong></p></th>
			            <th valign="top"><p align="center"><strong> <?php if ($producto['nombre_tarifa1'] != '' && $producto['nombre_tarifa1'] != 'Programa'){ echo $producto['nombre_tarifa1']; }else{ ?>Valor<?php } ?></strong></p></th>
                        <?php if ($producto['nombre_tarifa2'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa2']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa3'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa3']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa4'] != ''){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa4']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa5'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa5']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa6'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa6']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa7'] != ''){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa7']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa8'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa8']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa9'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa9']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa10'] != '' ){?>
                        <th valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa10']; ?></strong></p></th>
                        <?php } ?>
		              </tr>
			          <tr>
			            <td valign="top"><p><strong>Porción terrestre</strong></p></td>
			            <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre']?> </strong></p></td>
                         <?php if ($producto['nombre_tarifa2'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa2']?> </strong></p></td>                    
                         <?php } ?>
                         
                          <?php if ($producto['nombre_tarifa3'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa3']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa4'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa4']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa5'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa5']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa6'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa6']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa7'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa7']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa8'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa8']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa9'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa9']?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa10'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre_tarifa10']?> </strong></p></td>                    
                         <?php } ?>
		              </tr>
			          <tr>
			            <td valign="top"><p><strong>Tiquete aéreo </strong></p></td>
			            <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo']?> </strong></p></td>
                        <?php if ($producto['nombre_tarifa2'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa2']?> </strong></p></td>
      <?php } ?>   
     
                            <?php if ($producto['nombre_tarifa3'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa3']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa4'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa4']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa5'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa5']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa6'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa6']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa7'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa7']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa8'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa8']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa9'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa9']?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa10'] != ''){?>
        <td valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo_tarifa10']?> </strong></p></td>
                         <?php } ?>
		              </tr>
			          <tr>
			            <td><p><strong>VALOR TOTAL DEL PROGRAMA</strong></p></td>
			            <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></strong></p></td>
                        
                        <?php if ($producto['nombre_tarifa2'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa2']+$producto['valor_terrestre_tarifa2'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa3'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa3']+$producto['valor_terrestre_tarifa3'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa4'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa4']+$producto['valor_terrestre_tarifa4'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa5'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa5']+$producto['valor_terrestre_tarifa5'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa6'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa6']+$producto['valor_terrestre_tarifa6'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa7'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa7']+$producto['valor_terrestre_tarifa7'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa8'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa8']+$producto['valor_terrestre_tarifa8'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa9'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa9']+$producto['valor_terrestre_tarifa9'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa10'] != ''){?>
       <td valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa10']+$producto['valor_terrestre_tarifa10'])?></strong></p></td>                    
                         <?php } ?>
                        
		              </tr>
  </table></div>

		     		   


<h2>Calendario de Pagos</h2>  <div id="accordion-calen" class="accordion-section-content"><table  border="1" cellspacing="0" cellpadding="2" bordercolor="#CCCCCC"> <tr><td ><strong>CUOTA NO</strong></td><td><strong>FECHA LIMITE</strong></td><td><strong>AEREA</strong></td><td><strong>TERRESTRE</strong></td>     </tr>  <?php 
							
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
      <?php } ?> </table>  <?php } ?>
<h2>Itinerario de Vuelos</h2><div style="text-align:center"><?php echo trim($producto['itinerario'])?></div><h2>Documentación de Viaje</h2><?php echo trim(str_replace("<p>&nbsp;</p>","",$producto['documentacion']));?></strong><h3 id="pagos">Formas de Pago</h3><p><strong>Tiquete Aéreo</strong>: el tiquete aéreo al ser emitido en Colombia, se debe pagar en pesos colombianos; en programas internacionales, en los cuales el valor del tiquete es tarifado en dólares, se debe liquidar al valor de la Tasa Representativa del Mercado (TRM) vigente el día del pago.<u></u><u></u></p><p><u></u><u></u><strong>Porción Terrestre</strong>: el valor de los servicios terrestres tarifados en dólares, se puede pagar en pesos colombianos liquidados a la Tasa Representativa del Mercado (TRM) vigente el día de pago o en dólares.</p>
<?php if(strpos($producto['parametros'],'bancolombia') !== false){?>
<strong>Pago Botón PSE BANCOLOMBIA</strong><p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: <br>
  <a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=3617">https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=3617</a></p><?php } ?><?php if(strpos($producto['parametros'],'cbancolombia') !== false){?><strong>Consignacion Bancolombia</strong>
  <p><strong>Numero  de convenio: 56826</strong>  </p>
  <p>El banco le solicitará:  </p>
  <p>1) número de documento<br>2) nombre del Programa<br>3) nombre del viajero.</p>
  <p>Cuenta corriente de Bancolombia  No.060-607958-21 a nombre de EVENTOUR SPORT, NIT 900.199.006-3.</p>
  <p>Enviar soporte de consignación al correo <a href="mailto:info@eventours.travel">info@eventours.travel</a> . Incluir en el asunto del correo, el nombre del viajero  y el grupo al que pertenece.</p>
  <?php } ?> <?php if(strpos($producto['parametros'],'bancobogota') !== false){?><strong>Pago Botón PSE BANCO DE BOGOTA</strong><div id="accordion-pse" class="accordion-section-content"><p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
    <p>  <a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898">https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898</a></p><p align="center"> Si tiene dificultades utilice la siguiente ruta:   </p><p>1. Ingrese a la web del Banco de Bogotá:<a href="https://www.bancodebogota.com/wps/portal/banco-bogota/home#" target="_blank"> https://www.bancodebogota.com/</a><br>2. En el lado derecho haga click en la opción “Portal de Pagos Electrónicos”<br>3. Elija la opción “Establecimientos Comerciales” <br>4.  Posteriormente se despliega un directorio y por la letra E, eligen a<strong> EVENTOUR SPORT</strong></strong></p>
</div></div><?php } ?> <?php if(strpos($producto['parametros'],'transferenciaUSD') !== false){?><strong>Transferencia en Dólares</strong><div id="accordion-transd" class="accordion-section-content"><p>   Puede efectuar una transferencia en dólares a nuestra cuenta en Miami. La información de la cuenta es la siguiente:</p><p><span lang="EN-US">BENEFICIARY:		<strong>EVENTOUR SPORT SAS<u></u><u></u></strong></span><br><span lang="EN-US">BENEFICIARY ADDRESS:   <strong>AV 5C Norte 23DN-35 Cali, Colombia</strong><u></u><u></u></span><br>BANK INFO:   <strong>BANCO DE BOGOTA MIAMI AGENCY</strong><u></u><u></u><br><span lang="EN-US">BANK ADDRESS:  <strong>701 Brickell Avenue, Suite 1450. Miami, Florida 33131</strong><u></u><u></u></span><br>  <span lang="EN-US">ABA:    <strong><a href="tel:(6)%206010720" value="+5766010720" target="_blank">066010720</a><u></u><u></u></strong></span><br>  <span lang="EN-US">SWIFT:     <strong>BBOGUS3M</strong><u></u><u></u></span><br>  <span lang="EN-US">ACCOUNT:  <strong>58784</strong></span><u></u></p></div></div><?php } ?> <?php if(strpos($producto['parametros'],'cbancobogota') !== false){?><div class="accordion-section"><strong>Consignacion Banco de Bogota</strong><div id="accordion-cbancobogota" class="accordion-section-content"><p>Hacer su consignación en cualquier sucursal del Banco de Bogotá en nuestra Cuenta Corriente No. 119 - 1409 - 78 a nombre de EVENTOUR SPORT, NIT 900 199 006 -3</p><p>Enviar soporte de consignación al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a> . Incluir en el asunto del correo, el nombre del viajero y el grupo al que pertenece.</p>  </div></div><?php } ?><?php if(strpos($producto['parametros'],'tarjetacredito') !== false){?><strong>Tarjetas de Crédito</strong><p>Para pago en Tarjeta de Crédito, MODALIDAD NO PRESENCIAL,  descargue nuestro formato en línea, elabórelo a mano y envíe escaneado con  copia de la cédula del tarjetahabiente a <a href="mailto:info@eventours.travel">info@eventours.travel</a> indicando en el  asunto: Nombre del viajero y Programa de Viaje.
</p>
<p>Por favor diligenciar un formato distinto  por cada concepto, o por cada cargo.</p>
<p><strong>IMPORTANTE:</strong></p>
<p>*Tiquete aéreo: Este cargo se hará una  sola vez por el valor completo del tiquete, en la fecha de la emisión del  boleto, un mes antes del viaje (no se aceptan pagos parciales)</p>
<p>*Los valores indicados en dólares serán  cargados a su tarjeta en Pesos Colombianos, liquidados a la TRM vigente. </p>
<?php } ?><?php if(strpos($producto['parametros'],'dolaresefectivo') !== false){?><strong>Dólares en Efectivo</strong>
<p>Consigne los dólares en la Cuenta Corriente No. 072-06972-7, del Banco  ITAÚ. Es requisito del banco llevar la relación de los dólares. Utilice el  formato adjunto para su consignación.<strong> </strong></p>
<p>Importante: Es indispensable que por favor nos remita la copia de la  consignación sellada que le entrega el banco, a nuestro correo <a href="mailto:info@eventours.travel">info@eventours.travel</a> para poder registrar el abono. Favor especificar en el  asunto Nombre Completo del Viajero y grupo, de lo contrario el pago no se vera  reflejado.</p>
<?php } ?><?php if(strpos($producto['parametros'],'proexcursion') !== false){?><strong>Pasaporte Proexcursión</strong>
<p>Es muy frecuente que familiares y allegados al viajero, quieran darle a sus hijos, el regalo ideal con motivo de su grado. ¡<strong>Qué mejor regalo que aportar para este plan de viaje! </strong>Y si además ese aporte les da la posibilidad de ganarse a quien lo hace, un plan de viaje para dos personas, con alojamiento, boletas y traslados, para ver jugar a nuestra selección Colombia en el la <strong>COPA AMERICA – BRASIL 2019 </strong><br>
  <br>
En razón a esto EventourS desarrolló esta propuesta, para estimular a esos seres queridos con a vincularse económicamente a título de donación, pagando $ 75.000 por la compra del <strong>PASAPORTE PROEXCURSION</strong>, de los cuales $ 60.000 ingresarán en su nombre como pago del plan de viaje y $ 15.000 a EventourS, como parte de los gastos administrativos y de servicios de viaje del plan de viaje que será entregado a los eventuales favorecidos en el sorteo.</p>
<p><a href="http://eventoursport.travel/crm/programas/documentos/bono_proexcursion.pdf">Consultar Términos y Condiciones</a></p>
<p>
  <?php } ?>
</p><h3>Términos y condiciones del programa</h3><?php if($producto['terminoscondiciones'] != ""){echo str_replace('<p style="text-align:justify">&nbsp;</p>',"",str_replace("<p>&nbsp;</p>","",$producto['terminoscondiciones'])); }else{?><h2>Compromisos entre Eventour y el grupo</h2><p><strong>Compromisos de EventourS con  el Grupo:</strong></p>
<ul>
  <li>EventourS, deberá pagar y reservar por los  tiquetes de ida y regreso, Hotel seleccionado para el grupo y todos los  proveedores que se requieren para que las actividades, diurnas y nocturnas,  ofrecidas sean realizadas de manera exitosa.</li>
  <li>EventourS enviará vía correo electrónico, ocho  (08) días previos al viaje, un Boletín de salida con la siguiente información:  aerolínea e itinerario de vuelo, documentos necesarios para ingresar al país,  identificación de acompañante, programación de actividades en destino, manual  de convivencia y conducta.</li>
  <li>EventourS realizará todas las reuniones  relativas a la excursión que EL CLIENTE requiera de manera individual o grupal.</li>
  <li>EventourS enviará BOLETINES INFORMATIVOS que  considere de importancia, antes, durante y después del viaje.</li>
  <li>EventourS deberá mantener canales de  comunicación idóneos que le permita a EL CLIENTE mantenerse informado sobre el  desarrollo del programa del viaje, siempre y cuando las condiciones técnicas  y/o geográficas y/o de otro tipo se lo permitan.</li>
  <li>EventourS no permitirá el ingreso a personas  que no hayan contratado servicios con EventourS</li>
  <li>EventourS apoyará a todos sus viajeros en caso  de calamidad, accidente, enfermedad, desastre o siniestro.</li>
  <li>EventourS asignará para el acompañamiento del  grupo, un funcionario adulto desde la salida de Cali y hasta el regreso, por  cada 20 viajeros, durante todo el viaje.</li>
  <li> EventourS asignará un funcionario de su  planta, para coordinar con el departamento de grupos del hotel, la asistencia y  respuesta a los requerimientos del grupo durante su permanencia en el hotel.</li>
  <li>EventourS debe cumplir y prestar a cabalidad  todos los servicios ofrecidos al grupo y detallados anteriormente en el  Programa.</li>
  <li>EventourS está en la obligación de informar a  los pasajeros de los requisitos exigidos por las autoridades en cada destino,  como vacunas, documentación personal necesaria para el desplazamiento en  destinos nacionales e internacionales, sin embargo declinamos toda  responsabilidad en caso de que las autoridades del país o países visitados,  nieguen al pasajero el ingreso al mismo, evento en el cual el pasajero no  tendrá derecho al reintegro del valor de los servicios no utilizados. </li>
  <li>EventourS brindará de manera individual a cada viajero la cobertura de servicios  médicos prestados por APRIL Travel Assistance y detallados en el programa  completo, durante todos  los días que  el progama de viaje dure.</li>
</ul>
<p><strong>Compromisos del Grupo con  EventourS:</strong></p>
<ul>
  <li>El Grupo&nbsp;debe cumplir con todas las normas descritas&nbsp;según el&nbsp;<u>MANUAL&nbsp;DE&nbsp;CONVIVENCIA&nbsp;Y  CONDUCTA<a href="http://eventoursport.travel/documentos/manual_conducta.pdf" target="_blank">&nbsp;(click para descargar)</a></u></li>
  <li>El Grupo debe estar integrado por una cantidad  mínima de 20 pasajeros o más personas viajando juntas, en la misma ruta, fechas  y vuelos. </li>
  <li>No se considerará el Grupo y no gozará de los  beneficios de grupo, la cantidad de viajeros que no cumpla con estos  requisitos.</li>
  <li>El Grupo debe suministrar a EventourS el  listado oficial de los viajeros potenciales que puedan participar del viaje.  Cualquier persona que no pertenezca a dicho comunicado deber ser consultado  ante el comité de padres de familia. </li>
  <li>Suministrar a EventourS, mínimo cuarenta y  cinco (45) días antes del viaje, los datos de la (s) persona (s) que será (n)  el (los) Tour Conductor o en su defecto, forma en que el (los) Tour Conductor  serán utilizados por parte del grupo.</li>
  <li>En caso de que el grupo decida dividir el  valor del Tour Conductor en partes iguales para todos los viajeros, el Grupo  deberá informarlo de manera escrita al correo <a href="mailto:info@eventours.travel">info@eventours.travel</a> y EventourS, reintegrará el dinero equivalente en efectivo en nombre  de un alumno aleatorio que el Grupo le suministre. </li>
  <li>Enviar a EventourS mínimo cuarenta y cinco  días (45) antes del viaje, el listado con la acomodación del grupo, por  habitaciones según el archivo que EventourS le suministre a el Grupo.</li>
  <li>En caso de un grupo de viajeros o la totalidad  del grupo decida incluir una actividad distinta a las descritas en el PROGRAMA,  y adicionar el costo de dicha actividad al precio de venta, el Grupo debe  enviar un listado vía correo electrónico, informando a EventourS las personas a  las cuales se les deberá cargar el valor extra.</li>
</ul>
<p>      <strong>Claúsulas de Responsabilidad y Cancelación</strong></p>
<ol>
	   <li><strong>EVENTOUR SPORT, </strong>con Registro Nacional de Turismo vigente No.  16310, en su calidad de agente de viajes y turismo y sus operadores en el  destino, organizadores de este programa, declaramos explícitamente que actuamos  como intermediarios entre los pasajeros, por una parte, y las entidades  llamadas a proporcionar los servicios descritos en los diferentes itinerarios,  por la otra parte, responsabilizándonos del cumplimiento de los servicios  mencionados en este programa. </li>
       <li><strong>EVENTOUR SPORT </strong>y sus operadores tienen la prerrogativa de  hacer cambios en el itinerario, fecha de viaje, hoteles, transporte y los demás  servicios, por otros de igual o superior categoría, que sean necesarios para  garantizar el éxito de la excursión, en casos particulares en los que, por  causa del hotel y operadores turísticos, se presenten fallas en la prestación  del servicio.</li>
       <li><strong>EVENTOUR SPORT </strong>y sus operadores, declinan toda  responsabilidad y gastos extras por retrasos, huelgas, terremotos, huracanes,  avalanchas o demás causas de fuerza mayor, así como cualquier pérdida, daño,  accidente o irregularidad que pudiera ocurrir a los pasajeros y sus  pertenencias, cuando estos sean motivados por terceros, y por tanto ajenos al  control del Operador y sus afiliados. Igualmente quedamos exentos de cualquier perjuicio  por modificación o retraso en los itinerarios aéreos que se incluyan en los  diferentes programas.</li>
       <li><strong>EVENTOUR SPORT </strong>no asume responsabilidad alguna frente al  usuario o viajero por el servicio de transporte aéreo, salvo que se trate de  vuelos fletados y de acuerdo con lo especificado en el contrato de transporte.  La prestación de tal servicio se rige por las normas legales aplicables al  servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones  imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los  derechos del usuario y los procedimientos para hacer efectivas las devoluciones  de dinero a que estos hechos den lugar, se regirán por las disposiciones  legales pertinentes y en particular por las contenidas en el Reglamento  Aeronáutico Colombiano (RAC). Cuando en razón a la tarifa o por cualquier otro  motivo existan restricciones para efectuar modificaciones a la reserva aérea,  endosos o reembolsos; tales limitaciones deberán ser informadas al usuario.</li>
       <li><strong>EVENTOUR SPORT </strong>y/o la Aerolínea no podrán ser demandados por  retrasos o cancelaciones de vuelos debido a fenómenos de la naturaleza, o a  cualquier otra causa fuera del control nuestro.</li>
       <li>Favor tener en cuenta que tanto las tasas de  combustible, aeropuertos e impuestos gubernamentales pueden sufrir ajustes,  antes de la emisión de los tiquetes  electrónicos o de la  utilización del alojamiento en los hoteles. En este caso los viajeros estarán  obligados a cubrir la diferencia</li>
       <li><strong>De los Tiquetes Aéreos: </strong>El valor del tiquete está compuesto por la tarifa aérea y el valor de  los impuestos de Combustible (Q), IVA, tasas de salida de cada territorio,  tasas de aeropuertos, de turismo, Fees administrativos, y algunos otros de  acuerdo a cada país. Estos pueden variar con las legislaciones de esos países  que se visiten, por lo tanto el valor de estos impuestos pueden sufrir  variaciones y sus precios solo se garantizaran con la expedición definitiva de  todos los tiquetes del grupo,  cuya expedición se efectuará en una sola fecha para todos, como lo estipulan las aerolíneas en las tarifas  para grupos. Los tiquetes del grupo solo podrán ser expedidos por <strong>EVENTOUR SPORT </strong>de acuerdo a las  cláusulas del convenio firmado con la aerolínea en el momento de cotizar y  confirmar el grupo.</li>
       <li>Las tarifas de este grupo tienen un precio y  condiciones especiales, por lo tanto no pueden combinarse con otras promociones  o beneficios, tales como tiquetes de millas, etc. y solo podrán ser expedidos  por <strong>EVENTOUR SPORT. </strong></li></ol>
<ol>
  <p><strong>CAMBIOS, CANCELACIONES Y REEMBOLSOS</strong></p>
  <p>Una vez canceladas las cuotas  del plan establecido, los valores no serán reembolsables, salvo en aquellos  casos en donde medie caso fortuito o fuerza mayor, previo a análisis por parte  de la <strong>EventourS</strong><strong>,</strong> de la procedencia de la  solicitud. Toda solicitud de devolución debe realizarse mediante nota escrita  del titular de la factura dirigida a EVENTOUR SPORT, al correo <a href="mailto:info@eventours.travel">info@eventours.travel</a>, explicando los motivos que  inducen a la cancelación, adjuntando los documentos que la sustenten. En caso  de que haya lugar a algún tipo de devolución de dinero, se realizará, en el  momento en el que la aerolínea, el hotel y/o los demás proveedores se  pronuncien sobre el particular. El valor que se ha de reembolsar por concepto  de servicios incluidos en el plan y no utilizados, está sujeto a la aplicación  de los descuentos por penalidades o por gastos administrativos o por cobros de  no show de acuerdo con las condiciones particulares de cancelación de cada  aerolínea, hotel u operador, según sean aplicables.</p>
  <p>En caso de reembolso,  cumpliendo con el contenido del Decreto 2438 de 2010, las partes acuerdan que  la suma del<strong> 20% </strong>del total del valor  del programa, <strong>no será reembolsable</strong>,  ni transferible, ni endosable, <strong>en ningún  caso</strong>, ya que será abonado a gastos administrativos, financieros y de  reservas aéreas y hoteleras.</p>
  <p>En caso de cancelación:  </p>
  <ul>
    <li>30 dias antes del viaje no hay lugar a  reembolso.</li>
    <li>60 dias antes del viaje, reembolsable hasta 50%  del valor total del programa.
      <ul>
        <li>90 dias antes del viaje, reembolsable hasta 80%  del valor total del programa.<br>
          <br>
        </li>
      </ul>
    </li>
   <?php if($multicausa){?>
	  <li>En caso de no aplicar a reembolso, <strong>EventourS</strong> incluye en este programa un <strong>Seguro de Cancelación Multicausa </strong>que  hace parte de las coberturas del Seguro de viaje <strong>APRIL  Travel Assistance, </strong>que reconocerá al asegurado hasta el  límite contratado y de acuerdo con las 11 causales cubiertas por el seguro. El  viajero podrá consultar las 11 causales que cubren el reembolso de los  servicios terrestres de este programa y sus condiciones, en la sección de  Seguro de Asistencia.</li>
	  <?php } ?>
  </ul>
  <ul>
    <li><strong>El cliente </strong>que  cancele el viaje con justa causa tendrán derecho a que <strong>EventourS </strong>le devuelva los valores pagados siempre y cuando la  aerolínea, el hotel y/o los demás proveedores así lo autoricen. <strong>El cliente </strong>acepta que <strong>EventourS</strong> descuente el valor de todas  las penalidades que, por no presentación, cambio de nombre, cambio de fecha,  cambio de ruta y en general cualquier circunstancia ajena, impongan la  aerolínea, el hotel y/o los demás proveedores por concepto de la cancelación.</li>
  </ul>
  <p>&nbsp;</p>
  <ul>
    <li>En caso de no haber lugar al  reembolso, el viajero podrá ceder o traspasar la parte correspondiente a otro  usuario, siempre y cuando no se encuentre en la lista de inscritos del programa  de viaje, ni haya efectuado ningun pago. Si el tiquete aun no esta emitido, <strong>El cliente</strong> deberá asumir la suma de  US75 de penalidad por cambio de nombre del titular. Una vez emitido el tiquete  aereo, deberá asumir el monto pactado por la aeolinea. </li>
  </ul>
  <ul>
    <li><strong>EventourS</strong> se reservará el derecho de cancelar el viaje, en caso de que no se reúna el  número mínimo de usuarios previsto en el presente contrato  para que se configure un grupo. En ese caso, <strong>EventourS</strong> reembolsará íntegramente lo  que haya recibido de <strong>El cliente</strong></li>
    <li><strong>EventourS</strong> tiene la facultad de retirar del viaje a quien por falta grave de carácter  moral y/o disciplinario, atente contra la seguridad y/o tranquilidad del viaje<strong>, sin derecho a reembolso</strong>, debiendo  abandonar el destino según el caso. <strong>El  cliente </strong>debe asumir los costos adicionales que se deriven por la causa de  su conducta. </li>
    <li><strong>EventourS</strong> y/o los operadores  turísticos, no se hacen responsables frente a la contravención de normas, leyes  y/o asuntos legales u otros inconvenientes, en que pueda verse involucrado el  viajero en otro país, casos en que el viajero será obligado a retirarse del  programa de viaje por tales motivos, y no le serán reembolsados los servicios  no tomados.</li>
  </ul>
  <p> </p>
  <ul>
    <li>El viajero que se vea  obligado a retirarse del viaje, por motivos personales no tendrá derecho al  reintegro de los servicios no tomados, ocasionando un cobro de no show de  acuerdo a las condiciones de la aerolinea y las condiciones de cada hotel y/o  operador. <strong>EL CLIENTE</strong> debe asumir los  costos en penalidades por cambios de vuelo en caso de modificacion en su fecha  de regreso.  </li>
    <li><strong>De los tiquetes Aéreos:</strong> los tiquetes  con tarifas de Grupo <u>no son reembolsables</u>. En caso de no viajar y  haberlo pagado en su totalidad, pueden ser utilizados a nombre del titular,  para futuros viajes en rutas internacionales, de la misma aerolínea, con una  vigencia máxima de 1 año, previo pago de la penalidad por cambio fecha de  viaje, más el costo de la tasa administrativa y de la diferencia de tarifa, a  que hubiese lugar. </li>
  </ul>
  <ul>
    <li>El porcentaje permitido de cambios en grupos  antes de la emisión en las fechas de ida y vuelta será del 20% del total del  grupo, autorización que estará sujeta a la disponibilidad de cupo<u> manteniendo un rango máximo de 3 días a la fecha en común con el grup</u>o y <u>solo  en la salida o en el regreso</u>. Todo cambio antes de la emisión estará sujeto  a la disponibilidad de cupo en la clase correspondiente y a re cotización de la  tarifa.</li>
  </ul>
  <p>&nbsp;</p>
  <ul>
    <li>Después de emitidos los tiquetes, los cambios  de nombre podrán conservar la tarifa del grupo, si y sólo si se mantienen los  itinerarios originales. Cambio sujeto al pago de penalidades correspondientes.</li>
  </ul>
  <ul>
    <li>Después de emitidos los tiquetes, los cambios  de ruta, vuelos o fechas deberán manejarse por medio de la reexpedición de los  boletos (tiquetes) tomando como base las tarifas publicadas de pasajeros  individuales vigentes para ese itinerario. Cambio sujeto al pago de penalidades y diferencias de  tarifas correspondientes.</li>
  </ul>
</li>
</ol>    <?php } ?>
<strong> <u></u></strong>
<p><strong>TARJETA ASISTENCIA<br>
  COBERTURA 
PLAN INTERNACIONAL<u></u><u></u></strong></p>
<p><strong>APRIL TRAVEL ASSISTANCE</strong> esta presente en 37 países, cuenta con más de 45 compañías dedicadas a múltiples ramas de la industria de los seguros y servicios de asistencia. APRIL asesora, diseña, gestiona y comercializa pólizas a través de una estrategia multicanal. Es el Corredor de Seguros mayorista No. 1 en Francia  (Propiedades y Accidentes).<u></u><u></u> Consulte la cobertura completa <a href="http://eventoursport.travel/crm/programas/cobertura_april.pdf" target="_blank">aqui</a></p>
<?php if($multicasa){?><p><strong>SEGURO DE CANCELACIÓN MULTICAUSA<u></u><u></u></strong>
<p><u></u> El Seguro de Cancelación Multicausa, ampara hasta el límite asegurado y claramente establecido en la caratula de la póliza, los gastos adicionales en que incurra el Asegurado, como consecuencia de la cancelación, reprogramación o interrupción de su viaje y de acuerdo a las 11 causales o eventos cubiertos, siempre y cuando hayan sido reportados y su programación esté dentro de las fechas de vigencia. Consulte las 11 causales cubiertas y las condiciones del producto <u><a href="http://eventoursport.travel/crm/programas/seguro_cancelacion.pdf">aqui</a></u></p>
<?php } ?>
<p><?php if(strpos(strtolower($producto['destino']),"cancun") !== false){?></p><p align="left"><strong>HOSPITALES DE ASISTENCIA</strong></p><p>A continuación encontrará el listado de  Hospitales y Centros Médicos en Cancún a los cuales serán remitidos los  viajeros en caso de emergencia:   </p><p><strong>&nbsp;1. Hospital Ame &nbsp;Hospital Amerimed</strong><br>&nbsp;Avenida Bonampak S/n, Súper Manzana Siete, 77500  Benito Juárez,<br>&nbsp;Q.R., México<br>&nbsp;Tel 52 998 8813400   </p><p><strong>2.&nbsp;Hospital Playamed Cancún</strong><br>&nbsp;Av. Nader Supermanzana 2 manzana 1 lote 13, 77500<br>&nbsp;Cancún, Q.R., México<br>&nbsp;Tel 52 998 1405258   </p><p>&nbsp;<strong>3. Hospital Americano</strong><br>&nbsp;Viento Retorno 1 15, 4, 77500 Cancún, Q.R., Méxicorimed<br>&nbsp;Avenida Bonampak S/n, Súper Manzana Siete, 77500  Benito Juárez,<br>&nbsp;Q.R., México<br>&nbsp;Tel 52 998 8813400   </p><p>&nbsp;<strong>Hospital Playamed Cancún</strong><br>&nbsp;Av. Nader Supermanzana 2 manzana 1 lote 13, 77500<br>&nbsp;Cancún, Q.R., México<br>
&nbsp;Tel 52 998 1405258   </p><p><strong>&nbsp;Hospital Americano</strong><br>&nbsp;Viento Retorno 1 15, 4, 77500 Cancún, Q.R., México</p><p><?php } ?></p>
</body>
</html>