<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	 $id_grupo = $_REQUEST['id_costeo'];
	 
if(isset($_REQUEST['aprobado_por'])){
		
	$mensaje=$control->aprobarCosteoGrupoProspecto($_REQUEST['id_costeo'],$_REQUEST['aprobado_por'],$_REQUEST['fecha_aprobacion'],$_REQUEST['observaciones'],$_REQUEST['aprobado']);

}

	 $prospecto=$control->datosProspecto($id_grupo);
	//var_dump($prospecto);
	
	if(isset($_REQUEST['nombre'])){
		
	$mensaje=$control->registrarCosteo($_REQUEST['nombre'],$_REQUEST['id_costeo'],$_REQUEST['proveedor'],$_REQUEST['tipocosteo'],$_REQUEST['categoria'],$_REQUEST['id_externo'],$_REQUEST['vlr'],$_REQUEST['pventa']);

}
if(isset($_REQUEST['borrar'])){
		
	$mensaje=$control->borrarCosteo($_REQUEST['id_costeo'],$_REQUEST['borrar']);

}


?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>COSTEO</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                                    
                                    
                                     <?php if(isset($mensaje)){?><div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
									  <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre:</strong></td>
           				        <td><?php echo $prospecto['nombre_grupo']; ?></td>
           				        <td bgcolor="#CCCCCC"><strong>Viajeros Estimados:</strong></td>
           				        <td><?php echo $prospecto['cantidad_viajeros'];
								$viajeros=$prospecto['cantidad_viajeros']; ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Fecha Salida Desde:</strong></td>
           				        <td><?php echo $prospecto['fecha_salida']; ?></td>
           				        <td bgcolor="#CCCCCC"><strong>Fecha Regreso:</strong></td>
           				        <td><?php echo $prospecto['fecha_regreso']; ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Noches:</strong></td>
           				        <td><?php 
								
									$salida = new DateTime($producto['fecha_salida']);
					$llegada = new DateTime($producto['fecha_regreso']);
					
     $datediff = strtotime($prospecto['fecha_regreso'])- strtotime($prospecto['fecha_salida']);
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
						
					
				
								
							?>
                             <tr>
                               <td colspan="5"><strong>TIQUETES</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'TIQUETES');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							 	
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                              
                              <tr>
                               <td colspan="5"><strong>DOCUMENTACION Y VISAS</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'DOCUMENTACION');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                             <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                                
                              <tr>
                               <td colspan="5"><strong>ASISTENCIA</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'ASISTENCIA');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                               <tr>
                               <td colspan="5"><strong>TRANSFERS</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'TRANSFERS');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                              <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                                  <tr>
                               <td colspan="5"><strong>ALOJAMIENTO</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'ALOJAMIENTO');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                                    <tr>
                               <td colspan="5"><strong>RECEPTIVOS</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'RECEPTIVOS');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                                <tr>
                               <td colspan="5"><strong>SOUVENIRS</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'SOUVENIRS');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                             <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                              
                                  <tr>
                               <td colspan="5"><strong>PROMOCION</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'PROMOCION');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                              
                                 <tr>
                               <td colspan="5"><strong>COORDINACION EN DESTINO</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'GUIAS');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                              
                                 <tr>
                               <td colspan="5"><strong>OTROS</strong></td>
                             </tr>
                             <?php 
							 $resultado=$control->costeoLista($id_grupo,'OTROS');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  echo $unitatio;
							  $total_grupo=$total_grupo+$grupo;
							  $total_unit=$total_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                              <?php } ?>
                              
                              
                              
                              <tr>
                               <td>&nbsp;</td>
                               <td><strong>TOTAL COSTOS DIRECTOS:</strong></td>
                               <td align="right"><strong><?php echo $total_unit?></strong></td>
                               <td align="right"><strong><?php echo $total_grupo ?></strong></td>
                               <td>&nbsp;</td>
                             </tr>
                               <tr>
                               <td colspan="5"><strong>COMISIONES</strong></td>
                             </tr>
                             <?php 
							 $comision_unit=0;
							 $comision_grupo=0;
							 $resultado=$control->costeoLista($id_grupo,'COMISIONES');
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td><?php echo strtoupper($fi['proveedor']);?></td>
                               <td><?php echo strtoupper($fi['nomproveedor']);?></td>
                               <td align="right"><?php 
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi['vlr'];
							  $grupo= $fi['vlr']*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi['vlr']*$dias;
							  $grupo= $fi['vlr']*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi['vlr']*($dias-1);
							  $grupo= $fi['vlr']*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi['vlr']/$viajeros;
							  $grupo= $fi['vlr'];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi['vlr']*($total_unit/100);
							  $grupo= $fi['vlr']*($total_grupo/100);
							  }
							  echo $unitatio;
							  $comision_grupo=$comision_grupo+$grupo;
							  $comision_unit=$comision_unit+$unitatio;
							  ?></td>
                               <td align="right"><?php echo $grupo;?></td>
                               <td><?php if($prospecto['aprobado_por']==0){?> <a href="costeo.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>">X</a><?php } ?></td>
                             </tr>
                           
                              <?php } ?>
                                <tr>
                               <td>&nbsp;</td>
                               <td><strong>TOTAL COMSIONES:</strong></td>
                               <td align="right"><strong><?php echo $comision_unit?></strong></td>
                               <td align="right"><strong><?php echo $comision_grupo ?></strong></td>
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
								  echo number_format($subtotal,0); ?>
                                  </strong></td>
                                  <td align="right"><strong>
                                    <?php  $subtotalg=$comision_grupo+$total_grupo;
								  echo number_format($subtotalg,0); ?>
                                  </strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>MARGEN DE CONTRIBUCIÓN SUGERIDO (31%)</td>
                                  <td align="right"><strong><?php $subtotal=$comision_unit+$total_unit;
								  echo number_format($subtotal*0.31,0); ?></strong></td>
                                  <td align="right"><strong><?php  $subtotalg=$comision_grupo+$total_grupo;
								  echo number_format( $subtotalg*0.31,0); ?></strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td><strong>PRECIO DE VENTA SUGERIDO:</strong></td>
                                  <td align="right"><strong><?php echo number_format($subtotal+($subtotal*0.31),0)?></strong></td>
                                  <td align="right"><strong><?php echo number_format($subtotalg+($subtotalg*0.31),0) ?></strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                              
                            </table>
           				 <?php 
							/*ESTADO APROBACION:
							0. en construcccion
							1. listo para revision
							2. rechazado debe modificarse
							3. aprobado por gerencia
							*/
						
						if($prospecto['aprobado_por']==0 && ($prospecto['estado_aprobacion']==0 || $prospecto['estado_aprobacion']==2)){?>
							   <form action="costeo.php" method="post" name="form1" id="form1">
                             <h2>ADICIONAR ELEMENTO</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Servicio</td>
           				        <td><input name="nombre" type="text" id="nombre">
                                <input type="hidden" id="id_costeo" name="id_costeo" value="<?php echo $id_grupo; ?>">
                                </td>
           				        <td>Proveedor</td>
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
           				        <td bgcolor="#CCCCCC">Categoria:</td>
           				        <td><select name="categoria" id="categoria">
           				          <option value="TIQUETES">TIQUETES</option>
           				          <option value="DOCUMENTACION">DOCUMENTACION Y VISAS </option>
           				          <option value="ASISTENCIA">SEGUROS DE VIAJE Y ASISTENCIA </option>
           				          <option value="TRANSFERS">TRANSFERS </option>
           				          <option value="ALOJAMIENTO">ALOJ. Y ALIMENTACION HOTEL </option>
           				          <option value="RECEPTIVOS">ATRACCIONES PARTICULARES (RECEPTIVOS)</option>
           				          <option value="SOUVENIRS">SOUVENIRS</option>
           				          <option value="PROMOCION">PROMOCION</option>
           				          <option value="GUIAS">COORDINACION EN DESTINO</option>
           				          <option value="OTROS ">OTROS </option>
           				          <option value="COMISIONES">COMISIONES</option>
                                </select></td>
           				        <td><p>Tipo Costeo:</p></td>
           				        <td><select name="tipocosteo" id="tipocosteo">
           				          <option value="DIRECTO">DIRECTO</option>
           				          <option value="POR DIA">POR DIA</option>
           				          <option value="GRUPAL">GRUPAL</option>
           				          <option value="COMISION">COMISION </option>
           				          <option value="POR NOCHE">POR NOCHE</option>
                                </select></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Costo:</td>
           				        <td><p>
           				          <input name="vlr" type="text" id="vlr" >
           				        </p></td>
           				        <td>Precio de Venta al Detal:</td>
           				        <td><input name="pventa" type="text" id="pventa" ></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"></td>
       				          </tr>
       				        </table>
           				   
       				        </form> 
							    <?php } ?>
							    <?php 
	$usu= $control->datosUsuario($_SESSION['id']);
							   if($usu['nivel']>= 10 && $prospecto['estado_aprobacion']==0){
							   ?>
           				   <form action="costeo.php" method="post" name="form1" id="form2">
           				     <h2>APROBAR COSTEO</h2>
           				     <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				       <tr>
           				         <td bgcolor="#CCCCCC">Aprobado Por</td>
           				         <td><input name="aprobado_por" type="hidden" id="aprobado_por" value="<?php  echo $_SESSION['id']?>"> 
									 <input name="id_costeo" type="hidden" id="id_costeo" value="<?php  echo $id_grupo?>"> 
									<?php
									if($prospecto['aprobado_por']==0){
	echo $usu['nombre'];
									} else {
												$usu= $control->datosUsuario($prospecto['aprobado_por']); echo $usu['nombre']; }?></td>
           				         <td>Fecha Aprobacion</td>
           				         <td><input name="fecha_aprobacion" type="date" id="fecha_aprobacion" value="<?php if($prospecto['aprobado_por']==0){ echo date('Y-m-d',strtotime("now")); } else{
												echo $prospecto['fecha_aprobacion'];
											} ?>" readonly></td>
       				           </tr>
           				       <tr>
           				         <td bgcolor="#CCCCCC">Observaciones:</td>
           				         <td colspan="3"><p>
           				           <textarea name="observaciones" id="observaciones">
									  <?php echo $prospecto['observaciones_aprobacion']?></textarea>
         				           </p></td>
       				           </tr>
								  <tr>
           				         <td bgcolor="#CCCCCC">Aprobacion:</td>
           				         <td colspan="3"><p>
           				           <select name="aprobacion" id="aprobacion">
           				             <option value="3">APROBADO</option>
           				             <option value="2">NECESITA MODICIFICACIONES</option>
                                   </select>
           				         </p></td>
       				           </tr>
								  <?php if($prospecto['aprobado_por']==0){?>
       				           <tr>
           				         <td colspan="4"><input type="submit" name="Registrar2" id="Registrar2" value="Registrar"></td>
       				           </tr>
								 <?php } ?>
       				         </table>
         				     </form>
							   <?php } ?>
							  
           				   <p>&nbsp;</p>
       				        <p><a class="btn-xs btn-primary" href="gruposprospecto.php">Volver</a></p>
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
