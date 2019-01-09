<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	 $id_grupo = $_REQUEST['id_costeo'];
	  $multi = $_REQUEST['multitarifa'];
	 
	 $prospecto=$control->datosProducto($id_grupo);
	
	
if(isset($_REQUEST['copiarprograma'])){
	$mensaje=$control->copiarCosteoPrograma($_REQUEST);
	
}
	if(isset($_REQUEST['servicio'])){
	$mensaje=$control->registrarAdicional($_REQUEST['id_servicio'],$_REQUEST['idgrupo'],$_REQUEST['servicio'],$_REQUEST['proveedor'],$_REQUEST['ubicacion'],$_REQUEST['fecha'],$_REQUEST['fecha2'],$_REQUEST['costo'],$_REQUEST['aplica'],$_REQUEST['pventa'],$_REQUEST['categoria'],$_REQUEST['tipocosto']);

}

if(isset($_REQUEST['importarCosteo'])){
$mensaje=$control->importarCosteo($_REQUEST['id_costeo'],$_REQUEST['multitarifa'],$_REQUEST['importarCosteo']);
}

if(isset($_REQUEST['adicionarservicio'])){
$mensaje=$control->agregarAdicional($_REQUEST['adicionarservicio'],$_REQUEST['multitarifa']);
}

if(isset($_REQUEST["borra_adicional"]) ){
	$resultado=$control->borraAdicional($_REQUEST['borra_adicional']);
	
	}

if(isset($_REQUEST['borrar'])){
		
	$mensaje=$control->borrarAdicional($_REQUEST['borrar'],$_REQUEST['multitarifa']);

}
?>


<script>
							$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

	//var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
  
  $("#btnExport2").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

