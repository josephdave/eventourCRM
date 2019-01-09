<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	 $id_grupo = $_REQUEST['grupo'];
	 
	 $programa=$control->datosProducto($id_grupo);
?>


    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> PROVEEDORES <?php echo $programa['grupo']?></h3>
       				      
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
          <th bgcolor="#CCCCCC">CAEGORIA</th>
          <th bgcolor="#CCCCCC">CIUDAD</th>
          <th bgcolor="#CCCCCC">PAIS</th>
          <th bgcolor="#CCCCCC">TELEFONO</th>
          <th bgcolor="#CCCCCC"></th>
          </thead>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado4=$control->consultaProveedores($id_grupo);
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo $fi4['nombre'];?></td>
        <td><?php echo $fi4['categoria'];?></td>
        <td><?php echo $fi4['ciudad'];?></td>
        <td><?php echo $fi4['pais'];?></td>
                <td><?php echo $fi4['telefono'];?></td>        
              <td><button type="button" class="btn-xs btn-primary" onClick="location.href='liquidacion_proveedor.php?grupo=<?php echo $id_grupo;?>&proveedor=<?php echo $fi4['id'];?>'">LIQUIDACIÓN</button></td>
        
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
