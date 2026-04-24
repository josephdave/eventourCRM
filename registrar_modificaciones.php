<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['grupo'];
$id_viajero = $_REQUEST['viajero'];

 $producto=$control->datosProducto($id_grupo);
 $viajero=$control->datosViajeroID($id_viajero);


if(isset($_REQUEST['tipo'])){
	$mensaje=$control->registrarModificaciones($_REQUEST['grupo'],$_REQUEST['viajero'],$_REQUEST['valor'],$_REQUEST['tipo'],$_REQUEST['causa']);

}
	
?>

    
   <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">MODIFICACIONES AL PROGRAMA</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_modificaciones.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR MODIFICACIONES </h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">VIAJERO: 
   				                  <input type="hidden" value="<?php echo $id_grupo ?>" id="grupo" name="grupo" />
                                    <input type="hidden" value="<?php echo $id_viajero ?>" id="viajero" name="viajero" /></td>
           				        <td><?php echo $viajero['nombres']." ".$viajero['apellidos']; ?></td>
           				        <td bgcolor="#CCCCCC">PROGRAMA:</td>
           				        <td><?php echo $producto['grupo']?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">VALOR:</td>
           				        <td><p>
           				          <input type="text" name="valor" id="valor" placeholder="">
           				        </p></td>
           				        <td bgcolor="#CCCCCC">TIPO::</td>
           				        <td><p>
           				          <select name="tipo" id="tipo">
           				            <option value="PT">PT</option>
           				            <option value="TK">TK</option>
       				              </select>
           				        </p></td>
       				          </tr>
                               <tr>
           				        <td bgcolor="#CCCCCC">CAUSA:</td>
           				        <td colspan="3"><p>
           				          <textarea name="causa" id="causa"></textarea>
           				        </p></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='registrar_pago.php?doc=<?php echo $id_viajero?>';" ></td>
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
