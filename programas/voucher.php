<?php 
require_once("../control/control.php");
setlocale(LC_TIME,"es_ES.UTF-8");
$control = new Control();
$viajero =$_REQUEST['viajero'];
 $programa_tk=0;
 $programa_pt=0;
 $contrato = null;
 $servicios="";
$desc_servicios=array();
 $cant_viajeros=0;
					
						  
  $documento_viajero = $_REQUEST['doc'];
	$viajero=$control->datosViajeroID($documento_viajero);
	
	$producto=$control->datosProducto($viajero['id_grupo']);
	
	 $nitviajero=$viajero['facturacion_nodocumento'];
									  $viajeroNIT=$control->listaViajeros($nitviajero,$viajero['id_grupo']);
									  $totalTK=0;
									  $totalPT=0;
									  $viaj="";
									  
									  $totalAbonoTK=0;
									  $totalAbonoPT=0;
									  
									  
		/// LISTA DE ACTIVIDADES DEL PROGRAMA
		
		$actividades=array();
		$resultado4=$control->consultaServicios($producto['id']);
						
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								if(($fi4['categoria'] != "PROMOCION")&&($fi4['categoria'] != "GUIAS")&&($fi4['categoria'] != "OTROS")&&($fi4['categoria'] != "COMISIONES")&&($fi4['categoria'] != "DOCUMENTACION") ){
							
							if($fi4['categoria'] == "TIQUETES"){
								if(strpos($fi4['tarifa'],"-1") !== false){
							$actividades[]=$fi4;
								}
							
							
							}else{
							$actividades[]=$fi4;
							}
							
							} 		
							}
									  
									  
									  while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
								$cant_viajeros++;		  
						$viaj=$viaj."".$di['nombres']." ".$di['apellidos']."<br/>";
										  
			
			
			if($di['record']==''){
$contrato=$control->sillaPrincipalPrograma($producto['id']);

	}else{
	$contrato=$control->datosContratoRecord($di['record']);
	}			
	
	if($contrato == null){
	$contrato['destino']=$producto['destino'];
	$contrato['origen']=$producto['origen'];
	$contrato['fecha_salida']=$producto['f_salida'];
	$contrato['fecha_regreso']=$producto['f_llegada'];
	}
									
										  //var_dump($di['nombres']);
						$valortk= $control->valorViajeroTK($di['otro'],$producto); 
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
					  
					  
					  
					  
						
						 $n=0;
						 
						 $servicios.="<strong>"."<p>".$di['nombres']." ".$di['apellidos'].":</strong></p><ul>	";						 
						 foreach ($actividades as $ac){ 
						 
					 $valida_actividad = $control->validarActividad($di['id'],$ac['id']); 
						 
						 if($valida_actividad['poner']==1){
						 $servicios.="<li>";
					if($ac['fecha'] != "0000-00-00 00:00:00"){
						
										$servicios.=strftime("%e/%b/%Y ", strtotime($ac['fecha']))." - ";
				}
					$servicios.=" ".$ac['nombre']."</li>";
							
							 if($ac['observaciones']!=''){
							 $desc_servicios[$ac['nombre']]=$ac['observaciones'];
							 }
							 $totales[$n]++;
						 }else{
						 
					$f=$ac['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
				if($t==0 && $t!=''){
				if($valida_actividad['poner']==-1){	
				}else{
				$servicios.="<li>";
					if($ac['fecha'] != "0000-00-00 00:00:00"){
						
										$servicios.=strftime("%e/%b/%Y ", strtotime($ac['fecha']))." - ";
				}
					$servicios.=" ".$ac['nombre']."</li>";
					 if($ac['observaciones']!=''){
							 $desc_servicios[$ac['nombre']]=$ac['observaciones'];
							 }
				$totales[$n]++;
				}
				}else{
					if($t>0){
				if($producto['nombre_tarifa'.$t] == $di['otro']){if($valida_actividad['poner']==-1){	
				}else{
				$servicios.="<li>";
					if($ac['fecha'] != "0000-00-00 00:00:00"){
						
										$servicios.=strftime("%e/%b/%Y ", strtotime($ac['fecha']))." - ";
				}
					$servicios.=" ".$ac['nombre']."</li>";$totales[$n]++;
					 if($ac['observaciones']!=''){
							 $desc_servicios[$ac['nombre']]=$ac['observaciones'];
							 }
				}
					}

				
				}
				
				}
				}
						 
						 
						 
						 }
						 
						
						 
				
						
							$n++;
						 } 
						 $servicios.= "</ul>";
						 
					  }

$viaj=substr($viaj,0,-5);
							
