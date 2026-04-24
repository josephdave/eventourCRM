<?php 

$plan=$_REQUEST['plan'];

require_once("../control/control.php");

$control = new Control();

$producto=$control->datosProducto($plan);

$accion=$_REQUEST['accion'];

$firma =$_REQUEST['firma'];

if(isset($firma)){
	$cliente = $control->datosViajero($firma);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Programa completo - EVENTOURSPORT</title>
	<link rel="stylesheet" type="text/css" href="reset.css" /> 
    <?php if($accion == "print"){?>
	<link rel="stylesheet" type="text/css" href="style-print.css" />
    <?php }else{ ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="demo.css">
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="media-queries.css" />
    
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="accordion.js"></script>


	
    <style>
	OL { counter-reset: item }
OL LI { display: block }
OL LI:before { content: counters(item, ".") " "; counter-increment: item;
font-weight: bold;}
	</style>
	
	
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
			<h1><a href="index.html"><img src="eventour.png"  alt="" style="float:right"/></a><img src="<?php echo "../imagenes/productos/logo_$plan.jpg" ?>"  alt="" style="float:left;width:120px;margin:10px"/></h1><div style="display: table-cell;
    vertical-align: middle;    height: 126px;">
			<h1 style="font-size:190%"><?php 
			$salida = new DateTime($producto['f_salida']);
			echo ucwords( strtolower($producto['grupo']))." ".$salida->format("Y");?></h1>
            
			<h2>Programa  de viaje </h2>
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
			  <table width="100%" border="1" cellpadding="0">
			    <tr>
				    <th colspan="2"><p align="center"><strong>INFORMACIÓN DEL GRUPO</strong></p></th>
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
					
					
					echo "del ".$salida->format("j")." de ".$meses[$salida->format("n")]." al ".$llegada->format("j")." de ".$meses[$llegada->format("n")]." de ".$llegada->format("Y")?></p></td>
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
				    <td width="463" valign="top"><p align="center"><?php echo $control->nombreHoteles($plan);
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Valor del Programa</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php $moneda=$producto['MONEDA']; echo $moneda;?> <?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></p></td>
			      </tr>
			  </table>
			 <div id="noprint">  <p><a href="#"></a>Uno de los aspectos más  importantes en este proceso es contar con la&nbsp;información&nbsp;personal  necesaria de los viajeros y sus padres o acudientes. Estos datos se utilizarán  para enviarles boletines periódicos con información sobre los avances de la  excursión, y además llevar un estricto control de la documentación de viaje,  pagos, saldos, etc. Por este motivo se requiere un registro claro y  completo, de la información de cada participante. Por favor para regístrala,  haga un clic en el siguiente boton:</p>
              <p>&nbsp;</p>
              <p align="center"><a href="https://eventoursport.travel/crm/registro.php?plan=<?php echo $plan?>" target="_blank" class="myButton">Inscripción al viaje </a></p>
              <p align="center">&nbsp;</p>
              <p align="center" style="font-size:80%">Siguiendo los lineamientos de nuestra política interna y nuestra filosofía sobre el manejo y tratamiento de información personal, queremos ratificar que sus datos personales son tratados de forma privada y confidencial y que, por tanto, garantizamos la seguridad y confidencialidad de su información a través de un almacenamiento seguro que impide el acceso a terceras personas ajenas a nuestra organización empresarial.</p>
              <p align="center">&nbsp;</p>
          </div></div> 
			<!-- END Featured --><!-- END Latest -->
		  <div class="clearfix"></div>
			<hr/>
			<div id="about">
			  <h3 id="grupo">Información General del Programa</h3>
			  <p>&nbsp;</p>
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-1">Servicios Incluidos</a>
			      <div id="accordion-1" class="accordion-section-content"><?php echo $producto['incluye']?></div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-2">Valor del Programa</a>
			      <div id="accordion-2" class="accordion-section-content">
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
			      </div>
			      <!--end .accordion-section-content-->
		        </div>
                
                
			    <!--end .accordion-section-->
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-calen">Calendario de Pagos</a>
              <div id="accordion-calen" class="accordion-section-content"><?php echo $producto['calendariopagos']?>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
                <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-3">Itinerario de Vuelos</a>
			      <div id="accordion-3" class="accordion-section-content"><div style="text-align:center;"><?php echo $producto['itinerario']?></div></div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
		      
			
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-docu">Documentación de Viaje</a>
			      <div id="accordion-docu" class="accordion-section-content"><?php echo $producto['documentacion']?></div>
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
		  <h3 id="pagos">Formas de Pago</h3>
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
               <p>El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p align="center">&nbsp;</p>
          <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898

" class="myButton" target="_blank">Pago PSE</a></p>
               <p align="center"></p>
               <p>Si tiene dificultades utilice la siguiente ruta: </p>
          <p>1. Ingrese a la web del Banco de Bogotá: https://www.bancodebogota.com/wps/portal/banco-bogota/home# <br>
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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-credito">Tarjetas de Crédito</a>
              <div id="accordion-credito" class="accordion-section-content">
                <p>Puede pagar todos los servicios con tarjeta de crédito, liquidada a la TRM vigente, incluido el valor del fee bancario. </p>
                <p>&nbsp;</p>
                <p>Hemos diseñado una modalidad de pago no presencial para la cual solicitamos diligenciar nuestro<a href="documentos/autorizacion_tc.pdf" target="_blank">formato de autorización de cargo a su tarjeta clic aqí</a>  para descargar, el cual se debe elaborar a mano y enviar copia escaneada con fotocopia de tarjetahabiente. <br>
                  Si usted va a realizar el pago tanto de porción terrestre como tiquete, le solicitamos diligenciar un formato distinto para cada concepto. Enviar copia a nuestro correo info@eventoursport.com. Favor incluir en el asunto Nombre del Viajero y Colegio para poder registrar el abono.</p>
                <p>&nbsp;</p>
                <p>Importante: Los valores indicados en dólares serán cargados a su tarjeta en Pesos Colombianos, liquidados a la TRM vigente.</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-dolares">Dólares en Efectivo</a>
              <div id="accordion-dolares" class="accordion-section-content">
                <p><strong>El pago de dólares en efectivo aplica únicamente para el valor de la Porción Terrestre.</strong> Si elige esta opción, consigne los dólares en nuestra cuenta Corriente  No. 072-06972-7, del Banco CORPBANCA. Es requisito del banco llevar la relación de los dólares. Recuerde que debe sumar el 2% del fee bancario si no esta incluido en el valor de la porción terrestre.  Utilice el formato adjunto para su consignación. <a href="documentos/dolares.pdf" target="_blank">Click aquí para descargar.</a></p>
                <p>&nbsp;</p>
                <p>Importante: Es indispensable que por favor nos remita la copia de la consignación sellada que le entrega el banco, a nuestro correo info@eventoursport.com para poder registrar el abono. Favor especificar en el asunto Nombre Completo del Viajero y Colegio, de lo contrario el pago no se vera reflejado.</p>
                <p><strong>Sucursales CORPBANCA</strong></p>
                <div></div>
                
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center"><strong>CIUDAD<u></u><u></u></strong></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center"><strong>SUCURSAL<u></u><u></u></strong></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center"><strong>DIRECCION<u></u><u></u></strong></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Avenida Uribe<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Avenida Uribe Cra 1a # 24-96<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Banca Preferente Cali<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Calle 7 Oeste # 2-22 Segundo Piso<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Cali Principal<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Cra 5 # 8 - 69<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Chipichape<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Avenida 6N # 38-114<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Cosmocentro<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Calle 6a # 50 - 80. L-28<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Pance<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Carrera 122 # 18 - 99<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Santa Monica<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Avenida 6a # 25N - 24<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Santa Teresita<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Carrera 1A Oeste # 6 -86<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Unicentro Cali<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Carrera 100 # 5 - 169/331. Local 282<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">CALI<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Universidad Javeriana Cali<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Calle 18 # 118 - 250. Edificio Almendros<u></u><u></u></p></td>
                      </tr>
                      <tr>
                        <td width="59" nowrap="" valign="bottom"><p align="center">PEREIRA<u></u><u></u></p></td>
                        <td width="139" nowrap="" valign="bottom"><p align="center">Pereira Centro<u></u><u></u></p></td>
                        <td width="216" nowrap="" valign="bottom"><p align="center">Calle 17 # 6 -54<u></u><u></u></p></td>
                      </tr>
                    </tbody>
                  </table>
                
              
                <br>
                <p>&nbsp;</p>
              </div>
                    </div>
             
                <?php if(strpos($producto['parametros'],'proexcursion') !== false){?>
                        <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-bono">Pasaporte Proexcursión</a>
                          <div id="accordion-bono" class="accordion-section-content">
                <p align="center"><strong><img src="pasaporte.jpg"  alt=""/></strong></p>
                <p>Es muy frecuente que familiares y allegados al viajero, quieran darle a sus hijos, el regalo ideal con motivo de su grado. ¡Qué mejor regalo que aportar para este plan de viaje! Y si además ese aporte les da la posibilidad de ganarse a quien lo hace, un plan de viaje para dos personas, con tiquetes, alojamiento, boletas y traslados, para ver jugar a nuestra selección Colombia en Barranquilla o en otro país, en su camino para clasificar al mundial de futbol RUSIA 2.018… maravilloso. </p>
                <p>En razón a esto Eventour Sport desarrolló esta propuesta, para estimular a esos seres queridos con a vincularse económicamente a título de donación, pagando $ 60.000 por la compra del PASAPORTE PROEXCURSION, de los cuales $ 50.000 ingresarán en su nombre como pago del plan de viaje y $ 10.000 a Eventour, como parte de los gastos administrativos y de servicios de viaje del plan de viaje que será entregado a los eventuales favorecidos en el sorteo.</p>
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
            
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t1">Compromisos entre Eventour y el grupo</a>
              <div id="accordion-t1" class="accordion-section-content"><?php echo $producto['compromisos']?>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section--><!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t2">Claúsulas de Responsabilidad y Cancelación</a>
              <div id="accordion-t2" class="accordion-section-content"><?php echo $producto['terminoscondiciones']?>
<p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
          </div>
          <p>&nbsp;</p>
          <div class="clearfix"></div>
          <h3 id="seguro">Seguro de Asistencia APRIL</h3>
          <p>&nbsp;</p>
          <div class="accordion">
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-asis">Cobertura de la Asistencia</a>
              <div id="accordion-asis" class="accordion-section-content">
                <table cellspacing="0" cellpadding="0">
                  <col width="336">
                  <col width="274">
                  <thead>
                    <th width="336">Detalle    Beneficios y Coberturas </th>
                    <th width="274">Eventour Sport    Inclusión 100.000 </th>
                  </thead>
                  <tr>
                    <td width="336">Asistencia Médica en Caso de enfermedad </td>
                    <td width="274">100.000    USD </td>
                  </tr>
                  <tr>
                    <td width="336">Asistencia Médica en Caso de Accidente </td>
                    <td width="274">50,000    USD </td>
                  </tr>
                  <tr>
                    <td width="336">Medicamentos de internación o Ambulatorio</td>
                    <td width="274">400    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Asistencia Médica en Caso de Preexistencia*</td>
                    <td width="274">150    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Odontología de Urgencia</td>
                    <td width="274">150    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Repatriación Sanitaria</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Repatriación Funeraria</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Traslado de un familiar por Hospitalización del beneficiario</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Días Complementarios por internación</td>
                    <td width="274">3    días</td>
                  </tr>
                  <tr>
                    <td width="336">Seguro de accidentes personales-muerte accidental en transporte    Público</td>
                    <td width="274">60.000    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Compensación por pérdida de equipaje suplementario</td>
                    <td width="274">500    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Anticipo de fondos para fianza</td>
                    <td width="274">12.000    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Transferencia de Fondos</td>
                    <td width="274">2.000    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Asistencia Legal en caso de accidente</td>
                    <td width="274">1.000    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Localización de Equipaje</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Asistencia en caso de extravió de documentos</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Acompañamiento de Menores</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Viaje de Regreso por enfermedad del titular</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Transmisión de mensajes Urgentes</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Línea de consulta 24 horas</td>
                    <td width="274">INCLUIDO</td>
                  </tr>
                  <tr>
                    <td width="336">Cúmulo por evento, accidente con múltiples titulares a prorrata</td>
                    <td width="274">300.000    USD</td>
                  </tr>
                  <tr>
                    <td width="336">Cancelación de Viaje Multicausa </td>
                    <td width="274">2.000    USD </td>
                  </tr>
                  <tr>
                    <td width="336">Límite de Edad</td>
                    <td width="274">50    AÑOS</td>
                  </tr>
                  <tr>
                    <td width="336">Ámbito de cobertura *incluido dentro del ámbito de asistencia    médica </td>
                    <td width="274">INTERNACIONAL </td>
                  </tr>
                </table>
                <p>Cancelación Multicausa</p>
                <table cellspacing="0" cellpadding="0">
                  <col width="336">
                  <thead>
                    <th width="336">Causas    Cubiertas</th>
                  </thead>
                  <tr>
                    <td width="336">1. Fallecimiento    del asegurado</td>
                  </tr>
                  <tr>
                    <td width="336">2. Incapacidad    total o temporal por enfermedad o accidente del beneficiario</td>
                  </tr>
                  <tr>
                    <td width="336">3. Fallecimiento    o incapacidad total temporal o incapacidad total de familiar</td>
                  </tr>
                  <tr>
                    <td width="336">4. Desastres    naturales</td>
                  </tr>
                  <tr>
                    <td width="336">5. Haber sido    designado jurado de votación o citado a un juzgado</td>
                  </tr>
                  <tr>
                    <td width="336">6. Requerimiento    legal antes del viaje</td>
                  </tr>
                  <tr>
                    <td width="336">7. Perdida de    documentos que imposibiliten viajar a beneficiario y/o acompañante</td>
                  </tr>
                  <tr>
                    <td width="336">8. Afectación de    la vivienda o empresa del asegurado</td>
                  </tr>
                  <tr>
                    <td width="336">9. Cancelación de    boda del (los) asegurado (s)</td>
                  </tr>
                  <tr>
                    <td width="336">10. Despido    laboral del asegurado</td>
                  </tr>
                  <tr>
                    <td width="336">11. Cambio de    trabajo del asegurado</td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p align="center"><a href="documentos/asistencia_medica.pdf" target="_blank" class="myButton">Formato de autorización</a></p>
                <p>&nbsp;</p>
                <p>A continuación encontrará la lista de los  hospitales y centros médicos de Cancún al cual será remitido el viajero en caso  de emergencia.</p>
                <p align="center">&nbsp;</p>
          <p align="left"><strong>HOSPITALES DE ASISTENCIA<br>
            <br>
            Hospital Amerimed</strong><br>
            Avenida Bonampak S/n, Súper Manzana Siete, 77500 Benito Juárez,<br>
            Q.R., México<br>
            Tel 52 998 8813400<br>
            <strong><br>
            Hospital Playamed Cancún</strong><br>
            Av. Nader Supermanzana 2 manzana 1 lote 13, 77500<br>
            Cancún, Q.R., México<br>
            Tel 52 998 1405258<br>
            <br>
            <strong>Hospital Americano</strong><br>
            Viento Retorno 1 15, 4, 77500 Cancún, Q.R., México<br>
            Tel 52 998 2878023<br>
          </p>
          <p align="center"></p>
          <p>&nbsp;</p>
          
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section
           <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-any">Seguro de Cancelacion ANY REASON</a>
              <div id="accordion-any" class="accordion-section-content">
               <p>El seguro de cancelación ANY REASON tiene como  propósito ofrecer al viajero un seguro para la perdida irrecuperable de  depósitos o gastos pagados por anticipado de acuerdo a las condiciones  generales del contrato por un total de USD60.  <strong>Debe ser adquirido en la primera cuota</strong> (<a href="documentos/any_reason.pdf" target="_blank">Clic para consultar términos y condiciones especiales</a>)<br>
                 <strong>VALOR: USD 60</strong><br>
                <strong>Tarifas sujetas a cambio  sin previo aviso por parte de los parques o proveedores</strong></p>
           <div class="clearfix"></div>
			<hr/>
          <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content
            </div>-->
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
          <p><strong>EVENTOUR SPORT SE ACOGE A LA SIGUIENTE LEGISLACIÓN:</strong><br>
            <br>
Ley 17 de 1981 Por el cual se aprueba la convención sobre el comercio internacional de especies amenazadas de fauna y flora.<br>
Ley 397 de 1997 por la cual se dictan normas sobre patrimonio cultural, fomentos y estímulos a la cultura.<br>
Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
Ley 1336 de 2009 Por medio de la cual se adiciona y robustece la Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
<strong><br>
EVENTOUR SPORT S.A.S</strong>, con Registro Nacional de Turismo No.16310, se acoge en su totalidad a la Cláusula de Responsabilidad establecida en el Artículo 4 del Decreto 2438 de 2010 y sus posteriores reformas: ¨Responde por la total prestación y calidad de los servicios descritos en el programa, limitando su responsabilidad por casos de fuerza mayor, que puedan ocurrir durante el viaje. En virtud de esta, se reserva el derecho de hacer cambios en el itinerario, fechas de viaje y prestadores de servicio por otros de igual o superior categoría. Nuestra empresa informará y asesorará en la documentación necesaria para el viaje, pero no será responsable por la negación del ingreso a otros países por decisión de sus autoridades. La agencia de viajes no asume responsabilidad alguna por el servicio de transporte aéreo. La prestación de tal servicio se rige por las normas legales aplicables al servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los derechos del usuario y los procedimientos para hacer efectivas las devoluciones de dinero a que estos hechos den lugar, se regirán por las disposiciones legales pertinentes y en particular por las contenidas en el Reglamento Aeronáutico Colombiano. El viajero tendrá derecho al reintegro de servicios no utilizados por fuerza mayor, de acuerdo con la reglamentación establecida por los prestadores de servicios. El viajero deberá cumplir con las normas legales y de salud, restricciones, y será responsable de los objetos que lleve consigo¨.</p>
<p>&nbsp;</p>

<img src="<?php echo $cliente['firma']; ?>" width="30%"/>
<p align="center"><img src="eventour.png"  alt=""/></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF">
  <tr>
    <td align="left"><p align="left"><strong>Maria Paula Luna Stapel</strong><br>
      Jefe UN JUVENIL<br>
    </p>
      <p></p></td>
    <td align="right"><p align="right"><strong>Ricardo Luna Rivera<br>
    </strong>Director General</p></td>
  </tr>
</table>
<p align="center"><strong>EVENTOUR SPORT </strong><br>
Avenida 5C Norte 23DN - 35<br>
Cali - Colombia<br>
Tel: (572) 6604000 - Celular: 320 677 9116<br>
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