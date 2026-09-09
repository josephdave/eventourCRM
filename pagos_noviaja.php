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
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
//	

	  var table_html = table_html.replaceAll('.', '');
var table_html = table_html.replaceAll(',', ',');	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGOS NO VIAJAN COLEGIOS</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 
						  $producto=$control->datosProducto($_REQUEST['grupo']);
						  
						  ?>
                          <button id="btnExport">Descargar</button>
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
							    <div id="table_wrapper">
                            <table class="table table-hover table-fixed" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0"  data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="viajeros" data-sort-order="asc" data-side-pagination="client" data-fixed-header="true" >
                           <thead>
                              <?php if($_REQUEST['grupo'] == 0){?>
                              <tr>
                                <?php } ?>
                                <th data-sortable="true"data-field="viajeros" ><strong>Viajero(s)</strong></th>
                                <th>Grupo</th>
                                <th>No Documento Cliente</th>
                                <th>Ultima Fecha de Pago</th>
                                <th>Pagos TIK</th>
                                <th>Pagos TIK Pesos</th>
                                <th>Pagos PT</th>
                                <th>Pagos PT Pesos</th>
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
								 $pagosTKP=0;
								 $pagosPTP=0;
							$ultimafecha="";
						
							
							$gtotalviajeros=0;
							$gtotalsaldo=0;
							$gtotaltk=0;
							$gtotalpagostk=0;
							$gtotalpt=0;
							$gtotalpagospt=0;
								 
								 	$gtotalpagostkp=0;
							
							$gtotalpagosptp=0;
							$viajero="";
								 $grupoNom="";
							
							$resultado=$control->inscritosNOVIAJA($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC))
							
							 {	
							 $viajacon=1;	
												
						 	 if($facturador != $fi['facturacion_nodocumento']){
								 if($facturador != "" && ($pagosPT+$pagosTK  > 0)){
									  $gtotalviajeros++;	
								 ?>
                            <tr>
                              <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $viajero ?></a></td>
                              <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $grupoNom ?></a></td>
                              <td><?php echo $facturador ?></td>
                              <td><?php echo $ultimafecha ?></td>
                              <td><?php echo  $producto['MONEDA']."$ ".number_format($pagosTK,1,",","."); $gtotalpagostk+=$pagosTK;
								  $gtotalpagostkp+=$pagosTKP;?></td>
                              <td><?php echo number_format($pagosTKP,0,",",".");?></td>
                              <td><?php echo $producto['MONEDA']."$ ".number_format($pagosPT,1,",","."); $gtotalpagospt+=$pagosPT;
								  $gtotalpagosptp+=$pagosPTP;?></td>
                              <td><?php echo number_format($pagosPTP,0,",",".");?></td>
                              </tr>
                            <?php
								 }
								$facturador=$fi['facturacion_nodocumento'];
								$id=$fi['id'];
								$viajero = strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								$grupoNom =$control->datosProducto($fi['id_grupo'])['grupo'];
								$aereo_base= $control->valorViajeroTK($fi['otro'],$producto);
								$ModificacionesTK =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'TK');
								
								$realTK = $aereo_base+$ModificacionesTK;
								
								
								
								$terrestre_base= $control->valorViajeroPT($fi['otro'],$producto);
								$ModificacionesPT =  $control->consultarModificaciones($fi['id'],$_REQUEST['grupo'],'PT');
								
								$realPT=$terrestre_base+$ModificacionesPT;
																
								$pagos=$control->pagosViajero($fi['id']);
							  
							  	$pagosTK=$pagos['pagosTIK'];
								  	$pagosTKP=$pagos['pagosTIK']*$pagos['trm'];
								 
								$pagosPT=$pagos['pagosPT'];
								$pagosPTP=$pagos['pagosPT']*$pagos['trm'];
							  
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
								 $pagosTKP+=$pagos['pagosTIK']*$pagos['trm'];
								 
								
								$pagosPTP+=$pagos['pagosPT']*$pagos['trm'];
								$pagosPT+=$pagos['pagosPT'];
								$viajero.=" - ".strtoupper($fi['apellidos'])." ".strtoupper($fi['nombres']);
								$viajacon++;
								}
								
							 } ?>
                            <tr>
                              <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $viajero ?></a></td>
                              <td><a href="registrar_pago.php?doc=<?php echo $id ?>"><?php echo $grupoNom ?></a></td>
                              <td><?php echo $facturador ?></td>
                              <td><?php echo $ultimafecha;
							  if($ultimafecha != ""){
							  $totalconpago=$totalconpago+$viajacon;
							  }?></td>
                              <td><?php echo $producto['MONEDA']."$ ".number_format($pagosTK,1,",","."); $gtotalpagostk+=$pagosTK; ?></td>
                              <td><?php echo number_format($pagosTKP,0,",",".");?></td>
                              <td><?php echo $producto['MONEDA']."$ ".number_format($pagosPT,1,",","."); $gtotalpagospt+=$pagosPT; ?></td>
                              <td><?php echo number_format($pagosPTP,0,",",".");?></td>
                              </tr>
                            <tfoot>
                              <tr>
                                <td><strong>TOTAL</strong></td>
                                <td>&nbsp;</td>
                              <td><strong><?php echo $gtotalviajeros;?></strong></td>
                              <td>&nbsp;</td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($gtotalpagostk,1,",",".");?></strong></td>
                              <td><?php echo number_format($gtotalpagostkp,0,",",".");?></td>
                              <td><strong><?php echo $producto['MONEDA']."$ ".number_format($gtotalpagospt,1,",",".");?></strong></td>
                              <td><?php echo number_format($gtotalpagosptp,0,",",".");?></td>
                              </tfoot>
                          </table>
							  </div>
                          <?php } ?>
   				      </div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
