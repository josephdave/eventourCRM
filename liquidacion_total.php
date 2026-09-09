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

    <script>
 
 String.prototype.replaceAll = function(search, replace)
{
    //if replace is not sent, return original string otherwise it will
    //replace search string with 'undefined'.
    if (replace === undefined) {
        return this.toString();
    }

    return this.replace(new RegExp('[' + search + ']', 'g'), replace);
};
							$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();
	  var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

	var toolbar= document.getElementsByClassName("fixed-table-toolbar");
//	toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
    var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
	var table_html = table_html.replaceAll(',', '');

	  var table_html = table_html.replaceAll('.', ',');
	
    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script> 
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">LIQUIDACIÓN PROGRAMA</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
					 $programa_tk=$prospecto['valor_aereo'];
						  $programa_pt=$prospecto['valor_terrestre'];
						  
						  $idcontrato = $_REQUEST['id'];
	$viajero=$control->datosContrato($idcontrato);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                            <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <h2>SERVICIOS CONTRATADOS</h2>
                           <button id="btnExport">Descargar</button>
							  
                          <div id="table_wrapper">
							  
							  <table class="table table-hover" style="border:1px">
         					 <thead>
                              
                                <tr>
                                <th bgcolor="#CCCCCC">PROVEEDOR</th>
                                <th bgcolor="#CCCCCC">SERVICIO</th>
                                <th bgcolor="#CCCCCC">Usuarios del Servicio</th>
                                <th bgcolor="#42A3FE" style="color: #fff;padding: 0px 10px;">Costo Prospecto</th>
                                <th bgcolor="#42A3FE" style="color: #fff;padding: 0px 10px;">Costo Prospecto Total</th>
                                <th bgcolor="#10597D" style="color: #fff;padding: 0px 10px;">Costo Ajustado <br>
                                Unitario </th>
                                <th bgcolor="#10597D" style="color: #fff;padding: 0px 10px;">Costo Ajustado <br>
                                Total </th>
                                <th bgcolor="#070F42" style="color: #fff;padding: 0px 10px;">Costo Real <br>
                                Unitario</th>
                                <th bgcolor="#070F42" style="color: #fff;padding: 0px 10px;" 	> Costo Real <br>
                                  Total</th>
								  <th bgcolor="#CCCCCC">Diferencia</th>
            </thead>
                           
                            
                            <?php 
							
							$totalproveedor = 0;
							$totalproveedorreal = 0;
							$totalfacturado=0;
								//  $totalPropectoTotal=0;
								  $totalprospecto=0;
							  $totalunitario=0;
								  $totalproveedorppecto=0;
								  
								  $subtotalcostosRealProveedor=0;
								  $proveedor ='';
								  $pos = 0;
								  $rows=0;
							while ($fi = mysql_fetch_array($servicios, MYSQL_ASSOC)) {
								if(true){//$fi['categoria'] != 'TIQUETES'
								
								//var_dump($fi);
									if($pos==0){
										$proveedor = $fi['proveedor_id'];
									}
									$pos++;
									
								?>
								  
								  	  <?php if($fi['proveedor_id'] != $proveedor ){
									  
									
									  if($rows>1){
								   ?>
								  
								  <tr style="background:#333">
                                  <td bgcolor="#CCCCCC"><?php $prov=$control->datosProveedor($proveedor);
									
									
								//  var_dump($prov);
								  echo $prov['nombre'];?></td>
                                  <td bgcolor="#CCCCCC">&nbsp;</td>
                                  <td bgcolor="#CCCCCC">&nbsp;</td>
                                  <td bgcolor="#CCCCCC" align="right">&nbsp;</td>
                                  <td bgcolor="#CCCCCC" align="right">&nbsp;</td>
                                  <td bgcolor="#CCCCCC" align="right">&nbsp;</td>
                                  <td bgcolor="#CCCCCC" align="right">&nbsp;</td>
                                  <td bgcolor="#CCCCCC" align="right">&nbsp;</td>
                                  <td bgcolor="#CCCCCC" align="right"><?php echo number_format($subtotalcostosRealProveedor);?></td>
                                  <td 
								  align="right">&nbsp;</td>
                                </tr>
<?php }
							$subtotalcostosRealProveedor=0;	
									$rows = 0;
									$proveedor = $fi['proveedor_id'];
								} ?>
								  
								  
                                <tr>
                                  <td><strong><?php $prov=$control->datosProveedor($fi['proveedor_id']);
									
									
								//  var_dump($prov);
								  echo $prov['nombre'];?></strong></td>
                              <td><strong><a href="liquidacion_proveedor.php?grupo=<?php echo $grupo_ppal ?>&proveedor=<?php echo $fi['proveedor_id'];?>" target="_blank"><?php echo $fi['nombre']?></a></strong></td>
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
                              <td align="right" style="border-left: 1px solid #585858;"><?php
								
								 $viajeros = $total_usuarios;
							  
								//var_dump($fi['tipo_costo']);
							   if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['costo_prospecto'];
							  $grupo= $unitatio*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['costo_prospecto']*$dias;
							  $grupo= $fi['costo_prospecto']*$dias*$viajeros;
							  }
							 	
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['costo_prospecto']*($dias-1);
							  $grupo= $fi['costo_prospecto']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['costo_prospecto']/$viajeros;
							  $grupo= $fi['costo_prospecto'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= ($fi['costo_prospecto']/100)*$programa_pt;
							  $grupo=$unitatio*$viajeros;
							  }
								if($fi['tipo_costo'] == 'COSTO FINANCIERO'){
							  $unitatio= ($fi['costo_prospecto']/100)*($programa_pt+$programa_tk);
							  $grupo=$unitatio*$viajeros;
							  }
								$totalprospecto=$totalprospecto+$unitatio;
								//	var_dump($totalprospecto);
								echo number_format($unitatio,2);
							  
								
							 ?></td>
                              <td align="right"><?php 
							  
							 
							  
							  $totalcostopppecto= $grupo;
							  
							  $totalproveedorppecto = $totalproveedorppecto+$totalcostopppecto;
							  echo number_format($totalcostopppecto,2);?></td>
                              <td align="right" style="border-left: 1px solid #585858;"><?php
								
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
							  $unitatio= ($fi['costo']/100)*$programa_pt;
							  $grupo=$unitatio*$viajeros;
							  }
								if($fi['tipo_costo'] == 'COSTO FINANCIERO'){
							  $unitatio= ($fi['costo']/100)*($programa_pt+$programa_tk);
							    $grupo=$unitatio*$viajeros;
							  }
								
								echo number_format($unitatio,2);
							  
								
							 ?></td>
                              <td align="right"><?php 
							  
							 
							  
							  $totalcostop= $grupo;
							  
							  $totalproveedor = $totalproveedor+$totalcostop;
							  echo number_format($totalcostop,2);?> </td>
                              <td align="right" style="border-left: 1px solid #585858;"><?php 
							  
							  $totalcostor= $fi['facturado']/$total_usuarios;
							  
							  $totalproveedorreal						   = $totalproveedorreal+$totalcostor;
							  echo number_format($totalcostor,2);?></td>
                              <td align="right">
                                <?php
								  echo number_format($fi['facturado'],2);
									$subtotalcostosRealProveedor+=$fi['facturado'];
									$rows++;
								  $totalfacturado=$totalfacturado+$fi['facturado'] ?>
                               </td>
                              <td align="right" 
								  <?php $diferencia =  $totalcostop - $fi['facturado']; 
								  if($diferencia<(-$totalcostop*0.1)){
									echo "bgcolor='#FF0206'";  
								  }else{
									  
								  if ($diferencia>=0){
									  echo 'bgcolor="#10C813"';
								  }else{
									   echo 'bgcolor="#FEFD00"';
								  }
								  }
								  
								  
								  ?>
								  class="remover" id="<?php echo number_format($diferencia,0);  ?>"
								  style="border-left: 1px solid #585858;" >
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
                              <td bgcolor="#CCCCCC" align="right"><!--<strong><?php echo number_format($totalprospecto,2);?></strong>--></td>
                              <td bgcolor="#CCCCCC" align="right"><strong><?php echo number_format($totalproveedorppecto,2);?></strong></td>
                              <td bgcolor="#CCCCCC" align="right"><!--<strong><?php echo number_format($totalunitario,2);?></strong>--></td>
                              <td bgcolor="#CCCCCC" align="right"><strong><?php echo number_format($totalproveedor,2);?></strong></td>
                              <td bgcolor="#CCCCCC" align="right"><!--<?php echo number_format($totalproveedorreal,2);?>--></td>
                              <td bgcolor="#CCCCCC" align="right"><?php echo number_format($totalfacturado,2);?></td>
                              <td 
								  <?php $diferencia =   $totalproveedor-$totalfacturado; 
								  if($diferencia<=(-$totalproveedor*0.1)){
									echo "bgcolor='#FF0206'";  
								  }else{
									  
								  if ($diferencia>=0){
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
                                <td><strong><?php echo number_format($totalproveedorppecto,0);?></strong></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Costo Ajustado</td>
                                <td><strong><?php echo number_format($totalproveedor,0);?></strong></td>
                                <td><?php echo number_format((((($totalproveedor-$totalproveedorppecto)/$totalproveedorppecto))*100),2);?>%</td>
                              </tr>
                              <tr>
                                <td>Costo Real</td>
                                <td><?php echo number_format($totalfacturado,0);?></td>
                                <td><?php echo number_format((((($totalfacturado-$totalproveedor)/$totalproveedor))*100),2);?>%</td>
                              </tr>
                              <tr>
                                <td>Diferencia</td>
                                <td><?php echo number_format($diferencia);?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Total Venta Programa</td>
                                <td>
									 <?php 
									
									
                           		
									
									$totalTeoricoTK=0;
									$totalTeoricoPT=0;
									$valorMpt= $control->consultarModificacionesGrupo($prospecto['id'],'PT');
								//	var_dump($valorMpt);
									$valorMtk= $control->consultarModificacionesGrupo($prospecto['id'],'TK');
								//	var_dump($valorMtk);
									
									$totalTeoricoTK+=$valorMtk;
									$totalTeoricoPT+=$valorMpt;
										
									$totalTeoricoPT +=  ($prospecto['valor_terrestre']*$control->viajerosTarifa($prospecto['nombre_tarifa1'],$prospecto['id'])); 
									
									$totalTeoricoTK +=  ($prospecto['valor_aereo']*$control->viajerosTarifa($prospecto['nombre_tarifa1'],$prospecto['id'])); 
									
									
									//var_dump($totalTeoricoPT+$totalTeoricoTK);
									
									for($d = 2; $d<=10;$d++){
							
									if($prospecto['nombre_tarifa'.$d] != ""){
									
									$totalTeoricoPT +=  ($prospecto['valor_terrestre_tarifa'.$d]*$control->viajerosTarifa($prospecto['nombre_tarifa'.$d],$prospecto['id'])); 
									
									$totalTeoricoTK +=  ($prospecto['valor_aereo_tarifa'.$d]*$control->viajerosTarifa($prospecto['nombre_tarifa'.$d],$prospecto['id'])); 
										
										//var_dump($totalTeoricoPT+$totalTeoricoTK);
									
									}
									}
									
									echo number_format($totalTeoricoPT+$totalTeoricoTK);
									
									?>
									
									
								</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Utilidad Venta Programa</td>
                                <td><?php $utilidad=($totalTeoricoPT+$totalTeoricoTK) - $totalfacturado;
									echo number_format($utilidad); ?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Margen de Contribucion</td>
                                <td><?php $margen= $utilidad/($totalTeoricoPT+$totalTeoricoTK);
									echo number_format(($margen*100),2)?>%</td>
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
                             <?php
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
									
									echo number_format($gtotalpagospt+$gtotalpagostk,0);
									
									?>
								  
								  </td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Utilidad del Programa</td>
                                <td><?php $utilidad=$gtotalpagospt+$gtotalpagostk - $totalfacturado;
									echo number_format($utilidad); ?></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Margen de Contribucion</td>
                                <td><?php $margen= $utilidad/($gtotalpagospt+$gtotalpagostk);
									echo number_format(($margen*100),2)?>%</td>
                                <td>&nbsp;</td>
                              </tr>
                            </tbody>
                          </table>
							  </div>
                          <p>&nbsp;</p>
           				  </div>
   				      <h2>&nbsp;	</h2>
					</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
