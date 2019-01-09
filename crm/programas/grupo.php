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
setlocale(LC_ALL, 'es_ES');

?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="icon" href="http://www.eventours.travel/wp-content/uploads/2018/04/Eventours-favicon.ico.ico" type="image/x-icon">
	<meta charset="utf-8" />
	<title>Programa completo - EVENTOURSPORT</title>
    <style>
	a, abbr, acronym, address, applet, article, aside, audio,
b, blockquote, big, body,
center, canvas, caption, cite, code, command,
datalist, dd, del, details, dfn, dl, div, dt, 
em, embed,
fieldset, figcaption, figure, font, footer, form, 
h1, h2, h3, h4, h5, h6, header, hgroup, html,
i, iframe, img, ins,
kbd, 
keygen,
label, legend, li, 
meter,
nav,
object, ol, output,
p, pre, progress,
q, 
s, samp, section, small, span, source, strike, strong, sub, sup,
table, tbody, tfoot, thead, th, tr, tdvideo, tt,
u, ul, 
var, h1, h2, h3{
    background: transparent;
    border: 0 none;
    font-size: 100%;
    margin: 0;
    padding: 0;
    vertical-align: baseline; }
	</style>
	<link rel="stylesheet" type="text/css" href="http://eventoursport.travel/crm/programas/reset.css" />
    <?php if($accion == "print"){?>
	<link rel="stylesheet" type="text/css" href="http://eventoursport.travel/crm/programas/style-print.css" />
    <?php }else{ ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="demo.css">
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="http://eventoursport.travel/crm/programas/media-queries.css" />
    
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>
    	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="accordion.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

	
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
    
    
    <!--Start of Tawk.to Script
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ac3f1384b401e45400e5114/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    
    
    <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){
z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='https://v2.zopim.com/?5BDN2o1z1ic34zAekLKGOrc5xgcnkXY0';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zendesk Chat Script-->
</head>

<body id="home">
	<div id="wrapper">
		
		<header>
			<h1><img src="<?php echo "http://eventoursport.travel/crm/imagenes/productos/logo_$plan.jpg" ?>"  alt="" style="float:right;width:200px;margin:10px"/><img src="
            <?php if($producto['unidad_negocio']== "EVENTOS DEPORTIVOS"){
				echo "sport.png";
			}else if($producto['unidad_negocio']== "GRUPOS JUVENILES"){
				echo "student.png";
			}else if($producto['unidad_negocio']== "EVENTOS ESPECIALES"){
				echo "special.png";
			}else{
			echo "nuevologo.png";
			}?>
            "  alt="" width="260" height="152" style="float:left"/></h1>
			<div style="display: table-cell;
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
				    <td valign="top"><strong>Origen</strong></td>
				    <td valign="top"><p align="center"><?php echo $producto['origen']?></p></td>
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
					
					echo "<br><a  href='".$control->urlHoteles($plan)."' target='_blank'>Ver Website";
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr>
				 <tr>
				    <td width="204" valign="top"><p><strong>Valor del Programa</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php $moneda=$producto['MONEDA']; echo $moneda;?> <?php echo number_format(($producto['valor_aereo']+$producto['valor_terrestre']),0,",",".")?></p></td>
		        </tr>
                
			  </table>
			  </div> 
			<!-- END Featured --><!-- END Latest -->
		  <div class="clearfix"></div>
			<hr/>
			<div id="about">
			  <h3 id="grupo">Información General del Programa</h3>
			  <p>&nbsp;</p>
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-1">Servicios Incluidos<br><span style="font-size: 80%">(Click Aquí)</span></a>
			      <div id="accordion-1" class="accordion-section-content"><?php echo $producto['incluye']?></div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
			   <?php if($producto['calendario_pagos'] != ""){ ?>
              
              <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-calen">Valor del Programa<br><span style="font-size: 80%">(Click Aquí)</span></a>
                <div id="accordion-calen" class="accordion-section-content">
              <?php echo $producto['calendario_pagos']; ?>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
               
               <?php } else { ?> <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-2">Valor del Programa<br><span style="font-size: 80%">(Click Aquí)</span></a>
			      <div id="accordion-2" class="accordion-section-content">
			        <table border="1" cellpadding="0" width="514">
			          <tr>
			            <th width="427" valign="top"><p align="center"><strong>VALOR DEL PLAN POR PERSONA</strong></p></th>
			            <th width="81" valign="top"><p align="center"><strong>Valor</strong></p></th>
		              </tr>
			          <tr>
			            <td width="427" valign="top"><p><strong>Porción terrestre</strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_terrestre']?> </strong></p></td>
		              </tr>
			          <tr>
			            <td width="427" valign="top"><p><strong>Tiquete aéreo </strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".$producto['valor_aereo']?> </strong></p></td>
		              </tr>
			          <tr>
			            <td width="427"><p><strong>VALOR TOTAL DEL PROGRAMA</strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo']+$producto['valor_terrestre'])?></strong></p></td>
		              </tr>
		            </table>
			      </div>
			      <!--end .accordion-section-content-->
		        </div>
                
                
			    <!--end .accordion-section-->
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-calen">Calendario de Pagos<br><span style="font-size: 80%">(Click Aquí)</span></a>
              <div id="accordion-calen" class="accordion-section-content"><table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC">CUOTA NO</th>
          <th bgcolor="#CCCCCC">FECHA LIMITE</th>
          <th bgcolor="#CCCCCC">AEREA</th>
          <th bgcolor="#CCCCCC">TERRESTRE</th>
          
        </thead>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado5=$control->consultaCalendarioPagos($plan);
							while ($fi5 = mysql_fetch_array($resultado5, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo "CUOTA ".$fi5['id'];?></td>
        <td><?php echo strftime("%d-%b-%Y",strtotime($fi5['fecha']));?></td>
        <td><?php echo $producto['MONEDA']." ".$fi5['aerea'];?></td>
        <td><?php echo $producto['MONEDA']." ".$fi5['terrestre'];?></td>
        
      </tr>
      <?php } ?>
    </table>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <?php } ?>
                <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-3">Itinerario de Vuelos<br><span style="font-size: 80%">(Click Aquí)</span></a>
			      <div id="accordion-3" class="accordion-section-content"><div style="text-align:center;"><?php echo $producto['itinerario']?></div></div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
		      
			
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-docu">Documentación de Viaje<br><span style="font-size: 80%">(Click Aquí)</span></a>
			      <div id="accordion-docu" class="accordion-section-content"><?php echo $producto['documentacion']?>
			        <!--<p>Descargar Permiso de salida: <a href="https://eventoursport.travel/crm/impresion/pdf/permiso_pdf.php?firma=&programa=<?php echo $producto['id']; ?>">Aqui</a></p>-->
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
		  <h3 id="pagos">Formas de Pago</h3>
          <p>El valor de todos los servicios del Programa, están mencionados en dólares, pero deben ser cancelados en pesos, liquidados a la Tasa Representativa del Mercado (TRM) vigente del día de pago. Sin embargo la Porción Terrestre podrá ser pagada en Dólares en efectivo, si usted elige esta opción remítase a la pestaña que lo indica.</p>
          <p>&nbsp;</p>
          <div class="accordion">
          <?php if(strpos($producto['parametros'],'bancolombia') !== false){?>
      <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pse">Pago Botón PSE BANCOLOMBIA<br><span style="font-size: 80%">(Click Aquí)</span></a>

  <div id="accordion-pse" class="accordion-section-content">
               <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p>&nbsp;</p>
               <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=3617" class="myButton" target="_blank">PAGUE AQUÍ</a></p>
          <p>.</strong></p>
        </div>
              <!--end .accordion-section-content-->
            </div>
            <?php } ?>
            <?php if(strpos($producto['parametros'],'cbancolombia') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-cbancolombia">Consignacion Bancolombia<br><span style="font-size: 80%">(Click Aquí)</span></a>
                          <div id="accordion-cbancolombia" class="accordion-section-content">
                            <p><strong>Numero  de convenio: 56826</strong></p>
                            <p>&nbsp;</p>
                            <p>El banco le solicitará:</p>
                            <p>&nbsp;</p>
                            <p>1) número de documento<br>
                              2) nombre del grupo (colegio)<br>
                            3) nombre del viajero.</p>
                            <p>&nbsp;</p>
                            <p>Cuenta corriente de Bancolombia  No.060-607958-21 a nombre de EVENTOUR SPORT, NIT 900.199.006-3.</p>
                            <p>Enviar soporte de consignación al correo  <a href="mailto:info@eventours.travel">info@eventours.travel</a> . Incluir en el asunto del correo, el nombre del viajero  y el grupo al que pertenece.</p>
                          </div>
              
             
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <?php } ?>
             <?php if(strpos($producto['parametros'],'bancobogota') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pse">Pago Botón PSE BANCO DE BOGOTA<br><span style="font-size: 80%">(Click Aquí)</span></a>

              <div id="accordion-pse" class="accordion-section-content">
               <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p align="center">&nbsp;</p>
          <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898

" class="myButton" target="_blank">PAGUE AQUÍ</a>          </p>
          <p align="center"> </strong></p>
        </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            
            <!--end .accordion-section-->
            
            <?php } ?>
            
             <?php if(strpos($producto['parametros'],'transferenciaUSD') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-transd">Transferencia en Dólares<br><span style="font-size: 80%">(Click Aquí)</span></a>

              <div id="accordion-transd" class="accordion-section-content">
            <p>   Puede efectuar una transferencia en dólares a nuestra cuenta en Miami. La información de la cuenta es la siguiente:</p>
            <p>&nbsp;</p>
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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-cbancobogota">Consignacion Banco de Bogota<br><span style="font-size: 80%">(Click Aquí)</span></a>
                          <div id="accordion-cbancobogota" class="accordion-section-content">
                            <p>Hacer su consignación en cualquier sucursal del Banco de Bogotá en nuestra Cuenta Corriente No. 119 - 1409 - 78 a nombre de EVENTOUR SPORT, NIT 900 199 006 - 3                            </p>
                            <p>Enviar soporte de consignación al correo <a href="mailto:info@eventours.travel">info@eventours.travel</a> . Incluir en el asunto del correo, el nombre del viajero y el grupo al que pertenece.</p>
              </div>
              
             
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <?php } ?>
             <?php if(strpos($producto['parametros'],'tarjetacredito') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-credito">Tarjetas de Crédito<br><span style="font-size: 80%">(Click Aquí)</span></a>
              <div id="accordion-credito" class="accordion-section-content">
                <div>
                  <p>Para pago en Tarjeta de Crédito, MODALIDAD NO PRESENCIAL,  descargue nuestro formato en línea, elabórelo a mano y envíe escaneado con  copia de la cédula del tarjetahabiente a <a href="mailto:info@eventours.travel">info@eventours.travel</a> indicando en el  asunto: Nombre del viajero y Grupo/Colegio.</p>
                  <p>&nbsp;</p>
                  <p> <a href="https://eventoursport.travel/crm/programas/documentos/autorizacion_tc.pdf" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://eventoursport.travel/crm/programas/documentos/autorizacion_tc.pdf&source=gmail&ust=1505666495835000&usg=AFQjCNEHFlDmameArclfEZGSAht8hQ2y_A">DESCARGAR FORMATO</a></p>
                  <p>&nbsp;</p>
                  <p>Por favor diligenciar un formato distinto  por cada concepto, o por cada cargo. </p>
                  <p>&nbsp;</p>
                  <p><strong>IMPORTANTE:</strong></p>
                  <p>*Tiquete aéreo: Este cargo se hará una  sola vez por el valor completo del tiquete, en la fecha de la emisión del  boleto, un mes antes del viaje (no se aceptan pagos parciales)</p>
                  <p>*Los valores indicados en dólares serán  cargados a su tarjeta en Pesos Colombianos, liquidados a la TRM vigente.                </p>
                </div>
                <p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <?php } ?>
            <?php if(strpos($producto['parametros'],'dolaresefectivo') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-dolares">Dólares en Efectivo <br><span style="font-size: 80%">(Click Aquí)</span></a>
              <div id="accordion-dolares" class="accordion-section-content">
                <p>Consigne los dólares en la Cuenta Corriente No. 072-06972-7, del Banco  ITAÚ. Es requisito del banco llevar la relación de los dólares. Utilice el  formato adjunto para su consignación.<strong> </strong><a href="documentos/dolares.pdf" target="_blank">Click aquí para descargar.</a><br>
                    <br>
                    Importante: Es indispensable que por favor nos remita la copia de la  consignación sellada que le entrega el banco, a nuestro correo  <a href="mailto:info@eventours.travel">info@eventours.travel</a> para poder registrar el abono. Favor especificar en el  asunto Nombre Completo del Viajero y grupo, de lo contrario el pago no se vera  reflejado.<br></p>
                <p>&nbsp;</p>
                <p>Para consultar las sucursales ITAÚ haga <u><a href="sucursales_corpbanca.html" target="_blank">click aquí</a></u></p>
              </div>
            </div>
              <?php } ?>
                <?php if(strpos($producto['parametros'],'proexcursion') !== false){?>
                        <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-bono">Pasaporte Proexcursión <br><span style="font-size: 80%">(Click Aquí)</span></a>
                          <div id="accordion-bono" class="accordion-section-content">
                            <p align="center">&nbsp;</p>
                <div>
                  <p>Es muy frecuente que familiares y allegados al viajero, quieran darle a sus hijos, el regalo ideal con motivo de su grado. ¡<strong>Qué mejor regalo que aportar para este plan de viaje! </strong>Y si además ese aporte les da la posibilidad de ganarse a quien lo hace, un plan de viaje para dos personas, con alojamiento, boletas y traslados, para ver jugar a nuestra selección Colombia en el la <strong>COPA AMERICA – BRASIL 2019 </strong><br>
                  <br>
                  En razón a esto EventourS desarrolló esta propuesta, para estimular a esos seres queridos con a vincularse económicamente a título de donación, pagando $ 75.000 por la compra del <strong>PASAPORTE PROEXCURSION</strong>, de los cuales $ 60.000 ingresarán en su nombre como pago del plan de viaje y $ 15.000 a EventourS, como parte de los gastos administrativos y de servicios de viaje del plan de viaje que será entregado a los eventuales favorecidos en el sorteo.</p>
                  <p>&nbsp;</p>
                  <p><a href="documentos/bono_proexcursion.pdf">Consultar Términos y Condiciones</a></p>
                  <p>&nbsp;</p>
                </div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p align="center"><strong><img src="http://eventoursport.travel/crm/programas/pasaporte.jpg"  alt="" width="200px" /></strong></p>
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
            
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t1">Compromisos entre Eventour y el grupo<br><span style="font-size: 80%">(Click Aquí)</span></a>
              <div id="accordion-t1" class="accordion-section-content"><p><strong>Compromisos de EventourS con  el Grupo:</strong></p>
                <p>&nbsp;</p>
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
                <p>&nbsp;</p>
                <p><strong>Compromisos del Grupo con  EventourS:</strong></p>
                <p>&nbsp;</p>
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
                <p><strong><u>&nbsp;</u></strong></p>
<p>&nbsp;</p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section--><!--end .accordion-section-->
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t99">CAMBIOS, CANCELACIONES Y REEMBOLSOS <br><span style="font-size: 80%">(Click Aquí)</span></a>
              <div id="accordion-t99" class="accordion-section-content"><p>Una vez canceladas las cuotas  del plan establecido, los valores no serán reembolsables, salvo en aquellos  casos en donde medie caso fortuito o fuerza mayor, previo a análisis por parte  de la <strong>EventourS</strong><strong>,</strong> de la procedencia de la  solicitud. Toda solicitud de devolución debe realizarse mediante nota escrita  del titular de la factura dirigida a EVENTOUR SPORT, al correo <a href="mailto:info@eventours.travel">info@eventours.travel</a>, explicando los motivos que  inducen a la cancelación, adjuntando los documentos que la sustenten. En caso  de que haya lugar a algún tipo de devolución de dinero, se realizará, en el  momento en el que la aerolínea, el hotel y/o los demás proveedores se  pronuncien sobre el particular. El valor que se ha de reembolsar por concepto  de servicios incluidos en el plan y no utilizados, está sujeto a la aplicación  de los descuentos por penalidades o por gastos administrativos o por cobros de  no show de acuerdo con las condiciones particulares de cancelación de cada  aerolínea, hotel u operador, según sean aplicables.</p>
                <p>En caso de reembolso,  cumpliendo con el contenido del Decreto 2438 de 2010, las partes acuerdan que  la suma del<strong> 20% </strong>del total del valor  del programa, <strong>no será reembolsable</strong>,  ni transferible, ni endosable, <strong>en ningún  caso</strong>, ya que será abonado a gastos administrativos, financieros y de  reservas aéreas y hoteleras.</p>
                <p>En caso de cancelación: </p>
                <p>&nbsp;</p>
                <ul>
                  <li>30 dias antes del viaje no hay lugar a  reembolso.</li>
                  <li>60 dias antes del viaje, reembolsable hasta 50%  del valor total del programa.
                    <ul>
                      <li>90 dias antes del viaje, reembolsable hasta 80%  del valor total del programa.<br>
                        <br>
                      </li>
                    </ul>
                  </li>
                  <li>En caso de no aplicar a reembolso, <strong>EventourS</strong> incluye en este programa un <strong>Seguro de Cancelación Multicausa </strong>que  hace parte de las coberturas del Seguro de viaje <strong>APRIL  Travel Assistance, </strong>que reconocerá al asegurado hasta el  límite contratado y de acuerdo con las 11 causales cubiertas por el seguro. El  viajero podrá consultar las 11 causales que cubren el reembolso de los  servicios terrestres de este programa y sus condiciones, en la sección de  Seguro de Asistencia.</li>
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
              </div>
              <!--end .accordion-section-content-->
            </div>
			  <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t2">Claúsulas de Responsabilidad y Cancelación <br><span style="font-size: 80%">(Click Aquí)</span></a>
                <div id="accordion-t2" class="accordion-section-content"><p>&nbsp;</p>

<ol>
	   <li><strong>EVENTOUR SPORT, </strong>con Registro Nacional de Turismo vigente No.  16310, en su calidad de agente de viajes y turismo y sus operadores en el  destino, organizadores de este programa, declaramos explícitamente que actuamos  como intermediarios entre los pasajeros, por una parte, y las entidades  llamadas a proporcionar los servicios descritos en los diferentes itinerarios,  por la otra parte, responsabilizándonos del cumplimiento de los servicios  mencionados en este programa. </li>
       <li><strong>EVENTOUR SPORT </strong>y sus operadores tienen la prerrogativa de  hacer cambios en el itinerario, fecha de viaje, hoteles, transporte y los demás  servicios, por otros de igual o superior categoría, que sean necesarios para  garantizar el éxito de la excursión, en casos particulares en los que, por  causa del hotel y operadores turísticos, se presenten fallas en la prestación  del servicio.</li>
       <li><strong>EVENTOUR SPORT </strong>y sus operadores, declinan toda  responsabilidad y gastos extras por retrasos, huelgas, terremotos, huracanes,  avalanchas o demás causas de fuerza mayor, así como cualquier pérdida, daño,  accidente o irregularidad que pudiera ocurrir a los pasajeros y sus  pertenencias, cuando estos sean motivados por terceros, y por tanto ajenos al  control del Operador y sus afiliados. Igualmente quedamos exentos de cualquier perjuicio  por modificación o retraso en los itinerarios aéreos que se incluyan en los  diferentes programas.</li>
       <li><strong>EVENTOUR SPORT </strong>no asume responsabilidad alguna frente al  usuario o viajero por el servicio de transporte aéreo, salvo que se trate de  vuelos fletados y de acuerdo con lo especificado en el contrato de transporte.  La prestación de tal servicio se rige por las normas legales aplicables al  servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones  imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los  derechos del usuario y los procedimientos para hacer efectivas las devoluciones  de dinero a que estos hechos den lugar, se regirán por las disposiciones  legales pertinentes y en particular por las contenidas en el Reglamento  Aeronáutico Colombiano (RAC). Cuando en razón a la tarifa o por cualquier otro  motivo existan restricciones para efectuar modificaciones a la reserva aérea,  endosos o reembolsos; tales limitaciones deberán ser informadas al usuario.</li>
       <li><strong>EVENTOUR SPORT </strong>y/o la Aerolínea no podrán ser demandados por  retrasos o cancelaciones de vuelos debido a fenómenos de la naturaleza, o a  cualquier otra causa fuera del control nuestro.</li>
       <li>Favor tener en cuenta que tanto las tasas de  combustible, aeropuertos e impuestos gubernamentales pueden sufrir ajustes,  antes de la emisión de los tiquetes  electrónicos o de la  utilización del alojamiento en los hoteles. En este caso los viajeros estarán  obligados a cubrir la diferencia</li>
       <li><strong>De los Tiquetes Aéreos: </strong>El valor del tiquete está compuesto por la tarifa aérea y el valor de  los impuestos de Combustible (Q), IVA, tasas de salida de cada territorio,  tasas de aeropuertos, de turismo, Fees administrativos, y algunos otros de  acuerdo a cada país. Estos pueden variar con las legislaciones de esos países  que se visiten, por lo tanto el valor de estos impuestos pueden sufrir  variaciones y sus precios solo se garantizaran con la expedición definitiva de  todos los tiquetes del grupo,  cuya expedición se efectuará en una sola fecha para todos, como lo estipulan las aerolíneas en las tarifas  para grupos. Los tiquetes del grupo solo podrán ser expedidos por <strong>EVENTOUR SPORT </strong>de acuerdo a las  cláusulas del convenio firmado con la aerolínea en el momento de cotizar y  confirmar el grupo.</li>
       <li>Las tarifas de este grupo tienen un precio y  condiciones especiales, por lo tanto no pueden combinarse con otras promociones  o beneficios, tales como tiquetes de millas, etc. y solo podrán ser expedidos  por <strong>EVENTOUR SPORT. </strong></li></ol>
</div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
          </div>
          <p>&nbsp;</p>
          <div class="clearfix"></div>
            <?php if(strpos($producto['parametros'],'sinasistencia') === false){?>
          <h3 id="seguro">Seguro de Asistencia</h3>
          <p>&nbsp;</p>
          <div class="accordion">
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-asis">APRIL Assistance <br><span style="font-size: 80%">(Click Aquí)</span></a>
              <div id="accordion-asis" class="accordion-section-content">
                <p><strong> <u></u></strong></p>
                <p><strong>APRIL TRAVEL ASSISTANCE</strong> esta presente en 37 países, cuenta con más de 45 compañías dedicadas a múltiples ramas de la industria de los seguros y servicios de asistencia. APRIL asesora, diseña, gestiona y comercializa pólizas a través de una estrategia multicanal. Es el Corredor de Seguros mayorista No. 1 en Francia  (Propiedades y Accidentes).<u></u><u></u></p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
               <p>
				   <?php 
				   $asistencia=$control->datosAsistencia($producto['asistencia_id']);
				   $files = glob("../documentos_asistencia/".str_replace(" ","_",$asistencia['nombre']).".*"); // Will find 2.txt, 2.php, 2.gif

// Process through each file in the list
// and output its extension
if (count($files) > 0)
foreach ($files as $file)
 {
    $info = pathinfo($file);
	
	?>
    <a href="<?php echo "http://eventoursport.travel/crm/documentos_asistencia/". str_replace(" ","_",$asistencia['nombre']).".".$info["extension"] ?>" target="_blank" class="myButton">CONSULTAR COBERTURA</a>
    <?
   // echo "File found: extension ".$info["extension"]."<br>";
 }
								
								
								?>
				   
				   
				   
				   </p>
                <p>&nbsp;</p>
               <?php if($producto['id']!= 1) {?><p><strong>SEGURO DE CANCELACIÓN MULTICAUSA</strong></p>
                </strong>                </p>
                <p><u></u> <u></u></p>
                <p>El Seguro de Cancelación Multicausa, ampara hasta el límite asegurado y claramente establecido en la caratula de la póliza, los gastos adicionales en que incurra el Asegurado, como consecuencia de la cancelación, reprogramación o interrupción de su viaje y de acuerdo a las 11 causales o eventos cubiertos, siempre y cuando hayan sido reportados y su programación esté dentro de las fechas de vigencia. Consulte las 11 causales cubiertas y las condiciones del producto</p>
                <p>&nbsp;</p>
                <p> <u><a href="http://eventoursport.travel/crm/programas/seguro_cancelacion.pdf" class="myButton" target="_blank">CONSULTAR COBERTURA</a></u></p>
                <p>&nbsp;</p>
             <?php } ?>
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
          <p>&nbsp;Cancún, Q.R., Méxicoi</p>
          <p>&nbsp;Tel 52 998 1405258</p>
          <p>&nbsp;</p>
          <p><strong>&nbsp;Hospital Americano</strong></p>
          <p>&nbsp;Viento Retorno 1 15, 4, 77500 Cancún, Q.R., México</p>
          <p>
            <?php } ?>
          </p>
          <!--<p><strong>VIAJEROS CON CONDICION  MEDICA ESPECIAL</strong></p>
          <p>&nbsp;</p>
          <p><strong>Si  el viajero tiene alguna condición o alimentación especial, diligenciar el  formato adjunto y enviarlo escaneado al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a>, <a href="documentos/asistencia_medica.pdf">click aqui</a> para descargar el formato</strong></p>-->
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
          <?php } ?>
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
EVENTOUR SPORT S.A.S</strong>,  con Registro Nacional de Turismo No.16310, se acoge en su totalidad a la Cláusula de Responsabilidad establecida en el Artículo 4 del Decreto 2438 de 2010 y sus posteriores reformas. Responde por la total prestación y calidad de los servicios descritos en el programa, limitando su responsabilidad por casos de fuerza mayor entiendase como: circunstancia que, por no poder ser prevista o evitada, imposibilita absolutamente al cumplimiento de dicha obligación, que puedan ocurrir durante el viaje. En virtud de esta, se reserva el derecho de hacer cambios en el itinerario, fechas de viaje y prestadores de servicio por otros de igual o superior categoría. Nuestra empresa informará y asesorará en la documentación necesaria para el viaje, pero no será responsable por la negación del ingreso a otros países por decisión de sus autoridades. La agencia de viajes no asume responsabilidad alguna por el servicio de transporte aéreo. La prestación de tal servicio se rige por las normas legales aplicables al servicio de transporte aéreo. Los eventos tales como retrasos o modificaciones imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los derechos del usuario y los procedimientos para hacer efectivas las devoluciones de dinero a que estos hechos den lugar, se regirán por las disposiciones legales pertinentes y en particular por las contenidas en el Reglamento Aeronáutico Colombiano. El viajero tendrá derecho al reintegro de servicios no utilizados por fuerza mayor, de acuerdo con la reglamentación establecida por los prestadores de servicios. El viajero deberá cumplir con las normas legales y de salud, restricciones, y será responsable de los objetos que lleve consigo.
 
