<?php include 'logged.php';?>
<?php include 'layout/header-user.php';
?>
<?php 
$documento = $_SESSION['doc'];
//var_dump($documento);
	

	
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'documento'){
		
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_documento.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_identidad",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	/*
	if(isset($_POST['paso']) && $_POST['paso'] == 'rut'){
		
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_rut.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_rut",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	*/
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'rut'){
	echo "******************* RUT *************";	
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_rut.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		
		echo $destino;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_rut",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	
	echo $status;
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'pasaporte'){
		
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_pasaporte.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_pasaporte",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'permiso'){
		
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {

		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_permiso.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_permiso",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'visa'){
		
	// obtenemos los datos del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	//print_r($_FILES);
	//var_dump($_FILES["archivo"]['name']);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_visa.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_visa",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	$viajero=$control->datosViajero($documento);
	$grupo=$control->datosProducto($viajero['id_grupo']);
$producto = $grupo;
		$email="";
	
	
	
	$email="El Viajero:".$viajero['nombres']." ".$viajero['apellidos']." del Grupo:".$grupo['grupo']." ha subido el archivo: ".$_POST['paso'];
	
	?>
  <div data-w-tab="Overview" class="dashboard-section w-tab-pane w--tab-active">
          <div class="container">
            <h3>Hola, <span><?php
				
				echo $viajero['nombres'];?></span> asi van tus cuotas:</h3>
            <div class="dash-row" >
				
				<div class="white-box">
                <div class="box-padding">
                  <table  border="0" bordercolor="#000000" cellpadding="10" cellspacing="5" id="list" width="100%" class="table-responsive tabla">
                    <thead>
                      <tr bgcolor="#02396C" style="color: #fff">
                        <th data-sortable="true" data-field="apellidos"><strong>NOMBRE </strong></th>
                        
                        <?php 
							
                                $total_programa_tarifabase=$producto['valor_aereo']+$producto['valor_terrestre'];
                                //var_dump($viajero);
								//CALCULO DE VALOR DEL PROGRAMA PARA ESTE VIAJERO
								$totalViaje=0;
								$valortk2= $control->valorViajeroTK($viajero['otro'],$producto);					
								$valorMtk2= $control->consultarModificaciones($viajero['id'],$producto['id'],'TK');
								$totalTK2=($valortk2+$valorMtk2);
					   			
								$valorpt2= $control->valorViajeroPT($viajero['otro'],$producto); 
								$valorMpt2= $control->consultarModificaciones($viajero['id'],$producto['id'],'PT'); 
					  			$totalPT2=($valorpt2+$valorMpt2);
								$totalViaje=$totalPT2+$totalTK2;
								//FIN VALOR PROGRAMA

                             
								?>
                        
                        <?php 
								 $calendario=$control->consultaCalendarioPagos($grupo['id']);
                                 $row_count = mysql_num_rows($calendario);

                                // var_dump($row_count);
                                 $price_adjustment = $totalViaje/$total_programa_tarifabase;
								  $pago=1;
								  $pagos=array();


								  
								while ($fi = mysql_fetch_array($calendario, MYSQL_ASSOC)) {
								  ?>
                        <th ><strong>PAGO <?php echo $pago;

                                    $pagado=array_sum($pagos);
                                    $cuota = round(($fi['aerea']+$fi['terrestre'])*$price_adjustment);
                                    if($pagado+$cuota>$totalViaje){
                                        $pagos[$pago]=$totalViaje-$pagado;
                                    }else{
                                        $pagos[$pago]=$cuota;
                                    }

									
									$fechaPagos[$pago]=$fi['fecha'];
									$pago++;
									
									?></strong></th>
                        <?php } 


								  var_dump($pagos);
								  ?>
                        <th ><strong>TOTAL PAGADO</strong></th>
                        <th ><strong>VLR PROGRAMA</strong></th>
                        <th ><strong>SALDO</strong></th>
                      
                      </tr>
                    </thead>
                    <?php 
							
							$sup_total=0;
							
							
													
	
	//$fi=$control->datosViajeroID($fi2['id_viajero']);
 
							?>
                    <tr>
                      <td style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;border-bottom: dashed 1px #000000;"><?php 
							  
							 
				
						
					$grupo=array($viajero['id']);
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
								echo "</td>";
								?>                      
                      
                      <?php
								
							}
							 
							  }
							  
							  ?>
                      <?php 
								//var_dump($grupo[0]);
								  $datviajero2= $control->datosViajeroID($grupo[0]);
									$valorpt= $control->pagosViajero($datviajero2['id']); 
							$cnt= $control->cantidadViajerosNit($datviajero2['id']); 
								
								$valorpt['viajeros']=$cnt['viajeros'];
						 // echo $valorpt['viajeros']."-";
						 
								$valorpt['pagosPT']=$valorpt['pagosPT']/$valorpt['viajeros'];
								$valorpt['pagosTIK']=$valorpt['pagosTIK']/$valorpt['viajeros'];
								
								$pagoTotal=$valorpt['pagosPT']+$valorpt['pagosTIK'];
								$tt=$pagoTotal;
							
								
											
								$acumuladoPay=0;
								//$pag=$pagoTotal;
									foreach($pagos as $pay) {
										
								  ?>
                      <td valign="middle" align="center" style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px; border-bottom: dashed 1px #000000;"><?php 
										$acumuladoPay=$acumuladoPay+$pay;
										
									if($pagoTotal>=$pay){
										echo $pay;
										$pagoTotal=$pagoTotal-$pay;
									}else if($pagoTotal!=0){
										echo $pagoTotal;
										$pagoTotal=$pagoTotal-$pagoTotal;
									} 
									
									?></td>
                      <?php }?>
                      <td style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;border-bottom: dashed 1px #000000;" align="center">

								<?php echo $tt;?></td>
                      <td style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;border-bottom: dashed 1px #000000;" align="center"><?php echo $totalViaje;?></td>
                      <td style="border-top: solid 2px #000000; border-left: solid 1px;
   								 border-right: solid 1px;border-bottom: dashed 1px #000000;" align="center"><?php echo $totalViaje-$tt;?></td>
                     
                    </tr>
                    
                 
                    
                  </table>
                </div>
              </div>
				
		    </div>
			<style>  @media screen and (max-width: 600px) {
  #cuotas {
    visibility: hidden;
    clear: both;
    float: left;
    margin: 10px auto 5px 20px;
    width: 28%;
    display: none;
  }
}
				</style>
			  <div class="dash-row"><a href="#" class="white-box progress-box w-inline-block"><div class="box-padding"><div class="progress-wrapper"><div class="progress-text-row" id="cuotas">
				  <?php foreach($pagos as $s=>$p){?>
				  <div class="progress-text-column"><div class="progress-icon" style="width: 90px!important;height: 60px !important;"><div>Cuota <?php echo $s;
												  setlocale(LC_TIME, 'es_ES.UTF-8');
												  
					  echo "<br><span style='font-size:10px;'>".strftime("%d %b",
						  strtotime( $fechaPagos[$s]))."</span>";
					  ?></div></div><div>$<?php echo $p ?></div></div>
				  <?php } ?>
				  </div><div class="progress-bar-wrap" style="height: 2em !important;text-align: center !important;color:#fff;"><div class="progress-bar" style="width: <?php 
					 // var_dump($tt);
					  echo (($tt/$totalViaje)*100)."%"; ?> !important;"><?php 
					 // var_dump($tt);
					  echo number_format(($tt/$totalViaje)*100,0)."%"; ?></div></div></div></div></a></div>
			  
				    <div class="dash-row">
				      <div class="white-box third">
                    <div class="box-padding">
				          <div class="colorful-icon green"></div>
				          <h3 class="large-number">
				         
				            <span ms-data="spend">
				              <?php 
								$vfalta=$totalViaje-$tt;
								if($vfalta <= 0){
									echo "Felicidades!";
								}else{
					  echo "$".number_format($vfalta,0)."<br>";
								}
					  ?>
			                </span></h3>
				          <div><?php if($vfalta <= 0){ echo "Has pagado todo<br>"; } else {echo "Te Falta<br>$".($totalPT2-$valorpt['pagosPT'])." TERRESTRE  - $".($totalTK2-$valorpt['pagosTIK'])." TIQUETE";} ?></div>
			            </div>
              </div>
				      <div class="white-box third">
				        <div class="box-padding">
				          <div class="colorful-icon green"></div>
				          <h3 class="large-number">
				         
				            <span ms-data="spend">
				              <?php 
						$trm=	$control->trmDIA(date("Y-m-d"));	
				//var_dump($trm);
					  echo "$".$trm."";
								
					  ?>
			                </span></h3>
				          <div>pesos/USD <br>TRM del Dia (<?php echo date("Y-m-d"); ?>)</div>
			            </div>
			          </div>
              <div class="white-box third mobile-full-box">
                <div class="box-padding">
                  <div class="colorful-icon green"></div>
                  <h3 class="large-number">$<?php echo number_format(ceil($trm*$vfalta)); ?></php></h3>
                  <div>Valor del Saldo TOTAL<br>
                    <small>Si vas a pagar en pesos HOY <?php echo date("Y-m-d"); ?></small></div>
                </div>
              </div>
			    <div class="white-box third">
                <div class="box-padding">
				
			      <div class="colorful-icon purple"></div> <h3>Liquidacion de Pago</h3>
			      <p>Seleccione las cuotas que desea pagar</p>
			      <p>
				 <p>
					 <?php 
					 $disponible = $tt;
					 $pagadocuota=0;
					 
					 foreach($pagos as $cuota => $valorPago){ 
						 //$pagadocuota+=$valorPago;
					 if($disponible<$valorPago){
					 
						 if($disponible>0){
							 $valorPago=$valorPago-$disponible;
							 $disponible=0;
						 }
					 ?>
					 <label class="el-switch el-switch-lg">
					<input type="checkbox" name="switch" checked id="cuota[<?php echo $cuota?>]"  class="cuotas" value="<?php echo $valorPago?>" onChange="calcularCuota()">
					<span class="el-switch-style"></span>
					</label>
					  <span class="margin-r"><strong>CUOTA <?php echo $cuota?>:</strong>$<?php echo $valorPago?></span>
				  </p>
					<?php }else{
						 $disponible-=$valorPago;
					 }
												 } ?>
					<script>
					function calcularCuota(){
						
						var checkboxes = document.getElementsByClassName('cuotas');
						
						var totalViaje=0;
						for(var index in checkboxes){
							//bind event to each checkbox
							if(checkboxes[index].checked ){
							//window.alert(checkboxes[index].value );
								totalViaje=totalViaje+parseFloat(checkboxes[index].value);
							}
							}
						document.getElementById('viajeDolares').innerHTML="$"+(totalViaje).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
						document.getElementById('enpesos').innerHTML="$"+(totalViaje*parseFloat(<?php echo $trm;?>)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
						document.getElementById('linkpago').href="registrar_pago_general.php?id=<?php echo $viajero['id']; ?>&trm_reg=<?php echo $trm; ?>&val_pt="+(totalViaje).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
						
					}
					</script>
					
					 Total:<h3 class="large-number" ><span id="viajeDolares">$<?php echo number_format(ceil($vfalta)); ?></span></h3>
					<p><strong>Valor en Pesos: <span id="enpesos">$<?php echo number_format(ceil($vfalta*$trm)); ?></span></strong><br>
				  <small>*Este valor en pesos esta liquidado a la TRM del día. Recuerde que si va a pagar en otra fecha debe volver a liquidar.</small></p>
				<?php 
					
					if($_SESSION['nivel']>2){ ?>	<p><a href="registrar_pago_general.php?id=<?php echo $viajero['id']; ?>&trm_reg=<?php echo $trm; ?>&val_pt=<?php echo number_format(ceil($vfalta)); ?>" target="_blank" id="linkpago">REGISTRAR PAGO</a></p><?php } ?>
			      </p> 
					   
                  
                </div>
              </div>
              <div class="white-box two-third">
                <div class="box-padding">
                      <div class="colorful-icon purple"></div> <h3>¿Cómo pagar en linea?</h3>
			            <?php if(strpos($producto['parametros'],';bancolombia') !== false){?>
					<h2>Boton PSE</h2>
					<p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p>&nbsp;</p>
               <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=3617" class="myButton" target="_blank">PAGUE AQUÍ</a></p>
          <p>.</strong></p>
					<?php } ?>
	  
	      <?php if(strpos($producto['parametros'],';bancobogota') !== false ){?>
					  <div id="accordion-pse" class="accordion-section-content">
						  <h2>Boton PSE</h2>
               <p>Esta opción esta habilitada, con cargo a su cuenta de ahorros o corriente de cualquier banco, sin  costo adicional. El Boton PSE permite hacer el pago de la totalidad de Tiquetes y Porción Terrestre. Si usted elige esta opción ingrese directamente al portal de pago a través del siguiente botón: </p>
               <p align="center">&nbsp;</p>
          <p align="center"><a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=2898

" class="myButton" target="_blank">PAGUE AQUÍ</a>          </p>
          <p align="center"> </strong></p>
					<?php } ?>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      


<?php include 'layout/footer-user.php';?>