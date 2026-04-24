<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 


$documento = $_REQUEST['doc'];

if(isset($_SESSION['doc'])){
  $documento = $_SESSION['doc'];
}

if($documento=='' or $documento==0){
  die();
}
	
	$email="";
	
	$viajero=$control->datosViajero($documento);
	$grupo=$control->datosProducto($viajero['id_grupo']);
	
	$email="El Viajero:".$viajero['nombres']." ".$viajero['apellidos']." del Grupo:".$grupo['grupo'];
	
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'documento'){
		
		$email.=" Ha subido un nuevo documento,";
		
		
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
						 $mensaje=$control->actualizarCampo("doc_identidad",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'rut'){
		
		$email.=" Ha subido un nuevo rut,";
		
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


	if(isset($_POST['paso']) && $_POST['paso'] == 'cc'){
		
		$email.=" Ha subido un nuevo cc,";
		
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
		$nombrearchivo = $documento."_cc.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_cc",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	}
	
	
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'pasaporte'){
		$email.=" Ha subido un nuevo pasaporte,";
		
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
		
		$email.=" Ha subido un nuevo permiso,";
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
	$viajero=$control->datosViajero($documento);


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
		  
		  $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://www.emedia.co/mail/Send_Mail_EV.php?destino=info@eventoursport.com&key=1as12321sdsadaa2&asunto=Viajero%20Subio%20Documento&mensaje=".urlencode($email)); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch); 
		  
		  
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
$tipodoc=13;

$regimen = "S";//S NATURAL o C
$regimen_fiscal="2";//2 si nit;
$tipo_org="2";//2 si nit;

if($viajero['facturacion_documento'] == "NIT"){
  $c = "N";
  $regimen="C";
  $regimen_fiscal="1";
  $tipo_org="1";//2 si nit;

$tipodoc="31";
}else{
$c = "C";
}


$ap = explode(" ",trim($viajero['facturacion_nombre']));
$nom['nombre1']='';
$nom['nombre2']='';
$nom['apellido1']='';
$nom['apellido2']='';

$tipo_organizacion="Persona Natural";
if($viajero['facturacion_documento']!="NIT"){
if(count($ap) == 2){
  $nom['nombre1']=$ap[0];
  $nom['nombre2']='';
  $nom['apellido1']=$ap[1];
  $nom['apellido2']='';
 
  }
  if(count($ap) == 3){
    $nom['nombre1']=$ap[0];
    $nom['nombre2']='';
    $nom['apellido1']=$ap[1];
    $nom['apellido2']=$ap[2];
   
    }
    if(count($ap) == 4){
      $nom['nombre1']=$ap[0];
      $nom['nombre2']=$ap[1];
      $nom['apellido1']=$ap[2];
      $nom['apellido2']=$ap[3];
     
      }

}else{
  $tipo_organizacion="Persona Jurídica"; 
}

if(count($ap) > 3){
$ap[0]=$ap[0]." ".$ap[1];
$ap[1]=$ap[2];
$ap[2]=$ap[3];
}
if($viajero['telefono'] == ""){
$viajero['telefono']="0";
}


$select_ciudad=["Cali"=>"76001",
"Pereira"=>"66001",
"Bogota"=>"11001"
];
//$linea=$viajero['facturacion_nodocumento'].";".$ap[1].";".$ap[2].";".$ap[0].";".$viajero['nombres']." ".$viajero['apellidos']." ".$control->nomGrupo($viajero['id_grupo']).";".$viajero['facturacion_direccion'].";".$viajero['telefono'].";".$viajero['celular'].";".$viajero['facturacion_email'].";$c;"; 

//$linea='$("#tipo_identificacion_listbox .k-item").each(function(i){"'.$viajero['facturacion_documento'].'"==$(this).text()&&$(this).click()}),$("#tiene_rut_listbox .k-item").each(function(i){"No"==$(this).text()&&$(this).click()}),$("#tercero").val("'.$viajero['facturacion_nodocumento'].'"),$("#nombre").val("'.$viajero['facturacion_nombre'].'"),$("#primer_apellido").val("'.$nom['apellido1'].'"),$("#segundo_apellido").val("'.$nom['apellido2'].'"),$("#primer_nombre").val("'.$nom['nombre1'].'"),$("#segundo_nombre").val("'.$nom['nombre2'].'"),$("#direccion").val("'.$viajero['facturacion_direccion'].'"),$("#telefonos").val("'.$viajero['acudiente1_telefono'].'"),$("#email").val("'.$viajero['facturacion_email'].'"),$("#tercero_categoria_listbox .k-item").each(function(i){"CLIENTES"==$(this).text()&&$(this).click()}),$("#pais_listbox .k-item").each(function(i){"Colombia"==$(this).text()&&$(this).click()}),$("#municipio_listbox .k-item").each(function(i){"'.$select_ciudad[$viajero['facturacion_ciudad']].'"==$(this).text()&&$(this).click()}),$("#tipo_organizacion_listbox .k-item").each(function(i){"'.$tipo_organizacion.'"==$(this).text()&&$(this).click()}),$("#regimen_fiscal_listbox .k-item").each(function(i){"No responsable de IVA"==$(this).text()&&$(this).click()});';
//$linea=''.str_replace("\"","'",$linea);
$dv="";
$tercero_categoria="5";


$linea="1"."	".$viajero['facturacion_nodocumento']."	"."$dv"."	".$viajero['facturacion_nombre']."	". $nom['apellido1']."	". $nom['apellido2']."	";

if($viajero['telefono']=='' || $viajero['telefono']==0){
  $viajero['telefono']=$viajero['celular'];

}

$linea.=$nom['nombre1'].'	'.$nom['nombre2']."	".$tercero_categoria."	"."							".$viajero['facturacion_direccion']."	".str_replace(" ","",$viajero['telefono'])."	".str_replace(" ","",$viajero['celular'])."				";
$linea.=$viajero['facturacion_email']."		"."52"."	".$select_ciudad[$viajero['facturacion_ciudad']]."	".$tipodoc."				A	0	N	0,00000	0,00000	1		0,00000	0,00	N	N	0,00000		0,00000	".$regimen."								N	N				N				1				admin	".date('d/m/Y')." 12:00:00 a. m.	".$tipo_org."	".$regimen_fiscal;
//" ".$control->nomGrupo($viajero['id_grupo']).";".";".";"..";"..";$c;"; 
//$linea='javascript:'.urlencode($linea);

?>        
       <?php if($_SESSION['id'] != ""){?> <button type="button" data-clipboard-text="<?php echo $linea?>">Copiar Tercero</button></p>
        *Recuerda escribir "javascript:" y pegar el contenido en la URL de Karing
      <?php } ?></form>
    </div></td>
    <td valign="top"><div class="chart inline-legend grid" style="padding:10px;"><table width="100%" border="0" cellspacing="2px" cellpadding="2px">
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
    <td colspan="2" bgcolor="#006699" style="color:#FFF"><strong>Documento de Identidad</strong></td>
    </tr>
  <tr>
    <td colspan="2"><p><strong>Documento Subido:</strong>
      <?php  if(file_exists("documentos/".$viajero['doc_identidad']) && $viajero['doc_identidad'] != ""){ echo '<a href="documentos/'.$viajero['doc_identidad'].'?v='.rand(10000,99999).'" target="_blank">Ver Documento</a>'; 
	}else
{ echo "N/A"; }?>
    </p></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="dtos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion3"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula3"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="doc" value="<?php echo $documento; ?>">
        <input name="paso" type="hidden" id="paso" value="documento">
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
      <?php  if(file_exists("documentos/".$viajero['doc_pasaporte']) && $viajero['doc_pasaporte'] != ""){ echo '<a href="documentos/'.$viajero['doc_pasaporte'].'?v='.rand(10000,99999).'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; } ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="dtos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion4"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula4"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="doc" value="<?php echo $documento; ?>">
        <input name="paso" type="hidden" id="paso" value="pasaporte">
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
        <?php  if(file_exists("documentos/".$viajero['doc_permiso']) && $viajero['doc_permiso'] != ""){ echo '<a href="documentos/'.$viajero['doc_permiso'].'?v='.rand(10000,99999).'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; }?>
        <br>
       <a href="https://eventoursport.travel/crm/impresion/pdf/permiso_pdf.php?firma=<?php echo$viajero['no_documento'];?>" target="_blank">Descargar Formato</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="dtos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion6"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula6"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="do3" value="<?php echo $documento; ?>">
        <input name="paso" type="hidden" id="paso" value="permiso">
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
        <?php  if(file_exists("documentos/".$viajero['doc_rut']) && $viajero['doc_rut'] != ""){ echo '<a href="documentos/'.$viajero['doc_rut'].'?v='.rand(10000,99999).'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; }?></td>
    </tr>
    <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="dtos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion6"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula6"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="do3" value="<?php echo $documento; ?>">
        <input name="paso" type="hidden" id="paso" value="rut">
        <br>
        <input type="submit" name="button3" id="button3" value="Subir">
      </div>
    </form></td>
    </tr>
        
         <tr>
    <td>&nbsp;</td>
    <tr>
    <td colspan="2" bgcolor="#006699" style="color:#FFF"><strong>CÁMARA DE COMERCIO</strong>
      :</td>
    </tr>
    <tr>
      <td colspan="2">Rut Subido: 
        <?php  if(file_exists("documentos/".$viajero['doc_cc']) && $viajero['doc_cc'] != ""){ echo '<a href="documentos/'.$viajero['doc_cc'].'?v='.rand(10000,99999).'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; }?></td>
    </tr>
    <tr>
    <td colspan="2" bgcolor="#EFEFEF"><form action="dtos.php" method="post" enctype="multipart/form-data">
      <label class="control-label" for="facdireccion6"> Subir nuevo documento:</label>
      <div class="controls">
        <label for="cedula6"></label>
        <input type="file" name="archivo" id="archivo">
        <input name="doc" type="hidden" id="do3" value="<?php echo $documento; ?>">
        <input name="paso" type="hidden" id="paso" value="cc">
        <br>
        <input type="submit" name="button3" id="button3" value="Subir">
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

