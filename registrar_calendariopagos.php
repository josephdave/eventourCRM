<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['id'])){
	$cal  = $control->consultaCalendarioPagosID($id_grupo,$_REQUEST['id']);
	//var_dump($cal);
}

if(isset($_REQUEST['cuota'])){
	$mensaje=$control->registrarCalendarioPago($_REQUEST['idgrupo'],$_REQUEST['cuota'],$_REQUEST['fecha'],$_REQUEST['aerea'],$_REQUEST['terrestre']);

}

	
?>

    
   <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">CALENDARIO DE PAGOS</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_calendariopagos.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR</h2>
                           <?php $a; ?>
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">CUOTA: 
       				            <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" /></td>
           				        <td><input type="text" name="cuota" id="cuota" placeholder="" value="<?php echo $cal['id']?>"></td>
           				        <td bgcolor="#CCCCCC">FECHA:</td>
           				        <td><input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d',strtotime($cal['fecha']))?>"></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">AEREA:</td>
           				        <td><p>
           				          <input type="text" name="aerea" id="aerea" placeholder="" value="<?php echo $cal['aerea']?>">
           				        </p></td>
           				        <td bgcolor="#CCCCCC">TERRESTRE:</td>
           				        <td><p>
           				          <input type="text" name="terrestre" id="terrestre" placeholder="" value="<?php echo $cal['terrestre']?>">
           				        </p></td>
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
