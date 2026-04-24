	<?php 
require_once("control/control.php");
header('Content-Type: application/json; charset=utf-8');

$control = new Control();

if(isset($_REQUEST['factura'])){
	if($_REQUEST['factura']==""){
		echo "0";
	} else{
	echo $control->consultaIdViajero($_REQUEST['factura']);
}
}

if(isset($_REQUEST['term']) && !isset($_REQUEST['servicio'])){
	if($_REQUEST['term']==""){
		echo "0";
	} else{
		
	$listaResultado= $control->buscarAeropuerto($_REQUEST['term']);
		while($di = mysql_fetch_array($listaResultado, MYSQL_ASSOC)){
		$results['results'][]=array('id'=>$di['ciudad']." - ".$di['iata'],'text'=>$di['ciudad']." - ".$di['iata']);	
	
		}
	echo json_encode($results);	
}
}

if(isset($_REQUEST['servicio'])){
	
	
	if($_REQUEST['servicio'] == 'undefined'){
		$_REQUEST['servicio']='';
	}	
	$listaResultado= $control->buscarServicioProveedor($_REQUEST['servicio'],$_REQUEST['proveedor']);
	
	if(mysql_num_rows( $listaResultado ) != 0){
		while($di = mysql_fetch_array($listaResultado, MYSQL_ASSOC)){
		$results['results'][]=array('id'=>$di['id'],'text'=>$di['nombre']);	
	
		}
	}else{
		
		$results['results'][]=array('id'=>$_REQUEST['servicio'],'text'=>$_REQUEST['servicio']);	
	
		
	}
	echo json_encode($results);	

}

if(isset($_REQUEST['dolar'])){
	$respuesta=mysql_fetch_row($control->dolar($_REQUEST['dolar']));
	echo $respuesta[0];
}

if(isset($_REQUEST['grupo'])){
	
	$respuesta=$control->consulta('SELECT CONCAT(nombres," ",apellidos) as name,  no_documento as document, REGEXP_REPLACE(celular, "[^0-9]", "") as number, concat(observaciones," :: TARJETA ASISTENCIA:",asistencia.voucher) as obs FROM `viajero` left join asistencia on asistencia.id_viajero = viajero.id WHERE id_grupo = '.$_REQUEST['grupo'].';');
	
	while($di = mysql_fetch_array($respuesta, MYSQL_ASSOC)){
		$results[]=array('document'=>$di['document'],'name'=>$di['name'],'number'=>$di['number'],'obs'=>$di['obs']);
	}
	echo json_encode($results);
}

if(isset($_REQUEST['servicios'])){
	$respuesta=$control->listaServiciosDisp($_REQUEST['servicios'],"--");
	
	while($di = mysql_fetch_array($respuesta, MYSQL_ASSOC)){
		$prov=$control->datosProveedor($di['proveedor_id']);
		$results['results'][]=array('id'=>$di['id'],'name'=>$di['nombre']." - ".$prov['nombre']);	
	
		}
	echo json_encode($results);	
}

if(isset($_REQUEST['saldo'])){
	
	$viajero=$control->datosViajeroID($_REQUEST['saldo']);
	
	
	
	$producto=$control->datosProducto($viajero['id_grupo']);
	
	  $nitviajero=$viajero['facturacion_nodocumento'];
									  $viajeroNIT=$control->listaViajeros($nitviajero,$producto['id']);
									  $totalTK=0;
									  $totalPT=0;
									  
									  $totalAbonoTK=0;
									  $totalAbonoPT=0;
									  
									  while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
										  
										  //var_dump($di['nombres']);
						$valortk= $control->valorViajeroTK($di['otro'],$producto); 
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
					  }
					  
					  $resultado2=$control->pagosHistorialViajeroNIT($nitviajero,$producto['id']);
							while ($pi = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
								$totalAbonoTK=$totalAbonoTK+$pi['valor_TIK'];
								$totalAbonoPT=$totalAbonoPT+$pi['valor_PT'];
								
							}
							
							
							echo "Saldo TK:".($totalTK-$totalAbonoTK)." Saldo PT:".($totalPT-$totalAbonoPT);
					  
}

if(isset($_REQUEST['expediente'])){
	
	$viajero=$control->datosViajeroID($_REQUEST['expediente']);
	
	
	
	$producto=$control->datosProducto($viajero['id_grupo']);
	
	echo $viajero['expediente'];
					  
}


if(isset($_REQUEST['viajero'])){
	$viajero=$control->datosViajero($_REQUEST['viajero']);
	if($viajero != null){
		if($viajero['id_grupo']== $_REQUEST['plan']){
	echo "VIAJERO YA REGISTRADO";
		}else{
				echo "OK;".$viajero['nombres'].";".$viajero['apellidos'].";".$viajero['fnacimiento'].";".$viajero['email'].";".$viajero['telefono'].";".$viajero['celular'].";".$viajero['acudiente1_nombre'].";".$viajero['acudiente1_apellido'].";".$viajero['acudiente1_telefono'].";".$viajero['acudiente1_email'].$viajero['acudiente2_nombre'].";".$viajero['acudiente2_apellido'].";".$viajero['acudiente2_telefono'].";".$viajero['acudiente2_email'].";".$viajero['facturacion_nombre'].";".$viajero['facturacion_documento'].";".$viajero['facturacion_nodocumento'].";".$viajero['facturacion_ciudad'].";".$viajero['facturacion_direccion'].";".$viajero['facturacion_email'];
		}
	}else{
	echo "OK";
	}
	

}
?>