<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	

?>


    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> PAGOS A PROVEEDORES </h3>
       				      
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
                    <table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC">PROVEEDOR</th>
          <th bgcolor="#CCCCCC">PAGADO</th>
          <th bgcolor="#CCCCCC"></th>
          </thead>
      <?php 
						
							
							$resultado4=$control->consultaPagosProveedor();
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								
								$proveedor=$control->datosProveedor($fi4['id_proveedor']);
							?>
      <tr>
        <td><?php echo $proveedor['nombre'];?></td>
        <td><?php if($fi4['moneda']=="Dolar"){
			echo "US $";}else{
				echo "$";				
							}
			?> <?php echo number_format($fi4['total'],0,",",".");?></td>        
              <td><button type="button" class="btn-xs btn-primary" onClick="location.href='liquidacion_proveedor.php?grupo=<?php echo $id_grupo;?>&proveedor=<?php echo $fi4['id'];?>'">-</button></td>
        
        </tr>
      <?php } ?>
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
