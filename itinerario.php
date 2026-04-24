<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

setlocale(LC_TIME,"es_ES.UTF-8");

	//error_reporting(0);

if(isset($_REQUEST['viajero'])){
	
	if(isset($_REQUEST['actividad_check'])){
	$check = 1;
	}else{
	$check = -1;
	}
$mensaje=$control->checkActividad($_REQUEST['viajero'],$_REQUEST['actividad'],$check);

}


$programa=$control->datosProducto($_REQUEST['grupo']);

?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
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
					<div class="panel-heading">ACTIVIDADES EN VIAJE</div>
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="asc" class="table table-hover">
					    <thead>
					      <tr>
					        <th>DIA</th>
					        <th data-sortable="true"><strong>MAÑANA</strong></th>
					        <th><p><strong>TARDE</strong></p></th>
                            
                           
                            
					    
			            </thead>
					    
					      <?php 
						  
						  $min_fecha= new DateTime($programa['f_salida']);
						    $max_fecha= new DateTime($programa['f_llegada']);
						  
						//echo $min_fecha->format('Y-m-d');
							//echo $max_fecha->format('Y-m-d');
							
							
							
							
							$interval= $min_fecha->diff($max_fecha);	
							
							$dias= $interval->format('%a');
							
							
							$period = new DatePeriod(
     $min_fecha,
     new DateInterval('P1D'),
     $max_fecha->add(new DateInterval('P1D')));
	
						 
						  
								
							foreach($period as $date){
								?>
    <tr><td><?php 
	echo strftime("%A", $date->getTimestamp());
	echo " ".$date->format("d") ?></td><td>
    <?php 
	
	$resultado=$control-> consultaServiciosDia($programa['id'],$date->format("Y-m-d"));
	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {       $f=strtotime($fi['fecha']);
		if(date("A",$f) == "AM"){
			echo "<strong>".$fi['nombre']."</strong>";
		echo "<br>".date("h:i a",$f)."<br/>";
		}
		
		}
	
	?>
    
    
    </td><td> <?php 
	
	$resultado=$control-> consultaServiciosDia($programa['id'],$date->format("Y-m-d"));
	
		while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {       $f=strtotime($fi['fecha']);
		if(date("A",$f) == "PM"){
			echo "<strong>".$fi['nombre']."</strong>";
		echo "<br>".date("h:i a",$f)."<br/>";
		}
		
		}
	
	?></td></tr>
    <?php
}
								
								
						
						 ?>
                        
				        
                        
					    <tfoot>
				      </table>
                      <?php 						 // var_dump($totales); ?>
					  <p>&nbsp;</p>
				  </div>
                                                        </div>
                                                                                    </div>
       
           				  </div>
           				</div>
                        </div>
    </body>
