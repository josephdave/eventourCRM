<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> REPORTES OPERATIVOS HISTORICO</h3>
       				      
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
					
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
					  <tr>
					    <td><table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
					      <thead>
					        <tr>
					          <th ><strong>Año</strong> 
				              <th><strong>Producto</strong> 
				              <th data-hide="all" data-visible="false"><strong>Origen</strong> 
			                  <th><strong>Destino</strong> 
			                  <th data-hide="all" data-visible="false">Viajeros Estimados                              
		                      <th><strong>Inscritos</strong> 
		                      <th><strong>Unidad Negocio</strong> 
	                          <th><strong>Ver</strong></th>
			              </thead>
					      <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->gruposTodos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$color_estado = $control->colorEstado($fi['estado']);
								if($fi['estado'] == "HISTORIAL"){
								
							?>
					      <tr>
					        <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
					        <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
					        <td><?php echo strtoupper($fi['origen']);?></td>
					        <td><?php echo strtoupper( $fi['destino']);?></td>
					        <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
					        <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
					        <td><?php echo strtoupper( $fi['unidad_negocio']);?></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='reporte_observaciones.php?id=<?php echo $fi['id'];?>'">OBSERVACIONES</button>
                            <button type="button" class="btn-xs btn-primary" onClick="location.href='documentacion.php?id=<?php echo $fi['id'];?>'">DOCUMENTACIÓN</button>
                            <button type="button" class="btn-xs btn-primary" onClick="location.href='asistencia.php?grupo=<?php echo $fi['id'];?>'">ASISTENCIA</button>
					          <button type="button" class="btn-xs btn-primary" onClick="location.href='reporte_sillas.php?id=<?php echo $fi['id'];?>'">VUELOS</button>
                              <button type="button" class="btn-xs btn-primary" onClick="location.href='reporte_actividades.php?id=<?php echo $fi['id'];?>'">SERVICIOS</button>
                              <button type="button" class="btn-xs btn-primary" onClick="location.href='reporte_voucher.php?id=<?php echo $fi['id'];?>'">VOUCHER</button>
                                 
                                 <button type="button" class="btn-xs btn-primary" onClick="location.href='itinerario.php?grupo=<?php echo $fi['id'];?>'">ITINERARIO SERVICIOS</button>
                                 <button type="button" class="btn-xs btn-primary" onClick="location.href='actividades_grupo_reporte.php?grupo=<?php echo $fi['id'];?>'">SERVICIOS Y VIAJEROS</button>
                              
                              <button type="button" class="btn-xs btn-primary" onClick="location.href='acomodacion.php?id=<?php echo $fi['id'];?>'">ACOMODACIÓN</button>
                                <button type="button" class="btn-xs btn-primary" onClick="location.href='roominglist2.php?id=<?php echo $fi['id'];?>'">ROOMING LIST</button>
                                <button type="button" class="btn-xs btn-primary" onClick="location.href='proveedores_programa.php?grupo=<?php echo $fi['id'];?>'">PROVEEDORES</button>
								
								 <button type="button" class="btn-xs btn-primary" onClick="location.href='liquidacion_total.php?grupo=<?php echo $fi['id'];?>'">LIQUIDACIÓN POR SERVICIO</button>
								
								 <button type="button" class="btn-xs btn-primary" onClick="location.href='liquidacion_viajero.php?grupo=<?php echo $fi['id'];?>'">LIQUIDACIÓN POR VIAJERO</button>
                                
                              
                              
                              </td>
				          </tr>
					      <?php }} ?>
				        </table>					      <a href="insc.php?grupo=0"></a></td>
					    </tr>
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