EVENTOUR SPORT S.A.S. Rechaza la explotación, la pornografía, el turismo sexual y demás formas de abuso sexual con menores, como establece la Resolución 3840 de 2009; Cumple la Ley 17 de 1981 y Resolución 1367 de 2000 contra la comercialización y tráfico de especies de fauna y flora silvestre; Rechaza la comercialización y tráfico ilegal de bienes culturales regionales y nacionales, Ley 103 de 1991; Protege los espacios libres de humo según lo estipulado en la Ley 1335 de 2009; Rechaza la discriminación o actos de racismo a la población vulnerable; Implementa Sistema Integrado de Gestión según la normatividad establecida para la sostenibilidad, la seguridad y salud en el trabajo y la seguridad de datos personales en la Resolución 3860 de 2015, el Decreto 1072 de 2015 y la  Ley 1581 de 2012.
 
Los datos personales que se han recogido por medio de este canal serán tratados de conformidad con lo establecido en la Ley 1581 2012. 
 
Le invitamos a realizar consumo consciente de los recursos materiales y naturales.</p>
<p>&nbsp;</p>

<!--<img src="<?php echo $cliente['firma']; ?>" width="30%"/>-->
			  <div>  
              <p>&nbsp;</p>
              <p align="center">
				  <script>
					  function verificarFirma(){
						 if(document.getElementById('checkbox').checked){
							 document.getElementById('firma').style.visibility='visible';
						 }else{
							 document.getElementById('firma').style.visibility='hidden';
						 }
					  }
				  </script>
                <input type="checkbox" name="checkbox" id="checkbox" onChange="verificarFirma()" >
