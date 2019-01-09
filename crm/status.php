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
  $("#btnExport").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

	//var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
  
  $("#btnExport2").click(function(e) {
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
    var table_div = document.getElementById('table_wrapper2');
	
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
    <div class="panel-heading">GRUPOS JUVENILES 2019</div>
    <div class="panel-body">
      <div class="module-body">
        <button id="btnExport3">Descargar</button>
        <div id="table_wrapper3">
          <table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover table-fixed">
            <thead>
              <tr>
                <th width="150"><strong>Grupo</strong>
                  </td>
                <th><strong>Status</strong> 
                <th><strong>Origen</strong>
                  </td>
                <th><strong>Destino</strong>
                  </td>
                <th width="100">Salida                              
                <th width="100">Regreso                              
                <th>Potencial                              
                <th>Inscritos                              
                <th>Con Pago
                  <!-- <th>Con Pago No Viaja</th>-->
                <th>                  Sin Pago</th>
                <th>Viajeros                
                <th>% Inscritos <br>
                  con pago
                <th>%Viajeros <br>
                  vs <br>
                  potencial
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
							
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']!="RECHAZADO"  && date("Y",strtotime($fi['f_salida'])) >= 2019){						
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
              <td style="text-align: center"><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
              <td style="text-align: center"><?php echo $control->cantGrupo($fi['id']);
							  $total_insc_viaja=$total_insc_viaja+$control->cantGrupoViaja($fi['id']);?></td>
              <td style="text-align: center"><?php echo $control->viajeroConPago($fi['id']);
							  $total_conpago=$total_conpago+$control->viajeroConPago($fi['id']);?></td>
              <!--<td style="text-align: center"><?php echo $control->viajeroConPagoNo($fi['id']);
							  $total_conpago_no=$total_conpago_no+$control->viajeroConPagoNo($fi['id']);?></td>-->
              <td style="text-align: center"><?php echo $control->cantGrupo($fi['id'])-$control->viajeroConPago($fi['id']); ?></td>
              <td style="text-align: center"><?php echo $control->cantGrupoViaja($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
              <td style="text-align: center"><?php 
							  $v= $control->cantGrupo($fi['id']);
							  if($v > 0){echo round(($control->viajeroConPago($fi['id'])/$control->cantGrupo($fi['id']))*100,0)."%";}else{echo "0%";} ?></td>
              <td style="text-align: center"><?php 
							   if($fi['cant_viajeros'] != 0){
							echo round(($control->cantGrupoViaja($fi['id'])/$fi['cant_viajeros'])*100,0)."%"; }?></td>
            </tr>
            <?php }} }?>
            <tfoot>
              <tr>
                <td>TOTAL</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align: center"><?php echo $total_insc2;?></td>
                <td style="text-align: center"><?php echo $total_insc;?></td>
                <td style="text-align: center"><?php echo $total_conpago;?></td>
                <td style="text-align: center"><?php echo $total_conpago_no;?></td>
                <td style="text-align: center"><?php echo $total_insc_viaja;?></td>
                <td style="text-align: center"><?php echo $total_insc-$total_conpago;?></td>
                <td style="text-align: center"><?php 
							  							  echo round(($total_conpago/$total_insc)*100,0)."%";?></td>
                <td style="text-align: center"><?php 
							  							  echo round(($total_insc/$total_insc2)*100,0)."%";?></td>
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
  <div class="panel panel-default">
    <div class="panel-heading">GRUPOS JUVENILES 2018</div>
    <div class="panel-body">
      <div class="module-body">
        <button id="btnExport">Descargar</button>
        <div id="table_wrapper">
          <table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover table-fixed">
            <thead>
              <tr>
                <th width="150px"><strong>Grupo</strong>
                  </td>
                <th><strong>Status</strong>
                <th><strong>Origen</strong>
                  </td>
                <th><strong>Destino</strong>
                  </td>
                <th width="100px">Salida                              
                <th width="100px">Regreso                              
                <th>Potencial                              
                <th>Inscritos                              
                <th>Viajeros                              
                <th>Viajeros Pago
                  <!-- <th>Con Pago No Viaja</th>-->
                <th>Viajeros <br>
                  Sin Pago</th>
                <th>% Inscritos <br>
                  con pago
                <th>%Viajeros <br>
                  vs <br>
                  potencial
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
							
							$resultado=$control->gruposTodos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']!="RECHAZADO"  && date("Y",strtotime($fi['f_salida'])) == 2018){						
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
            <tr>
              <td><a href="producto.php?grupo=<?php echo $fi['id']?>"><?php echo strtoupper($fi['grupo']);?></a></td>
    
				<td><?php 
	
	echo strtoupper( $fi['estado']);?></td>
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
              <td style="text-align: center"><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
              <td style="text-align: center"><?php echo $control->cantGrupo($fi['id']);
							  $total_insc_viaja=$total_insc_viaja+$control->cantGrupoViaja($fi['id']);?></td>
              <td style="text-align: center"><?php echo $control->cantGrupoViaja($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
              <td style="text-align: center"><?php echo $control->viajeroConPago($fi['id']);
							  $total_conpago=$total_conpago+$control->viajeroConPago($fi['id']);?></td>
              <!--<td style="text-align: center"><?php echo $control->viajeroConPagoNo($fi['id']);
							  $total_conpago_no=$total_conpago_no+$control->viajeroConPagoNo($fi['id']);?></td>-->
              <td style="text-align: center"><?php echo $control->cantGrupoViaja($fi['id'])-$control->viajeroConPago($fi['id']); ?></td>
              <td style="text-align: center"><?php 
							  $v= $control->cantGrupo($fi['id']);
							  if($v > 0){echo round(($control->viajeroConPago($fi['id'])/$control->cantGrupo($fi['id']))*100,0)."%";}else{echo "0%";} ?></td>
              <td style="text-align: center"><?php 
							   if($fi['cant_viajeros'] != 0){
							echo round(($control->cantGrupoViaja($fi['id'])/$fi['cant_viajeros'])*100,0)."%"; }?></td>
            </tr>
            <?php }} }?>
            <tr>            
            <tfoot>
              <tr>
                <td>TOTAL</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align: center"><?php echo $total_insc2;?></td>
                <td style="text-align: center"><?php echo $total_insc;?></td>
                <td style="text-align: center"><?php echo $total_insc_viaja;?></td>
                <td style="text-align: center"><?php echo $total_conpago;?></td>
                <td style="text-align: center"><?php echo $total_conpago_no;?></td>
                <td style="text-align: center"><?php echo $total_insc-$total_conpago;?></td>
                <td style="text-align: center"><?php 
							  							  echo round(($total_conpago/$total_insc)*100,0)."%";?></td>
                <td style="text-align: center"><?php 
							  							  echo round(($total_insc/$total_insc2)*100,0)."%";?></td>
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
  <div class="panel panel-default">
    <div class="panel-heading">GRUPOS DEPORTIVOS Y ESPECIALES</div>
    <div class="panel-body">
      <div class="module-body">
        <button id="btnExport2">Descargar</button>
        <div id="table_wrapper2">
          <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover table-fixed">
            <thead>
              <tr>
                <th width="150px"><strong>Grupo</strong>
                  </td>
                <th><strong>Status</strong> 
                <th><strong>Origen</strong>
                  </td>
                <th><strong>Destino</strong>
                  </td>
                <th width="100px">Salida                              
                <th width="100px">Regreso                              
                <th>Potencial                              
                <th>Inscritos                              
                <th>Viajeros                              
                <th>Viajeros Pago
                  <!-- <th>Con Pago No Viaja</th>-->
                <th>Viajeros <br>
                  Sin Pago</th>
                <th>% Inscritos <br>
                  con pago
                <th>%Viajeros <br>
                  vs <br>
                  potencial
            </thead>
            <?php 
							$total_insc=0;
							$total_conpago=0;
							$total_conpago_no=0;
							
							$total_insc2=0;
							$total_viaja=0;
							$total_pend=0;
							$total_no=0;
							
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) != "GRUPOS JUVENILES"){		

if($fi['estado']!="RECHAZADO"){						
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
              <td style="text-align: center"><?php echo $fi['cant_viajeros'];
							  $total_insc2=$total_insc2+$fi['cant_viajeros'];?></td>
              <td style="text-align: center"><?php echo $control->cantGrupo($fi['id']);
							  $total_insc_viaja=$total_insc_viaja+$control->cantGrupoViaja($fi['id']);?></td>
              <td style="text-align: center"><?php echo $control->cantGrupoViaja($fi['id']);
							  $total_insc=$total_insc+$control->cantGrupo($fi['id']);?></td>
              <td style="text-align: center"><?php echo $control->viajeroConPago($fi['id']);
							  $total_conpago=$total_conpago+$control->viajeroConPago($fi['id']);?></td>
              <!--<td style="text-align: center"><?php echo $control->viajeroConPagoNo($fi['id']);
							  $total_conpago_no=$total_conpago_no+$control->viajeroConPagoNo($fi['id']);?></td>-->
              <td style="text-align: center"><?php echo $control->cantGrupoViaja($fi['id'])-$control->viajeroConPago($fi['id']); ?></td>
              <td style="text-align: center"><?php 
							  $v= $control->cantGrupo($fi['id']);
							  if($v > 0){echo round(($control->viajeroConPago($fi['id'])/$control->cantGrupo($fi['id']))*100,0)."%";}else{echo "0%";} ?></td>
              <td style="text-align: center"><?php 
							   if($fi['cant_viajeros'] != 0){
							echo round(($control->cantGrupoViaja($fi['id'])/$fi['cant_viajeros'])*100,0)."%"; }?></td>
            </tr>
            <?php }} }?>
            <tr>
            <tfoot>
              <tr>
                <td>TOTAL</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align: center"><?php echo $total_insc2;?></td>
                <td style="text-align: center"><?php echo $total_insc;?></td>
                <td style="text-align: center"><?php echo $total_insc_viaja;?></td>
                <td style="text-align: center"><?php echo $total_conpago;?></td>
                <td style="text-align: center"><?php echo $total_conpago_no;?></td>
                <td style="text-align: center"><?php echo $total_insc-$total_conpago;?></td>
                <td style="text-align: center"><?php 
							  							  echo round(($total_conpago/$total_insc)*100,0)."%";?></td>
                <td style="text-align: center"><?php 
							  							  echo round(($total_insc/$total_insc2)*100,0)."%";?></td>
            </tfoot>
              </tr>
            
          </table>
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
      <p>&nbsp;</p>
    </div>
  </div>
</div>
</div>
                        </div>
    </body>
