<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	/*
 $id_grupo = $_REQUEST['grupo'];
 $vouchers=$_REQUEST['voucher'];
 $fvouchers=$_REQUEST['fvoucher'];
  $vlr_diario=$_REQUEST['vlr_diario'];
 $facvouchers=$_REQUEST['facvoucher'];
 
 //var_dump($vouchers);
if(isset($vouchers)){
	$resultado=$control->registrarVouchers($vouchers);
	$resultado=$control->registrarFVouchers($fvouchers);
$resultado=$control->registrarVlrDiario($vlr_diario);

	$resultado=$control->registrarFacVouchers($facvouchers);
}
*/
$pendientes=$_REQUEST['p'];
	
$prospecto=$control->datosProducto($id_grupo);
?>

    <script type="text/javascript" src="programas/accordion.js"></script>
   

      
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">REPORTE SAGRLAFT PROVEEDORES <?php if($pendientes==1){ echo " - PENDIENTES POR APROBAR";}?>
							  </div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						 
	
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                            <h2><?php echo $prospecto['grupo']; ?></h2>
                            <button id="btnExport">Descargar</button>
                            <form id="form1" name="form1" method="post" action="asistencia.php">
                            <div id="table_wrapper">
					                 <table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
           				      <thead>
   				              <tr>
   				               
   				                <th>TIPO</th>
       				            <?php if($_REQUEST['grupo'] == 0){?>
         				          <?php } ?>
         				          <th ><strong>Documento</strong></th>
         				          <th><strong>Nombre<br>
         				          </strong></th>
         				          <th  >Razon Social</th>
         				          <th  data-filter-control="select" data-field="pais" >Pais</th>
         				          <th data-filter-control="select" data-field="estado" >Estado</th>
         				          <th>Documento</th>
         				          <th >No. Consulta</th>
         				          <th data-filter-control="select" data-field="lista">Lista</th>
         				         
         				          <th ><strong>Fecha Consulta</strong></th>
         				          <th >Registrado por</th>
         				          <th >Observaciones</th>
         				          <th >Fecha Registro</th>
       				            </thead>
                             
       				                                          <?php 
							
							//$resultado=$control->inscritos($_REQUEST['grupo']);
							 $resultado=$control->proveedores();
							$grant_total_usd=0;$grant_total_cop=0;
										 $documentos_evaluados=array();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { 
							
							
							
								
							//$prd=$control->datosProducto($fi['id_grupo']);
								$sarlaft = $control->datosSarlaft($fi['id'],"PROVEEDOR");
								
								$mostrar=true;
								if($pendientes==1){
									
									if($fi['rut'] !="" && $fi['contacto2']!="" && $fi['cargo2']!="" && file_exists('documentos_proveedores/'.$fi['id'].'-RUT.pdf') && file_exists('documentos_proveedores/'.$fi['id'].'-IDREP.pdf')){
										
										if($fi['estado'] !="APROBADO"){
										$mostrar=true;
									}else{
											$mostrar=false;
										}
									}else{
										$mostrar=false;
									}
									
								}
							
								if($sarlaft!=null && $mostrar){
							
								
									$documentos_evaluados[$fi['no_documento']]=$fi;
							?>
										 
       				                                          
                                                               <tr>
                               
                                <td>PROVEEDOR</td>
       				                                          <td><a href="laft.php?id=<?php echo $fi['id'];?>&tipo=PROVEEDOR" target="_blank"><?php echo $fi['rut'];?></a><br/>
       				                                           </td>
       				                                          <td><a href="datos_proveedor.php?id=<?php echo $fi['id'] ?>" target="_blank"><?php 
							
							  echo strtoupper( $fi['nombre']);?></a></td>
       				                                          <td ><?php 
							
							  echo strtoupper( $fi['razonsocial']);?></td>
       				                                          <td ><?php 
							
							  echo strtoupper( $fi['pais']);?></td>
       				                                          <td > <?php 
																  if($sarlaft == null){
																	  echo "NO VERIFICADO";
																  }else{
																	echo  $sarlaft['estado'];
																  }
																  ?></td>
       				                                          <td ><?php if(file_exists('documentos_proveedores/'.$fi['id'].'-RUT.pdf')){
																	echo "<a href='documentos_proveedores/".$fi['id']."-RUT.pdf' target='_blank'>VER</a>";
																  }else{echo "NO";}?></td>
       				                                          <td ><?php echo  $sarlaft['id']; ?></td>
       				                                          <td ><?php 
								$listas="";
								if($sarlaft['listas_restrictivas']=='SI'){
									$listas.="LISTAS RESTRICTIVAS<br>";
								}if($sarlaft['peps']=='SI'){
									$listas="PEPS<br>";
								}if($sarlaft['procuraduria']=='SI'){
									$listas.="PROCURADURIA<br>";
								}if($sarlaft['contaduria']=='SI'){
									$listas.="CONTADURIA<br>";
								}if($sarlaft['contraloria']=='SI'){
									$listas.="CONTRALORIA<br>";
								}if($sarlaft['demandas']=='SI'){
									$listas.="DEMANDAS<br>";
								}if($listas==""){
									$listas="NINGUNA";
								}
													echo $listas;			  
																  ?></td>
															<td ><?php echo  $sarlaft['fecha_consulta']; ?></td>
       				                                      
                                                             
       				                                         
       			
                                                       <td ><?php $usr=$control->datosUsuario($sarlaft['usuario_registro']); 
														   echo $usr['nombre'];
														   ?></td>
       				                                          <td><?php echo  $sarlaft['observaciones']; ?></td>
       				                                          <td><?php echo  $sarlaft['fecha_registro']; ?></td>
                                       </tr>
                                                              <?php 
								
										 	
				if($fi['contacto2'] !=''){
					
					
										 ?> <tr>
                                                             
                                                                 <td>REP LEGAL                                                                 </td>
                                                                 <td><a href="laft.php?id=<?php echo $fi['id'];?>&tipo=REPLEGAL" target="_blank"><?php if($fi['facturacion_documento']=="Cedula"){
											 echo "CC ";
										 } echo $fi['cargo2']; ?></a></td>
                                                                 <td><a href="datos_proveedor.php?id=<?php echo $fi['id'] ?>" target="_blank"> <?php echo strtoupper($fi['contacto2']);
																	 $sarlaft2 = $control->datosSarlaft($fi['id'],"REPLEGAL");
																	 ?></a></td>
                                                                 <td ><?php 
							
							  echo strtoupper( $fi['razonsocial']);?></td>
                                                                 <td ><?php 
							
							  echo strtoupper( $fi['pais']);?></td>
                                                                <td ><?php 
																  if($sarlaft2 == null){
																	  echo "NO VERIFICADO";
																  }else{
																	echo  $sarlaft2['estado'];
																  }
																	?></td>
                                                                <td ><?php if(file_exists('documentos_proveedores/'.$fi['id'].'-IDREP.pdf')){
																	echo "<a href='documentos_proveedores/".$fi['id']."-IDREP.pdf' target='_blank'>VER</a>";
																  }else{echo "NO";}?></td>
       				                                          <td ><?php echo  $sarlaft2['id']; ?></td>
       				                                          <td ><?php 
																  $listas="";
								if($sarlaft2['listas_restrictivas']=='SI'){
									$listas.="LISTAS RESTRICTIVAS<br>";
								}if($sarlaft2['peps']=='SI'){
									$listas="PEPS<br>";
								}if($sarlaft2['procuraduria']=='SI'){
									$listas.="PROCURADURIA<br>";
								}if($sarlaft2['contaduria']=='SI'){
									$listas.="CONTADURIA<br>";
								}if($sarlaft2['contraloria']=='SI'){
									$listas.="CONTRALORIA<br>";
								}if($sarlaft2['demandas']=='SI'){
									$listas.="DEMANDAS<br>";
								}if($listas==""){
									$listas="NINGUNA";
								}
													echo $listas;
																  ?></td>
															<td ><?php echo  $sarlaft2['fecha_consulta']; ?></td>
       				                                      
                                                             
       				                                         
       			
                                                       <td ><?php $usr=$control->datosUsuario($sarlaft2['usuario_registro']); 
														   echo $usr['nombre'];
														   ?></td>
       				                                          <td><?php echo  $sarlaft2['observaciones']; ?></td>
       				                                          <td><?php echo  $sarlaft2['fecha_registro']; ?></td>
                                                               </tr>
           				      <?php
																															  
							  
				}
							
							
							}
							}?>
       				        </table>
                            </div>
                            </form>
           				  </div>
           				</div>
                        </div>
</div>
                        </div>
                        </div>
                        
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
                        
    </body>
