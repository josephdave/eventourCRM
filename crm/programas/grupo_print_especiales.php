<?php 

$plan=$_REQUEST['plan'];

require_once("../control/control.php");

$control = new Control();

$producto=$control->datosProducto($plan);


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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85%"><h1 style="font-size:190%"><?php	$salida = new DateTime($producto['f_salida']);			echo ucwords( strtolower($producto['grupo']))." ".$salida->format("Y");?></h1> <h2>Programa  de viaje </h2></td>
          <td width="15%" align="right">
		  
		  </td>
  </tr>
      </table>
     
     
	  
		  <div id="featured">
          <?php if($plan == 133){?>
          
          
          
			  <table width="100%" border="1" cellpadding="0">
			    <tr>
			      <td valign="top"><p><strong>Fecha de Viaje</strong></p></td>
			      <td valign="top"><p align="center"><?php 
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
					$salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
					
     $datediff = strtotime($producto['f_llegada'])- strtotime($producto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
					
					
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
			  </table>
          <?php } else { ?>
			  <table width="100%" border="1" cellpadding="0">
			    <tr>
			      <td valign="top"><p><strong>Fecha de Viaje</strong></p></td>
			      <td valign="top"><p align="center"><?php 
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
					$salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
					
     $datediff = strtotime($producto['f_llegada'])- strtotime($producto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
					
					
					echo "del ".$salida->format("j")." de ".$meses[$salida->format("n")]." al ".$llegada->format("j")." de ".$meses[$llegada->format("n")]." de ".$llegada->format("Y")?></p></td>
		        </tr>
				  <tr>
				    <td valign="top"><p><strong>Destino</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $producto['destino']?></p></td>
			      </tr>
				  <tr>
				    <td valign="top"><p><strong>Tiempo de Estancia</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</p></td>
			      </tr>
				  <tr>
				    <td valign="top"><p><strong>Nombre del Hotel</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $control->nombreHoteles($plan);
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr>
				  <tr>
				    <td valign="top"><p><strong>Valor del Programa</strong></p></td>
				    <td valign="top"><p align="center"><?php $moneda=$producto['MONEDA']; echo $moneda;?> <?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></p></td>
			      </tr>
</table><?php } ?>
			  <h3>Información General del Programa			  </h3>
			
<h2>Servicios Incluidos</h2>
			    <?php echo $producto['incluye']?>
			     
			    <!--end .accordion-section-->
<h2>Valor del Programa</h2>
 <?php if($producto['calendario_pagos'] != ""){ ?>
			     <?php echo $producto['calendario_pagos']; ?>
                 <?php }else{ ?>
<table border="1" cellpadding="0" width="514">
			          <tr>
			            <th width="427" valign="top"><p align="center"><strong>VALOR DEL PLAN POR PERSONA</strong></p></th>
			            <th width="81" valign="top"><p align="center"><strong>Valor</strong></p></th>
		              </tr>
			          <tr>
			            <td width="427" valign="top"><p><strong>Porción terrestre acomodación doble</strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php echo $moneda."".$producto['valor_terrestre']?> </strong></p></td>
		              </tr>
			          <tr>
			            <td width="427" valign="top"><p><strong>Tiquete aéreo </strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php echo $moneda."".$producto['valor_aereo']?> </strong></p></td>
		              </tr>
			          <tr>
			            <td width="427"><p><strong>VALOR TOTAL DEL PROGRAMA</strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda;?> <?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></strong></p></td>
		              </tr>
		            </table>

		          <!--end .accordion-section-content-->
		        
                
                
			    <!--end .accordion-section-->
<h2>Calendario de Pagos</h2>
              <div id="accordion-calen" class="accordion-section-content"><table  border="1" cellspacing="0" cellpadding="2" >
      
        <tr>
          <td >CUOTA NO</td>
          <td>FECHA LIMITE</td>
          <td>AEREA</td>
          <td>TERESTRE</td>
          
        </tr>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado5=$control->consultaCalendarioPagos($plan);
							while ($fi5 = mysql_fetch_array($resultado5, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo "CUOTA ".$fi5['id'];?></td>
        <td><?php echo $fi5['fecha'];?></td>
        <td><?php echo $producto['MONEDA']." ".$fi5['aerea'];?></td>
        <td><?php echo $producto['MONEDA']." ".$fi5['terrestre'];?></td>
        
      </tr>
      <?php } ?>
    </table>
              <?php } ?>
              <!--end .accordion-section-content-->
            
<h2>Itinerario de Vuelos</h2>
			     <?php echo $producto['itinerario']?>
			      <!--end .accordion-section-content-->
		        
			    <!--end .accordion-section-->
		      
			
			
			    <h2>Documentación de Viaje</h2>
			      <?php echo trim($producto['documentacion'])?>-
			      <!--end .accordion-section-content-->
		        
                
                
			    <!--end .accordion-section-->
<!--end .accordion-section--></strong>
		  
		
	  
        
		  <h3 id="pagos">Formas de Pago</h3>
          <p>Para cumplir con el calendario de pagos, estamos  ofreciendo un servicio de recaudo ágil y seguro, a través de  los siguientes medios de pago:</p>
          <p>
   <?php if(strpos($producto['parametros'],'bancolombia') !== false){?>
<div class="accordion-section"> <strong>Pago Botón PSE BANCOLOMBIA</strong>

  <div id="accordion-pse" class="accordion-section-content">
    <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón:</p>
               <p align="center"><a href="http://www.grupobancolombia.com/multipagospse/" class="myButton" target="_blank">Pago PSE BANCOLOMBIA</a></p>
          <p>Si tiene dificultades utilice la siguiente ruta:</p>
               <p>Para pago por el Portal  Electrónico de Bancolombia. ingrese a la web de Bancolombia www.grupobancolombia.com siguiendo estos pasos:</p>
               <p>1. Haga clic en &quot;Productos y Servicios&quot;</p>
               <p>2. Haga clic en la opcion servicios de pago</p>
               <p>3. Seleccione la opcion MULTIPAGOS PSE y de clic en el boton azul &quot;Ingresa aquí&quot;</p>
               <p>4. Allí eligen la opción &ldquo;Hoteles y Turismo&rdquo;. </p>
               <p>5. Posteriormente se  despliega un directorio y por la letra <strong>E</strong>,  eligen a <strong>EVENTOUR SPORT</strong>.</strong></p>
  </div>
              <!--end .accordion-section-content-->
</div>
            <?php } ?>
            <?php if(strpos($producto['parametros'],'cbancolombia') !== false){?>
            <div class="accordion-section"> <strong>Consignacion Bancolombia</strong>
                          <div id="accordion-cbancolombia" class="accordion-section-content">
                            <p>CONSIGNACIÓN REFERENCIADA: cuenta corriente de Bancolombia No.060-607958-21 a nombre de EVENTOUR SPORT, NIT 900.199.006-3. El banco le solicitará: </p>
                            <p>1) número de documento<br>
                              2) nombre del grupo<br>
                              3) nombre del viajero.</p>
                            <p>Enviar soporte de consignación al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a> . Incluir en el asunto del correo, el nombre del viajero y el grupo al que pertenece.</p>
              </div>
              
             
              <!--end .accordion-section-content-->
</div>
            <!--end .accordion-section-->
            <?php } ?>
             <?php if(strpos($producto['parametros'],'bancobogota') !== false){?>
            <div class="accordion-section"> <strong>Pago Botón PSE BANCO DE BOGOTA</strong>

              <div id="accordion-pse" class="accordion-section-content">
               <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898

" class="myButton" target="_blank">Pago PSE</a></p>
               Si tiene dificultades utilice la siguiente ruta: 
          <p>            1. Ingrese a la web del Banco de Bogotá:<a href="https://www.bancodebogota.com/wps/portal/banco-bogota/home#" target="_blank"> https://www.bancodebogota.com/</a><br>
                 2. En el lado derecho haga click en la opción “Portal de Pagos Electrónicos”<br>
                 3. Elija la opción “Establecimientos Comerciales” <br>
            4.  Posteriormente se despliega un directorio y por la letra E, eligen a<strong> EVENTOUR SPORT</strong></p>
          <p align="center"> </strong></p>
        </div>
              <!--end .accordion-section-content-->
</div>
            <!--end .accordion-section-->
            
            <!--end .accordion-section-->
            
            <?php } ?>
            
             <?php if(strpos($producto['parametros'],'transferenciaUSD') !== false){?>
            <div class="accordion-section"> <strong>Transferencia en Dólares</strong>

              <div id="accordion-transd" class="accordion-section-content">
            <p>   Puede efectuar una transferencia en dólares a nuestra cuenta en Miami. La información de la cuenta es la siguiente:</p>
            <p><span lang="EN-US">BENEFICIARY:		<strong>EVENTOUR SPORT SAS<u></u><u></u></strong></span></p>
               <p><span lang="EN-US">BENEFICIARY ADDRESS:   <strong>AV 5C Norte 23DN-35 Cali, Colombia</strong><u></u><u></u></span></p>
               <p>BANK INFO:   <strong>BANCO DE BOGOTA MIAMI AGENCY</strong><u></u><u></u></p>
               <p><span lang="EN-US">BANK ADDRESS:  <strong>701 Brickell Avenue, Suite 1450. Miami, Florida 33131</strong><u></u><u></u></span></p>
               <p><span lang="EN-US">ABA:    <strong><a href="tel:(6)%206010720" value="+5766010720" target="_blank">066010720</a><u></u><u></u></strong></span></p>
               <p><span lang="EN-US">SWIFT:     <strong>BBOGUS3M</strong><u></u><u></u></span></p>
               <p><span lang="EN-US">ACCOUNT:  <strong>58784</strong></span><u></u></p>
              </div>
              <!--end .accordion-section-content-->
</div>
            <!--end .accordion-section-->
            
            <!--end .accordion-section-->
            
            <?php } ?>
             <?php if(strpos($producto['parametros'],'cbancobogota') !== false){?>
            <div class="accordion-section"> <strong>Consignacion Banco de Bogota</strong>
                          <div id="accordion-cbancobogota" class="accordion-section-content">
                            <p>Hacer su consignación en cualquier sucursal del Banco de Bogotá en nuestra Cuenta Corriente No. 119 - 1409 - 78 a nombre de EVENTOUR SPORT, NIT 900 199 006 - 3                            </p>
                            <p>Enviar soporte de consignación al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a> . Incluir en el asunto del correo, el nombre del viajero y el grupo al que pertenece.</p>
              </div>
              
             
              <!--end .accordion-section-content-->
</div>
            <!--end .accordion-section-->
            <?php } ?>
             <?php if(strpos($producto['parametros'],'tarjetacredito') !== false){?>
            <div class="accordion-section"> <strong>Tarjetas de Crédito</strong>
              <div id="accordion-credito" class="accordion-section-content">
                <p>Puede pagar todos los servicios con tarjeta de crédito, liquidada a la TRM vigente, incluido el valor del fee bancario.                </p>
                <p>Hemos diseñado una modalidad de pago no presencial para la cual solicitamos diligenciar nuestro formato de autorización de cargo a su tarjeta <a href="documentos/autorizacion_tc.pdf" target="_blank">clic aquí para descargar</a>, el cual se debe elaborar a mano y enviar copia de la cedula escaneada con fotocopia de tarjetahabiente. <br>
                </p>
                <p> Si usted va a realizar el pago tanto de porción terrestre como tiquete, le solicitamos diligenciar un formato distinto para cada concepto. Enviar copia a nuestro correo info@eventoursport.com. Favor incluir en el asunto Nombre del Viajero y grupo para poder registrar el abono.                </p>
                <p>Importante: Los valores indicados en dólares serán cargados a su tarjeta en Pesos Colombianos, liquidados a la TRM vigente.</p>
              </div>
              <!--end .accordion-section-content-->
</div>
            <!--end .accordion-section-->
            <?php } ?>
            <?php if(strpos($producto['parametros'],'dolaresefectivo') !== false){?>
            <div class="accordion-section"> <strong>Dólares en Efectivo</strong>
              <div id="accordion-dolares" class="accordion-section-content">
                <p><strong>El pago de dólares en efectivo aplica únicamente para el valor de la Porción Terrestre.</strong> Si elige esta opción, consigne los dólares en nuestra cuenta Corriente No. 072-06972-7, del Banco CORPBANCA. Es requisito del banco llevar la relación de los dólares. Utilice el formato adjunto para su consignación. <a href="documentos/dolares.pdf" target="_blank">Click aquí para descargar.</a><br>
                    <br>
                Importante: Es indispensable que por favor nos remita la copia de la consignación sellada que le entrega el banco, a nuestro correo info@eventoursport.com para poder registrar el abono. Favor especificar en el asunto Nombre Completo del Viajero y grupo, de lo contrario el pago no se vera reflejado.<br></p>
                <p>&nbsp;</p>
                <p>Para consultar las sucursales CORPBANCA haga <u><a href="sucursales_corpbanca.html" target="_blank">click aquí</a></u></p>
              </div>
</div>
              <?php } ?>
                <?php if(strpos($producto['parametros'],'proexcursion') !== false){?>
<div class="accordion-section"> <strong>Pasaporte Proexcursión</strong>
  <div id="accordion-bono" class="accordion-section-content">
    <p align="center">&nbsp;</p>
                <p>Es muy frecuente que familiares y allegados al viajero, quieran darle a sus hijos, el regalo ideal con motivo de su grado. <strong>¡Qué mejor regalo que aportar para este plan de viaje! </strong>Y si además ese aporte les da la posibilidad de ganarse a quien lo hace, un plan de viaje para dos personas, con tiquetes, alojamiento, boletas y traslados, para ver jugar a nuestra selección Colombia en Barranquilla o en otro país, en su camino para clasificar al mundial de <strong>Fútbol RUSIA 2.018</strong>… maravilloso.</p>
                <p>&nbsp; </p>
    <p>En razón a esto Eventour Sport desarrolló esta propuesta, para estimular a esos seres queridos con a vincularse económicamente a título de donación, pagando $ 60.000 por la compra del <strong>PASAPORTE PROEXCURSION</strong>, de los cuales $ 50.000 ingresarán en su nombre como pago del plan de viaje y $ 10.000 a Eventour, como parte de los gastos administrativos y de servicios de viaje del plan de viaje que será entregado a los eventuales favorecidos en el sorteo.</p>
                <p>&nbsp;</p>
  </div>
              
             
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <?php } ?>
            
            
            
             
            
           
          </p>
          <h3>Términos y condiciones del programa          </h3>
          <?php 
		  if($producto['terminoscondiciones'] != ""){
		  
		  echo $producto['terminoscondiciones'];
		  
		  }else{?>
          
            
            <h2>Compromisos entre Eventour y el grupo</h2>

            <p><u><strong>COMPROMISOS DE EVENTOUR &nbsp;CON EL GRUPO</strong></u></p>
            <p>&nbsp;</p>
            <ul>
              <li><strong>EVENTOUR SPORT</strong>&nbsp;enviará &nbsp;BOLETINES INFORMATIVOS que considere de       importancia, antes del viaje.</li>
              <li><strong>EVENTOUR SPORT</strong>&nbsp;asignará para el acompañamiento del grupo, un funcionario  adulto desde la salida de Cali y hasta el       regreso, por cada 20 viajeros, durante todo el viaje.</li>
              <li><strong>EVENTOUR SPORT</strong>&nbsp;asignará un funcionario de su planta, para coordinar con el       departamento de grupos del hotel, la asistencia y respuesta a los       requerimientos del grupo durante su permanencia en el hotel.</li>
              <li><strong>EVENTOUR SPORT</strong>&nbsp;debe cumplir y prestar a cabalidad todos los servicios       ofrecidos al grupo y detallados anteriormente en el Programa.</li>
              <li><strong>EVENTOUR SPORT</strong>&nbsp;está en la obligación de informar a los pasajeros de los       requisitos exigidos por las autoridades en cada destino, como vacunas,       documentación personal necesaria para el desplazamiento en destinos       nacionales e internacionales, sin embargo declinamos toda responsabilidad       en caso de que las autoridades del país o países visitados, nieguen al       pasajero el ingreso al mismo, evento en el cual el pasajero no tendrá       derecho al reintegro del valor de los servicios no utilizados.</li>
              <li>Brindar de manera individual a LOS CLIENTES la       cobertura de servicios médicos prestados por <strong>APRILTravel Assistance</strong> y detallados en el programa completo,       durante todos los días que dure el viaje.</li>
            </ul>
            <p>&nbsp;</p>
<p><u><strong>COMPROMISOS DEL GRUPO CON EVENTOUR</strong></u></p>
            <p>El&nbsp;<strong>GRUPO&nbsp;</strong>debe estar integrado       por una cantidad mínima de 15 pasajeros o más personas viajando juntas, en       la misma ruta, fechas y vuelos.</p>
            <ul>
              <li>No se considerará&nbsp;<strong>GRUPO</strong>&nbsp;y no       gozará de los beneficios de&nbsp;<strong>GRUPO</strong>, la cantidad de viajeros que       no cumpla con estos&nbsp; requisitos.</li>
              <li>Toda reserva debe ser confirmada y pagada,       para los integrantes de&nbsp;<strong>EL</strong>&nbsp;<strong>GRUPO</strong>, en las fechas       establecidas en el calendario de pagos. De no cumplirse con estos       compromisos la reserva será cancelada y podría presentarse cargo por       concepto de cancelación de servicios o por incremento en las tarifas       disponibles después de las fechas establecidas en el calendario de pagos.       Las reservaciones y venta de tiquetes y boletos aéreos para la       participación de viajes en grupos, para cruceros, eventos deportivos y       culturales, congresos, ferias, exposiciones y similares, se sujetaran a       las condiciones &nbsp;penalizaciones que impongan las aerolíneas, hoteles       y operadores, descritos en la pestaña de&nbsp;<strong>Cláusulas de       Responsabilidad y Cancelación.</strong></li>
            </ul>
            <p>
              <!--end .accordion-section-content-->
              
              <!--end .accordion-section--><!--end .accordion-section-->
            Claúsulas de Responsabilidad y Cancelación            </p>
            <ol>
              <li><strong>Eventour Sport,&nbsp;</strong>con Registro Nacional de Turismo vigente No. 16310,<strong>&nbsp;</strong>en       su calidad de agente de viajes y turismo y sus operadores en el destino,       organizadores de este programa, declaramos explícitamente que actuamos como       intermediarios entre los pasajeros, por una parte, y las entidades       llamadas a proporcionar los servicios descritos en los diferentes       itinerarios, por la otra parte, responsabilizándonos del cumplimiento de       los servicios mencionados en este programa.</li>
              <li><strong>Eventour Sport</strong>&nbsp;y sus operadores tienen la prerrogativa de hacer cambios en       el itinerario, fecha de viaje, hoteles, transporte y los demás servicios,       por otros de igual o superior categoría, que sean necesarios para       garantizar el éxito de la excursión, en casos particulares en los que, por       causa del hotel y operadores turísticos, se presenten fallas en la       prestación del servicio.</li>
              <li><strong>Eventour Sport&nbsp;</strong>y sus operadores, declinan toda responsabilidad y gastos extras por       retrasos, huelgas, terremotos, huracanes, avalanchas o demás causas de       fuerza mayor, así como cualquier pérdida, daño, accidente o irregularidad       que pudiera ocurrir a los pasajeros y sus pertenencias, cuando estos sean       motivados por terceros, y por tanto ajenos al control del Operador y sus       afiliados. Igualmente quedamos exentos de cualquier perjuicio por       modificación o retraso en los itinerarios aéreos que se incluyan en los       diferentes programas.</li>
              <li>Para conservar las tarifas de tiquetes aéreos       de grupo, habitaciones y todas las actividades incluidas en este programa,       la aerolínea y el hotel, y tour operadores, exigen un depósito, cuyo valor       está indicado en el calendario de pagos, incluido en este programa. Después       de estas fechas, las tarifas sufrirán ajustes.</li>
              <li><strong>Eventour Sport</strong>&nbsp;no asume responsabilidad alguna frente al usuario o viajero       por el servicio de transporte aéreo, salvo que se trate de vuelos fletados       y de acuerdo con lo especificado en el contrato de transporte. La       prestación de tal servicio se rige por las normas legales aplicables al       servicio de transporte aéreo. Los eventos tales como retrasos o       modificaciones imprevistas en los horarios de los vuelos dispuestos por       las aerolíneas, los derechos del usuario y los procedimientos para hacer       efectivas las devoluciones de dinero a que estos hechos den lugar, se       regirán por las disposiciones legales pertinentes y en particular por las       contenidas en el Reglamento Aeronáutico Colombiano (RAC). Cuando en razón       a la tarifa o por cualquier otro motivo existan restricciones para       efectuar modificaciones a la reserva aérea, endosos o reembolsos; tales       limitaciones deberán ser informadas al usuario.&nbsp;</li>
              <li><strong>Eventour Sport&nbsp;</strong>y/o los operadores turísticos, no se hacen responsables frente a la       contravención de normas, leyes y/o asuntos legales u otros inconvenientes,       en que pueda verse involucrado el viajero en otro país, casos en que el       viajero será obligado a retirarse de la excursión por tales motivos, y no       le serán reembolsados los servicios no tomados, en concordancia con las       condiciones incluidas en el&nbsp;<strong>numeral 5</strong>, de estas&nbsp;<strong>CLÁUSULAS       DE RESPONSABILIDAD.</strong></li>
              <li>El Pasajero es responsable del equipaje y       demás pertenecías personales que lleve consigo y&nbsp;&nbsp;<strong>Eventour       Sport,</strong>&nbsp;no se hará responsable en caso de pérdida de los       mismos.&nbsp;</li>
              <li>Todos los servicios incluidos en los programas       para grupos, reservados y pagados de acuerdo con el calendario de pagos       aquí establecido,&nbsp;<strong><u>no serán reembolsables</u></strong>, salvo en caso       de fuerza mayor. Para el efecto <strong>Eventour Sport</strong>, incluye en este       programa un <strong>Seguro de Cancelación       Multicausa</strong> que hace parte de las coberturas del Seguro de viaje <strong>APRILTravel Assistance,</strong> que       reconocerá al asegurado hasta el límite contratado y de acuerdo con las 11       causales cubiertas por el seguro. El viajero podrá consultar las 11 causales       que cubren el reembolso de los servicios terrestres de este programa y sus       condiciones, en la sección de Seguro de Asistencia.</li>
              <li><strong> De los Tiquetes Aéreos:</strong> El valor del tiquete está compuesto por la tarifa aérea y el valor       de los impuestos de Combustible (Q), IVA, tasas de salida de cada       territorio, tasas de aeropuertos, de turismo, Fees administrativos, y       algunos otros de acuerdo a cada país. Estos pueden variar con las       legislaciones de esos países que se visiten, por lo tanto el valor de       estos impuestos pueden sufrir variaciones y sus precios solo se       garantizaran con la expedición definitiva de todos los tiquetes del grupo,       cuya expedición se efectuará en una sola fecha para todos, como lo       estipulan las aerolíneas en las tarifas para grupos. Los tiquetes del       grupo solo podrán ser expedidos por&nbsp;<strong>EVENTOUR SPORT</strong>&nbsp;de       acuerdo a las cláusulas del convenio firmado con la aerolínea en el       momento de cotizar y confirmar el grupo.</li>
              <li>Los tiquetes Aéreos con tarifas de Grupo&nbsp;<u>no       son reembolsables</u>. En caso de no viajar y haberlo pagado en su       totalidad, pueden ser utilizados a nombre del titular, para futuros viajes       en rutas internacionales, de la misma aerolínea, con una vigencia máxima       de 1 año, previo pago de la penalidad por cambio fecha de viaje, más el       costo de la tasa administrativa y de la diferencia de tarifa, a que hubiese       lugar. Las tarifas de este grupo tienen un precio y condiciones       especiales, por lo tanto no pueden combinarse con otras promociones o       beneficios, tales&nbsp; como tiquetes de millas, etc. y solo podrán ser       expedidos por&nbsp;<strong>EVENTOUR SPORT.</strong></li>
              <ul type="circle">
                <li>El porcentaje permitido de cambios en grupos        antes de la emisión en las fechas de ida y vuelta será del 20% del total        del grupo, autorización que estará sujeta a la disponibilidad de cupo <u>manteniendo        un rango máximo de 3 días a la fecha en común con el grupo y solo en la        salida o en el regreso</u>. Todo cambio antes de la emisión estará sujeto        a la disponibilidad de cupo en la clase correspondiente y a re cotización        de la tarifa.</li>
                <li>Después de emitidos los tiquetes, los cambios        de nombre podrán conservar la tarifa del grupo, si y sólo si se mantienen        los itinerarios originales. Cambio sujeto al pago de penalidades        correspondientes.</li>
                <li>Después de emitidos los tiquetes, los cambios        de ruta, vuelos o fechas deberán manejarse por medio de la re–emisión de        los boletos (tiquetes) tomando como base las tarifas publicadas de        pasajeros individuales vigentes para ese itinerario. Cambio sujeto al        pago de penalidades y diferencias de tarifas correspondientes.</li>
                <li>Para garantizar las reservas del grupo, debe        efectuarse el depósito correspondiente a la TRM del día, por cada        viajero, en la fecha indicada en el calendario de pagos de este programa.</li>
                <li>Las sillas reservadas están sujetas a        cancelación de no cumplirse con alguno de&nbsp; los requisitos        mencionados anteriormente<strong>.</strong></li>
                <li><strong>EVENTOUR SPORT</strong>&nbsp;y/o la Aerolínea no podrán ser demandados por retrasos o        cancelaciones de vuelos debido a fenómenos de la naturaleza, o a        cualquier otra causa fuera del control nuestro.</li>
                <li>Favor tener en cuenta que tanto las tasas de        combustible, aeropuertos e impuestos gubernamentales pueden sufrir        ajustes, antes de la emisión de los tiquetes electrónicos o de la        utilización del alojamiento en los hoteles. En este caso los viajeros        estarán obligados a cubrir la diferencia</li>
              </ul>
            </ol>
<ul>
              <li>Todos los servicios incluidos en la  Porción Terrestre están tarifados en dólares porque son proveídos por empresas  establecidas en el exterior, pero&nbsp; como debemos recaudarlos en pesos  Colombianos, deben liquidarse a la TRM (tasa representativa del mercado) del  día de su pago. Para efectos legales, las Agencias de viajes y turismo, estamos  obligados a comprar divisas y a pagar impuestos sobre las mismas, porque  debemos pagar servicios a empresas internacionales, que tienen cuentas de  bancos en el exterior. Por esta razón estamos autorizadas por el gobierno para  cobrar un fee bancario el 2%, sobre el total de los servicios terrestres en  dólares.</li>
            </ul>
<!--end .accordion-section-content-->
            
          <!--end .accordion-section-->
         <?php } ?> 

