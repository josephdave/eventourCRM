<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['nombre'])){
	$mensaje=$control->registrarActividad($_REQUEST['idgrupo'],$_REQUEST['nombre'],$_REQUEST['lugar'],$_REQUEST['fecha'],$_REQUEST['hora'],$_REQUEST['contacto'],$_REQUEST['observaciones']);

}
	
?>

      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>Actividad</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_actividad.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR ACTIVIDAD      				    </h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">Actividad: </td>
           				        <td><input name="nombre" type="text" id="nombre"></td>
           				        <td>Lugar:</td>
           				        <td><input type="text" name="lugar" id="lugar" placeholder=""></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><p>Fecha
           				          :
                                      <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" />
       				             
   				                </p></td>
           				        <td><input type="date" name="fecha" id="fecha"></td>
           				        <td>Hora:</td>
           				        <td><input type="time" name="hora" id="hora"></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Contacto:</td>
           				        <td><p>
           				          <select name="contacto" id="contacto">
           				            <?php  	$res=$control->listaContactos($id_grupo);
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				            <option value="<?php echo $fi['id']; ?>" ><?php echo $fi['nombre'];?></option>
           				            <?php } ?>
       				              </select>
           				        </p></td>
           				        <td>&nbsp;</td>
           				        <td><p>&nbsp;</p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones" cols="100" rows="5" id="observaciones"></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='prospecto.php?grupo=<?php echo $id_grupo?>';" ></td>
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
