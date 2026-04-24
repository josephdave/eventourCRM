<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['hotel'])){
	$mensaje=$control->registrarHotel($_REQUEST['idgrupo'],$_REQUEST['hotel'],$_REQUEST['ubicacion'],$_REQUEST['fecha_llegada'],$_REQUEST['fecha_salida'],$_REQUEST['direccion'],$_REQUEST['telefono'],$_REQUEST['web']);

}
	
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">REGISTRAR HOTEL</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_hotel.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR HOTEL</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">HOTEL: 
       				            <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" /></td>
           				        <td><input type="text" name="hotel" id="hotel" placeholder=""></td>
           				        <td bgcolor="#CCCCCC">UBICACIÓN:</td>
           				        <td><input type="text" name="ubicacion" id="ubicacion" placeholder=""></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">DIRECCION:</td>
           				        <td><input type="text" name="direccion" id="direccion" placeholder=""></td>
           				        <td bgcolor="#CCCCCC">TELEFONO:</td>
           				        <td><input type="text" name="telefono" id="telefono" placeholder=""></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">FECHA LLEGADA:</td>
           				        <td><input type="date" name="fecha_llegada" id="fecha_llegada"></td>
           				        <td bgcolor="#CCCCCC">FECHA SALIDA:</td>
           				        <td><input type="date" name="fecha_salida" id="fecha_salida"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">PAGINA WEB</td>
           				        <td><input type="text" name="web" id="web" placeholder=""></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='producto.php?grupo=<?php echo $id_grupo?>';" ></td>
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
