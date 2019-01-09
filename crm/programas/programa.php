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
	<link rel="stylesheet" type="text/css" href="reset.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="media-queries.css" />
    <link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="accordion.js"></script>


	<link rel="stylesheet" type="text/css" href="demo.css">
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700,400,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body id="home">
	<div id="wrapper">
		
		<header>
			<h1><a href="index.html"><img src="eventour.png"  alt="" style="float:right"/></a></h1><div style="display: table-cell;
    vertical-align: middle;    height: 126px;">
			<h1 style="font-size:161%;text-align:left;"><img src="23/torneo.jpg"  alt="" width="491" height="112"/></h1>
            </div>
			<p>&nbsp;</p>
		<!--	<nav>
			<div style="width:50%;margin:0 auto;">
				<a href="#grupo">Grupo</a>
				<a href="#pagos">Pagos</a>
				<a href="#documentacion">Documentación	Viajero</a>
				<a href="#seguro">Seguro de asistencia</a>
              </div>
			  <div class="clearfix"></div>
			</nav>	-->
		</header>
				
		<section id="main-content">
		  <div id="featured">
			  <table width="508" border="1" cellpadding="0">
			    <tr>
				    <th colspan="2"><p align="center"><strong>INFORMACIÓN DEL PROGRAMA</strong></p></th>
			    </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Fecha de Viaje</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php 
					$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
					$salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
					
     $datediff = strtotime($producto['f_llegada'])- strtotime($producto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
					
					
					echo "".$salida->format("j")." a ".$llegada->format("j")." de ".$meses[$llegada->format("n")]." de ".$llegada->format("Y")?></p></td>
			      </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Destino</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php echo $producto['destino']?></p></td>
			      </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Tiempo de Estancia</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</p></td>
			      </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Nombre del Hotel</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php echo $producto['hotel'];
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Valor del Programa</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php $moneda=$producto['moneda']; echo $moneda;?> <?php echo number_format(($producto['valor_aereo']+$producto['valor_terrestre']),0,",",".")?></p></td>
			      </tr>
			  </table>
			  <p><a href="#"></a>Uno de los aspectos más  importantes en este proceso es contar con la&nbsp;información&nbsp;personal  necesaria de los viajeros. Estos datos se utilizarán  para enviarles boletines periódicos con información detallada de los servicios, y además seguir un riguroso control de la documentación personal de viaje,  pagos, etc. Por esta razón requerimos un registro claro y  completo, de la información personal de cada participante. Por favor para registrarse,  haga un clic en el siguiente boton:</p>
              <p>&nbsp;</p>
              <p align="center"><a href="https://eventoursport.travel/crm/registro.php?plan=<?php echo $plan?>" target="_blank" class="myButton" style="font-size:150%">INSCRIPCIÓN AL VIAJE </a></p>
              <p align="center">&nbsp;</p>
              <p align="center" style="font-size:80%">Siguiendo los lineamientos de nuestra política interna y  filosofía sobre el manejo y tratamiento de información personal, queremos ratificar que sus datos personales son tratados de forma privada y confidencial y  por tanto, garantizamos la seguridad y confidencialidad de su información a través de un almacenamiento seguro que impide el acceso a terceras personas ajenas a nuestra organización empresarial.</p>
              <p align="center">&nbsp;</p>
          </div> 
			<!-- END Featured --><!-- END Latest -->
		  <div class="clearfix"></div>
			<hr/>
			<div id="about">
			  <h3 id="grupo">Información del Grupo</h3>
			  <p>&nbsp;</p>
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-1">Servicios Incluidos</a>
			      <div id="accordion-1" class="accordion-section-content">
			        
                    <?php include($plan."/incluidos.html"); ?>
                    
                    
		          </div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-2">Valor del Programa</a>
			      <div id="accordion-2" class="accordion-section-content">
			        
                     <?php include($plan."/valor_programa.html"); ?>
		          </div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-3">Itinerario de Vuelos</a>
			      <div id="accordion-3" class="accordion-section-content">
			          <?php include($plan."/itinerarios.html"); ?>
			      </div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
		      
			
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-docu">Documentación de Viaje</a>
			      <div id="accordion-docu" class="accordion-section-content">
			        <p>Pasaporte al día, con vigencia mínima de 6 meses.<br>
			        </p>
			        <ul>
			          <li> Cédula de ciudadanía</li>
		            </ul>
			        <p>&nbsp;</p>
			        <p><strong>Información importante sobre el PASAPORTE COLOMBIANO:</strong><br>
			          A partir del 24 de noviembre de 2015, si su libreta es Convencional debe renovarla.<br>
			          Tenga en cuenta que actualmente será aceptado el pasaporte de lectura mecánica durante su vigencia de 10 años y el pasaporte electrónico que se emite en Colombia desde el 1 de Septiembre del 2015, implementado por exigencia de la Unión Europea                 para eliminar la Visa Schengen. Los dos pasaportes serán aceptados para su viaje internacional.<br>
			          <strong><br>
			            ¿Cómo sé si tengo que cambiar mi pasaporte?</strong><br>
			          Según el Decreto 1067, el cambio de pasaporte se adelanta por las siguientes razones:<br>
			          1. Por rectificación de datos en el documento de identidad.<br>
			          2. Por vencimiento.<br>
			          3. Por daño que impida su uso.<br>
			          4. Por robo o pérdida.<br>
			          5. Cuando el pasaporte vigente no cuente con las páginas suficientes.<br>
			          6. Por alcanzar la mayoría de edad.<br>
			          7. En Colombia, por cumplir siete (7) años y obtener la Tarjeta de Identidad.<br>
		            8. A partir del 24 de noviembre de 2015, si su libreta es Convencional debe renovarla.</p>
			        <p align="center"> </strong></p>
		          </div>
			      <!--end .accordion-section-content-->
		        </div>
                </div>
			    <!--end .accordion-section-->
			    <!--end .accordion-section-->
		      </div>
			  <p>&nbsp;</p>
			  <p align="center"> </strong></p>
		  </div>
		</section>
	  <div class="clearfix"></div>
        <div id="about">
		  <h3 id="pagos">Información de Pagos</h3>
		  <p>&nbsp; </p>
		  <div class="accordion">
        
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-calen">Calendario de Pagos</a>
              <div id="accordion-calen" class="accordion-section-content">
               
 <?php include($plan."/calendario_pagos.html"); ?>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
        
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pago">Del tiquete aéreo</a>
              <div id="accordion-pago" class="accordion-section-content">
                <ul>
                  <li>Por reglamentación IATA los tiquetes internacionales  están tarifados en Dólares Americanos y deben ser pagados en pesos en Colombia.  El valor del tiquete aéreo en pesos se calcula al cambio de la TRM (Tasa  Representativa del Mercado) de la fecha de expedición. </li>
                  <li>El valor del tiquete está compuesto por la tarifa  aérea y los impuestos aéreos detallados. Los impuestos como el IVA, o salida de  cada país y las tasas de aeropuertos o administrativas, y pueden variar de  acuerdo a las legislaciones de cada país, por lo tanto el valor de estos, solo  se garantiza con la expedición de los tiquetes electrónicos. </li></ul>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <div class="accordion-section"><a class="accordion-section-title" href="#accordion-terrestre">De la porción terrestre</a>
              <div id="accordion-terrestre" class="accordion-section-content">
                <ul>
                  <li>Todos los servicios incluidos en la Porción  Terrestre están tarifados en dólares porque son proveídos por empresas  establecidas en el exterior, pero  como  debemos recaudarlos en pesos Colombianos, deben liquidarse a la TRM (tasa  representativa del mercado) del día de su pago. </li>
                  <li>Para efectos legales, las Agencias de viajes y  turismo, estamos obligados a comprar divisas y a pagar impuestos sobre las  mismas, porque debemos pagar servicios a empresas internacionales, que tienen  cuentas de bancos en el exterior. Por esta razón estamos autorizadas por el  gobierno para cobrar un fee bancario el 2%, sobre el total de los servicios  terrestres en dólares. </li>
                </ul>
              </div>
              <!--end .accordion-section-content-->
            </div>
            
            <!--end .accordion-section-->
         
          </div>
          <p>&nbsp;</p>
<p>&nbsp;</p>
		  <h3>Formas de Pago</h3>
          <p>Para cumplir con el calendario de pagos, estamos  ofreciendo un servicio de recaudo ágil y seguro, a través de  los siguientes medios de pago:</p>
          <p>&nbsp;</p>
          <div class="accordion">
          <?php if(strpos($producto['parametros'],'bancolombia') !== false){?>
      <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pse">Pago Botón PSE BANCOLOMBIA</a>

  <div id="accordion-pse" class="accordion-section-content">
               <p>Pago por el Portal  Electrónico de Bancolombia. En la web de Bancolombia encontrarán la opción &ldquo;<strong>Multipagos PSE</strong>&rdquo; (En el menú  Transacciones). Allí eligen la opción &ldquo;Hoteles y Turismo&rdquo;. Posteriormente se  despliega un directorio y por la letra <strong>E</strong>,  eligen a <strong>EVENTOUR SPORT</strong>, para pagar  por PSE.  Con esta opción ustedes pueden  pagar, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. También puede ingresar directamente a través del siguiente  botón:  </p>
               <p>&nbsp;</p>
               <p align="center"><a href="http://www.grupobancolombia.com/multipagospse/" class="myButton" target="_blank">Pago PSE BANCOLOMBIA</a></p>
               <p align="center"></p>
               <p>&nbsp;</p>
               <p align="center">&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center"> </strong></p>
        </div>
              <!--end .accordion-section-content-->
            </div>
            <?php } ?>
             <?php if(strpos($producto['parametros'],'bancobogota') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pse">Pago Botón PSE </a>

  <div id="accordion-pse" class="accordion-section-content">
               <p>En la web del Banco de Bogotá por la ruta: https://www.bancodebogota.com/wps/portal/banco-bogota/home# encontrarán  la opción &ldquo;Portal de pagos Electrónicos&rdquo; (En el menú Transacciones). Allí  escogen la opción &ldquo;Establecimientos Comerciales&rdquo;. Posteriormente se despliega  un directorio y por la letra <strong>E</strong>,  eligen a <strong>EVENTOUR SPORT</strong>, para pagar  por PSE.  Con esta opción ustedes pueden  pagar, con cargo a su cuenta de ahorros o corriente desde cualquier banco, sin  costo adicional. También puede ingresar directamente a través del siguiente  botón:  </p>
               <p align="center">&nbsp;</p>
          <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898

" class="myButton" target="_blank">Pago PSE</a></p>
               <p align="center"></p>
               <p>&nbsp;</p>
               <p align="center">&nbsp;</p>
          <p>&nbsp;</p>
          <p align="center"> </strong></p>
        </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            
            <!--end .accordion-section-->
            
            <?php } ?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-credito">Tarjetas de Crédito</a>
              <div id="accordion-credito" class="accordion-section-content">
                <p>Puede pagar todos los servicios con tarjeta de crédito, liquidados a la TRM vigente, incluido el valor del fee bancario. En caso de elegir esta opción tenga en cuenta que:<u></u><u></u></p>
                <p><u></u><u></u></p>
                <p>El pago con tarjeta de crédito del tiquete aéreo debe efectuarse en pesos, por el valor total de la tarifa aérea más impuestos, a la TRM vigente del día establecido por la aerolínea como fecha límite para la expedición de los boletos aéreos de todo el grupo. En todo caso no será más allá de un mes, antes de la salida indicada en este Programa.<u></u><u></u></p>
                <p><u></u><u></u></p>
                <p>Descargue el <a href="documentos/autorizacion_tc.pdf" target="_blank">formato de autorización de cargo a su tarjeta</a>, el cual se debe elaborar uno para porción terrestre y otro para el pago del tiquete aéreo y envíelo a nuestro correo<a href="mailto:info@eventoursport.com" target="_blank">info@eventoursport.com</a> junto con la copia de la cédula del tarjetahabiente para poder registrar el abono.                </p>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-dolares">Dólares en Efectivo</a>
              <div id="accordion-dolares" class="accordion-section-content">
                <p>Para quienes elijan hacer el pago de la  porción terrestre en dólares en efectivo, hemos dispuesto de la cuenta  Corriente en dólares No. 072-06972-7, del Banco CORPBANCA. Es requisito del  banco llevar la relación de los dólares. Recuerde que debe sumar el 2% del fee  bancario.&nbsp; Si utiliza este medio de pago, debe <a href="documentos/dolares.pdf" target="_blank">utilizar el formato  adjunto (CLIC PARA DESCARGAR)</a>. Adicionalmente es indispensable que por favor nos remita la copia de  la consignación sellada que le entrega el banco, a nuestro correo <a href="mailto:contabilidad@eventoursport.com">info@eventoursport.com</a> para poder registrar el abono. 
                </p>
              </div>
                    </div>
              <div class="accordion-section"><a class="accordion-section-title" href="#accordion-pdol">Transferencia en Dólares para la porción terrestre</a>
                <div id="accordion-pdol" class="accordion-section-content">
                <div>
                  <p>Si usted tiene una cuenta en dólares en Bancos internacionales, también puede hacer transferencia en dólares, a nuestra en USA. A continuación todos los datos que necesitará para la efectuar la transacción:</p>
                  <p>&nbsp;</p>
                  <p>BENEFICIARY: <strong>EVENTOUR SPORT SAS</strong></p>
                  <p>BENEFICIARY ADDRESS:<strong> Avda 5C Nte 23DN-35 Cali, Colombia</strong></p>
                  <p>BANK INFO: <strong>BANCO DE BOGOTA MIAMI AGENCY</strong></p>
                  <p>BANK ADDRESS: <strong>701 Brickell Avenue, Suite 1450. Miami, Florida 33131 </strong></p>
                  <p>ABA: <strong>066010720 (router number)</strong></p>
                  <p>SWIFT: <strong>BBOGUS3M</strong></p>
                  <p>ACCOUNT:  <strong>58784</strong></p>
                  <p>&nbsp;</p>
                  <p>Recuerde que para registrar su pago es indispensable que nos envíe soporte de la consignación o transferencia. Si cuenta con chequera de su banco en USA, también podemos recibirle su cheque en nuestra oficina, ubicada en la Avenida 5C Norte 23DN-35.</p>
                </div>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
                <?php if(strpos($producto['parametros'],'proexcursion') !== false){?>
                        <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-bono">Pasaporte Proexcursión</a>
                          <div id="accordion-bono" class="accordion-section-content">
                <p align="center"><strong><img src="pasaporte.jpg"  alt=""/></strong></p>
                <p><strong>Eventour Sport</strong> desarrolló esta propuesta considerando la frecuente solicitud de diferentes padres de familia,  que nos sugerían algún aliciente para familiares y amigos que a cambio de su donación, tuvieran la posibilidad de participar en un sorteo por un premio realmente atractivo, así que con la posibilidad de "ganarse la selección Colombia" ofrecemos a ustedes esta simpática opción de hacer de este, el mejor regalo de grado, para los viajeros.<u></u><u></u></p>
                <p> </p>
                <p>A partir del 14 de Noviembre, y en el horario de jornada laboral, pueden retirarlos, acogiéndose a los <strong>TÉRMINOS Y CONDICIONES </strong><u><a href="documentos/legales_bono.pdf" title="undefined" target="_blank">(clic para descargarlos)</a></u> del <strong>PASAPORTE PROEXCURSIÓN</strong> de Eventour Sport.</p>
                <p>&nbsp;</p>
              </div>
              
             
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <?php } ?>
    
          </div>
          <p>&nbsp;</p>
           <div class="clearfix"></div>
           <h3>Términos y condiciones del programa</h3>
          <p>&nbsp;</p>
        
          <div class="accordion">
            
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t1">Compromisos de Eventour Sport con el grupo</a>
              <div id="accordion-t1" class="accordion-section-content">
                <ul>
                  <li>Envíos de BOLETINES INFORMATIVOS,  antes del viaje.</li>
                  <li>Enviar encuesta de satisfacción despues del viaje.</li>
                  <li>Acompañamiento de un guía adulto EVENTOUR SPORT por  cada 25 viajeros, durante todo el viaje, mínimo uno.</li>
                  <li>Asignación de un coordinador del departamento de  grupos del hotel, para su asistencia, durante la permanencia en este. </li>
                  <li>Asistencia médica permanente durante todo el viaje, y  cuando así lo requiera la salud y el bienestar de alguno de los integrantes del  grupo, asignado por la compañía de asistencia. </li>
                </ul>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-compro">Compromisos del grupo con Eventour Sport</a>
              <div id="accordion-compro" class="accordion-section-content">
                <ul>
                  <li>Será  considerado como grupo una cantidad de pasajeros integrados por 15 o más  personas adultas viajando juntas, en la misma ruta, fechas y vuelos. No se considerará  en grupo y no gozará de los beneficios de grupo, el viajero que no cumpla con  estos  requisitos.</li>
                  <li><strong>EVENTOUR SPORT</strong> y/o la  Aerolínea no podrán ser demandados por retrasos o cancelaciones de vuelos  debido a fenómenos de la naturaleza, o a cualquier otra causa fuera del control  nuestro.</li>
                  <li>Favor  tener en cuenta que tanto las tasas de combustible, aeropuertos e impuestos gubernamentales  pueden sufrir ajustes, antes de la emisión de los tiquetes electrónicos o de la  utilización del alojamiento en los hoteles.</li>
                  <li>Un cargo  de USD 150 será aplicado por cualquier cambio de nombre que se haga después de  la fecha límite de reserva, más el costo de USD 25 de la  tasa administrativa. </li>
                  <li>Un cargo  de USD 150 será aplicado por cualquier cambio realizado por el pasajero después  de emitirse los tiquetes, más el costo de USD 25 de la tasa administrativa. </li>
                  <li>Los  tiquetes con tarifas de Grupo <u>no son reembolsables</u>. En caso de no  viajar, pueden ser utilizados a nombre del titular, para futuros viajes en  rutas internacionales, de la misma aerolínea, con una vigencia máxima de 1 año,  previo pago de la penalidad por cambio fecha de viaje, por valor de USD 150, más el costo de USD 25 de la tasa administrativa y de la diferencia de  tarifa, a que hubiere lugar. </li>
                  <li>Los  nombres de los pasajeros deben ser suministrados tal como figuren en el  pasaporte. En caso de que el nombre suministrado sea diferente al que figura en  el pasaporte, este cambio implicará pagar penalidad por cambio de nombre,  indicada anteriormente. </li>
                  <li>Para garantizar las  reservas del grupo, debe efectuarse el depósito correspondiente a la TRM del  día, por cada viajero, en la fecha indicada en el calendario de pagos de este  programa,.</li>
                  <li>Los  tiquetes del grupo solo podrán ser expedidos por <strong>EVENTOUR SPORT</strong> de  acuerdo a las cláusulas del convenio firmado con la aerolínea en el momento de  cotizar y confirmar el grupo. </li>
                  <li>Las tarifas  de este grupo tienen un precio y condiciones especiales, por lo tanto no pueden  combinarse con otras promociones o beneficios, tales  como tiquetes de millas, etc. y solo podrán  ser expedidos por <strong>EVENTOUR SPORT. </strong></li>
                  <li>Para la  emisión de tiquetes otorgados como beneficios del grupo, la aerolínea  aplicará los cargos de impuestos y tasas, de acuerdo  a la misma ruta y tarifa del grupo.</li>
                  <li>No se  aceptan cambios de nombre después de la emisión de los tiquetes, salvo con el  cargo de la penalidad <u>por el cambio total del nombre</u>.</li>
                  <li>Las  sillas reservadas están sujetas a cancelación de no cumplirse con alguno  de  los requisitos mencionados  anteriormente<strong>.</strong></li>
                  <li>Para conservar la tarifa aérea  de grupo, las tarifas de habitaciones y todas las actividades incluidas en este  programa, la aerolínea y el hotel, y tour operadores, exigen un deposito, cuyo  valor esta indicado en el calendario de pagos, incluido en este programa.  Despues de estas fechas, las tarifas sufriran ajustes.</li>
                  <li>La <strong>Ley  300 de 1996</strong>, preceptúa que la industria turística se regirá por los  principios allí establecidos; y que, en el numeral 8, hay una prerrogativa a  favor del organizador y los operadores turísticos, de retirar del tour a quien  por causa grave de carácter moral o disciplinario debidamente comprobada,  atente contra el éxito del mismo; caso en el cual el usuario tendrá derecho al  reintegro del valor de los servicios turísticos no disfrutados. </li>
                </ul>
                <p>&nbsp;</p>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t2">Claúsulas de Responsabilidad</a>
              <div id="accordion-t2" class="accordion-section-content">
             
                <ul> <li><strong>Eventour  Sport,&nbsp;</strong>con Registro Nacional de Turismo vigente  No. 16310,<strong>&nbsp;</strong>en su calidad de agente de viajes y turismo y sus  operadores en el destino, organizadores de este programa, declaramos  explícitamente que actuamos como intermediarios entre los pasajeros, por una  parte y las entidades llamadas a proporcionar los servicios descritos en los  diferentes itinerarios, por la otra parte, responsabilizándonos del  cumplimiento de los servicios descritos ofrecidos en este programa.</li>
                  <li><strong>Eventour  Sport&nbsp;</strong>y sus operadores, declinan toda responsabilidad y gastos extras por  retrasos, huelgas, terremotos, huracanes, avalanchas o demás causas de <strong>fuerza mayor</strong>, así como cualquier  pérdida, daño, accidente o irregularidad que pudiera ocurrir a los pasajeros y  sus pertenencias, cuando estos sean motivados por terceros, y por tanto ajenos  al control del Operador y sus afiliados. Igualmente quedamos exentos de  cualquier perjuicio por modificación o retraso en los itinerarios aéreos que se  incluyan en los diferentes programas.</li>
                </ul>
                <p><strong>&nbsp;</strong></p>
                <ul>
                  <li><strong>Eventour  Sport</strong>&nbsp;y sus operadores tienen la perrogativa de hacer cambios en el itinerario,  fecha de viaje, hoteles, transporte y los demás servicios, por otros de igual o  superior cateogria, que sean necesarios para garantizar el éxito de la  excursión en casos particulares en los que, por causa del hotel y operadores  turísticos, se presenten fallas en la prestación del servicio.</li>
                </ul>
                <ul>
                  <li><strong>Eventour Sport</strong> no asume responsabilidad alguna frente al usuario  o viajero por el servicio de transporte aéreo, salvo que se trate de vuelos  fletados y de acuerdo con lo especificado en el contrato de transporte. La  prestación de tal servicio se rige por las normas legales aplicables al  servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones  imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los  derechos del usuario y los procedimientos para hacer efectivas las devoluciones  de dinero a que estos hechos den lugar, se regirán por las disposiciones  legales pertinentes y en particular por las contenidas en el Reglamento  Aeronáutico Colombiano (RAC). Cuando en razón a la tarifa o por cualquier otro  motivo existan restricciones para efectuar modificaciones a la reserva aérea,  endosos o reembolsos; tales limitaciones deberán ser informadas al usuario. </li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                  <li>Eventour  Sport declara que todos los servicios incluidos en los programas para grupos,  reservados y pagados de acuerdo con el calendario de pagos aquí establecido, no  serán reembolsables, salvo en casos de <strong>fuerza  mayor</strong>. En este caso el viajero tendrá derecho al reintegro de servicios, de  acuerdo con la reglamentación establecida por los prestadores de servicios (hoteles,  aerolíneas y operadores). Para prever estos casos, sugerimos tomar por un costo  opcional, el seguro de cancelación&nbsp;<strong><em>ANY REASON</em></strong><em>&nbsp;<strong>ASSIST CARD</strong></em><strong>,&nbsp;</strong>cuyo fin es  recuperar<strong>&nbsp;</strong>los depósitos o gastos pagados por anticipado  para el viaje, de acuerdo a las condiciones y compromisos generales del grupo  por los servicios incluidos y descritos en este programa, suscritos entre el  Titular y la Agencia de Viajes.&nbsp;<strong>Por  exigencia de ASSIST CARD el seguro ANY  REASON puede&nbsp;ser adquirido, <u>únicamente</u> con el pago de la primera  cuota del calendario de pagos.<em> (ver condiciones)</em></strong></li>
                </ul>
                <p>&nbsp;  </p>
                <p><strong><em>SE ENTIENDE COMO CASOS DE FUERZA MAYOR:</em></strong></p>
                <ul>
                  <li>Condiciones médicas no preexistentes</li>
                  <li>Muerte del usuario prestador del  servicio</li>
                  <li>Muerte de familiar en primero y segundo  grado de consanguinidad y primero civil.</li>
                </ul>
                <p><strong><em>DOCUMENTOS REQUERIDOS PARA PROBAR CASOS  DE FUERZA MAYOR:</em></strong></p>
                <ul>
                  <li>Certificado de incapacidad médica</li>
                  <li>Certificado de defunción</li>
                  <li>Registro civil de nacimiento </li>
                  <li>Registro civil de matrimonio</li>
                </ul>
                <p>&nbsp; </p>
                <ul>
                  <li><strong>Eventour Sport</strong>&nbsp;está  en la obligación de informar a los pasajeros de los requerimientos de cada  destino, como vacunas, documentación personal requerida para facilitar el  desplazamiento en destinos nacionales e internacionales, sin embargo declinamos  toda responsabilidad en caso de que las autoridades del país o países  visitados, nieguen al pasajero el ingreso al mismo, evento en el cual el  pasajero no tendrá derecho al reintegro del valor de los servicios no  utilizados.</li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                  <li><strong>Eventour Sport&nbsp;</strong>y/o  los operadores turísticos tienen la prerrogativa de retirar del tour a quien  por causa grave de carácter moral o disciplinaria, atente contra el éxito del  programa o no acate todas las normas y protocolos descritos en el&nbsp;<strong><em>MANUAL y GUIA DE COMPORTAMIENTO PARA VIAJES EN GRUPO DE EVENTOUR  SPORT</em></strong><em>,&nbsp;</em>caso en el cual el usuario  no tendrá derecho al reintegro del valor de los servicios turísticos no  disfrutados, en concordancia con la reglamentación establecida por los  prestadores de servicios (hoteles, aerolíneas y operadores), mencionados en el  numeral 5 de estas&nbsp;<strong>CLÁUSULAS DE RESPONSABILIDAD</strong></li>
                </ul>
                <ul>
                  <li><strong>Eventour Sport&nbsp;</strong>y/o  los operadores turísticos, no se hacen responsables frente a la contravención  de normas, leyes y/o asuntos legales u otros inconvenientes, en que pueda verse  involucrado el viajero en otro país, casos en que el viajero será obligado a  retirarse de la excursión por tales motivos, y no le serán reembolsados los  servicios no tomados, en concordancia con la reglamentación establecida por los  prestadores de servicios (hoteles, aerolíneas y operadores), mencionados en el  numeral 5 de estas&nbsp;<strong>CLÁUSULAS DE RESPONSABILIDAD</strong></li>
                </ul>
                <p>&nbsp;</p>
                <ul>
                  <li>El Pasajero es responsable del equipaje  y demás pertenecías personales que lleve consigo y&nbsp;&nbsp;<strong>Eventour Sport,</strong>&nbsp;no se hará responsable en caso de  pérdida de los mismos.&nbsp;<strong>Eventour Sport</strong>,  incluye en este programa un seguro de equipaje con una cobertura específica que  cubra tales imprevistos.</li>
                </ul>
                <p>&nbsp;</p>
                <p>Toda  reserva debe ser confirmada y pagada, en las fechas establecidas en el  calendario de pagos en concordancia con la reglamentación establecida por los  prestadores de servicios turísticos (hoteles, aerolíneas y operadores). De no  cumplirse con estos compromisos la reserva será cancelada y podrían presentarse  cargos por concepto de cancelación de servicios o diferencia en las tarifas  vigentes. Las reservaciones y venta de boletos en grupo, de cruceros, boletas  para eventos deportivos, musicales y culturales, congresos, ferias,  exposiciones y similares, se sujetaran a las condiciones &nbsp;penalizaciones  que impongan cada empresa. </p>
                <p>&nbsp;</p>
          
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
          </div>
          <p>&nbsp;</p>
          <div class="clearfix"></div>
          <h3 id="seguro">Seguro de Asistencia</h3>
          <p>&nbsp;</p>
          <div class="accordion">
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-asis">Seguro de Asistencia ASSIST CARD</a>
              <div id="accordion-asis" class="accordion-section-content">
                <p>&nbsp;</p>  
          <p>Nuestro programa de viaje incluye una Tarjeta de Asistencia al viajero que le proveerá de asistencia médica en caso de accidente o enfermedad, además de otros servicios en destino sin que usted tenga que desembolsar su dinero.<u></u><u></u></p>
          <p><strong><u></u> </strong></p>
          <p align="center"><a href="documentos/asisstcard.pdf" target="_blank" class="myButton">Ver Cobertura</a></p>
          <p align="center">&nbsp;</p>
          <p align="center"></p>
          <p></p>
          <p></p>
          <p></p>
          <p>¿Qué debo hacer si necesito asistencia? Si necesita cualquier clase de asistencia, ya sea una consulta médica, una urgencia odontológica, asistencia legal o algún otro servicio cubierto, debe contactarse con la Central de Asistencia de ASSIST CARD. Puede hacerlo telefónicamente llamando, a través de la modalidad de cobro revertido, a la Central de Asistencia más cercana detallada en el listado que le proveeremos y que también se encuentra disponible en <a href="http://www.assistcard.com/" target="_blank">www.assistcard.com</a>, o bien puede contactarse gratuitamente a través del chat disponible en nuestra APP o en nuestro sitio web.</p>
          <p align="center"><br>
        </p>
          <p align="center"></p>
          <p>&nbsp;</p>
          
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-any">Seguro de Cancelacion ANY REASON</a>
              <div id="accordion-any" class="accordion-section-content">
               <p>El seguro de cancelación ANY REASON es para la pérdida irrecuperable de depósitos o gastos pagados por anticipado por el viaje, cualquiera sea el motivo de la cancelación siempre que el Titular haya adquirido y pagado la tarjeta ASSIST CARD con este beneficio en la misma fecha en que se realizó el primer depósito a la Agencia de Viajes y de acuerdo a las condiciones generales del contrato o programa suscrito por el Titular con la Agencia.(<a href="documentos/any_reason.pdf" target="_blank">Clic para consultar términos y condiciones especiales</a>)<br>
                 <strong>VALOR: USD 90</strong><br>
  <strong>Tarifas sujetas a cambio  sin previo aviso por parte de los parques o proveedores</strong></p>
           <div class="clearfix"></div>
			<hr/>
          <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
           
              <!--end .accordion-section-content-->
          </div>
            <!--end .accordion-section-->
      </div>
        
          <div class="clearfix"></div>
			<hr/>
         
          <div id="featured">
            <h4>CLÁUSULA DE RESPONSABILIDAD ESTABLECIDA 
            POR EVENTOUR SPORT (Decreto 053 de 2002)</h4>
            <h5><strong>EVENTOUR SPORT SE ACOGE A LA SIGUIENTE LEGISLACIÓN:</strong><br>
              <br>
            </h5>
            <ul>
              <li>Ley 17 de 1981 Por el cual se aprueba la convención sobre el comercio internacional de especies amenazadas de fauna y flora.<br>
                </li>
              <li>Ley 397 de 1997 por la cual se dictan normas sobre patrimonio cultural, fomentos y estímulos a la cultura.<br>
                </li>
              <li>Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
                </li>
              <li>Ley 1336 de 2009 Por medio de la cual se adiciona y robustece la Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
                <strong><br>
                EVENTOUR SPORT S.A.S</strong>, con Registro Nacional de Turismo No.16310, se acoge en su totalidad a la Cláusula de Responsabilidad establecida en el Artículo 4 del Decreto 2438 de 2010 y sus posteriores reformas: ¨Responde por la total prestación y calidad de los servicios descritos en el programa, limitando su responsabilidad por casos de fuerza mayor, que puedan ocurrir durante el viaje. En virtud de esta, se reserva el derecho de hacer cambios en el itinerario, fechas de viaje y prestadores de servicio por otros de igual o superior categoría. Nuestra empresa informará y asesorará en la documentación necesaria para el viaje, pero no será responsable por la negación del ingreso a otros países por decisión de sus autoridades. La agencia de viajes no asume responsabilidad alguna por el servicio de transporte aéreo. La prestación de tal servicio se rige por las normas legales aplicables al servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los derechos del usuario y los procedimientos para hacer efectivas las devoluciones de dinero a que estos hechos den lugar, se regirán por las disposiciones legales pertinentes y en particular por las contenidas en el Reglamento Aeronáutico Colombiano. El viajero tendrá derecho al reintegro de servicios no utilizados por fuerza mayor, de acuerdo con la reglamentación establecida por los prestadores de servicios. El viajero deberá cumplir con las normas legales y de salud, restricciones, y será responsable de los objetos que lleve consigo¨.</li>
            </ul>
<p>&nbsp;</p>
<p align="center"><img src="eventour.png"  alt=""/></p>
<p>Ricardo Luna Rivera</p>
<p><strong>Director General</strong></p>
<p align="center"><strong>EVENTOUR SPORT </strong><br>
Avenida 5C Norte 23DN - 35<br>
Cali - Colombia<br>
Tel: (572) 6604000<br>
www.eventoursport.travel </p>
<p align="center"><br>
</p>
          <p></p>
      </div>
         
</div>
		</section>	
		<hr/>
		<footer>
			<p>&copy; 2015 - EventourSport</p>
		</footer>		
		
	</div> <!-- END Wrapper -->
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</body>
</html>