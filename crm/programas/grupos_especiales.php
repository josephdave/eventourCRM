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
<link rel="icon" href="http://www.eventours.travel/wp-content/uploads/2018/04/Eventours-favicon.ico.ico" type="image/x-icon">


<!--Start of Tawk.to Script-->
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
</head>

<body id="home">
	<div id="wrapper">
		
		<header>
			<h1><img src="
            <?php if($producto['unidad_negocio']== "EVENTOS DEPORTIVOS"){
				echo "sport.png";
			}else if($producto['unidad_negocio']== "GRUPOS JUVENILES"){
				echo "student.png";
			}else if($producto['unidad_negocio']== "EVENTOS ESPECIALES"){
				echo "special.png";
			}else{
			echo "nuevologo.png";
			}?>
            "  alt="" width="260" height="152" style="float:right"/>
              <?php if(file_exists("../imagenes/productos/logo_".$plan.".jpg")){?><img src="http://eventoursport.travel/crm/imagenes/productos/logo_<?php echo $plan ?>.jpg"  alt="" width="150" style="float:left;width:120px;margin:10px"/><?php } else{?>
                                <img src="../imagenes/productos/nologo.jpg" width="150" height="150"  alt="" style="float:left;width:120px;margin:10px"/>
                                <?php } ?>
            
          </h1><div style="display: table-cell;
    vertical-align: middle;    height: 126px;">
			<h1 style="font-size:190%;text-transform:uppercase;"><?php 
			$salida = new DateTime($producto['f_salida']);
			echo ucwords( strtoupper($producto['grupo']))." ".$salida->format("Y");?></h1>
            
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
				    <td valign="top"><p><strong>Origen</strong></p></td>
				    <td valign="top"><p align="center"><?php echo $producto['origen']?></p></td>
			    </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Destino</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php echo $producto['destino']?></p></td>
			      </tr>
				  <tr>
				    <td width="204" valign="top"><p><strong>Tiempo de Estancia</strong></p></td>
				    <td width="463" valign="top"><p align="center">
						<?php if($producto['id']== 183){echo "12 dias - 10 noches";}else{
						?><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches<?php }?></p></td>
			      </tr>
                  <?php $hot=$control->nombreHoteles($plan);
				  if($hot!=""){?>
				  <tr>
				    <td width="204" valign="top"><p><strong>Nombre del Hotel</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php echo $control->nombreHoteles($plan);
					
					echo "<br><a  href='".$control->urlHoteles($plan)."' target='_blank'>Ver Website";
					
					$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?><br>
				    </p></td>
			      </tr>
				  <?php } ?>
                 <?php  if($producto['nombre_tarifa2'] == ""){?>
                 <tr><?php 		$valor_terrestre=$producto['valor_terrestre'];					$valor_aereo=$producto['valor_aereo'];
				 ?>
				    <td width="204" valign="top"><p><strong>Valor del Programa</strong></p></td>
				    <td width="463" valign="top"><p align="center"><?php $moneda=$producto['MONEDA']; echo $moneda;?> <?php echo number_format(($producto['valor_aereo']+$producto['valor_terrestre']),0,".",".")?></p></td>
		        </tr>
                <?php } ?>
			  </table>
			  <div id="noprint">  <p><a href="#"></a>Uno de los aspectos más  importantes en este proceso es contar con la&nbsp;información&nbsp;personal  necesaria de los viajeros. Estos datos se utilizarán  para enviarles boletines periódicos con información sobre los avances del programa, y además llevar un estricto control de la documentación de viaje,  pagos, saldos, etc. Por este motivo se requiere un registro claro y  completo, de la información de cada participante. Por favor para regístrala,  haga un clic en el siguiente boton:</p>
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
			   <?php if($producto['calendario_pagos'] != ""){ ?>
              
              <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-calen">Valor del Programa</a>
                <div id="accordion-calen" class="accordion-section-content">
              <?php echo $producto['calendario_pagos']; ?>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
               
               <?php } else { ?> <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-2">Valor del Programa</a>
			      <div id="accordion-2" class="accordion-section-content">
			        <table border="1" cellpadding="0" width="514">
			          <tr>
			            <th width="427" valign="top"><p align="center"><strong>VALOR DEL PLAN POR PERSONA</strong></p></th>
			            <th width="81" valign="top"><p align="center"><strong> <?php if ($producto['nombre_tarifa1'] != '' && $producto['nombre_tarifa1'] != 'Programa'){ echo $producto['nombre_tarifa1']; }else{ ?>Valor<?php } ?></strong></p></th>
                        <?php if ($producto['nombre_tarifa2'] != '' ){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa2']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa3'] != ''  && strpos($producto['nombre_tarifa3'],"interno") === false){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa3']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa4'] != ''){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa4']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa5'] != '' ){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa5']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa6'] != '' ){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa6']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa7'] != ''){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa7']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa8'] != '' ){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa8']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa9'] != '' ){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa9']; ?></strong></p></th>
                        <?php } ?>
                        <?php if ($producto['nombre_tarifa10'] != '' ){?>
                        <th width="81" valign="top"><p align="center"><strong><?php echo $producto['nombre_tarifa10']; ?></strong></p></th>
                        <?php } ?>
		              </tr>
			          <tr>
			            <td width="427" valign="top"><p><strong>Porción terrestre acomodación doble</strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre'],0,".",".")?> </strong></p></td>
                         <?php if ($producto['nombre_tarifa2'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa2'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                         
                          <?php if ($producto['nombre_tarifa3'] != '' && strpos($producto['nombre_tarifa3'],"interno") === false){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa3'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa4'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa4'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa5'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa5'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa6'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa6'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa7'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa7'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa8'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa8'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa9'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa9'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
                          <?php if ($producto['nombre_tarifa10'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_terrestre_tarifa10'],0,".",".")?> </strong></p></td>                    
                         <?php } ?>
		              </tr>
			          <tr>
			            <td width="427" valign="top"><p><strong>Tiquete aéreo </strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo'],0,".",".")?> </strong></p></td>
                        <?php if ($producto['nombre_tarifa2'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa2'],0,".",".")?> </strong></p></td>
      <?php } ?>   
     
                            <?php if ($producto['nombre_tarifa3'] != '' && strpos($producto['nombre_tarifa3'],"interno") === false){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa3'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa4'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa4'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa5'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa5'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa6'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa6'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa7'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa7'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa8'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa8'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa9'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa9'],0,".",".")?> </strong></p></td>
                         <?php } ?>
                            <?php if ($producto['nombre_tarifa10'] != ''){?>
        <td width="81" valign="top"><p align="right"><strong><?php echo $moneda." ".number_format($producto['valor_aereo_tarifa10'],0,".",".")?> </strong></p></td>
                         <?php } ?>
		              </tr>
			          <tr>
			            <td width="427"><p><strong>VALOR TOTAL DEL PROGRAMA</strong></p></td>
			            <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo number_format(($producto['valor_aereo']+$producto['valor_terrestre']),0,".",".");?></strong></p></td>
                        
                        <?php if ($producto['nombre_tarifa2'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa2']+$producto['valor_terrestre_tarifa2'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa3'] != '' && strpos($producto['nombre_tarifa3'],"interno") === false){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa3']+$producto['valor_terrestre_tarifa3'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa4'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa4']+$producto['valor_terrestre_tarifa4'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa5'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa5']+$producto['valor_terrestre_tarifa5'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa6'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa6']+$producto['valor_terrestre_tarifa6'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa7'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa7']+$producto['valor_terrestre_tarifa7'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa8'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa8']+$producto['valor_terrestre_tarifa8'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa9'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa9']+$producto['valor_terrestre_tarifa9'])?></strong></p></td>                    
                         <?php } ?>
                         <?php if ($producto['nombre_tarifa10'] != ''){?>
       <td width="81" valign="top"><p align="right"><strong><?php $moneda=$producto['MONEDA']; echo $moneda."  ";?> <?php echo ($producto['valor_aereo_tarifa10']+$producto['valor_terrestre_tarifa10'])?></strong></p></td>                    
                         <?php } ?>
                        
		              </tr>
		            </table>
			      </div>
			      <!--end .accordion-section-content-->
		        </div>
                
                
			    <!--end .accordion-section-->
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-calen">Calendario de Pagos</a>
              <div id="accordion-calen" class="accordion-section-content"><table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC">CUOTA NO</th>
          <th bgcolor="#CCCCCC">FECHA LIMITE</th>
          <th bgcolor="#CCCCCC">AEREA</th>
          <th bgcolor="#CCCCCC">TERESTRE</th>
          
        </thead>
      <?php 
							
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
        <td><?php echo $producto['MONEDA']." ".number_format($fi5['aerea'],0,".",".");?></td>
        <?php } ?>
        <?php if($fi5['terrestre']<=1 && $fi5['terrestre']!=0){?>
		<td><?php echo " ".($fi5['terrestre']*100)."%";?></td>
        <?php }else if($fi5['terrestre'] == 0){?>
        <td>0</td>
		<?php }else{?>
        <td><?php echo $producto['MONEDA']." ".number_format($fi5['terrestre'],0,".",".");?></td>
        <?php } ?>
      </tr>
      <?php } ?>
    </table>
                <p align="center"> </strong></p>
              </div>
              <!--end .accordion-section-content-->
            </div>
            <?php } ?>
                <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-3">Itinerario de Vuelos</a>
			      <div id="accordion-3" class="accordion-section-content"><div style="text-align:center;"><?php echo $producto['itinerario']?></div></div>
			      <!--end .accordion-section-content-->
		        </div>
			    <!--end .accordion-section-->
		      
			
			  <div class="accordion">
			    <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-docu">Documentación de Viaje</a>
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
          <p><strong>Tiquete Aéreo</strong>: el tiquete aéreo al ser emitido en Colombia, se debe pagar en pesos colombianos; en programas internacionales, en los cuales el valor del tiquete es tarifado en dólares, se debe liquidar al valor de la Tasa Representativa del Mercado (TRM) vigente el día del pago.<u></u><u></u></p>
          <p><u></u><u></u></p>
          <p><strong>Porción Terrestre</strong>: el valor de los servicios terrestres tarifados en dólares, se puede pagar en pesos colombianos liquidados a la Tasa Representativa del Mercado (TRM) vigente el día de pago o en dólares.</p>
          <p>&nbsp;</p>
          <div class="accordion">
          <?php if(strpos($producto['parametros'],'bancolombia') !== false){?>
      <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pse">Pago Botón PSE BANCOLOMBIA</a>

  <div id="accordion-pse" class="accordion-section-content">
               <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p>&nbsp;</p>
               <p align="center"><a href="http://www.grupobancolombia.com/multipagospse/" class="myButton" target="_blank">Pago PSE BANCOLOMBIA</a></p>
          <p>&nbsp;</p>
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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-cbancolombia">Consignacion Bancolombia</a>
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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-pse">Pago Botón PSE BANCO DE BOGOTA</a>

              <div id="accordion-pse" class="accordion-section-content">
               <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p align="center">&nbsp;</p>
          <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898

" class="myButton" target="_blank">Pago PSE</a></p>
               <p align="center"></p>
               <p>Si tiene dificultades utilice la siguiente ruta: </p>
          <p><br>
            1. Ingrese a la web del Banco de Bogotá:<a href="https://www.bancodebogota.com/wps/portal/banco-bogota/home#" target="_blank"> https://www.bancodebogota.com/</a><br>
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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-transd">Transferencia en Dólares</a>

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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-cbancobogota">Consignacion Banco de Bogota</a>
                          <div id="accordion-cbancobogota" class="accordion-section-content">
                            <p>Hacer su consignación en cualquier sucursal del Banco de Bogotá en nuestra Cuenta Corriente No. 119 - 1409 - 78 a nombre de EVENTOUR SPORT, NIT 900 199 006 - 3                            </p>
                            <p>Enviar soporte de consignación al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a> . Incluir en el asunto del correo, el nombre del viajero y el grupo al que pertenece.</p>
              </div>
              
             
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section-->
            <?php } ?>
             <?php if(strpos($producto['parametros'],'tarjetacredito') !== false){?>
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-credito">Tarjetas de Crédito</a>
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
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-dolares">Dólares en Efectivo</a>
              <div id="accordion-dolares" class="accordion-section-content">
                <p><strong>El pago de dólares en efectivo aplica únicamente para el valor de la Porción Terrestre.</strong> Si elige esta opción, consigne los dólares en nuestra cuenta Corriente No. 072-06972-7, del Banco ITAÚ. Es requisito del banco llevar la relación de los dólares. Utilice el formato adjunto para su consignación. <a href="documentos/dolares.pdf" target="_blank">Click aquí para descargar.</a><br>
                    <br>
                    Importante: Es indispensable que por favor nos remita la copia de la consignación sellada que le entrega el banco, a nuestro correo info@eventoursport.com para poder registrar el abono. Favor especificar en el asunto Nombre Completo del Viajero y grupo, de lo contrario el pago no se vera reflejado.<br></p>
                <p>&nbsp;</p>
                <p>Para consultar las sucursales ITAÚ haga <u><a href="sucursales_corpbanca.html" target="_blank">click aquí</a></u></p>
              </div>
                    </div>
              <?php } ?>
                <?php if(strpos($producto['parametros'],'proexcursion') !== false){?>
                        <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-bono">Pasaporte Proexcursión</a>
                          <div id="accordion-bono" class="accordion-section-content">
                <p align="center">&nbsp;</p>
                <p>Es muy frecuente que familiares y allegados al viajero, quieran darle a sus hijos, el regalo ideal con motivo de su grado. <strong>¡Qué mejor regalo que aportar para este plan de viaje! </strong>Y si además ese aporte les da la posibilidad de ganarse a quien lo hace, un plan de viaje para dos personas, con tiquetes, alojamiento, boletas y traslados, para ver jugar a nuestra selección Colombia en Barranquilla o en otro país, en su camino para clasificar al mundial de <strong>Fútbol RUSIA 2.018</strong>… maravilloso.</p>
                <p>&nbsp; </p>
                <p>En razón a esto Eventour Sport desarrolló esta propuesta, para estimular a esos seres queridos con a vincularse económicamente a título de donación, pagando $ 60.000 por la compra del <strong>PASAPORTE PROEXCURSION</strong>, de los cuales $ 50.000 ingresarán en su nombre como pago del plan de viaje y $ 10.000 a Eventour, como parte de los gastos administrativos y de servicios de viaje del plan de viaje que será entregado a los eventuales favorecidos en el sorteo.</p>
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
            
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-t1">Términios y Condiciones</a>
              <div id="accordion-t1" class="accordion-section-content"><?php echo $producto['terminoscondiciones']?></div>
              <!--end .accordion-section-content-->
            </div>
            <!--end .accordion-section--><!--end .accordion-section--><!--end .accordion-section-->
          </div>
          <p>&nbsp;</p>
          <div class="clearfix"></div>
          <h3 id="seguro">Seguro de Asistencia</h3>
          <p>&nbsp;</p>
          <div class="accordion">
            <div class="accordion-section"> <a class="accordion-section-title" href="#accordion-asis">APRIL Assistance</a>
              <div id="accordion-asis" class="accordion-section-content">
                <p><strong> <u></u></strong></p>
                <p><strong>APRIL TRAVEL ASSISTANCE</strong> esta presente en 37 países, cuenta con más de 45 compañías dedicadas a múltiples ramas de la industria de los seguros y servicios de asistencia. APRIL asesora, diseña, gestiona y comercializa pólizas a través de una estrategia multicanal. Es el Corredor de Seguros mayorista No. 1 en Francia  (Propiedades y Accidentes).<u></u><u></u></p>
                <?php if($plan != 133 && $plan != 135 && $plan != 137 && $plan != 141){?>
                <p><strong><u></u> <u></u></strong></p>
                <p><strong>PLAN INTERNACIONAL<u></u><u></u></strong></p>
                <p>Seguro de asistencia <strong>APRIL Travel Assistance</strong> con una cobertura hasta USD 50.000 por accidente o enfermedad no preexistente, seguro por pérdida de equipaje hasta por USD 1.500 y seguro de cancelación de viaje Multicausa hasta USD 2.000, incluido. Consulte la cobertura completa <a href="april50000.pdf" target="_blank">aqui</a></p>
                <p>&nbsp;</p>
                <p><strong><br>
                <?php }else{ ?>
                <p><strong><u></u> <u></u></strong></p>
                <p><strong>PLAN INTERNACIONAL<u></u><u></u></strong></p>
                <p>Seguro de asistencia <strong>APRIL Travel Assistance</strong> con una cobertura hasta USD 50.000 por accidente o enfermedad no preexistente, seguro por pérdida de equipaje hasta por USD 1.500 y seguro de cancelación de viaje Multicausa hasta USD 2.000, incluido. Consulte la cobertura completa <a href="april2.html" target="_blank">aqu</a><a href="april.html" target="_blank">i</a></p>
                <p>&nbsp;</p>
                <p><strong><br>
                <?php } ?>
                SEGURO DE CANCELACIÓN MULTICAUSA<u></u><u></u></strong></p>
                <p><u></u> <u></u></p>
                <p>El Seguro de Cancelación Multicausa, ampara hasta el límite asegurado y claramente establecido en la caratula de la póliza, los gastos adicionales en que incurra el Asegurado, como consecuencia de la cancelación, reprogramación o interrupción de su viaje y de acuerdo a las 11 causales o eventos cubiertos, siempre y cuando hayan sido reportados y su programación esté dentro de las fechas de vigencia. Consulte las 11 causales cubiertas y las condiciones del producto <u><a href="cancelacion_multicausa.pdf">aqui</a></u></p>
                <p>&nbsp;</p>
             
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
          <p><strong>Si  el viajero tiene alguna condición o alimentación especial, diligenciar el  formato adjunto y enviarlo escaneado al correo <a href="mailto:info@eventoursport.com">info@eventoursport.com</a>, <a href="documentos/asistencia_medica.pdf">click aqui</a> para descargar el formato</strong></p>
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

<!--<img src="<?php echo $cliente['firma']; ?>" width="30%"/>-->
<p align="center"><img src="http://www.eventours.travel/wp-content/uploads/2018/03/EventourS-Logo-300x107.png"  alt=""/></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#FFF">
  <tr>
    <td align="left"><p align="left">
    <?php if($producto['unidad_negocio'] != "GRUPOS JUVENILES"){ ?>
    <strong>Maria Alejandra Moreno Quintero</strong><br>
      Jefe UN Especiales<br>
    </p> <?php }else{ ?>
    <strong>Maria Paula Luna Stapel</strong><br>
      Jefe UN JUVENIL<br>
    </p>
      <p></p><?php } ?></td>
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