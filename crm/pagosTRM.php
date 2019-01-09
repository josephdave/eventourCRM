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
					<div class="panel-heading">ESTADO DE CUENTA GRUPO <a href="pagosv2.php?grupo=<?php echo $_REQUEST['grupo'] ?>">(ver 1 a 1)</a></div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 
						  $producto=$control->datosProducto($_REQUEST['grupo']);
						  
						  ?>
                          <button id="btnExport">Descargar</button>
                          <div id="table_wrapper">
                         <!--  <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="programa" data-sort-order="desc">-->
                           
                          
                          
                           <table class="table table-hover table-fixed" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0"  data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="viajeros" data-sort-order="asc" data-side-pagination="client" data-fixed-header="true" >
                           
           				    <thead>
           				      
           				      
           				      <?php if($_REQUEST['grupo'] == 0){?>
           				    <tr><?php } ?>
           				      <th data-sortable="true"data-field="viajeros" ><strong>Viajero(s)</strong></th>
           				      <th>No Documento Tercero</th>
							  <th>Tercero</th>
           				      <th>Ultima Fecha de Pago</th>
           				      <th>Pagos PESOS TIK</th>
           				      <th>Pagos PESOS PT</th>
           				      <th>TOTAL Pagos</th>
       				         </thead>
           				   
           				  
                            
                            <?php 
							
							$facturador="";
							$facturador_nombre="";
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
							$totalconpago=0;
							$gtotalpagospt=0;
							
							$resultado=$control->inscritosVIAJA($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {		
							  $viajacon=1;	
							 $gtotalviajeros++;						
							 if($facturador != $fi['facturacion_nodocumento'] || $producto['unidad_negocio']== "GRUPOS JUVENILES"){
								 if($facturador != ""){
								 ?>
                                  <tr>
                                 <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $viajero; echo "(".(substr_count ($viajero,"-")+1).")"; ?></a></td>
                                 
           				      <td><?php echo $facturador ?></td>
							  <td><?php echo $facturador_nombre ?></td>
           				      <td><?php echo $ultimafecha;
							  if($ultimafecha != ""){
							  $totalconpago=$totalconpago+substr_count ($viajero,"-")+1;
							  } ?></td>
           				      <td><?php echo  "$ ".number_format($pagosTK,1,",","."); $gtotalpagostk+=$pagosTK; ?></td>
           				      <td><?php echo "$ ".number_format($pagosPT,1,",","."); $gtotalpagospt+=$pagosPT; ?></td>
           				      <td><?php echo "$ ".number_format($pagosPT+$pagosTK,1,",","."); ?></td>
			                 </tr>
                                 <?
								 }
								$facturador=$fi['facturacion_nodocumento'];
								$facturador_nombre=$fi['facturacion_nombre'];
								
								$id=$fi['id'];
								if($fi['control'] != ""){$tktc= "si";}else{
									$tktc= "";
								}
								
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajeroTRM($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								$pagosPT=$pagos['pagosPT'];
							  
								$ultimafecha= $pagos['ultimafecha'];
								$viajacon++;
								
								
							 }else{
								
								$aereo_base+= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK+=  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
								
								$realTK= $aereo_base+$ModificacionesTK;
								
								
								$terrestre_base+= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT+=  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
								
								
								$pagos=$control->pagosViajeroTRM($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								$pagosPT=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								$viajacon=$viajacon+1;
								}
								
							 } ?>
                             <tr>
                                 <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $viajero; echo "(".(substr_count ($viajero,"-")+1).")";?></a></td>
           				      <td><?php echo $facturador ?></td>
							  <td><?php echo $facturador_nombre ?></td>
           				      <td><?php echo $ultimafecha;
							  if($ultimafecha != ""){
							  $totalconpago=$totalconpago+substr_count ($viajero,"-")+1;
							  }
							   ?></td>
           				      <td><?php echo "$ ".number_format($pagosTK,1,",","."); $gtotalpagostk+=$pagosTK; ?></td>
           				      <td><?php echo"$ ".number_format($pagosPT,1,",","."); $gtotalpagospt+=$pagosPT; ?></td>
           				      <td><?php echo "$ ".number_format($pagosPT+$pagosTK,1,",","."); ?></td>
       				         </tr>
                             <tfoot>
                                 <tr>
                               <td><strong>TOTAL</strong></td>
                               <td><strong><?php echo $gtotalviajeros;?></strong></td>
							   <td><strong>&nbsp;</strong></td>
                               <td><strong><?php echo $totalconpago;?></strong></td>
                               <td><strong><?php echo "$ ".number_format($gtotalpagostk,1,",",".");?></strong></td>
                               <td><strong><?php echo "$ ".number_format($gtotalpagospt,1,",",".");?></strong></td>
                               <td><strong><?php echo "$ ".number_format($gtotalpagospt+$gtotalpagostk,1,",",".");?></strong></td>
                             </tfoot>
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
                             <?php 
						 $noviaja=0;
						 
						 $resultado=$control->inscritosNOVIAJA($_REQUEST['grupo']);
						 while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {		
							 $noviaja++;	
							 
							 }
							 
							 if($noviaja > 0){
						 ?> 
                         <!-- 
                         <h2> NO VIAJAN</h2>
                          <table class="table table-hover table-fixed" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0"  data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="viajeros" data-sort-order="asc" data-side-pagination="client" data-fixed-header="true" >
                            <thead>
                              <?php if($_REQUEST['grupo'] == 0){?>
                              <tr>
                                <?php } ?>
                                <th data-sortable="true"data-field="viajeros" ><strong>Viajero(s)</strong></th>
                                <th>No Documento Cliente</th>
                                <th>Ultima Fecha de Pago</th>
                                <th><strong>Saldo Total por Pagar</strong></th>
                                <th>Valor TIK</th>
                                <th>Pagos TIK</th>
                                <th><strong>Saldo TIK</strong></th>
                                <th>Valor PT</th>
                                <th>Pagos PT</th>
                                <th><strong>Saldo PT</strong></th>
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
						
							
							$gtotalviajeros=0;
							$gtotalsaldo=0;
							$gtotaltk=0;
							$gtotalpagostk=0;
							$gtotalpt=0;
							$gtotalpagospt=0;
							$viajero="";
							
							$resultado=$control->inscritosNOVIAJA($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {	
							 $viajacon=1;	
							 $gtotalviajeros++;						
						 	 if($facturador != $fi['facturacion_nodocumento'] || $producto['unidad_negocio']=="GRUPOS JUVENILES"){
								 if($facturador != ""){
								 ?>
                            <tr>
                              <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $viajero ?></a></td>
                              <td><?php echo $facturador ?></td>
                              <td><?php echo $ultimafecha ?></td>
                              <td><strong><?php echo "$ ".number_format(($aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK),1,",",".");
							  
							  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;
							  ?></strong></td>
                              <td><?php
							  
							   echo "$ ".number_format($aereo_base+$ModificacionesTK,1,",","."); 
							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?></td>
                              <td><?php echo  "$ ".number_format($pagosTK,1,",","."); $gtotalpagostk+=$pagosTK; ?></td>
                              <td><strong><?php echo "$ ".number_format($aereo_base+$ModificacionesTK-$pagosTK,1,",","."); ?></strong></td>
                              <td><?php echo "$ ".number_format($terrestre_base+$ModificacionesPT,1,",","."); $gtotalpt+=$terrestre_base+$ModificacionesPT; ?></td>
                              <td><?php echo "$ ".number_format($pagosPT,1,",","."); $gtotalpagospt+=$pagosPT; ?></td>
                              <td><strong><?php echo "$ ".number_format($terrestre_base+$ModificacionesPT-$pagosPT,1,",",".")?></strong></td>
                            </tr>
                            <?
								 }
								$facturador=$fi['facturacion_nodocumento'];
								$id=$fi['id'];
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajeroTRM($fi['id']);
							  
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
								
								
								$pagos=$control->pagosViajeroTRM($fi['id']);
							  
							  	$pagosTK+=$pagos['pagosTIK'];
								$pagosPT+=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								$viajacon++;
								}
								
							 } ?>
                            <tr>
                              <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $viajero ?></a></td>
                              <td><?php echo $facturador ?></td>
                              <td><?php echo $ultimafecha;
							  if($ultimafecha != ""){
							  $totalconpago=$totalconpago+$viajacon;
							  }?></td>
                              <td><strong><?php echo "$ ".number_format(($aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK),1,",",".");
							  $gtotalsaldo+=$aereo_base+$ModificacionesTK+$terrestre_base+$ModificacionesPT-$pagosPT-$pagosTK;?></strong></td>
                              <td><?php echo "$ ".number_format($aereo_base+$ModificacionesTK,0,",",".");
							   $gtotaltk+=$aereo_base+$ModificacionesTK;  ?></td>
                              <td><?php echo "$ ".number_format($pagosTK,1,",","."); $gtotalpagostk+=$pagosTK; ?></td>
                              <td><strong><?php echo "$ ".number_format($aereo_base+$ModificacionesTK-$pagosTK,0,",",".") ?></strong></td>
                              <td><?php echo "$ ".number_format($terrestre_base+$ModificacionesPT,0,",","."); $gtotalpt+=$terrestre_base+$ModificacionesPT; ?></td>
                              <td><?php echo "$ ".number_format($pagosPT,1,",","."); $gtotalpagospt+=$pagosPT; ?></td>
                              <td><strong><?php echo "$ ".number_format($terrestre_base+$ModificacionesPT-$pagosPT,0,",",".");?></strong></td>
                            </tr>
                            <tfoot>
                              <td><strong>TOTAL</strong></td>
                              <td><strong><?php echo $gtotalviajeros;?></strong></td>
                              <td>&nbsp;</td>
                              <td><strong><?php echo "$ ".number_format($gtotalsaldo,1,",",".");?></strong></td>
                              <td><strong><?php echo "$ ".number_format($gtotaltk,1,",",".");?></strong></td>
                              <td><strong><?php echo "$ ".number_format($gtotalpagostk,1,",",".");?></strong></td>
                              <td><strong><?php echo "$ ".number_format(($gtotaltk-$gtotalpagostk),0,",",".");?></strong></td>
                              <td><strong><?php echo "$ ".number_format($gtotalpt,1,",",".");?></strong></td>
                              <td><strong><?php echo "$ ".number_format($gtotalpagospt,1,",",".");?></strong></td>
                              <td><strong><?php echo "$ ".number_format(($gtotalpt-$gtotalpagospt),1,",",".");?></strong></td>
                                </tfoot>
                          </table>
                          <?php } ?>
                          -->
   				      </div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
