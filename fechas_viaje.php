<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">FECHAS DE VIAJE</div>
					<div class="panel-body">
           				  <div class="module-body">
                          
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
      	var g = document.getElementsByTagName("svg")[22].getElementsByTagName("g")[1];
        document.getElementsByTagName("svg")[22].parentNode.style.top = '40px';
        document.getElementsByTagName("svg")[22].style.overflow = 'visible';
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
                            
       				      <div id="timeline" style="height: 700px;"></div>
           				  </div>
           				  <p>&nbsp;</p>
                           
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
