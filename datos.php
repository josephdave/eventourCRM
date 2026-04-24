<?php include 'logged.php';?>
<?php include 'layout/header-user.php';
?>
<?php 
if(isset($_REQUEST['idcd'])){
	$_SESSION['doc']= $_REQUEST['idcd'];
}
$documento = $_SESSION['doc'];
	

	
	
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
            <h3>Bienvenido(a), <span><?php
				
				echo $viajero['nombres'];?></span>!</h3>
            <div class="dash-row">
				
				<div class="white-box two-third">
                <div class="box-padding">
                  <div class="w-embed w-script">
					  
                    <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;border: 0px;border-color: #fff;" class="tabla-datos">
  <tr>
    <td ><strong>Nombre de quien viaja:</strong></td>
    <td><?php
		  //$producto = $datosproducto;
									  $nitviajero=$viajero['facturacion_nodocumento'];
									  $viajeroNIT=$control->listaViajeros($nitviajero,$viajero['id_grupo']);
									  $totalTK=0;
									  $totalPT=0;
									  $viaj="";
									  
									  $totalAbonoTK=0;
									  $totalAbonoPT=0;
									  
									  while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
										  
						$viaj=$viaj." ".$di['nombres']." ".$di['apellidos'];
							if($di['estado']=="NO VIAJA"){	
							$viaj=$viaj." (NO VIAJA)";
							}
										  $viaj=$viaj." - ";
						
						//var_dump($di['nombres']);
									
										  //var_dump($di['nombres']);
						if($di['estado']=="VIAJA"){				  
						$valortk= $control->valorViajeroTK($di['otro'],$producto); 
					
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
								}else{
								$valortk= 0; 
					
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= 0; 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
						}
					  }
					  
	
	 echo $viaj; ?>     </td>
    </tr>
  <tr>
    <td ><strong>Celular:</strong></td>
    <td><?php echo $viajero['celular']; ?></td>
    </tr>
  <tr>
    <td ><strong>Documento Facturación:</strong></td>
    <td><?php echo $viajero['facturacion_nodocumento'] ?></td>
    </tr>
  <tr>
    <td ><strong>Grupo:</strong></td>
    <td><?php echo $control->nomGrupo($viajero['id_grupo'])." ".$viajero['otro'];?></td>
    </tr>
  <tr>
    <td ><strong>Valor Tiquetes:</strong></td>
    <td> <?php 
						
						  
						  //echo $valorMtk;
						  
						 ?>
      
      
      <?php   echo $producto['MONEDA']." ".($totalTK);?></td>
    </tr>
  <tr>
    <td ><strong>Valor Terrestre:</strong></td>
    <td><?php 
						  
						 ?>
      <?php   echo $producto['MONEDA']." ".($totalPT);?></td>
    </tr>
                    </table>
                  </div>
                </div>
              </div>
				<div class="white-box third">
                <div class="box-padding">
                  <div class="colorful-icon green"></div>
                  <h3 class="large-number">
					  <?php
					  				  $nitviajero=$viajero['facturacion_nodocumento'];
									  $viajeroNIT=$control->listaViajeros($nitviajero,$viajero['id_grupo']);
					 
									  $totalTK=0;
									  $totalPT=0;
									  $viaj="";
									  
									  $totalAbonoTK=0;
									  $totalAbonoPT=0;
									  
									  while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
										  
								  
						$viaj=$viaj." ".$di['nombres']." ".$di['apellidos'];
							if($di['estado']=="NO VIAJA"){	
							$viaj=$viaj." (NO VIAJA)";
							}
										  $viaj=$viaj." - ";
						
						//var_dump($di['nombres']);
									
										  //var_dump($di['nombres']);
						if($di['estado']=="VIAJA"){				  
						$valortk= $control->valorViajeroTK($di['otro'],$producto); 
					
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
								}else{
								$valortk= 0; 
					
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= 0; 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
							
						}
					  }
					   ?>
					  $<span><?php $v_total=$totalPT+$totalTK;
					  echo number_format($v_total,0);
					  ?></span></h3>
                  <div>Valor total de tu viaje</div>
                </div>
              </div>
		    </div>
				    <div class="dash-row">
				      <div class="white-box third">
                <div class="box-padding">
                  <div class="colorful-icon green"></div>
                  <h3 class="large-number">$
					  <?php 
					   
							
							$totaltik=0;
							$totalpt=0;
                      $totalTikSinval=0;
                      $totalPTSinval=0;
                      
							
							$resultado=$control->pagosHistorialViajeroNIT($viajero['facturacion_nodocumento'],$producto['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							
                        $fechapago= $fi['fecha'];
           				    $totaltik+=$fi['valor_TIK'];
                                $totalpt+=$fi['valor_PT'];
							 if($fi['validado'] == 0){$totalTikSinval+= $fi['valor_TIK'];}
						
           				      
							if($fi['validado'] == 0){ $totalPTSinval+= $fi['valor_PT']; }
           				  
							}
           				      
					  ?>
					  <span ms-data="spend"><?php $v=$totalpt+$totaltik;
					  echo number_format($v,0);
					  ?></span></h3>
                  <div>Has Pagado
                   <?php
                      $totalEnValidacion= $totalTikSinval+  $totalPTSinval;
                      if($totalEnValidacion >0){echo ' <br/>Valor en validación:'. number_format($totalEnValidacion,0);} ?></div>
                </div>
              </div>
				      <div class="white-box third">
				        <div class="box-padding">
				          <div class="colorful-icon green"></div>
				          <h3 class="large-number">
				         
				            <span ms-data="spend">
				              <?php 
								$vfalta=$v_total-$v;
								if($vfalta <= 0){
									echo "Felicidades!";
								}else{
					  echo "$".number_format($v_total-$v,0)."<br>";
								}
					  ?>
			                </span></h3>
				          <div><?php if($vfalta <= 0){ echo "Has pagado todo"; } else {echo "Te Falta";} ?></div>
			            </div>
			          </div>
              <div class="white-box third mobile-full-box">
                <div class="box-padding">
                  <div class="colorful-icon purple"></div>
                  <h3 class="large-number"><?php echo $fechapago; ?></php></h3>
                  <div>Fecha Ultimo Pago</div>
                </div>
              </div>
              <div class="white-box two-third">
                <div class="box-padding">
                  <div class="w-embed w-script">
					   <div class="colorful-icon purple"></div> <h3>Tu Historial de Pagos</h3> <table  border="1" cellspacing="0" cellpadding="2" style="font-size:13px;border: 0px;border-color: #fff;" class="tabla-datos" width="100%" >
           				    <thead>
           				      <tr>
           				      <th>Id</th>
           				      <th>Fecha de Pago</th>
           				      <th>Abono TIK</th>
           				      <th>Abono PT</th>
           				      <th>Fee</th>
           				      <th>TRM</th>
           				      <th>Medio</th>
           				      <th>Recibo No.</th>
							</tr>
       				      </thead>
                            <tbody>
                            <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->pagosHistorialViajeroNIT($viajero['facturacion_nodocumento'],$producto['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?><tr>
                           
           				      <td>ID PAGO:<?php echo $fi['id'];?></td>
           				      <td><?php echo $fi['fecha'];?></td>
                              <?php 
							  
							  
							  
							  ?>
           				      <td><?php 
							 if($fi['validado'] == 1){ $totaltik+=$fi['valor_TIK'];}
							 echo $fi['valor_TIK'];?></td>
           				      <td><?php 
							if($fi['validado'] == 1){ $totalpt+=$fi['valor_PT'];}?> 
                            
                            <?php 		  
							  echo $fi['valor_PT'];?></td>
           				      <td><?php echo $fi['fee'];?></td>
           				      <td><?php echo $fi['trm'];?></td>
           				      <td><?php echo $fi['medio'];?></td>
           				      <td><?php echo $fi['recibo_caja'];?></td>
           				      </tr> <?php } ?>
                           </tbody>
         				    </table>
                  </div>
                </div>
              </div>
              <div class="white-box third">
                <div class="box-padding">
					 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Valor', 'Pagado'],
          ['Pagado',    <?php echo $v;?>],
          ['Pendiente',      <?php echo $vfalta;?>]
        ]);

        var options = {
          title: 'MI PROGRESO',
          pieHole: 0.4,
			legend: {position: 'none'},
			 slices: {
            0: { color: 'blue' },
            1: { color: 'gray' }
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
                  <div class="w-embed w-script">  <div id="donutchart" style="width: 100%; height: 250px;"></div>
                  
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      


<?php include 'layout/footer-user.php';?>