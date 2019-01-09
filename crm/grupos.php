<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>PROGRAMAS</h3>
       				      
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
					<div class="panel-heading">GRUPOS JUVENILES</div>
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="true"          data-sort-order="desc" class="table table-hover">
					   <thead>
					        <tr>
					          <th ><strong>Año</strong> 
				              <th><strong>Programa</strong> 
				              <th data-hide="all" data-visible="false"><strong>Origen</strong> 
			                  <th><strong>Destino</strong> 
			                  <th data-hide="all" data-visible="false">Viajeros Estimados                              
		                      <th><strong>Inscritos</strong> 
		                      <th>Salida                              
	                          <th>Regreso                              
	                          <th>Dias
                              <th><strong>Estado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Encargado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Unidad Negocio</strong> 
                              <th><strong>Viaja</strong></th>
					          <th><strong>Pendiente</strong></th>
					          <th><strong>No Viaja</strong></th>
					          <th>Asistencia</th>
					          <th><strong>Ver</strong></th>
					          <th><strong> Viajeros</strong></th>
			              </thead>
					      <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								if(strtoupper( $fi['unidad_negocio'] == 'GRUPOS JUVENILES')){
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
	<!--bgcolor="<?php echo $color_estado;?>"-->				      <tr >
					        <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
					        <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
					        <td><?php echo strtoupper($fi['origen']);?></td>
					        <td><?php echo strtoupper( $fi['destino']);?></td>
					        <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
					        <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
					        <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['f_salida']);?></td>
					        <td><?php echo strtoupper( $fi['f_llegada']);?></td>
					        <td><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
					        <td><span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
					        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
					        <td><?php echo strtoupper( $fi['unidad_negocio']);?></td>
					        <td><?php echo $control->viaja($fi['id']);
							  $total_viaja=$total_viaja+$control->viaja($fi['id']);
							   ?></td>
					        <td><?php echo $control->pendiente($fi['id']);
							  $total_pend=$total_pend+$control->pendiente($fi['id']);
							   ?></td>
					        <td><?php echo $control->noviaja($fi['id']);
							  $total_no=$total_no+$control->noviaja($fi['id']);
							  							  
							   ?></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='asistencia.php?grupo=<?php echo $fi['id'];?>'">ASISTENCIA</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='pagos.php?grupo=<?php echo $fi['id'];?>'">PAGOS</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='insc.php?grupo=<?php echo $fi['id'];?>'">VIAJEROS</button><button type="button" class="btn-xs btn-primary" onClick="location.href='constant.php?grupo=<?php echo $fi['id'];?>'">CONSTANT</button></td>
				          </tr>
					      <?php } }?>
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
					        <td>&nbsp;</td>
					        <td><?php echo $total_viaja;?></td>
					        <td><?php echo $total_pend;?></td>
					        <td><?php echo $total_no;?></td>
					        <td>&nbsp;</td>
					        <td><a href="insc.php?grupo=0">Ver Todos </a></td>
                            <td>&nbsp;</td>
				          </tr>
				        </table>					      <a href="insc.php?grupo=0"></a></td>
                        					    </tr>
					  </table>
					</div>
                                                        </div>
                        <div class="panel panel-default">
					<div class="panel-heading">EVENTOS ESPECIALES Y DEPORTIVOS</div>
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="true"          data-sort-order="desc" class="table table-hover">
					 
					      <thead>
					        <tr>
					          <th ><strong>Año</strong> 
				              <th><strong>Programa</strong> 
				              <th data-visible="false"><strong>Origen</strong> 
			                  <th><strong>Destino</strong> 
			                  <th data-hide="all" data-visible="false">Viajeros Estimados                              
		                      <th><strong>Inscritos</strong> 
		                      <th>Salida                              
	                          <th>Regreso                              
	                          <th>Dias
                              <th><strong>Estado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Encargado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Unidad Negocio</strong> 
                              <th><strong>Viaja</strong></th>
					          <th><strong>Pendiente</strong></th>
					          <th><strong>No Viaja</strong></th>
					          <th><strong>Asistencia</strong></th>
                               <th><strong>Ver</strong></th>
					          <th><strong> Viajeros</strong></th>
			              </thead>
					      <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								if(strtoupper( $fi['unidad_negocio'] == 'EVENTOS DEPORTIVOS') || strtoupper( $fi['unidad_negocio'] == 'EVENTOS ESPECIALES')){
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
	<!--bgcolor="<?php echo $color_estado;?>"-->				      <tr >
					        <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
					        <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
					        <td><?php echo strtoupper($fi['origen']);?></td>
					        <td><?php echo strtoupper( $fi['destino']);?></td>
					        <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
					        <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
					        <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['f_salida']);?></td>
					        <td><?php echo strtoupper( $fi['f_llegada']);?></td>
					        <td><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
					        <td><span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
					        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
					        <td><?php echo strtoupper( $fi['unidad_negocio']);?></td>
					        <td><?php echo $control->viaja($fi['id']);
							  $total_viaja=$total_viaja+$control->viaja($fi['id']);
							   ?></td>
					        <td><?php echo $control->pendiente($fi['id']);
							  $total_pend=$total_pend+$control->pendiente($fi['id']);
							   ?></td>
					        <td><?php echo $control->noviaja($fi['id']);
							  $total_no=$total_no+$control->noviaja($fi['id']);
							  							  
							   ?></td>
                               
                                <td><button type="button" class="btn-xs btn-primary" onClick="location.href='asistencia.php?grupo=<?php echo $fi['id'];?>'">ASISTENCIA</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='pagos.php?grupo=<?php echo $fi['id'];?>'">PAGOS</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='insc.php?grupo=<?php echo $fi['id'];?>'">VIAJEROS</button><button type="button" class="btn-xs btn-primary" onClick="location.href='constant.php?grupo=<?php echo $fi['id'];?>'">CONSTANT</button></td>
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
					        <td>&nbsp;</td>
					        <td><?php echo $total_viaja;?></td>
					        <td><?php echo $total_pend;?></td>
					        <td><?php echo $total_no;?></td>
					        <td><a href="insc.php?grupo=0">Ver Todos </a></td>
                            <td>&nbsp;</td>
				          </tr>
				        </table>					      <a href="insc.php?grupo=0"></a></td>
                        					    </tr>
					  </table>
					</div>
                                                        </div>                                                            </div>

