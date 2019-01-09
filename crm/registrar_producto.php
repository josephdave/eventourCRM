<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);

if(isset($_REQUEST['prospecto'])){
	
		$prospecto=$control->datosProspecto($_REQUEST['prospecto']);
		$mensaje=$control->prospectoHistorial($prospecto['id'],'ACEPTADO');
		$mensaje="El Prospecto se ha convertido en programa";
}


if(isset($_REQUEST['nombre'])){
	
	if($_REQUEST['modificar'] > 0){
		
		$mensaje=$control->modificarProducto($_REQUEST['modificar'],$_REQUEST['nombre'],$_REQUEST['viajeros'],$_REQUEST['salida'],$_REQUEST['regreso'],$_REQUEST['destino'],$_REQUEST['origen'],$_REQUEST['encargado'],$_REQUEST['unidadnegocio'],$_REQUEST['moneda'],$_REQUEST['incluye'],$_REQUEST['itinerario'],$_REQUEST['terminos'],$_REQUEST['parametros'],$_FILES['logo'],$_FILES['landing'],$_REQUEST['tiquete'],$_REQUEST['terrestre'],$_REQUEST['calendariopagos'],$_REQUEST['documentacion'],$_REQUEST['asistencia_id']);
		
	}else{
	
	$mensaje=$control->registrarProducto($_REQUEST['nombre'],$_REQUEST['viajeros'],$_REQUEST['salida'],$_REQUEST['regreso'],$_REQUEST['destino'],$_REQUEST['origen'],$_REQUEST['encargado'],$_REQUEST['unidadnegocio'],$_REQUEST['moneda'],$_REQUEST['incluye'],$_REQUEST['itinerario'],$_REQUEST['terminos'],$_REQUEST['parametros'],$_FILES['logo'],$_FILES['landing'],$_REQUEST['tiquete'],$_REQUEST['terrestre'],$_REQUEST['calendariopagos'],$_REQUEST['documentacion'],$_REQUEST['compromisos'],$_REQUEST['id_prospecto'],$_REQUEST['asistencia_id']);
	}
}

if(isset($_REQUEST['modificar'])){
  $grupo_modifica = $_REQUEST['modificar'];
  $datos_producto=$control->datosProducto($grupo_modifica);
  $m = true;
}
	
