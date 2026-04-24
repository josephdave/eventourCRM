<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}

if(isset($_REQUEST['estado'])){
	
	
		
		$mensaje=$control->actualizarEstadoSillas($_REQUEST['id'],$_REQUEST['estado']);
		
	
}

if(isset($_REQUEST['historial_id'])){
	
	
		
		$mensaje=$control->actualizarHistorialSillas($_REQUEST['historial_id']);
		
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> FECHAS CONTRATOS AEROLINEA</h3>
       				      
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
					<div class="panel-heading">CONTRATO AEROLINEA</div>
					<div class="panel-body">
           				<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      <tr>
           				      <th ><strong>NOMBRE</strong></td>
                               
           				      <th><strong>Record</strong>
           				      <th><strong>Cupos </strong>
           				      <th >Utilizados                              
           				      <th data-hide="all" data-visible="false"><strong>Destino</strong>
           				      
           				      
           				      
           				                               
                                                       	                            
                                <th><strong>Total Tiquete</strong></th>
                                                       	                               <th><strong>Politica TC</strong></th>	                               <th><strong>Vlr TC</strong></th>
                                                                                       	                              
                                                                                                                       	                               <th><strong>F Deposito</strong></th>
                                                                                                                                                       	                               <th ><strong>Deposito xPAx</strong></th>
                                                                                                                                                                                       	                               <th ><strong>F. Cambios</strong></th>	                               <th ><strong>F. Nombres</strong></th>	                               <th><strong>F. Emision</strong></th>
                                                                                                                                                                                                                       	                               <th ><strong>F. Impuestos</strong></th>
       				        </thead>
                            
                            
								
           				     <?php 
							  /////BLOQUE DE CALCULO DE FECHAS/////
							  
							  function diasDiferencia($fecha){
							  $date1 = date_create(date("d-m-Y", strtotime($fecha)));
							  if($date1 != null){
$date2 = date_create("now");

//difference between two dates
$diff = date_diff($date2,$date1);

//count days
$dias=$diff->format("%r%a");

//// FIN BLOQUE
							  }else{
								return -1;  
							  }
							  
							  return $dias;
							  }
							  
							  function colores($dias){
								if($dias < 5){
								return "#FF0000";
								}else if ($dias < 10){
								return "#FFFF00";
								}else if ($dias >= 10){
								return "#66FF00";
								}
							  }
							  ?>
                            
                            <?php 
							
							
							$resultado=$control->cuposAereosFechas();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
			//					$producto=$control->datosProducto($fi['id_grupo']);
								
								if($fi['estado']=='APROBADO'){
								
								
								
							?>
                             <tr>
                             <td><a href="detalle_aerolinea.php?id=<?php echo $fi['id'];?>"><?php echo strtoupper($fi['nombre']);?> - <?php echo strtoupper($fi['aerolinea']);?></a></td>
                             <td><?php echo strtoupper($fi['record']);?></td>
                             <td><?php echo $fi['cupos_solicitados'];?></td>
                             <td><?php 
							 
							 $usados=$control->cuposRecord($fi['id']);
							
							 
							 echo $usados;?></td>
                             <td><?php echo $fi['destino'];?></td>
                             <td><?php echo "$".$producto['MONEDA']." ". number_format(($fi['tadmin']*1.19)+$fi['neta_q']+$fi['q']+$control->impuestosRecord($fi['id']),0,',','.')?></td>
                              
           				      <td><?php echo strtoupper($fi['politica_tc']);?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['vlr_tc'],0,',','.')?></td>
                              
                             
                              
                              <td><?php echo date("d-m-Y", strtotime($fi['f_deposito']));
		$d=diasDiferencia(	$fi['f_deposito']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							 
							  
							  ?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['deposito_pax'],0,',','.')?></td>
                              <td>
                              <?php echo date("d-m-Y", strtotime($fi['f_cambios']));
							  
							  $d=diasDiferencia(	$fi['f_cambios']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							  ?></td>
                             <td> <?php echo date("d-m-Y", strtotime($fi['f_nombres']));
							  $d=diasDiferencia(	$fi['f_nombres']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}

							 ?></td>
                              <td><?php echo date("d-m-Y ", strtotime($fi['f_emision']));
							    $d=diasDiferencia(	$fi['f_emision']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							  ?></td>
                            <td>  <?php echo date("d-m-Y", strtotime($fi['f_impuestos']));
							 $d=diasDiferencia(	$fi['f_impuestos']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							?></td>
       				        </tr>
           				 
                            <?php }} ?>
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