<p><strong>APRIL TRAVEL ASSISTANCE</strong> esta presente en 37 países, cuenta con más de 45 compañías dedicadas a múltiples ramas de la industria de los seguros y servicios de asistencia. APRIL asesora, diseña, gestiona y comercializa pólizas a través de una estrategia multicanal. Es el Corredor de Seguros mayorista No. 1 en Francia  (Propiedades y Accidentes).<u></u><u></u></p>
                <?php if($plan != 133 && $plan != 135 && $plan != 137 ){?>
                <strong> <u></u></strong>
                <p><strong>PLAN INTERNACIONAL<u></u><u></u></strong></p>
<p>Seguro de asistencia <strong>APRIL Travel Assistance</strong> con una cobertura hasta USD 100.000 por accidente o enfermedad no preexistente, seguro por pérdida de equipaje hasta por USD 1.500 y seguro de cancelación de viaje Multicausa hasta USD 2.000, incluido. Consulte la cobertura completa <a href="april.html" target="_blank">aqu</a><a href="april.html" target="_blank">i</a></p>
                <p>
                  <?php }else{ ?>
                </p>
                <p><strong><u></u> <u></u></strong><strong>PLAN INTERNACIONAL<u></u><u></u></strong></p>
                <p>Seguro de asistencia <strong>APRIL Travel Assistance</strong> con una cobertura hasta USD 50.000 por accidente o enfermedad no preexistente, seguro por pérdida de equipaje hasta por USD 1.500 y seguro de cancelación de viaje Multicausa hasta USD 2.000, incluido. Consulte la cobertura completa <a href="april2.html" target="_blank">aqu</a><a href="april.html" target="_blank">i</a></p>
                <p><strong><br>
                <?php } ?>
                SEGURO DE CANCELACIÓN MULTICAUSA<u></u><u></u></strong></p>
                <p><u></u> El Seguro de Cancelación Multicausa, ampara hasta el límite asegurado y claramente establecido en la caratula de la póliza, los gastos adicionales en que incurra el Asegurado, como consecuencia de la cancelación, reprogramación o interrupción de su viaje y de acuerdo a las 11 causales o eventos cubiertos, siempre y cuando hayan sido reportados y su programación esté dentro de las fechas de vigencia. Consulte las 11 causales cubiertas y las condiciones del producto <u><a href="cancelacion_multicausa.pdf">aqui</a></u>                </p>
                <p><?php if(strpos(strtolower($producto['destino']),"cancun") !== false){?></p>
          <p align="left"><strong>HOSPITALES DE ASISTENCIA<br>
            <br></strong></p>
          <p>A continuación encontrará el listado de  Hospitales y Centros Médicos en Cancún a los cuales serán remitidos los  viajeros en caso de emergencia: </p>
          <p>&nbsp;</p>
          <p><strong>&nbsp;1. Hospital Ame &nbsp;Hospital Amerimed</strong></p>
          <p>&nbsp;Avenida Bonampak S/n, Súper Manzana Siete, 77500  Benito Juárez,</p>
          <p>&nbsp;Q.R., México</p>
          <p>&nbsp;Tel 52 998 8813400</p>
          <p>&nbsp;</p>
          <p><strong>2.&nbsp;Hospital Playamed Cancún</strong></p>
          <p>&nbsp;Av. Nader Supermanzana 2 manzana 1 lote 13, 77500</p>
          <p>&nbsp;Cancún, Q.R., México</p>
          <p>&nbsp;Tel 52 998 1405258</p>
          <p>&nbsp;</p>
          <p>&nbsp;<strong>3. Hospital Americano</strong></p>
          <p>&nbsp;Viento Retorno 1 15, 4, 77500 Cancún, Q.R., México<br>
            rimed</p>
          <p>&nbsp;Avenida Bonampak S/n, Súper Manzana Siete, 77500  Benito Juárez,</p>
          <p>&nbsp;Q.R., México</p>
          <p>&nbsp;Tel 52 998 8813400</p>
          <p>&nbsp;</p>
          <p>&nbsp;<strong>Hospital Playamed Cancún</strong></p>
          <p>&nbsp;Av. Nader Supermanzana 2 manzana 1 lote 13, 77500</p>
          <p>&nbsp;Cancún, Q.R., México</p>
          <p>&nbsp;Tel 52 998 1405258</p>
          <p>&nbsp;</p>
          <p><strong>&nbsp;Hospital Americano</strong></p>
          <p>&nbsp;Viento Retorno 1 15, 4, 77500 Cancún, Q.R., México</p>
          <p>
            <?php } ?>
          </p>
          <p><strong>VIAJEROS CON CONDICION  MEDICA ESPECIAL</strong></p>
          <p>&nbsp;</p>
          <p><strong>Si  el viajero tiene alguna condición o alimentación especial, diligenciar el  formato adjunto y enviarlo escaneado al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a>, <a href="documentos/asistencia_medica.pdf">click aqui</a> para descargar el formato</strong></p><!--end .accordion-section-content-->
            
            <!--end .accordion-section
           <a class="accordion-section-title" href="#accordion-any">Seguro de Cancelacion ANY REASON</a>
              <div id="accordion-any" class="accordion-section-content">
               <p>El seguro de cancelación ANY REASON tiene como  propósito ofrecer al viajero un seguro para la perdida irrecuperable de  depósitos o gastos pagados por anticipado de acuerdo a las condiciones  generales del contrato por un total de USD60.  <strong>Debe ser adquirido en la primera cuota</strong> (<a href="documentos/any_reason.pdf" target="_blank">Clic para consultar términos y condiciones especiales</a>)<br>
                 <strong>VALOR: USD 60</strong><br>
                <strong>Tarifas sujetas a cambio  sin previo aviso por parte de los parques o proveedores</strong></p>
           
			<hr/>
          <p>&nbsp;</p>
                <p>&nbsp;</p>
              
              <!--end .accordion-section-content
            -->
            <!--end .accordion-section-->
           
              <!--end .accordion-section-content-->
          
