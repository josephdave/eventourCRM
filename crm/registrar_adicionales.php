<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);

$id_servicio=$_REQUEST['id_servicio'];

$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['servicio'])){
	$mensaje=$control->registrarAdicionalObs($_REQUEST['id_servicio'],$_REQUEST['idgrupo'],$_REQUEST['servicio'],$_REQUEST['proveedor'],$_REQUEST['ubicacion'],$_REQUEST['fecha'],$_REQUEST['fecha2'],$_REQUEST['costo'],$_REQUEST['aplica'],$_REQUEST['pventa'],$_REQUEST['categoria'],$_REQUEST['tipocosto'],$_REQUEST['observaciones']);

}
	
?>

    <script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
   

       <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">REGISTRAR SERVICIO</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_adicionales.php" method="post" name="form1" id="form1">
                            <?php 
							$servicio=$control->consultaServicioID($id_servicio);	
								
							?>
                            
                          
           				    <h2>REGISTRAR SERVICIO</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">SERVICIO:       				              </td>
           				        <td><input type="hidden" name="id_servicio" id="id_servicio" placeholder="" value="<?php echo $id_servicio ?>">
       				            <input type="hidden" name="idgrupo" id="idgrupo" placeholder="" value="<?php echo $id_grupo ?>"><input type="text" name="servicio" id="servicio" placeholder="" value="<?php echo $servicio['nombre'] ?>"></td>
           				        <td bgcolor="#CCCCCC">PROVEEDOR:</td>
           				        <td><select name="proveedor" id="proveedor" class="chosen-select">
           				          <?php 
							$total_insc=0;
						
							$resultado=$control->proveedores();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				
								
								
							?>
           				          <option value="<?php 
							
							  echo strtoupper( $fi['id']);?>" <?php if ($servicio['proveedor_id']== $fi['id']){ echo "selected";
							  }?>>
           				            <?php 
							
							  echo strtoupper( $fi['nombre']);?>
           				            - <?php echo strtoupper($fi['ciudad']);?></option>
           				          <?php } ?>
       				            </select></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">FECHA:</td>
           				        <td><input type="datetime-local" name="fecha" id="fecha" value="<?php if(isset($servicio['fecha'])){echo date("Y-m-d\TH:i:s",strtotime($servicio['fecha']));}else{echo "0000-00-00 00:00:00";} ?>"></td>
           				        <td bgcolor="#CCCCCC">UBICACIÓN:</td>
           				        <td><input type="text" name="ubicacion" id="ubicacion" placeholder="" value="<?php echo $servicio['ubicacion'] ?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">CATEGORIA:</td>
           				        <td><select name="categoria" id="categoria">
           				          <option value="TIQUETES" <?php if($servicio['categoria']=="TIQUETES"){echo "selected";}?>>TIQUETES</option>
           				          <option value="DOCUMENTACION" <?php if($servicio['categoria']=="DOCUMENTACION"){echo "selected";}?>>DOCUMENTACION Y VISAS </option>
           				          <option value="ASISTENCIA" <?php if($servicio['categoria']=="ASISTENCIA"){echo "selected";}?>>SEGUROS DE VIAJE Y ASISTENCIA </option>
           				          <option value="TRANSFERS" <?php if($servicio['categoria']=="TRANSFERS"){echo "selected";}?>>TRANSFERS </option>
           				          <option value="ALOJAMIENTO" <?php if($servicio['categoria']=="ALOJAMIENTO"){echo "selected";}?>>ALOJ. Y ALIMENTACION HOTEL </option>
           				          <option value="RECEPTIVOS" <?php if($servicio['categoria']=="RECEPTIVOS"){echo "selected";}?>>ATRACCIONES PARTICULARES (RECEPTIVOS)</option>
           				          <option value="SOUVENIRS" <?php if($servicio['categoria']=="SOUVENIRS"){echo "selected";}?>>SOUVENIRS</option>
           				          <option value="PROMOCION" <?php if($servicio['categoria']=="PROMOCION"){echo "selected";}?>>PROMOCION</option>
           				          <option value="GUIAS" <?php if($servicio['categoria']=="GUIAS"){echo "selected";}?>>GUIAS</option>
           				          <option value="OTROS" <?php if($servicio['categoria']=="OTROS"){echo "selected";}?>>OTROS </option>
           				          <option value="COMISIONES" <?php if($servicio['categoria']=="COMISIONES"){echo "selected";}?>>COMISIONES</option>
       				            </select></td>
           				        <td bgcolor="#CCCCCC">TIPO COSTEO:</td>
           				        <td><select name="tipocosto" id="tipocosto">
           				          <option value="DIRECTO" <?php if($servicio['tipo_costo']=="DIRECTO"){echo "selected";}?>>DIRECTO</option>
           				          <option value="POR DIA" <?php if($servicio['tipo_costo']=="POR DIA"){echo "selected";}?>>POR DIA</option>
           				          <option value="GRUPAL" <?php if($servicio['tipo_costo']=="GRUPAL"){echo "selected";}?>>GRUPAL</option>
           				          <option value="COMISION" <?php if($servicio['tipo_costo']=="COMISION"){echo "selected";}?>>COMISION </option>
           				          <option value="POR NOCHE" <?php if($servicio['tipo_costo']=="POR NOCHE"){echo "selected";}?>>POR NOCHE</option>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">COSTO:</td>
           				        <td><input type="text" name="costo" id="costo" placeholder="" value="<?php echo $servicio['costo'] ?>"></td>
           				        <td bgcolor="#CCCCCC">PRECIO VENTA AL DETAL: </td>
           				        <td><input type="text" name="pventa" id="pventa" placeholder="" value="<?php echo $servicio['pventa'] ?>"></td>
   				           </tr>
                           <tr>
           				        <td bgcolor="#CCCCCC">APLICA A:</td>
       				         <td colspan="3"><span class="controls">
   				             <select multiple name="aplica[]" class="span8" id="aplica[]" tabindex="1" data-placeholder="Select here..">
           				            <option value="
									0" <?php if(strpos($servicio['tarifa'],"0") !== false){ echo "selected";}  ?>  >TODOS</option>
                                    <option value="
									-1" 
                                    <?php if(strpos($servicio['tarifa'],"-1") !== false){ echo "selected";}  ?> 
                                    >OPCIONAL</option>
           				            <?php 
									  $datos_producto=$control->datosProducto($id_grupo);
									  if($datos_producto['nombre_tarifa1'] != ""){?>
           				            <option value="<?php 
									
									echo 1;?>" <?php if(strpos($servicio['tarifa'],"1") !== false && strpos($servicio['tarifa'],"-1")===false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa1'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa2'] != ""){?>
           				            <option value="<?php echo 2;?>" <?php if(strpos($servicio['tarifa'],"2") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa2'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa3'] != ""){?>
           				            <option value="<?php echo 3;?>" <?php if(strpos($servicio['tarifa'],"3") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa3'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa4'] != ""){?>
           				            <option value="<?php echo 4;?>" <?php if(strpos($servicio['tarifa'],"4") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa4'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa5'] != ""){?>
           				            <option value="<?php echo 5;?>" <?php if(strpos($servicio['tarifa'],"5") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa5'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa6'] != ""){?>
           				            <option value="<?php echo 6;?>" <?php if(strpos($servicio['tarifa'],"6") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa6'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa7'] != ""){?>
           				            <option value="<?php echo 7;?>" <?php if(strpos($servicio['tarifa'],"7") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa7'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa8'] != ""){?>
           				            <option value="<?php echo 8;?>" <?php if(strpos($servicio['tarifa'],"8") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa8'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa9'] != ""){?>
           				            <option value="<?php echo 9;?>" <?php if(strpos($servicio['tarifa'],"9") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa9'];?></option>
           				            <?php } ?>
           				            <?php if($datos_producto['nombre_tarifa10'] != ""){?>
           				            <option value="<?php echo 10;?>" <?php if(strpos($servicio['tarifa'],"10") !== false){ echo "selected";}  ?> ><?php echo $datos_producto['nombre_tarifa10'];?></option>
           				            <?php } ?>
       				              </select>
       				            </span></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><p><strong>OBSERVACIONES (OPCIONAL):</strong><br>
           				          <textarea name="observaciones" id="observaciones" rows="10" cols="80">
                                <?php echo $servicio['observaciones'];  ?>
                               
            
                                  </textarea>
									<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'observaciones' );
            </script>
   				                </p></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='producto.php?grupo=<?php echo $id_grupo?>';" ></td>
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
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
    </body>
