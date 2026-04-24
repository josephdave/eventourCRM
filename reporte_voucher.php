<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
	//
	
	
	
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>VOUCHERS</h3>
       				      
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
					            <th width="18%" data-sortable="true" data-field="posicion">VIAJERO</th>
					            <th width="82%" data-sortable="true" data-field="nombres"><strong>VOUCHER</strong> </th>
				                </tr>
			                </thead>

					       <?php 
							
							$resultado=$control->viajerosViajanRooming($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
	
	

							?>
					        <tr>
					          <td><a href="registrar_pago.php?doc=<?php echo $fi['id']?>" target="_blank"><?php echo strtoupper($fi['nombres']);?>  <?php echo strtoupper($fi['apellidos']);?> (<?php echo strtoupper($fi['no_documento']);?>)</a></td>
					          <td><a href="https://eventoursport.travel/crm/impresion/pdf/voucher_pdf.php?viajero=<?php echo $fi['id']?>" target="_blank">Descargar</a></td>
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
