<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$idArchivo="";

if(isset($_REQUEST['nombre'])){
	if(isset($_REQUEST['id']) && $_REQUEST['id'] !=""){
		$mensaje=$control->modificarProveedor($_REQUEST);
		
			$sarlaft = $control->datosSarlaft($_REQUEST['id'],"PROVEEDOR"); 
		if($sarlaft!=null){
		$control->actualizarSARLAFTCOMPLETO($_REQUEST['id'],"PROVEEDOR",$_POST['estado'],$_POST['peps_recursos_publicos'],$_POST['peps_poder_publico'],$_POST['peps_reconocimiento_publico'],$_POST['peps_vinculo'],$_POST['actividad_economica'],$_POST['banco'],$_POST['financiero_tipo'],$_POST['nro_cuenta'],$_POST['beneficiario'],$_POST['financiero_documento'],$_POST['financiero_monedaextranjera'],$_POST['financiero_tipo_monedaextranjera'],$_SESSION['id'],$_POST['listas_restrictivas'],$_POST['peps'],$_POST['procuraduria'],$_POST['contaduria'],$_POST['contraloria'],$_POST['demandas'],$_POST['fecha_consulta'],$_POST['observaciones'],$sarlaft['id']);
		}else{
			$control->registrarSARLAFTCOMPLETO($_REQUEST['id'],"PROVEEDOR",$_POST['estado'],$_POST['peps_recursos_publicos'],$_POST['peps_poder_publico'],$_POST['peps_reconocimiento_publico'],$_POST['peps_vinculo'],$_POST['actividad_economica'],$_POST['banco'],$_POST['financiero_tipo'],$_POST['nro_cuenta'],$_POST['beneficiario'],$_POST['financiero_documento'],$_POST['financiero_monedaextranjera'],$_POST['financiero_tipo_monedaextranjera'],$_SESSION['id'],$_POST['listas_restrictivas'],$_POST['peps'],$_POST['procuraduria'],$_POST['contaduria'],$_POST['contraloria'],$_POST['demandas'],$_POST['fecha_consulta'],$_POST['observaciones']);
		}
		$sarlaft = $control->datosSarlaft($_REQUEST['id'],"PROVEEDOR"); 
	
		
		
	}else{
	$mensaje=$control->registrarProveedor($_REQUEST);
		$id_entidad = $control -> consultaIdProveedor();
		
		$control->registrarSARLAFTCOMPLETO($id_entidad,"PROVEEDOR",$_POST['estado'],$_POST['peps_recursos_publicos'],$_POST['peps_poder_publico'],$_POST['peps_reconocimiento_publico'],$_POST['peps_vinculo'],$_POST['actividad_economica'],$_POST['banco'],$_POST['financiero_tipo'],$_POST['nro_cuenta'],$_POST['beneficiario'],$_POST['financiero_documento'],$_POST['financiero_monedaextranjera'],$_POST['financiero_tipo_monedaextranjera'],$_SESSION['id'],$_POST['listas_restrictivas'],$_POST['peps'],$_POST['procuraduria'],$_POST['contaduria'],$_POST['contraloria'],$_POST['demandas'],$_POST['fecha_consulta'],$_POST['observaciones']);
		
	$sarlaft = $control->datosSarlaft($id_entidad,"PROVEEDOR");
		
		
		if(strpos(";",$mensaje) === true){
			$r=explode(";",$mensaje);
			$idArchivo=$r[0];
		}
	}
}
	if(isset($_REQUEST['id'])){
	$proveedor=$control->datosProveedor($_REQUEST['id']);
		$idArchivo=$_REQUEST['id'];
$sarlaft = $control->datosSarlaft($_REQUEST['id'],'PROVEEDOR'); 
}



		
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		
		
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $idArchivo."-".str_replace(" ","_",$_REQUEST['nomarchivo']).".".$extension;
		$destino =  "documentos_proveedores/". $nombrearchivo;
		if (move_uploaded_file($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
			
			$control->archivoProveedor($idArchivo,$_REQUEST['nomarchivo'].";");
					
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	

?>

    
   
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>PROVEEDORES</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $documento_viajero = $_REQUEST['doc'];
	$viajero=$control->datosViajero($documento_viajero);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="datos_proveedor.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          
           				    <h2>PROVEEDOR </h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre Proveedor:</td>
           				        <td><input name="nombre" type="text" id="nombre" value="<?php echo $proveedor['nombre']?>"></td>
           				        <td bgcolor="#CCCCCC">Razón Social:</td>
								  <?php 
	
									$categorias = array("AEROLÍNEAS","ALOJAMIENTO","GASTRONOMÍA","VIAJES Y TURISMO","AGENCIAS MAYORISTAS","TOUR OPERADORES Y TURISMO RECEPTIVO","ATRACTIVOS TURÍSTICOS","GUÍAS TURÍSTICOS","ASISTENCIA MEDICA","ASESOR COMERCIAL","MERCADEO Y PUBLICIDAD","TRANSPORTADORES","OTROS");
										   
										   if($sarlaft==null || $sarlaft['listas_restrictivas']=="SI"){
										   $estados = array("REGISTRADO","NEGADO","COMPLETO");
										   }else{
											 
										   $estados = array("REGISTRADO","NEGADO","COMPLETO","APROBADO");
										   }
										   $tipo = array("EMISIVO","RECEPTIVO");
										   
										   $us=$control->datosUsuario($_SESSION['id']);
										   //var_dump($us);
										  
	?>
           				        <td><input name="razonsocial" type="text" id="razonsocial" value="<?php echo $proveedor['razonsocial']?>">
								
							    </td>
                                
   				           </tr>
							   <tr>
           				        <td bgcolor="#CCCCCC">Estado:</td>
           				        <td>
									
									<?php  if($us['nivel']>=10){
											  
										   
											?>
									<select name="estado" id="estado">
           				          <?php foreach ($estados as $cat){ ?>
           				          <option  value="<?php echo $cat;?>" 
                                  <?php if ( $proveedor['estado']==$cat ){ echo 'selected'; } ?>
                                  ><?php echo $cat;?></option>
           				          <?php } 
										
									?>
       				             </select><?php }else{ 
									if($proveedor['estado']==''){
										$proveedor['estado']="REGISTRADO";
									}
									?>
									<input type="hidden" id="estado" name="estado" value="<?php echo $proveedor['estado']; ?>">
									<?php echo $proveedor['estado']; ?><br>
								   <?php } 
									
										   if($sarlaft==null){
											   echo "Se debe realizar el proceso de sarlaft para poder aprobar el proveedor";
										   }else{
											   if($sarlaft['listas_restrictivas']=="SI"){
												   echo "Este proveedor se encuentra en listas restrictivas, no puede ser aprobado";
											   }
										   }
										   
									?></td>
           				        <td bgcolor="#CCCCCC">Tipo:</td>
           				        <td><select name="tipo" id="tipo">
           				          <?php foreach ($tipo as $cat){ ?>
           				          <option  value="<?php echo trim($cat);?>" 
                                  <?php if ( substr(trim($proveedor['tipo']),0,15)==substr(trim($cat),0,15) ){ echo 'selected'; } ?>
                                  ><?php echo $cat;?></option>
           				          <?php } 
									
									/*
									
									
           				          <option value="ALOJAMIENTO"
                                   <?php if ( $proveedor['categoria']=="ALOJAMIENTO" ){ echo 'selected'; } ?>>ALOJAMIENTO</option>
           				          <option value="TRASLADOS" <?php if ( $proveedor['categoria']=="TRASLADOS" ){ echo 'selected'; } ?>>TRASLADOS</option>
           				          <option value="TOUROPERADOR" <?php if ( $proveedor['categoria']=="TOUROPERADOR" ){ echo 'selected'; } ?>>TOUROPERADOR</option>
           				          <option value="EVENTOS" <?php if ( $proveedor['categoria']=="EVENTOS" ){ echo 'selected'; } ?>>EVENTOS</option>
           				          <option value="ASISTENCIA" <?php if ( $proveedor['categoria']=="ASISTENCIA" ){ echo 'selected'; } ?>>ASISTENCIA</option>
           				          <option value="SERVICIOS" <?php if ( $proveedor['categoria']=="SERVICIOS" ){ echo 'selected'; } ?>>SERVICIOS</option>
           				          <option value="OTROS" <?php if ( $proveedor['categoria']=="OTROS" ){ echo 'selected'; } ?>>OTROS</option>
								  */
									?>
       				             </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Categoría:</td>
           				        <td colspan="3"><select name="categoria" id="categoria">
           				          <?php foreach ($categorias as $cat){ ?>
           				          <option  value="<?php echo trim($cat);?>" 
                                  <?php if ( substr(trim($proveedor['categoria']),0,15)==substr(trim($cat),0,15) ){ echo 'selected'; } ?>
                                  ><?php echo $cat;?></option>
           				          <?php } 
									
									/*
									
									
           				          <option value="ALOJAMIENTO"
                                   <?php if ( $proveedor['categoria']=="ALOJAMIENTO" ){ echo 'selected'; } ?>>ALOJAMIENTO</option>
           				          <option value="TRASLADOS" <?php if ( $proveedor['categoria']=="TRASLADOS" ){ echo 'selected'; } ?>>TRASLADOS</option>
           				          <option value="TOUROPERADOR" <?php if ( $proveedor['categoria']=="TOUROPERADOR" ){ echo 'selected'; } ?>>TOUROPERADOR</option>
           				          <option value="EVENTOS" <?php if ( $proveedor['categoria']=="EVENTOS" ){ echo 'selected'; } ?>>EVENTOS</option>
           				          <option value="ASISTENCIA" <?php if ( $proveedor['categoria']=="ASISTENCIA" ){ echo 'selected'; } ?>>ASISTENCIA</option>
           				          <option value="SERVICIOS" <?php if ( $proveedor['categoria']=="SERVICIOS" ){ echo 'selected'; } ?>>SERVICIOS</option>
           				          <option value="OTROS" <?php if ( $proveedor['categoria']=="OTROS" ){ echo 'selected'; } ?>>OTROS</option>
								  */
									?>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Pais:       				            
       				            <input type="hidden" name="id" id="id" value="<?php echo $proveedor['id']?>"></td>
           				        <td>
                                <?php
								
								  $array_paises = array("Colombia","Republica Dominicana","Afganistan","Africa del Sur","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Antillas Holandesas","Arabia Saudita","Argelia","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarusia","Belgica","Belice","Benin","Bermudas","Bolivia","Bosnia","Botswana","Brasil","Brunei Darussulam","Bulgaria","Burkina Faso","Burundi","Butan","Camboya","Camerun","Canada","Cape Verde","Chad","Chile","China","Chipre","Comoros","Congo","Corea del Norte","Corea del Sur","Costa de Marfíl","Costa Rica","Croasia","Cuba","Dinamarca","Djibouti","Dominica","Ecuador","Egipto","El Salvador","Emiratos Arabes Unidos","Eritrea","Eslovenia","España","Estados Unidos","Estonia","Etiopia","Fiji","Filipinas","Finlandia","Francia","Gabon","Gambia","Georgia","Ghana","Granada","Grecia","Groenlandia","Guadalupe","Guam","Guatemala","Guayana Francesa","Guerney","Guinea","Guinea-Bissau","Guinea Equatorial","Guyana","Haiti","Holanda","Honduras","Hong Kong","Hungria","India","Indonesia","Irak","Iran","Irlanda","Islandia","Islas Caiman","Islas Faroe","Islas Malvinas","Islas Marshall","Islas Solomon","Islas Virgenes Britanicas","Islas Virgenes (U.S.)","Israel","Italia","Jamaica","Japon","Jersey","Jordania","Kazakhstan","Kenia","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lesotho","Libano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Macao","Macedonia","Madagascar","Malasia","Malawi","Maldivas","Mali","Malta","Marruecos","Martinica","Mauricio","Mauritania","Mexico","Micronesia","Moldova","Monaco","Mongolia","Mozambique","Myanmar (Burma)","Namibia","Nepal","Nicaragua","Niger","Nigeria","Noruega","Nueva Caledonia","Nueva Zealandia","Oman","Pakistan","Palestina","Panama","Papua Nueva Guinea","Paraguay","Peru","Polinesia Francesa","Polonia","Portugal","Puerto Rico","Qatar","Reino Unido","Republica Centroafricana","Republica Checa","Republica Democratica del Congo","Republica Eslovaca","Reunion","Ruanda","Rumania","Rusia","Sahara","Samoa","San Cristobal-Nevis (St. Kitts)","San Marino","San Vincente y las Granadinas","Santa Helena","Santa Lucia","Santa Sede (Vaticano)","Sao Tome & Principe","Senegal","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka (Ceilan)","Sudan","Suecia","Suiza","Sur Africa","Surinam","Swaziland","Tailandia","Taiwan","Tajikistan","Tanzania","Timor Oriental","Togo","Tokelau","Tonga","Trinidad & Tobago","Tunisia","Turkmenistan","Turquia","Ucrania","Uganda","Union Europea","Uruguay","Uzbekistan","Vanuatu","Venezuela","Vietnam","Yemen","Yugoslavia","Zambia","Zimbabwe");
    $cantidad_paises = count($array_paises);
    echo '<select name="pais" id="pais">';
    for($i = 0; $i<$cantidad_paises; $i++){
        $array_paises_i = $array_paises[$i];
        echo '<option value="'.$array_paises_i.'"'; 
            if($proveedor['pais']=="$array_paises_i"){
                    echo "selected";
            }
        echo '>'.$array_paises_i.'</option>';
    }
    echo '</select>';
								
								
								?>
                                
                                
                                </td>
           				        <td bgcolor="#CCCCCC">Estado / Departamento:</td>
           				        <td><input name="departamento" type="text" id="departamento" value="<?php echo $proveedor['departamento']?>"></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Ciudad:</td>
           				        <td><input name="ciudad" type="text" id="ciudad" value="<?php echo $proveedor['ciudad']?>"></td>
           				        <td bgcolor="#CCCCCC">Localidad / Corregimiento</td>
           				        <td><input name="localidad" type="text" id="localidad" value="<?php echo $proveedor['localidad']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Servicio</td>
           				        <td><p>
           				          <input name="servicio" type="text" id="servicio" value="<?php echo $proveedor['servicio']?>">
           				        </p></td>
           				        <td bgcolor="#CCCCCC">Metodologia de Pago</td>
           				        <td><p>
           				          <input name="pago" type="text" id="pago" value="<?php echo $proveedor['formas_pago']?>">
           				        </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">RUT /Nro Fiscal:</td>
           				        <td><input name="rut" type="text" id="rut" value="<?php echo $proveedor['rut']?>" > 
           				        DV:
       				            <input name="dverificacion" type="text" id="dverificacion" value="<?php echo $proveedor['dverificacion']?>" ></td>
           				        <td bgcolor="#CCCCCC">Direccion Fiscal:</td>
           				        <td><input name="direccion" type="text" id="direccion" value="<?php echo $proveedor['direccion']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Celular:</td>
           				        <td><input name="celular" type="text" id="celular" value="<?php echo $proveedor['celular']?>"></td>
           				        <td bgcolor="#CCCCCC">Telefono:</td>
           				        <td><input name="telefono" type="text" id="telefono" value="<?php echo $proveedor['telefono']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Email:</td>
           				        <td><input name="email" type="text" id="email" value="<?php echo $proveedor['email']?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
           				      <tr>
           				        <td colspan="4" bgcolor="#CCCCCC"><strong>CONTACTO PRINCIPAL</strong></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre:</td>
           				        <td><input name="contacto" type="text" id="contacto" value="<?php echo $proveedor['contacto']?>"></td>
           				        <td bgcolor="#CCCCCC">Cargo:</td>
           				        <td><input name="cargo" type="text" id="cargo" value="<?php echo $proveedor['cargo']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Email:</td>
           				        <td><input name="emailcontacto" type="text" id="emailcontacto" value="<?php echo $proveedor['emailcontacto']?>"></td>
           				        <td bgcolor="#CCCCCC">Telefono:</td>
           				        <td><input name="telefonocontacto" type="text" id="telefonocontacto" value="<?php echo $proveedor['telefonocontacto']?>"></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4" bgcolor="#CCCCCC"><strong>REPRESENTANTE LEGAL</strong> <?php if($proveedor['cargo2'] != ""){?><a href="laft.php?id=<?php  echo $proveedor['id'];  ?>&tipo=REPLEGAL" target="_blank">PROCESO SAGRLAFT</a> <?php } ?></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre:</td>
           				        <td><input name="contacto2" type="text" id="contacto2" value="<?php echo $proveedor['contacto2']?>"></td>
           				        <td bgcolor="#CCCCCC">Documento Identificacion:</td>
           				        <td><input name="cargo2" type="text" id="cargo2" value="<?php echo $proveedor['cargo2']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Email:</td>
           				        <td><input name="emailcontacto2" type="text" id="emailcontacto2" value="<?php echo $proveedor['emailcontacto2']?>"></td>
           				        <td bgcolor="#CCCCCC">Telefono:</td>
           				        <td><input name="telefonocontacto2" type="text" id="telefonocontacto2" value="<?php echo $proveedor['telefonocontacto2']?>"></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4" bgcolor="#CCCCCC"><strong>CONTACTO PAGOS</strong></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre:</td>
           				        <td><input name="contacto3" type="text" id="contacto3" value="<?php echo $proveedor['contacto3']?>"></td>
           				        <td bgcolor="#CCCCCC">Cargo:</td>
           				        <td><input name="cargo3" type="text" id="cargo3" value="<?php echo $proveedor['cargo3']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Email:</td>
           				        <td><input name="emailcontacto3" type="text" id="emailcontacto3" value="<?php echo $proveedor['emailcontacto3']?>"></td>
           				        <td bgcolor="#CCCCCC">Telefono</td>
           				        <td><input name="telefonocontacto3" type="text" id="telefonocontacto3" value="<?php echo $proveedor['telefonocontacto3']?>"></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4" bgcolor="#CCCCCC"><strong>INFORMACIÓN BANCARIA</strong></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Beneficiario:</td>
           				        <td><input name="beneficiario" type="text" id="beneficiario" value="<?php echo $proveedor['beneficiario']?>"></td>
           				        <td bgcolor="#CCCCCC">Domicilio Beneficiario:</td>
           				        <td><input name="domicilio_beneficiario" type="text" id="domicilio_beneficiario" value="<?php echo $proveedor['domicilio_beneficiario']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Pais Beneficiario:</td>
           				        <td><?php
								
								  $array_paises = array("Elige","Republica Dominicana","Afganistan","Africa del Sur","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Antillas Holandesas","Arabia Saudita","Argelia","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarusia","Belgica","Belice","Benin","Bermudas","Bolivia","Bosnia","Botswana","Brasil","Brunei Darussulam","Bulgaria","Burkina Faso","Burundi","Butan","Camboya","Camerun","Canada","Cape Verde","Chad","Chile","China","Chipre","Colombia","Comoros","Congo","Corea del Norte","Corea del Sur","Costa de Marfíl","Costa Rica","Croasia","Cuba","Dinamarca","Djibouti","Dominica","Ecuador","Egipto","El Salvador","Emiratos Arabes Unidos","Eritrea","Eslovenia","España","Estados Unidos","Estonia","Etiopia","Fiji","Filipinas","Finlandia","Francia","Gabon","Gambia","Georgia","Ghana","Granada","Grecia","Groenlandia","Guadalupe","Guam","Guatemala","Guayana Francesa","Guerney","Guinea","Guinea-Bissau","Guinea Equatorial","Guyana","Haiti","Holanda","Honduras","Hong Kong","Hungria","India","Indonesia","Irak","Iran","Irlanda","Islandia","Islas Caiman","Islas Faroe","Islas Malvinas","Islas Marshall","Islas Solomon","Islas Virgenes Britanicas","Islas Virgenes (U.S.)","Israel","Italia","Jamaica","Japon","Jersey","Jordania","Kazakhstan","Kenia","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lesotho","Libano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Macao","Macedonia","Madagascar","Malasia","Malawi","Maldivas","Mali","Malta","Marruecos","Martinica","Mauricio","Mauritania","Mexico","Micronesia","Moldova","Monaco","Mongolia","Mozambique","Myanmar (Burma)","Namibia","Nepal","Nicaragua","Niger","Nigeria","Noruega","Nueva Caledonia","Nueva Zealandia","Oman","Pakistan","Palestina","Panama","Papua Nueva Guinea","Paraguay","Peru","Polinesia Francesa","Polonia","Portugal","Puerto Rico","Qatar","Reino Unido","Republica Centroafricana","Republica Checa","Republica Democratica del Congo","Republica Eslovaca","Reunion","Ruanda","Rumania","Rusia","Sahara","Samoa","San Cristobal-Nevis (St. Kitts)","San Marino","San Vincente y las Granadinas","Santa Helena","Santa Lucia","Santa Sede (Vaticano)","Sao Tome & Principe","Senegal","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka (Ceilan)","Sudan","Suecia","Suiza","Sur Africa","Surinam","Swaziland","Tailandia","Taiwan","Tajikistan","Tanzania","Timor Oriental","Togo","Tokelau","Tonga","Trinidad & Tobago","Tunisia","Turkmenistan","Turquia","Ucrania","Uganda","Union Europea","Uruguay","Uzbekistan","Vanuatu","Venezuela","Vietnam","Yemen","Yugoslavia","Zambia","Zimbabwe");
    $cantidad_paises = count($array_paises);
    echo '<select name="pais_beneficiario" id="pais_beneficiario">';
    for($i = 0; $i<$cantidad_paises; $i++){
        $array_paises_i = $array_paises[$i];
        echo '<option value="'.$array_paises_i.'"'; 
            if($proveedor['pais']=="$array_paises_i"){
                    echo "selected";
            }
        echo '>'.$array_paises_i.'</option>';
    }
    echo '</select>';
								
								
								?></td>
           				        <td bgcolor="#CCCCCC">Banco:</td>
           				        <td><input name="banco" type="text" id="banco" value="<?php echo $proveedor['banco']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Domicilio Banco: </td>
           				        <td><input name="domicilio_banco" type="text" id="domicilio_banco" value="<?php echo $proveedor['domicilio_banco']?>"></td>
           				        <td bgcolor="#CCCCCC">Nro Cuenta:</td>
           				        <td><input name="nro_cuenta" type="text" id="nro_cuenta" value="<?php echo $proveedor['nro_cuenta']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">SWIFT:</td>
           				        <td><input name="swift" type="text" id="swift" value="<?php echo $proveedor['swift']?>"></td>
           				        <td bgcolor="#CCCCCC">ABA</td>
           				        <td><input name="aba" type="text" id="aba" value="<?php echo $proveedor['aba']?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Documentos:<br>
           				          Los documentos obligatorios para validacion son:<br>
           				          <ol>
           				            <li>Rut</li>
           				            <li>Cedula Representante Legal</li>
           				            <li>           				              Certificacion Bancaria</li>
           				            <li>           				              Certificado De Camara De Comercio</li>
           				            <li>           				              Registro Nacional De Turismo (Si Aplica)</li>
           				            <li>           				              Certificaciones De Calidad</li>
           				            <li> Referencias Comerciales.</li>
       				              </ol></td>
           				        <td>
									<p>
									  <?php if($_SESSION['id']>0){?>
								  </p>
									<p>
									  <select name="nomarchivo" id="nomarchivo">
									    <option value="RUT">RUT o Equivalente</option>
									    <option value="RNT">RNT</option>
									    <option value="SST">Politica de Seguridad y Salud en el trabajo</option>
									    <option value="SOSTENIBILIDAD">Politica de Sostenibilidad</option>
									    <option value="ID">Documento de Identidad</option>
									    <option value="IDREP">Documento de Identidad Representante Legal</option>
									    <option value="CERTBANCARIA">Certificacion Bancaria</option>
									    <option value="CERTCALIDAD">Certificado de Calidad</option>
									    <option value="CERTCALIDADTUR">Certificado de Calidad Turistica</option>
									    <option value="TRANSF">Datos Bancarios para transferencias</option>
									    <option value="CONTRATO">Contrato</option>
									    <option value="REFERENCIAS">Referencias</option>
									    <option value="CAMARACOMERCIO">Camara de Comercio</option>
									    <option value="FICHATECNICA">Ficha Tecnica</option>
									    <option value="CONOCIMIENTO_PROVEEDORES">Formulario de Conocimiento de Proveedores</option>
									    <option value="ORIGEN_FONDOS">Declaracion Origen de Fondos</option>
									    <option value="COMPOSICION_ACCIONARIA">Composicion AccionariaU</option>
								      </select>
									  <br>
									  <input type="file" name="archivo" id="archivo">
								  </p>
								  <?php }?>
							    </td>
           				        <td bgcolor="#CCCCCC">DOCUMENTOS CARGADOS:</td>
           				        <td><?php 
								//	var_dump($proveedor['rut']);
							if(!is_null($proveedor['rut']))
							{
								if($proveedor['rut'] != ''){
								$files = glob("documentos_proveedores/".$proveedor['rut'].".*");
										   
								 $files2 = glob("documentos_proveedores/".$proveedor['id']."-*.*");
									$files=array_merge($files,$files2);	
									
										   }else{
									 $files = glob("documentos_proveedores/".$proveedor['id']."-*.*");
								}
									}
								// Will find 2.txt, 2.php, 2.gif

// Process through each file in the list
// and output its extension
if (count($files) > 0)
foreach ($files as $file)
 {

    $info = pathinfo($file);
	
	?>
    <a href="<?php echo $file ?>" target="_blank"><?php echo $info['filename']; ?> Ver Documento</a><br/>
    <?
   // echo "File found: extension ".$info["extension"]."<br>";
 }
								
								
								?></td>
   				           </tr>
							 
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones"  rows="5" id="observaciones" ><?php echo $proveedor['observaciones']?></textarea></td>
       				          </tr>
							 <tr>
							     <td colspan="4" bgcolor="#CCCCCC"><strong>CONSULTA PEPS</strong></td>
						        </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">¿Maneja recursos públicos?</td>
							     <td><select name="peps_recursos_publicos" id="peps_recursos_publicos">
							       <option value=""  >SIN DEFINIR</option>
								   <option value="NO" <?php if($sarlaft['peps_recursos_publicos']=="NO"){echo 'selected';} ?> >NO</option>
								   <option value="SI" <?php if($sarlaft['peps_recursos_publicos']=="SI"){echo 'selected';} ?> >SI</option>
						         </select></td>
							     <td bgcolor="#CCCCCC">¿Ejerce algun grado de poder público?</td>
							     <td><select name="peps_poder_publico" id="peps_poder_publico">
							       <option value="" >SIN DEFINIR</option>
							       <option value="NO" <?php if($sarlaft['peps_poder_publico']=="NO"){echo 'selected';} ?> >NO</option>
							       <option value="SI" <?php if($sarlaft['peps_poder_publico']=="SI"){echo 'selected';} ?> >SI</option>
						         </select></td>
						        </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">¿Tiene reconocimiento público?</td>
							     <td><select name="peps_reconocimiento_publico" id="peps_reconocimiento_publico">
							       <option value="" >SIN DEFINIR</option>
							       <option value="NO" <?php if($sarlaft['peps_reconocimiento_publico']=="NO"){echo 'selected';} ?> >NO</option>
							       <option value="SI" <?php if($sarlaft['peps_reconocimiento_publico']=="SI"){echo 'selected';} ?> >SI</option>
						         </select></td>
							     <td bgcolor="#CCCCCC">¿Tiene algún vínculo con una persona públicamente expuesta?</td>
							     <td><select name="peps_vinculo" id="peps_vinculo">
							       <option value="" >SIN DEFINIR</option>
							       <option value="NO" <?php if($sarlaft['peps_vinculo']=="NO"){echo 'selected';} ?> >NO</option>
							       <option value="SI" <?php if($sarlaft['peps_vinculo']=="SI"){echo 'selected';} ?> >SI</option>
						         </select></td>
						        </tr>
							   <tr>
							     <td colspan="4" bgcolor="#CCCCCC"><strong>OPERACIONES CON MONEDA EXTRANJERA</strong></td>
						        </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">Realiza Transacciones en moneda extranjera:</td>
							     <td><select name="financiero_monedaextranjera" id="financiero_monedaextranjera">
							       <option value="" >SIN DEFINIR</option>
							       <option value="NO" <?php if($sarlaft['financiero_monedaextranjera']=="NO"){echo 'selected';} ?> >NO</option>
							       <option value="SI" <?php if($sarlaft['financiero_monedaextranjera']=="SI"){echo 'selected';} ?> >SI</option>
						         </select></td>
							     <td bgcolor="#CCCCCC">Tipo de transacción:</td>
							     <td><select name="financiero_tipo_monedaextranjera" id="financiero_tipo_monedaextranjera">
							       <option value="" >SIN DEFINIR</option>
							       <option value="NINGUNA" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="NINGUNA"){echo 'selected';} ?> >NINGUNA</option>
							       <option value="IMPORTACIONES" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="IMPORTACIONES"){echo 'selected';} ?> >IMPORTACIONES</option>
									 <option value="EXPORTACIONES" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="EXPORTACIONES"){echo 'selected';} ?> >EXPORTACIONES</option>
									  <option value="INVERSIONES" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="INVERSIONES"){echo 'selected';} ?> >INVERSIONES</option>
									  <option value="PRESTAMOS" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="PRESTAMOS"){echo 'selected';} ?> >PRESTAMOS</option>
									  <option value="GIROS" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="GIROS"){echo 'selected';} ?> >GIROS</option>
									  <option value="TRANSFERENCIAS" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="TRANSFERENCIAS"){echo 'selected';} ?> >TRANSFERENCIAS</option>
									  <option value="OTROS" <?php if($sarlaft['financiero_tipo_monedaextranjera']=="OTROS"){echo 'selected';} ?> >OTROS</option>
									 
									 
									 
						         </select></td>
						        </tr>
							   <tr>
							     <td colspan="4" bgcolor="#CCCCCC"><strong>RESULTADO CONSULTA EN LISTAS</strong></td>
						        </tr>
							   <tr>
           				        <td bgcolor="#CCCCCC">Fecha Consulta:</td>
           				        <td><input type="date" name="fecha_consulta" id="fecha_consulta" value="<?php echo $sarlaft['fecha_consulta']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">En Listas Restrictivas:</td>
           				        <td><select name="listas_restrictivas" id="listas_restrictivas" >
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['listas_restrictivas']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['listas_restrictivas']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
           				        <td bgcolor="#CCCCCC">PEPS:</td>
           				        <td><select name="peps" id="peps" >
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['peps']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['peps']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Procuraduria:</td>
           				        <td><p>
           				          <select name="procuraduria" id="procuraduria" >
									  <option value=""  >SIN DEFINIR</option>
           				            <option value="NO" <?php if($sarlaft['procuraduria']=="NO"){echo 'selected';} ?>>NO</option>
           				            <option value="SI" <?php if($sarlaft['procuraduria']=="SI"){echo 'selected';} ?>>SI</option>
       				              </select>
           				        </p></td>
           				        <td bgcolor="#CCCCCC">Contaduria:</td>
           				        <td><p>
           				          <select name="contaduria" id="contaduria" >
									  <option value=""  >SIN DEFINIR</option>
           				            <option value="NO" <?php if($sarlaft['contaduria']=="NO"){echo 'selected';} ?>>NO</option>
           				            <option value="SI" <?php if($sarlaft['contaduria']=="SI"){echo 'selected';} ?>>SI</option>
       				              </select>
                                </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Contraloria:</td>
           				        <td><select name="contraloria" id="contraloria" >
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['contraloria']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['contraloria']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
           				        <td bgcolor="#CCCCCC">Demandas:</td>
           				        <td><select name="demandas" id="demandas" >
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['demandas']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['demandas']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><?php 


$c = "N";


$ap = trim($proveedor['razonsocial']);


if($viajero['telefono'] == ""){
$viajero['telefono']="0";
}

$linea= $proveedor['rut'].";;;;".$ap.";".$proveedor['direccion'].";".$proveedor['telefono'].";".$proveedor['celular'].";".$proveedor['email'].";$c;"; ?>        
       <?php if($_SESSION['id'] != ""){?> <button type="button" data-clipboard-text="<?php echo $linea?>">Copiar Tercero</button></p>
      <?php } ?></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='proveedores.php';" ></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				  </div>
           				</div>
                        </div>
                          </div>
                            </div>

 <script>
    var btns = document.querySelectorAll('button');
    var clipboard = new Clipboard(btns);

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
    
  </script>
    </body>
