<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

<script>
							$(document).ready(function() {
  $("#btnExport3").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

//	var toolbar= document.getElementsByClassName("fixed-table-toolbar2");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper3');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });

});
							</script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
  <div class="panel panel-default">
    <div class="panel-heading">REPORTE MARGEN</div>
    <div class="panel-body">
      <div class="module-body">
        <button id="btnExport3">Descargar</button>
        <div id="table_wrapper3">
          <table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover table-fixed">
            <thead>
              <tr>
                <th width="150"><strong>Grupo</strong>
                  </td>
                <th><strong>Destino</strong>
                  </td>
                <th width="100">Año                              
                <th>Viajeros                              
                
                <th>Costo Total<!-- <th>Con Pago No Viaja</th>-->
                <th> Precio de Venta               </th>
                <th>TK                
                <th>PT                
                <th>Utilidad                
                <th>Margen
            </thead>
            <?php 
							$total_insc=0;
							$total_conpago=0;
							$total_conpago_no=0;
							
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
		  $total_insc_viaja=0;
							
							$resultado=$control->gruposAnio(2020);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		
if(true){		

if($fi['estado']!="RECHAZADO"  && date("Y",strtotime($fi['f_salida'])) >= 2019){						
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
            <tr>
              <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
              <td><?php $de=explode("–",$fi['destino']);							  echo strtoupper($de[0]);?></td>
              <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo  date("Y", strtotime($fi['f_salida']));?></td>
              <td style="text-align: center"><?php echo $control->cantGrupoViaja($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupoViaja($fi['id']);?></td>
            
              <td style="text-align: right;"><?php $ctotalGrupo=$control->costoTotalGrupo($fi['id'])['totalFacturado'];
	$total_ctotalGrupo_global +=$ctotalGrupo;
	echo number_format($ctotalGrupo);
							  $total_ctotalGrupo=$total_ctotalGrupo+$ctotalGrupo;
				  ?></td>
              <!--<td style="text-align: center"><?php echo $control->viajeroConPagoNo($fi['id']);
							  $total_conpago_no=$total_conpago_no+$control->viajeroConPagoNo($fi['id']);?></td>-->
              <td style="text-align: center"><?php 
									
								$prospecto=$control->datosProducto($fi['id']);	
                           	//	$prospecto['id']=$fi['id'];
									
									$totalTeoricoTK=0;
									$totalTeoricoPT=0;
									$valorMpt= $control->consultarModificacionesGrupo($prospecto['id'],'PT');
								//	var_dump($valorMpt);
									$valorMtk= $control->consultarModificacionesGrupo($prospecto['id'],'TK');
								//	var_dump($valorMtk);
									
									$totalTeoricoTK+=$valorMtk;
									$totalTeoricoPT+=$valorMpt;
										
									$totalTeoricoPT +=  ($prospecto['valor_terrestre']*$control->viajerosTarifa($prospecto['nombre_tarifa1'],$prospecto['id'])); 
									
									$totalTeoricoTK +=  ($prospecto['valor_aereo']*$control->viajerosTarifa($prospecto['nombre_tarifa1'],$prospecto['id'])); 
									
									
									//var_dump($totalTeoricoPT+$totalTeoricoTK);
									
									for($d = 2; $d<=10;$d++){
							
									if($prospecto['nombre_tarifa'.$d] != ""){
									
									$totalTeoricoPT +=  ($prospecto['valor_terrestre_tarifa'.$d]*$control->viajerosTarifa($prospecto['nombre_tarifa'.$d],$prospecto['id'])); 
									
									$totalTeoricoTK +=  ($prospecto['valor_aereo_tarifa'.$d]*$control->viajerosTarifa($prospecto['nombre_tarifa'.$d],$prospecto['id'])); 
										
										//var_dump($totalTeoricoPT+$totalTeoricoTK);
									
									}
									}
									
									echo number_format($totalTeoricoPT+$totalTeoricoTK);
	
									$pventatotal=$totalTeoricoPT+$totalTeoricoTK;
	$pventatotal_general+=$pventatotal;
									
									?></td>
              <td style="text-align: center"><?php echo number_format($totalTeoricoTK);?></td>
              <td style="text-align: center"><?php echo number_format($totalTeoricoPT);?></td>
              <td style="text-align: center"><?php  $utilidad=$pventatotal-$total_ctotalGrupo;
	echo number_format($utilidad);
				 
				  ?></td>
              <td style="text-align: center"><?php 
						
						$porc = number_format(($utilidad/$pventatotal)*100);
	echo $porc."%";
	 $pventatotal=0;
	$total_ctotalGrupo=0;
				
				  ?></td>
            </tr>
            <?php }} } }?>
            <tfoot>
              <tr>
                <td>TOTAL</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align: left"><?php echo $total_insc;?></td>
            
                <td style="text-align: left"><?php echo number_format($total_ctotalGrupo_global);?></td>
                <td style="text-align: left"><?php echo  number_format($pventatotal_general);?></td>
                <td style="text-align: left">&nbsp;</td>
                <td style="text-align: left">&nbsp;</td>
                <td style="text-align: left"><?php echo  number_format($pventatotal_general-$total_ctotalGrupo_global);?></td>
                <td style="text-align: left"><?php echo number_format((($pventatotal_general-$total_ctotalGrupo_global)/$pventatotal_general)*100);?>%</td>
            </tfoot>
            </tr>
            
          </table>
        </div>
        <p>&nbsp;</p>
        <!--<p><strong>RECHAZADOS</strong></p>
