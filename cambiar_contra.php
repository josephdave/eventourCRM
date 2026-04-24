<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


if($_REQUEST['nueva'] ==  $_REQUEST['nuevaconfirm'] && isset($_REQUEST['nueva']) ){
	$mensaje=$control->cambiarContra($_SESSION['id'],$_REQUEST['actual'],$_REQUEST['nueva']);

}else{
	if(isset($_REQUEST['nueva'])){
$mensaje="Las contraseñas no son iguales";
	}
}
	
?>

    
   

      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">USUARIO</div>
					<div class="panel-body">
           				  <div class="module-body">
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="cambiar_contra.php" method="post" name="form1" id="form1">
                          
           				    <h2>MODIFICAR CONTRASEÑA</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC"><p>CONTRASEÑA ACTUAL:
                                    <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" />
       				             
   				                </p></td>
           				        <td><input type="password" name="actual" id="actual" placeholder=""></td>
           				        <td bgcolor="#CCCCCC">Nota:</td>
           				        <td>La nueva contraseña debe ser segura, diferente a la clave por defecto y no debe contener la palabra eventour.</td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">NUEVA CONTRASEÑA:</td>
           				        <td><p>
           				          <input type="password" name="nueva" id="nueva" placeholder="">
           				        </p></td>
           				        <td bgcolor="#CCCCCC">CONFIRMAR CONTRASEÑA:</td>
           				        <td><p>
           				          <input type="password" name="nuevaconfirm" id="nuevaconfirm" placeholder="">
           				        </p></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='dashboard.php';" ></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				  </div>
           				</div>
                        </div>
                        </div>
                        </div></div>
    </body>
