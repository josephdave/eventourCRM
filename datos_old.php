<?php include 'logged.php';?>
<?php include 'layout/header2.php';

require('MailSendRegistro.php');
?>


<?php 


$documento = $_REQUEST['doc'];
	

	
	
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
		$email="";
	
	
	
	$email="El Viajero:".$viajero['nombres']." ".$viajero['apellidos']." del Grupo:".$grupo['grupo']." ha subido el archivo: ".$_POST['paso'];
	
	?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">DATOS VIAJERO </div>
					<div class="panel-body">
           				  <div class="module-body">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="70%"><div class="chart inline-legend grid" >
      <?php if(isset($status)){
		  
/*		  $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://www.emedia.co/mail/Send_Mail_EV.php?destino=info@eventoursport.com&key=1as12321sdsadaa2&asunto=Viajero%20Subio%20Documento&mensaje=".urlencode($email)); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch); 
	*/
		sendEmailTransaccional("info@eventours.travel","Nuevo documento de viajero subido",$email);
		  
		  
		   } ?>
      <form action="#" method="post" class="form-horizontal row-fluid" id="registro">
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Grupo</strong>:</label>
          <div class="controls"><?php echo strtoupper($control->nomGrupo($viajero['id_grupo']));?></div>
        </div> <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Nombres</strong>:</label>
          <div class="controls"><?php echo $viajero['nombres'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Apellidos</strong>:</label>
          <div class="controls"><?php echo $viajero['apellidos'] ?></div>
        </div>
        
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Documento</strong>:</label>
          <div class="controls"><?php echo $viajero['documento'] ?> <?php echo $viajero['no_documento'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput5"><strong>Fecha</strong> <strong>Nacimiento</strong>:</label>
          <div class="controls"><?php echo $viajero['fnacimiento'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput6"><strong>email</strong>:</label>
          <div class="controls"><?php echo $viajero['email'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput7"><strong>Telefono:</strong></label>
          <div class="controls"><?php echo $viajero['telefono'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput8"><strong>Celular:</strong></label>
          <div class="controls"><?php echo $viajero['celular'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput9"><strong>Pasaporte</strong>:</label> 
          <div class="controls"><?php echo $viajero['pasaporte'] ?></div>
        </div>
       
        <div class="control-group">
          <label class="control-label" for="facdireccion" style="text-transform:uppercase"><strong>Contacto Emergencia / Acudiente</strong></label>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Nombre</strong></label>
          :
          <div class="controls"><?php echo strtoupper($viajero['acudiente1_nombre']) ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Apellidos</strong></label>
          :
          <div class="controls"><?php echo strtoupper($viajero['acudiente1_apellido']) ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Telefono</strong></label>
          :
          <div class="controls"><?php echo $viajero['acudiente1_telefono'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>email</strong></label>
          :
          <div class="controls"><?php echo $viajero['acudiente1_email'] ?></div>
        </div>
        
        <?php if( $viajero['acudiente2_nombre'] !=""){?>
         <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>ACUDIENTE 2</strong></label>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Nombre:</strong></label>
          :
          <div class="controls"><?php echo $viajero['acudiente2_nombre'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Apellidos:</strong></label>
          :
          <div class="controls"><?php echo $viajero['acudiente2_apellido'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Telefono</strong></label>
          :
          <div class="controls"><?php echo $viajero['acudiente2_telefono'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>email</strong></label>
          :
          <div class="controls"><?php echo $viajero['acudiente2_email'] ?></div>
        </div>
        <?php } ?>
        <div class="control-group">
          <label class="control-label" for="basicinput4"><strong>DATOS DE FACTURACIÓN</strong></label>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Nombre:</strong></label>
          <div class="controls"><?php echo $viajero['facturacion_nombre'] ?></div>
        </div>
       
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong> Documento</strong></label>
          <strong> :</strong>
          <div class="controls"><?php echo $viajero['facturacion_nodocumento'] ?><?php echo $viajero['facturacion_documento'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput5"><strong>Direccion</strong></label>
          :
          <div class="controls"><?php echo $viajero['facturacion_direccion'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput2"><strong>email</strong></label>
          <div class="controls"><?php echo $viajero['facturacion_email'] ?></div>
        </div>
        <p> 
<?php 

if($viajero['facturacion_documento'] == "NIT"){
$c = "N";
}else{
$c = "C";
}


$ap = explode(" ",trim($viajero['facturacion_nombre']));

if(count($ap) > 3){
$ap[0]=$ap[0]." ".$ap[1];
$ap[1]=$ap[2];
$ap[2]=$ap[3];
}

$linea=$viajero['facturacion_nodocumento'].";".$ap[1].";".$ap[2].";".$ap[0].";".$viajero['nombres']." ".$viajero['apellidos']." ".$control->nomGrupo($viajero['id_grupo']).";".$viajero['facturacion_direccion'].";".$viajero['telefono'].";".$viajero['celular'].";".$viajero['facturacion_email'].";$c;"; ?>        
       <?php if($_SESSION['id'] != ""){?> <button type="button" data-clipboard-text="<?php echo $linea?>">Copiar Tercero</button></p>
      <?php } ?></form>
    </div></td>
    <td valign="top"><div class="chart inline-legend grid" style="padding:10px;">
    <table width="100%" border="0" cellspacing="2px" cellpadding="2px">
    <tr>
    <td colspan="2" bgcolor="#FFF"><h2 style="color:#000">OPCIONES:</h2>
    <p>  <a href="http://eventoursport.travel/crm/registro.php?plan=<?php echo $viajero['id_grupo'];?>&ac=<?php echo $documento ?>" target="_blank">Registrar Acompañante</a></p>
    </td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#000066"><h2 style="color:#FFF">DOCUMENTOS:</h2></td>
    </tr>
  <tr>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#006699" style="color:#FFF"><strong>Cedula / Contrase&ntilde;a o Registro Civil</strong></td>
    </tr>
  <tr>
    <td colspan="2"><p><strong>Documento Subido:</strong>
      <?php  if(file_exists("documentos/".$viajero['doc_identidad']) && $viajero['doc_identidad'] != ""){ echo '<a href="documentos/'.$viajero['doc_identidad'].'" target="_blank">Ver Documento</a>'; 
	}else
{ echo "N/A"; }?>
    </p></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="datos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion3"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula3"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="doc" value="<?php echo $viajero['no_documento']; ?>">
        <input name="paso" type="hidden" id="paso" value="documento">
        <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
        <br>
        <input type="submit" name="button2" id="button2" value="Subir">
      </div>
    </form></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#006699" style="color:#FFF"><span class="control-group">
      <strong>Pasaporte</strong>
    </span></td>
    </tr>
  <tr>
    <td colspan="2">Pasaporte Subido: 
      <?php  if(file_exists("documentos/".$viajero['doc_pasaporte']) && $viajero['doc_pasaporte'] != ""){ echo '<a href="documentos/'.$viajero['doc_pasaporte'].'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; } ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="datos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion4"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula4"></label>
        <input type="file" name="archivo" id="archivo">
         <input name="doc" type="hidden" id="doc" value="<?php echo $viajero['no_documento']; ?>">
        <input name="paso" type="hidden" id="paso" value="pasaporte">
         <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
        <br>
        <input type="submit" name="button" id="button" value="Subir">
      </div>
    </form></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#006699" style="color:#FFF">Permiso de Salida</td>
    </tr>
  <tr>
    <td><strong>Permsio Subido</strong>
      :
        <?php  if(file_exists("documentos/".$viajero['doc_permiso']) && $viajero['doc_permiso'] != ""){ echo '<a href="documentos/'.$viajero['doc_permiso'].'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; }?>
        <br>
       <a href="https://eventoursport.travel/crm/impresion/pdf/permiso_pdf.php?firma=<?php echo$viajero['no_documento'];?>" target="_blank">Descargar Formato</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="datos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion6"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula6"></label>
        <input type="file" name="archivo" id="archivo">
          <input name="doc" type="hidden" id="doc" value="<?php echo $viajero['no_documento']; ?>">
        <input name="paso" type="hidden" id="paso" value="permiso">
         <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
        <br>
        <input type="submit" name="button3" id="button3" value="Subir">
      </div>
    </form></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <tr>
    <td colspan="2" bgcolor="#006699" style="color:#FFF"><strong>RUT</strong>
      :</td>
    </tr>
    <tr>
      <td colspan="2">Rut Subido: 
        <?php  if(file_exists("documentos/".$viajero['doc_rut']) && $viajero['doc_rut'] != ""){ echo '<a href="documentos/'.$viajero['doc_rut'].'" target="_blank">Ver Rut</a>'; 
	}else
{ echo "N/A"; }?></td>
    </tr>
    <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="datos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion3"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula3"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="doc" value="<?php echo $viajero['no_documento']; ?>">
        <input name="paso" type="hidden" id="paso" value="rut">
        <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
        <br>
        <input type="submit" name="button2" id="button2" value="Subir">
      </div>
    </form></td>
    </tr>
  <tr>
  <tr>
    <td>&nbsp;</td>
    <tr>
    <td colspan="2" bgcolor="#006699" style="color:#FFF">VISA AMERICANA (SI APLICA):</td>
    </tr>
    <tr>
      <td colspan="2">Visa Subida: 
        <?php  if(file_exists("documentos/".$viajero['doc_visa']) && $viajero['doc_visa'] != ""){ echo '<a href="documentos/'.$viajero['doc_visa'].'" target="_blank">Ver Visa</a>'; 
	}else
{ echo "N/A"; }?></td>
    </tr>
    <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="datos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion3"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula3"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="doc" value="<?php echo $viajero['no_documento']; ?>">
        <input name="paso" type="hidden" id="paso" value="visa">
        <input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
        <br>
        <input type="submit" name="button2" id="button2" value="Subir">
      </div>
    </form></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>
    </div>
      <p>&nbsp;</p></td>
  </tr>
</table>
           				  </div>
           				</div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
        </div>
   <script>
    var btns = document.querySelectorAll('button');
    var clipboard = new Clipboard(btns);

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
    
  </script>
      
    </body>
