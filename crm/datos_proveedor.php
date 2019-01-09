<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);




if(isset($_REQUEST['nombre'])){
	if(isset($_REQUEST['id']) && $_REQUEST['id'] !=""){
		$mensaje=$control->modificarProveedor($_REQUEST);
	}else{
	$mensaje=$control->registrarProveedor($_REQUEST);
	}
}
	if(isset($_REQUEST['id'])){
	$proveedor=$control->datosProveedor($_REQUEST['id']);

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
		$nombrearchivo = $_REQUEST['rut'].".".$extension;
		$destino =  "documentos_proveedores/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
					
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
	
									$categorias = array("ESTABLECIMIENTOS DE ALOJAMIENTO
","ALBERGUE - REFUGIO - HOSTAL
","APARTAHOTEL
","APARTAMENTOS TURÍSTICOS
","ALOJAMIENTO RURAL 
","HOTEL
","POSADAS TURÍSTICAS
","CAMPAMENTO O CAMPING
","CENTROS VACACIONALES
","VIVIENDAS TURÍSTICAS
","BALNEARIOS 
","ESPACIOS NATURALES PROTEGIDOS
","AGENCIAS DE VIAJES Y TURISMO 
","AGENCIAS MAYORISTAS
","AGENCIAS OPERADORAS.
","DESTINATION MANAGER COMPANY: 
","OPERADORES PROFESIONALES DE CONGRESOS, FERIAS Y CONVENCIONES.
","SERVICIOS TURÍSTICOS
","AEROLÍNEAS
","TURISMO DE AVENTURA
","TURISMO DE SALUD
","TURISMO RECEPTIVO
","ASISTENCIA O SEGURO DE VIAJE
","OFICINAS DE INFORMACIÓN Y REPRESENTACIONES TURÍSTICAS.
","CONCESIONARIOS DE SERVICIOS TURÍSTICOS EN PARQUE.
","INSTALACIONES NÁUTICO DEPORTIVAS
","OPERADORES, DESARROLLADORES E INDUSTRIALES EN ZONAS FRANCAS TURÍSTICAS.
","EMPRESAS PROMOTORAS O DESARROLLADORAS DE PROYECTOS DE TIEMPO COMPARTIDO Y MULTIPROPIEDAD.
","EMPRESAS COMERCIALIZADORAS DE PROYECTOS DE TIEMPO COMPARTIDO Y MULTIPROPIEDAD.
","COMPAÑÍA DE INTERCAMBIO VACACIONAL
","ESTABLECIMIENTOS DE GASTRONOMÍA, BARES Y NEGOCIOS SIMILARES
","EMPRESAS CAPTADORAS DE AHORRO PARA VIAJES Y DE SERVICIOS TURÍSTICOS PREPAGADOS.
","ARRENDADORES DE VEHÍCULOS PARA TURISMO NACIONAL E INTERNACIONAL.
","EMPRESAS OPERADORAS DE CHIVAS Y DE OTROS VEHÍCULOS AUTOMOTORES QUE PRESTEN SERVICIO DE TRANSPORTE TURÍSTICO.
","GUÍAS DE TURISMO.
","RECREACIÓN TURÍSTICA
","CAMPOS DE GOLF
","ESTACIONES DE ESQUÍ
","PALACIO DE CONGRESOS
","OCIO NOCTURNO
");
	?>
           				        <td><input name="razonsocial" type="text" id="razonsocial" value="<?php echo $proveedor['razonsocial']?>">
								
							    </td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Categoría:</td>
           				        <td colspan="3"><select name="categoria" id="categoria">
           				          <?php foreach ($categorias as $cat){ ?>
           				          <option  value="<?php echo $cat;?>" 
                                  <?php if ( $proveedor['categoria']==$cat ){ echo 'selected'; } ?>
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
           				        <td><input name="rut" type="text" id="rut" value="<?php echo $proveedor['rut']?>" ></td>
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
           				        <td colspan="4" bgcolor="#CCCCCC"><strong>REPRESENTANTE LEGAL</strong></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre:</td>
           				        <td><input name="contacto2" type="text" id="contacto2" value="<?php echo $proveedor['contacto2']?>"></td>
           				        <td bgcolor="#CCCCCC">Cargo:</td>
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
           				        <td bgcolor="#CCCCCC">Documento Fiscal:</td>
           				        <td>
                                <input type="file" name="archivo" id="archivo"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php 
								$files = glob("documentos_proveedores/".$proveedor['rut'].".*"); // Will find 2.txt, 2.php, 2.gif

// Process through each file in the list
// and output its extension
if (count($files) > 0)
foreach ($files as $file)
 {
    $info = pathinfo($file);
	
	?>
    <a href="<?php echo "documentos_proveedores/".$proveedor['rut'].".".$info["extension"] ?>" target="_blank">Ver Documento</a>
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
    </body>