<!--end .accordion-section--></h3>
<hr/>
         
         
            <h4>CLÁUSULA DE RESPONSABILIDAD ESTABLECIDA 
            POR EVENTOUR SPORT (Decreto 053 de 2002)</h4>
          <p><strong>EVENTOUR SPORT SE ACOGE A LA SIGUIENTE LEGISLACIÓN:</strong><br>
            <br>
Ley 17 de 1981 Por el cual se aprueba la convención sobre el comercio internacional de especies amenazadas de fauna y flora.<br>
Ley 397 de 1997 por la cual se dictan normas sobre patrimonio cultural, fomentos y estímulos a la cultura.<br>
Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
Ley 1336 de 2009 Por medio de la cual se adiciona y robustece la Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
<strong><br>
EVENTOUR SPORT S.A.S</strong>, con Registro Nacional de Turismo No.16310, se acoge en su totalidad a la Cláusula de Responsabilidad establecida en el Artículo 4 del Decreto 2438 de 2010 y sus posteriores reformas: ¨Responde por la total prestación y calidad de los servicios descritos en el programa, limitando su responsabilidad por casos de fuerza mayor, que puedan ocurrir durante el viaje. En virtud de esta, se reserva el derecho de hacer cambios en el itinerario, fechas de viaje y prestadores de servicio por otros de igual o superior categoría. Nuestra empresa informará y asesorará en la documentación necesaria para el viaje, pero no será responsable por la negación del ingreso a otros países por decisión de sus autoridades. La agencia de viajes no asume responsabilidad alguna por el servicio de transporte aéreo. La prestación de tal servicio se rige por las normas legales aplicables al servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los derechos del usuario y los procedimientos para hacer efectivas las devoluciones de dinero a que estos hechos den lugar, se regirán por las disposiciones legales pertinentes y en particular por las contenidas en el Reglamento Aeronáutico Colombiano. El viajero tendrá derecho al reintegro de servicios no utilizados por fuerza mayor, de acuerdo con la reglamentación establecida por los prestadores de servicios. El viajero deberá cumplir con las normas legales y de salud, restricciones, y será responsable de los objetos que lleve consigo¨.</p>
          <p>
            <?php if($producto['unidad_negocio'] != "GRUPOS JUVENILES"){ ?>
            <strong>Maria Alejandra Moreno Quintero</strong><br>
Jefe UN Especiales<br>
</p>
<p>
  <?php }else{ ?>
  <strong>Maria Paula Luna Stapel</strong><br>
Jefe UN JUVENIL<br>
<?php } ?>
</p>
<p><strong>Ricardo Luna Rivera<br>
</strong>Director General </p>
<p align="center"><strong>EVENTOUR SPORT </strong><br>
Avenida 5C Norte 23DN - 35<br>
Cali - Colombia<br>
Tel: (572) 6604000 - Celular: 320 677 9116<br>
www.eventoursport.travel<!-- END Wrapper -->
	
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</p>
      
	
</body>
</html>