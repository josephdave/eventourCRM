<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>SEGURO ASISTENCIA</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
           				    <p>
           				      <input type="button" name="button" id="button" value="Registrar Asistencia " onclick="location.href='datos_asistencia.php';" >
           				    </p>
           				   <table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
					    
           				    <thead>
           				      <tr>
           				      <th data-filter-control="select" data-field="pais"><strong>Proveedor</strong></td>
           				      <th><strong>Nombre</strong>
           				      <th  data-filter-control="select" data-field="categoria"><strong>Vlr Dia</strong><th><strong>Ver</strong></td>
       				        </thead>
                            
           				   
                            
                            <?php 
							$total_insc=0;
						
							$resultado=$control->asistencia();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				
								
								
							?>
                             <tr>
           				      <td><?php 
							  $pr=$control->datosProveedor($fi['proveedor_id']);
							  echo strtoupper($pr['nombre']);?></td>
           				      <td><?php echo strtoupper($fi['nombre']);?></td>
           				      <td><?php echo strtoupper( $fi['vlr_dia']);?></td>
           				      <td><a href="datos_asistencia.php?id=<?php echo $fi['id'];?>" >Ver/Modificar</a></td>
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
    </body>
