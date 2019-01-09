 <?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	if(isset($_REQUEST['borrar']) && $_REQUEST['borrar'] != 0){
	
	$resultado=$control->borrarRegistro($_REQUEST['borrar']);
	}
	
	
	if(isset($_REQUEST['marca']) && $_REQUEST['marca'] != 0){
	
	$resultado=$control->nombreTC($_REQUEST['marca']);
	}
	
	if($_POST["estado"] == 1){
	$resultado=$control->registrarEstado($_REQUEST['documento'],$_REQUEST['estado_viaje']);
	
	}
?>
 <script>
 
 
 String.prototype.replaceAll = function(search, replace)
{
    //if replace is not sent, return original string otherwise it will
    //replace search string with 'undefined'.
    if (replace === undefined) {
        return this.toString();
    }

    return this.replace(new RegExp('[' + search + ']', 'g'), replace);
};
		
		
		
							$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

	var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
	
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
	var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
	var table_html = table_html.replaceAll('.', '');
	//var table_html = table_html.replaceAll(',', '.');

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

	var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper2');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
	
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
	var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
	var table_html = table_html.replaceAll('.', '');
	//var table_html = table_html.replaceAll(',', '.');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">CONSOLIDADO CUENTAS GRUPOS</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 
						  $producto=$control->datosProducto($_REQUEST['grupo']);
						  
						  ?>
                          <button id="btnExport">Descargar</button>
                          <div id="table_wrapper">
                         <!--  <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="programa" data-sort-order="desc">-->
                           
                           
                           <table class="table table-hover" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0"  data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="viajeros" data-sort-order="desc" data-side-pagination="client" data-fixed-header="true" >
                           
           				    <thead>
           				      
           				      
           				      <?php 
							  	
							$totalesfinales[0]=0;
							$totalesfinales[1]=0;
							$totalesfinales[2]=0;
							$totalesfinales[3]=0;
							
							$totalesfinales[4]=0;
							
							$totalesfinales[5]=0;
							
							$totalesfinales[6]=0;
									$totalesfinales[7]=0;
							  
							  
							  if($_REQUEST['grupo'] == 0){?>
           				    <tr><?php } ?>
           				      <th data-sortable="true"data-field="viajeros" ><strong>Programa</strong></th>
           				      <th>Unidad Negocio</th>
           				      <th>Viajeros</th>
           				      <th><strong>Saldo Total por Pagar</strong></th>
           				      <th>Valor TIK</th>
           				      <th>Pagos TIK</th>
           				      <th><strong>Saldo TIK</strong></th>
           				      <th>Valor PT</th>
           				      <th>Pagos PT</th>
           				      <th><strong>Saldo PT</strong></th>
       				        </thead>
           				   
           				  
                            
                            <?php 
							
							$resulto=$control->grupos();
							while ($fd = mysql_fetch_array($resulto, MYSQL_ASSOC)) {
							if($fd['estado'] == "ACEPTADO" && $fd['unidad_negocio'] == "GRUPOS JUVENILES"){
								
								 $producto=$control->datosProducto($fd['id']);
							$facturador="";
							$aereo_base=0;
							$ModificacionesTK=0;
							$terrestre_base=0;
							$ModificacionesPT=0;
							$pagosPT=0;
							$pagosTK=0;
							$ultimafecha="";
						
							
							$gtotalviajeros=0;
							$gtotalsaldo=0;
							$gtotaltk=0;
							$gtotalpagostk=0;
							$gtotalpt=0;
							$gtotalpagospt=0;
							
							$resultado=$control->inscritosVIAJA($fd['id']);
							
						
							
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {		
							 				
							 if($facturador != $fi['facturacion_nodocumento']){
								 if($facturador != ""){
								 ?>
                                <?php 				  
							  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;
							  ?><?php
							  
							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?><?php  $gtotalpagostk+=$pagosTK; ?><?php  $gtotalpt+=$terrestre_base+$ModificacionesPT; ?> <?php  $gtotalpagospt+=$pagosPT; ?>     <?
								 }
								 
								$facturador=$fi['facturacion_nodocumento'];
								$id=$fi['id'];
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$fd['id'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$fd['id'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajero($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								$pagosPT=$pagos['pagosPT'];
							  
								$ultimafecha= $pagos['ultimafecha'];
								
								
								
								
							 }else{
								
								$aereo_base+= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK+=  $control->consultarModificaciones($fi['id'],$fd['id'],'TK');
								
								$realTK= $aereo_base+$ModificacionesTK;
								
								
								$terrestre_base+= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT+=  $control->consultarModificaciones($fi['id'],$fd['id'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
								
								
								$pagos=$control->pagosViajeroID($fi['id']);
							  
							  	$pagosTK+=$pagos['pagosTIK'];
								$pagosPT+=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								}
								 if($pagosPT>0){
								$gtotalviajeros++;		
								}
								
							 } 
							
								?>
                            <?php 				  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;?><?php 							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?><?php $gtotalpagostk+=$pagosTK; ?><?php $gtotalpt+=$terrestre_base+$ModificacionesPT; ?><?php $gtotalpagospt+=$pagosPT; ?>                             <tr>
                               <td><strong><a href="pagos.php?grupo=<?php echo $fd['id']?>"><?php echo $fd['grupo']?></a></strong></td>
                               <td><strong><?php echo $fd['unidad_negocio']?></strong></td>
                               <td><strong><?php echo $gtotalviajeros;
							   $totalesfinales[7]=$totalesfinales[7]+$gtotalviajeros;
							   ?></strong></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalsaldo,1,",",".");
							   $totalesfinales[0]+=$gtotalsaldo;
							   ?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotaltk,1,",",".");
							   
							   $totalesfinales[1]+=$gtotaltk;?>
                               </td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalpagostk,1,",",".");
							   
							   $totalesfinales[2]+=$gtotalpagostk;?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format(($gtotaltk-$gtotalpagostk),0,",",".");
							   
							   $totalesfinales[3]+=$gtotaltk-$gtotalpagostk;
							   ?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalpt,1,",",".");
							   
							   
							   $totalesfinales[4]+=$gtotalpt;
							   ?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalpagospt,1,",",".");
							   
							   
							   $totalesfinales[5]+=$gtotalpagospt;?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format(($gtotalpt-$gtotalpagospt),1,",",".");
							   $totalesfinales[6]+=$gtotalpt-$gtotalpagospt;
							   
							   ?></td>
                             </tr>
                          
                             <?php }} ?>
                               <tfoot>
                                <td><strong>TOTAL</strong></td>
                              <td>&nbsp;</td>
                              <td><strong><?php echo $totalesfinales[7];
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[0],1,",",".");
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[1],1,",",".");
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[2],1,",",".");
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[3],1,",",".");
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[4],1,",",".");
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[5],1,",",".");
							   ?></strong></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($totalesfinales[6],1,",",".");
							   ?></strong></td>
                            </tfoot>
         				    </table>
                            
                             </div>
                           <p>&nbsp;</p>
                           
                             <button id="btnExport2">Descargar</button>
                             <div id="table_wrapper2">
                           <table class="table table-hover" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0"  data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="viajeros" data-sort-order="desc" data-side-pagination="client" data-fixed-header="true" >
                             <thead>
                               <?php if($_REQUEST['grupo'] == 0){?>
                               <tr>
                                 <?php } ?>
                                 <th data-sortable="true"data-field="viajeros" ><strong>Programa</strong></th>
                                 <th>Unidad Negocio</th>
                                 <th>Viajeros</th>
                                 <th><strong>Saldo Total por Pagar</strong></th>
                                 <th>Valor TIK</th>
                                 <th>Pagos TIK</th>
                                 <th><strong>Saldo TIK</strong></th>
                                 <th>Valor PT</th>
                                 <th>Pagos PT</th>
                                 <th><strong>Saldo PT</strong></th>
                             </thead>
                             <?php 
							
							$resulto=$control->grupos();
							while ($fd = mysql_fetch_array($resulto, MYSQL_ASSOC)) {
							if($fd['estado'] == "ACEPTADO" && $fd['unidad_negocio'] != "GRUPOS JUVENILES"){
								
								 $producto=$control->datosProducto($fd['id']);
							$facturador="";
							$aereo_base=0;
							$ModificacionesTK=0;
							$terrestre_base=0;
							$ModificacionesPT=0;
							$pagosPT=0;
							$pagosTK=0;
							$ultimafecha="";
						
							
							$gtotalviajeros=0;
							$gtotalsaldo=0;
							$gtotaltk=0;
							$gtotalpagostk=0;
							$gtotalpt=0;
							$gtotalpagospt=0;
							
							$resultado=$control->inscritosVIAJA($fd['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {		
							 $gtotalviajeros++;						
							 if($facturador != $fi['facturacion_nodocumento']){
								 if($facturador != ""){
								 ?>
                             <?php 				  
							  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;
							  ?>
                             <?php
							  
							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?>
                             <?php  $gtotalpagostk+=$pagosTK; ?>
                             <?php  $gtotalpt+=$terrestre_base+$ModificacionesPT; ?>
                             <?php  $gtotalpagospt+=$pagosPT; ?>
                             <?
								 }
								$facturador=$fi['facturacion_nodocumento'];
								$id=$fi['id'];
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$fd['id'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$fd['id'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajeroID($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								$pagosPT=$pagos['pagosPT'];
							  
								$ultimafecha= $pagos['ultimafecha'];
								
								
							 }else{
								
								$aereo_base+= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK+=  $control->consultarModificaciones($fi['id'],$fd['id'],'TK');
								
								$realTK= $aereo_base+$ModificacionesTK;
								
								
								$terrestre_base+= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT+=  $control->consultarModificaciones($fi['id'],$fd['id'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
								
								
								$pagos=$control->pagosViajeroID($fi['id']);
							  
							  	$pagosTK+=$pagos['pagosTIK'];
								$pagosPT+=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								}
								
							 } ?>
                             <?php 				  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;?>
                             <?php 							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?>
                             <?php $gtotalpagostk+=$pagosTK; ?>
                             <?php $gtotalpt+=$terrestre_base+$ModificacionesPT; ?>
                             <?php $gtotalpagospt+=$pagosPT; ?>
                             <tr>
                               <td><strong><a href="pagos.php?grupo=<?php echo $fd['id']?>"><?php echo $fd['grupo']?></a></strong></td>
                               <td><strong><?php echo $fd['unidad_negocio']?></strong></td>
                               <td><strong><?php echo $gtotalviajeros;?></strong></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalsaldo,1,",",".");?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotaltk,1,",",".");?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalpagostk,1,",",".");?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format(($gtotaltk-$gtotalpagostk),0,",",".");?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalpt,1,",",".");?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format($gtotalpagospt,1,",",".");?></td>
                               <td><?php echo $producto['MONEDA']."$ ".number_format(($gtotalpt-$gtotalpagospt),1,",",".");?></td>
                             </tr>
                             <?php }} ?>
                           </table>
                           </div>
                           <p>&nbsp;</p>
                           
                          <h2><script type="text/javascript">
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
                           
                          </h2>
       				  </div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