/*
$cliente = $control->datosViajero($firma);
	$producto=$control->datosProducto($cliente['id_grupo']);
	
	*/
	
	
	
	
		
							
							
								?>
    
    <?php 
							  /////BLOQUE DE CALCULO DE FECHAS/////
							  
							  function diasDiferencia($fecha1,$fecha2){
							  $date1 = date_create(date("d-m-Y", strtotime($fecha1)));
							  if($date1 != null){
		  $date2 = date_create(date("d-m-Y", strtotime($fecha2)));

//difference between two dates
$diff = date_diff($date2,$date1);

//count days
$dias=$diff->format("%r%a");

//// FIN BLOQUE
							  }else{
								return -1;  
							  }
							  
							  return $dias;
							  }
							  
							  function colores($dias){
								if($dias < 5){
								return "#FF0000";
								}else if ($dias < 10){
								return "#FFFF00";
								}else if ($dias >= 10){
								return "#66FF00";
								}
							  }
							  ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
<table width="100%" border="0px" cellspacing="2" cellpadding="2" bordercolor="#fff">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Ciudad y Fecha:</strong></td>
    <td bgcolor="#EEEEEE">Cali, <?php  echo strftime("%A, %d de %B ", strtotime("now"));?></td>
    <td bgcolor="#CCCCCC"><strong>Voucher No:</strong></td>
    <td bgcolor="#EEEEEE"><?php echo $documento_viajero."-".$producto['id']?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Destino:</strong></td>
    <td bgcolor="#EEEEEE"><?php echo strtoupper( $contrato['destino']); ?></td>
    <td bgcolor="#CCCCCC"><strong>Noches:</strong></td>
    <td bgcolor="#EEEEEE" ><?php echo diasDiferencia($contrato['fecha_regreso'],$contrato['fecha_salida'])?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" ><strong>Procedentes de:</strong></td>
    <td colspan="3" align="left" bgcolor="#EEEEEE"><?php echo strtoupper( $producto['origen']);?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" ><strong>Proporcionar a:</strong></td>
    <td colspan="3" align="left" bgcolor="#EEEEEE"><?php echo $viaj ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" ><strong>Fecha de Llegada:</strong></td>
    <td bgcolor="#EEEEEE"><?php  echo strftime("%A, %d de %B ", strtotime($contrato['fecha_salida']));?></td>
    <td bgcolor="#CCCCCC"><strong>Fecha de Salida:</strong></td>
    <td bgcolor="#EEEEEE"><?php  
							  
							 echo strftime("%A, %d de %B ", strtotime($contrato['fecha_regreso']));
							  ?></td>
