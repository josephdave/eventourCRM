<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 
if(isset($_REQUEST['aprobado_por'])){
	
			//aprobarCosteoGrupoProspecto($id,$aprobado_por,$fecha_aprobacion,$observaciones,$estado)
		
		//$id,$aprobado_por,$fecha_aprobacion,$observaciones,$estado,$tarifa
	$mensaje=$control->aprobarCosteoGrupoProspecto($_REQUEST['id_prospecto'],$_REQUEST['aprobado_por'],$_REQUEST['fecha_aprobacion'],$_REQUEST['observaciones'],$_REQUEST['aprobacion'],$_REQUEST['multitarifa']);
			
	
	}

	//error_reporting(0);	
	$tipo_costo="costo";
	if(isset($_REQUEST['id_costeo'])){
	 $id_grupo = $_REQUEST['id_costeo'];
		 $prospecto=$control->datosProducto($id_grupo);
		$tipo_costo="costo";
	
	}else{
	$id_prospecto=	$_REQUEST['id_prospecto'];
		 $prospecto=$control->datosProspecto($id_prospecto);
		$tipo_costo="costo_prospecto";
	
	}
	  $multi = $_REQUEST['multitarifa'];
	 
	
	
if(isset($_REQUEST['copiarprograma'])){
	$mensaje=$control->copiarCosteoPrograma($_REQUEST);
	
}
	if(isset($_REQUEST['servicio'])){
		
		if(isset($_REQUEST['id_costeo'])){
	
			
	$mensaje=$control->registrarAdicional($_REQUEST['id_servicio'],$_REQUEST['idgrupo'],$_REQUEST['servicio'],$_REQUEST['proveedor'],$_REQUEST['ubicacion'],$_REQUEST['fecha'],$_REQUEST['fecha2'],$_REQUEST['costo'],$_REQUEST['aplica'],$_REQUEST['pventa'],$_REQUEST['categoria'],$_REQUEST['tipocosto'],$_REQUEST['dia']);
			
	
	}else{
	
			
	$mensaje=$control->registrarAdicionalProspecto($_REQUEST['id_servicio'],$_REQUEST['id_prospecto'],$_REQUEST['servicio'],$_REQUEST['proveedor'],$_REQUEST['ubicacion'],$_REQUEST['fecha'],$_REQUEST['fecha2'],$_REQUEST['costo'],$_REQUEST['aplica'],$_REQUEST['pventa'],$_REQUEST['categoria'],$_REQUEST['tipocosto'],$_REQUEST['dia']);
	
	}
		
		

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
	 // window.alert("a");
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}


    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
//	

	  var table_html = table_html.replaceAll('.', '');
