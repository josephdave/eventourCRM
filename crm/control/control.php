<?php
 error_reporting(0);


class control
{

	

   /* Class constructor */
   function Control(){
	   
	  
   }


	/*Base de Datos*/
	
	 function baseDeDatos(){
		
      /* Make connection to database */
      $this->connection = mysql_connect("localhost", "eventour_databas", "h3tabew3") or die(mysql_error());
      mysql_select_db("eventour_crm", $this->connection) or die(mysql_error());
	  mysql_query ('SET NAMES utf8');
	  
   }
   
   function consulta($q){
	   
	   	$this->baseDeDatos();
    	$result = mysql_query($q, $this->connection);
		mysql_close($this->connection);
		return $result;
   }
   
   
   
   function registrarPago($idviajero,$fecha,$tik,$pt,$trm,$fee,$medio,$producto,$observaciones,$moneda,$numero,$comprobante,$aut,$usuario){
	   
	   $mensaje = "";
	   
	   if(!isset($producto)){
	   $viajero=$this->datosViajeroID($idviajero);
	   $producto=$viajero['id_grupo'];
	   }
   	
		$q="INSERT INTO `pago`( `id_viajero`, `fecha`,fecha_registro, `medio`, `valor_TIK`, `valor_PT`, `fee`, `trm`, `id_producto`, `observaciones`, moneda, numero, comprobante, aut, usuario) VALUES ('$idviajero','$fecha','".date('Y-m-d H:m:s')."','$medio','$tik','$pt','$fee','$trm','$producto','$observaciones','$moneda','$numero','$comprobante','$aut','$usuario');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='Pago '.$viajero['nombres'].' '.$viajero['apellidos'].'  NO Registrado</p>';
}else{
	$mensaje.='Pago '.$viajero['nombres'].' '.$viajero['apellidos'].' Registrado';
}


return $mensaje;
   }
	
	
	function registrarPagoProveedor($idproveedor,$fecha,$valor,$observaciones,$moneda,$usuario){
	   
	   $mensaje = "";
	   
	 
   	
		$q="INSERT INTO `pago_proveedor`(`id_proveedor`,`fecha`, `moneda`, `valor`, `observaciones`, `usuario`) VALUES ('$idproveedor','$fecha','$moneda','$valor','$observaciones','$usuario');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='Pago  NO Registrado</p>';
}else{
	$mensaje.='Pago Registrado';
}


return $mensaje;
   }


function registrarTRM($fecha,$trm){
	   
	   $mensaje = "";
	   
	   
		$q="
		INSERT INTO `pago`(`id_viajero`, `fecha`, `medio`, `moneda`, `valor_TIK`, `valor_PT`, `fee`, `trm`, `validado`) VALUES ('0','$fecha','TRM','Dolar','0','0','0','$trm',1);";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='Pago '.$viajero['nombres'].' '.$viajero['apellidos'].'  NO Registrado</p>';
}else{
	$mensaje.='Pago '.$viajero['nombres'].' '.$viajero['apellidos'].' Registrado';
}


return $mensaje;
   }


function registrarProveedor($datos){
	   
	   $mensaje = "";
	   
	   
		$q="
		INSERT INTO `proveedores`(`nombre`, `pais`, `ciudad`, `categoria`, `servicio`, `observaciones`, `formas_pago`, `telefono`, `email`, `contacto`,rut,celular,direccion,domicilio_beneficiario,pais_beneficiario,banco,nro_cuenta,swift,domicilio_banco,
		
		beneficiario,cargo,emailcontacto,telefonocontacto,contacto2,cargo2,emailcontacto2,telefonocontacto2,contacto3,cargo3,emailcontacto3,telefonocontacto3,aba,razonsocial,departamento,localidad
		
		) VALUES ('".$datos['nombre']."','".$datos['pais']."','".$datos['ciudad']."','".$datos['categoria']."','".$datos['servicio']."','".$datos['observaciones']."','".$datos['pago']."','".$datos['telefono']."','".$datos['email']."','".$datos['contacto']."','".$datos['rut']."','".$datos['celular']."','".$datos['direccion']."','".$datos['domicilio_beneficiario']."','".$datos['pais_beneficiario']."','".$datos['banco']."','".$datos['nro_cuenta']."','".$datos['swift']."','".$datos['domicilio_banco']."',
	'".$datos['beneficiario']."'	,
	'".$datos['cargo']."','".$datos['emailcontacto']."','".$datos['telefonocontacto']."','".$datos['contacto2']."'	,
	'".$datos['cargo2']."','".$datos['emailcontacto2']."','".$datos['telefonocontacto2']."','".$datos['contacto3']."'	,
	'".$datos['cargo3']."','".$datos['emailcontacto3']."','".$datos['telefonocontacto3']."','".$datos['aba']."','".$datos['razonsocial']."','".$datos['departamento']."','".$datos['localidad']."'
		);";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='Proveedor NO Registrado</p>';
}else{
	$mensaje.='Proveedor Registrado';
}


return $mensaje;
   }
   
   
   
function registrarAsistencia($datos){
	   
	   $mensaje = "";
	   
	   
		$q="
		INSERT INTO `seguro_asistencia`( `nombre`, `proveedor_id`, `coberturas`, `vlr_dia`, `observaciones`
		
		) VALUES ('".$datos['nombre']."','".$datos['proveedor_id']."','".$datos['coberturas']."','".$datos['vlr_dia']."','".$datos['observaciones']."');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='asistencia NO Registrado</p>';
}else{
	$mensaje.='asistencia Registrado';
	
}


return $mensaje;
   }


function modificarProveedor($datos){
	   
	   $mensaje = "";
	   
	   
		$q="
		
		UPDATE `proveedores` SET `nombre`='".$datos['nombre']."',`pais`='".$datos['pais']."',`ciudad`='".$datos['ciudad']."',`categoria`='".$datos['categoria']."',`servicio`='".$datos['servicio']."',`observaciones`='".$datos['observaciones']."',`formas_pago`='".$datos['pago']."',`telefono`='".$datos['telefono']."',`email`='".$datos['email']."',`contacto`='".$datos['contacto']."',`rut`='".$datos['rut']."',`celular`='".$datos['celular']."',`direccion`='".$datos['direccion']."',`domicilio_beneficiario`='".$datos['domicilio_beneficiario']."',`pais_beneficiario`='".$datos['pais_beneficiario']."',`banco`='".$datos['banco']."',`nro_cuenta`='".$datos['nro_cuenta']."',`swift`='".$datos['swift']."',`domicilio_banco`='".$datos['domicilio_banco']."', beneficiario = '".$datos['beneficiario']."', cargo = '".$datos['cargo']."', telefonocontacto = '".$datos['telefonocontacto']."',  emailcontacto = '".$datos['emailcontacto']."', contacto2 = '".$datos['contacto2']."', cargo2 = '".$datos['cargo2']."', telefonocontacto2 = '".$datos['telefonocontacto2']."',  emailcontacto2 = '".$datos['emailcontacto2']."', contacto3 = '".$datos['contacto3']."', cargo3 = '".$datos['cargo3']."', telefonocontacto3 = '".$datos['telefonocontacto3']."',  emailcontacto3 = '".$datos['emailcontacto3']."'  ,  aba = '".$datos['aba']."',  razonsocial = '".$datos['razonsocial']."',  departamento = '".$datos['departamento']."',   localidad = '".$datos['localidad']."'  WHERE id = '".$datos['id']."';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='Proveedor NO Registrado</p>';
}else{
	$mensaje.='Proveedor Registrado';
}


return $mensaje;
   }