<div class="panel panel-default">
					<div class="panel-heading">RECEPTIVOS</div>
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="true"          data-sort-order="desc" class="table table-hover">
					 
					      <thead>
					        <tr>
					          <th ><strong>Año</strong> 
				              <th><strong>Programa</strong> 
				              <th data-visible="false"><strong>Origen</strong> 
			                  <th><strong>Destino</strong> 
			                  <th data-hide="all" data-visible="false">Viajeros Estimados                              
		                      <th><strong>Inscritos</strong> 
		                      <th>Salida                              
	                          <th>Regreso                              
	                          <th>Dias
                              <th><strong>Estado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Encargado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Unidad Negocio</strong> 
                              <th><strong>Viaja</strong></th>
					          <th><strong>Pendiente</strong></th>
					          <th><strong>No Viaja</strong></th>
					          <th><strong>Asistencia</strong></th>
                               <th><strong>Ver</strong></th>
					          <th><strong> Viajeros</strong></th>
			              </thead>
					      <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								if(strtoupper( $fi['unidad_negocio'] == 'RECEPTIVOS')){
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
	<!--bgcolor="<?php echo $color_estado;?>"-->				      <tr >
					        <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
					        <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
					        <td><?php echo strtoupper($fi['origen']);?></td>
					        <td><?php echo strtoupper( $fi['destino']);?></td>
					        <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
					        <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
					        <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['f_salida']);?></td>
					        <td><?php echo strtoupper( $fi['f_llegada']);?></td>
					        <td><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
					        <td><span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
					        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
					        <td><?php echo strtoupper( $fi['unidad_negocio']);?></td>
					        <td><?php echo $control->viaja($fi['id']);
							  $total_viaja=$total_viaja+$control->viaja($fi['id']);
							   ?></td>
					        <td><?php echo $control->pendiente($fi['id']);
							  $total_pend=$total_pend+$control->pendiente($fi['id']);
							   ?></td>
					        <td><?php echo $control->noviaja($fi['id']);
							  $total_no=$total_no+$control->noviaja($fi['id']);
							  							  
							   ?></td>
                               
                                <td><button type="button" class="btn-xs btn-primary" onClick="location.href='asistencia.php?grupo=<?php echo $fi['id'];?>'">ASISTENCIA</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='pagos.php?grupo=<?php echo $fi['id'];?>'">PAGOS</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='insc.php?grupo=<?php echo $fi['id'];?>'">VIAJEROS</button><button type="button" class="btn-xs btn-primary" onClick="location.href='constant.php?grupo=<?php echo $fi['id'];?>'">CONSTANT</button></td>
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
					        <td>&nbsp;</td>
					        <td><?php echo $total_viaja;?></td>
					        <td><?php echo $total_pend;?></td>
					        <td><?php echo $total_no;?></td>
					        <td><a href="insc.php?grupo=0">Ver Todos </a></td>
                            <td>&nbsp;</td>
				          </tr>
				        </table>					      <a href="insc.php?grupo=0"></a></td>
                        					    </tr>
					  </table>
					</div>
                                                        </div>                                                            </div>

       <div class="panel panel-default">
					<div class="panel-heading">VACACIONALES</div>
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="true"          data-sort-order="desc" class="table table-hover">
					 
					      <thead>
					        <tr>
					          <th ><strong>Año</strong> 
				              <th><strong>Programa</strong> 
				              <th data-visible="false"><strong>Origen</strong> 
			                  <th><strong>Destino</strong> 
			                  <th data-hide="all" data-visible="false">Viajeros Estimados                              
		                      <th><strong>Inscritos</strong> 
		                      <th>Salida                              
	                          <th>Regreso                              
	                          <th>Dias
                              <th><strong>Estado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Encargado</strong> 
                              <th data-hide="all" data-visible="false"><strong>Unidad Negocio</strong> 
                              <th><strong>Viaja</strong></th>
					          <th><strong>Pendiente</strong></th>
					          <th><strong>No Viaja</strong></th>
					          <th><strong>Asistencia</strong></th>
                               <th><strong>Ver</strong></th>
					          <th><strong> Viajeros</strong></th>
			              </thead>
					      <?php 
							$total_insc=0;
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								if(strtoupper( $fi['unidad_negocio'] == 'VACACIONALES')){
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
	<!--bgcolor="<?php echo $color_estado;?>"-->				      <tr >
					        <td><?php echo date("Y", strtotime($fi['f_salida']));?></td>
					        <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
					        <td><?php echo strtoupper($fi['origen']);?></td>
					        <td><?php echo strtoupper( $fi['destino']);?></td>
					        <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
					        <td><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
					        <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['f_salida']);?></td>
					        <td><?php echo strtoupper( $fi['f_llegada']);?></td>
					        <td><?php echo $dias; ?> dias - <?php echo $dias-1; ?> noches</td>
					        <td><span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
					        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
					        <td><?php echo strtoupper( $fi['unidad_negocio']);?></td>
					        <td><?php echo $control->viaja($fi['id']);
							  $total_viaja=$total_viaja+$control->viaja($fi['id']);
							   ?></td>
					        <td><?php echo $control->pendiente($fi['id']);
							  $total_pend=$total_pend+$control->pendiente($fi['id']);
							   ?></td>
					        <td><?php echo $control->noviaja($fi['id']);
							  $total_no=$total_no+$control->noviaja($fi['id']);
							  							  
							   ?></td>
                               
                                <td><button type="button" class="btn-xs btn-primary" onClick="location.href='asistencia.php?grupo=<?php echo $fi['id'];?>'">ASISTENCIA</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='pagos.php?grupo=<?php echo $fi['id'];?>'">PAGOS</button></td>
					        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='insc.php?grupo=<?php echo $fi['id'];?>'">VIAJEROS</button><button type="button" class="btn-xs btn-primary" onClick="location.href='constant.php?grupo=<?php echo $fi['id'];?>'">CONSTANT</button></td>
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
					        <td>&nbsp;</td>
					        <td><?php echo $total_viaja;?></td>
					        <td><?php echo $total_pend;?></td>
					        <td><?php echo $total_no;?></td>
					        <td><a href="insc.php?grupo=0">Ver Todos </a></td>
                            <td>&nbsp;</td>
				          </tr>
				        </table>					      <a href="insc.php?grupo=0"></a></td>
                        					    </tr>
					  </table>
					</div>
                                                        </div>                                                            </div>
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