var table_html = table_html.replaceAll(',', ',');	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>COSTEO - <?php echo $prospecto['nombre_tarifa'.$multi]; ?></h3> 
		
		<?php if($id_grupo>0){?>
		<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=<?php echo $multi?>" class="btn-xs btn-primary"> RECARGAR</a>
		<?php } else { ?>
		<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto?>&multitarifa=<?php echo $multi?>" class="btn-xs btn-primary"> RECARGAR</a>
		<?php } ?>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                                    
                                    
                                     <?php if(isset($mensaje)){?><div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                                
                                <button id="btnExport">Descargar</button>
										
                             
                                <div id="table_wrapper">
									  <table  border="1" cellspacing="0" cellpadding="2" class="table demo" style="max-width: 800px;margin: 0 auto;font-size:13px;">
           				      <tr>
           				        <td width="14%" bgcolor="#bbd5ff"><strong>Nombre:</strong></td>
           				        <td width="52%"><?php echo $prospecto['grupo']; ?><?php echo $prospecto['nombre_grupo']; ?></td>
           				        <td width="12%" bgcolor="#bbd5ff"><strong>Viajeros Estimados:</strong></td>
           				        <td width="22%"><?php 
									
									if($prospecto['cant_viajeros'] > 0 ){
								$viajeros=$prospecto['cant_viajeros'];
									}else if($prospecto['cantidad_viajeros'] > 0 ){
								$viajeros=$prospecto['cantidad_viajeros'];
									}else{
										$viajeros = 1;
									}
									echo $viajeros;
									
									$viajerosOriginal=$viajeros;
									
									?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#bbd5ff"><strong>Fecha Salida Desde:</strong></td>
           				        <td><?php echo $prospecto['f_salida']; ?><?php echo $prospecto['fecha_salida']; ?></td>
           				        <td bgcolor="#bbd5ff"><strong>Fecha Regreso:</strong></td>
           				        <td><?php echo $prospecto['f_llegada']; ?><?php echo $prospecto['fecha_regreso']; ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#bbd5ff"><strong>Noches:</strong></td>
           				        <td><?php 
								if(isset($prospecto['f_llegada'])){
								
     $datediff = strtotime($prospecto['f_llegada'])- strtotime($prospecto['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
	 $noches=$dias-1;
								}else{
									   $datediff = strtotime($prospecto['fecha_regreso'])- strtotime($prospecto['fecha_salida']);
     $dias= floor($datediff/(60*60*24))+1;
	 $noches=$dias-1;
								}
								
								?>
                                <?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
           				        <td bgcolor="#bbd5ff">&nbsp;</td>
           				        <td>&nbsp;</td>
         				        </tr>
           				      <tr>
           				        <td bgcolor="#bbd5ff"><strong>Origen:</strong></td>
           				        <td><?php echo $prospecto['origen'] ?></td>
           				        <td bgcolor="#bbd5ff"><strong>Destino:</strong></td>
           				        <td><?php echo $prospecto['destino'] ?></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#bbd5ff"><strong>OBSERVACIONES:</strong></td>
           				        <td><?php echo $prospecto['observaciones'] ?></td>
           				        <td bgcolor="#bbd5ff"><strong>Encargado:</strong></td>
           				        <td><?php  $usuario=$control->datosUsuario($prospecto['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
       				          </tr>
           				      </table>
           				    <p>&nbsp;</p>
								  <style>
										.tabla-costeo{
											max-width: 800;
											margin: 0 auto;
										}
										.tabla-costeo td{
											padding:4px;
											
										}
										.tabla-costeo th{
											padding: 5px;
											background: rgb(141,180,226);
											text-transform: uppercase;
											
									  }.totales{
										   background: rgb(255,245,86);
									  }
									  .numeros{
										   background: rgba(192,234,172,1.00);
									  }
									  .directos{
										  background: rgba(0,7,81,1.00);
										  color: #fff;
										  
									  }
									  
									    .resultados{
										  background: rgba(18,70,2,1.00);
										  color: #fff;
										  
									  }
									    .contribucion{
										  background: rgba(223,121,10,1.00);
										  color: #fff;
										  
									  }
									  .resultadofinal{
										  background: rgba(130,70,4,1.00);
										  color: #fff;
										  
									  }
									
									</style>
								  <script>
									function switchvisible(id){
										
										if(document.getElementById(id).style.display == "none"){
											document.getElementById(id).style.display= "table-row";
										}else{
											document.getElementById(id).style.display= "none";
										}
										
									}
									</script>
           				    <table   border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="tabla-costeo" >
					    
           				    <thead>
           				      <tr>
           				      <th  data-field="pais"><strong>SERVICIOS</strong>
           				      <th>PROVEEDOR
           				     <?php if(!isset($_REQUEST['id_prospecto'])){?>  <th>Vlr Prospecto <?php }?>  
								  <?php
								 $pax_num=array(4,10,15	);
								  foreach($pax_num as $pax){?>
           				      <th><?php echo $pax;?> PAX                              
								  <?php } ?>
           				      <th><strong>INDIVIDUAL:<?php echo $viajeros;?> PAX </strong>
           				      <th  ><strong>GRUPO: <?php echo $viajeros;?> PAX</strong>                              
           				      <th   width="30px">
       				          </thead>
                            
                            <?php 
							$total_unit=0;
								$total_unit_pt=0;
							$total_grupo=0;
							$total_tk=0;
						$total_unit_tk=0;
								$ta=0;
					$categorias=array("TIQUETES","DOCUMENTACION","ASISTENCIA","TRANSFERS","ALOJAMIENTO","RECEPTIVOS","TC","SOUVENIRS","PROMOCION","GUIAS","OTROS");
				
								
							?>
							
                            <?php foreach ($categorias as $cat){
								?>
                            <!--
								<tr>
                               <td><strong><?php
							   if($cat == "GUIAS"){
								   echo "COORDINACIÓN EN DESTINO"; } else{
							    echo $cat;} ?></strong></td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                               <td>&nbsp;</td>
                             </tr>
                            -->
                             <?php 
	
					
	
	if(isset($_REQUEST['id_costeo'])){
	 $resultado=$control->costeoListaProd($_REQUEST['id_costeo'],$cat,$multi);
	
	}else{
	 $resultado=$control->costeoListaProdPROSPECTO($_REQUEST['id_prospecto'],$cat,$multi);
	
	}
						//	 $total_unit_cat=0;
	
						//	 $total_grupo_cat=0;
	
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
								$fi[$tipo_costo]=($contratoAerolinea['tadmin']*1.19)+$contratoAerolinea['neta_q']+$contratoAerolinea['q']+$control->impuestosRecord($contratoAerolinea['id_sillas']);
								 }
								
								$caerolinea=$fi[$tipo_costo];
								
								$total_tk=$caerolinea;
								 
								 
								// $fi[$tipo_costo]= $totalTK=$contratoAerolinea['neta_q']+$contratoAerolinea['q']+$control->impuestosRecord($contratoAerolinea['id'])+$contratoAerolinea['tadmin'];
								 
							 }?>
                               <td>
								   <?php if($fi['dia'] !=0){
								echo "(DIA".$fi['dia'].") "; 
							 }?>
								<?php   
								   	if(isset($_REQUEST['id_costeo'])){ ?>
								   <a href="registrar_adicionales.php?idgrupo=<?php echo $id_grupo ?>&id_servicio=<?php echo $fi['id'] ?>" target="_blank"><?php echo strtoupper($fi['nombre']);?></a>
	
							<?php }else{?>
								    <a href="registrar_adicionales.php?id_prospecto=<?php echo $_REQUEST['id_prospecto'] ?>&id_servicio=<?php echo $fi['id'] ?>" target="_blank"><?php echo strtoupper($fi['nombre']);?></a>
								   
								   <?php
	
								}
								  ?>		   
								   </td>
                               <td><?php 
								if($fi['proveedor']!=""){
								
								echo "<a href='datos_proveedor.php?id=".$fi['proveedor_id']."' target='_blank'>".strtoupper($fi['proveedor'])."</a>";
								}else{
								
									$prv=$control->datosProveedor($fi['proveedor_id']);
									echo "<a href='datos_proveedor.php?id=".$fi['proveedor_id']."' target='_blank'>".strtoupper($prv['nombre'])."</a>";
								
								}?></td>
                               <?php if(!isset($_REQUEST['id_prospecto'])){?>
								 <td align="right"><?php 
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
							  $unitatio= $fi['costo_prospecto']/$viajeros;
							  $grupo= $fi['costo_prospecto'];
							  }
							  echo number_format($unitatio,2,",",".");
							 // $total_grupo=$total_grupo+$grupo;
							 // $total_grupo_cat=$total_grupo_cat+$grupo;
							  
							//	$total_unit=$total_unit+$unitatio;
							
	
							//  $total_unit_cat=$total_unit_cat+$unitatio;
							  ?></td>
								 
								 <?php } ?>
								 
								   <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">
								 <?php 
								//	  var_dump($prospecto);
									  
									  if($fi['id_servicioproveedor']!=0){
								$tarifasevicio = $control->buscarTarifa($fi['id_servicioproveedor'],$pax,$prospecto['fecha_salida']);
									  
									  //var_dump($tarifasevicio);
									  
								$fi['tipo_costo']=	 $tarifasevicio['tipo_costeo'];
								//$fi['tipo_costo']=	 $tarifasevicio['tipo_costo'];
									  $viajeros=$pax;
									  $fi[$tipo_costo]= $tarifasevicio['tarifa'];
									echo 					"<small>".	$tarifasevicio['observaciones']."</small><br/>";}
									  else{
										   $viajeros=$pax;
										  
									  }
									  
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi[$tipo_costo];
							  $grupo= $unitatio*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi[$tipo_costo]*$dias;
							  $grupo= $fi[$tipo_costo]*$dias*$viajeros;
							  }
							 	
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi[$tipo_costo]*($dias-1);
							  $grupo= $fi[$tipo_costo]*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi[$tipo_costo]/$viajeros;
							  $grupo= $fi[$tipo_costo];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi[$tipo_costo]/$viajeros;
							  $grupo= $fi[$tipo_costo];
							  }
							  echo number_format($unitatio,2,",",".");
							  $total_grupo[$pax]=$total_grupo[$pax]+$grupo;
							  $total_grupo_cat[$pax]=$total_grupo_cat[$pax]+$grupo;
							  $total_unit[$pax]=$total_unit[$pax]+$unitatio;
								
								if ( $cat != "TIQUETES"){
								$total_unit_pt[$pax]=$total_unit_pt[$pax] + $unitatio;
		  }	else {
									$total_unit_tk[$pax]=$total_unit_tk[$pax]+$unitatio;
									if($fi['nombre']=="TA"||$fi['nombre']=="TASA ADMINISTRATIVA"){
									$ta+=$unitatio;
									}
									//var_dump($total_unit_tk);
								}

							  $total_unit_cat[$pax]=$total_unit_cat[$pax]+$unitatio;
							  ?>
								 
								 
								 </td>
								 <?php }?>
                               <td align="right"><?php 
								
								 if($fi['id_servicioproveedor']!=0){
								$tarifasevicio = $control->buscarTarifa($fi['id_servicioproveedor'],$viajerosOriginal,$prospecto['fecha_salida']);
									  
									  //var_dump($tarifasevicio);
									  
								$fi['tipo_costo']=	 $tarifasevicio['tipo_costeo'];
								//$fi['tipo_costo']=	 $tarifasevicio['tipo_costo'];
									  $viajeros=$viajerosOriginal;
									  $fi[$tipo_costo]= $tarifasevicio['tarifa'];
									echo 					"<small>".	$tarifasevicio['observaciones']."</small><br/>";}else{
									 
								
								  $viajeros=$viajerosOriginal;
								 }
								
								
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi[$tipo_costo];
							  $grupo= $unitatio*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi[$tipo_costo]*$dias;
							  $grupo= $fi[$tipo_costo]*$dias*$viajeros;
							  }
							 	
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi[$tipo_costo]*($dias-1);
							  $grupo= $fi[$tipo_costo]*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi[$tipo_costo]/$viajeros;
							  $grupo= $fi[$tipo_costo];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi[$tipo_costo]/$viajeros;
							  $grupo= $fi[$tipo_costo];
							  }
							  echo number_format($unitatio,2,",",".");
							  $total_grupo[$viajeros]=$total_grupo[$viajeros]+$grupo;
							  $total_grupo_cat[$viajeros]=$total_grupo_cat[$viajeros]+$grupo;
							  $total_unit[$viajeros]=$total_unit[$viajeros]+$unitatio;
								
								if ( $cat != "TIQUETES"){
								$total_unit_pt[$viajeros]=$total_unit_pt[$viajeros] + $unitatio;
		  }	else {
									$total_unit_tk[$viajeros]=$total_unit_tk[$viajeros]+$unitatio;
									if($fi['nombre']=="TA"||$fi['nombre']=="TASA ADMINISTRATIVA"){
									$ta+=$unitatio;
									}
									//var_dump($total_unit_tk);
								}

							  $total_unit_cat[$viajeros]=$total_unit_cat[$viajeros]+$unitatio;
							  ?></td>
                               <td align="right"><?php echo number_format($grupo,2,",",".");?></td>
                               <td><?php 
							  // var_dump($fi['tarifa']);
							   if(trim($fi['tarifa']) == "0;"){?>
                                 <?php if(isset($_REQUEST['id_costeo']) && $_REQUEST['id_costeo'] != 0){
	?>
                                 <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borra_adicional=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
                                 <?php
	
	}else{
									?>
                                 <a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&borra_adicional=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
                                 <?php
	
	}
									?>
                                 <?php }else{ ?>
                                 <?php if(isset($_REQUEST['id_costeo'])  && $_REQUEST['id_costeo'] != 0){
	?>
                                 <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
                                 <?php
	
	}else{
									?>
                                 <a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&borrar=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
                                 <?php
	
	}
									?>
                               <?php } ?></td>
                             </tr>
                              <?php } 
								
	if(mysql_num_rows($resultado)>0){
								?>
                              
                                <tr>
                               <td class="totales"><strong>TOTAL <?php echo $cat ?></strong></td>
                               <td class="totales">&nbsp;</td>
                                 <?php if(!isset($_REQUEST['id_prospecto'])){?><td align="right" class="numeros">&nbsp;</td>
                                
                                 <?php } ?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right" class="numeros"><strong><?php 
															
													
															echo number_format($total_unit_cat[$pax],2,",",".")?></strong></td>
								 <?php }?>
                               <td align="right" class="numeros"><strong><?php echo number_format($total_unit_cat[$viajeros],2,",",".")?></strong></td>
                               <td align="right" class="numeros"><strong><?php echo number_format($total_grupo_cat[$viajeros],2,",",".") ?></strong></td>
                               <td >&nbsp;</td>
                             </tr>
                              
                              
                             <?php
								}
								} ?>
                                                          
                              
                              
                              <tr>
                               <td class="directos">&nbsp;</td>
                               <td class="directos"><strong>TOTAL COSTOS DIRECTOS:</strong></td>
                          <?php if(!isset($_REQUEST['id_prospecto'])){?>   <td align="right" class="directos">&nbsp;</td>
                         
                          <?php }?>
								    <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                <td align="right" class="directos"><strong><?php echo number_format($total_unit_pt,2,",",".");?></strong></td>
                               <td align="right" class="directos"><strong><?php echo number_format($total_grupo,2,",","."); ?></strong></td>
                               <td>&nbsp;</td>
                             </tr>
                          <!--     <tr>
                               <td colspan="6"><strong>COMISIONES</strong></td>
                             </tr>-->
                             <?php 
							 $comision_unit=0;
							 $comision_grupo=0;
								
								if(isset($_REQUEST['id_costeo'])){
	 $resultado=$control->costeoListaProd($_REQUEST['id_costeo'],'COMISIONES',$multi);
	
	}else{
	 $resultado=$control->costeoListaProdPROSPECTO($_REQUEST['id_prospecto'],'COMISIONES',$multi);
	
	}
					
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							 ?>
                            
                             <tr>
                               <td>	   
								<?php   
								   	if(isset($_REQUEST['id_costeo'])){ ?>
								   <a href="registrar_adicionales.php?idgrupo=<?php echo $id_grupo ?>&id_servicio=<?php echo $fi['id'] ?>" target="_blank"><?php echo strtoupper($fi['nombre'])." ".$fi['costo']."%";?></a>
	
							<?php }else{?>
								    <a href="registrar_adicionales.php?id_prospecto=<?php echo $_REQUEST['id_prospecto'] ?>&id_servicio=<?php echo $fi['id'] ?>" target="_blank"><?php echo strtoupper($fi['nombre'])." ".$fi['costo_prospecto']."%";?></a>
								   
								   <?php
	
								}
								  ?>	</td>
                               <td><?php 
								if($fi['proveedor']!=""){
								
								echo strtoupper($fi['proveedor']);
								}else{
								
									$prv=$control->datosProveedor($fi['proveedor_id']);
									echo strtoupper($prv['nombre']);
								
								}?></td>
                                <?php if(!isset($_REQUEST['id_prospecto'])){?>  <td align="right">&nbsp;</td>
                              
                                <?php }?>
								   <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                              <td align="right"><?php 
								
								  if($multi == 1){
								  $precioFinal=($prospecto['valor_terrestre']+$prospecto['valor_aereo']);
									   
									  
								  }else{
								  $precioFinal=($prospecto['valor_terrestre_tarifa'.$multi]+$prospecto['valor_aereo_tarifa'.$multi]);
								  }
								
								//var_dump($total_unit_pt);
								
							  if($fi['tipo_costo'] == 'DIRECTO'){
							  $unitatio= $fi[$tipo_costo];
							  $grupo= $fi[$tipo_costo]*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'POR DIA'){
							  $unitatio= $fi[$tipo_costo]*$dias;
							  $grupo= $fi[$tipo_costo]*$dias*$viajeros;
							  }
							   if($fi['tipo_costo'] == 'POR NOCHE'){
							  $unitatio= $fi[$tipo_costo]*($dias-1);
							  $grupo= $fi[$tipo_costo]*($dias-1)*$viajeros;
							  }
							  if($fi['tipo_costo'] == 'GRUPAL'){
							  $unitatio= $fi[$tipo_costo]/$viajeros;
							  $grupo= $fi[$tipo_costo];
							  }
							  if($fi['tipo_costo'] == 'COMISION'){
							  $unitatio= $fi[$tipo_costo]*(($total_unit_pt)/100);
							  $grupo= $unitatio*$viajeros;
							  }
							  
							  if($fi['tipo_costo'] == 'COSTO FINANCIERO'){
							 // $unitatio= $fi[$tipo_costo]*(($total_unit-$total_tk)/100);
								   $unitatio= $fi[$tipo_costo]*(($total_unit_pt)/100);
								  //var_dump($unitatio);
							  $grupo= $unitatio*$viajeros;
							  }
								
								 if($fi['tipo_costo'] == 'COSTO FINANCIERO' && strtoupper($fi['nombre']) == 'FEE'){
									 
									 
									   if($multi == 1){
								  $precioFinal=($prospecto['valor_terrestre']);
								  }else{
								  $precioFinal=($prospecto['valor_terrestre_tarifa'.$multi]);
								  }
									 
									 
									 		  $unitatio= $fi[$tipo_costo]*(($precioFinal)/100);//AQUI
								  //var_dump($unitatio);
							  $grupo= $unitatio*$viajeros;	
									 }
								
								 if($fi['tipo_costo'] == 'COSTO FINANCIERO' && (strtoupper($fi['nombre']) == 'COSTO FINANCIERO' || strtoupper($fi['nombre']) == 'GASTOS BANCARIOS POR RECAUDO')){
									 
									
									 
									 
									 		  $unitatio= $fi[$tipo_costo]*(($total_unit_pt+$total_unit_tk)/100);//AQUI
								  //var_dump($unitatio);
							  $grupo= $unitatio*$viajeros;	
									 }
							//	var_dump($viajeros);
							  echo number_format($unitatio,2,",",".");
							  $comision_grupo=$comision_grupo+$grupo;
							  $comision_unit=$comision_unit+$unitatio;
							// $total_unit_pt=$total_unit_pt + $unitatio;
							  ?></td>
                               <td align="right"><?php echo  number_format($grupo,2,",",".");?></td>
                               <td>
                               <?php 
							  // var_dump($fi['tarifa']);
							   if(trim($fi['tarifa']) == "0;"){?>
								  
								  		<?php if(isset($_REQUEST['id_costeo']) && $_REQUEST['id_costeo'] != 0){
	?>
								  	  
                               <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borra_adicional=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
								  
								 <?php
	
	}else{
									?>
								  <a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&borra_adicional=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
								 <?php
	
	}
									?>	
								  
							
                               <?php }else{ ?>
								  
								  <?php if(isset($_REQUEST['id_costeo'])  && $_REQUEST['id_costeo'] != 0){
	?>
								  	  
                               <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&borrar=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
								  
								 <?php
	
	}else{
									?>
								  <a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&borrar=<?php echo $fi['id'] ?>&multitarifa=<?php echo $multi ?>"><img src="imagenes/delete.png" alt=""/></a>
								 <?php
	
	}
									?>	
                              <?php } ?></td>
                             
                             </tr>
                           
                              <?php } ?>
                                <tr>
                               <td class="totales"><strong>TOTAL COMSIONES:</strong></td>
                               <td class="totales">&nbsp;</td>
                                 <?php if(!isset($_REQUEST['id_prospecto'])){?><td align="right" class="numeros">&nbsp;</td>
                             
                                 <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                               <td align="right" class="numeros"><strong><?php echo number_format($comision_unit,2,",",".")?></strong></td>
                               <td align="right" class="numeros"><strong><?php echo number_format($comision_grupo,2,",",".") ?></strong></td>
                               <td>&nbsp;</td>
                             </tr>
                                <tr>
                                  <td bgcolor="#CECECE">&nbsp;</td>
                                  <td bgcolor="#CECECE">&nbsp;</td>
                                 
                                   <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
									 <td align="right" bgcolor="#CECECE">&nbsp;</td>
                                  <td align="right" bgcolor="#CECECE">&nbsp;</td>
                                  <td align="right" bgcolor="#CECECE">&nbsp;</td>
                                  <td >&nbsp;</td>
                             </tr>
                                <tr>
                                  <td class="directos"><a href="#!" onClick="switchvisible('detalle_costos');switchvisible('detalle_costos2');switchvisible('detalle_costos3')" style="color: #fff">+</a></td>
                                  <td class="directos"><strong>COSTO TOTAL PORCION TERRESTRE</strong></td>
                                  <?php if(!isset($_REQUEST['id_prospecto'])){?>  <td align="right" class="directos">&nbsp;</td>
                               
                                  <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right" class="directos"><strong>
                                    <?php $subtotal=$comision_unit+$total_unit_pt;
								  echo number_format($subtotal,2,",","."); ?>
                                  </strong></td>
                                  <td align="right" class="directos"><strong>
                                    <?php  $subtotalg=$comision_grupo+$total_grupo;
								  echo number_format($subtotalg,2,",","."); ?>
                                  </strong></td>
                                  <td >&nbsp;</td>
                                </tr>
                                <tr id="detalle_costos" >
                                  <td>&nbsp;</td>
                                  <td>MARGEN DE CONTRIBUCIÓN SUGERIDA <br>
                                  PT 31%</td>
                                 <?php if(!isset($_REQUEST['id_prospecto'])){?>   <td align="right">&nbsp;</td>
                              
                                 <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right"><strong><?php $subtotal=$comision_unit+$total_unit_pt;
								  echo number_format($subtotal*0.31,2,",","."); ?></strong></td>
                                  <td align="right"><strong><?php  $subtotalg=$comision_grupo+$total_grupo;
								  echo number_format($subtotalg*0.31,2,",","."); ?></strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr id="detalle_costos2" >
                                  <td>&nbsp;</td>
                                  <td><strong>PRECIO DE VENTA SUGERIDO PT:</strong></td>
                                  <?php if(!isset($_REQUEST['id_prospecto'])){?>  <td align="right">&nbsp;</td>
                                
                                  <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right"><strong><?php echo number_format($subtotal+($subtotal*0.31),2,",",".")?></strong></td>
                                  <td align="right"><strong><?php echo number_format($subtotalg+($subtotalg*0.31),2,",",".") ?></strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr id="detalle_costos3" >
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right">&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="directos"><a href="#!" onClick="switchvisible('detalle_tiq');switchvisible('detalle_tiq2')"style="color: #fff">+</a></td>
                                  <td class="directos"><strong>COSTO TOTAL TIQUETES</strong></td>
                                  <?php if(!isset($_REQUEST['id_prospecto'])){?>
									<td class="directos">&nbsp;</td>
									
									<?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right" class="directos"><strong>
                                    <?php $subtotal=$total_unit_tk-$ta;
									//  var_dump($total_unit_tk);
								  echo number_format($subtotal,2,",","."); ?>
                                  </strong></td>
                                  <td align="right" class="directos"><strong>
                                    <?php  $subtotalg=($total_unit_tk-$ta)*$viajeros;
								  echo number_format($subtotalg,2,",","."); ?>
                                  </strong></td>
                                  <td >&nbsp;</td>
                                </tr>
                                <tr id="detalle_tiq" style="display: none">
                                  <td>&nbsp;</td>
                                  <td><strong>MARGEN DE CONTRIBUCIÓN (TA) </strong></td>
                                 <?php if(!isset($_REQUEST['id_prospecto'])){?>
									<td>&nbsp;</td>
								
									<?php } ?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right"><strong>
                                    <?php $subtotal=$ta;
								//	  var_dump($total_unit_tk);
								  echo number_format($subtotal,2,",","."); ?>
                                  </strong></td>
                                  <td align="right"><strong>
                                    <?php  $subtotalg=($ta)*$viajeros;
								  echo number_format($subtotalg,2,",","."); ?>
                                  </strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr id="detalle_tiq2" style="display: none">
                                  <td>&nbsp;</td>
                                  <td><strong>PRECIO DE VENTA TK</strong></td>
                                   <?php if(!isset($_REQUEST['id_prospecto'])){?>
									<td>&nbsp;</td>
									
									<?php } ?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right"><strong>
                                    <?php $subtotal=$total_unit_tk;
								//	  var_dump($total_unit_tk);
								  echo number_format($subtotal,2,",","."); ?>
                                  </strong></td>
                                  <td align="right"><strong>
                                    <?php  $subtotalg=($total_unit_tk)*$viajeros;
								  echo number_format($subtotalg,2,",","."); ?>
                                  </strong></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                   <?php if(!isset($_REQUEST['id_prospecto'])){?> <td align="right">&nbsp;</td>
                                
                                   <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right">&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="resultados"><a href="#!" onClick="switchvisible('detalle_margenpt');switchvisible('detalle_margenpt2')"style="color: #fff">+</a></td>
                                  <td class="resultados">PRECIO VENTA REAL PT</td>
                                    <?php if(!isset($_REQUEST['id_prospecto'])){?><td align="right" class="resultados">&nbsp;</td>
                                 
                                    <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right" class="resultados"><?php 
								  if($multi == 1){
								  $precioFinal=($prospecto['valor_terrestre']);
								  }else{
								  $precioFinal=($prospecto['valor_terrestre_tarifa'.$multi]);
								  }
								  echo number_format($precioFinal,2,",",".") ?></td>
                                  <td align="right" class="resultados"><?php echo number_format($precioFinal*$viajeros,2,",",".") ?></td>
                                  <td>&nbsp;</td>
                                </tr>
								     <tr id="detalle_margenpt" style="display: none"> 
                                  <td >&nbsp;</td>
                                  <td>MARGEN DE CONTRIBUCIÓN (ACTUAL) 
									  <?php
								 // echo number_format((($precioFinal-$total_unit_pt)/($total_unit_pt+$comision_unit))*100,0,".",","); 
								  ?>
									  <?php
								  echo number_format((($precioFinal-$total_unit_pt-$comision_unit)/($precioFinal))*100,0,".",","); 
								  ?>% </td>
                                    <?php if(!isset($_REQUEST['id_prospecto'])){?><td align="right">&nbsp;</td>
                                  
                                    <?php }?>
										   <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right"><?php  echo number_format($precioFinal-$total_unit_pt-$comision_unit,2,",",".");?></td>
                                  <td align="right"><?php  echo number_format(($precioFinal-$total_unit_pt-$comision_unit)*$viajeros,2,",",".");?></td>
                                  <td>&nbsp;</td>
                                </tr>
								   <tr id="detalle_margenpt2" style="display: none">
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                   <?php if(!isset($_REQUEST['id_prospecto'])){?> <td align="right">&nbsp;</td>
                                  
                                   <?php }?>
									     <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right">&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
						        <tr>
							         <td class="resultados"><a href="#!" onClick="switchvisible('detalle_margentk');"style="color: #fff">+</a></td>
							         <td class="resultados">PRECIO VENTA REAL  TK</td>
							         <?php if(!isset($_REQUEST['id_prospecto'])){?>
							         <td align="right" class="resultados">&nbsp;</td>
							       
							         <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
							         <td align="right" class="resultados"><?php 
								  if($multi == 1){
								  $precioFinaltk=($prospecto['valor_aereo']);
								  }else{
								  $precioFinaltk=($prospecto['valor_aereo_tarifa'.$multi]);
								  }
								  echo number_format($precioFinaltk,2,",",".") ?></td>
							         <td align="right" class="resultados"><?php echo number_format($precioFinaltk*$viajeros,2,",",".") ?></td>
							         <td>&nbsp;</td>
					          </tr>
						        <tr id="detalle_margentk" style="display: none">
						          <td>&nbsp;</td>
						          <td>MARGEN DE CONTRIBUCIÓN TK (ACTUAL)
						            <?php
								  echo number_format((($precioFinaltk-($total_unit_tk-$ta))/($total_unit_tk-$ta))*100,0,".",","); 
								  ?>
						            % </td>
						          <?php if(!isset($_REQUEST['id_prospecto'])){?>
						          <td align="right">&nbsp;</td>
						        
						          <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
						          <td align="right"><?php  echo number_format($precioFinaltk-($total_unit_tk-$ta),2,",",".");?></td>
						          <td align="right"><?php  echo number_format(($precioFinaltk-($total_unit_tk-$ta))*$viajeros,2,",",".");?></td>
						          <td>&nbsp;</td>
					          </tr>
                           
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                   <?php if(!isset($_REQUEST['id_prospecto'])){?> <td align="right">&nbsp;</td>
                                  
                                   <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right">&nbsp;</td>
                                  <td align="right">&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="resultadofinal">&nbsp;</td>
                                  <td class="resultadofinal">PRECIO VENTA REAL PROGRAMA</td>
                                  <?php if(!isset($_REQUEST['id_prospecto'])){?>
                                  <td align="right" class="resultadofinal">&nbsp;</td>
                                
                                  <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right" class="resultadofinal"><?php 
								  if($multi == 1){
								  $precioFinaltotal=($prospecto['valor_aereo']+$prospecto['valor_terrestre']);
								  }else{
								  $precioFinaltotal=($prospecto['valor_aereo_tarifa'.$multi]+$prospecto['valor_terrestre_tarifa'.$multi]);
								  }
								  echo number_format($precioFinaltotal,2,",",".") ?></td>
                                  <td align="right" class="resultadofinal"><?php echo number_format($precioFinaltotal*$viajeros,2,",",".") ?></td>
                                  <td >&nbsp;</td>
                                </tr>
                                <tr>
                                  <td class="contribucion">&nbsp;</td>
                                  <td class="contribucion">MARGEN DE CONTRIBUCIÓN  (ACTUAL)
                                    <?php
								 // echo number_format((($precioFinaltotal-(($total_unit_tk-$ta)+$total_unit_pt))/(($total_unit_tk-$ta)+$total_unit_pt+$comision_unit))*100,0,".",","); 
									  
									  echo number_format((($precioFinaltotal-(($total_unit_tk-$ta)+$total_unit_pt+$comision_unit))/$precioFinaltotal)*100,0);
								  ?>
                                    % </td>
                                  <?php if(!isset($_REQUEST['id_prospecto'])){?>
                                  <td align="right" class="contribucion">&nbsp;</td>
                                
                                  <?php }?>
									  <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
                                  <td align="right" class="contribucion"><?php  echo number_format($precioFinaltotal-(($total_unit_tk-$ta)+$total_unit_pt+$comision_unit),2,",",".");?></td>
                                  <td align="right" class="contribucion"><?php  echo number_format(($precioFinaltotal-(($total_unit_tk-$ta)+$total_unit_pt+$comision_unit))*$viajeros,2,",",".");?></td>
                                  <td >&nbsp;</td>
                                </tr>
								  <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                   <?php if(!isset($_REQUEST['id_prospecto'])){?> <td align="right">&nbsp;</td>
                                <?php }?>
									    <?php
								 
								  foreach($pax_num as $pax){?>
								 <td align="right">&nbsp;</td>
								 <?php }?>
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
							   <?php } 
							   
							   if(isset($_REQUEST['id_costeo'])){
	
	
	
							   ?>
                          
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
       				        </form>  
								
							
                            <?php 
								   
							   }
							$servicio=$control->consultaServicioID($id_servicio);	
							
								   
							?>
									<?php if( $prospecto['estado_aprobacion'.$multi] != 3){ ?>
									<form action="costeo_multitarifa.php" method="post" name="form1" id="form1">
                            
                          
           				    <h2>ADICIONAR ELEMENTO</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">SERVICIO:       				              </td>
           				        <td>
									<?php if(isset($_REQUEST['id_costeo'])){
	?>   <input type="hidden" name="id_costeo" id="id_costeo" placeholder="" value="<?php echo $id_grupo ?>">				 <input type="hidden" name="idgrupo" id="idgrupo" placeholder="" value="<?php echo $id_grupo ?>"><?php
	}else{
	?>	<input type="hidden" name="id_prospecto" id="id_prospecto" placeholder="" value="<?php echo $id_prospecto ?>"><?php
	
	} ?>
								
       <input type="hidden" name="id_servicio" id="id_servicio" placeholder="" value="<?php echo $id_servicio ?>">                         
                         
       				            <input type="hidden" name="multitarifa" id="multitarifa" placeholder="" value="<?php echo $multi ?>">
                         <select name="servicio" id="servicio" class="servicio" style="width: 200px">
								
									</select></td>
           				        <td bgcolor="#CCCCCC">PROVEEDOR:</td>
           				        <td><select name="proveedor" id="proveedor" class="chosen-select">
           				          <?php 
							$total_insc=0;
						
							$resultado=$control->proveedoresAprobados();
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
           				        <td><input type="datetime-local" name="fecha" id="fecha" value="<?php if(isset($servicio['fecha'])){echo date("Y-m-d\TH:i:s",strtotime($servicio['fecha']));}else{echo "0000-00-00 00:00:00";} ?>">
           				          <select name="dia" id="dia">
           				            <option value="0" <?php if($servicio['dia']=="0"){echo "selected";}?>>N/A</option>
           				            <option value="1" <?php if($servicio['dia']=="1"){echo "selected";}?>>Día 1</option>
           				            <option value="2" <?php if($servicio['dia']=="2"){echo "selected";}?>>Día 2</option>
           				            <option value="3" <?php if($servicio['dia']=="3"){echo "selected";}?>>Día 3</option>
           				            <option value="4" <?php if($servicio['dia']=="4"){echo "selected";}?>>Día 4</option>
           				            <option value="5" <?php if($servicio['dia']=="5"){echo "selected";}?>>Día 5</option>
           				            <option value="6" <?php if($servicio['dia']=="6"){echo "selected";}?>>Día 6</option>
           				            <option value="7" <?php if($servicio['dia']=="7"){echo "selected";}?>>Día 7</option>
           				            <option value="8" <?php if($servicio['dia']=="8"){echo "selected";}?>>Día 8</option>
           				            <option value="9" <?php if($servicio['dia']=="9"){echo "selected";}?>>Día 9</option>
           				            <option value="10" <?php if($servicio['dia']=="10"){echo "selected";}?>>Día 10</option>
   				                </select></td>
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
									 <option value="TC" <?php if($servicio['categoria']=="TC"){echo "selected";}?>>TC</option>
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
           				        <td><input type="text" name="costo" id="costo" placeholder="" value="<?php echo $servicio[$tipo_costo] ?>"></td>
           				        <td bgcolor="#CCCCCC">PRECIO VENTA AL DETAL:</td>
           				        <td><input type="text" name="pventa" id="pventa" placeholder="" value="<?php echo $servicio['pventa'] ?>"></td>
   				           </tr>
                           <tr>
           				        <td bgcolor="#CCCCCC">APLICA A:</td>
       				         <td colspan="3"><span class="controls">
   				             <select multiple name="aplica[]" class="span8" id="aplica[]" tabindex="1" data-placeholder="Select here..">
           				          <!--  <option value="
									0" <?php if(strpos($servicio['tarifa'],"0") !== false){ echo "selected";}  ?>  >TODOS</option>-->
                                    <option value="
									-1" 
                                    <?php if(strpos($servicio['tarifa'],"-1") !== false){ echo "selected";}  ?> 
                                    >OPCIONAL</option>
           				            <?php 
								 
									  $datos_producto=$prospecto;
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
									
       				        </form> 
       				        <form action="costeo_multitarifa.php" method="post" name="form1" id="form3">
       				          <?php 
							$servicio=$control->consultaServicioID($id_servicio);	
								
							?>
       				          <?php if($subtotal == 0 && $multi==1 && isset($id_grupo)){ ?>
       				          <a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=1&importarCosteo=<?php echo $prospecto['id_prospecto']?>" class="btn-xs btn-primary"> Importar Costeo Base</a>
       				          <?php } ?>
       				          <h2>COPIAR COSTEO</h2>
       				          <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo" width="100%">
       				            <tr>
       				              <td width="22%" bgcolor="#CCCCCC">COSTEO PROGRAMA: </td>
       				              <td width="78%" colspan="3"><input type="hidden" name="id_servicio2" id="id_servicio2" placeholder="" value="<?php echo $id_servicio ?>">
       				                <?php if(isset($_REQUEST['id_costeo'])){
	 $id_grupo = $_REQUEST['id_costeo'];
		 $prospecto=$control->datosProducto($id_grupo);?>
       				                <input type="hidden" name="id_costeo" id="id_costeo" placeholder="" value="<?php echo $id_grupo ?>">
       				                <?php
	
	}else{
	?>
       				                <input type="hidden" name="id_prospecto" id="id_prospecto" placeholder="" value="<?php echo $id_prospecto ?>">
       				                <?php
	
	}
									?>
       				                <input type="hidden" name="idgrupo" id="idgrupo" placeholder="" value="<?php echo $id_grupo ?>">
       				                <input type="hidden" name="multitarifa" id="multitarifa" placeholder="" value="<?php echo $multi ?>">
       				                <select name="copiarprograma" id="copiarprograma" class="chosen-select" style="width: 100%">
       				                  <?php 
	
	if(isset($_REQUEST['id_costeo'])){
	$resultado=$control->grupos();
	
	}else{
	$resultado=$control->gruposProspecto();
	
	}
					
							
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				//var_dump($fi);
								
								for($i=1;$i<=10;$i++){
								//	var_dump($fi['nombre_tarifa'.$i]);
									if($fi['nombre_tarifa'.$i]!=''){
							?>
       				                  <option value="<?php 
							
							  echo strtoupper( $fi['id'])."-".$i;?>" >
       				                    <?php 
							
							  echo strtoupper( $fi['grupo']."".$fi['nombre_grupo'])."-".strtoupper( $fi['nombre_tarifa'.$i]);?>
   				                      </option>
       				                  <?php
									}
								}
								}
									  
									  
									  ?>
   				                    </select></td>
   				                </tr>
       				            <tr>
       				              <td bgcolor="#CCCCCC">COPIAR COMO</td>
       				              <td><input type="text" name="copiar_como" id="copiar_como"></td>
       				              <td bgcolor="#CCCCCC">DIA (SI APLICA):</td>
       				              <td><select name="dia" id="dia">
       				                <option value="0" <?php if($servicio['dia']=="0"){echo "selected";}?>>N/A</option>
       				                <option value="1" <?php if($servicio['dia']=="1"){echo "selected";}?>>Día 1</option>
       				                <option value="2" <?php if($servicio['dia']=="2"){echo "selected";}?>>Día 2</option>
       				                <option value="3" <?php if($servicio['dia']=="3"){echo "selected";}?>>Día 3</option>
       				                <option value="4" <?php if($servicio['dia']=="4"){echo "selected";}?>>Día 4</option>
       				                <option value="5" <?php if($servicio['dia']=="5"){echo "selected";}?>>Día 5</option>
       				                <option value="6" <?php if($servicio['dia']=="6"){echo "selected";}?>>Día 6</option>
       				                <option value="7" <?php if($servicio['dia']=="7"){echo "selected";}?>>Día 7</option>
       				                <option value="8" <?php if($servicio['dia']=="8"){echo "selected";}?>>Día 8</option>
       				                <option value="9" <?php if($servicio['dia']=="9"){echo "selected";}?>>Día 9</option>
       				                <option value="10" <?php if($servicio['dia']=="10"){echo "selected";}?>>Día 10</option>
     				                </select></td>
   				                </tr>
       				            <tr>
       				              <td colspan="4"><input type="submit" name="Registrar3" id="Registrar3" value="Copiar"></td>
   				                </tr>
   				              </table>
       				          <p>&nbsp;</p>
     				          </form>
									<?php } ?>
       				        <p>&nbsp;
									
								</p>
									
									  <?php 
	$usu= $control->datosUsuario($_SESSION['id']);
							   if($usu['nivel']>= 10 || $prospecto['estado_aprobacion'.$multi]!=3){
							   ?>
           				   <form action="costeo_multitarifa.php" method="post" name="form1" id="form2">
           				     <h2>APROBAR COSTEO</h2>
           				     <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				       <tr>
           				         <td bgcolor="#CCCCCC">Aprobado Por</td>
           				         <td><input name="aprobado_por" type="hidden" id="aprobado_por" value="<?php  echo $_SESSION['id']?>"> 
									 <input name="id_prospecto" type="hidden" id="id_prospecto" value="<?php  echo $_REQUEST['id_prospecto'];?>"> 
									 
									 <input name="multitarifa" type="hidden" id="multitarifa" value="<?php  echo $_REQUEST['multitarifa'];?>"> 
									<?php
									if($prospecto['aprobado_por'.$multi]==0){
	echo $usu['nombre'];
									} else {
												$usu= $control->datosUsuario($prospecto['aprobado_por'.$multi]); echo $usu['nombre']; }?></td>
           				         <td>Fecha Aprobacion</td>
           				         <td><input name="fecha_aprobacion" type="date" id="fecha_aprobacion" value="<?php if($prospecto['aprobado_por']==0){ echo date('Y-m-d',strtotime("now")); } else{
												echo $prospecto['fecha_aprobacion'];
											} ?>" readonly></td>
       				           </tr>
           				       <tr>
           				         <td bgcolor="#CCCCCC">Observaciones:</td>
           				         <td colspan="3"><p>
           				           <textarea name="observaciones" id="observaciones">
									  <?php echo trim($prospecto['observaciones_aprobacion'.$multi])?></textarea>
         				           </p></td>
       				           </tr>
								  <tr>
           				         <td bgcolor="#CCCCCC">Aprobacion:</td>
           				         <td colspan="3"><p>
           				           <select name="aprobacion" id="aprobacion">
           				             <option value="3" <?php if($prospecto['estado_aprobacion'.$multi]== 3){echo 'selected';}?>>APROBADO</option>
           				             <option value="2"  <?php if($prospecto['estado_aprobacion'.$multi]== 2){echo 'selected';}?>>NECESITA MODICIFICACIONES</option>
                                   </select>
           				         </p></td>
       				           </tr>
								  <?php if($usu['nivel']>= 10){?>
       				           <tr>
           				         <td colspan="4"><input type="submit" name="Registrar2" id="Registrar2" value="Registrar"></td>
       				           </tr>
								 <?php } ?>
       				         </table>
         				     </form>
							   <?php } ?>
       				        <p>
								
       				          <?php if(isset($_REQUEST['id_costeo'])){
	?>
       				          <a class="btn-xs btn-primary" href="registrar_multitarifa.php?idgrupo=<?php echo $id_grupo;?>">Volver</a><?php
	
	}else{
									?><a class="btn-xs btn-primary" href="registrar_multitarifa.php?idprospecto=<?php echo $id_prospecto;?>">Volver</a><?php
	
	}
									?>	
       				          
       				          
       				          
       				          
     				          </p>
									
										<?php if($id_grupo>0){?>
		<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo?>&multitarifa=<?php echo $multi?>" class="btn-xs btn-primary"> RECARGAR</a>
		<?php } else { ?>
		<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto?>&multitarifa=<?php echo $multi?>" class="btn-xs btn-primary"> RECARGAR</a>
		<?php } ?>
                             
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script>
	
	$('.servicio').select2({
  ajax: {
	   
    url: function (params) {
		//  console.log('https://eventoursport.travel/crm/api.php?servicio='+ params.term+"&proveedor="+$('#proveedor').val());
     return 'https://eventoursport.travel/crm/api.php?servicio='+ params.term+"&proveedor="+$('#proveedor').val();
    },dataType: 'json'
  }
	
});
	

	
	

</script>
    </body>
