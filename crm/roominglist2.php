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

$tipo='pagos';
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
                       <form id="form1" name="form1" method="post" action="roominglist2.php">
                         <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>"/>
                      <div id="table_wrapper">
                      
                      <?php 
					  $resultado=$control->inscritos($_REQUEST['id']);
							
							$min_fecha=new DateTime('2050-01-01');
							$max_fecha=new DateTime('0000-01-01');
							
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
											 //var_dump($fi);
											 
				$datviajero=$control->datosViajeroID($fi['id']);
							
							 
							 
		$datPrograma = $control-> datosProducto($datviajero['id_grupo']);
															  
															  if($datviajero['record']!=''){
																  $rec=$control->datosContratoRecord($datviajero['record']);
		
$fecha_INOK=new DateTime($rec['fecha_salida']);
																																  $fecha_OUTOK=new DateTime($rec['fecha_regreso']);
																  }else{
																  															   $fecha_INOK=new DateTime($datPrograma['f_salida']);
$fecha_OUTOK=new DateTime($datPrograma['f_llegada']);
//$fecha_OUTOK->modify("-1 day");						  

 }
									
				$interval= $min_fecha->diff($fecha_INOK);																					   			if($interval->format('%R%a')<0){
				$min_fecha=$fecha_INOK;
				};
				
				$interval= $max_fecha->diff($fecha_OUTOK);																					   			if($interval->format('%R%a')>0){
				$max_fecha=$fecha_OUTOK;
				};
								
							}
							
							echo $min_fecha->format('Y-m-d');
							echo $max_fecha->format('Y-m-d');
							
							$interval= $min_fecha->diff($max_fecha);	
							
							$dias= $interval->format('%a');
							
							
							$period = new DatePeriod(
     $min_fecha,
     new DateInterval('P1D'),
     $max_fecha);


					  
					  ?>
						  <style>
						
						  </style>
					                 <table  border="0" bordercolor="#000000" cellpadding="10" cellspacing="5" id="list" width="100%" class="table-responsive tabla">
					        <thead>
					          <tr bgcolor="#A3A3A3">
					            <th data-sortable="true" data-field="nombres"><strong>NO.</strong></th>
					             <?php if($tipo!="pagos"){?> <th ><strong>ACOMODACION</strong></th><?php }?>
					            <th ><strong>ACOMODACION</strong></th>
					           <?php if($tipo!="pagos"){?> <th ><strong>HABITACION</strong></th>
					            <th ><strong>TIPO HABITACIÓN</strong></th><?php }?>
				                <th data-sortable="true" data-field="apellidos"><strong>NOMBRES
                                </strong></th>
				                <th ><strong>TIPO PROGRAMA</strong></th>
				                <th ><strong>TIQUETE</strong></th>
								  <?php 
								 $calendario=$control->consultaCalendarioPagos($idgrupo);
								  $pago=1;
								  $pagos=array();
								  
								while ($fi = mysql_fetch_array($calendario, MYSQL_ASSOC)) {
								  ?>
				                <th ><strong>PAGO <?php echo $pago;
									$pagos[$pago]=($fi['aerea']+$fi['terrestre']);
									$pago++;
									
									?></strong></th>
								  <?php } 
								 // var_dump($pagos);
								  ?>
								    <?php if($tipo!="pagos"){?> 
                                 <th ><strong>SGL</strong></th>
				                <th ><strong>DBL</strong></th>
				                <th ><strong>TPL</strong></th>
				                <th ><strong>CPL</strong></th>
				                <th ><strong>CHD</strong></th>
				                <th ><strong>ENTRADA</strong></th>
				                <th ><strong>SALIDA</strong></th>
                                <th ><strong>NOCHES</strong></th>
			                    <?php 
								
							foreach($period as $date){
    echo '<th>'.$date->format("Y-m-d") . "</th>";
}
								
								?> 
                             
                                <th ><strong>TOTAL</strong></th>
								  <?php } 
								 // var_dump($pagos);
								  ?>
			                  </tr>
			                </thead>

					       <?php 
							
							$sup_total=0;
							
							
							$resultado=$control->roomingList($_REQUEST['id']);
							while ($fis = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							
	
	//$fi=$control->datosViajeroID($fi2['id_viajero']);
 $grupo=explode(";",$fis['viajeros']);
							?>
					        <tr>
					          <td rowspan="<?php echo sizeof($grupo)?>" valign="middle" align="center" style="border-bottom: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;"><?php echo strtoupper($fis['posicion']);?></td>
					           <?php if($tipo!="pagos"){?>  <td rowspan="<?php echo sizeof($grupo)?>" valign="middle" align="center"  style="border-bottom: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;"><?php echo "1x".sizeof($grupo).""?></td><?php } ?>
					          <td rowspan="<?php echo sizeof($grupo)?>" valign="middle" align="center"  style="border-bottom: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;" ><?php 
								if(sizeof($grupo)==1){
									echo "SENCILLA";
								}
								if(sizeof($grupo)==2){
									echo "DOBLE";
								}
								if(sizeof($grupo)==3){
									echo "TRIPLE";
								}if(sizeof($grupo)==4){
									echo "CUADRUPLE";
								}
								
								?></td >
					          <?php if($tipo!="pagos"){?> <td rowspan="<?php echo sizeof($grupo)?>" class="remover" id="<?php echo  $fis['habitacion']; ?>"  style="border-bottom: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;">
                            
                              <input type="text" name="habitacion[<?php echo $fis['posicion']?>]" id="habitacion[<?php echo $fis['posicion']?>]" value="<?php echo  $fis['habitacion']; ?>"></td>
								
					           <td rowspan="<?php echo sizeof($grupo)?>" class="remover" id=""  style="border-bottom: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;">
                                 <select name="tipohabitacion[<?php echo $fis['posicion']?>]" id="tipohabitacion[<?php echo $fis['posicion']?>]">
								 
                                 <?php 
								 if($fis['id_habitacion']==0){
								 ?>
                                 <option value="" disabled selected>Seleccione</option>
                                 <?php } ?>
								 <?php 
								 $resultado2=$control->tiposHabitaciones();
							while ($fid = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
									
								 ?>
                                 
                                   <option value="<?php  echo $fid['id'];?>" <?php  if($fis['id_habitacion']==$fid['id']){ echo "selected"; $hot="".$fid['hotel']."".$fid['tipo'];} ?>><?php  echo $fid['hotel'];?>-<?php  echo $fid['tipo'];?></option>
                                   <?php } ?>
                               </select></td><?php }?>
					          <td style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;"><?php 
							  
							 
				
						
					$grupo=explode(";",$fis['viajeros']);
							  $pax=0;
							  $adultos=0;
							  $ninos=0;
							  $c=0;
							  foreach ($grupo as $n=>$viajero2){
								  $pax++;
							  $datviajero2= $control->datosViajeroID($viajero2);
							 $ed=$control->edad($datviajero2['fnacimiento'],$datviajero2['id_grupo']);
							 
							 
							 if($ed > 12){
							 $adultos++;
							 }else{
							 $ninos++;
							 }
							  
						
							  	
							 
							 
							if($c==0){
							 echo $datviajero2['nombres']." ".$datviajero2['apellidos']." "; $c++;
								echo "</td><td style='border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;'>".$datviajero2['otro']."</td>";
								?>
								  	<td style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;"><?php if($datviajero2['record']!=''){
																  $rec=$control->datosContratoRecord($datviajero2['record']);
																  echo $rec['nombre'];
																 
																  }else{
																	  $rec=$control->sillaPrincipalPrograma($datPrograma['id']);
										  echo $rec['nombre'];
																	  }?></td>
								  <?php
								
							}
							 
							  }
							  
							  ?>
								    <?php 
									$valorpt= $control->pagosViajero($datviajero2['id']); 
							$cnt= $control->cantidadViajerosNit($datviajero2['id']); 
								
								$valorpt['viajeros']=$cnt['viajeros'];
						 // echo $valorpt['viajeros']."-";
						 
								$valorpt['pagosPT']=$valorpt['pagosPT']/$valorpt['viajeros'];
								$valorpt['pagosTIK']=$valorpt['pagosTIK']/$valorpt['viajeros'];
								
								$pagoTotal=$valorpt['pagosPT']+$valorpt['pagosTIK'];
							
											
								$acumuladoPay=0;
								//$pag=$pagoTotal;
									foreach($pagos as $pay) {
										
								  ?>
								
								<td valign="middle" align="center" style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;">
									<?php 
										$acumuladoPay=$acumuladoPay+$pay;
										
									if($pagoTotal>=$pay){
										echo $pay;
										$pagoTotal=$pagoTotal-$pay;
									}else if($pagoTotal!=0){
										echo $pagoTotal;
										$pagoTotal=$pagoTotal-$pagoTotal;
									} 
									
									?>
									
									
								
								</td>
							
								<?php }?>
								<?php if($tipo!="pagos"){?>
                               <td rowspan="<?php echo sizeof($grupo)?>" valign="middle" align="center" style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;"><?php if($adultos == 1){ echo "1";} ?></td>
                              
					          <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php if($adultos == 2){ echo "1";} ?></td>
					          <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php if($adultos == 3){ echo "1";} ?></td>
					          <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php if($adultos == 4){ echo "1";} ?></td>
					          <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php echo $ninos?></td>
					          <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php 
							  
							  $datPrograma = $control-> datosProducto($datviajero['id_grupo']);
															  
															  if($datviajero['record']!=''){
																  //var_dump($datviajero['record']);
																  $rec=$control->datosContratoRecord($datviajero['record']);
																  
																  echo
date_format(date_create($rec['fecha_salida']),"d-m-Y");
$fecha_INOK=$rec['fecha_salida'];
																  
																  }else{
																   echo date_format(date_create($datPrograma['f_salida']),"d-m-Y");
																   $fecha_INOK=$datPrograma['f_salida'];
																   }?></td>
					          <td rowspan="<?php echo sizeof($grupo)?>" style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;"><?php if($datviajero['record']!=''){
																  $rec=$control->datosContratoRecord($datviajero['record']);
																  
																  echo date_format(date_create($rec['fecha_regreso']),"d-m-Y");
																  $fecha_OUTOK=$rec['fecha_regreso'];
																  }else{
																	  echo date_format(date_create($datPrograma['f_llegada']),"d-m-Y");
																	  $fecha_OUTOK=$datPrograma['f_llegada'];
																	  }?></td>
              <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php 
															    $salida = new DateTime($fecha_INOK);
					$llegada = new DateTime($fecha_OUTOK);
					
     $datediff = strtotime($fecha_OUTOK)-strtotime($fecha_INOK);
     $dias= floor($datediff/(60*60*24));
	 
	 echo ($dias);
															  ?></td>                                                            <?php 
							$totalhab=0;
								
							foreach($period as $date){
    echo '<td rowspan="'.sizeof($grupo).'" style="border-left: solid 1px;
   								 border-right: solid 1px;">';
	
	$tipohab=$fis['id_habitacion'];
	$fechacalc=$date->format('Y-m-d');
	
	$val=0;
	
	if($adultos == 1){
	$val=$val+$control->valorHabitacion($tipohab,$fechacalc,"SGL");
	}else if($adultos == 2){
	$val=$val+$control->valorHabitacion($tipohab,$fechacalc,"DBL");
	}
	else if($adultos == 3){
	$val=$val+$control->valorHabitacion($tipohab,$fechacalc,"TPL");
	}
	else if($adultos == 4){
	$val=$val+$control->valorHabitacion($tipohab,$fechacalc,"CPL");
	}
								
   /*else if($adultos >2){
	$val=$val+$control->valorHabitacion($tipohab,$fechacalc,"DBL");
	$val=$val+(($adultos-2)*$control->valorHabitacion($tipohab,$fechacalc,"EXT"));
	}*/
	
	if($ninos > 0){
		$val=$val+($ninos*$control->valorHabitacion($tipohab,$fechacalc,"CHD"));
	
	}
	$totalhab=$totalhab+$val;
	
	echo "$".$val;
	echo '</td>';
}
								
								?>
                                                                      
					          <td rowspan="<?php echo sizeof($grupo)?>"  style="border-bottom: solid 2px #000000"><?php 
						
		$sup_total=$sup_total+$totalhab;													    echo "$".$totalhab;
															  ?></td><?php }?>
					          </tr>
                              <?php for($i=1;$i<sizeof($grupo);$i++){?>
					        <tr>
					         
					          <td><?php 
							  
							 
				$datviajero=$control->datosViajeroID($grupo[$i]);
							
		 						 
							 
							
							 echo $datviajero['nombres']." ".$datviajero['apellidos']."";
							  echo "</td><td style=' border-left: solid 1px;
   								 border-right: solid 1px;'>".$datviajero['otro']."</td>";
							  ?>
								  		
								  	<td style="border-left: solid 1px;
   								 border-right: solid 1px;"><?php if($datviajero['record']!=''){
																  $rec=$control->datosContratoRecord($datviajero['record']);
																  echo $rec['nombre'];
																 
																  }else{
																	  $rec=$control->sillaPrincipalPrograma($datPrograma['id']);
										  echo $rec['nombre'];
																	  }?></td>
							
								  
								      <?php 
									$valorpt= $control->pagosViajero($datviajero['id']); 
							$cnt= $control->cantidadViajerosNit($datviajero['id']); 
								
								$valorpt['viajeros']=$cnt['viajeros'];
						 // echo $valorpt['viajeros']."-";
						 
								$valorpt['pagosPT']=$valorpt['pagosPT']/$valorpt['viajeros'];
								$valorpt['pagosTIK']=$valorpt['pagosTIK']/$valorpt['viajeros'];
								
								$pagoTotal=$valorpt['pagosPT']+$valorpt['pagosTIK'];
							
											
								$acumuladoPay=0;
									foreach($pagos as $pay) {
										
								  ?>
								
								<td valign="middle" align="center" style="border-left: solid 1px;
   								 border-right: solid 1px;">
									<?php 
										$acumuladoPay=$acumuladoPay+$pay;
										
									if($pagoTotal>=$pay){
										echo $pay;
										$pagoTotal=$pagoTotal-$pay;
									}else if($pagoTotal!=0){
										echo $pagoTotal;
										$pagoTotal=$pagoTotal-$pagoTotal;
									} 
									 ?>
									
									
								
								</td><?php }?>
					        
					          </tr>
                              <?php  } ?>
					        <?php } ?>
                            
                           
				          </table> 
                          </div>
                          <p>GRAN TOTAL: $<?php echo $sup_total;?></p>
                          <p>
                            <input type="submit" value="Guardar">
                          </p>
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