function modificarAsistencia($datos){
	   
	   $mensaje = "";
	   
	   
		$q="
		
		UPDATE `seguro_asistencia` SET 
		
		nombre`='".$datos['nombre']."',`proveedor_id`='".$datos['proveedor_id']."',`coberturas`='".$datos['coberturas']."',`vlr_dia`='".$datos['vlr_dia']."',`observaciones`='".$datos['observaciones']."' WHERE id = '".$datos['id']."';";
		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
					
					
    $mensaje.='Asistencia NO Registrado</p>';
}else{
	$mensaje.='Asistencia Registrada';
}


return $mensaje;
   }


 function registrarVouchers($vouchers){
	   
	  foreach ($vouchers as $id => $valor){
	  if($valor != ""){
	  
	  $q="INSERT INTO `asistencia`(`id_viajero`, `voucher`) VALUES ($id,'$valor') ON DUPLICATE KEY UPDATE voucher = '$valor';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Voucher error</p>';
}else{
	$mensaje.='Voucher OK';
}

	  }
	  
	  
	  }
   	
		
   }
   
   
   function registrarObs($viajero,$usuario,$obs){
	   
	 
	  
	  $q="INSERT INTO `observaciones_viajero`( `viajeroid`, `usuario`, `comentario`) VALUES ($viajero,$usuario,'$obs');";
		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Observaciones error</p>';
}else{
	$mensaje.='Observaciones OK';
}

	 return $mensaje;
   	
		
   }
   
    function registrarFVouchers($vouchers){
	   
	  foreach ($vouchers as $id => $valor){
	  if($valor != ""){
	  
	  $q="UPDATE `asistencia` SET `fecha_emision`='$valor' WHERE `id_viajero` = '$id';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Voucher error</p>';
}else{
	$mensaje.='Voucher OK';
}

	  }
	  
	  
	  }
   	
		
   }
   
    function registrarVlrDiario($vouchers){
	   
	  foreach ($vouchers as $id => $valor){
	  if($valor != ""){
	  
	  $q="UPDATE `asistencia` SET `vlr_diario`='$valor' WHERE `id_viajero` = '$id';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Voucher error</p>';
}else{
	$mensaje.='Voucher OK';
}

	  }
	  
	  
	  }
   	
		
   }
   
   function registrarFacVouchers($vouchers){
	   
	  foreach ($vouchers as $id => $valor){
	  if($valor != ""){
	  
	  $q="UPDATE `asistencia` SET `factura`='$valor' WHERE `id_viajero` = '$id';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Voucher error</p>';
}else{
	$mensaje.='Voucher OK';
}

	  }
	  
	  
	  }
   	
		
   }
   
   
   function registrarTiquetes($vouchers){
	   
	  foreach ($vouchers as $id => $valor){
	  if($valor != ""){
	  
	  $q="
	  UPDATE `viajero` SET `tiquete`='$valor'  WHERE `id` = '$id'";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Tiquete error</p>';
}else{
	$mensaje.='Tiquete OK';
}

	  }
	  
	  
	  }
   	
		
   }


function registrarInfoActividad($actividad){
	   
	  foreach ($actividad as $id => $valor){
	  if($valor != ""){
		  
		  $datos=explode("-",$id);
	  
	  $q="
	  INSERT INTO `viajero_actividad`(`id_viajero`, `id_actividad`, `poner`, `registro`) VALUES ('".$datos[0]."','".$datos[1]."',1,'$valor')
	  ON DUPLICATE KEY UPDATE
	`registro`='$valor';";
		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Tiquete error</p>';
}else{
	$mensaje.='Tiquete OK';
}

	  }
	  
	  
	  }
   	
		
   }


 function registrarRecords($vouchers){
	   
	  foreach ($vouchers as $id => $valor){
	  if($valor != ""){
	  
	  $q="
	  UPDATE `viajero` SET `record_emitido`='$valor'  WHERE `id` = '$id'";
		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Tiquete error</p>';
}else{
	$mensaje.='Tiquete OK';
}

	  }
	  
	  
	  }
   	
		
   }


function registrarAcomodaciones($acomodacion,$grupo){
	   
	  foreach ($acomodacion as $id => $valor){
	  if($valor != ""){
	  
	  $q="
	  REPLACE INTO `acomodacion`(`id_viajero`, `id_grupo`, `posicion`) VALUES ('".$id."','".$grupo."','".$valor."');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='acomodacion error</p>';
}else{
	$mensaje.='acomodacion OK';
}

	  }
	  
	  
	  }
   	
		
   }


function registrarHabitaciones($hab,$grupo){
	   
	  foreach ($hab as $id => $valor){
	  if($valor != ""){
	  
	  $q="
	  UPDATE `acomodacion` SET `no_habitacion`='$valor' WHERE `id_grupo` = '$grupo' and `posicion` = '$id';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='acomodacion error</p>';
}else{
	$mensaje.='acomodacion OK';
}

	  }
	  
	  
	  }
   	
		
   }


function registrartipoHabitaciones($hab,$grupo){
	   
	  foreach ($hab as $id => $valor){
	  if($valor != ""){
	  
	  $q="
	  UPDATE `acomodacion` SET `id_habitacion`='$valor' WHERE `id_grupo` = '$grupo' and `posicion` = '$id';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='acomodacion error</p>';
}else{
	$mensaje.='acomodacion OK';
}

	  }
	  
	  
	  }
   	
		
   }


function checkActividad($viajero,$actividad,$check){
	   
	  	  $q="INSERT INTO `viajero_actividad`( `id_viajero`, `id_actividad`, `poner`) VALUES ('".$viajero."','".$actividad."','".$check."') ON DUPLICATE KEY UPDATE poner = '".$check."';";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='No Asignado </p>';
}else{
	$mensaje.='Asignado';
}

   	
		
   }




function registrarTablero($grupo,$actividades,$encargado,$fecha){
	   
	  foreach ($actividades as $id => $actividad){
	
	  
	  $nombre=explode("/",$actividad);
	  
	  if($fecha[$id] != null){
	  
	  $q="INSERT INTO `tablero_control`(`id_grupo`, `categoria`, `actividad`, `responsable`, `fecha`) VALUES ('$grupo','".$nombre[0]."','".$nombre[1]."','".$encargado[$id]."','".$fecha[$id]."');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Fecha Error</p>';
}else{
	$mensaje.='Fecha OK';
}
	  }

	  
	  
	  
	  }
   	
		
   }


  function registrarHotel($idgrupo,$hotel,$ubicacion,$llegada,$salida,$direccion,$telefono,$web){
   	
		$q="INSERT INTO `alojamiento`(`id_producto`, hotel, `ubicacion`, `fecha_llegada`, `fecha_salida`, direccion, telefono,web) VALUES ('$idgrupo','$hotel','$ubicacion','$llegada','$salida','$direccion','$telefono','$web');";
		
	//	var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Hotel NO Registrado</p>';
}else{
	$mensaje.='Hotel Registrado';
}
	

		
		return $mensaje; 
   
   }
   
   function registrarObservaciones($id,$observaciones){
   	
		$q="UPDATE viajero set `observaciones`='$observaciones' WHERE `id` = '$id';";
		
//		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Observaciones NO Registrado</p>';
}else{
	$mensaje.='Observaciones Registrado';
}
	

		
		return $mensaje; 
   
   }
   
   
   
   
    function asignarContrato($idgrupo,$idsillas,$tipo,$modificacion){
   	
		$q="INSERT INTO `sillas_grupo`(`id_programa`, `id_sillas`, `principal`,modificacion_valor) VALUES  ('$idgrupo','$idsillas','$tipo','$modificacion');";
		
		//var_dump($q);
			$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Asignacion Contrato NO Registrado</p>';
}else{
	$mensaje.='Asignacion contrato Registrado';
}
	

		
		return $mensaje; 
   
   }
   
    function registrarAdicional($id_servicio,$idgrupo,$servicio,$proveedor,$ubicacion,$fecha,$fecha2,$costo,$aplica,$pventa,$categoria,$tipo_costo){
		
		$id_prov=$proveedor;
		$prov=$this->datosProveedor($proveedor);
		
		$proveedor=$prov['nombre'];
		
		
		//var_dump($aplica);
   	$m="";
	if($aplica != ""){
	foreach ($aplica as $mods){
		$m.=$mods.";";
	}
	}
	
	if($id_servicio>0){
		$q="UPDATE `servicios` SET `nombre`='$servicio',`proveedor`='$proveedor',`ubicacion`='$ubicacion',`fecha`='$fecha',`fecha_out`='$fecha2',`costo`='$costo',`pventa`='$pventa',`tarifa`='$m', categoria='$categoria', tipo_costo='$tipo_costo',proveedor_id='$id_prov' WHERE `id` = '$id_servicio';";
	}else{
	$q="INSERT INTO `servicios`( `id_producto`, `nombre`, `proveedor`, `ubicacion`, `fecha`, `fecha_out`,costo,tarifa,pventa,categoria,tipo_costo,proveedor_id) VALUES ('$idgrupo','$servicio','$proveedor','$ubicacion','$fecha','$fecha2','$costo','$m','$pventa','$categoria','$tipo_costo','$id_prov');";
	}
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Servicio NO Registrado</p>';
}else{
	$mensaje.='Servicio Registrado';
}
	

		
		return $mensaje; 
   
   }
	
	function registrarAdicionalObs($id_servicio,$idgrupo,$servicio,$proveedor,$ubicacion,$fecha,$fecha2,$costo,$aplica,$pventa,$categoria,$tipo_costo,$observaciones){
		
		$id_prov=$proveedor;
		$prov=$this->datosProveedor($proveedor);
		
		$proveedor=$prov['nombre'];
		
		
		//var_dump($aplica);
   	$m="";
	if($aplica != ""){
	foreach ($aplica as $mods){
		$m.=$mods.";";
	}
	}
	
	if($id_servicio>0){
		$q="UPDATE `servicios` SET `nombre`='$servicio',`proveedor`='$proveedor',`ubicacion`='$ubicacion',`fecha`='$fecha',`fecha_out`='$fecha2',`costo`='$costo',`pventa`='$pventa',`tarifa`='$m', categoria='$categoria', tipo_costo='$tipo_costo',proveedor_id='$id_prov',observaciones='$observaciones' WHERE `id` = '$id_servicio';";
	}else{
	$q="INSERT INTO `servicios`( `id_producto`, `nombre`, `proveedor`, `ubicacion`, `fecha`, `fecha_out`,costo,tarifa,pventa,categoria,tipo_costo,proveedor_id,observaciones) VALUES ('$idgrupo','$servicio','$proveedor','$ubicacion','$fecha','$fecha2','$costo','$m','$pventa','$categoria','$tipo_costo','$id_prov','$observaciones');";
	}
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Servicio NO Registrado</p>';
}else{
	$mensaje.='Servicio Registrado';
}
	

		
		return $mensaje; 
   
   }
   
   
   function agregarAdicional($id_servicio,$costo){
		
	
		$q="UPDATE `servicios` SET `tarifa`=CONCAT(tarifa,'$costo;') WHERE `id` = '$id_servicio';";

		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Servicio NO Registrado</p>';
}else{
	$mensaje.='Servicio Registrado';
}
	

		
		return $mensaje; 
   
   }
   
   
   function registarHabitacion($hotel,$acomodacion,$tipo,$plan){
		
	
	
		$q="INSERT INTO `habitaciones`(`hotel`, `acomodacion`, `tipo`, `plan`) VALUES ('$hotel','$acomodacion','$tipo','$plan');";
		
	//	var_dump($q);
		$resultado=$this->consulta($q);
	
		//return $resultado;
			
		
		
		
		
				if (!$resultado) {
    $mensaje.='Habitacion NO Registrada</p>';
}else{
	$mensaje.='Habitacion Registrada';
}
	

		
		return $mensaje; 
   
   }
   
   function registarTarifaHabitacion($id,$acomodacion,$desde,$hasta,$tarifa){
		
	
	
		$q="INSERT INTO `tarifa_habitacion`(`id_habitacion`, `tarifa`, `acomodacion`, `desde`, `hasta`) VALUES ('$id','$tarifa','$acomodacion','$desde','$hasta');";
		
	//	var_dump($q);
		$resultado=$this->consulta($q);
	
		//return $resultado;
			
		
		
		
		
				if (!$resultado) {
    $mensaje.='Tarifa NO Registrada</p>';
}else{
	$mensaje.='Tarifa Registrada';
}
	

		
		return $mensaje; 
   
   }
   
   
    function registrarTiquete($record){
   	
		$q="
		
		INSERT INTO `sillas`(nombre,`record`, `aerolinea`, `id_grupo`, `radicado`, `cupos_solicitados`, `origen`, `destino`, `ruta`, `vuelo_llegada_destino`, `vuelo_llegada_origen`,`fecha_salida`, `fecha_regreso`, `neta_q`, q,`tadmin`, `politica_tc`, `vlr_tc`, `estado`, `f_deposito`, `deposito_pax`, `f_cambios`, `f_nombres`, `f_emision`, `f_impuestos`,itinerario,recordtc,cupos_originales,cancelacion_sinp,cancelacion_conp) VALUES(
		'".$record['nombre']."','".$record['record']."','".$record['aerolinea']."','".$record['idgrupo']."','".$record['radicado']."','".$record['cupos']."','".$record['origen']."','".$record['destino']."','".$record['ruta']."','".$record['vsalida']."','".$record['vregreso']."','".$record['fh_llegada']."','".$record['fh_regreso']."','".$record['neta']."','".$record['q']."','".$record['ta']."','".$record['politica_tc']."','".$record['valor_tc']."','".$record['estado']."','".$record['fecha_deposito']."','".$record['deposito_pax']."','".$record['f_cambios']."','".$record['f_nombres']."','".$record['f_emision']."','".$record['f_impuestos']."','".$record['itinerario']."','".$record['recordtc']."','".$record['cupos_originales']."','".$record['cancelacion_sinp']."','".$record['cancelacions_conp']."');";
		
//		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Tiquete NO Registrado</p>';
}else{
	$mensaje.='Tiquete Registrado';
}
	

		
		return $mensaje; 
   
   }
   
    function modificarTiquete($record){
   	
		$q="
		
		UPDATE `sillas` SET `record`='".$record['record']."',`aerolinea`='".$record['aerolinea']."',`nombre`='".$record['nombre']."',`id_grupo`='".$record['idgrupo']."',`radicado`='".$record['radicado']."',`cupos_solicitados`='".$record['cupos']."',`origen`='".$record['origen']."',`destino`='".$record['destino']."',`ruta`='".$record['ruta']."',`fecha_salida`='".$record['fh_llegada']."',`fecha_regreso`='".$record['fh_regreso']."',`vuelo_llegada_destino`='".$record['vsalida']."',`vuelo_llegada_origen`='".$record['vregreso']."',`neta_q`='".$record['neta']."',`q`='".$record['q']."',`tadmin`='".$record['ta']."',`politica_tc`='".$record['politica_tc']."',`vlr_tc`='".$record['valor_tc']."',`estado`='".$record['estado']."',`f_deposito`='".$record['fecha_deposito']."',`deposito_pax`='".$record['deposito_pax']."',`recordtc`='".$record['recordtc']."',`f_cambios`='".$record['f_cambios']."',`f_nombres`='".$record['f_nombres']."',`f_emision`='".$record['f_emision']."',`f_impuestos`='".$record['f_impuestos']."',`itinerario`='".$record['itinerario']."' ,`cupos_originales`='".$record['cupos_originales']."',`cancelacion_sinp`='".$record['cancelacion_sinp']."',`cancelacion_conp`='".$record['cancelacion_conp']."' WHERE id = '".$record['contrato']."';";
		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Tiquete NO Registrado</p>';
}else{
	$mensaje.='Tiquete Registrado';
}
	

		
		return $mensaje; 
   
   }
   
    function registrarCalendarioPago($grupo,$id,$fecha,$aerea,$terrestre){
   	
		$q="INSERT INTO `calendario_pagos`(`id`, `id_grupo`, `fecha`, `aerea`, `terrestre`) VALUES('$id','$grupo','$fecha','$aerea','$terrestre');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Calendario NO Registrado</p>';
}else{
	$mensaje.='Calendario Registrado';
}
	

		
		return $mensaje; 
   
   }
  
     function registrarImpuesto($record,$impuesto,$valor){
   	
		$q="INSERT INTO `impuesto`(`record`, `impuesto`, `valor`) VALUES ('$record','$impuesto','$valor');";
		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Impuesto NO Registrado</p>';
}else{
	$mensaje.='Impuesto Registrado';
}
	

		
		return $mensaje; 
   
   }
  
   
       function registrarModificaciones($grupo,$id,$valor,$tipo,$obs){
   	
		$q="INSERT INTO `modificaciones`(`id_viajero`, `id_programa`, `valor`, `tipo`, `concepto`) VALUES('$id','$grupo','$valor','$tipo','$obs');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Modificaciones NO Registradas</p>';
}else{
	$mensaje.='Modificaciones Registradas';
}
	

		
		return $mensaje; 
   
   }
   
   
     function registrarModificacionServicio($grupo,$id,$actividad,$check){
		 
		 $serv=$this->consultaServicioID($actividad);
		 $precioModificacion=0;
		 
		 $tipoServ="PT";
		 
		 if($serv['categoria'] == "TIQUETES"){
		 $tipoServ = "TK";
		 }
		 
		 $prospecto=$this->datosProducto($grupo);
		 $viajeros=$prospecto['cant_viajeros'];
						
     $datediff = strtotime($prospecto['f_llegada'])- strtotime($prospecto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
	 
	 
		 
		if($serv['tipo_costo'] == 'DIRECTO'){
		  $conv= 1;
		  }
		  if($serv['tipo_costo'] == 'POR DIA'){
		  $conv= $dias;
		   }
			
		   if($serv['tipo_costo'] == 'POR NOCHE'){
		  $conv= ($dias-1);
		  }
		  if($serv['tipo_costo'] == 'GRUPAL'){
		  $conv= 1/$viajeros;
		  $grupo= $fi['costo'];
		  }
		  if($serv['tipo_costo'] == 'COMISION'){
		  $conv= 1/$viajeros;
		  }
		 
		 if($check == 1){
		 $precioModificacion=$serv['pventa']*$conv;
		 $men="Adicion servicio:".$serv['nombre'];
		 }
		 if($check == -1){
		 $precioModificacion=-$serv['costo']*$conv;
		  $men="Retiro servicio:".$serv['nombre'];
		 }
   	
		$q="INSERT INTO `modificaciones`(`id_viajero`, `id_programa`, `valor`, `tipo`, `concepto`) VALUES('$id','$grupo','$precioModificacion','$tipoServ','$men');";
		
		//var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Modificaciones NO Registradas</p>';
}else{
	$mensaje.='Modificaciones Registradas';
}
	

		
		return $mensaje; 
   
   }
   
   function registrarViajero($nombres,$apellidos,$documento,$no_documento,$fnacimiento,$email,$telefono,$celular,$ciudad,$direccion,$pasaporte,$fpasaporte,$visa,$fvisa,$p1nombre,$p1apellido,$p1telefono,$p1email,$p2nombre,$p2apellido,$p2telefono,$p2email,$facnombre,$facdocumento,$facnumero,$facciudad,$facdireccion,$facemail,$producto,$otro,$estado_viajero,$observaciones,$tipodoc,$acudientedocumento){
   		
		$mensaje="";
		
		$nombres=strtoupper($nombres);
		$apellidos=strtoupper($apellidos);
		$direccion=strtoupper($direccion);
		$ciudad=strtoupper($ciudad);
		$facnombre=strtoupper($facnombre);
		
		
		$q="INSERT INTO `viajero`(`nombres`, `apellidos`, `documento`, `no_documento`, `fnacimiento`, `email`, `telefono`, `celular`, `ciudad`,`direccion`,`pasaporte`, `pasaporte_vigencia`, `visa_americana`, `visa_vigencia`, `acudiente1_nombre`, `acudiente1_apellido`, `acudiente1_telefono`, `acudiente1_email`, `acudiente2_nombre`, `acudiente2_apellido`, `acudiente2_telefono`, `acudiente2_email`, `facturacion_nombre`, `facturacion_documento`,facturacion_nodocumento,facturacion_ciudad, `facturacion_direccion`, `facturacion_email`,id_grupo,otro,estado,observaciones,acudiente1_tipodoc,acudiente1_documento) VALUES ('$nombres','$apellidos','$documento','$no_documento','$fnacimiento','$email','$telefono','$celular','$ciudad','$direccion','$pasaporte','$fpasaporte','$visa','$fvisa','$p1nombre','$p1apellido','$p1telefono','$p1email','$p2nombre','$p2apellido','$p2telefono','$p2email','$facnombre','$facdocumento','$facnumero','$facciudad','$facdireccion','$facemail','$producto','$otro','$estado_viajero','$observaciones','$tipodoc','$acudientedocumento')";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Viajero no registrado: '.$nombres.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombres.' - Viajero Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
   function subirImagenProducto($archivo,$nombre){
   
   
		$valid_file=true;
	//if no errors...
	if(!$archivo['error'])
	{
		//now is the time to modify the future file name and validate the file
		//$new_file_name = strtolower($archivo['tmp_name']); //rename file
		if($archivo['size'] > (2024000)) //can't be larger than 1 MB
		{
			$valid_file = false;
			$mensaje = 'Oops!  Your file\'s size is to large.';
		}
		
		//if the file has passed the test
		if($valid_file)
		{
			//move it to where we want it to be
			move_uploaded_file($archivo['tmp_name'], 'imagenes/productos/'.$nombre);
			$mensaje = 'Imagen subida.';
		}
	}
	//if there is an error...
	else
	{
		//set that to be the returned message
		$mensaje = 'Ooops!  Your upload triggered the following error:  '.$archivo['error'];
	}
	//var_dump($mensaje);
	return $mensaje;
   }
   
     
   
   function registrarProducto($nombregrupo,$viajeros,$salida,$regreso,$destino,$origen,$encargado,$unidadnegocio,$moneda,$incluye,$itinerario,$terminos,$parametros,$logo,$header,$tiquete,$terrestre,$calendario,$documentacion,$compromisos,$id_prospecto,$asistencia){
   		
		$mensaje="";





		
		$q="INSERT INTO `producto`(`grupo`,`cant_viajeros`, `f_salida`, `f_llegada`,`destino`, `origen`,`encargado`, `unidad_negocio`, `estado`,`MONEDA`, `incluye`, `itinerario`, `terminoscondiciones`, `parametros`,valor_terrestre,valor_aereo,documentacion,id_prospecto, asistencia_id) VALUES ('$nombregrupo','$viajeros','$salida','$regreso','$destino','$origen','$encargado','$unidadnegocio','ACEPTADO','$moneda','$incluye','$itinerario','$terminos','$parametros','$terrestre','$tiquete','$documentacion','$id_prospecto','$asistencia');";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Producto no registrado: '.$nombregrupo.' - Razon:' . mysql_error(). '</p>';
}else{
	
	$q="SELECT MAX(id) as idreg FROM producto";
	//var_dump($q);
		
	$resultado = $this->consulta($q);
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			//var_dump($fi['idreg']);
			if($logo['size'] > 0 ){ 
			$mensaje.=$this->subirImagenProducto($logo,"logo_".$fi['idreg'].".jpg");
			}
			if($header['size'] > 0 ){ 
			$mensaje.=$this->subirImagenProducto($header,"header_".$fi['idreg'].".jpg");
			}
		
		}
	
	$mensaje.=' '.$nombregrupo.' - producto Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
   function modificarProducto($grupo,$nombregrupo,$viajeros,$salida,$regreso,$destino,$origen,$encargado,$unidadnegocio,$moneda,$incluye,$itinerario,$terminos,$parametros,$logo,$header,$tiquete,$terrestre,$calendariopagos,$documentacion,$asistencia){
   		
		$mensaje="";





		
		$q="
		
		UPDATE `producto` SET `grupo`='$nombregrupo',`MONEDA`='$moneda',`valor_terrestre`='$terrestre',`valor_aereo`='$tiquete',`f_salida`='$salida',`f_llegada`='$regreso',`destino`='$destino',`origen`='$origen',`cant_viajeros`='$viajeros',`unidad_negocio`='$unidadnegocio',`encargado`='$encargado',`incluye`='$incluye',`itinerario`='$itinerario',`terminoscondiciones`='$terminos',`parametros`='$parametros', calendario_pagos = '$calendariopagos', documentacion = '$documentacion', asistencia_id = '$asistencia' WHERE id = '$grupo';";
		
//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Producto no registrado: '.$nombregrupo.' - Razon:' . mysql_error(). '</p>';
}else{
	
	
	
			if($logo['size'] > 0 ){ 
			$mensaje.=$this->subirImagenProducto($logo,"logo_".$grupo.".jpg");
			}
			if($header['size'] > 0 ){ 
			$mensaje.=$this->subirImagenProducto($header,"header_".$grupo.".jpg");
			}
		
	
	
	$mensaje.=' '.$nombregrupo.' - producto Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
   
    function modificarContacto($contacto,$idgrupo,$nombre,$telefono,$direccion,$ciudad,$email,$tipo,$origen,$observaciones){
   		
		$mensaje="";





		
		$q="
		
		UPDATE `contacto` SET `nombre`='$nombre',`telefono`='$telefono',`direccion`='$direccion',`ciudad`='$ciudad',`email`='$email',`tipo`='$tipo',`origen`='$origen',`observaciones`='$observaciones' WHERE id = '$contacto';";
		
//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Producto no registrado: '.$nombregrupo.' - Razon:' . mysql_error(). '</p>';
}else{
		
	
	
	$mensaje.=' Contacto Modificado';
}
	

		
		return $mensaje;   
   
   
   }
   
   function exitsteContrato($idsilla,$programa){
   
   		$mensaje="";
		
		
		$q="SELECT count(*) as selec FROM `sillas_grupo` WHERE `id_sillas` = '$idsilla' and `id_programa` = '$programa'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
    function tipohabitacion($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `habitaciones` WHERE `id` = '$id'";
		
	//var_dump($q);
	 $resultado=$this->consulta($q);	
			
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi;
	
   return null;	
		
		
	
   
   }
   
   
    function verObservaciones($doc){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `observaciones_viajero` WHERE `viajeroid` = '$doc'";
		
	//var_dump($q);
	 $resultado=$this->consulta($q);	
			

	
   return $resultado;	
		
		
	
   
   }
   
   
     function valorHabitacion($id,$fecha,$tipo){
   
   		$mensaje="";
		
		
		$q="SELECT MIN(tarifa) as tarifa FROM `tarifa_habitacion` WHERE `id_habitacion` = '".$id."' and `hasta`>= '".$fecha."' and desde<='".$fecha."' and acomodacion = '".$tipo."'";
		
	//var_dump($q);
	 $resultado=$this->consulta($q);	
			
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi['tarifa'];
	
   return 0;	
		
		
	
   
   }
   
   
      function listaNombres($documento,$grupo){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `viajero` WHERE `facturacion_nodocumento` = '$documento' and `id_grupo` = '$grupo' and estado ='VIAJA' ";
		
	//var_dump($q);
	 $resultado=$this->consulta($q);
	 
	 $nombres="";	
			
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
		
		$nombres.="".$fi['nombres']." ".$fi['apellidos']." - ";	
	}
			 return $nombres;
		
		
	
   
   }
   
      function listaViajeros($documento,$grupo){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `viajero` WHERE `facturacion_nodocumento` = '$documento' and `id_grupo` = '$grupo'";
		
	//var_dump($q);
	 $resultado=$this->consulta($q);
	 
	 return $resultado;
		
		
	
   
   }
   
     function registrarFirma($documento,$firma){
   		
		$mensaje="";





		
		$q="UPDATE `viajero` SET `firma`='$firma' WHERE no_documento = '$documento';";
		
//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Firma no registrada:  - Razon:' . mysql_error(). '</p>';
}else{
	
	
	
	$mensaje.='Firma Registrada';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
    function borrarProducto($grupo){
   		
		$mensaje="";





		
		$q="DELETE FROM `producto` WHERE id = '$grupo';";
		
//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Producto no borrado - Razon:' . mysql_error(). '</p>';
}else{
		
	
	$mensaje.='  producto borrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
     function borrarModificacion($id){
   		
		$mensaje="";





		
		$q="DELETE FROM `modificaciones` WHERE `id` = '$id';";
		
//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Modificacion no borrado - Razon:' . mysql_error(). '</p>';
}else{
		
	
	$mensaje.='Modificacion borrada';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   function borrarAdicional($id_servicio,$costo){
		
	
		$q="UPDATE `servicios` SET `tarifa`=
		REPLACE (tarifa, '$costo;', '') WHERE `id` = '$id_servicio';";

		
		var_dump($q);
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Servicio NO Borrado</p>';
}else{
	$mensaje.='Servicio Eliminado';
}
	

		
		return $mensaje; 
   
   }
   
   
   function borrarContacto($id){
   		
		$mensaje="";





		
		$q="DELETE FROM `contacto` WHERE id = '$id';";
		
//var_dump($q);
		
		
		$resultado = $this->consulta($q);
		
		
		//var_dump($id);
				if (!$resultado) {
    $mensaje.='Contacto no borrado - Razon:' . mysql_error(). '</p>';
}else{
		
	
	$mensaje.='  Contacto borrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   function registrarGrupoProspecto($nombregrupo,$viajeros,$salida,$regreso,$destino,$origen,$encargado,$unidadnegocio,$observaciones){
   		
		$mensaje="";
	
		
		$q="INSERT INTO `grupoprospecto`( `nombre_grupo`, `cantidad_viajeros`, `fecha_salida`, `fecha_regreso`, `destino`, `origen`, `encargado`, `unidad_negocio`, `estado`, `observaciones`) VALUES ('$nombregrupo','$viajeros','$salida','$regreso','$destino','$origen','$encargado','$unidadnegocio','REGISTRADO','$observaciones');";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Grupo no registrado: '.$nombregrupo.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombregrupo.' - Grupo Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   function registrarCosteo($nombre,$id_costeo,$id_proveedor,$tipo_costo,$categoria,$id_externo,$vlr,$pventa){
   		
		$mensaje="";
	
		
		$q="
		INSERT INTO `costeos`(`id_costeo`, `id_proveedor`, `tipo_costo`, `categoria`, `id_externa`, `vlr`, `nombre`, pventa) VALUES ('$id_costeo','$id_proveedor','$tipo_costo','$categoria','$id_externo','$vlr','$nombre','$pventa');";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Costeo no registrado: '.$nombre.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombre.' - Costeo Registrado';
}
	

		
		return $mensaje;   
   
   
   }
	
	  function borrarCosteo($id_costeo,$id_item){
   		
		$mensaje="";
	
		
		$q="
		DELETE FROM `costeos` WHERE `id_costeo`= '$id_costeo' and `id` = '$id_item';";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Costeo no borrado - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.='Costeo Borrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   function modificarGrupoProspecto($nombregrupo,$viajeros,$salida,$regreso,$destino,$origen,$encargado,$unidadnegocio,$observaciones,$id){
   		
		$mensaje="";
	
		
		$q="UPDATE `grupoprospecto` SET `nombre_grupo`='$nombregrupo',`cantidad_viajeros`='$viajeros',`fecha_salida`='$salida',`fecha_regreso`='$regreso',`destino`='$destino',`origen`='$origen',`encargado`='$encargado',`unidad_negocio`='$unidadnegocio',`observaciones`='$observaciones' WHERE id = '$id';";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Grupo no modificado: '.$nombregrupo.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombregrupo.' - Grupo modificado';
}
	

		
		return $mensaje;   
   
   
   }
   
	function aprobarCosteoGrupoProspecto($id,$aprobado_por,$fecha_aprobacion,$observaciones,$estado){
   		
		$mensaje="";
	
		
		$q="UPDATE `grupoprospecto` SET `aprobado_por`='$aprobado_por',`fecha_aprobacion`='$fecha_aprobacion',`observaciones_aprobacion`='$observaciones' , estado_aprobacion = '$estado' WHERE id = '$id';";
		
	var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Costeo no aprobado - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' Costeo Aprobado';
}
	

		
		return $mensaje;   
   
   
   }
   
    function registrarContacto($id_grupo,$nombre,$telefono,$direccion,$ciudad,$email,$tipo,$origen,$observaciones){
   		
		$mensaje="";
	
		
		$q="INSERT INTO `contacto`(id_grupo, `nombre`, `telefono`, `direccion`, ciudad, `email`, `tipo`, `origen`, `observaciones`) VALUES ('$id_grupo','$nombre','$telefono','$direccion','$ciudad','$email','$tipo','$origen','$observaciones');";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Contacto no registrado: '.$nombre.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombre.' - Contacto Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   function registrarActividad($id_grupo,$nombre,$lugar,$fecha,$hora,$contacto,$observaciones){
   		
		$mensaje="";
	
		
		$q="INSERT INTO `actividades_prospecto`(`grupo`, `fecha`, `hora`, `lugar`, `contacto`, `actividad`, `participantes`, `observaciones`) VALUES ('$id_grupo','$fecha','$hora','$lugar','$contacto','$nombre','','$observaciones');";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Actividad no registrado: '.$nombre.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombre.' - Actividad Registrada';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
   function actualizarDatos($documento,$nombres,$apellidos,$fnacimiento,$email,$telefono,$celular,$ciudad,$direccion,$pasaporte,$fpasaporte,$visa,$fvisa,$p1nombre,$p1apellido,$p1telefono,$p1email,$p2nombre,$p2apellido,$p2telefono,$p2email,$facnombre,$facdireccion,$facemail){
   		
		$mensaje="";
		
		
		
		$nombres=strtoupper($nombres);
		$apellidos=strtoupper($apellidos);
		$direccion=strtoupper($direccion);
		$ciudad=strtoupper($ciudad);
		$facnombre=strtoupper($facnombre);
		
		
		$q="
		
		
		UPDATE `viajero` SET `nombres`='$nombres',`apellidos`='$apellidos',`fnacimiento`='$fnacimiento',`email`='$email',`telefono`='$telefono',`celular`='$celular',`ciudad`='$ciudad',`direccion`='$direccion',`pasaporte`='$pasaporte',`pasaporte_vigencia`='$fpasaporte',`visa_americana`='$visa',`visa_vigencia`='$fvisa',`acudiente1_nombre`='$p1nombre',`acudiente1_apellido`='$p1apellido',`acudiente1_telefono`='$p1telefono',`acudiente1_email`= '$p1email',`acudiente2_nombre`='$p2nombre',`acudiente2_apellido`='$p2apellido',`acudiente2_telefono`='$p2telefono',`acudiente2_email`='$p2email',`facturacion_nombre`='$facnombre',`facturacion_direccion`='$facdireccion',`facturacion_email`='$facemail' WHERE no_documento = '$documento';";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Viajero no registrado: '.$nombres.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombres.' - Viajero Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   function actualizarDatosSuper($id,$documento,$no_documento,$nombres,$apellidos,$fnacimiento,$email,$telefono,$celular,$ciudad,$direccion,$pasaporte,$fpasaporte,$visa,$fvisa,$p1nombre,$p1apellido,$p1telefono,$p1email,$p2nombre,$p2apellido,$p2telefono,$p2email,$facnombre,$facdireccion,$facemail,$fadocumento,$id_grupo,$otro){
   		
		$mensaje="";
		
		
		
		$nombres=strtoupper($nombres);
		$apellidos=strtoupper($apellidos);
		$direccion=strtoupper($direccion);
		$ciudad=strtoupper($ciudad);
		$facnombre=strtoupper($facnombre);
		
		
		$q="
		
		
		UPDATE `viajero` SET documento = '$documento', no_documento= '$no_documento',`nombres`='$nombres',`apellidos`='$apellidos',`fnacimiento`='$fnacimiento',`email`='$email',`telefono`='$telefono',`celular`='$celular',`ciudad`='$ciudad',`direccion`='$direccion',`pasaporte`='$pasaporte',`pasaporte_vigencia`='$fpasaporte',`visa_americana`='$visa',`visa_vigencia`='$fvisa',`acudiente1_nombre`='$p1nombre',`acudiente1_apellido`='$p1apellido',`acudiente1_telefono`='$p1telefono',`acudiente1_email`= '$p1email',`acudiente2_nombre`='$p2nombre',`acudiente2_apellido`='$p2apellido',`acudiente2_telefono`='$p2telefono',`acudiente2_email`='$p2email',`facturacion_nombre`='$facnombre',`facturacion_direccion`='$facdireccion', `facturacion_nodocumento`='$fadocumento',`facturacion_email`='$facemail', id_grupo = '$id_grupo', otro = '$otro' WHERE id = '$id';";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.='Viajero no registrado: '.$nombres.' - Razon:' . mysql_error(). '</p>';
}else{
	$mensaje.=' '.$nombres.' - Viajero Registrado';
}
	

		
		return $mensaje;   
   
   
   }
   
   
   
   
   function actualizarCheklist($valor,$id){
   
   $mensaje="";
		
		
		$q="UPDATE `grupoprospecto` SET `checklist`='$valor' WHERE `id` = '$id'";
		
	var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.=' Error' . mysql_error(). '</p>';
}else{
	$mensaje.=' OK';
}
	

		
		return $mensaje;   
   }
   
   
   function actualizarFacturado($servicio,$facturado,$observaciones){
   
   $mensaje="";
		
		
		$q="UPDATE `servicios` SET `facturado`='$facturado', observaciones = '$observaciones' WHERE `id` = '$servicio'";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.=' Error' . mysql_error(). '</p>';
}else{
	$mensaje.=' OK';
}
	

		
		return $mensaje;   
   }
   
   
   
   function actualizarCampo($campo,$valor,$donde,$id){
   
   $mensaje="";
		
		
		$q="UPDATE `viajero` SET $campo='$valor' WHERE $donde = '$id'";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.=' Error' . mysql_error(). '</p>';
}else{
	$mensaje.=' OK';
}
	

		
		return $mensaje;   
   }
   
   
   function actualizarEstadoSillas($id,$valor){
   
   $mensaje="";
		
		
		$q="
		UPDATE `sillas` SET `estado`='$valor' WHERE `id` = '$id'";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.=' Error' . mysql_error(). '</p>';
}else{
	$mensaje.=' OK';
}
	

		
		return $mensaje;   
   }
   
   
   function actualizarHistorialSillas($id){
   
   $mensaje="";
		
		
		$q="
		UPDATE `sillas` SET `historial`='1' WHERE `id` = '$id'";
		
	//var_dump($q);
		
		
		$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.=' Error' . mysql_error(). '</p>';
}else{
	$mensaje.=' OK';
}
	

		
		return $mensaje;   
   }
   
   function equivProducto($plan){
   
   if($plan == 1){
	   return "PUJ 2015 LA ARBOLEDA";
   	}
	 if($plan == 2){
	   return "CUN 2015 COL BILINGUE SANTA MARTA";
   	}
	
	 if($plan == 3){
	   return "PUJ 2015 LICEO FRANCES CALI";
   	}
	
	 if($plan == 4){
	   return "CUN 2015 COLOMBO BRITANICO";
   	}
	
		 if($plan == 5){
	   return "CUN 2015 TILATÁ";
   	}
	
	 if($plan == 6){
	   return "CUN 2015 LICEO FRANCES PEREIRA";
   	}
	
		 if($plan == 7){
	   return "CUN 2015 ALEMAN";
   	}
	
		 if($plan == 8){
	   return "CUN 2015 GOLFISTAS";
   	}
   }
   
   function datosViajero($documento){
   
   		$mensaje="";
		
		
		$q="SELECT `id`,id_grupo, `nombres`, `apellidos`, `documento`, `no_documento`, `fnacimiento`, `email`, `telefono`, `celular`,direccion, ciudad, `pasaporte`, `pasaporte_vigencia`, `visa_americana`, `visa_vigencia`, `acudiente1_nombre`, `acudiente1_apellido`, `acudiente1_telefono`, `acudiente1_email`, `acudiente2_nombre`, `acudiente2_apellido`, `acudiente2_telefono`, `acudiente2_email`, `facturacion_nombre`, `facturacion_documento`, `facturacion_nodocumento`, facturacion_ciudad, `facturacion_direccion`, `facturacion_email`, `fregistro`, `doc_identidad`, `doc_pasaporte`, doc_rut, firma, `doc_permiso`, doc_visa, record, otro, acudiente1_tipodoc, acudiente1_documento FROM `viajero` WHERE no_documento = '$documento' order by id desc";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }



function datosContrato($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `sillas` WHERE `id` = '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   function datosContratoRecord($record){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `sillas` WHERE `record` = '$record'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
   
   
   function datosRecordPrograma($record,$programa){
   
   		$mensaje="";
		
		
		$q="SELECT *, sillas_grupo.principal as ppal FROM `sillas_grupo`, sillas WHERE sillas.id = sillas_grupo.id_sillas and sillas.record = '$record' and sillas_grupo.id_programa = '$programa'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }


   function datosModificaciones($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `modificaciones` WHERE `id_viajero`= '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function datosModificacionesNIT($id,$programa){
   
   		$mensaje="";
		
		
		$q="SELECT *, modificaciones.id as identificador FROM `modificaciones`, viajero WHERE `id_viajero`= viajero.id and viajero.facturacion_nodocumento = '".$id."' and viajero.id_grupo = '".$programa."'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
    function impuestosContrato($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `impuesto` WHERE `record`= '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   function dolar($fecha){
   
   		$mensaje="";
		
		
		$q="SELECT max(trm) as trm FROM `pago` where fecha = '$fecha'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
    function voucher($id){
   
   		$mensaje="";
		
		
		$q="SELECT `id_viajero`, `voucher`, `fecha_registro` FROM `asistencia` WHERE `id_viajero`= '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi['voucher'];
	
   return null;
   }
   
    function datosVoucher($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `asistencia` WHERE `id_viajero`= '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi;
	
   return null;
   }
   
   
   
   
    function impuestosRecord($record){
   
   		$mensaje="";
		
		
		$q="SELECT sum(valor) as impuestos FROM `impuesto` WHERE record =  '$record'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi['impuestos'];
	
   return null;
   }
   
     function consultarModificaciones($id_viajero,$id_grupo,$tipo){
  		 $mensaje="";
		
		
		$q="SELECT sum(valor) as total FROM `modificaciones` WHERE `id_viajero` = '$id_viajero' and `id_programa`= '$id_grupo' and tipo = '$tipo'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
	if($fi['total'] != ''){
			 return $fi['total'];
	}else{ return 0;}
	
   return 0;
   }
   
   
   
   
   function nombreHoteles($programa){
   
   		$mensaje="";
		
		
		$q="SELECT  `id` ,  `id_producto` ,  `hotel` ,  `ubicacion` ,  `direccion` ,  `telefono` ,  `fecha_llegada` ,  `fecha_salida` 
FROM  `alojamiento` 
WHERE  `id_producto` = '$programa'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi['hotel'];
	
   
   }
	
	function infoHoteles($programa){
   
   		$mensaje="";
		
		
		$q="SELECT  `id` ,  `id_producto` ,  `hotel` ,  `ubicacion` ,  `direccion` ,  `telefono` ,  `fecha_llegada` ,  `fecha_salida` 
FROM  `alojamiento` 
WHERE  `id_producto` = '$programa'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi;
	
   
   }
   
    function urlHoteles($programa){
   
   		$mensaje="";
		
		
		$q="SELECT  `id` ,  `id_producto` ,  `hotel` ,  `ubicacion` ,  `direccion` ,  `telefono` , web,  `fecha_llegada` ,  `fecha_salida` 
FROM  `alojamiento` 
WHERE  `id_producto` = '$programa'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 return $fi['web'];
	
   
   }
   
   
   
    function cambiarContra($usuario,$actual,$nueva){
   
   		$mensaje="";
		
		
		$q="SELECT `user_id`, `usuario`, `nombre`, `email`, `password`, `nivel` FROM `usuarios` WHERE `user_id` =  '$usuario'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
			 if($fi['password'] == $actual){
			 
			 $q="UPDATE `usuarios` SET `password`= '$nueva' WHERE `user_id` = '$usuario'";
			 
			 	$resultado = $this->consulta($q);
				if (!$resultado) {
    $mensaje.=' Error' . mysql_error(). '</p>';
}else{
	$mensaje.=' Contraseña ha sido cambiada';
}
			 
			 }else{
				$mensaje="la contraseña no es correcta"; 
			 }
	return $mensaje;
   
   }
   
   
   function datosViajeroID($id){
   
   		$mensaje="";
		
		
		$q="SELECT `id`,id_grupo, `nombres`, `apellidos`, `documento`, `no_documento`, `fnacimiento`, `email`, `telefono`, `celular`,direccion, ciudad, `pasaporte`, `pasaporte_vigencia`, `visa_americana`, `visa_vigencia`, `acudiente1_nombre`, `acudiente1_apellido`, `acudiente1_telefono`, `acudiente1_email`, `acudiente2_nombre`, `acudiente2_apellido`, `acudiente2_telefono`, `acudiente2_email`, `facturacion_nombre`, `facturacion_documento`, `facturacion_nodocumento`, `facturacion_direccion`, `facturacion_email`, `fregistro`, `doc_identidad`, `doc_pasaporte`, `doc_permiso`, doc_rut, doc_visa, otro, record, control FROM `viajero` WHERE id = '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
   function contactosProspecto($idgrupo){
   
   		$mensaje="";
		
		if($idgrupo == 0){
			$q="SELECT contacto.id,  `id_grupo` ,  `nombre` ,  `telefono` ,  `direccion` ,  `email` ,  `tipo` , ciudad,contacto.origen, contacto.observaciones, contacto.estado, grupoprospecto.nombre_grupo
FROM  `contacto` , grupoprospecto
WHERE grupoprospecto.id = contacto.id_grupo";
		}else{
		$q="SELECT `id`, `id_grupo`, `nombre`, `telefono`, `direccion`, ciudad, `email`, `tipo`, `origen`, estado, `observaciones` FROM `contacto` WHERE id_grupo = '$idgrupo'";}
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
    function consultaTiquetes($idgrupo){
   
   		$mensaje="";
		
			$q="SELECT `id`, `id_producto`, `aerolinea`, `vuelo`, `fecha`, `origen`, `destino`, `hora_sale`, `hora_llega` FROM `tiquetes` WHERE `id_producto` = '$idgrupo'";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
    function borraTiquetes($id){
   
   		$mensaje="";
		
			$q="DELETE FROM `tiquetes` WHERE `id` = '$id'";
		
		
		
  //var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   function borraHotel($id){
   
   		$mensaje="";
		
			$q="DELETE FROM `alojamiento` WHERE `id` = '$id'";
		
		
		
  //var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   function borraAdicional($id){
   
   		$mensaje="";
		
			$q="DELETE FROM `servicios` WHERE `id` = '$id'";
		
		
		
  var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }


function consultaHotel($idgrupo){
   
   		$mensaje="";
		
			$q="SELECT  `id`, hotel, `id_producto`, `ubicacion`, direccion, telefono, `fecha_llegada`, `fecha_salida` FROM `alojamiento` WHERE `id_producto` = '$idgrupo'";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
	function calcularCostoIndividual($ac,$viajeros,$dias){
		$fi['tipo_costo']=$ac['tipo_costo'];
		$fi['costo']=$ac['facturado'];
							  
								//var_dump($ac);
							   if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['costo'];
							  $grupo= $fi['costo']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['costo']*$dias;
							  $grupo= $fi['costo']*$dias*$viajeros;
							  }
							 	
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['costo']*($dias-1);
							  $grupo= $fi['costo']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['costo']/$viajeros;
							  $grupo= $fi['costo'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['costo']/$viajeros;
							  $grupo= $fi['costo'];
							  }
		return $unitario;
	}
   
   function consultaServicios($idgrupo){
   
   		$mensaje="";
		
			$q="SELECT `id`, `id_producto`, `nombre`, `proveedor`, `ubicacion`, `fecha`, `fecha_out`, costo, pventa, tarifa, categoria, tipo_costo, facturado, proveedor_id, observaciones FROM `servicios` WHERE  `id_producto` = '$idgrupo' order by fecha asc, categoria;";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   function consultaServiciosProveedorGrupo($idgrupo,$proveedor){
   
   		$mensaje="";
		
			$q="SELECT `id`, `id_producto`, `nombre`, `proveedor`, `ubicacion`, `fecha`, `fecha_out`, costo, pventa, tarifa, categoria, tipo_costo, facturado, observaciones FROM `servicios` WHERE  `id_producto` = '$idgrupo' and proveedor_id ='$proveedor' ";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   
   function consultaProveedores($idgrupo){
   
   		$mensaje="";
		
			$q="SELECT DISTINCT proveedores.* FROM `servicios`, proveedores WHERE  `id_producto` = '$idgrupo' and servicios.proveedor_id = proveedores.id order by nombre";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
	  
   function consultaPagosProveedor(){
   
   		$mensaje="";
		
			$q="SELECT id_proveedor, sum(valor) as total, moneda FROM `pago_proveedor` WHERE `validado` =1  GROUP by id_proveedor, moneda";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function consultaServiciosDia($idgrupo,$fecha){
   
   		$mensaje="";
		
			$q="SELECT * FROM `servicios` WHERE `id_producto` = '$idgrupo' and `fecha` >= '$fecha 00:00:00' and fecha <= '$fecha 23:59:00' order by fecha asc";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
    function consultaServicioID($id){
   
   		$mensaje="";
		
			$q="SELECT * FROM `servicios` WHERE  `id` = '$id'";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
		  	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			return $fi;
			}
			return null;
   
   }
   
   
   function datosProveedor($id){
   
   		$mensaje="";
		
			$q="SELECT * FROM `proveedores` WHERE `id` = '$id'";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
		  	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			return $fi;
			}
			return null;
   
   }
   
    function datosAsistencia($id){
   
   		$mensaje="";
		
			$q="SELECT * FROM `seguro_asistencia` WHERE `id` = '$id'";
		
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
		  	while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			return $fi;
			}
			return null;
   
   }
   
   
   function consultaCalendarioPagos($idgrupo){
   
   		$mensaje="";
		
			$q="SELECT `id`, `id_grupo`, `fecha`, `aerea`, `terrestre` FROM `calendario_pagos` WHERE  `id_grupo` = '$idgrupo'";
		
		
		
	//	var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function consultaCalendarioPagosFecha($idgrupo,$fecha){
   
   		$mensaje="";
		
			$q="SELECT `id`, `id_grupo`, `fecha`, `aerea`, `terrestre` FROM `calendario_pagos` WHERE  `id_grupo` = '$idgrupo' and fecha = '$fecha'";
		
		
		
	//	var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
   function totalInscritosFecha($idgrupo,$anio,$mes){
   
   
   		$mensaje="";
		
		if($idgrupo == 0){
			$q="SELECT count(*) as inscritos FROM `viajero`, producto WHERE unidad_negocio = 'GRUPOS JUVENILES' and producto.id = viajero.id_grupo  and YEAR(fregistro) = '$anio' and MONTH(fregistro) = '$mes' ";
			
		}else{
		
			$q="SELECT count(*) as inscritos FROM `viajero` WHERE YEAR(fregistro) = '$anio' and MONTH(fregistro) = '$mes' and `id_grupo` = '$idgrupo'";
		}
		
		
	//	var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
    function totalPagosFecha($idgrupo,$anio,$mes){
   
   		$mensaje="";
		
		if($idgrupo == 0){
			$q="SELECT DISTINCT viajero.id as pagos FROM `pago`, viajero, producto WHERE YEAR(pago.fecha) = '$anio' and MONTH(pago.fecha) = '$mes' and pago.id_viajero = viajero.id and producto.unidad_negocio = 'GRUPOS JUVENILES' and producto.id = viajero.id_grupo and pago.valor_TIK > -1 and pago.valor_PT > -1 and pago.validado = 1 and producto.estado = 'ACEPTADO'";
			//$q="SELECT DISTINCT viajero.id as pagos FROM `pago`, viajero, producto WHERE YEAR(pago.fecha) = '$anio' and MONTH(pago.fecha) = '$mes' and pago.id_viajero = viajero.id and producto.unidad_negocio = 'GRUPOS JUVENILES' and pago.valor_TIK > -1 and pago.valor_PT > -1 and pago.validado = 1 and producto.estado <> 'HISTORIAL' and producto.id = viajero.id_grupo";
		}else{
			$q="
			SELECT DISTINCT viajero.id as pagos FROM `pago`, viajero, producto WHERE YEAR(pago.fecha) = '$anio' and MONTH(pago.fecha) = '$mes' and pago.id_viajero = viajero.id and producto.unidad_negocio = 'GRUPOS JUVENILES' and `id_grupo` = '$idgrupo' and pago.valor_TIK > -1 and pago.valor_PT > -1 and pago.validado = 1 and producto.id = viajero.id_grupo";
		}
		
		
		//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   
    function actividadesProspecto($idgrupo){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `grupo`, `fecha`, `hora`, `lugar`, `contacto`, `actividad`, `participantes`, `observaciones` FROM `actividades_prospecto` WHERE  grupo = '$idgrupo'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function fechasPagos(){
   
   		$mensaje="";
		
		
		$q='SELECT min(fecha) as minfecha, max(fecha) as maxfecha FROM `calendario_pagos`, producto WHERE calendario_pagos.id_grupo = producto.id and producto.unidad_negocio="GRUPOS JUVENILES" and producto.estado="ACEPTADO"';
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
    function maximaFechaViaje(){
   
   		$mensaje="";
		
		
		$q='SELECT  max(f_salida) as maxfecha FROM  producto WHERE producto.unidad_negocio="GRUPOS JUVENILES" and producto.estado="ACEPTADO"';
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
    function FechasViajeGral(){
   
   		$mensaje="";
		
		
		$q='SELECT  min(f_salida) as minfecha, max(f_llegada) as maxfecha FROM  producto WHERE producto.estado="ACEPTADO"';
		
	var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
   
   function datosProspecto($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `grupoprospecto` WHERE `id`  = '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   function consultarPago($id){
	   
	   $mensaje="";
		
		
		$q="SELECT `id`, `id_viajero`, `fecha`, `medio`, `valor_TIK`, `valor_PT`, `fee`, `trm`, `id_producto`, `observaciones`, `validado` FROM `pago` WHERE id = '$id'";
		
//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   function datosProducto($id){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `grupo`, `MONEDA`, `valor_terrestre`, `valor_aereo`, `f_salida`, `f_llegada`, `destino`, `origen`, `cant_viajeros`, `unidad_negocio`, `encargado`, `incluye`, `calendario_pagos`, `itinerario`, `terminoscondiciones`, documentacion, compromisos,  `parametros`, `estado`, `nombre_tarifa1`, `nombre_tarifa2`, `valor_terrestre_tarifa2`, `valor_aereo_tarifa2`, `nombre_tarifa3`, `valor_terrestre_tarifa3`, `valor_aereo_tarifa3`, `nombre_tarifa4`, `valor_terrestre_tarifa4`, `valor_aereo_tarifa4`, `nombre_tarifa5`, `valor_terrestre_tarifa5`, `valor_aereo_tarifa5`,`nombre_tarifa6`, `valor_terrestre_tarifa6`, `valor_aereo_tarifa6`,`nombre_tarifa7`, `valor_terrestre_tarifa7`, `valor_aereo_tarifa7`,`nombre_tarifa8`, `valor_terrestre_tarifa8`, `valor_aereo_tarifa8`,`nombre_tarifa9`, `valor_terrestre_tarifa9`, `valor_aereo_tarifa9`,`nombre_tarifa10`, `valor_terrestre_tarifa10`, `valor_aereo_tarifa10`,  `nombre_tarifa3`,  `nombre_tarifa4`,  `nombre_tarifa5`,  `nombre_tarifa6`,  `nombre_tarifa7`,  `nombre_tarifa8`,  `nombre_tarifa9`,  `nombre_tarifa10`, id_prospecto, asistencia_id FROM `producto` WHERE `id`  = '$id'";
		
//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   function viajerosPrincipal($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `viajero`, sillas_grupo WHERE `id_grupo` = id_programa and sillas_grupo.principal = 1 and viajero.record = '' and id_sillas = '".$id."' and viajero.estado = 'VIAJA'";
		
// var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function viajerosRecord($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `viajero`, sillas WHERE  viajero.record = sillas.record and sillas.id = '".$id."' and viajero.estado = 'VIAJA'";
		
// var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   
    function datosContacto($id){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `id_grupo`, `nombre`, `telefono`, `direccion`,ciudad, `email`, `tipo`, `origen`, `observaciones`, `fecha_registro` FROM `contacto` WHERE `id`  = '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }


function pagosViajero($idViajero){
   
   		$mensaje="";
		
		$viajero=$this->datosViajeroID($idViajero);
		
		$q="
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE, count(DISTINCT viajero.id) as viajeros FROM `pago`, viajero WHERE viajero.id = pago.id_viajero AND viajero.facturacion_nodocumento = ".$viajero['facturacion_nodocumento']." AND viajero.id_grupo = ".$viajero['id_grupo']." AND validado = 1";
		
		//ANTIGUA VERSION
		/*	
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago` WHERE `id_viajero` = ".$idViajero." AND validado = 1 group by `id_viajero`
		*/
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
	
	function cantidadViajerosNit($idViajero){
   
   		$mensaje="";
		
		$viajero=$this->datosViajeroID($idViajero);
		
		$q="
		SELECT count(DISTINCT viajero.id) as viajeros FROM viajero WHERE viajero.facturacion_nodocumento = ".$viajero['facturacion_nodocumento']." AND viajero.id_grupo = ".$viajero['id_grupo']." ;";
		
		//ANTIGUA VERSION
		/*	
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago` WHERE `id_viajero` = ".$idViajero." AND validado = 1 group by `id_viajero`
		*/
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
	
	
	function pagosViajerounoauno($idViajero){
   
   		$mensaje="";
		
		$viajero=$this->datosViajeroID($idViajero);
		
		$q="
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago`, viajero WHERE viajero.id = pago.id_viajero AND viajero.id = ".$viajero['id']." AND viajero.id_grupo = ".$viajero['id_grupo']." AND validado = 1 group by `id_viajero`";
		
		//ANTIGUA VERSION
		/*	
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago` WHERE `id_viajero` = ".$idViajero." AND validado = 1 group by `id_viajero`
		*/
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   function pagosViajeroTRM($idViajero){
   
   		$mensaje="";
		
		$viajero=$this->datosViajeroID($idViajero);
		
		$q="
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`*trm) as pagosTIK, SUM(`valor_PT`*trm) as pagosPT, SUM(`fee`*trm) as pagosFEE FROM `pago`, viajero WHERE viajero.id = pago.id_viajero AND viajero.facturacion_nodocumento = ".$viajero['facturacion_nodocumento']." AND viajero.id_grupo = ".$viajero['id_grupo']." AND validado = 1 group by `id_viajero`";
		
		//ANTIGUA VERSION
		/*	
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago` WHERE `id_viajero` = ".$idViajero." AND validado = 1 group by `id_viajero`
		*/
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   function pagosViajeroID($idViajero){
   
   		$mensaje="";
		
		$viajero=$this->datosViajeroID($idViajero);
		
		$q="
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago`, viajero WHERE viajero.id = pago.id_viajero AND viajero.id = ".$viajero['id']." AND viajero.id_grupo = ".$viajero['id_grupo']." AND validado = 1 group by `id_viajero`";
		
		//ANTIGUA VERSION
		/*	
		SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago` WHERE `id_viajero` = ".$idViajero." AND validado = 1 group by `id_viajero`
		*/
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }

   
   

function pagosNIT($nit){
   
   		$mensaje="";
		
		
		$q="SELECT MAX(`fecha`) as ultimafecha, SUM(`valor_TIK`) as pagosTIK, SUM(`valor_PT`) as pagosPT, SUM(`fee`) as pagosFEE FROM `pago`, viajero WHERE `id_viajero` = viajero.id and facturacion_nodocumento = ".$nit." AND validado = 1 group by `id_viajero`";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  if($resultado){
			return mysql_fetch_array($resultado, MYSQL_ASSOC);}else
			{
				return 0;
			}
	
   
   }
   
   
   function listaUsuarios(){
   
   		$mensaje="";
		
		
		$q="SELECT `user_id`, `usuario`, `nombre`, `email`, `password`, `nivel` FROM `usuarios` WHERE 1";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   
     function listaAerolineas(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `nombre` FROM `aerolineas` WHERE 1";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   
   function listaContactos($idgrupo){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `id_grupo`, `nombre`, `telefono`, `direccion`, `email`, `tipo`, `origen`, `observaciones`, `fecha_registro` FROM `contacto` WHERE  id_grupo = '$idgrupo'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function listaEstadosProspecto($cat){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `estado`, `potencial` FROM `estados_prospecto` WHERE categoria ='$cat'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function listaEstadosContacto(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `estado`, `potencial` FROM `estados_contacto` WHERE 1";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return $resultado;
	
   
   }
   
   function login($usuario,$contrasena){
   
   		$mensaje="";
		
		
		$q="SELECT `user_id`, `usuario`, `email`, `password`, `nivel` FROM `usuarios` WHERE usuario = '$usuario'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				if($fi['password'] == $contrasena){
					$_SESSION['nivel']=$fi['nivel'];
					$_SESSION['password']=$contrasena;
							$_SESSION['email']=$fi['email'];
							$_SESSION['id']=$fi['user_id'];
							
					
					return true;
				}else{
				return false;
				}
			}
			
			
	
   
   }
   
   
    
   function panel1($unidad){
   
   		$mensaje="";
		
		
		$q="SELECT COUNT( * ) as cant FROM  `producto` WHERE  `estado` =  'ACEPTADO' and unidad_negocio = '$unidad'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				
					return $fi['cant'];
			
			}
			
			
	
   
   }
   
   function panelA($unidad){
   
   		$mensaje="";
		
		
		$q="SELECT SUM( cant_viajeros ) as cant FROM  `producto` WHERE  `estado` =  'ACEPTADO' and unidad_negocio = '$unidad'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				
					return $fi['cant'];
			
			}
			
			
	
   
   }
	function contarViajerosActividad($actividad){
		$actividad=$this->consultaServicioID($actividad);
		$programa = $this->datosProducto($actividad['id_producto']);
		//SELECT sum(poner) as adicionados FROM `viajero_actividad` WHERE `id_actividad` = 709
		
		$total_viajeros=0;
		$tr=explode(";",$actividad['tarifa']);
		$qs='';
		foreach($tr as $tarif){
			if($tarif>=1){
				$total_viajeros+=$this->viajerosTarifa($programa['nombre_tarifa'.$tarif],$programa['id']);
				$qs.=" and viajero.otro <> '".$programa['nombre_tarifa'.$tarif]."' ";
				$qd.=" viajero.otro = '".$programa['nombre_tarifa'.$tarif]."' or ";
			}
		}
		$qd=substr($qd,0,-3);
			
	//	var_dump($total_viajeros);
		$q="SELECT sum(poner) as adicionados FROM `viajero_actividad`, viajero WHERE `id_actividad` = '".$actividad['id']."' and viajero.id = viajero_actividad.id_viajero and poner = 1 ".$qs;
		//var_dump($q);
		$resultado= $this->consulta($q);	
			$fi = mysql_fetch_array($resultado, MYSQL_ASSOC);
			$modificados=$fi['adicionados'];
		
		$q="SELECT sum(poner) as adicionados FROM `viajero_actividad`, viajero WHERE `id_actividad` = '".$actividad['id']."' and viajero.id = viajero_actividad.id_viajero and poner = -1  and (".$qd.") ";
		//var_dump($q);
		$resultado= $this->consulta($q);	
			$fi = mysql_fetch_array($resultado, MYSQL_ASSOC);
			$restar=$fi['adicionados'];
		
		//var_dump($restar);
		
		
		
		//var_dump($modificados);
		
		$total_viajeros+=$modificados+$restar;
		
		return $total_viajeros;
			
		
		
	}
   
   function validarActividad($viajero,$actividad){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `viajero_actividad` WHERE `id_viajero` ='".$viajero."' and `id_actividad` = '".$actividad."' ";
		
	//var_dump($q);
		  $resultado= $this->consulta($q);	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
				
					return $fi;
			
			}
			
			
	
   
   }
   
   function panel2(){
   
   		$mensaje="";
		
		
		$q="SELECT count(*) as cant FROM `viajero`, producto WHERE `id_grupo` = producto.id and producto.estado = 'ACEPTADO' and producto.unidad_negocio = 'GRUPOS JUVENILES'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				
					return $fi['cant'];
			
			}
			
			
	
   
   }
   
   
   function nombreUsuario($id){
   
   		$mensaje="";
		
		
		$q="SELECT `user_id`, `usuario`, nombre, `email`, `password`, `nivel` FROM `usuarios` WHERE user_id = '$id'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['nombre'];
							
					
				
			}
			
			
	
   
   }
   
  function tieneActividad($id_viajero,$id_actividad){
  		
  }
   
   

   
   function viajeroActividades($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.* FROM viajero, producto WHERE producto.id = viajero.id_grupo and producto.estado <> 'HISTORIAL'";
		
			if($grupo == 0){
			
			//$q .=" WHERE 1";
		
			
		}else{
		$q .=" AND id_grupo = '$grupo'";
		}
//var_dump($q);
	  $q.=" ORDER BY otro desc, viajero.facturacion_nodocumento, nombres ";
		
		
		  return $this->consulta($q);	
			
	
   
   }
   function tildes($str){
   $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
$str = strtr( $str, $unwanted_array );

return $str;
   }
   
   function inscritos($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, viajero.observaciones, viajero.tiquete, producto.grupo as producto, producto.f_salida, producto.f_llegada FROM viajero, producto WHERE producto.id = viajero.id_grupo";
		
			if($grupo == 0){
			
			//$q .=" WHERE 1";
			
		$q .=" AND producto.estado <> 'HISTORIAL'";
			
		}else{
		$q .=" AND id_grupo = '$grupo'";
		}
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
	 function inscritosbuscar($grupo,$termino){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, viajero.observaciones, viajero.tiquete, producto.grupo as producto, producto.f_salida, producto.f_llegada FROM viajero, producto WHERE producto.id = viajero.id_grupo and (nombres like '%$termino%' or apellidos like '%$termino%'  or no_documento like '%$termino%' )";
		
			if($grupo == 0){
			
			//$q .=" WHERE 1";
			
		$q .=" AND producto.estado <> 'HISTORIAL'";
			
		}else{
		$q .=" AND id_grupo = '$grupo'";
		}
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
	
	 function serviciosLista($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT DISTINCT proveedores.id as idprov, proveedores.nombre as nombre FROM  producto, proveedores, servicios WHERE servicios.id_producto = producto.id and producto.estado <> 'HISTORIAL' and proveedores.id = servicios.proveedor_id ";
		
			if($grupo == 0){
			
	
			
		}else{
		$q .=" AND servicios.id_producto = '$grupo'";
		}
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
    function viajerosViajanRecord($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, viajero.record_emitido,viajero.observaciones, viajero.tiquete FROM viajero, producto WHERE producto.id = viajero.id_grupo and viajero.estado = 'VIAJA' AND id_grupo = '$grupo' order by record";
		
	
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function viajerosNIT($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, viajero.record_emitido,viajero.observaciones, viajero.tiquete FROM viajero, producto WHERE producto.id = viajero.id_grupo and viajero.estado = 'VIAJA' AND id_grupo = '$grupo' order by facturacion_nodocumento";
		
	
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
      function viajerosViajanRooming($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, viajero.record_emitido,viajero.observaciones, viajero.tiquete, contrato_ok FROM viajero, producto WHERE producto.id = viajero.id_grupo and viajero.estado = 'VIAJA' AND id_grupo = '$grupo' order by apellidos";
		
	
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
	
	   function viajerosTodosRooming($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, viajero.record_emitido,viajero.observaciones, viajero.tiquete, contrato_ok FROM viajero, producto WHERE producto.id = viajero.id_grupo AND id_grupo = '$grupo' order by apellidos";
		
	
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function roomingList($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT posicion, GROUP_CONCAT(id_viajero SEPARATOR ';') as viajeros, max(no_habitacion) as habitacion, max(id_habitacion) as id_habitacion FROM `acomodacion` WHERE id_grupo = '$grupo'group by posicion;";
		
	
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
     function roomingListConViajero($viajeroId){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM acomodacion, ( SELECT `id_grupo` as grupo,`posicion` as pos FROM `acomodacion` WHERE `id_viajero` = '".$viajeroId."') as vj WHERE acomodacion.id_grupo = vj.grupo and acomodacion.posicion = vj.pos;";
		
	
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   function inscritosNOVIAJA($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record FROM viajero, producto WHERE producto.id = viajero.id_grupo and viajero.estado = 'NO VIAJA' ";
		
			if($grupo == 0){
			
			//$q .=" WHERE 1";
		
			
		}else{
		$q .=" AND id_grupo = '$grupo'";
		}
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   function inscritosVIAJA($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, otro,facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado, viajero.record, control FROM viajero, producto WHERE producto.id = viajero.id_grupo and viajero.estado <> 'NO VIAJA' ";
		
			if($grupo == 0){
			
			//$q .=" WHERE 1";
		
			
		}else{
		$q .=" AND id_grupo = '$grupo'";
		}
//var_dump($q);
		$q.=" ORDER BY viajero.facturacion_nodocumento ";
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function valorViajeroPT($otro,$programa){
   
   if($otro == ""){
   	$otro = "Programa";
   }
   if($otro == $programa['nombre_tarifa1']){
		return    $programa['valor_terrestre'];
   }else if($otro == $programa['nombre_tarifa2']){
		return    $programa['valor_terrestre_tarifa2'];
   }else if($otro == $programa['nombre_tarifa3']){
		return    $programa['valor_terrestre_tarifa3'];
   }else if($otro == $programa['nombre_tarifa4']){
		return    $programa['valor_terrestre_tarifa4'];
   }else if($otro == $programa['nombre_tarifa5']){
		return    $programa['valor_terrestre_tarifa5'];
   }else if($otro == $programa['nombre_tarifa6']){
		return    $programa['valor_terrestre_tarifa6'];
   }else if($otro == $programa['nombre_tarifa7']){
		return    $programa['valor_terrestre_tarifa7'];
   }else if($otro == $programa['nombre_tarifa8']){
		return    $programa['valor_terrestre_tarifa8'];
   }else if($otro == $programa['nombre_tarifa9']){
		return    $programa['valor_terrestre_tarifa9'];
   }else if($otro == $programa['nombre_tarifa10']){
		return    $programa['valor_terrestre_tarifa10'];
   }
   
  	return    $programa['valor_terrestre'];
   
   }
   
   function valorViajeroTK($otro,$programa){
   
   if($otro == ""){
   	$otro = "Programa";
   }
   if($otro == $programa['nombre_tarifa1']){
		return    $programa['valor_aereo'];
   }else if($otro == $programa['nombre_tarifa2']){
		return    $programa['valor_aereo_tarifa2'];
   }else if($otro == $programa['nombre_tarifa3']){
		return    $programa['valor_aereo_tarifa3'];
   }else if($otro == $programa['nombre_tarifa4']){
		return    $programa['valor_aereo_tarifa4'];
   }else if($otro == $programa['nombre_tarifa5']){
		return    $programa['valor_aereo_tarifa5'];
   }else if($otro == $programa['nombre_tarifa6']){
		return    $programa['valor_aereo_tarifa6'];
   }else if($otro == $programa['nombre_tarifa7']){
		return    $programa['valor_aereo_tarifa7'];
   }else if($otro == $programa['nombre_tarifa8']){
		return    $programa['valor_aereo_tarifa8'];
   }else if($otro == $programa['nombre_tarifa9']){
		return    $programa['valor_aereo_tarifa9'];
   }else if($otro == $programa['nombre_tarifa10']){
		return    $programa['valor_aereo_tarifa10'];
   }
   
  	return    $programa['valor_aereo'];
   
   }
   
   
   function inscritosHistorial($grupo){
   
   		$mensaje="";
		
		
		$q="SELECT viajero.id, viajero.id_grupo, nombres, apellidos, documento, no_documento, fnacimiento, email, telefono, celular, acompanante_de,pasaporte, pasaporte_vigencia, visa_americana, visa_vigencia, acudiente1_nombre, acudiente1_apellido, acudiente1_telefono, acudiente1_email, acudiente2_nombre, acudiente2_apellido, acudiente2_telefono, acudiente2_email, facturacion_nombre, facturacion_documento, facturacion_nodocumento, facturacion_direccion, facturacion_email, fregistro, doc_identidad, doc_pasaporte, doc_permiso, doc_visa, viajero.estado FROM viajero, producto WHERE producto.id = viajero.id_grupo and producto.estado = 'HISTORIAL'";
		
			if($grupo == 0){
			
			//$q .=" WHERE 1";
		
			
		}else{
		$q .=" AND id_grupo = '$grupo'";
		}
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function pagosRegistrados(){
   
   		$mensaje="";
		
		
		$q="SELECT pago.id, `id_viajero`, `fecha`, `medio`, `valor_TIK`, `valor_PT`, `fee`, `trm`, `id_producto`, `observaciones`, f_modificacion, usuario, fecha_registro FROM `pago`, producto WHERE pago.id_producto = producto.id and pago.validado = 1 and producto.estado <> 'HISTORIAL' ORDER BY fecha DESC";
		
			
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
     function pagosRegistradosValidar(){
   
   		$mensaje="";
		
		
		$q="SELECT pago.id, pago.id_viajero, medio, pago.moneda, valor_TIK, valor_PT, fee, numero, comprobante, fecha, trm, aut, id_producto, observaciones, validado, grupo, fecha_registro FROM `pago`, producto WHERE pago.id_producto = producto.id and pago.validado = 0  ORDER BY fecha DESC";
		
//and producto.estado <> 'HISTORIAL'			
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
	
	  function pagosRegistradosProveedorValidar(){
   
   		$mensaje="";
		
		
		$q="SELECT *, pago_proveedor.observaciones as obs, pago_proveedor.id as id FROM `pago_proveedor`, proveedores WHERE proveedores.id = pago_proveedor.id_proveedor and validado = 0 ORDER BY fecha DESC";
		
//and producto.estado <> 'HISTORIAL'			
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   function pagosHistorialViajero($viajero){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `fecha`, `medio`, `valor_TIK`, `valor_PT`, `fee`, `trm`, validado, `id_producto`, observaciones FROM `pago` WHERE `id_viajero` = '".$viajero."' ";
		
		
	//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   function pagosHistorialViajeroNIT($viajero,$programa){
   
   		$mensaje="";
		
		
		$q="SELECT pago.id, `fecha`, `medio`, `valor_TIK`, `valor_PT`, `fee`, `trm`, validado, `id_producto`, pago.observaciones FROM `pago`, viajero WHERE pago.id_viajero = viajero.id and viajero.facturacion_nodocumento = '".$viajero."' and  id_grupo = '".$programa."';";
		
		
//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   function borrarRegistro($documento){
   
   		$mensaje="";
		
		
		$q="DELETE FROM `viajero` WHERE id = '".$documento."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function nombreTC($id){
   
   		$mensaje="";
		
		$vj=$this->datosViajeroID($id);
		var_dump(strpos($vj['control'],"(TK TARJETA)"));
		
		if(strpos($vj['control'],"(TK TARJETA)") !== false){
		$q="UPDATE `viajero` SET `control`='".str_replace("(TK TARJETA)","",$vj['control'])."' WHERE `id`= '".$id."';";
		}else{
		
		$q="UPDATE `viajero` SET `control`=concat(control,'(TK TARJETA)') WHERE `id`= '".$id."';";
		}
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function borrarImpuesto($documento){
   
   		$mensaje="";
		
		
		$q="DELETE FROM `impuesto` WHERE `id` = '".$documento."';";
		
		//var_dump($q);
		$this->consulta($q);
		
		  return "Impuesto eliminado";	
			
	
   
   }
   
    function borrarPago($id){
   
   		$mensaje="";
		
		
		$q="DELETE FROM `pago` WHERE id = '".$id."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
     function borrarCalendario($id,$grupo){
   
   		$mensaje="";
		
		
		$q="DELETE FROM `calendario_pagos` WHERE id = '".$id."'AND  id_grupo = '".$grupo."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
     function registrarEstado($documento,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE`viajero` SET estado = '".$estado."' WHERE no_documento = '".$documento."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
	 
   
      function registrarEstadoID($documento,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE`viajero` SET estado = '".$estado."' WHERE id = '".$documento."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
     function prospectoHistorial($id,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE`grupoprospecto` SET historial = '1', estado='".$estado."' WHERE id = '".$id."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function registrarMultitarifa($programa,$nombre1,$aerea1,$terrestre1,$nombre2,$aerea2,$terrestre2,$nombre3,$aerea3,$terrestre3,$nombre4,$aerea4,$terrestre4,$nombre5,$aerea5,$terrestre5,$nombre6,$aerea6,$terrestre6,$nombre7,$aerea7,$terrestre7,$nombre8,$aerea8,$terrestre8,$nombre9,$aerea9,$terrestre9,$nombre10,$aerea10,$terrestre10){
   
   		$mensaje="";
		
		
		$q="UPDATE `producto` SET `nombre_tarifa1`='$nombre1',`valor_terrestre`='$terrestre1',`valor_aereo`='$aerea1', `nombre_tarifa2`='$nombre2',`valor_terrestre_tarifa2`='$terrestre2',`valor_aereo_tarifa2`='$aerea2',`nombre_tarifa3`='$nombre3',`valor_terrestre_tarifa3`='$terrestre3',`valor_aereo_tarifa3`='$aerea3',`nombre_tarifa4`='$nombre4',`valor_terrestre_tarifa4`='$terrestre4',`valor_aereo_tarifa4`='$aerea4',`nombre_tarifa5`='$nombre5',`valor_terrestre_tarifa5`='$terrestre5',`valor_aereo_tarifa5`='$aerea5',`nombre_tarifa6`='$nombre6',`valor_terrestre_tarifa6`='$terrestre6',`valor_aereo_tarifa6`='$aerea6',`nombre_tarifa7`='$nombre7',`valor_terrestre_tarifa7`='$terrestre7',`valor_aereo_tarifa7`='$aerea7',`nombre_tarifa8`='$nombre8',`valor_terrestre_tarifa8`='$terrestre8',`valor_aereo_tarifa8`='$aerea8',`nombre_tarifa9`='$nombre9',`valor_terrestre_tarifa9`='$terrestre9',`valor_aereo_tarifa9`='$aerea9',`nombre_tarifa10`='$nombre10',`valor_terrestre_tarifa10`='$terrestre10',`valor_aereo_tarifa10`='$aerea10' WHERE `id` = '".$programa."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
		  
   }
   
   
     function validarPago($id){
   
   		$mensaje="";
		
		
		$q="UPDATE `pago` SET `validado`='1' WHERE id = '".$id."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
	function validarPagoProveedores($id){
   
   		$mensaje="";
		
		
		$q="UPDATE `pago_proveedor` SET `validado`='1' WHERE id = '".$id."';";
		
		var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
     function registrarEstadoGrupo($grupo,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE `grupoprospecto` SET `estado`='".$estado."' WHERE `id`= '".$grupo."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   function registrarEstadoProducto($grupo,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE `producto` SET `estado`='".$estado."' WHERE `id`= '".$grupo."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   function archivarPrograma($grupo,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE `producto` SET `estado`='HISTORIAL', `estado_final`='".$estado."'  WHERE `id`= '".$grupo."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function registrarEstadoContacto($grupo,$estado){
   
   		$mensaje="";
		
		
		$q="UPDATE `contacto` SET `estado`='".$estado."' WHERE `id`= '".$grupo."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   
    function registrarRecord($idviajero,$record){
   
   		$mensaje="";
		
		
		$q="UPDATE `viajero` SET `record`='".$record."' WHERE `id`= '".$idviajero."';";
		
		//var_dump($q);
		
		
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   
   
   function registrarFechaPresentacion($grupo,$fecha){
   
   		$mensaje="";
		
		
		$q="UPDATE `grupoprospecto` SET `fecha_presentacion`='".$fecha."' WHERE `id`= '".$grupo."';";
		
		//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   
   
   
     function busqueda($termino){
   
   		$mensaje="";
		
		
		$q="SELECT `id`,id_grupo, `nombres`, `apellidos`, `documento`, `no_documento`, `fnacimiento`, `email`, `telefono`, `celular`, `pasaporte`, `pasaporte_vigencia`, `visa_americana`, `visa_vigencia`, `acudiente1_nombre`, `acudiente1_apellido`, `acudiente1_telefono`, `acudiente1_email`, `acudiente2_nombre`, `acudiente2_apellido`, `acudiente2_telefono`, `acudiente2_email`, `facturacion_nombre`, `facturacion_documento`, `facturacion_nodocumento`, `facturacion_direccion`, `facturacion_email`, `fregistro`, `doc_identidad`, `doc_pasaporte`, `doc_permiso`, doc_visa FROM `viajero`";
		
			
			
			$q .=" WHERE (nombres like '%$termino%' OR apellidos like '%$termino%' OR  acudiente1_nombre  like '%$termino%' OR acudiente1_apellido like '%$termino%' OR acudiente2_nombre  like '%$termino%' OR acudiente2_apellido like '%$termino%'); ";
		
			
	
	//var_dump($q);
		
		
		  return $this->consulta($q);	
			
	
   
   }
   
   function edad($birthday, $grupo){ 
    $age = strtotime($birthday);
	
	$fecha_viaje=$this->consultaGrupo($grupo);
	$fecha_viaje=$fecha_viaje['f_salida'];
	
	//var_dump($fecha_viaje);
    
    if($age === false){ 
        return false; 
    } 
    
    list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
    
    $now = strtotime($fecha_viaje." -7 days"); 
	
	//var_dump(date('l dS \o\f F Y h:i:s A', $now));
    
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
    
    $age = $y2 - $y1; 
    
    if((int)($m2.$d2) < (int)($m1.$d1)) 
        $age -= 1; 
        
    return $age; 
} 
   
     function grupos(){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `producto` WHERE estado <>'HISTORIAL' order by estado,f_salida asc, grupo";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
	 function gruposTodos(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `grupo`, `MONEDA`, `valor_terrestre`, `valor_aereo`, `f_salida`, `f_llegada`, `destino`, `origen`, `cant_viajeros`, `unidad_negocio`, `encargado`, `incluye`, `calendario_pagos`, `itinerario`, `terminoscondiciones`, `parametros`, `estado` FROM `producto` WHERE 1 order by estado,f_salida asc, grupo";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
     function tiposHabitaciones(){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `habitaciones` WHERE 1";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
      function observacionesViajero($idv){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `observaciones_viajero` WHERE `viajeroid` = '$idv'";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
    function manillaID($idv){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `traveltracer` WHERE `no_documento` = '$idv'";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   
   function tarifasHabitacion($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `tarifa_habitacion` WHERE `id_habitacion` = '$id'";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   function cuposAereos($historial){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `sillas` WHERE historial = $historial";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   
   function cuposAereosFechas(){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `sillas` WHERE f_impuestos > NOW()";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   
   function cuposAereosPrograma($programa){
   
   		$mensaje="";
		
		
		$q="SELECT sillas.id as ida, sillas.*, sillas_grupo.* FROM `sillas`, sillas_grupo WHERE sillas_grupo.id_programa='$programa' and sillas_grupo.id_sillas=sillas.id order by neta_q desc";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
	function copiarCosteoPrograma($datos){
		
		$programa = $datos['id_costeo'];
		$multitarifa=$datos['multitarifa'];
		$m= split("-",$datos['copiarprograma']);
		
		$programaACopiar=$m[0];
		$subprogramaACopiar=$m[1];
		
		var_dump($programa);
		var_dump($programaACopiar);
		
		if($programa == $programaACopiar){
			
			$q="UPDATE `servicios` SET `tarifa`=CONCAT(tarifa,'$multitarifa;') WHERE  id_producto ='".$programaACopiar."' and tarifa like '%".$subprogramaACopiar."%' and tarifa <>'-1';";
			
			var_dump($q);
			
			$this->consulta($q);
			
		}else{
			
			
		$q="SELECT * FROM `servicios` WHERE id_producto ='".$programaACopiar."' and tarifa like '%".$subprogramaACopiar."%'";
		// var_dump($q);
		$resultado=$this->consulta($q);	
			
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
			 	$q="
				INSERT INTO `servicios`(`id_producto`, `nombre`,  `proveedor_id`, `ubicacion`, `fecha`, `fecha_out`, `costo`, `pventa`, `tarifa`, `categoria`, `tipo_costo`, `facturado`, `observaciones`) VALUES ('".$programa."','".$fi['nombre']."','".$fi['proveedor_id']."','".$fi['ubicacion']."','0000-00-00 00:00:00','0000-00-00','".$fi['costo']."','".$fi['pventa']."','".$multitarifa.";','".$fi['categoria']."','".$fi['tipo_costo']."','0','');";
			
		//	var_dump($q);
		
				$this->consulta($q);
			}
			
		}
		
	}
	
    function cuposAereosProgramaPrincipal($programa){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `sillas`, sillas_grupo WHERE sillas_grupo.id_programa='$programa' and sillas_grupo.id_sillas=sillas.id and sillas_grupo.principal = 1";
		
	//var_dump($q);
		
		 
		$resultado=$this->consulta($q);	
			
					while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi;		
			}
	
	return null;
   
   }
   function acomodacion($id){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `acomodacion` WHERE `id_viajero` = '".$id."'";
		
	//var_dump($q);
		
		 
			$resultado=$this->consulta($q);	
			
					while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi;		
			}
	
	return null;
	
   
   }
  
   function sillaPrincipalPrograma($programa){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `sillas`, sillas_grupo WHERE sillas_grupo.id_programa='$programa' and sillas_grupo.id_sillas=sillas.id and sillas_grupo.principal = 1";
		
	//var_dump($q);
		
		 
			$resultado=$this->consulta($q);	
			
					while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi;		
			}
	
	return "";
	
   
   }
    function tablerocontrol(){
   
   		$mensaje="";
		
		
		$q="SELECT  `id_grupo` ,  `categoria` , MIN(  `fecha` ) inicio, MAX(  `fecha` ) fin FROM  `tablero_control` WHERE 1 
GROUP BY id_grupo, categoria";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   function gruposHistorial(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `grupo`, `MONEDA`, `valor_terrestre`, `valor_aereo`, `f_salida`, `f_llegada`, `destino`, `origen`, `cant_viajeros`, `unidad_negocio`, `encargado`, `incluye`, `calendario_pagos`, `itinerario`, `terminoscondiciones`, `parametros`, `estado`, estado_final FROM `producto` WHERE estado ='HISTORIAL' order by f_salida desc, grupo";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
    function gruposProspecto(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `nombre_grupo`, `cantidad_viajeros`, `fecha_salida`, `fecha_regreso`, `destino`, `origen`, `encargado`, `unidad_negocio`, `estado`, `observaciones`, `fecha_registro`, `fecha_presentacion`, `activo` FROM `grupoprospecto` WHERE 1";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   
   
   function prospectos(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `nombre_grupo`, `cantidad_viajeros`, `fecha_salida`, `fecha_regreso`, `destino`, `origen`, `encargado`, `unidad_negocio`, `estado`, `observaciones`, `fecha_registro`, fecha_presentacion, `activo`, checklist FROM `grupoprospecto` WHERE historial = 0";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   function prospectosHistorico(){
   
   		$mensaje="";
		
		
		$q="SELECT `id`, `nombre_grupo`, `cantidad_viajeros`, `fecha_salida`, `fecha_regreso`, `destino`, `origen`, `encargado`, `unidad_negocio`, `estado`, `observaciones`, `fecha_registro`, fecha_presentacion, `activo`, checklist FROM `grupoprospecto` WHERE historial = 1";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
    function proveedores(){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `proveedores` WHERE 1 order by nombre";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   function asistencia(){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `seguro_asistencia` WHERE 1";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
   function listaServiciosDisp($producto,$multi){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `servicios` WHERE id_producto = '$producto' and tarifa not like '%$multi;%' and tarifa not like '%0;%'";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
   
    function costeoLista($id_costeo,$categoria){
   
   		$mensaje="";
		
		
		$q="SELECT costeos.id,costeos.id_proveedor,costeos.nombre as nomproveedor, proveedores.nombre as proveedor, vlr, costeos.tipo_costo, costeos.categoria, id_externa FROM `costeos`,proveedores WHERE costeos.id_proveedor = proveedores.id and `id_costeo`  = '$id_costeo' and costeos.categoria = '$categoria'";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
	
	function importarCosteo($id_costeo,$multitarifa,$prospecto){
		
		$mensaje="";
		
		
		$q="SELECT * FROM `costeos` WHERE  `id_costeo`  = '$prospecto' ";
		
	//var_dump($q);
		
		 
			$resultado= $this->consulta($q);
		
		
		
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
		//var_dump($fi);
			$this->registrarAdicional(0,$id_costeo,$fi['nombre'],$fi['id_proveedor'],'','','',$fi['vlr'],array(1),$fi['pventa'],$fi['categoria'],$fi['tipo_costo']);
		}
	}
   
     function costeoListaProd($id_costeo,$categoria,$multi){
   
   		$mensaje="";
		
		
		$q="SELECT * FROM `servicios` WHERE  `id_producto`  = '$id_costeo' and servicios.categoria = '$categoria' and (tarifa like '%$multi%' OR tarifa like '%0%') and tarifa not like  '%-1%';";
		
	//var_dump($q);
		
		 
			return $this->consulta($q);	
	
   
   }
    function datosUsuario($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT `nombre`,`email`,`nivel` FROM `usuarios` WHERE `user_id`  = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi;		
			}
	
	return "";
   
   }
   
   
   function facturacionConPago($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT sum(pago.valor_TIK) as TK, sum(pago.valor_PT) as PT FROM `pago`, viajero WHERE pago.id_viajero=viajero.id and viajero.facturacion_nodocumento = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi;		
			}
	
	return "";
   
   }
   
   
   function cuposRecord($idsillas){
   
   		$mensaje="";
		
			$q="SELECT sillas_grupo.principal as principal, sillas.record, sillas_grupo.id_programa FROM `sillas_grupo`, sillas WHERE  sillas_grupo.id_sillas = '$idsillas' and sillas.id = sillas_grupo.id_sillas";
								
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  $cupos_usados=0;
		  $siprincipal="";
		  
		 
		  
	
			
			while ($a = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
				
				 if($a['principal']==1){
		  $siprincipal="( `record`=  '".$a['record']."' OR record = '' )";
		  }else{
			   $siprincipal="`record`=  '".$a['record']."'";
		  }
		  
						 
				 $q="SELECT id, facturacion_nodocumento FROM `viajero` WHERE  $siprincipal and `id_grupo` = '".$a['id_programa']."'";
			//var_dump($q);
		
		
		  $resultado2= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
				
				$pago=$this->facturacionConPago($fi['facturacion_nodocumento']);
				
				$pg=$pago['TK']+$pago['PT'];
				
				if($pg>0){
			
				$cupos_usados++;
				}
			}	
			}
			
		
	
		
		
	
	return $cupos_usados;
   
   }
   
   function cuposRecordsinPago($idsillas){
   
   		$mensaje="";
		
			$q="SELECT sillas_grupo.principal as principal, sillas.record, sillas_grupo.id_programa FROM `sillas_grupo`, sillas WHERE  sillas_grupo.id_sillas = '$idsillas' and sillas.id = sillas_grupo.id_sillas";
								
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  $cupos_usados=0;
		  $siprincipal="";
		  
		 
		  
	
			
			while ($a = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
				
				 if($a['principal']==1){
		  $siprincipal="( `record`=  '".$a['record']."' OR record = '' )";
		  }else{
			   $siprincipal="`record`=  '".$a['record']."'";
		  }
		  
						 
				 $q="SELECT id, facturacion_nodocumento FROM `viajero` WHERE  $siprincipal and `id_grupo` = '".$a['id_programa']."'";
			//var_dump($q);
		
		
		  $resultado2= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
				
			
			
				$cupos_usados++;
				
			}	
			}
			
		
	
		
		
	
	return $cupos_usados;
   
   }



function viajerosTarifa($tarifa,$grupo){
   
   		$mensaje="";
		
		if($tarifa == 'Programa'){
		$tarifa="";
		}
	
		
		$q="SELECT count(*) as cupos FROM `viajero` WHERE `otro`= '$tarifa' AND `id_grupo`  = '$grupo' AND estado = 'VIAJA'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['cupos'];		
			}
	
	return "";
   
   }
   
   
    function viajeroConPago($grupo){
   
   		$mensaje="";
		
	if($grupo == 0){
		$q="SELECT COUNT(DISTINCT `id_viajero`) as conpago FROM `pago`, viajero, producto  WHERE viajero.id_grupo = producto.id and pago.id_viajero = viajero.id and viajero.estado = 'VIAJA' and producto.estado = 'ACEPTADO' and unidad_negocio = 'GRUPOS JUVENILES' ";
	}else{
		
		$q="SELECT COUNT(DISTINCT `id_viajero`) as conpago FROM `pago`, viajero WHERE pago.id_producto = $grupo and pago.id_viajero = viajero.id and estado = 'VIAJA'";
	}
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['conpago'];		
			}
	
	return "";
   
   }
   
    function viajeroConPagoNo($grupo){
   
   		$mensaje="";
		
	if($grupo == 0){
		$q="SELECT COUNT(DISTINCT `id_viajero`) as conpago FROM `pago` WHERE 1;";
	}else{
		
		$q="SELECT COUNT(DISTINCT `id_viajero`) as conpago FROM `pago`, viajero WHERE pago.id_producto = $grupo and pago.id_viajero = viajero.id and estado = 'NO VIAJA'";
	}
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['conpago'];		
			}
	
	return "";
   
   }
        function proximaFecha($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT max(`fecha`) as proximafecha FROM `actividades_prospecto` WHERE `grupo` = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['proximafecha'];		
			}
	
	return "";
   
   }
   
        function nomGrupo($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT id,grupo,f_salida,destino,origen  FROM `producto` WHERE id = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['grupo']." ".$fi['origen']." ".date("Y", strtotime($fi['f_salida']))." ".$fi['destino'];		
			}
	
	return "";
   
   }
   
   
     function nomGrupoSimple($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT id,grupo,f_salida,destino,origen  FROM `producto` WHERE id = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['grupo'];		
			}
	
	return "";
   
   }
   
   function nomCentroCosto($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT id,grupo,f_salida,destino,origen  FROM `producto` WHERE id = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return date("Y", strtotime($fi['f_salida']))." ".$fi['grupo'];	
			}
	
	return "";
   
   }
   
    function colorEstado($estado){
   
   		$mensaje="";
		
	
		
		$q="SELECT `id`, `estado`, `potencial`, `color` FROM `estados_prospecto` WHERE estado = '$estado'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['color'];
			}
	
	return "#FFF";
   
   }
   
   
   
      function viaja($grupo){
   
   		$mensaje="";
		$q="SELECT count(*) as cuantos FROM `viajero` WHERE `id_grupo` = '$grupo' and `estado` = 'VIAJA'";
	//var_dump($q);
			  $resultado= $this->consulta($q);	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['cuantos'];		
			}
	
	return "0";
   
   }
   
      function noviaja($grupo){
   
   		$mensaje="";
		$q="SELECT count(*) as cuantos FROM `viajero` WHERE `id_grupo` = '$grupo' and `estado` = 'NO VIAJA'";
	//var_dump($q);
			  $resultado= $this->consulta($q);	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['cuantos'];		
			}
	
	return "0";
   
   }
   
       function pendiente($grupo){
   
   		$mensaje="";
		$q="SELECT count(*) as cuantos FROM `viajero` WHERE `id_grupo` = '$grupo' and `estado` = 'PENDIENTE'";
	//var_dump($q);
			  $resultado= $this->consulta($q);	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['cuantos'];		
			}
	
	return "0";
   
   }
   
   
   
        function consultaGrupo($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT id,grupo,f_salida,destino,origen  FROM `producto` WHERE id = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi;		
			}
	
	return "";
   
   }
   
    function consultaIdViajero($id){
   
   		$mensaje="";
		
	
		
		$q="SELECT id  FROM `viajero` WHERE facturacion_nodocumento = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['id'];		
			}
	
	return "0";
   
   }
   
      function cantGrupo($id){
   
   		$mensaje="";
		
		
		$q="SELECT count(id) as cant FROM `viajero` WHERE id_grupo = '$id'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['cant'];		
			}
		return 0;
   
   }
   
   function cantGrupoViaja($id){
   
   		$mensaje="";
		
		
		$q="SELECT count(id) as cant FROM `viajero` WHERE id_grupo = '$id' and estado = 'VIAJA'";
		
		
							
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
		  
	
			
			while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			
				return $fi['cant'];		
			}
		return 0;
   
   }
   
   
   
     function validarLogin($email,$documento){
   
   		$mensaje="";
		
		
		$q="SELECT `no_documento` FROM `viajero` WHERE no_documento = '$documento' and email = '$email'";
		
	//var_dump($q);
		
		
		  $resultado= $this->consulta($q);	
			return mysql_fetch_array($resultado, MYSQL_ASSOC);
	
   
   }
   
   
   
   
   
}
   ?>