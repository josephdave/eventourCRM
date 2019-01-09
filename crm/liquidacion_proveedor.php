<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

if(isset($_REQUEST['servicio'])){
	$mensaje=$control->actualizarFacturado($_REQUEST['servicio'],$_REQUEST['facturado'],$_REQUEST['observaciones']);
	
}

$proveedor=$control->datosProveedor($_REQUEST['proveedor']);
$grupo= $_REQUEST['grupo'];
$prospecto=$control->datosProducto($grupo);
$servicios=$control->consultaServiciosProveedorGrupo($grupo,$_REQUEST['proveedor']);


 
	
?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">LIQUIDACIÓN PROVEEDOR  <button type="button" class="btn-xs btn-primary" onclick="location.href='datos_proveedor.php?id=<?php echo $_REQUEST['proveedor'];?>'">EDITAR PROVEEDOR</button><button type="button" class="btn-xs btn-primary" onclick="location.href='proveedores_programa.php?grupo=<?php echo $_REQUEST['grupo'];?>'">VOLVER</button></div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $idcontrato = $_REQUEST['id'];
	$viajero=$control->datosContrato($idcontrato);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                            <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
           				        <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				          <tr>
           				            <td bgcolor="#CCCCCC">Nombre Proveedor:</td>
           				            <td><?php echo $proveedor['nombre'];?></td>
           				            <td bgcolor="#CCCCCC">Categoría:</td>
           				            <td><?php echo $proveedor['categoria'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Pais:           				              </td>
           				            <td><?php echo $proveedor['pais'];?></td>
           				            <td bgcolor="#CCCCCC">Ciudad:</td>
           				            <td><?php echo $proveedor['ciudad'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Servicio</td>
           				            <td><p><?php echo $proveedor['servicio'];?></p></td>
           				            <td bgcolor="#CCCCCC">Metodologia de Pago</td>
           				            <td><p><?php echo $proveedor['formas_pago'];?></p></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">RUT /Nro Fiscal:</td>
           				            <td><?php echo $proveedor['rut'];?></td>
           				            <td bgcolor="#CCCCCC">Direccion Fiscal:</td>
           				            <td><?php echo $proveedor['direccion'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Celular:</td>
           				            <td><?php echo $proveedor['celular'];?></td>
           				            <td bgcolor="#CCCCCC">Telefono:</td>
           				            <td><?php echo $proveedor['telefono'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Email:</td>
           				            <td><?php echo $proveedor['email'];?></td>
           				            <td bgcolor="#CCCCCC">&nbsp;</td>
           				            <td>&nbsp;</td>
       				              </tr>
           				          <tr>
           				            <td colspan="4" bgcolor="#CCCCCC"><strong>INFORMACIÓN BANCARIA</strong></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Beneficiario:</td>
           				            <td><?php echo $proveedor['contacto'];?></td>
           				            <td bgcolor="#CCCCCC">Domicilio Beneficiario:</td>
           				            <td><?php echo $proveedor['domicilio_beneficiario'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Pais Beneficiario:</td>
           				            <td><?php echo $proveedor['pais_beneficiario'];?></td>
           				            <td bgcolor="#CCCCCC">Banco:</td>
           				            <td><?php echo $proveedor['banco'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Domicilio Banco: </td>
           				            <td><?php echo $proveedor['domicilio_banco'];?></td>
           				            <td bgcolor="#CCCCCC">Nro Cuenta:</td>
           				            <td><?php echo $proveedor['nro_cuenta'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">SWIFT o ABA:</td>
           				            <td><?php echo $proveedor['swift'];?></td>
           				            <td bgcolor="#CCCCCC">&nbsp;</td>
           				            <td>&nbsp;</td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Observaciones</td>
           				            <td colspan="3"><?php echo $proveedor['observaciones'];?></td>
       				              </tr>
   				            </table>
           				        <h2>SERVICIOS CONTRATADOS</h2>
                          <table class="table table-hover" style="border:1px #999;">
          <thead>
                              <tr>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
                                <th colspan="2" bgcolor="#CCCCCC"><strong>PRESUPUESTADO</strong></th>
                                <th colspan="2" bgcolor="#CCCCCC">REAL</th>
                              <tr>
                                <th bgcolor="#CCCCCC">SERVICIO</th>
                                <th bgcolor="#CCCCCC">Usuarios del Servicio</th>
                                <th bgcolor="#CCCCCC">Costo Unitario </th>
                                <th bgcolor="#CCCCCC">Total </th>
                                <th bgcolor="#CCCCCC">Costo Real</th>
                                <th bgcolor="#CCCCCC">TOTAL Facturado</th>
            </thead>
                           
                            
                            <?php 
							
							$totalproveedor = 0;
							$totalproveedorreal = 0;
							$totalfacturado=0;
							while ($fi = mysql_fetch_array($servicios, MYSQL_ASSOC)) {
								?>
                                <tr>
                              <td><strong><?php echo $fi['nombre']?></strong></td>
                              <td><?php
							  
							  $total_usuarios=0;
							  
							  	$resultado=$control->viajeroActividades($grupo);
							 
							while ($fi3 = mysql_fetch_array($resultado, MYSQL_ASSOC)) { if($fi3['estado'] == 'VIAJA'){
								
								
								$va=false;
								
								$valida_actividad = $control->validarActividad($fi3['id'],$fi['id']);
								 
								if($valida_actividad['poner']==1){
									$va=true;
									
								}else if($valida_actividad['poner']==-1){
								
								$va=false;
								
								}else{
									
								
									$f=$fi['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
					
					
				//var_dump($t);
						if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi3['otro']){
					$va=true;
					}
					
					

				
				}
				
				if($t==0 && $t!=""){
					$va=true;
					}
				}
								
								}
								
								if($va){
									$total_usuarios++;
								}
							}
							}
								
								echo $total_usuarios;
							   
							  ?></td>
                      
                              <td><?php echo $fi['costo'];
							  
							 ?></td>
                              <td><?php 
							  
							  $totalcostop= $fi['costo']*$total_usuarios;
							  
							  $totalproveedor = $totalproveedor+$totalcostop;
							  echo $totalcostop;?> </td>
                              <td><?php 
							  
							  $totalcostor= $fi['facturado']/$total_usuarios;
							  
							  $totalproveedorreal						   = $totalproveedorreal+$totalcostor;
							  echo $totalcostor;?></td>
                              <td><form id="form1" name="form1" method="post" action="liquidacion_proveedor.php">
                               
                                <p>
                                <input type="text" name="facturado" id="facturado" value="<?php echo $fi['facturado'] ?>">
                                <?php $totalfacturado=$totalfacturado+$fi['facturado'] ?>
                                <input type="hidden" id="grupo" name="grupo" value="<?php echo $grupo ?>">
                                
                                           <input type="hidden" id="proveedor" name="proveedor" value="<?php echo $_REQUEST['proveedor'] ?>">
                                            <input type="hidden" id="servicio" name="servicio" value="<?php echo $fi['id'] ?>">
                                            <br>
                                OBSERVACIONES:<br>
                                <textarea name="observaciones" id="observaciones"><?php echo $fi['observaciones'] ?></textarea>
  <input type="submit" value="Modificar">
                                </p>
                              </form></td>
                            </tr>

                                
                                <?php } ?>
                            <tr style="background:#333">
                              <td bgcolor="#CCCCCC">TOTAL:</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totalproveedor;?></strong></td>
                              <td bgcolor="#CCCCCC"><?php echo $totalproveedorreal;?></td>
                              <td bgcolor="#CCCCCC"><?php echo $totalfacturado;?></td>
                            </tr>
                            </table>
           				  </div>
   				      <h2>&nbsp;	</h2>
					</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
