<?php include 'layout/header.php' ?>
<?php 
	$documento = $_REQUEST['doc'];
	
	if(isset($_POST['paso']) && $_POST['paso'] == 'editar'){
	$mensaje = $control->actualizarDatos($_POST['doc'],$_POST['nombres'],$_POST['apellidos'],$_POST['fnacimiento'],$_POST['email'],$_POST['telefono'],$_POST['celular'],$_POST['ciudad'],$_POST['direccion'],$_POST['pasaporte'],$_POST['pasaporte_vigencia'],$_POST['visa_americana'],$_POST['visa_vigencia'],$_POST['p1nombre'],$_POST['p1apellido'],$_POST['p1telefono'],$_POST['p1email'],$_POST['p2nombre'],$_POST['p2apellido'],$_POST['p2telefono'],$_POST['p2email'],$_POST['facturacion_nombre'],$_POST['facturacion_direccion'],$_POST['facturacion_email']);
	}
	
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
	
	$viajero=$control->datosViajero($documento);
	
	
?>
	
 
    
   

        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                       <?php include 'layout/menu.php' ?> 
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                          <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				  <div class="module-head">
           				    <h3> Informacion del Viajero</h3>
       				      </div>
           				  <div class="module-body">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="chart inline-legend grid" >
      <?php if(isset($mensaje)){?>
      <?php } ?>
      <form action="editar.php?doc=<?php echo $viajero['no_documento'] ?>" method="post" class="form-horizontal row-fluid" id="registro">
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Grupo</strong>:</label>
          <div class="controls"><?php echo $control->nomGrupo($viajero['id_grupo']);?>
            <input name="paso" type="hidden" id="paso" value="editar" />
          </div>
        </div> <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Nombres</strong>:</label>
          <div class="controls">
            <label for="nombres"></label>
            <input type="text" name="nombres" id="nombres" value=" <?php echo $viajero['nombres'] ?>"/>
           </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Apellidos</strong>:</label>
          <div class="controls">
            <input type="text" name="apellidos" id="apellidos" value=" <?php echo $viajero['apellidos'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput2"><strong>Documento</strong>:</label>
          <div class="controls"><?php echo $viajero['documento'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Numero</strong> <strong>Documento</strong>:</label>
          <div class="controls"><?php echo $viajero['no_documento'] ?>
            <input name="doc" type="hidden" id="doc" value="<?php echo $viajero['no_documento'] ?>" />
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput5"><strong>Fecha</strong> <strong>Nacimiento</strong>:</label>
          <div class="controls">
            <input type="text" name="fnacimiento" id="fnacimiento" value=" <?php echo $viajero['fnacimiento'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput6"><strong>email</strong>:</label>
          <div class="controls">
            <input type="text" name="email" id="email" value=" <?php echo $viajero['email'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput7"><strong>Telefono:</strong></label>
          <div class="controls">
            <input type="text" name="telefono" id="telefono" value=" <?php echo $viajero['telefono'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput8"><strong>Celular:</strong></label>
          <div class="controls">
            <strong>
            <input type="text" name="celular" id="celular" value=" <?php echo $viajero['celular'] ?>"/>
            </strong></div>
        </div>
            <div class="control-group"><strong><span class="control-label">Ciudad</span></strong>
           				          <div class="controls">
           				            <input name="ciudad" type="text" class="span8" id="ciudad" placeholder="" style="text-transform:uppercase" value=" <?php echo $viajero['ciudad'] ?>" >
           				          </div>
			            </div>
                                    <div class="control-group"><span class="control-label"><strong>Dirección</strong></span>
           				          <div class="controls">
           				            <input name="direccion" type="text" class="span8" id="direccion" placeholder="" style="text-transform:uppercase" value=" <?php echo $viajero['direccion'] ?>" >
           				          </div>
			            </div>
        <div class="control-group">
          <label class="control-label" for="basicinput9"><strong>Pasaporte</strong>:</label>
          <div class="controls">
            <input type="text" name="pasaporte" id="pasaporte" value=" <?php echo $viajero['pasaporte'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput10"><strong>Vigencia</strong></label>
          :
          <div class="controls">
            <input type="text" name="pasaporte_vigencia" id="pasaporte_vigencia" value=" <?php echo $viajero['pasaporte_vigencia'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label"><strong>Visa Americana:</strong></label>
          <div class="controls"></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput11"><strong>No. Visa</strong></label>
          :
          <div class="controls">
            <input type="text" name="visa_americana" id="visa_americana" value=" <?php echo $viajero['visa_americana'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput12"><strong>Vencimiento</strong></label>
          :
          <div class="controls">
            <input type="text" name="visa_vigencia" id="visa_vigencia" value=" <?php echo $viajero['visa_vigencia'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Acudientes</strong></label>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Nombre Padre</strong></label>
          :
          <div class="controls">
            <input type="text" name="p1nombre" id="p1nombre" value=" <?php echo $viajero['acudiente1_nombre'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Apellidos Padre</strong></label>
          :
          <div class="controls">
            <input type="text" name="p1apellido" id="p1apellido" value=" <?php echo $viajero['acudiente1_apellido'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Telefono</strong></label>
          :
          <div class="controls">
            <input type="text" name="p1telefono" id="p1telefono" value=" <?php echo $viajero['acudiente1_telefono'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>email</strong></label>
          :
          <div class="controls">
            <input type="text" name="p1email" id="p1email" value=" <?php echo $viajero['acudiente1_email'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Nombre Madre</strong></label>
          :
          <div class="controls">
            <input type="text" name="p2nombre" id="p2nombre" value=" <?php echo $viajero['acudiente2_nombre'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Apellidos Madre</strong></label>
          :
          <div class="controls">
            <input type="text" name="p2apellido" id="p2apellido" value=" <?php echo $viajero['acudiente2_apellido'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>Telefono</strong></label>
          :
          <div class="controls">
            <input type="text" name="p2telefono" id="p2telefono" value=" <?php echo $viajero['acudiente2_telefono'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput13"><strong>email</strong></label>
          :
          <div class="controls">
            <input type="text" name="p2email" id="p2email" value=" <?php echo $viajero['acudiente2_email'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput4"><strong>Facturacion</strong></label>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Nombre:</strong></label>
          <div class="controls">
            <input type="text" name="facturacion_nombre" id="facturacion_nombre" value=" <?php echo $viajero['facturacion_nombre'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput2"><strong>Documento</strong></label>
          <div class="controls"><?php echo $viajero['facturacion_documento'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="facdireccion"><strong>Numero Documento*</strong></label>
          <strong> :</strong>
          <div class="controls"><?php echo $viajero['facturacion_nodocumento'] ?></div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput5"><strong>Direccion*</strong></label>
          :
          <div class="controls">
            <input type="text" name="facturacion_direccion" id="facturacion_direccion" value=" <?php echo $viajero['facturacion_direccion'] ?>"/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="basicinput2"><strong>email</strong></label>
          <div class="controls">
            <input type="text" name="facturacion_email" id="facturacion_email" value=" <?php echo $viajero['facturacion_email'] ?>"/>
          </div>
        </div>
        <p>
          <input type="submit" name="button4" id="button4" value="Guardar" />
        </p>
      </form>
    </div></td>
    <td valign="top"><div class="chart inline-legend grid" style="background:#E4E4E4;padding:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>DOCUMENTOS:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Documento de Identidad</strong></td>
    <td><?php  if(file_exists("documentos/".$viajero['doc_identidad']) && $viajero['doc_identidad'] != ""){ echo '<a href="documentos/'.$viajero['doc_identidad'].'" target="_blank">Ver Documento</a>'; 
	}else
{ echo "N/A"; }?></td>
  </tr>
  <tr>
    <td colspan="2"><form action="datos.php" method="post" enctype="multipart/form-data">
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
    <td><span class="control-group">
      <strong>Pasaporte</strong>
    </span></td>
    <td><?php  if(file_exists("documentos/".$viajero['doc_pasaporte']) && $viajero['doc_pasaporte'] != ""){ echo '<a href="documentos/'.$viajero['doc_pasaporte'].'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; } ?></td>
  </tr>
  <tr>
    <td colspan="2"><form action="datos.php" method="post" enctype="multipart/form-data">
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
    <td><strong>Permiso de Salida</strong>
      :</td>
    <td><?php  if(file_exists("documentos/".$viajero['doc_permiso']) && $viajero['doc_permiso'] != ""){ echo '<a href="documentos/'.$viajero['doc_permiso'].'" target="_blank">Ver Documento</a>'; }else
{ echo "N/A"; }?></td>
  </tr>
  <tr>
    <td colspan="2"><form action="datos.php" method="post" enctype="multipart/form-data">
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
   
      
    </body>
