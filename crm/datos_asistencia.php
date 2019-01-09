<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);




if(isset($_REQUEST['nombre'])){
	if(isset($_REQUEST['id']) && $_REQUEST['id'] !=""){
		$mensaje=$control->modificarAsistencia($_REQUEST);
	}else{
	$mensaje=$control->registrarAsistencia($_REQUEST);
	}
}
	if(isset($_REQUEST['id'])){
	$proveedor=$control->datosAsistencia($_REQUEST['id']);

}



		
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
		$nombrearchivo = str_replace(" ","_",$_REQUEST['nombre']).".".$extension;
		$destino =  "documentos_asistencia/". $nombrearchivo;
		if (copy($_FILES['archivo']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
					
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
		
	

?>

    
   
  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>ASISTENCIA</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $documento_viajero = $_REQUEST['doc'];
	$viajero=$control->datosViajero($documento_viajero);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="datos_asistencia.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          
           				    <h2>SEGURO ASISTENCIA</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre Servicio:</td>
           				        <td><input name="nombre" type="text" id="nombre" value="<?php echo $proveedor['nombre']?>">
       				            <input type="hidden" name="id" id="id" value="<?php echo $proveedor['id']?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Valor Dia:</td>
           				        <td><input name="vlr_dia" type="text" id="vlr_dia" value="<?php echo $proveedor['vlr_dia']?>"></td>
           				        <td bgcolor="#CCCCCC">Proveedor:</td>
           				        <td><select name="proveedor_id" id="proveedor_id">
           				          <?php 
							$total_insc=0;
						
							$resultado=$control->proveedores();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
				
								
								
							?>
           				          <option value="<?php 
							
							  echo strtoupper( $fi['id']);?>" <?php if ($proveedor['proveedor_id']== $fi['id']){ echo "selected";
							  }?>>
           				            <?php 
							
							  echo strtoupper( $fi['nombre']);?>
           				            - <?php echo strtoupper($fi['ciudad']);?></option>
           				          <?php } ?>
       				            </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Asistencia PDF:</td>
           				        <td>
                                  <p>
                                    <input type="file" name="archivo" id="archivo">
                                  </p>
                               </td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php 
								$files = glob("documentos_asistencia/".str_replace(" ","_",$proveedor['nombre']).".*"); // Will find 2.txt, 2.php, 2.gif

// Process through each file in the list
// and output its extension
if (count($files) > 0)
foreach ($files as $file)
 {
    $info = pathinfo($file);
	
	?>
    <a href="<?php echo "documentos_asistencia/". str_replace(" ","_",$proveedor['nombre']).".".$info["extension"] ?>" target="_blank">Ver Documento</a>
    <?
   // echo "File found: extension ".$info["extension"]."<br>";
 }
								
								
								?></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Coberturas</td>
           				        <td colspan="3"><textarea  name="coberturas"  rows="5" id="coberturas" ><?php echo $proveedor['coberturas']?></textarea></td>
       				          </tr>
                                  <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones"  rows="5" id="observaciones" ><?php echo $proveedor['observaciones']?></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='seguro_asistencia.php';" ></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				  </div>
           				</div>
                        </div>
                          </div>
                            </div>
    </body>
