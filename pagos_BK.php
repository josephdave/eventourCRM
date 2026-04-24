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
					<div class="panel-heading">ESTADO DE CUENTA GRUPO</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 
						  $producto=$control->datosProducto($_REQUEST['grupo']);
						  
						  ?>
           				  <h3>Valor TIK: 	
           				    <?php $aereo_base=$producto['valor_aereo'];  echo $producto['MONEDA']." ".$aereo_base;?>
           				    <br>
           				    Valor PT:	
           				      <?php $terrestre_base=$producto['valor_terrestre']; echo $producto['MONEDA']." ".$terrestre_base;?>
           				  </h3>
           				  <table class="table table-hover" data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
           				    <thead>
           				      
           				      
           				      <?php if($_REQUEST['grupo'] == 0){?>
           				    <tr><th>Grupo</th><?php } ?>
           				      <th><strong>Documento</strong></th>
           				      <th><strong>Viajero</strong></th>
           				      <th>Factura</th>
           				      <th>Ultima Fecha de Pago</th>
           				      <th><strong>Saldo por Pagar</strong></th>
           				      <th>Valor TIK</th>
           				      <th>Saldo TIK</th>
           				      <th>Pagos TIK</th>
           				      <th>Valor PT</th>
           				      <th>Saldo PT</th>
           				      <th>Pagos PT</th>
           				      </thead>
           				    <tr>
           				  
                            
                            <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
							?>
                            <?php if($_REQUEST['grupo'] == 0){?> <td><?php echo $control->nomGrupo($fi['id_grupo']);?></td><?php } ?>
           				      <td><a href="registrar_pago.php?doc=<?php echo $fi['no_documento'];?>" target="_blank"><?php echo $fi['no_documento'];?></a></td>
           				      <td><?php echo strtoupper($fi['apellidos']);?> <?php echo strtoupper($fi['nombres']);?></td>
           				      <td><?php echo strtoupper($fi['facturacion_nombre']);?> -<?php echo $fi['facturacion_nodocumento'];?></td>
                              <?php $pagos=$control->pagosViajero($fi['id']);
							  $ModificacionesPT =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
							  
							  $pendienteTotal=($terrestre_base+$aereo_base+$ModificacionesPT+$ModificacionesTK)-($pagos['pagosTIK']+$pagos['pagosPT']);
							  
							  ?>
           				      <td><?php echo $pagos['ultimafecha']?></td>
           				      <td><strong><?php echo $pendienteTotal?></strong></td>
           				      <td><?php $ModificacionesTK =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
							  echo $aereo_base+$ModificacionesTK?></td>
           				      <td><?php
							  
							  
							   echo ($aereo_base+$ModificacionesTK-$pagos['pagosTIK']);?></td>
           				      <td><?php echo $pagos['pagosTIK'];?></td>
           				      <td><?php 
							  echo $terrestre_base+$ModificacionesPT?></td>
           				      <td><?php echo ($terrestre_base+$ModificacionesPT-$pagos['pagosPT']);?></td>
           				      <td><?php echo $pagos['pagosPT'];?></td>
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
                          <a href="excel.php?grupo=<?php echo $_REQUEST['grupo']?>">Descargar a EXCEL</a> </div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