?>
<script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
    
   

      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	  <div class="panel panel-default">
           				    
				
					<div class="panel-body">                 				 
                 
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				 
           				  <div class="module-body">
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
       				        <form action="registrar_producto.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          
           				    <h2><?php if($m){echo "MODIFICAR PROGRAMA";}else{ ?>CREAR PROGRAMA<?php } ?></h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre Producto
       				            <input type="hidden" name="modificar" id="modificar" value="<?php echo $grupo_modifica;?>">
								  <input type="hidden" name="id_prospecto" id="id_prospecto" value="<?php if($prospecto != null){echo $prospecto['id']; }else{ echo "0";}?>"></td>
           				        <td><input name="nombre" type="text" id="nombre" <?php if($m){echo "value='".$datos_producto['grupo']."'";}else{
								echo "value='".$prospecto['nombre_grupo']."'";}?>></td>
           				        <td>Cantidad de Viajeros (Estimados):</td>
           				        <td><input type="number" name="viajeros" id="viajeros" placeholder="Viajeros" <?php if($m){echo "value='".$datos_producto['cant_viajeros']."'";}else if($prospecto != null){echo 'value="'.$prospecto['cantidad_viajeros'].'"'; }?>></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Fecha Salida:       				         
       				           
           				        <td><input type="date" name="salida" id="salida" min="<?php echo date("Y-m-j");?>" <?php if($m){echo "value='".$datos_producto['f_salida']."'";}else if($prospecto != null){echo 'value="'.$prospecto['fecha_salida'].'"'; }else{?> value="<?php echo date("Y-m-j");?>" <?php } ?>></td>
           				        <td>Fecha Regreso:</td>
           				        <td><input name="regreso" type="date" id="regreso" min="<?php echo date("Y-m-j");?>" <?php if($m){echo "value='".$datos_producto['f_llegada']."'";}else if($prospecto != null){echo 'value="'.$prospecto['fecha_regreso'].'"'; }else{?> value="<?php echo date("Y-m-j");?>" <?php } ?>></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Origen</td>
           				        <td><p>
           				          <input name="origen" type="text" id="origen" <?php if($m){echo "value='".$datos_producto['origen']."'";}else if($prospecto != null){echo 'value="'.$prospecto['origen'].'"'; }?>>
           				        </p></td>
           				        <td>Destino</td>
           				        <td><p>
           				          <input name="destino" type="text" id="destino" <?php if($m){echo "value='".$datos_producto['destino']."'";}else if($prospecto != null){echo 'value="'.$prospecto['destino'].'"'; }?>>
           				        </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Encargado</td>
           				        <td><select name="encargado" id="encargado">
                                <?php  	$res=$control->listaUsuarios();
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				          <option value="<?php echo $fi['user_id']; ?>"<?php if($_SESSION['id'] == $fi['user_id']){ echo "selected";}?> ><?php echo $fi['nombre'];?></option><?php } ?>
       				            </select></td>
           				        <td>Unidad de Negocio</td>
           				        <td><p>
           				         
                                  <select name="unidadnegocio" id="unidadnegocio">
                                    <option value="GRUPOS JUVENILES" <?php if("GRUPOS JUVENILES" == $datos_producto['unidad_negocio']){ echo "selected";}?> >GRUPOS JUVENILES</option>
                                    <option value="EVENTOS DEPORTIVOS" <?php if("EVENTOS DEPORTIVOS" == $datos_producto['unidad_negocio']){ echo "selected";}?>>EVENTOS DEPORTIVOS</option>
                                    <option value="EVENTOS ESPECIALES" <?php if("EVENTOS ESPECIALES" == $datos_producto['unidad_negocio']){ echo "selected";}?>>EVENTOS ESPECIALES</option>
									   <option value="RECEPTIVOS" <?php if("RECEPTIVOS" == $datos_producto['unidad_negocio']){ echo "selected";}?>>RECEPTIVOS</option>
									   <option value="VACACIONALES" <?php if("VACACIONALES" == $datos_producto['unidad_negocio']){ echo "selected";}?>>VACACIONALES</option>
                                  </select>
           				        </p>
       				           </td>
       				          </tr>
                               <tr>
           				        <td bgcolor="#CCCCCC">Logo PRODUCTO</td>
           				        <td><p>
           				          <input type="file" name="logo" id="logo">
           				        </p>
       				             <p>Dimensiones (150x150) </p></td>
           				        <td>Imagen LANDING</td>
           				        <td><p>
           				          <input type="file" name="landing" id="landing">
           				        </p>
           				          <p>Dimensiones (1200x800) </p>
       				            </td>
       				          </tr> <tr>
           				        <td bgcolor="#CCCCCC">MONEDA</td>
           				        <td><p>
           				          <select name="moneda" id="moneda">
                                    <option value="USD" <?php if("USD" == $datos_producto['MONEDA']){ echo "selected";}?>>USD</option>
                                    <option value="COP"<?php if("COP" == $datos_producto['MONEDA']){ echo "selected";}?>>COP</option>
									   <option value="EUR"<?php if("EUR" == $datos_producto['MONEDA']){ echo "selected";}?>>EUR</option>
                                  </select>
           				        </p></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
       				          </tr>
                              <tr>
           				        <td bgcolor="#CCCCCC">VALOR TIQUETES</td>
           				        <td><p>
           				          <input type="number" name="tiquete" id="tiquete" <?php if($m){echo "value='".$datos_producto['valor_aereo']."'";}?>>
           				        </p></td>
           				        <td>VALOR TERRESTRE:</td>
           				        <td><input type="number" name="terrestre" id="terrestre" <?php if($m){echo "value='".$datos_producto['valor_terrestre']."'";}?>></td>
       				          </tr>
                              
       				       <tr>
           				        <td colspan="4" bgcolor="#CCCCCC"><strong>PROGRAMA</strong></td>
       				          </tr>
                               <tr>
           				        <td bgcolor="#CCCCCC">El Programa incluye</td>
           				        <td colspan="3"> <textarea name="incluye" id="inclyue" rows="10" cols="80">
                                
                                <?php if($m){echo $datos_producto['incluye']; }else{?>
                <ul>
	<li>Items incluidos en el programa</li>
	<li>Segundo item</li>
</ul>
<?php } ?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'incluye' );
            </script>
           				          <p>&nbsp;</p>       				           </td>
       				          </tr>
                              <tr>
           				        <td bgcolor="#CCCCCC">Itinerario</td>
           				        <td colspan="3"> <textarea name="itinerario" id="itinerario" rows="10" cols="80">
           
            </textarea>
           
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
              	document.getElementById("itinerario").value='<?php if($m){echo preg_replace( "/\r|\n/", "",$datos_producto['itinerario']);}else{?><table width="100%" border="0" cellspacing="1" cellpadding="5"><tr><td bgcolor="#000033" style="text-align: center; color: #FFF;">AEROLINEA</td><td bgcolor="#000033" style="text-align: center; color: #FFF;">VUELO</td><td bgcolor="#000033" style="text-align: center; color: #FFF;">FECHA</td><td bgcolor="#000033" style="text-align: center; color: #FFF;">RUTA</td><td bgcolor="#000033" style="text-align: center; color: #FFF;">HORA SALE</td><td bgcolor="#000033" style="text-align: center; color: #FFF;">HORA LLEGA</td></tr><tr style=""><td style="text-align: center;border-bottom:2px #000033;">Avianca</td><td style="text-align: center;border-bottom:2px #000033;">9496</td><td style="text-align: center;border-bottom:2px #000033;">31 - Ago</td><td style="text-align: center;border-bottom:2px #000033;">Cali - Barranquilla</td><td style="text-align: center;border-bottom:2px #000033;">5:55 </td><td style="text-align: center;border-bottom:2px #000033;">7:28</td></tr><tr><td style="text-align: center;border-bottom:2px #000033;">Avianca</td><td style="text-align: center;border-bottom:2px #000033;">9496</td><td style="text-align: center;border-bottom:2px #000033;">31 - Ago</td><td style="text-align: center;border-bottom:2px #000033;">Cali - Barranquilla</td><td style="text-align: center;border-bottom:2px #000033;">5:55 </td><td style="text-align: center;border-bottom:2px #000033;">7:28</td></tr></table><p>&nbsp;</p><?php } ?>';
			    CKEDITOR.replace( 'itinerario' );
            </script>
       
           				          <p>&nbsp;</p>       				           </td>
   				           </tr>
                          <!-- <tr>
                                <td bgcolor="#CCCCCC"> <p>Valor Programa y Calendario </p>
                                <p>*(Dejar en blanco para carga automatico)</p></td>
                                <td colspan="3"><script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'calendariopagos' );
            </script>
              <textarea name="calendariopagos" id="calendariopagos" rows="10" cols="80">
                                
                                <?php if($m){echo $datos_producto['calendario_pagos'];}else{?>
    
<?php } ?>
                                </textarea></td>
                              </tr>-->
                              <tr>
                                <td bgcolor="#CCCCCC">Documentacion de Viaje</td>
                                <td colspan="3"><textarea name="documentacion" id="documentacion" rows="10" cols="80">
                                
                                <?php if($m){echo $datos_producto['documentacion'];}else{?>
     <p>En todos los casos, pasaporte al día, con vigencia mínima de 6 meses.<br>
		            </p>
			        <p>&nbsp;</p>
			        <p><strong>Para mayores de 18 años.</strong></p>
			        <ul>
			          <li> Cédula de ciudadanía</li>
		            </ul>
			        <p>&nbsp; </p>
			        <p><strong>Para menores de edad.</strong></p>
			        <ul>
			          <li>Tarjeta de identidad</li>
			          <li>Permiso de salida del país debidamente autenticado en notaría, con vigencia no mayor a 60 días, firmado por sus dos padres. <a href="https://eventoursport.travel/crm/impresion/pdf/permiso_pdf.php" target="_blank">Click aquí para descargar formato</a></li>
			          <li> Fotocopia de la cédula de ambos padres</li>
			          <li> Copia del registro civil <strong>ORIGINAL</strong> de nacimiento del menor (No mayor a 6o días)</li>
		            </ul>
			        <p><br>
			          <strong>Información importante sobre el PASAPORTE COLOMBIANO:</strong><br>
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
<?php } ?>
                                </textarea>
                                 <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'documentacion' );
            </script></td>
                              </tr>
                              <tr>
           				        <td bgcolor="#CCCCCC">Terminos y condiciones</td>
           				        <td colspan="3"> <textarea name="terminos" id="terminos" rows="10" cols="80"><?php if($m){echo $datos_producto['terminoscondiciones'];}else{?>
                <ul>
	<li>Items incluidos en el programa</li>
	<li>Segundo item</li>
</ul>
<?php } ?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'terminos' );
            </script>
           				          <p>&nbsp;</p>       				           </td>
       				          </tr>
                               <tr>
           				        <td bgcolor="#CCCCCC">Formas de Pago</td>
           				        <td colspan="3"><p>
                                
                                      <script>
									function evalparametros(valor){
										
									parametros_val = document.getElementById('parametros').value;
									
									//window.alert(parametros_val);
									
									if(parametros_val.includes(valor)){parametros_val = parametros_val.replace(valor+";","");
									document.getElementById('parametros').value=parametros_val;
									}else{
									document.getElementById('parametros').value = parametros_val+valor+";";
									}
									
									}
									<?php $param= $datos_producto['parametros'];?>									</script>
       				              <input name="checkbox" type="checkbox" id="checkbox" onClick="evalparametros('proexcursion')" 
                                  <?php 
								  
								  
								  if(strpos($param,'proexcursion')!== false){
									  echo "checked"; 
									  }
								  
								  ?>
                                  
                                  >
           				          Bono Proexcursion</p>
                                   <p>
           				            <input type="checkbox" name="checkbox3" id="checkbox3" onClick="evalparametros('tarjetacredito')" 
                                    <?php 
								   if(strpos($param,'tarjetacredito')!== false){									  echo "checked"; 		  }?>>
           				            Tarjeta de Credito           				            </p>
                                     <p>
           				            <input type="checkbox" name="checkbox3" id="checkbox3" onClick="evalparametros('dolaresefectivo')" 
                                    <?php 
								   if(strpos($param,'dolaresefectivo')!== false){									  echo "checked"; 		  }?>>
           				            CONSIGNACIÓN USD           				            CORPBANCA</p>
           				          <p>
           				            <input type="checkbox" name="checkbox2" id="checkbox2" onClick="evalparametros('bancolombia')" 
                                      <?php 
								   if(strpos($param,'bancolombia')!== false){									  echo "checked"; 		  }?>
                                  >
   				                    Botón PSE en BANCOLOMBIA           				          </p>
           				          <p>
       				                <input type="checkbox" name="checkbox4" id="checkbox4" onClick="evalparametros('bancobogota')"
                                    
                                     <?php 
								   if(strpos($param,'bancobogota')!== false){									  echo "checked"; 		  }?>>
           				            Botón PSE en BANCO BOGOTA</p>
                                    
                                     <p>
       				                <input type="checkbox" name="checkbox4" id="checkbox4" onClick="evalparametros('cbancobogota')"
                                    
                                     <?php 
								   if(strpos($param,'cbancobogota')!== false){									  echo "checked"; 		  }?>>
           				            CONSIGNACION en BANCO BOGOTA</p><p>
           				            <input type="checkbox" name="checkbox2" id="checkbox2" onClick="evalparametros('cbancolombia')" 
                                      <?php 
								   if(strpos($param,'cbancolombia')!== false){									  echo "checked"; 		  }?>
                                  >
   				                    CONSIGNACION en BANCOLOMBIA   				                  </p>
       				                <p>
                                    
                                    <input type="checkbox" name="checkbox5" id="checkbox5" onClick="evalparametros('transferenciaUSD')" 
                                      <?php 
								   if(strpos($param,'transferenciaUSD')!== false){									  echo "checked"; 		  }?>
                                  >
   				                    CONSIGNACIÓN USD BANCO DE BOGOTA MIAMI 				                  </p>
       				                <p>
                              
       				                  <input type="hidden" name="parametros" id="parametros" value="<?php echo $param?>">
                                      
       				                </p>
       				                <p>&nbsp;</p></td>
       				          </tr>
                               <tr>
                                 <td bgcolor="#CCCCCC">Tarjeta de Asistencia</td>
                                 <td colspan="3"><p></p>
                                   <p>
                                     <select name="asistencia_id" id="asistencia_id">
                                       <?php  	$res=$control->asistencia();
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
                                       <option value="<?php echo $fi['id']; ?>"<?php if($datos_producto['asistencia_id'] == $fi['id']){ echo "selected";}?> ><?php echo $fi['nombre'];?></option>
                                       <?php } ?>
                                     </select>
                                   </p>
                                   <p>
                                   <input type="checkbox" name="checkbox6" id="checkbox6" onClick="evalparametros('sinasistencia')" 
                                      <?php 
								   if(strpos($param,'sinasistencia')!== false){									  echo "checked"; 		  }?>
                                  >
                                 TARJETA DE ASISTENCIA <strong>NO</strong> INCLUIDA</p></td>
                               </tr>
           				      <tr>
           				        <td colspan="4">
                                <?php if(isset($_REQUEST['modificar'])){
								$a="producto.php?grupo=".$_REQUEST['modificar'];
								}else{
								$a="grupos.php";
								}
								?>
                                <input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='<?php echo $a ?>';" ></td>
       				          </tr>
                              
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				  </div>
           				</div>
                        </div>
                        </div>
           				</div>
                        </div>
    </body>
