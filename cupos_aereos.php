<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}

if(isset($_REQUEST['estado'])){
	
	
		
		$mensaje=$control->actualizarEstadoSillas($_REQUEST['id'],$_REQUEST['estado']);
		
	
}

if(isset($_REQUEST['historial_id'])){
	
	
		
		$mensaje=$control->actualizarHistorialSillas($_REQUEST['historial_id']);
		
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> CONTRATO AEROLINEA</h3>
       				      
           				  <div class="module-body">
                     <!--     
           				  <p><a href="insc.php?grupo=0">Ver Todos </a><br>
           				  </p>
           				  <form name="form1" method="post" action="busqueda.php">
           				    <label for="termino"></label>
           				    Busqueda General:
           				    <input type="text" name="termino" id="termino" ><input name="Submit" type="submit" value="Consultar">
         				    </form>
           				  <p>&nbsp; </p>--><div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">CONTRATO AEROLINEA</div>
					<div class="panel-body">
           				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      <tr>
           				      <th ><strong>NOMBRE</strong></td>
                               <th>Año</th>
                               <th><strong>Estado</strong></th>
           				      <th><strong>Aerolinea</strong>
           				      <th><strong>Record</strong>
           				      <th data-hide="all" data-visible="false"><strong>Radicado</strong>
           				      <th><strong>Cupos </strong>
           				      <th >Utilizados                              
           				      <th ><strong>Origen</strong>
           				      <th data-hide="all" data-visible="false"><strong>Destino</strong>
           				      <th data-hide="all" data-visible="false"><strong>Ruta</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Vuelo llegada a destino </strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Vuelo llegada Origen</strong></th>
           				                               <th><strong>Neta+Q</strong></th>
                                                       	                            
                     	                               <th><strong>Impuestos</strong></th>                                                                  	                               <th><strong>TA</strong></th>
                               <th><strong>Total</strong></th>
                                                       	                               <th><strong>Politica TC</strong></th>	                               <th><strong>Vlr TC</strong></th>
                                                                                       	                              
                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F Deposito</strong></th>
                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>Deposito xPAx</strong></th>
                                                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F. Cambios</strong></th>	                               <th data-hide="all" data-visible="false"><strong>F. Nombres</strong></th>	                               <th data-hide="all" data-visible="false"><strong>F. Emision</strong></th>
                                                                                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F. Impuestos</strong></th>
           				      <th><strong>Ver</strong></th>
       				        </thead>
                            
                            
								
           				    
                            
                            <?php 
							
							
							$resultado=$control->cuposAereos($_REQUEST['historial']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								$producto=$control->datosProducto($fi['id_grupo']);
								
								if($producto['estado']!='HISTORIAL'){
								
								
								
							?>
                             <tr>
                             <td><a href="detalle_aerolinea.php?id=<?php echo $fi['id'];?>"><?php echo strtoupper($fi['nombre']);?></a></td>
                             <td><?php echo date("Y", strtotime($fi['fecha_salida']));?></td>
                             <td>
							 <form id="form2<?php echo  $fi['id'];?>" name="form1" method="post" action="cupos_aereos.php" style="margin:0;">
       				                                            <input type="hidden" id="id" name="id" value="<?php echo $fi['id'];?>">
       				                                     		
<select name="estado" id="estado" onchange="getElementById('form2<?php echo  $fi['id'];?>').submit()">
  <option value="APROBADO" <?php if($fi['estado']=="APROBADO"){echo 'selected';}?>>APROBADO</option>
  <option value="RECHAZADO" <?php if($fi['estado']=="RECHAZADO"){echo 'selected';}?>>RECHAZADO</option>
  <option value="EN VERIFICACIÓN" <?php if($fi['estado']=="EN VERIFICACIÓN"){echo 'selected';}?>>EN VERIFICACIÓN</option>
  <option value="CANCELADO" <?php if($fi['estado']=="CANCELADO"){echo 'selected';}?>>CANCELADO</option>
           				       
         				              </select>
       				                                            
                               </form></td>
                              <td><?php echo strtoupper($fi['aerolinea']);?></td>
                             <td><?php echo strtoupper($fi['record']);?></td><td><?php echo strtoupper($fi['radicado']);?></td>
                             <td><?php echo $fi['cupos_solicitados'];?></td>
                             <td><?php 
							 
							 $usados=$control->cuposRecord($fi['id']);
							
							 
							 echo $usados;?></td>
                             <td><?php echo $fi['origen'];?></td>
                             <td><?php echo $fi['destino'];?></td>
                             <td><?php echo $fi['ruta'];?></td>
           				      <td><?php echo $fi['vuelo_llegada_destino']." ".date("d-m-Y H:m", strtotime($fi['fecha_salida']));?></td>
                              <td><?php echo $fi['vuelo_llegada_origen']." ".date("d-m-Y H:m", strtotime($fi['fecha_regreso']));?></td>
           				      <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['neta_q']+$fi['q'],0,',','.')?></td>
                            <td><?php echo "$".$producto['MONEDA']." ". number_format($control->impuestosRecord($fi['id']),0,',','.')?></td><td><?php echo "$".$producto['MONEDA']." ". number_format($fi['tadmin']*1.19,0,',','.')?></td>
                            <td><?php echo "$".$producto['MONEDA']." ". number_format(($fi['tadmin']*1.19)+$fi['neta_q']+$fi['q']+$control->impuestosRecord($fi['id']),0,',','.')?></td>
                              
           				      <td><?php echo strtoupper($fi['politica_tc']);?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['vlr_tc'],0,',','.')?></td>
                              
                              <td><?php echo date("d-m-Y", strtotime($fi['f_deposito']));?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['deposito_pax'],0,',','.')?></td>
                              <td>
                              <?php echo date("d-m-Y", strtotime($fi['f_cambios']));?></td>
                             <td> <?php echo date("d-m-Y", strtotime($fi['f_nombres']));?></td>
                              <td><?php echo date("d-m-Y ", strtotime($fi['f_emision']));?></td>
                            <td>  <?php echo date("d-m-Y", strtotime($fi['f_impuestos']));?></td>
           				      <td>
                      <button type="button" class="btn-xs btn-primary" onclick="location.href='reporte_contrato_liquidacion.php?id=<?php echo $fi['id'];?>'">LIQUIDACION</button>
                      
                      <button type="button" class="btn-xs btn-primary" onclick="location.href='reporte_contrato.php?id=<?php echo $fi['id'];?>'">LISTADO EMISION</button>
                      <?php if($_REQUEST['historial']==0){?>
                       <button type="button" class="btn-xs btn-primary" onclick="location.href='cupos_aereos.php?historial=0&historial_id=<?php echo $fi['id'];?>'">ARCHIVAR</button>
                       <?php } ?>
                      
                         
                   </td>
           				      
       				        </tr>
           				 
                            <?php }} ?>
                            </table>
                            </div>
                                                        </div>
                                                                                    </div>
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
           				  </div>
           				</div>
                        </div>
    </body>
