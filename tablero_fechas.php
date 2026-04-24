<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">TABLERO DE CONTROL GENERAL</div>
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
	//dataTable.addColumn({ type: 'string', role: 'tooltip' });
    dataTable.addColumn({ type: 'date', id: 'Start' });
    dataTable.addColumn({ type: 'date', id: 'End' });
    dataTable.addRows([
	
	<?php $resultado=$control->tablerocontrol();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$grupo=$control->datosProducto($fi['id_grupo']);
								
								?>


      [ '<?php echo strtoupper($grupo['grupo']); ?>', '<?php echo $fi['categoria'];?>',  new Date(<?php
	  $date = new DateTime($fi['inicio']);
echo $date->format('Y').",".($date->format('n')-1).",".$date->format('d'); ?>), new Date(<?php
	  $date = new DateTime($fi['fin']."");
echo $date->format('Y').",".($date->format('n')-1).",".$date->format('d'); ?>) ],	
	<?php
}?>
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
	 /*
      	var g = document.getElementsByTagName("svg")[22].getElementsByTagName("g")[0];
        document.getElementsByTagName("svg")[22].parentNode.style.top = '40px';
        document.getElementsByTagName("svg")[22].style.overflow = 'visible';
        var height = Number(g.getElementsByTagName("text")[0].getAttribute('y')) + 15;
        g.setAttribute('transform','translate(0,-'+height+')');
        g = null;*/
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
           				  </div>
           				  <p>&nbsp;</p>
                           
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
