<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
	//
	
	 $habitaciones = $_REQUEST['habitacion'];
  if(isset($habitaciones)){
	$resultado=$control->registrarHabitaciones($habitaciones,$idgrupo);
}

 $tipohabitaciones = $_REQUEST['tipohabitacion'];
  if(isset($tipohabitaciones)){
	$resultado=$control->registrartipoHabitaciones($tipohabitaciones,$idgrupo);
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> ROOMING LIST</h3>
       				      
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
                       <form id="form1" name="form1" method="post" action="roominglist.php">
                         <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>"/>
                      <div id="table_wrapper">
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="posicion" data-sort-order="desc">
					        <thead>
					          <tr>
					            <th data-sortable="true" data-field="nombres"><strong>NO.</strong></th>
					            <th >HABITACION</th>
					            <th >TIPO HABITACIÓN</th>
				                <th data-sortable="true" data-field="apellidos"><strong>NOMBRES
                                </strong> </th>
				                <th >SGL</th>
				                <th >DBL</th>
				                <th >TPL</th>
				                <th >CPL</th>
				                <th >CHD</th>
				                <th ><strong>ENTRADA</strong></th>
				                <th >SALIDA</th>
				                <th >NOCHES</th>
				                <th >TOTAL</th>
				                <th >ADULTOS</th>
				                <th >MENORES</th>
                                </tr>
			                </thead>

					       <?php 
							
							$resultado=$control->roomingList($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							
	
	//$fi=$control->datosViajeroID($fi2['id_viajero']);

							?>
					        <tr>
					          <td><?php echo strtoupper($fi['posicion']);?></td>
					           <td class="remover" id="<?php echo  $fi['habitacion']; ?>">
                            
                              <input type="text" name="habitacion[<?php echo $fi['posicion']?>]" id="habitacion[<?php echo $fi['posicion']?>]" value="<?php echo  $fi['habitacion']; ?>"></td>
					           <td class="remover" id="">
                                 <select name="tipohabitacion[<?php echo $fi['posicion']?>]" id="tipohabitacion[<?php echo $fi['posicion']?>]">
								 
                                 <?php 
								 if($fi['id_habitacion']==0){
								 ?>
                                 <option value="" disabled selected>Seleccione</option>
                                 <?php } ?>
								 <?php 
								 $resultado2=$control->tiposHabitaciones();
							while ($fid = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
									
								 ?>
                                 
                                   <option value="<?php  echo $fid['id'];?>" <?php  if($fi['id_habitacion']==$fid['id']){ echo "selected";} ?>><?php  echo $fid['hotel'];?>-<?php  echo $fid['tipo'];?></option>
                                   <?php } ?>
                               </select></td>
					          <td><?php $grupo=explode(";",$fi['viajeros']);
							  $pax=0;
							  $adultos=0;
							  $ninos=0;
							  foreach ($grupo as $viajero){
								  $pax++;
							  $datviajero= $control->datosViajeroID($viajero);
							 $ed=$control->edad($datviajero['fnacimiento'],$datviajero['id_grupo']);
							 
							 
							 if($ed > 12){
							 $adultos++;
							 }else{
							 $ninos++;
							 }
							  
							 echo $datviajero['nombres']." ".$datviajero['apellidos']."<br/>";
							  }
							  ?></td>
					          <td><?php if($adultos == 1){ echo "1";} ?></td>
					          <td><?php if($adultos == 2){ echo "1";} ?></td>
					          <td><?php if($adultos == 3){ echo "1";} ?></td>
					          <td><?php if($adultos == 4){ echo "1";} ?></td>
					          <td><?php echo $ninos?></td>
					          <td><?php 
							  
							  $datPrograma = $control-> datosProducto($datviajero['id_grupo']);
															  
															  if($datviajero['record']!=''){
																  $rec=$control->datosContratoRecord($datviajero['record']);
																  
																  echo
date_format(date_create($rec['fecha_salida']),"d-m-Y");
$fecha_INOK=$rec['fecha_salida'];
																  
																  }else{
																   echo date_format(date_create($datPrograma['f_salida']),"d-m-Y");
																   $fecha_INOK=$datPrograma['f_salida'];
																   }?></td>
					          <td><?php if($datviajero['record']!=''){
																  $rec=$control->datosContratoRecord($datviajero['record']);
																  
																  echo date_format(date_create($rec['fecha_regreso']),"d-m-Y");
																  $fecha_OUTOK=$rec['fecha_regreso'];
																  }else{
																	  echo date_format(date_create($datPrograma['f_llegada']),"d-m-Y");
																	  $fecha_OUTOK=$datPrograma['f_llegada'];
																	  }?></td>
					          <td><?php 
															    $salida = new DateTime($fecha_INOK);
					$llegada = new DateTime($fecha_OUTOK);
					
     $datediff = strtotime($fecha_OUTOK)-strtotime($fecha_INOK);
     $dias= floor($datediff/(60*60*24));
	 
	 echo ($dias);
															  ?></td>
					          <td>
                              
                               <?php 
	
	
	$minf=$fecha_INOK;	
	$maxf=$fecha_OUTOK;
	
	$now = strtotime($maxf);// or your date as well
	$your_date = strtotime($minf);
	$datediff = $now - $your_date;

	$dias=floor($datediff / (60 * 60 * 24));
	
	?>
    
    <?php for($i=0;$i<$dias;$i++){ ?>
   
    <?php echo  strftime("%e %b",strtotime($minf." +".$i."days"))?></strong>
    <?php } ?>
                              </td>
					          <td><?php echo $adultos ?></td>
					          <td><?php echo $ninos ?></td>
                              </tr>
					        <?php } ?>
                            
                           
				          </table> 
                          </div>
                          <input type="submit" value="Guardar">
                           </form>                         
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
