<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<style>
.tooltipp {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltipp .tooltiptext {
    visibility: hidden;
    width: 200px;
	 top: 100%;
    left: 50%; 
    margin-left: -200px; 
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltipp:hover .tooltiptext {
    visibility: visible;
}
</style>
<?php 

	//error_reporting(0);

if(isset($_REQUEST['servicio'])){
	$mensaje=$control->actualizarFacturado($_REQUEST['servicio'],$_REQUEST['facturado']);
	
}

$grupo_ppal= $_REQUEST['grupo'];
$prospecto=$control->datosProducto($grupo_ppal);

  $datediff = strtotime($prospecto['f_llegada'])- strtotime($prospecto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
	 $noches=$dias-1;

$servicios=$control->consultaServicios($grupo_ppal);


 
	
?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">LIQUIDACIÓN PROGRAMA</div>
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
       				        <h2>SERVICIOS CONTRATADOS</h2>
                          <table class="table table-hover" style="border:1px #999;">
          <thead>
                              <tr>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
                                <th colspan="2" bgcolor="#CCCCCC"><strong>COSTO AJUSTADO</strong></th>
                                <th colspan="2" bgcolor="#CCCCCC"> COSTO REAL</th>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
                              <tr>
                                <th bgcolor="#CCCCCC">PROVEEDOR</th>
                                <th bgcolor="#CCCCCC">SERVICIO</th>
                                <th bgcolor="#CCCCCC">Usuarios del Servicio</th>
                                <th bgcolor="#CCCCCC">Costo Ajustado <br>
                                Unitario </th>
                                <th bgcolor="#CCCCCC">Costo Ajustado <br>
                                Total </th>
                                <th bgcolor="#CCCCCC">Costo Real <br>
                                Unitario</th>
                                <th bgcolor="#CCCCCC"> Costo Real <br>
                                  Total</th>
                                <th bgcolor="#CCCCCC">Diferencia</th>
            </thead>
                           
                            
                            <?php 
							
							$totalproveedor = 0;
							$totalproveedorreal = 0;
							$totalfacturado=0;
							  $totalunitario=0;
							while ($fi = mysql_fetch_array($servicios, MYSQL_ASSOC)) {
								if($fi['categoria'] != 'TIQUETES'){
								
								//var_dump($fi);
								?>
                                <tr>
                                  <td><strong><?php $prov=$control->datosProveedor($fi['proveedor_id']);
								//  var_dump($prov);
								  echo $prov['nombre'];?></strong></td>
                              <td><strong><?php echo $fi['nombre']?></strong></td>
                              <td><?php
									  
							  $f=$fi['tarifa'];
								//var_dump($f);
							  $total_usuarios=0;
							  
							  	$resultado=$control->viajeroActividades($grupo_ppal);
							 
							while ($fi3 = mysql_fetch_array($resultado, MYSQL_ASSOC)) { if($fi3['estado'] == 'VIAJA'){
								//var_dump($fi3['nombres']);
								$va=false;
								
								$valida_actividad = $control->validarActividad($fi3['id'],$fi['id']);
								 
								if($valida_actividad['poner']==1){
									$va=true;
									
								}else if($valida_actividad['poner']==-1){
								
								$va=false;
								
								}else{
									
								
									
				$s=explode(";",$f);
									
									
				foreach ($s as $t){
					
					
				//var_dump($t);
						if($t>0){
							//var_dump($fi3['otro']);
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
                      
                              <td align="right"><?php
								
								 $viajeros = $total_usuarios;
							  
								//var_dump($fi['tipo_costo']);
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
								
								echo number_format($unitatio,2);
							  
								
							 ?></td>
                              <td align="right"><?php 
							  
							 
							  
							  $totalcostop= $grupo;
							  
							  $totalproveedor = $totalproveedor+$totalcostop;
							  echo number_format($totalcostop,2);?> </td>
                              <td align="right"><?php 
							  
							  $totalcostor= $fi['facturado']/$total_usuarios;
							  
							  $totalproveedorreal						   = $totalproveedorreal+$totalcostor;
							  echo number_format($totalcostor,2);?></td>
                              <td align="right">
                                <?php
								  echo number_format($fi['facturado'],2);
								  $totalfacturado=$totalfacturado+$fi['facturado'] ?>
                               </td>
                              <td align="right" 
								  <?php $diferencia = $fi['facturado'] - $totalcostop; 
								  if($diferencia>($totalcostop*0.1)){
									echo "bgcolor='#FF0206'";  
								  }else{
									  
								  if ($diferencia<=0){
									  echo 'bgcolor="#10C813"';
								  }else{
									   echo 'bgcolor="#FEFD00"';
								  }
								  }
								  ?>
								  
								  >
								  <?php if($fi['observaciones']!=''){?>
								  <div class="tooltipp"><?php echo number_format($diferencia,0);  ?><span class="tooltiptext"><?php echo $fi['observaciones'];?></span></div>
									<?php }else{ ?>
									<?php echo number_format($diferencia,0);  ?>
									<?php } ?></td>
                            </tr>

                                
                                <?php } } ?>
                            <tr style="background:#333">
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">TOTAL:</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC" align="right"><!--<strong><?php echo number_format($totalunitario,2);?></strong>--></td>
                              <td bgcolor="#CCCCCC" align="right"><strong><?php echo number_format($totalproveedor,2);?></strong></td>
                              <td bgcolor="#CCCCCC" align="right"><?php echo number_format($totalproveedorreal,2);?></td>
                              <td bgcolor="#CCCCCC" align="right"><?php echo number_format($totalfacturado,2);?></td>
                              <td 
								  <?php $diferencia = $totalfacturado - $totalproveedor; 
								  if($diferencia>($totalproveedor*0.1)){
									echo "bgcolor='#FF0206'";  
								  }else{
									  
								  if ($diferencia<=0){
									  echo 'bgcolor="#10C813"';
								  }else{
									   echo 'bgcolor="#FEFD00"';
								  }
								  }
								  ?> align="right"><?php echo number_format($diferencia);?></td>
                            </tr>
                            </table>
                          <br>
                          <table width="50%" class="table table-hover" style="border:1px #999;">
                            <tbody>
                              <tr>
                                <td  bgcolor="#CCCCCC"><strong>ANALISIS</strong></td>
                                <td  bgcolor="#CCCCCC"><strong>Total</strong></td>
                                <td  bgcolor="#CCCCCC"><strong>Variación</strong></td>
                              </tr>
                              <tr>
                                <td>Costo Iniciales</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Costo Ajustado</td>
                                <td><strong><?php echo number_format($totalproveedor,0);?></strong></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Costo Real</td>
                                <td><?php echo number_format($totalfacturado,0);?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Total Recaudado</td>
                                <td>
								 <?php $producto=$prospecto;
							$facturador="";
							$aereo_base=0;
							$ModificacionesTK=0;
							$terrestre_base=0;
							$ModificacionesPT=0;
							$pagosPT=0;
							$pagosTK=0;
							$ultimafecha="";
						
							
							$gtotalviajeros=0;
							$gtotalsaldo=0;
							$gtotaltk=0;
							$gtotalpagostk=0;
							$gtotalpt=0;
							$gtotalpagospt=0;
							
							$resultado=$control->inscritosVIAJA($producto['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {		
							 $gtotalviajeros++;						
							 if($facturador != $fi['facturacion_nodocumento']){
								 if($facturador != ""){
								 ?>
                             <?php 				  
							  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;
							  ?>
                             <?php
							  
							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?>
                             <?php  $gtotalpagostk+=$pagosTK; ?>
                             <?php  $gtotalpt+=$terrestre_base+$ModificacionesPT; ?>
                             <?php  $gtotalpagospt+=$pagosPT; ?>
                             <?
								 }
								$facturador=$fi['facturacion_nodocumento'];
								$id=$fi['id'];
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$fd['id'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$fd['id'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajeroID($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								$pagosPT=$pagos['pagosPT'];
							  
								$ultimafecha= $pagos['ultimafecha'];
								
								
							 }else{
								
								$aereo_base+= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK+=  $control->consultarModificaciones($fi['id'],$fd['id'],'TK');
								
								$realTK= $aereo_base+$ModificacionesTK;
								
								
								$terrestre_base+= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT+=  $control->consultarModificaciones($fi['id'],$fd['id'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
								
								
								$pagos=$control->pagosViajeroID($fi['id']);
							  
							  	$pagosTK+=$pagos['pagosTIK'];
								$pagosPT+=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								}
								
							 } ?>
                             <?php 				  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;?>
                             <?php 							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?>
                             <?php $gtotalpagostk+=$pagosTK; ?>
                             <?php $gtotalpt+=$terrestre_base+$ModificacionesPT; ?>
                             <?php $gtotalpagospt+=$pagosPT; 
									
									echo number_format($gtotalpagospt,0);
									
									?>
								  
								  </td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Utilidad del Programa</td>
                                <td><?php $utilidad=$gtotalpagospt - $totalfacturado;
									echo number_format($utilidad); ?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Margen de Contribucion</td>
                                <td><?php $margen= $utilidad/$gtotalpagospt;
									echo number_format(($margen*100),0)?>%</td>
                                <td>&nbsp;</td>
                              </tr>
                            </tbody>
                          </table>
                          <p>&nbsp;</p>
           				  </div>
   				      <h2>&nbsp;	</h2>
					</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
