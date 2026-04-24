<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> PAGOS</h3>
       				      
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
					<div class="panel-heading">PAGOS POR GRUPO HISTORICO</div>
					<div class="panel-body">
           				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      <tr>
           				      <th ><strong>Año</strong></td>
           				      <th><strong>Producto</strong></td>
           				      <th data-hide="all" data-visible="false"><strong>Origen</strong></td>
           				      <th><strong>Destino</strong></td>
           				      <th data-hide="all" data-visible="false">Viajeros Estimados                              
           				      <th><strong>Inscritos</strong></td>
           				      <th data-hide="all" data-visible="false"><strong>Encargado</strong>
       				          <th data-hide="all" data-visible="false"><strong>Unidad Negocio</strong> 
     				            <th><strong>PT</strong></th>
           				      <th><strong>TIK</strong></th>
           				      <th><strong>TOTAL</strong></th>
           				                               
           				      <th><strong>Ver</strong></th>
       				        </thead>
                            
                            
								
           				    
                            
                            <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->gruposTodos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$color_estado = $control->colorEstado($fi['estado']);
								if($fi['estado'] == "HISTORIAL"){
								
							?>
                             <tr bgcolor="<?php echo $color_estado;?>">
           				      <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
           				      <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
           				      <td><?php echo strtoupper($fi['origen']);?></td>
           				      <td><?php echo strtoupper( $fi['destino']);?></td>
           				      <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
           				      <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
           				      <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
           				      <td><?php echo strtoupper( $fi['unidad_negocio']);?></td>
           				      <td><?php echo $fi['MONEDA']."$ ".number_format($fi['valor_terrestre'],0,",",".");
							   ?></td>
           				      <td><?php  echo $fi['MONEDA']."$ ".number_format($fi['valor_aereo'],0,",",".");
							   ?></td>
           				      <td><?php  echo $fi['MONEDA']."$ ".number_format(($fi['valor_terrestre']+$fi['valor_aereo']),0,",",".");
							   ?></td>
           				      <td>
                      <button type="button" class="btn-xs btn-primary" onclick="location.href='modificaciones.php?grupo=<?php echo $fi['id'];?>'">VALOR PROGRAMA</button>
                        <button type="button" class="btn-xs btn-primary" onclick="location.href='pagos.php?grupo=<?php echo $fi['id'];?>'">LIQUIDACION GRUPO</button>    
                        <button type="button" class="btn-xs btn-primary" onclick="location.href='pagosTRM.php?grupo=<?php echo $fi['id'];?>'">PAGO EN PESOS</button>        
                   </td>
           				      
       				        </tr>
           				 
                            <?php }} ?>
                               <tr>
           				      <td>TOTAL</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td><?php echo $total_insc2;?></td>
           				      <td><?php echo $total_insc;?></td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      
           				      <td><a href="insc.php?grupo=0">Ver Todos </a></td>
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
