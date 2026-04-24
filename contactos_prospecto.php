<?php include('logged.php');?>
<?php include 'layout/header.php' ?>
<?php 

	//error_reporting(0);
 

?>

    
   

       <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                       <?php include 'layout/menu.php' ?> 
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				  <div class="module-head">
           				    <h3>Prospectos</h3>
       				      </div>
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  

	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div>
                              <?php } ?><!-- end of comments container "cmt-container" -->
                            <h2>PROSPECTOS
                              <input type="button" name="button" id="button" value="Registrar Prospectos" onclick="location.href='registrar_contacto.php?idgrupo=<?php echo $id_grupo?>';" >
                            - 
                            Buscar:
                            <input id="filter" type="text">
                            </h2>
                            <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo" data-filter="#filter">
           				    <thead>
           				      
           				      
           				    
           				      
           				        <tr>
           				          <th bgcolor="#CCCCCC">GRUPO</th>
           				      <th bgcolor="#CCCCCC"><strong>Nombre</strong></th>
           				      <th bgcolor="#CCCCCC">Telefono</th>
           				      <th bgcolor="#CCCCCC">Tipo</th>
           				      <th bgcolor="#CCCCCC">Origen</th>
           				      <th bgcolor="#CCCCCC">Observaciones</th>
           				      </thead>
                            
                            <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->contactosProspecto(0);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?><tr>
                              <td><a href="prospecto.php?grupo=<?php echo $fi['id_grupo']?>"><?php echo $fi['nombre_grupo'];?></a></td>
                           
           				      <td><?php echo $fi['nombre'];?></td>
           				      <td><?php echo $fi['telefono'];?></td>
                             
           				      <td><?php echo $fi['tipo'];?></td>
           				      <td><?php echo $fi['origen'];?></td>
           				      <td><?php echo $fi['observaciones'];?></td>
           				      </tr> <?php } ?>
                           
         				    </table>
                            <p>
                            <script src="js/footable.filter.js" type="text/javascript"></script>
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
    </body>
