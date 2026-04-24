<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	if(isset($_REQUEST['borrar']) && $_REQUEST['borrar'] != 0){
	
	$resultado=$control->borrarRegistro($_REQUEST['borrar']);
	}
	
	if($_POST["estado"] == 1){
	$resultado=$control->registrarEstado($_REQUEST['documento'],$_REQUEST['estado_viaje']);
	
	}
?>
	
 
    
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">Lista de Correos Constant -  <?php echo $control->nomGrupo($_REQUEST['grupo']); ?></div>
					<div class="panel-body">
           				  <div class="module-body"><p>&nbsp;</p>
           				  
                            
                            <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							  $cat_anterior ="";
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$categoria= $fi['otro'];
								if($categoria!=$cat_anterior){
									echo "<p><h1>".$categoria."</h1>";
									$cat_anterior=$categoria;
								}
							?>
                            <?php if($_REQUEST['grupo'] == 0){?> <?php } ?>
           				    <?php if($fi['email'] != ""){?>  <?php echo strtoupper($fi['nombres']);?> <?php echo strtoupper($fi['apellidos']);?> <?php echo " ".$fi['email'];?><br><?php } ?>           				        
							<?php if($fi['acudiente1_email'] != ""){?><?php echo strtoupper($fi['acudiente1_nombre']);?> <?php echo strtoupper($fi['acudiente1_apellido']);?><?php echo " ".$fi['acudiente1_email'];?><br><?php } ?>
                            
                            <?php if($fi['acudiente2_email'] != ""){?>
       				          <?php echo strtoupper($fi['acudiente2_nombre']);?> <?php echo strtoupper($fi['acudiente2_apellido']);?>  <?php echo " ".$fi['acudiente2_email'];?> <br><?php } ?>
       				          </td>
           				      <?php if($_REQUEST['grupo'] != 8){?>   <?php } else{ ?>
                              <?php } ?>
       				       
                             <?php } ?>
         				   
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
    </script></div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
