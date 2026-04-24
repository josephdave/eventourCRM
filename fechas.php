<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
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
  $("#btnExport3").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

	//var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper3');
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
	var table_html = table_html.replaceAll(',', '');

	  var table_html = table_html.replaceAll('.', ',');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
  


});
							</script>
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">FECHAS DE VIAJE</div>
					<div class="panel-body">
						
						  <button id="btnExport3">Descargar</button>
						
						
           				  <div class="module-body">
                         <div style="width: 100%;overflow-x: auto;
	white-space: nowrap;">
							  <div id="table_wrapper3">
								  <style>
									  .tabla3 tr td{
										  border: 1px solid rgba(54,54,54,1.00);
										  padding: 5px;
									  }
									  .tabla3 tr th{
										  min-width: 30px;
									  }
								  </style>
                          <table  class="tabla3" border="1px" bordercolor="rgba(44,44,44,1.00)">
                          <thead>
  <tr>
    <th bgcolor="#CCCCCC" width="500px"><strong>Grupo</strong></th>
	    <th bgcolor="#CCCCCC" width="500px"><strong>Viajeros</strong></th>
    <?php 
	$result=$control->fechasPagos();
	
	$minf=$result['minfecha'];
	$maxf=$result['maxfecha'];
	
	$now = strtotime($maxf);// or your date as well
	$your_date = strtotime($minf);
	$datediff = $now - $your_date;

	$dias=floor($datediff / (60 * 60 * 24));
	  $meses=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	  $totales=array();
	
	?>
    
    <?php for($i=0;$i<$dias;$i++){ ?>
    <th bgcolor="#CCCCCC" style="font-size:70%" width="20px;"><strong><?php echo  strftime("%e<br>%b",strtotime($minf." +".$i."days"))?></strong></th>
    <?php } ?>
  </tr>
  </thead>
  <?php $resultado=$control->grupos();
							  
								  $background_colors = array('#fcba03','#00c0f5','#377ebf','#2cc99a','#1be382','#6f1fc4','#a8db1d','#7188bd','#cc913d');
							  
							  $n=0;
							  
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
				
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']=="ACEPTADO"){			
							  
	
							  ?>
  <tr>
    <td bgcolor="<?php echo $background_colors[$n];  ?>" style="background:<?php echo $background_colors[$n];  ?>!important;width:100%;height:100%;padding:7px"  width="500px"><span ><strong><?php echo strtoupper($fi['grupo']);$n++; ?>
      </strong></span></td>
	   <td bgcolor="#CCCCCC"  width="500px"><strong><?php $viajerosGrupo= $control->cantGrupoViaja($fi['id']); echo $viajerosGrupo; ?>
      </strong></td>
    <?php for($i=0;$i<$dias;$i++){ ?>
    
    <?php 
		$fech= date('Y-m-d',strtotime($minf." +".$i."days"));
		
	  $datos= $control->consultaCalendarioPagosFecha($fi['id'],$fech);
	  
	  if($datos['aerea'] != 0 || $datos['terrestre'] != 0){ ?>
    <td  bgcolor="<?php echo $background_colors[$n-1];  ?>" style="background:<?php echo $background_colors[$n-1];  ?>!important;" >
		<span >
		<?php $cuota= $datos['aerea']+$datos['terrestre']; echo $cuota;
														     ?><br/><?php echo number_format($viajerosGrupo*$cuota);  
			$totales[date('Y',strtotime($minf." +".$i."days"))."-".date('n',strtotime($minf." +".$i."days"))." ".$meses[date('n',strtotime($minf." +".$i."days"))]]+=($viajerosGrupo*$cuota);
			?>
		</span>
		</td>
      <?php }else { ?> <td>&nbsp;</td>
      <?php } ?>
    
    <?php } ?>
    
  </tr>
  <?php } 
}
							}?>
  
                          </table>
							  
							
							  <p>&nbsp;</p>
						   <p>&nbsp;</p>
							  <table width="300px" border="0" class="table table-hover">
							    <tbody>
							      <tr>
							        <th>MES</th>
							        <th>VALOR</th>
						          </tr>
									<?php
									ksort($totales);
									
									foreach ($totales as $mes=>$tot){?>
							      <tr>
							        <td><?php echo  $mes; ?></td>
							        <td><?php echo number_format($tot); ?></td>
						          </tr>
							    
							      <?php } ?>
									  <tr>
							        <td><strong>TOTAL</strong></td>
							        <td><strong><?php echo number_format(array_sum($totales)); ?></strong></td>
						          </tr>
						        </tbody>
					       </table>
							 </div>
                         </div>
                          <!--

           				  <p>GRUPOS JUVENILES</p>
           			
                     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">	
      google.charts.load('current', {'packages':['timeline']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
 var dataTable = new google.visualization.DataTable();
    dataTable.addColumn({ type: 'string', id: 'Position' });
    dataTable.addColumn({ type: 'string', id: 'Name' });
	dataTable.addColumn({ type: 'string', role: 'tooltip' });
    dataTable.addColumn({ type: 'date', id: 'Start' });
    dataTable.addColumn({ type: 'date', id: 'End' });
    dataTable.addRows([
	
	<?php $resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']=="ACEPTADO"){			 ?>

<?php $resultado5=$control->consultaCalendarioPagos($fi['id']);
							while ($fi5 = mysql_fetch_array($resultado5, MYSQL_ASSOC)) {
							?>
      [ '<?php echo strtoupper($fi['grupo']); ?>', 'Cuota <?php echo $fi5['id'];?>',  'Cuota <?php echo $fi5['id'];?>: <?php
	  $date = new DateTime($fi5['fecha']);
echo $date->format('d-M-Y');
	  
	   ?> - TK:<?php echo $fi5['aerea'];?> - PT:<?php echo $fi5['terrestre'];?>',
	   
	   
	   new Date(<?php
	  $date = new DateTime($fi5['fecha']);
echo $date->format('Y').",".($date->format('n')-1).",".$date->format('d');
	  
	   ?>), new Date(<?php
	  $date = new DateTime($fi5['fecha']." +1 day");
echo $date->format('Y').",".($date->format('n')-1).",".$date->format('d');
	  
	   ?>) ],
     
	
	
	<?php } 
	?>
	 [ '<?php echo strtoupper($fi['grupo']); ?>', 'VIAJE','VIAJE: <?php
	  $date = new DateTime($fi['f_salida']);
echo $date->format('j-M-Y');
	  
	   ?> al <?php
	  $date = new DateTime($fi['f_llegada']);
echo $date->format('j-M-Y');
	  
	   ?>', new Date(<?php
	  $date = new DateTime($fi['f_salida']);
echo $date->format('Y').",".($date->format('n')-1).",".$date->format('d');
	  
	   ?>), new Date(<?php
	  $date = new DateTime($fi['f_llegada']);
echo $date->format('Y').",".($date->format('n')-1).",".$date->format('d');
	  
	   ?>) ],
	<?php
	}}}?>
	]);
	
	 var options = {
                      hAxis: {
                format: "MMM d, y"
                //format: "HH:mm:ss"
                //format:'MMM d, y'
            },
			gridlines:{count: 100},
				ticks: [new Date(2017, 0, 1), new Date(2017, 0, 15), new Date(2017, 0, 18)]
     
			        };
	
        var container = document.getElementById('timeline');
        var chart = new google.visualization.Timeline(container);
		google.visualization.events.addListener(chart, 'ready', afterDraw);
	

        chart.draw(dataTable,options);
		
		
		
		
      }

 function afterDraw() {
      	var g = document.getElementsByTagName("svg")[62].getElementsByTagName("g")[0];
        document.getElementsByTagName("svg")[62].parentNode.style.top = '40px';
        document.getElementsByTagName("svg")[62].style.overflow = 'visible';
        var height = Number(g.getElementsByTagName("text")[0].getAttribute('y')) + 15;
        g.setAttribute('transform','translate(0,-'+height+')');
        g = null;
      }
    </script>
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
                            
       				      <div id="timeline" style="height: 400px;"></div>
           				  </div>-->
           				  <p>&nbsp;</p>
                           
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
