<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


if(isset($_REQUEST['id']) && isset($_REQUEST['nombre']) && $_REQUEST['nombre']!=''){
	$mensaje=$control->modificarGrupoProspecto($_REQUEST['nombre'],$_REQUEST['viajeros'],$_REQUEST['salida'],$_REQUEST['regreso'],$_REQUEST['destino'],$_REQUEST['origen'],$_REQUEST['encargado'],$_REQUEST['unidadnegocio'],$_REQUEST['observaciones'],$_REQUEST['id']);
}
if(isset($_REQUEST['id'])){
$prospecto=$control->datosProspecto($_REQUEST['id']);
}
if(isset($_REQUEST['nombre']) && $_REQUEST['id']==''){
	$mensaje=$control->registrarGrupoProspecto($_REQUEST['nombre'],$_REQUEST['viajeros'],$_REQUEST['salida'],$_REQUEST['regreso'],$_REQUEST['destino'],$_REQUEST['origen'],$_REQUEST['encargado'],$_REQUEST['unidadnegocio'],$_REQUEST['observaciones']);

}
	
?>

    
   
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>GRUPOS PROSPECTO</h3>
       				      
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
       				        <form action="registrar_grupoprospecto.php" method="post" name="form1" id="form1">
                          
           				    <h2>CREAR/MODIFICAR GRUPO      				    </h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre Grupo</td>
           				        <td><input name="nombre" type="text" id="nombre" value="<?php echo $prospecto['nombre_grupo'];?>"></td>
           				        <td>Cantidad de Viajeros:</td>
           				        <td><input type="number" name="viajeros" id="viajeros" placeholder="Viajeros" value="<?php echo $prospecto['cantidad_viajeros'];?>"></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Fecha Estimada de Viaje:       				         
       				              <input type="hidden" value="<?php echo $prospecto['id'] ?>" id="id" name="id" />
       				            </td>
           				        <td><input type="date" name="salida" id="salida" min="<?php echo date("Y-m-j");?>" value="<?php 
								if(isset($prospecto['fecha_salida'])){
								echo $prospecto['fecha_salida'];
								}else{
								echo date("Y-m-j");
								}?>"></td>
           				        <td><p>Fecha Estimada Regreso:</p></td>
           				        <td><input name="regreso" type="date" id="regreso" min="<?php echo date("Y-m-j");?>" value="<?php 
								if(isset($prospecto['fecha_regreso'])){
								echo $prospecto['fecha_regreso'];
								}else{
								echo date("Y-m-j");
								}?>"></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Origen</td>
           				        <td><p>
           				          <input name="origen" type="text" id="origen" value="<?php echo $prospecto['origen'] ?>" >
           				        </p></td>
           				        <td>Destino Proyectado</td>
           				        <td><p>
           				          <input name="destino" type="text" id="destino"  value="<?php echo $prospecto['destino'] ?>" >
           				        </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Encargado</td>
           				        <td><select name="encargado" id="encargado">
                                <?php  	$res=$control->listaUsuarios();
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				          <option value="<?php echo $fi['user_id']; ?>"<?php 
							if(isset($prospecto['encargado'])){  
							if($prospecto['encargado'] == $fi['user_id']){ echo "selected";}
							}else{
						 if($_SESSION['id'] == $fi['user_id']){ echo "selected";}
							}
								  ?> ><?php echo $fi['nombre'];?></option><?php } ?>
       				            </select></td>
           				        <td>Unidad de Negocio</td>
           				        <td><p>
           				         
                                  <select name="unidadnegocio" id="unidadnegocio">
                                    <option value="GRUPOS JUVENILES"
                                    <?php 
									if($prospecto['unidad_negocio'] == 'GRUPOS JUVENILES'){ echo "selected";}
									?>
                                    >GRUPOS JUVENILES</option>
                                    <option value="EVENTOS DEPORTIVOS"
                                    
                                    <?php 
									if($prospecto['unidad_negocio'] == 'EVENTOS DEPORTIVOS'){ echo "selected";}
									?>>EVENTOS DEPORTIVOS</option>
                                    <option value="EVENTOS ESPECIALES"     
                                    <?php 
									if($prospecto['unidad_negocio'] == 'EVENTOS ESPECIALES'){ echo "selected";}
									?>>EVENTOS ESPECIALES</option>
									   <option value="GRUPOS VACACIONALES"     
                                    <?php 
									if($prospecto['unidad_negocio'] == 'GRUPOS VACACIONALES'){ echo "selected";}
									?>>GRUPOS VACACIONALES</option>
									     <option value="GRUPOS RECEPTIVOS"     
                                    <?php 
									if($prospecto['unidad_negocio'] == 'GRUPOS RECEPTIVOS'){ echo "selected";}
									?>>GRUPOS RECEPTIVOS</option>
									       <option value="RESERVAS INDIVIDUALES"     
                                    <?php 
									if($prospecto['unidad_negocio'] == 'RESERVAS INDIVIDUALES'){ echo "selected";}
									?>>RESERVAS INDIVIDUALES</option>
                                  </select>
           				        </p>
       				           </td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones"  rows="5" id="observaciones"><?php echo $prospecto['observaciones'] ?></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='gruposprospecto.php';" ></td>
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
