<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">FECHAS DE VIAJE</div>
					<div class="panel-body">
           				  <div class="module-body">
                         <div style="width: 100%;overflow-x: auto;
	white-space: nowrap;">
    <?php
	
	$potencial_total=0;
	 $resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']=="ACEPTADO"){			 ?>
<h3><strong><?php echo strtoupper($fi['grupo']); ?>
<?php 

$chart_insc=array();
$chart_pagos=array();
$chart_mes=array();
$chart_potencial=array();
$potencial = $fi['cant_viajeros'];
$potencial_total+=$potencial;

?>
      </strong></h3>
                          <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
                          <thead>
  <tr>
    <th bgcolor="#CCCCCC" width="500px"><strong>Grupo</strong></th>
    <?php 
	$result=$control->maximaFechaViaje();
	
	$minf="2018-07-01";
	$maxf=$result['maxfecha'];
	
	$now = strtotime($maxf);// or your date as well
	$your_date = strtotime($minf);
	$datediff = $now - $your_date;

	$dias=floor($datediff / (60 * 60 * 24 ));
	
	?>
    
    <?php for($i=0;$i<$dias;$i=$i+31){ ?>
    <th bgcolor="#CCCCCC" style="font-size:70%" width="20px;" ><strong><?php echo  strftime("%b<br>%G",strtotime($minf." +".($i)."days"));
	
	$chart_mes[]=strftime("%b %G",strtotime($minf." +".($i)."days"));
	
	?></strong></th>
    <?php } ?>
  </tr>
  </thead>
  
 
  <tr>
    <td bgcolor="#CCCCCC"  width="500px"><strong>INSCRITOS
      </strong></td>
    <?php 
	$sum_insc=0;
	for($i=0;$i<$dias;$i=$i+31){ ?>
    
   
    <td> <?php 
		$anio= date('Y',strtotime($minf." +".$i."days"));
		$mes= date('m',strtotime($minf." +".$i."days"));
		
	  $datos= $control->totalInscritosFecha($fi['id'],$anio,$mes);
	 
	 $sum_insc=$sum_insc+$datos['inscritos'];
	 $chart_insc[]=$sum_insc;
	 echo $sum_insc;
	
	 
	 ?>
    </td>
    <?php } ?>
    
  </tr>
  
  <tr>
    <td bgcolor="#CCCCCC"  width="500px"><strong>CON PAGO</strong></td>
    <?php 
	$sum_pagos=0;
	$conpago=array();
	for($i=0;$i<$dias;$i=$i+31){ ?>
    
   
    <td><?php 
		$anio= date('Y',strtotime($minf." +".$i."days"));
		$mes= date('m',strtotime($minf." +".$i."days"));
		
		
		
	  $datos= $control->totalPagosFecha($fi['id'],$anio,$mes);
	  
	  
	  
	  	while ($di = mysql_fetch_array($datos, MYSQL_ASSOC)) {
			$conpago[]=$di['pagos'];
			
		}
		
		$conpago=array_unique($conpago);
	  
	  
	$sum_pagos = sizeof($conpago);
	 
	 $chart_pagos[]=$sum_pagos;
	 
	 $chart_potencial[]=$potencial;
	 echo $sum_pagos;
	  
	 
	 ?></td>
    <?php } ?>
    
  </tr>
  
  

  
                          </table>
                          
                          
                           
    <script type="text/javascript">
     
	    google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'MES');
      data.addColumn('number', 'INSCRITOS (Acumulado)');
      data.addColumn('number', 'PAGOS (Acumulado)');
	   data.addColumn('number', 'POTENCIAL');
	  
   
      data.addRows([
	  <?php 
	  $a=0;
	  foreach ($chart_mes as $mes){
	  echo "['".$mes."', ".$chart_insc[$a].",".$chart_pagos[$a].",".$chart_potencial[$a]."],";
	  $a++;
	  }
	  
	  
	  ?>
        
      ]);

      var options = {
        chart: {
          title: '<?php echo strtoupper($fi['grupo']); ?>'
        },
   
      };

      var chart = new google.charts.Line(document.getElementById('<?php echo "chart_".$fi['grupo']?>'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
	
	
       
    </script>
    
     <div id="<?php echo "chart_".$fi['grupo']?>" style="width: 100%; height: 300px"></div>
                            <?php } 
}
							}?>
                          </div>
                        
           				  <p>&nbsp;</p>
                          
                          			 
