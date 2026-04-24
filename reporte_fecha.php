<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
	//
	
	$id_grupo = $_REQUEST['id'];
 
	$producto=$control->datosProducto($id_grupo);
	
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
						<button id="btnExport">Descargar</button>
                      
                     <div id="table_wrapper">
                       
                      
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" data-sort-name="fecha" data-sort-order="desc" data-search="true" width="100%">
					        <thead>
					          <tr>
					            <th data-sortable="true" data-field="posicion">VIAJERO</th>
					            <th data-sortable="true" data-field="email">EMAIL</th>
					            <th data-sortable="true" data-field="pasaporte">NO PASAPORTE</th>
					            <th data-sortable="true" data-field="fecha_pasa">FECHA VENCIMIENTO PASAPORTE</th>
					            <th data-sortable="true" data-field="fecha">FECHA INSCRIPCION</th>
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
							// var_dump($producto['f_salida']); 
							 
							 echo $fi['email'];?></td>
					 
							  <td><?php echo $fi['pasaporte'];?></td>
							  <td><?php 
							  $datetime1 = new DateTime($producto['f_salida']);
							  $datetime2 = new DateTime($fi['pasaporte_vigencia']);
							  $interval = $datetime1->diff($datetime2);
							  $diasd=$interval->days;
							 // var_dump($interval->days);

						
							 echo '<a href="https://eventoursport.travel/crm/editar_super.php?id='.$fi['id'].'" target="_blank">'. $fi['pasaporte_vigencia']." </a>";
								
							 if($fi['pasaporte_vigencia'] != '0000-00-00'){
							 
							 if($diasd<210){
								echo '<span style="background-color:#ff3333;padding:5px;">'.round($diasd/30,1).' MESES</span>';
							  }else if($diasd<240){
								echo '<span style="background-color:#ffac33;padding:5px;">'.round($diasd/30,1).' MESES</span>';
							  }else{
								echo '<span style="background-color:#99FF33;padding:5px;">'.round($diasd/30,1).' MESES</span>';
							  }
							}
							 ?></td>
					   
					          <td><?php echo strtoupper($fi['fregistro']);?></td>
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