<!--  </tr>
	<tr>
    <td bgcolor="#CCCCCC" ><strong>Hotel:</strong></td>
    <td colspan="3" bgcolor="#EEEEEE"><?php $hotel= $control->infoHoteles($producto['id']);
		echo "<b>".$hotel['hotel']."</b><br>".$hotel['direccion']."";
					
					
				 ?></td>
  </tr>-->
	  
	    </tr>
	<tr>
    <td bgcolor="#CCCCCC" ><strong>Tour Operador:</strong></td>
    <td colspan="3" bgcolor="#EEEEEE">SPLENDID TRAVEL &amp; TOURISM (LLC)</td>
  </tr>
	<tr>
	  <td bgcolor="#CCCCCC" ><strong>Contacto en destino:</strong></td>
	  <td colspan="3" bgcolor="#EEEEEE">Angélica Vivas / (971) 4 441 6351</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#CCCCCC" align="center"><strong>SERVICIOS CONTRATADOS:</strong></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#EEEEEE">  <p><?php echo $servicios ?>
    <br/>
    </p>
    <p>&nbsp;</p>
    </td>
  </tr>
	<tr>
	 <td colspan="4" bgcolor="#EEEEEE" align="center"><span style="text-align: center"><strong>HORA DE CHECK-IN: 2:00pm | HORA CHECK-OUT: 12:00pm</strong></span></td>
  </tr>
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" valign="top" bgcolor="#CCCCCC" align="center"><strong>NO INCLUYE:</strong></td>
  </tr>
  <tr>
   
    <td colspan="4" bgcolor="#EEEEEE"><p>&nbsp;</p>
      <ul>
        <li>Propinas (Se sugiere USD 5, por persona, por noche).&nbsp;</li>
      <li>Tours y Visitas opcionales</li>
      <li>Fee Bancario (2%)</li>
      <li>Cualquier otro servicio no mencionado.&nbsp;&nbsp;&nbsp;</li>
      <li><strong>Impuesto hotelero Dirham fee</strong> 15 AED (USD 4.5 Aprox.) por habitación, por noche.    </li>
      <li></li>
      </ul>
      <p>&nbsp;</p>
    </td>
  </tr>
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <?php if(sizeof($desc_servicios)!=0){?>
	<tr>
    <td colspan="4" valign="top" bgcolor="#CCCCCC" align="center"><strong>DESCRIPCIÓN TOURS:</strong></td>
  </tr>
  <tr>
   
    <td colspan="4" bgcolor="#EEEEEE"><ul>
      <?php foreach ($desc_servicios as $nombreser => $desc){
	echo "<li><b>".strtoupper($nombreser)."</b>".$desc."</li>";
}?>
      </ul>
    <p>&nbsp;</p></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
  </tr><? } ?>
  <!--<tr>
    <td colspan="4" valign="top" bgcolor="#CCCCCC" align="center"><strong>VALOR PROGRAMA <?php echo $cant_viajeros ?> VIAJERO(S):</strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" ><strong>Porción AEREA:</strong></td>
    <td bgcolor="#EEEEEE">
	
    <?php   echo $producto['MONEDA']." ".($totalTK);?></td>
	 
	 
    <td bgcolor="#CCCCCC"><strong>PORCIÓN TERRESTRE:</strong></td>
    <td bgcolor="#EEEEEE" > <?php   echo $producto['MONEDA']." ".($totalPT);?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
  </tr>-->
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
<!--  <tr>
    <td bgcolor="#CCCCCC"><strong>Cantidad</strong></td>
    <td bgcolor="#CCCCCC"><strong>Habitación</strong></td>
    <td bgcolor="#CCCCCC"><strong>Acomodacion</strong></td>
    <td bgcolor="#CCCCCC" ><strong>Tipo Pasajero</strong></td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE">&nbsp;</td>
    <td bgcolor="#EEEEEE">&nbsp;</td>
    <td bgcolor="#EEEEEE">&nbsp;</td>
    <td bgcolor="#EEEEEE">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
  <!--<tr>
    <td colspan="4" valign="top" bgcolor="#CCCCCC" align="center"><strong>TÉRMINOS Y CONDICIONES:</strong></td>
  </tr>
  <tr>
   
    <td colspan="4" bgcolor="#EEEEEE"><?php echo $producto['terminoscondiciones']?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
  <tr>
    <td colspan="4" align="center" bgcolor="#CCCCCC"><strong> EVENTOUR SPORT SE ACOGE A LA SIGUIENTE LEGISLACIÓN:</strong></td>
  </tr>
  <tr>
    <td colspan="4"><p>Ley 17 de 1981 Por el cual se aprueba la convención sobre el comercio internacional de especies amenazadas de fauna y flora.<br>
      Ley 397 de 1997 por la cual se dictan normas sobre patrimonio cultural, fomentos y estímulos a la cultura.<br>
      Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.<br>
    Ley 1336 de 2009 Por medio de la cual se adiciona y robustece la Ley 679 de 2001, de lucha contra la explotación, la pornografía y el turismo sexual con niños, niñas y adolescentes.</p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="4" align="center" bgcolor="#CCCCCC"><strong>CONTRATO DE PRESTACION DE SERVICIO    TURISTICO</strong></td>
  </tr>
  <tr>
    <td colspan="4"><p>EVENTOUR SPORT S.A.S, con Registro Nacional de Turismo No.16310, se acoge    en su totalidad a la Cláusula de Responsabilidad establecida en el Artículo 4    del Decreto 2438 de 2010 y sus posteriores reformas: ¨Responde por la total    prestación y calidad de los servicios descritos en el programa, limitando su    responsabilidad por casos de fuerza mayor, que puedan ocurrir durante el    viaje. En virtud de esta, se reserva el derecho de hacer cambios en el    itinerario, fechas de viaje y prestadores de servicio por otros de igual o    superior categoría. Nuestra empresa informará y asesorará en la documentación    necesaria para el viaje, pero no será responsable por la negación del ingreso    a otros países por decisión de sus autoridades. La agencia de viajes no asume    responsabilidad alguna por el servicio de transporte aéreo. La prestación de    tal servicio se rige por las normas legales aplicables al servicio de    transporte aéreo. Los eventos tales como retrasos o modificaciones    imprevistas en los horarios de los vuelos dispuestos por las aerolíneas, los    derechos del usuario y los procedimientos para hacer efectivas las    devoluciones de dinero a que estos hechos den lugar, se regirán por las    disposiciones legales pertinentes y en particular por las contenidas en el    Reglamento Aeronáutico Colombiano. El viajero tendrá derecho al reintegro de    servicios no utilizados por fuerza mayor, de acuerdo con la reglamentación    establecida por los prestadores de servicios. El viajero deberá cumplir con    las normas legales y de salud, restricciones, y será responsable de los    objetos que lleve consigo¨.</p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="4"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p><br>
    Recibi: </p></td>
    <td><p>&nbsp;</p>
      <p><br>
    EventourSport SAS: </p></td>
  </tr>
  <tr>
    <td><p>____________________________</p></td>
    <td><p>____________________________</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">EVENTOUR SPORT | Av. 5C Norte No. 23DN-35 | Teléfono: 57 (2) 660 4000 | E-mail: info@eventoursport.com | Cali - Colombia</td>
  </tr>
</table>
</body>
</html>
