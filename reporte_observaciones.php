<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
	//
	
	
	
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>OBSERVACIONES VIAJEROS</h3>
       				      
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
                       
                      
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" data-sort-name="posicion" data-sort-order="desc" data-search="true" width="100%">
					        <thead>
					          <tr>
					            <th data-sortable="true" data-field="posicion" width="20%">VIAJERO</th>
					            <th data-sortable="true" data-field="manilla">MANILLA</th>
					            <th data-sortable="true" data-field="nombres"><strong>OBSERVACIONES</strong> </th>
				                </tr>
			                </thead>

					       <?php 
							
							$ias=0;
							$resultado=$control->viajerosTodosRooming($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$ias++;
								
							
	if($fi['record']==''){
$contrato=$control->sillaPrincipalPrograma($idgrupo);

	}else{
	$contrato=$control->datosContratoRecord($fi['record']);
	}
	
	

							?>
					        <tr>
					          <td><a href="registrar_pago.php?doc=<?php echo $fi['id']?>" target="_blank"><?php echo strtoupper($fi['nombres']);?>  <?php echo strtoupper($fi['apellidos']);?> (<?php echo strtoupper($fi['no_documento']);?>)</a></td>
					          <td><?php 
							  $res=$control->manillaID($fi['no_documento']);
							while ($di = mysql_fetch_array($res, MYSQL_ASSOC)) {
								
							
							  
                              
								echo $di['id'];
							} ?></td>
					          <td><?php 
							  $res=$control->observacionesViajero($fi['id']);
							while ($di = mysql_fetch_array($res, MYSQL_ASSOC)) {
								
								$usuario=$control->datosUsuario($di['usuario']);
							  
                              
								echo $di['fecha_registro']."<br/><b>".strtoupper($usuario['nombre']).":</b><br/>".$di['comentario'];
							} ?></td>
					          </tr>
					        <?php } ?>
                            
                           
				          </table>
					                 <p>&nbsp;</p>
					                 <p><?php echo $ias ?></p> 
                         
                                                    
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
