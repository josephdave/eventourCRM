<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> TIPOS DE HABITACIONES <button type="button" class="btn-xs btn-primary" onClick="location.href='registrar_tipohab.php'">NUEVO</button></h3>
       				      
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
					          <th ><strong>Hotel</strong> 
				              <th><strong>Tipo</strong> 
				              <th data-hide="all" data-visible="false"><strong>Plan</strong> 
			                  <th><strong>Ver</strong></th>
			              </thead>
					      <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->tiposHabitaciones();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
									
							?>
					      <tr>
					        <td><?php echo $fi['hotel'];?></td>
					        <td><?php echo $fi['tipo'];?></td>
					        <td><?php echo strtoupper($fi['plan']);?></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='tipohab.php?id=<?php echo $fi['id'];?>'">TARIFAS</button>
                              
                              </td>
				          </tr>
					      <?php } ?>
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
