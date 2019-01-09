<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	if(isset($_REQUEST['eliminar'])){
		
		$control->borrarPago($_REQUEST['eliminar']);
	
	}
	
?>
	
 
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGOS REALIZADOS</div>
					<div class="panel-body">
           				  <div class="module-body">
           				    <p>&nbsp;</p>
           				 	<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      
           			
           				    <tr>
           				      <?php if($_SESSION['id']==5){ ?><th width="68">BORRAR</th>
           				      
           				      <?php } ?>
           				      
                              <th width="17">id</th><th width="61">Producto</th>
           				     
           				      <th width="76"><strong>Documento</strong></th>
           				      <th width="54"><strong>Nombre</strong></th>
           				      <th width="40">Fecha Registro</th>
           				      <th width="40">Fecha Pago</th>
           				      <th width="114">Fecha Validacion</th>
           				      <th width="80"> Registrado por</th>
           				      <th width="59">Medio</th>
           				      <th width="67">Abono PT</th>
           				      <th width="74">Abono TIK</th>
           				      <th width="25">Fee</th>
           				      <th width="36">TRM</th>
       				        </thead>
           				    <tr>
           				     
                            
                            <?php 
							
							$resultado=$control->pagosRegistrados();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                            <?php if($_SESSION['id']==5){ ?>
                             <td><a href="pagos_registrados.php?eliminar=<?php echo $fi['id'];?>" onclick="return confirm('Desea Borrar?')">Eliminar</a></td>
                            
           				  <?php } ?>
                           <td><?php echo $fi['id']?></td>
                          <td><?php echo $control->nomGrupo($fi['id_producto']);?></td>
           				      <td><?php 
							  $viajero=$control->datosViajeroID($fi['id_viajero']);
							  
							  echo $viajero['documento'];?> <a href="registrar_pago.php?doc=<?php echo $viajero['id'];?>" target="_blank"><?php echo $viajero['no_documento'];?></a></td>
           				      <td><?php echo strtoupper($viajero['apellidos']);?> <?php echo strtoupper($viajero['nombres']);?></td>
           				      <td><?php echo $fi['fecha_registro']?></td>
           				      <td><?php echo $fi['fecha']?></td>
           				      <td><?php echo $fi['f_modificacion']?></td>
           				      <td><?php $val= $control->datosUsuario($fi['usuario']); echo $val['nombre'];?></td>
           				      <td><?php echo $fi['medio']?></td>
           				      <td><?php echo $fi['valor_PT']?></td>
           				      <td><?php echo $fi['valor_TIK']?></td>
           				      <td><?php echo $fi['fee']?></td>
           				      <td><?php echo $fi['trm']?></td>
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
    </script></div>
           				</div>
                        </div>
                        </div></div>
                      
    </body>