//	var toolbar= document.getElementsByClassName("fixed-table-toolbar2");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper2');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });

});
							</script>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>COSTEO</h3> <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=<?php echo $multi?>" class="btn-xs btn-primary"> RECARGAR</a>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                                    
                                    
                                     <?php if(isset($mensaje)){?><div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                                
                                <button id="btnExport">Descargar</button>
										
                             
                                <div id="table_wrapper">
									  <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre:</strong></td>
           				        <td><?php echo $prospecto['grupo']; ?></td>
           				        <td bgcolor="#CCCCCC"><strong>Viajeros Estimados:</strong></td>
           				        <td><?php echo $prospecto['cant_viajeros'];
								$viajeros=$prospecto['cant_viajeros']; ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Fecha Salida Desde:</strong></td>
           				        <td><?php echo $prospecto['f_salida']; ?></td>
           				        <td bgcolor="#CCCCCC"><strong>Fecha Regreso:</strong></td>
           				        <td><?php echo $prospecto['f_llegada']; ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Noches:</strong></td>
           				        <td><?php 
								
									$salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($producto['f_llegada']);
					
     $datediff = strtotime($prospecto['f_llegada'])- strtotime($prospecto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
	 $noches=$dias-1;
								
								?>
                                <?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
         				        </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Origen:</strong></td>
           				        <td><?php echo $prospecto['origen'] ?></td>
           				        <td bgcolor="#CCCCCC">Destino:</td>
           				        <td><?php echo $prospecto['destino'] ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>OBSERVACIONES:</strong></td>
           				        <td><?php echo $prospecto['observaciones'] ?></td>
           				        <td bgcolor="#CCCCCC"><strong>Encargado:</strong></td>
           				        <td><?php  $usuario=$control->datosUsuario($prospecto['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
       				          </tr>
           				      </table>
           				    <p>&nbsp;</p>
									<form action="costeo_multitarifa.php" method="post" name="form1" id="form1">
                            <?php 
							$servicio=$control->consultaServicioID($id_servicio);	
								
							?>
                            <?php if($subtotal == 0 && $multi==1){ ?>
							     <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=1&importarCosteo=<?php echo $prospecto['id_prospecto']?>" class="btn-xs btn-primary"> Importar Costeo Base</a>
							   <?php } ?>
                          
           				    <h2>COPIAR COSTEO</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">COSTEO PROGRAMA:       				              </td>
           				        <td><input type="hidden" name="id_servicio" id="id_servicio" placeholder="" value="<?php echo $id_servicio ?>">
           				          
           				          <input type="hidden" name="idgrupo" id="idgrupo" placeholder="" value="<?php echo $id_grupo ?>">                      
           				          <input type="hidden" name="id_costeo" id="id_costeo" placeholder="" value="<?php echo $id_grupo ?>"><input type="hidden" name="multitarifa" id="multitarifa" placeholder="" value="<?php echo $multi ?>">
           				          <select name="copiarprograma" id="copiarprograma" class="chosen-select">
           				            <?php 
					
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				
								
								for($i=1;$i<=10;$i++){
								//	var_dump($fi['nombre_tarifa'.$i]);
									if($fi['nombre_tarifa'.$i]!=''){
							?>
           				            <option value="<?php 
							
							  echo strtoupper( $fi['id'])."-".$i;?>" >
           				              <?php 
							
							  echo strtoupper( $fi['grupo'])."-".strtoupper( $fi['nombre_tarifa'.$i]);?>
       				                </option>
           				            <?php
									}
								}
								} ?>
   				                </select></td>
   				           </tr>
           				      <tr>
           				        <td colspan="2"><input type="submit" name="Registrar" id="Registrar" value="Copiar"></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				   <table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false"  data-filter-control="true" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
					    
           				    <thead>
           				      <tr>
           				      <th  data-field="pais"><strong>Proveedor</strong>
           				      <th>Items
           				      <th><strong>Vlr Unitario</strong>
           				      <th  ><strong>Vlr Grupo</strong>                              
           				      <th  >BORRAR                              
       				         </thead>
                            
                            <?php 
							$total_unit=0;
							$total_grupo=0;
							$total_tk=0;
						
					$categorias=array("TIQUETES","DOCUMENTACION","ASISTENCIA","TRANSFERS","ALOJAMIENTO","RECEPTIVOS","SOUVENIRS","PROMOCION","GUIAS","OTROS");
				
								
							?>
                            <?php foreach ($categorias as $cat){
								?>
                             <tr>
                               <td colspan="5"><strong><?php
							   if($cat == "GUIAS"){
								   echo "COORDINACIÓN EN DESTINO"; } else{
							    echo $cat;} ?></strong></td>
                             </tr>
                            
                             <?php 
							 $resultado=$control->costeoListaProd($id_grupo,$cat,$multi);
							 $total_unit_cat=0;
							 $total_grupo_cat=0;
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                             
                             <?php if ( strtoupper($fi['nombre']) == "TIQUETE") {
								 
								   $contratoAerolinea=$control->cuposAereosProgramaPrincipal($id_grupo);
								 if($contratoAerolinea['nombre'] != ''){
								 $fi['nombre']=$contratoAerolinea['nombre'];
								 $fi['proveedor']=$contratoAerolinea['aerolinea'];
								 //var_dump($contratoAerolinea['id_sillas']);
	//							 var_dump($control->impuestosRecord($contratoAerolinea['id_sillas']));
								$fi['costo']=($contratoAerolinea['tadmin']*1.19)+$contratoAerolinea['neta_q']+$contratoAerolinea['q']+$control->impuestosRecord($contratoAerolinea['id_sillas']);
								 }
								
								$caerolinea=$fi['costo'];
								
								$total_tk=$caerolinea;
								 
								// $fi['costo']= $totalTK=$contratoAerolinea['neta_q']+$contratoAerolinea['q']+$control->impuestosRecord($contratoAerolinea['id'])+$contratoAerolinea['tadmin'];
								 
							 }?>
                               <td><a href="registrar_adicionales.php?idgrupo=<?php echo $id_grupo ?>&id_servicio=<?php echo $fi['id'] ?>" target="_blank"><?php echo strtoupper($fi['nombre']);?></a></td>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['costo'];
							  $grupo= $unitatio*$viajeros;
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
							  echo number_format($unitatio,2,",",".");
							  $total_grupo=$total_grupo+$grupo;
							  $total_grupo_cat=$total_grupo_cat+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  $total_unit_cat=$total_unit_cat+$unitatio;
							  ?></td>
                               <td align="right"><?php echo number_format($grupo,2,",",".");?></td>
                               <td>
                               <?php 
							  // var_dump($fi['tarifa']);
							   if(trim($fi['tarifa']) == "0;"){?>
                               <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borra_adicional=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>">X</a>
                               <?php }else{ ?>
                               <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                              
                                <tr>
                               <td bgcolor="#CCCCCC">&nbsp;</td>
                               <td bgcolor="#CCCCCC"><strong>TOTAL <?php echo $cat ?>:</strong></td>
                               <td align="right" bgcolor="#CCCCCC"><strong><?php echo number_format($total_unit_cat,2,",",".")?></strong></td>
                               <td align="right" bgcolor="#CCCCCC"><strong><?php echo number_format($total_grupo_cat,2,",",".") ?></strong></td>
                               <td bgcolor="#CCCCCC">&nbsp;</td>
                             </tr>
                              
                              
                             <?php } ?>
                                                          
                              
                              
                              <tr>
                               <td>&nbsp;</td>
                               <td><strong>TOTAL COSTOS DIRECTOS:</strong></td>
                               <td align="right"><strong><?php echo number_format($total_unit,2,",",".");?></strong></td>
                               <td align="right"><strong><?php echo number_format($total_grupo,2,",","."); ?></strong></td>
                               <td>&nbsp;</td>
                             </tr>
                               <tr>
                               <td colspan="5"><strong>COMISIONES</strong></td>
                             </tr>
                             <?php 
							 $comision_unit=0;
							 $comision_grupo=0;
							 $resultado=$control->costeoListaProd($id_grupo,'COMISIONES',$multi);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><a href="registrar_adicionales.php?idgrupo=<?php echo $id_grupo ?>&id_servicio=<?php echo $fi['id'] ?>" target="_blank"><?php echo strtoupper($fi['nombre']);?></a></td>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td align="right"><?php 
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
							  $unitatio= $fi['costo']*(($total_unit)/100);
							  $grupo= $fi['costo']*($total_grupo/100);
							  }
							  
							  if($fi['tipo_costo'] == 'COSTO FINANCIERO'){
							  $unitatio= $fi['costo']*(($total_unit-$total_tk)/100);
							  $grupo= $fi['costo']*($total_grupo-($total_tk*$viajeros)/100);
							  }
							  echo number_format($unitatio,2,",",".");
							  $comision_grupo=$comision_grupo+$grupo;
							  $comision_unit=$comision_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo  number_format($grupo,2,",",".");?></td>
                              <td>
                               <?php 
							  // var_dump($fi['tarifa']);
							   if(trim($fi['tarifa']) == "0;"){?>
                               <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borra_adicional=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>">X</a>
                               <?php }else{ ?>
                               <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>">X</a><?php } ?></td>
                             
                             </tr>
                           
                              <?php } ?>
                                <tr>
                               <td>&nbsp;</td>
                               <td><strong>TOTAL COMSIONES:</strong></td>
                               <td align="right"><strong><?php echo number_format($comision_unit,2,",",".")?></strong></td>
                               <td align="right"><strong><?php echo number_format($comision_grupo,2,",",".") ?></strong></td>
                               <td>&nbsp;</td>
                             </tr>
                                <tr>
                                  <td bgcolor="#666666">&nbsp;</td>
                                  <td bgcolor="#666666">&nbsp;</td>
                                  <td align="right" bgcolor="#666666">&nbsp;</td>
                                  <td align="right" bgcolor="#666666">&nbsp;</td>
                                  <td bgcolor="#666666">&nbsp;</td>
                             </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><strong>COSTO TOTAL</strong></td>
                                  <td align="right"><strong>
                                    <?php $subtotal=$comision_unit+$total_unit;
								  echo number_format($subtotal,2,",","."); ?>
                                  </strong></td>
                                  <td align="right"><strong>
                                    <?php  $subtotalg=$comision_grupo+$total_grupo;
								  echo number_format($subtotalg,2,",","."); ?>
                                  </strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>MARGEN DE CONTRIBUCIÓN 31%</td>
                                  <td align="right"><strong><?php $subtotal=$comision_unit+$total_unit;
								  echo number_format($subtotal*0.31,2,",","."); ?></strong></td>
                                  <td align="right"><strong><?php  $subtotalg=$comision_grupo+$total_grupo;
								  echo number_format($subtotalg*0.31,2,",","."); ?></strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><strong>PRECIO DE VENTA SUGERIDO:</strong></td>
                                  <td align="right"><strong><?php echo number_format($subtotal+($subtotal*0.31),2,",",".")?></strong></td>
                                  <td align="right"><strong><?php echo number_format($subtotalg+($subtotalg*0.31),2,",",".") ?></strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>PRECIO DEFINIDO</td>
                                  <td align="right"><?php 
								  if($multi == 1){
								  $precioFinal=($prospecto['valor_terrestre']+$prospecto['valor_aereo']);
								  }else{
								  $precioFinal=($prospecto['valor_terrestre_tarifa'.$multi]+$prospecto['valor_aereo_tarifa'.$multi]);
								  }
								  echo number_format($precioFinal,2,",",".") ?></td>
                                  <td align="right"><? echo number_format($precioFinal*$viajeros,2,",",".") ?></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>MARGEN DE CONTRIBUCIÓN (ACTUAL) <?php
								  echo number_format((($precioFinal-$subtotal)/$subtotal)*100,0,".",","); 
								  ?>% </td>
                                  <td align="right"><?php  echo number_format($precioFinal-$subtotal,2,",",".");?></td>
                                  <td align="right"><?php  echo number_format(($precioFinal-$subtotal)*$viajeros,2,",",".");?></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              
                            </table>
                            </div>
           				   <form action="costeo_multitarifa.php" method="post" name="form1" id="form1">
                            <?php 
							$servicio=$control->consultaServicioID($id_servicio);	
								
							?>
                            <?php if($subtotal == 0 && $multi==1){ ?>
							     <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=1&importarCosteo=<?php echo $prospecto['id_prospecto']?>" class="btn-xs btn-primary"> Importar Costeo Base</a>
							   <?php } ?>
                          
           				    <h2>ASIGNAR ELEMENTO</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">SERVICIO:       				              </td>
           				        <td><input type="hidden" name="id_servicio" id="id_servicio" placeholder="" value="<?php echo $id_servicio ?>">
           				          
           				          <input type="hidden" name="idgrupo" id="idgrupo" placeholder="" value="<?php echo $id_grupo ?>">                      
           				          <input type="hidden" name="id_costeo" id="id_costeo" placeholder="" value="<?php echo $id_grupo ?>"><input type="hidden" name="multitarifa" id="multitarifa" placeholder="" value="<?php echo $multi ?>">
           				          <select name="adicionarservicio" id="adicionarservicio">
           				            <?php 
							$total_insc=0;
						
							$resultado=$control->listaServiciosDisp($id_grupo,$multi);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				
								
								
							?>
           				            <option value="<?php 
							
							  echo strtoupper( $fi['id']);?>" >
           				              <?php 
							
							  echo strtoupper( $fi['nombre']);?>
       				                </option>
           				            <?php } ?>
   				                </select></td>
   				           </tr>
           				      <tr>
           				        <td colspan="2"><input type="submit" name="Registrar" id="Registrar" value="Asignar"></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>   <form action="costeo_multitarifa.php" method="post" name="form1" id="form1">
                            <?php 
							$servicio=$control->consultaServicioID($id_servicio);	
								
							?>
                            
                          
           				    <h2>ADICIONAR ELEMENTO</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">SERVICIO:       				              </td>
           				        <td><input type="hidden" name="id_servicio" id="id_servicio" placeholder="" value="<?php echo $id_servicio ?>">
                                
          <input type="hidden" name="idgrupo" id="idgrupo" placeholder="" value="<?php echo $id_grupo ?>">                      
       				            <input type="hidden" name="id_costeo" id="id_costeo" placeholder="" value="<?php echo $id_grupo ?>"><input type="hidden" name="multitarifa" id="multitarifa" placeholder="" value="<?php echo $multi ?>">
                                <input type="text" name="servicio" id="servicio" placeholder="" value="<?php echo $servicio['nombre'] ?>"></td>
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
       				            </select> 
           				        <a href="datos_proveedor.php" target="_blank">NUEVO PROVEEDOR</a></td>
                                
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
           				          <option value="GUIAS" <?php if($servicio['categoria']=="GUIAS"){echo "selected";}?>>COORDINACION EN DESTINO</option>
           				          <option value="OTROS" <?php if($servicio['categoria']=="OTROS"){echo "selected";}?>>OTROS </option>
           				          <option value="COMISIONES" <?php if($servicio['categoria']=="COMISIONES"){echo "selected";}?>>COMISIONES</option>
   				             </select></td>
           				        <td bgcolor="#CCCCCC">TIPO COSTEO:</td>
           				        <td><select name="tipocosto" id="tipocosto">
           				          <option value="DIRECTO" <?php if($servicio['tipo_costo']=="DIRECTO"){echo "selected";}?>>DIRECTO</option>
           				          <option value="POR DIA" <?php if($servicio['tipo_costo']=="POR DIA"){echo "selected";}?>>POR DIA</option>
                                    <option value="POR NOCHE" <?php if($servicio['tipo_costo']=="POR NOCHE"){echo "selected";}?>>POR NOCHE</option>
           				          <option value="GRUPAL" <?php if($servicio['tipo_costo']=="GRUPAL"){echo "selected";}?>>GRUPAL</option>
           				          <option value="COMISION" <?php if($servicio['tipo_costo']=="COMISION"){echo "selected";}?>>COMISION </option>
                                    <option value="COSTO FINANCIERO" <?php if($servicio['tipo_costo']=="COSTO FINANCIERO"){echo "selected";}?>>COSTO FINANCIERO</option>
           				        
   				             </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">COSTO:</td>
           				        <td><input type="text" name="costo" id="costo" placeholder="" value="<?php echo $servicio['costo'] ?>"></td>
           				        <td bgcolor="#CCCCCC">PRECIO VENTA AL DETAL:</td>
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
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form> <p><a class="btn-xs btn-primary" href="registrar_multitarifa.php?idgrupo=<?php echo $id_grupo;?>">Volver</a></p>
									
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=<?php echo $multi?>" class="btn-xs btn-primary"> RECARGAR</a>
                               <script type="text/javascript">
        $(function () {
			$('table').footable();

            $('.sort-column').click(function (e) {
                e.preventDefault();

                //get the footable sort object
                var footableSort = $('table').data('footable-sort');

                //get the index we are wanting to sort by
                var index = $(this).data('index');

                footableSort.doSort(index, 'toggle');
            });
        });
                               </script>
                             </p>
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
