<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
	//
	
	
if(isset($_REQUEST['contrato_id'])){
	  if($_REQUEST['contrato_status'] == 1){
	  
	 $mensaje=$control->actualizarCampo("contrato_ok","0","id",$_REQUEST['contrato_id']);
	  }else{
	$mensaje=$control->actualizarCampo("contrato_ok","1","id",$_REQUEST['contrato_id']);
	 	  
	  }
	  
	
	 
	 
	 }  

if(isset($_REQUEST['doc_identidad']) && file_exists('documentos/'.$_REQUEST['doc_identidad'])){
	  
	  if(strpos($_REQUEST['doc_identidad'],"OK") === false){
	  
	  rename('documentos/'.$_REQUEST['doc_identidad'],'documentos/OK'.$_REQUEST['doc_identidad']);
	  
	 $mensaje=$control->actualizarCampo("doc_identidad","OK".$_REQUEST['doc_identidad'],"no_documento",$_REQUEST['no_documento']);
	  }else{
	    rename('documentos/'.$_REQUEST['doc_identidad'],'documentos/'.str_replace("OK","",$_REQUEST['doc_identidad']));
	  
	 $mensaje=$control->actualizarCampo("doc_identidad",str_replace("OK","",$_REQUEST['doc_identidad']),"no_documento",$_REQUEST['no_documento']);
	  }
	 
	 
	 }
	 
	 if(isset($_REQUEST['doc_permiso']) && file_exists('documentos/'.$_REQUEST['doc_permiso'])){
		 
	if(strpos($_REQUEST['doc_permiso'],"OK") === false){
	  
	  rename('documentos/'.$_REQUEST['doc_permiso'],'documentos/OK'.$_REQUEST['doc_permiso']);
	  
	 $mensaje=$control->actualizarCampo("doc_permiso","OK".$_REQUEST['doc_permiso'],"no_documento",$_REQUEST['no_documento']);
	  }else{
	    rename('documentos/'.$_REQUEST['doc_permiso'],'documentos/'.str_replace("OK","",$_REQUEST['doc_permiso']));
	  
	 $mensaje=$control->actualizarCampo("doc_permiso",str_replace("OK","",$_REQUEST['doc_permiso']),"no_documento",$_REQUEST['no_documento']);
	  }
	 
	 
	 }
	 
	 if(isset($_REQUEST['doc_pasaporte']) && file_exists('documentos/'.$_REQUEST['doc_pasaporte'])){
	
	  if(strpos($_REQUEST['doc_pasaporte'],"OK") === false){
	  
	  rename('documentos/'.$_REQUEST['doc_pasaporte'],'documentos/OK'.$_REQUEST['doc_pasaporte']);
	  
	 $mensaje=$control->actualizarCampo("doc_pasaporte","OK".$_REQUEST['doc_pasaporte'],"no_documento",$_REQUEST['no_documento']);
	  }else{
	    rename('documentos/'.$_REQUEST['doc_pasaporte'],'documentos/'.str_replace("OK","",$_REQUEST['doc_pasaporte']));
	  
	 $mensaje=$control->actualizarCampo("doc_pasaporte",str_replace("OK","",$_REQUEST['doc_pasaporte']),"no_documento",$_REQUEST['no_documento']);
	  }
	 
	 
	 }
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>DOCUMENTACIÓN</h3>
       				      
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
					
					<div class="panel-body">
                     <div id="table_wrapper">
                       
                      
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="posicion" data-sort-order="desc" data-search="true">
					        <thead>
					          <tr>
					            <th data-sortable="true" data-field="posicion">DOCUMENTO</th>
					            <th data-sortable="true" data-field="nombres"><strong>NOMBRES</strong> </th>
				                <th data-sortable="true" data-field="apellidos"><strong>APELLIDOS
                                </strong> </th>
				                <th >CONTRATO</th>
				                <th >DOCUMENTO</th>
				                <th >PERMISO</th>
				                <th >PASAPORTE</th>
				                </tr>
			                </thead>

					       <?php 
							
							$resultado=$control->viajerosTodosRooming($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							
	if($fi['record']==''){
$contrato=$control->sillaPrincipalPrograma($idgrupo);

	}else{
	$contrato=$control->datosContratoRecord($fi['record']);
	}
	
	

							?>
					        <tr>
					          <td><?php echo strtoupper($fi['no_documento']);?></td>
					          <td><?php echo strtoupper($fi['nombres']);?></td>
					          <td><?php echo strtoupper($fi['apellidos']);?></td>
					          <td>
								  <?php 
								$url="";
								if(file_exists("impresion/pdf/contratos_firmados/contrato_".$fi['no_documento'].".pdf")){
								$url="impresion/pdf/contratos_firmados/contrato_".$fi['no_documento'].".pdf";
								}else{
									$url="impresion/pdf/contrato_pdf.php?firma=".$fi['no_documento']."&carta_aceptacion=0&descarga=fi";
								}
								  ?>
								  <a href="https://eventoursport.travel/crm/<?php echo $url;?>" target="_blank"><img src='images/icon-download.png' width='20' height='20'  alt='descargar contrato' title='descargar contrato'/></a><br>
					            <form action="documentacion.php" method="post">
					              <input type="hidden" id="id" name="id" value="<?php echo $idgrupo?>">
					              
					              <input type="hidden" id="contrato_id" name="contrato_id" value="<?php echo  $fi['id']?>">
									 <input type="hidden" id="contrato_status" name="contrato_status" value="<?php echo  $fi['contrato_ok']?>">
					              <input type="checkbox"  onChange="this.form.submit()"
                             <?php if($fi['contrato_ok']== 1 ){ echo 'checked';
							 }
							 
							 ?>
                              
                              >
			                  </form></td>
					         <td><?php 
							
							 
							 if($fi['doc_identidad']!= ""){echo "<a href='documentos/".$fi['doc_identidad']."' target='_blank'><img src='images/icon-download.png' width='20' height='20'  alt='descargar'/></a><br/>";
							  ?><form action="documentacion.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $idgrupo?>"><input type="hidden" id="doc_identidad" name="doc_identidad" value="<?php echo  $fi['doc_identidad']?>"><input type="hidden" id="no_documento" name="no_documento" value="<?php echo  $fi['no_documento']?>"><input type="checkbox"  onChange="this.form.submit()"
                             <?php if(strpos($fi['doc_identidad'],"OK") !== false ){ echo 'checked';
							 }
							 
							 ?>
                              
                              ></form>
                        
   				<?php }?>                                              </td>
       				                                          <td><?php 
															  
	 if($control->edad($fi['fnacimiento'],$_REQUEST['grupo'])>=18){echo "N/A";}														  if($fi['doc_permiso']!= ""){echo "<a href='documentos/".$fi['doc_permiso']."' target='_blank'><img src='images/icon-download.png' width='20' height='20'  alt='descargar permiso'/></a><br/>";
							  
							  
							 ?><form action="documentacion.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $idgrupo?>"><input type="hidden" id="doc_permiso" name="doc_permiso" value="<?php echo  $fi['doc_permiso']?>"><input type="hidden" id="no_documento" name="no_documento" value="<?php echo  $fi['no_documento']?>"><input type="checkbox"  onChange="this.form.submit()"
                             <?php if(strpos($fi['doc_permiso'],"OK") !== false ){ echo 'checked';
							 }?>
                              
                              ></form><?php } ?></td>
       				                                          <td><?php if($fi['doc_pasaporte']!= ""){echo "<a href='documentos/".$fi['doc_pasaporte']."' target='_blank'><img src='images/icon-download.png' width='20' height='20'  alt='descargar pasaporte'/></a><br/>";
							  ?><form action="documentacion.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $idgrupo?>"><input type="hidden" id="doc_pasaporte" name="doc_pasaporte" value="<?php echo  $fi['doc_pasaporte']?>"><input type="hidden" id="no_documento" name="no_documento" value="<?php echo  $fi['no_documento']?>"><input type="checkbox"  onChange="this.form.submit()"
                             <?php if(strpos($fi['doc_pasaporte'],"OK") !== false ){ echo 'checked';
							 }?>
                              
                              ></form> <?php } ?></td>
					          </tr>
					        <?php } ?>
                            
                           
				          </table> 
                         
                                                    
					</div>
					</div>
                       </div>
                                                                                    </div>
                             <script>
							$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>
           				  </div>
           				</div>
                        </div>
    </body>