<table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      <tr>
           				        <th width="150px"><strong>Grupo</strong> 
       				            <th><strong>Status</strong> 
       				            <th><strong>Origen</strong> 
   				                <th><strong>Destino</strong> 
   				                <th width="100px">Salida                              
			                    <th width="100px">Regreso                              
			                    <th> Estimados                              
		                        <th>Inscritos                              
		                        <th>Con Pago                              
	                            <th>Sin Pago
	                            <th>% Inscritos con pago
                                <th>%insc vs potencial
          </thead>
           				    <?php 
							$total_insc=0;
							$total_conpago=0;
							
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']=="RECHAZADO"){						
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
           				    <tr>
           				      <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
           				      <td><?php echo strtoupper( $fi['estado']);?></td>
           				      <td><?php 
							  
$or=explode("-",$fi['origen']);							  echo strtoupper($or[0]);?></td>
           				      <td><?php $de=explode("–",$fi['destino']);							  echo strtoupper($de[0]);?></td>
           				      <td><?php 
							  
							  $salida = new DateTime($producto['f_salida']);
					$llegada = new DateTime($fi['f_llegada']);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['f_salida']);?></td>
           				      <td><?php echo strtoupper( $fi['f_llegada']);?></td>
           				      <td><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
           				      <td style="text-align: center"><?php echo $control->cantGrupo($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
           				      <td style="text-align: center"><?php echo $control->viajeroConPago($fi['id']);
							  $total_conpago=$total_conpago+$control->viajeroConPago($fi['id']);?></td>
           				      <td style="text-align: center"><?php echo $control->cantGrupo($fi['id'])-$control->viajeroConPago($fi['id']); ?></td>
           				      <td style="text-align: center"><?php 
							  $v= $control->cantGrupo($fi['id']);
							  if($v > 0){echo round(($control->viajeroConPago($fi['id'])/$control->cantGrupo($fi['id']))*100,0)."%";}else{echo "%0";} ?></td>
           				      <td style="text-align: center"><?php 
							echo round(($control->cantGrupo($fi['id'])/$fi['cant_viajeros'])*100,0)."%"; ?></td>
       				        </tr>
           				    <?php }} }?>
           				    <tr>
           				      <td>TOTAL</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td><?php echo $total_insc2;?></td>
           				      <td style="text-align: center"><?php echo $total_insc;?></td>
           				      <td style="text-align: center"><?php echo $total_conpago;?></td>
           				      <td style="text-align: center"><?php echo $total_insc-$total_conpago;?></td>
           				      <td style="text-align: center">0</td>
           				      <td style="text-align: center"><?php 
							  							  echo "%".round(($total_insc/$total_insc2)*100,0);?></td>
       				        </tr>
         				    </table>-->
        <p>
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
  <p>&nbsp;</p>
</div>
</div>
                        </div>
    </body>
