<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);

if(isset($_REQUEST['nombre'])){
	
	if(isset($_REQUEST['contacto']) && $_REQUEST['contacto']>0){
	$mensaje=$control->modificarContacto($_REQUEST['contacto'],$_REQUEST['idgrupo'],$_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['direccion'],$_REQUEST['ciudad'],$_REQUEST['email'],$_REQUEST['tipo'],$_REQUEST['origen'],$_REQUEST['observaciones']);
	}else{
	$mensaje=$control->registrarContacto($_REQUEST['idgrupo'],$_REQUEST['nombre'],$_REQUEST['telefono'],$_REQUEST['direccion'],$_REQUEST['ciudad'],$_REQUEST['email'],$_REQUEST['tipo'],$_REQUEST['origen'],$_REQUEST['observaciones']);
	}

}

$id_grupo = $_REQUEST['idgrupo'];
//var_dump($id_grupo);


$idcontacto = $_REQUEST['contacto'];
if(isset($idcontacto)){
	$contacto = $control->datosContacto($idcontacto);
	$id_grupo = $contacto['id_grupo'];
}

if(!isset($id_grupo)|| $id_grupo==""){
	$_REQUEST['idgrupo']= $_REQUEST['idgrupo_new'];
}


?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">CONTACTO</div>
					<div class="panel-body">
           				  <div class="module-body">
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
       				        <form action="registrar_contacto.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR CONTACTO</h2>
                           
           				 <table border="1" width="100%" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <?php if(!isset($id_grupo)|| $id_grupo==""){
?><tr>
           				        <td bgcolor="#CCCCCC">GRUPO</td>
           				        <td colspan="3"><select name="idgrupo_new" id="idgrupo_new">
           				          <?php  	$res=$control->grupos();
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				          <option value="<?php echo $fi['id']; ?>" ><?php echo $fi['grupo'];?></option>
           				          <?php } ?>
       				            </select></td>
   				           </tr><?php }?>           				      <tr>
           				        <td bgcolor="#CCCCCC">Nombre 
       				            <input type="hidden" value="<?php echo $idcontacto ?>" id="contacto" name="contacto" /></td>
           				        <td><input name="nombre" type="text" id="nombre" value="<?php echo $contacto['nombre'];?>"></td>
           				        <td>Telefono:</td>
           				        <td><input type="text" name="telefono" id="telefono" placeholder="" value="<?php echo $contacto['telefono'];?>"></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><p>Direccion
           				          :
                                      <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" />
       				             
   				                </p></td>
           				        <td><input type="text" name="direccion" id="direccion" value="<?php echo $contacto['direccion'];?>" ></td>
           				        <td>Ciudad</td>
           				        <td><input name="ciudad" type="text" id="ciudad" value="<?php echo $contacto['ciudad'];?>"></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Email:</td>
           				        <td><input name="email" type="email" id="email" value="<?php echo $contacto['email'];?>"></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Tipo de Contacto:</td>
           				        <td><p>
           				          <select name="tipo" id="tipo">
           				            <option value="ESTUDIANTE"  <?php if($contacto['tipo']=="ESTUDIANTE"){echo "selected";} ?>>ESTUDIANTE</option>
           				            <option value="PADRE DE FAMILIA" <?php if($contacto['tipo']=="PADRE DE FAMILIA"){echo "selected";} ?>>PADRE DE FAMILIA</option>
           				            <option value="CONTACTO" <?php if($contacto['tipo']=="CONTACTO"){echo "selected";} ?>>CONTACTO</option>
           				            <option value="VIAJERO" <?php if($contacto['tipo']=="VIAJERO"){echo "selected";} ?>>VIAJERO</option>
           				            <option value="ESTUDIANTE COMITE">ESTUDIANTE COMITE</option>
           				            <option value="PADRE COMITE">PADRE COMITE</option>
           				            <option value="OTRO">OTRO</option>
       				              </select>
           				        </p></td>
           				        <td>Origen del contacto:</td>
           				        <td><select name="origen" id="origen">
                          <option value="PAGINA WEB" <?php if($contacto['origen']=="PAGINA WEB"){echo "selected";} ?>PAGINA WEB</option>
                          <option value="LLAMADA" <?php if($contacto['origen']=="LLAMADA"){echo "selected";} ?>>LLAMADA </option>
                          <option value="REFERENCIADO" <?php if($contacto['origen']=="REFERENCIADO"){echo "selected";} ?>>REFERENCIADO</option>
                          <option value="EMAIL" <?php if($contacto['origen']=="EMAIL"){echo "selected";} ?>>EMAIL</option>
                          <option value="OTRO" <?php if($contacto['origen']=="OTRO"){echo "selected";} ?>>OTRO</option>
                        </select></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones" cols="100" rows="5" id="observaciones" value="<?php echo $contacto['observaciones'];?>"></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="<?php if(isset($idcontacto)){ echo "Modificar";}else{ echo "Registrar";}?>">   <!-- <?php if(!isset($id_grupo)|| $id_grupo==""){}else{
?><input type="button" name="button" id="button" value="Volver" onclick="location.href='producto.php?grupo=<?php echo $id_grupo?>';" ><?php }?>--></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				 </div>
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
                        
    </body>
