<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>PROVEEDORES</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
           				    <p>
           				      <input type="button" name="button" id="button" value="Registrar Proveedor " onclick="location.href='datos_proveedor.php';" >
           				    </p>
           				   <table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
					    
           				    <thead>
           				      <tr>
								   <th>Nombre</th>
								   <th>Razón Social</th>
								   <th data-filter-control="select" data-field="estado">Estado</th>
								   <th data-filter-control="select" data-field="tipo">Tipo</th>
           				      <th data-filter-control="select" data-field="pais"><strong>Pais</strong></th>
           				      <th data-filter-control="select" data-field="Ciudad"><strong>Ciudad</strong></th>
           				      <th  data-filter-control="select" data-field="categoria"><strong>Categoria</strong></th>
								  <th><strong>Servicio</strong></th>
								 <th><strong>Ver</strong></th>
       				        </thead>
                            
           				   
                            
                            <?php 
							$total_insc=0;
						
							$resultado=$control->proveedores();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				
								
								
							?>
                             <tr>
								 <td><?php 
							
							  echo strtoupper( $fi['nombre']);?></td>
								 <td><?php 
							
							  echo strtoupper( $fi['razonsocial']);?></td>
								 <td><?php echo strtoupper($fi['estado']);?></td>
								 <td><?php echo strtoupper($fi['tipo']);?></td>
           				      <td><?php echo strtoupper($fi['pais']);?></td>
           				      <td><?php echo strtoupper($fi['ciudad']);?></td>
           				      <td><?php echo strtoupper( $fi['categoria']);?></td>
           				      <td><?php echo $fi['servicio'];
							?></td>
           				      
           				      <td><a href="datos_proveedor.php?id=<?php echo $fi['id'];?>" >Ver/Modificar</a>
								 <br/>
								  <a class="btn-xs btn-primary" href="proveedor_servicios.php?proveedor=<?php echo $fi['id'];?>" >Servicios</a>
								 </td>
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