He leido y Acepto el contenido del presente programa<br>
El hecho de inscribirme y pagar la primera cuota es la condicion tácita e implicita de que acepto todos los terminos y condiciones del programa<br>
</br></br>
<div style="visibility: hidden;width: 200px;margin: 0 auto;" id="firma">
<a href="https://eventoursport.travel/crm/registro.php?plan=<?php echo $plan?>" target="_blank" class="myButton">REGÍSTRESE AQUÍ</a></p>
</div>
              <p align="center">&nbsp;</p>
          </div>
<p align="center">
	
	<img src="http://www.eventours.travel/wp-content/uploads/2018/03/EventourS-Logo-300x107.png"  alt=""/></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF">
  <tr>
    <td align="left"><p align="left">
      <?php if($producto['unidad_negocio'] != "GRUPOS JUVENILES"){ ?>
      <strong>Maria Alejandra Moreno Quintero</strong><br>
      Jefe UN Especiales<br>
    </p>
      <?php }else{ ?>
      <strong>Catalina Kafury Ramirez</strong><br>
      Jefe UN JUVENIL<br>
      </p>
      <p></p>
      <?php } ?></td>
    <td align="right"><p align="right"><strong>Ricardo Luna Rivera<br>
    </strong>Director General</p></td>
  </tr>
</table>
<p align="center"><strong>EVENTOURS </strong><br>
  Avenida 5C Norte 23DN - 35<br>
  Cali - Colombia<br>
  Tel: (572) 6604000 - Celular: 320 677 9116<br>
  www.eventours.travel </p>
<p align="center">&nbsp;</p>
<p align="center"><div style="font-size:3em; color:#00538C;width:200px;margin: 0 auto;text-align:center"><a href="https://www.facebook.com/eventours.travel/" target="_blank"><i class="fab fa-facebook"></i></a>
<a href="https://www.instagram.com/eventours.travel/" target="_blank"><i class="fab fa-instagram"></i></a>
<a href="https://www.youtube.com/channel/UC6sFctsVRIkgfRtX2qsdDvw" target="_blank"><i class="fab fa-youtube"></i></a></div></p>
<p align="center"><br>
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
    <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
    <script type="text/javascript" src="https://cdn.trustedsite.com/js/1.js" async></script>
</body>
</html>