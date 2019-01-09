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
                         <div style="width: 100%;overflow-x: auto;
	white-space: nowrap;">
                          <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover"
                         data-fixed-columns="true"
       data-fixed-number="1">
                          <thead>
  <tr>
    <th bgcolor="#CCCCCC" width="500px"><strong>Grupo</strong></th>
    <?php 
	$result=$control->fechasPagos();
	
	$minf=$result['minfecha'];
	$maxf=$result['maxfecha'];
	
	$now = strtotime($maxf);// or your date as well
	$your_date = strtotime($minf);
	$datediff = $now - $your_date;

	$dias=floor($datediff / (60 * 60 * 24));
	
	?>
    
    <?php for($i=0;$i<$dias;$i++){ ?>
    <th bgcolor="#CCCCCC" style="font-size:70%" width="20px;"><strong><?php echo  strftime("%e<br>%b",strtotime($minf." +".$i."days"))?></strong></th>
    <?php } ?>
  </tr>
  </thead>
  <?php $resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']=="ACEPTADO"){			 ?>
  <tr>
    <td bgcolor="#CCCCCC"  width="500px"><strong><?php echo strtoupper($fi['grupo']); ?>
      </strong></td>
    <?php for($i=0;$i<$dias;$i++){ ?>
    
   
    <td> <?php 
		$fech= date('Y-m-d',strtotime($minf." +".$i."days"));
		
	  $datos= $control->consultaCalendarioPagosFecha($fi['id'],$fech);
	  
	  if($datos['aerea'] != 0 || $datos['terrestre'] != 0){ ?><span style="background:#FF0"><?php echo $datos['aerea']+$datos['terrestre']  ?></span>
      <?php }else { ?> &nbsp;
      <?php } ?>
    </td>
    <?php } ?>
    
  </tr>
  <?php } 
}
							}?>
  
                          </table></div>
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