<h3><strong>CONSOLIDADO
<?php 

$chart_insc=array();
$chart_pagos=array();
$chart_mes=array();

?>
      </strong></h3>
                          <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
                          <thead>
  <tr>
    <th bgcolor="#CCCCCC" width="500px"><strong>Grupo</strong></th>
    <?php 
	$result=$control->maximaFechaViaje();
	
	$minf="2018-07-01";
	$maxf=$result['maxfecha'];
	
	$now = strtotime($maxf);// or your date as well
	$your_date = strtotime($minf);
	$datediff = $now - $your_date;

	$dias=floor($datediff / (60 * 60 * 24 ));
	
	?>
    
    <?php for($i=0;$i<$dias;$i=$i+31){ ?>
    <th bgcolor="#CCCCCC" style="font-size:70%" width="20px;" ><strong><?php echo  strftime("%b<br>%G",strtotime($minf." +".($i)."days"));
	
	$chart_mes[]=strftime("%b %G",strtotime($minf." +".($i)."days"));
	
	?></strong></th>
    <?php } ?>
  </tr>
  </thead>
  
 
  <tr>
    <td bgcolor="#CCCCCC"  width="500px"><strong>INSCRITOS
      </strong></td>
    <?php 
	$sum_insc=0;
	for($i=0;$i<$dias;$i=$i+31){ ?>
    
   
    <td> <?php 
		$anio= date('Y',strtotime($minf." +".$i."days"));
		$mes= date('m',strtotime($minf." +".$i."days"));
		
	  $datos= $control->totalInscritosFecha(0,$anio,$mes);
	 
	 $sum_insc=$sum_insc+$datos['inscritos'];
	 $chart_insc[]=$sum_insc;
	 echo $sum_insc;
	
	 
	 ?>
    </td>
    <?php } ?>
    
  </tr>
  
  <tr>
    <td bgcolor="#CCCCCC"  width="500px"><strong>PAGOS
      </strong></td>
    <?php 
	$sum_pagos=0;
	   $conpago = array();
	for($i=0;$i<$dias;$i=$i+31){ ?>
    
   
    <td> <?php 
		$anio= date('Y',strtotime($minf." +".$i."days"));
		$mes= date('m',strtotime($minf." +".$i."days"));
		
	
	
	
	
	  $datos= $control->totalPagosFecha(0,$anio,$mes);
	  
	 
	  
	  	while ($di = mysql_fetch_array($datos, MYSQL_ASSOC)) {
			$conpago[]=$di['pagos'];
			
		}
		
		$conpago=array_unique($conpago);
	  
	  
	$sum_pagos = sizeof($conpago);
	 
	 $chart_pagos[]=$sum_pagos;
	 
	 echo $sum_pagos;
	 
	 
	  
	 
	 ?>
    </td>
    <?php } ?>
    
  </tr>
  
  

  
                          </table>
                          
                          
                           
    <script type="text/javascript">
     
	    google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'MES');
      data.addColumn('number', 'INSCRITOS (Acumulado)');
      data.addColumn('number', 'PAGOS (Acumulado)');
	  data.addColumn('number', 'POTENCIAL');
	  
  
      data.addRows([
	  <?php 
	  $a=0;
	  foreach ($chart_mes as $mes){
	  echo "['".$mes."', ".$chart_insc[$a].",".$chart_pagos[$a].",".$potencial_total."],";
	  $a++;
	  }
	  
	  
	  ?>
        
      ]);

      var options = {
        chart: {
          title: '<?php echo strtoupper($fi['grupo']); ?>'
        },
   
      };

      var chart = new google.charts.Line(document.getElementById('<?php echo "chart_".$fi['grupo']?>'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
	
	
       
    </script>
    
     <div id="<?php echo "chart_".$fi['grupo']?>" style="width: 100%; height: 300px"></div>
                            
                           
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
