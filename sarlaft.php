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

$prospecto=$control->datosProducto($id_grupo);
?>

    <script type="text/javascript" src="programas/accordion.js"></script>
   

      
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">REPORTE SAGRLAFT</div>
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
					                 <table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="id" data-sort-order="desc">
           				      <thead>
   				              <tr>
   				                <th data-sortable="true" data-field="id" >Id</th>
   				                <th data-sortable="true" data-filter-control="select" data-field="programa" >Programa</th>
   				                <th>TIPO</th>
       				            <?php if($_REQUEST['grupo'] == 0){?>
         				          <?php } ?>
         				          <th ><strong>Documento</strong></th>
         				          <th><strong>Nombres<br>
         				          </strong></th>
         				          <th data-sortable="true" data-filter-control="select" data-field="estado" >Estado</th>
         				          <th data-sortable="true" >Documento</th>
         				          <th data-sortable="true" >No. Consulta</th>
         				          <th data-sortable="true" data-filter-control="select" data-field="lista">Lista</th>
         				         
         				          <th ><strong>Fecha Consulta</strong></th>
         				          <th >Registrado por</th>
         				          <th >Observaciones</th>
         				          <th >Fecha Registro</th>
       				            </thead>
                             
       				                                          <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							$grant_total_usd=0;$grant_total_cop=0;
										 $documentos_evaluados=array();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { 
							
							
							
								
							$prd=$control->datosProducto($fi['id_grupo']);
							
							if(!array_key_exists($fi['no_documento'],$documentos_evaluados)){
								
									$documentos_evaluados[$fi['no_documento']]=$fi;
							?>
										 
       				                                          
                                                               <tr>
                                                                 <td><?php echo $fi['id'] ?></td>
                                <td><?php echo strtoupper($control->nomGrupoSimple($fi['id_grupo']));
															  
															  $programa = $control->datosProducto($fi['id_grupo']);
															  $sarlaft = $control->datosSarlaft($fi['id'],"VIAJERO");
								//var_dump($sarlaft);
									
									?></td>
                                <td>VIAJERO</td>
       				                                          <td><a href="laft.php?id=<?php echo $fi['id'];?>&tipo=VIAJERO" target="_blank"><?php echo $fi['documento'];?><?php echo $fi['no_documento'];?></a> <br/>
       				                                           </td>
       				                                          <td><?php echo strtoupper($fi['nombres']);?><?php echo strtoupper($fi['apellidos']);?></td>
       				                                          <td > <?php 
																  if($sarlaft == null){
																	  echo "NO VERIFICADO";
																  }else{
																	echo  trim($sarlaft['estado']);
																  }
																  ?></td>
       				                                          <td ><?php if($fi['doc_identidad']!= ""){echo "<a href='documentos/".$fi['doc_identidad']."' target='_blank'>VER</a><br/>";
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
                                                              <?php if($fi['no_documento'] != $fi['facturacion_nodocumento'] && (!array_key_exists($fi['facturacion_nodocumento'],$documentos_evaluados))){
										 	
							
								
									$documentos_evaluados[$fi['facturacion_nodocumento']]=$fi;
										 ?> <tr>
                                                                <td><?php echo $fi['id'] ?></td>
                                                                 <td><?php echo strtoupper($control->nomGrupoSimple($fi['id_grupo']));?></td>
                                                                 <td>TERCERO</td>
                                                                 <td><a href="laft.php?id=<?php echo $fi['id'];?>&tipo=TERCERO" target="_blank"><?php if($fi['facturacion_documento']=="Cedula"){
											 echo "CC ";
										 } echo $fi['facturacion_nodocumento']; ?></a></td>
                                                                 <td> <?php echo $fi['facturacion_nombre'];
																	 $sarlaft2 = $control->datosSarlaft($fi['id'],"TERCERO");
																	 ?></td>
                                                                <td ><?php 
																  if($sarlaft2 == null){
																	  echo "NO VERIFICADO";
																  }else{
																	echo  $sarlaft2['estado'];
																  }
																	?></td>
                                                                <td ><?php if($fi['doc_pasaporte']!= ""){echo "<a href='documentos/".$fi['doc_pasaporte']."' target='_blank'>VER</a><br/>";
							  }else{ echo "NO";}?></td>
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
							
							
							} ?>
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
