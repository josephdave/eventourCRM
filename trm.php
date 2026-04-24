<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
	
	if(isset($_REQUEST['fech'])){
	$control->registrarTRM($_REQUEST['fech'],$_REQUEST['trm']);
	}
 

function range_date($first, $last) {
  $arr = array();
  $now = strtotime($last);
  $last = strtotime($first);

  while($now >= $last ) {
    $arr[] = date('Y-m-d', $now);
    $now = strtotime('-1 day', $now);
  }

  return $arr;
}

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> TRM</h3>
       				      
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
                    
                    <script>
					google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
      var data = new google.visualization.DataTable();
      data.addColumn('date', 'X');
      data.addColumn('number', 'TRM');
 
      data.addRows([
	  <?php
	  $cont=0;
	   $resultado=range_date("-2 months","now");
							foreach ($resultado as $fech) {
								 $trm=mysql_fetch_row($control->dolar($fech));
								 if($trm[0] == null ){
								
								 }else{
								 
								 
								
	  $date = new DateTime($fech);


		if($trm[0] != 0){

				 echo "[new Date(".$date->format('Y').",".($date->format('n')-1).",".$date->format('d')."), ".$trm[0]."],";
		}
								 }
				 $cont++;
								
								
							} ?>
          
      ]);

      var options = {
        hAxis: {
          title: 'Fecha'
        },
        vAxis: {
          title: 'TRM'
        },
        series: {
          1: {curveType: 'function'}
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
					</script>
                     
                      
  <div id="chart_div"></div>
                        <button id="btnExport">Descargar</button>
                        <?php echo $fech;?>
                       
                      <div id="table_wrapper">
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="posicion" data-sort-order="desc">
					        <thead>
					          <tr>
					            <th >FECHA</th>
				                <th data-sortable="true" data-field="apellidos"><strong>TRM</strong></th>
				                </tr>
			                </thead>

					       <?php 
							
							$resultado=range_date("-2 months","now");
							foreach ($resultado as $fech) {
							
	
	//$fi=$control->datosViajeroID($fi2['id_viajero']);

							?>
					        <tr>
					          <td><?php echo $fech;?></td>
					          <td  class="remover" id="<?php 
							  $trm=mysql_fetch_row($control->dolar($fech));
							  echo $trm[0];?>"><?php
															  
	
	//var_dump($trm);
							if(	$trm[0] !=null){				  
				echo $trm[0];}
				else{
															  ?>
                                                              
                 <form action="trm.php" method="post"><input type="text" id="trm" name="trm"> <input type="hidden" id="fech" name="fech" value="<?php echo $fech?>">
                   <input type="submit" value="Guardar">
                 </form>                                             <?php } ?></td>
					          </tr>
					        <?php } ?>
                            
                           
				          </table> 
                          </div>

					</div>
					</div>
                       </div>
                                                                                    </div>
                            <script>
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
