<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
?>

    
   

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    <div class="panel panel-default">
					<div class="panel-heading">HISTORICO</div>
					<div class="panel-body">                 				  <div class="module-body">
                          
           				  <p>&nbsp;</p>
           				<table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
           				    <thead>
           				      <tr>
           				      <th data-filter-control="select" data-field="year"><strong>Año</strong></td>
           				      <th data-filter-control="select" data-field="un">Unidad Negocio                              
           				      <th><strong>Producto</strong></td>
           				      <th><strong>Origen</strong></td>
           				      <th><strong>Destino</strong></td>
           				      <th>Viajeros Estimados                              
           				      <th><strong>Inscritos</strong></td>
           				      <th>Salida                              
           				      <th>Regreso                              
           				      <th>Dias
           				      <th data-filter-control="select" data-field="estado"><strong>Estado</strong> 
         				        <th>Pagos                              
           				      <th><strong>Ver</strong></td>
       				        </thead>
                            
                            
								
           				    
                            
                            <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->gruposHistorial();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
                             <tr bgcolor="<?php echo $color_estado;?>">
           				      <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
           				      <td><?php echo strtoupper($fi['unidad_negocio']);?></td>
           				      <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
           				      <td><?php echo strtoupper($fi['origen']);?></td>
           				      <td><?php echo strtoupper( $fi['destino']);?></td>
           				      <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
           				      <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
           				      <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['f_salida']);?></td>
           				      <td><?php echo strtoupper( $fi['f_llegada']);?></td>
           				      <td><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
           				      <td><?php echo strtoupper( $fi['estado_final']);?></td>
           				      <td><a href="pagos.php?grupo=<?php echo $fi['id'];?>" target="_blank">Ver Pagos</a></td>
           				      <td><a href="insc.php?grupo=<?php echo $fi['id'];?>" target="_blank">Ver Inscritos</a></td>
       				        </tr>
           				 
                            <?php } ?>
                            </table>
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
                        </div>
                        </div>
                        </div>
    </body>
