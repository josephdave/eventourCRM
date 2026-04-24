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
           				      <th width="59">Validado Por</th>
           				      <th width="59">Moneda</th>
           				      <th width="59">Valor Solicitado</th>
           				      <th width="67">Valor Pagado</th>
           				      <th width="36">Comprobante Egreso</th>
           				      <th width="36">TRM</th>
           				      <th width="36">Observaciones</th>
       				        </thead>
           				    <tr>
           				     
                            
                            <?php 
							
							$resultado=$control->pagosRegistradosProveedor();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                            <?php if($_SESSION['id']==5){ ?>
                             <td><a href="pagos_registrados.php?eliminar=<?php echo $fi['id'];?>" onclick="return confirm('Desea Borrar?')">Eliminar</a></td>
                            
           				  <?php } ?>
                           <td><?php echo $fi['id']?></td>
                          <td><?php echo $control->nomGrupo($fi['id_producto']);?></td>
           				      <td><?php 
							  $viajero=$control->datosProveedor($fi['id_proveedor']);
							  
							  echo $viajero['rut'];?> </td>
           				      <td><?php echo strtoupper($viajero['nombre']);?> <?php echo strtoupper($viajero['razonsocial']);?></td>
           				      <td><?php echo $fi['fecha']?></td>
           				      <td><?php echo $fi['fecha_real']?></td>
           				      <td><?php echo $fi['f_modificacion']?></td>
           				      <td><?php $val= $control->datosUsuario($fi['usuario']); echo $val['nombre'];?></td>
           				      <td><?php $val= $control->datosUsuario($fi['usuario_valido']); echo $val['nombre'];?></td>
           				      <td><?php echo $fi['moneda']?></td>
           				      <td><?php echo $fi['valor']?></td>
           				      <td><?php echo $fi['valor_real']?></td>
           				      <td><?php echo $fi['comprobante_egreso']?></td>
           				      <td><?php echo $fi['trm']?></td>
           				      <td><?php echo $fi['observaciones']?></td>
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
