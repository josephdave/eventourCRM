<?php include('logged.php');?>
<?php include 'layout/header2.php';

$id_entidad=$_REQUEST['id'];
$tipo = $_REQUEST['tipo'];

$sarlaft = $control->datosSarlaft($id_entidad,$tipo); 
if(isset($_REQUEST['estado'])){
if($sarlaft==null){
	
	$control->registrarSARLAFTCOMPLETO($id_entidad,$tipo,$_POST['estado'],$_POST['peps_recursos_publicos'],$_POST['peps_poder_publico'],$_POST['peps_reconocimiento_publico'],$_POST['peps_vinculo'],$_POST['actividad_economica'],$_POST['financiero_entidad'],$_POST['financiero_tipo'],$_POST['financiero_nro'],$_POST['financiero_titular'],$_POST['financiero_documento'],$_POST['financiero_monedaextranjera'],$_POST['financiero_tipo_monedaextranjera'],$_SESSION['id'],$_POST['listas_restrictivas'],$_POST['peps'],$_POST['procuraduria'],$_POST['contaduria'],$_POST['contraloria'],$_POST['demandas'],$_POST['fecha_consulta'],$_POST['observaciones']);
		
	$sarlaft = $control->datosSarlaft($id_entidad,$tipo); 
	
}else{
	$control->actualizarSARLAFTCOMPLETO($id_entidad,$tipo,$_POST['estado'],$_POST['peps_recursos_publicos'],$_POST['peps_poder_publico'],$_POST['peps_reconocimiento_publico'],$_POST['peps_vinculo'],$_POST['actividad_economica'],$_POST['financiero_entidad'],$_POST['financiero_tipo'],$_POST['financiero_nro'],$_POST['financiero_titular'],$_POST['financiero_documento'],$_POST['financiero_monedaextranjera'],$_POST['financiero_tipo_monedaextranjera'],$_SESSION['id'],$_POST['listas_restrictivas'],$_POST['peps'],$_POST['procuraduria'],$_POST['contaduria'],$_POST['contraloria'],$_POST['demandas'],$_POST['fecha_consulta'],$_POST['observaciones'],$sarlaft['id']);
	$sarlaft = $control->datosSarlaft($id_entidad,$tipo); 
}
}


// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	//$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		$idArchivo=$sarlaft['id_entidad'];
		
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $idArchivo."-".str_replace(" ","_",$_REQUEST['nomarchivo']).".".$extension;
		$destino =  "documentos_sagrlaft/". $nombrearchivo;
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
   

                      
           				    <h3>PROCESO LA/FT</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                          <?php 	
						  
	//CONTROL DE TIPOS DE ENTIDADES
			if($tipo=="VIAJERO"  ){			
	$entidad=$control->datosViajeroID($id_entidad);
			//	var_dump($entidad);
				$nombre=$entidad['nombres']." ".$entidad['apellidos'];
				$documento = $entidad['documento']." ".$entidad['no_documento'];
				
			}
										
		if( $tipo=="TERCERO" ){			
	$entidad=$control->datosViajeroID($id_entidad);
			$nombre=$entidad['facturacion_nombre'];
			$documento = $entidad['facturacion_documento']." ".$entidad['facturacion_nodocumento'];
					
			}
										
												if($tipo=="PROVEEDOR"  ){			
	$entidad=$control->datosProveedor($id_entidad);
			//	var_dump($entidad);
				$nombre=$entidad['nombre'];
				$documento = $entidad['rut'];
				
			}
										
										if($tipo=="REPLEGAL"  ){			
	$entidad=$control->datosProveedor($id_entidad);
			//	var_dump($entidad);
				$nombre=$entidad['contacto2'];
				$documento = $entidad['cargo2'];
				
			}
										
			
				
										
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div>
							<?php } ?>
										
										<?php  
										
										
									//	var_dump($sarlaft);
										?>
       				        <form action="laft.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
       				          <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre:</td>
           				        <td><?php echo $nombre;?>
									<input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>"/>
									<input type="hidden" name="tipo" id="tipo" value="<?php echo $_REQUEST['tipo']; ?>"/>
								  
								  </td>
           				        <td bgcolor="#CCCCCC">Documento:</td>
								
           				        <td><?php echo $documento;?></td>
                                
   				           </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">Actividad Economica </td>
							     <td>
						         <input type="text" name="actividad_economica" id="actividad_economica" value="<?php echo $sarlaft['actividad_economica']; ?>"></td>
							     <td bgcolor="#CCCCCC">Estado:</td>
							     <td><select name="estado" id="estado">
							        <option value="NO VERIFICADO" >NO VERIFICADO</option>
									 <option value="REGISTRADO" <?php if($sarlaft['estado']=="REGISTRADO"){echo 'selected';} ?> >REGISTRADO</option>
									 <option value="HABILITADO" <?php if($sarlaft['estado']=="HABILITADO"){echo 'selected';} ?> >HABILITADO</option>
							       <option value="BLOQUEADO" <?php if($sarlaft['estado']=="BLOQUEADO"){echo 'selected';} ?> >BLOQUEADO</option>
						         </select></td>
						        </tr>
								  <?php 	if($tipo=="VIAJERO"  ){	 ?>
							   <tr>
							     <td colspan="4" bgcolor="#CCCCCC"><strong>DATOS </strong></td>
								  </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Telefono</td>
							     <td>
						        <?php echo $entidad['telefono']; ?></td>
							     <td bgcolor="#CCCCCC">Celular</td>
							     <td> <?php echo $entidad['celular']; ?></td>
						        </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Fecha Nacimiento:</td>
							     <td>
						        <?php echo $entidad['fnacimiento']; ?></td>
							     <td bgcolor="#CCCCCC">Email</td>
							     <td> <?php echo $entidad['email']; ?></td>
						        </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Ciudad:</td>
							     <td>
						        <?php echo $entidad['ciudad']; ?></td>
							     <td bgcolor="#CCCCCC"></td>
							     <td> </td>
						        </tr>
						      <?php } ?>
								  
								    <?php 	if($tipo=="TERCERO"  ){	 ?>
							   <tr>
							     <td colspan="4" bgcolor="#CCCCCC"><strong>DATOS</strong></td>
								  </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Telefono:</td>
							     <td>
						        <?php echo $entidad['acudiente1_telefono']; ?></td>
							     <td bgcolor="#CCCCCC">Email</td>
							     <td> <?php echo $entidad[ 'facturacion_email']; ?></td>
						        </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Ciudad:</td>
							     <td>
						        <?php echo $entidad['facturacion_ciudad']; ?></td>
							     <td bgcolor="#CCCCCC">Direccion:</td>
							     <td> <?php echo $entidad['facturacion_direccion']; ?></td>
						        </tr>
						      <?php } ?>
								  
								  	    <?php 	if($tipo=="TERCERO" || $tipo=="VIAJERO" ){	 ?>
							   <tr>
							     <td colspan="4" bgcolor="#CCCCCC"><strong>LEGAL</strong></td>
								  </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Pólitica de Tratamiento de Datos:</td>
							     <td colspan="3"><span class="form-horizontal row-fluid">Mediante el registro de sus datos personales en el presente formulario, usted autoriza a Eventour Sport para la recolección, almacenamiento y uso de los mismos, con la finalidad de realizar la inscripción y solicitud de todos los servicios contratados, así como para informarle sobre otros eventos organizados por Eventour Sport, relacionados con nuestras funciones, sobre los servicios que prestamos, las publicaciones que elaboramos y para solicitarle que evalúe la calidad de nuestros servicios. Como Titular de información tiene derecho a conocer, actualizar y rectificar sus datos personales, solicitar prueba de la autorización otorgada para su tratamiento, ser informado sobre el uso que se ha dado a los mismos, presentar quejas ante la SIC por infracción a la ley, revocar la autorización y/o solicitar la supresión de sus datos en los casos en que sea procedente, y acceder en forma gratuita a los mismos. </span>
						         </td>
							     
						        </tr>
								  <tr>
							     <td bgcolor="#CCCCCC">Declaración de Origen de Fondos:</td>
							     <td colspan="3"><p><strong>Declaración de Origen de Fondos</strong><br>
								    Me permito realizar las siguientes declaraciones sobre la  fuente y origen de fondos y actividades licitas:</p>
                                    <ol>
                                      <li>Declaro  que mis bienes y recursos provienen de actividades lícitas, de conformidad con  la normatividad Colombiana.</li>
                                      <li>Que  no admitiré que terceros efectúen depósitos en mis cuentas con fondos  provenientes de las actividades ilícitas contempladas en el código Penal  Colombiano o en cualquier otra norma que lo adicione; ni efectuaré  transacciones destinadas a tales actividades o a favor de personas relacionadas  con las mismas. </li>
                                      <li>Que  todas las actividades e ingresos que se perciben provienen de actividades  licitas. </li>
                                      <li>Que  no me (nos)  encontramos en ninguna lista  de reporte internacional o bloqueado por actividades de narcotráfico, lavado de  activos, o delitos asociados al turismo sexual en menores de edad. </li>
                                      <li>Que  en mi (nuestra) contra no se adelanta ningún proceso en instancias nacionales o  internacionales por ninguno de los aspectos anteriores. </li>
                                      <li>Autorizo  a resolver cualquier acuerdo, beneficio, subsidio, negocio o contrato celebrado  la empresa Eventour Sport SAS en caso de  infracción de cualquiera de los numerales contenidos en este documento  eximiendo a la entidad de toda responsabilidad que se derive por información  errónea, falsa o inexacta que yo hubiere proporcionado en este documento, o de  la violación del mismo. </li>
                                      <li>Me  comprometo a informar oportunamente, cualquier cambio de la composición  accionaria en caso de ser una sociedad comercial.</li>
                                    </ol>
						        </td>
							     
						        </tr>
								  	  <tr>
							     <td bgcolor="#CCCCCC">Firma</td>
							     <td colspan="3"><img src="<?php echo($entidad['firma']); ?>" >
						        </td>
							     
						        </tr>
								  	  <tr>
							     <td bgcolor="#CCCCCC">Contrato Firmado</td>
							     <td colspan="3"> <a href="https://eventoursport.travel/crm/impresion/pdf/contratos_firmados/contrato_<?php echo $entidad['no_documento'];?>.pdf" target="_blank">DESCARGAR</a>
						        </td>
							     
						        </tr>
								
						      <?php } ?>
								  
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
							     <td colspan="4" bgcolor="#CCCCCC"><strong>INFORMACIÓN FINANCIERA</strong></td>
						        </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">Entidad Financiera:</td>
							     <td>
									
									 <input type="text" name="financiero_entidad" id="financiero_entidad" value="<?php echo $sarlaft['financiero_entidad']; ?>"></td>
							     <td bgcolor="#CCCCCC">Tipo de Cuenta:</td>
							     <td><select name="financiero_tipo" id="financiero_tipo">
							       <option value="" >SIN DEFINIR</option>
							       <option value="AHORROS" <?php if($sarlaft['financiero_tipo']=="AHORROS"){echo 'selected';} ?> >AHORROS</option>
							       <option value="CORRIENTE" <?php if($sarlaft['financiero_tipo']=="CORRIENTE"){echo 'selected';} ?> >CORRIENTE</option>
						         </select></td>
						        </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">Numero de Cuenta:</td>
							     <td><input type="text" name="financiero_nro" id="financiero_nro" value="<?php echo $sarlaft['financiero_nro']; ?>"></td>
							     <td bgcolor="#CCCCCC">&nbsp;</td>
							     <td>&nbsp;</td>
						        </tr>
							   <tr>
							     <td bgcolor="#CCCCCC">Titular de la Cuenta:</td>
							     <td><input type="text" name="financiero_titular" id="financiero_titular" value="<?php echo $sarlaft['financiero_titular']; ?>"></td>
							     <td bgcolor="#CCCCCC">No. Documento de la cuenta:</td>
							     <td><input type="text" name="financiero_documento" id="financiero_documento" value="<?php echo $sarlaft['financiero_documento']; ?>"></td>
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
           				        <td><select name="listas_restrictivas" id="listas_restrictivas">
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['listas_restrictivas']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['listas_restrictivas']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
           				        <td bgcolor="#CCCCCC">PEPS:</td>
           				        <td><select name="peps" id="peps">
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['peps']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['peps']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Procuraduria:</td>
           				        <td><p>
           				          <select name="procuraduria" id="procuraduria">
									  <option value=""  >SIN DEFINIR</option>
           				            <option value="NO" <?php if($sarlaft['procuraduria']=="NO"){echo 'selected';} ?>>NO</option>
           				            <option value="SI" <?php if($sarlaft['procuraduria']=="SI"){echo 'selected';} ?>>SI</option>
       				              </select>
           				        </p></td>
           				        <td bgcolor="#CCCCCC">Contaduria:</td>
           				        <td><p>
           				          <select name="contaduria" id="contaduria">
									  <option value=""  >SIN DEFINIR</option>
           				            <option value="NO" <?php if($sarlaft['contaduria']=="NO"){echo 'selected';} ?>>NO</option>
           				            <option value="SI" <?php if($sarlaft['contaduria']=="SI"){echo 'selected';} ?>>SI</option>
       				              </select>
                                </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Contraloria:</td>
           				        <td><select name="contraloria" id="contraloria">
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['contraloria']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['contraloria']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
           				        <td bgcolor="#CCCCCC">Demandas:</td>
           				        <td><select name="demandas" id="demandas">
									<option value=""  >SIN DEFINIR</option>
           				          <option value="NO" <?php if($sarlaft['demandas']=="NO"){echo 'selected';} ?>>NO</option>
           				          <option value="SI" <?php if($sarlaft['demandas']=="SI"){echo 'selected';} ?>>SI</option>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Documentos:</td>
           				        <td>
									<?php if($_SESSION['id']>0){?>
           				          <select name="nomarchivo" id="nomarchivo">
           				            <option value="REPORTE">REPORTE</option>
           				            <option value="AMPLIACION">AMPLIACION DE INFORMACION</option>
                                  </select>
<br>
<input type="file" name="archivo" id="archivo">
								  <?php }?>
								  </td>
           				        <td bgcolor="#CCCCCC">DOCUMENTOS CARGADOS:</td>
           				        <td><?php 
								//	var_dump($proveedor['rut']);
							if(!is_null($sarlaft['id_entidad']))
							{
								if($proveedor['rut'] != ''){
								$files = glob("documentos_sagrlaft/".$sarlaft['id_entidad'].".*");
										   
								
										   }else{
									 $files = glob("documentos_sagrlaft/".$sarlaft['id_entidad']."-*.*");
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
    <?php
   // echo "File found: extension ".$info["extension"]."<br>";
 }
								
								
								?></td>
   				           </tr>
							 
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones"  rows="5" id="observaciones" ><?php echo $sarlaft['observaciones']?></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4">
   </td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='sarlaft.php';" ></td>
       				          </tr>
       				        </table>
       				        </form>
           				  </div>
           				</div>
                        </div>
                          </div>
                            </div>

 
    </body>
