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
           				    <tr><?php } ?>
           				      <th><strong>Viajero(s)</strong></th>
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
           				   
           				  
                            
                            <?php 
							
							$facturador="";
							$aereo_base=0;
							$ModificacionesTK=0;
							$terrestre_base=0;
							$ModificacionesPT=0;
							$pagosPT=0;
							$pagosTK=0;
							$ultimafecha="";
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {								
							 if($facturador != $fi['facturacion_nodocumento']){
								 if($facturador != ""){
								 ?>
                                  <tr>
                                 <td><?php echo $viajero ?></td>
           				      <td><?php echo $facturador ?></td>
                             
           				      <td><?php echo $ultimafecha ?></td>
           				      <td><?php echo ($aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK)?></td>
           				      <td><?php echo $aereo_base+$ModificacionesTK ?></td>
           				      <td><?php echo $aereo_base+$ModificacionesTK-$pagosTK ?></td>
           				      <td><?php echo $pagosTK ?></td>
           				      <td><?php echo $terrestre_base+$ModificacionesPT ?> </td>
           				      <td><?php echo $terrestre_base+$ModificacionesPT-$pagosPT?></td>
           				      <td><?php echo $pagosPT ?></td>
       				        </tr>
                                 <?php
								 }
								$facturador=$fi['facturacion_nodocumento'];
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajero($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								$pagosPT=$pagos['pagosPT'];
							  
								$ultimafecha= $pagos['ultimafecha'];
								
								
							 }else{
								
								$aereo_base+= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK+=  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
								
								$realTK= $aereo_base+$ModificacionesTK;
								
								
								$terrestre_base+= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT+=  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
								
								
								$pagos=$control->pagosViajero($fi['id']);
							  
							  	$pagosTK+=$pagos['pagosTIK'];
								$pagosPT+=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								}
								
							 } ?>
                             <tr>
                                 <td><?php echo $viajero ?></td>
           				      <td><?php echo $facturador ?></td>
                             
           				      <td><?php echo $ultimafecha ?></td>
           				      <td><?php echo ($aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK)?></td>
           				      <td><?php echo $aereo_base+$ModificacionesTK ?></td>
           				      <td><?php echo $aereo_base+$ModificacionesTK-$pagosTK ?></td>
           				      <td><?php echo $pagosTK ?></td>
           				      <td><?php echo $terrestre_base+$ModificacionesPT ?> </td>
           				      <td><?php echo $terrestre_base+$ModificacionesPT-$pagosPT?></td>
           				      <td><?php echo $pagosPT ?></td>
       				        </tr>
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
