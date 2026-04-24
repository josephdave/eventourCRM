<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['idsillas'])){
	$mensaje=$control->asignarContrato($_REQUEST['idgrupo'],$_REQUEST['idsillas'],$_REQUEST['tipo'],$_REQUEST['modificacion']);

}
	
?>

    
   

       <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">Asignar CONTRATO AEROLINEA</div>
					<div class="panel-body">
           				  <div class="module-body">
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_sillasgrupo.php" method="post" name="form1" id="form1">
                          
           				    <h2>ASIGNAR CONTRATO AEROLINEA</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">CONTRATO: 
       				              <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" /></td>
           				        <td>
                                  <select name="idsillas" id="idsillas">
            <option value="" disabled selected>SELECCIONE CONTRATO</option>
                                  <?php $resultado=$control->cuposAereos(0);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								
								if($fi['estado'] == "APROBADO"){
									
								$existe=$control->exitsteContrato($fi['id'],$id_grupo);
								if($existe['selec'] >= 1){
								}else{
								
								 ?>
                                 
                                    <option value="<?php echo $fi['id']?>"><?php echo $fi['record']." - ".$fi['nombre']." - ".$fi['aerolinea']." : ".$fi['origen']." - ".$fi['destino'] ?></option><?php }
								}
									 
									 
							}?>
                                </select></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">TIPO:</td>
           				        <td><select name="tipo" id="tipo">
                                  <option value="1">PRINCIPAL</option>
                                    <option value="2">SECUNDARIO</option>
                                    <option value="3">EXTERNO</option>
                                </select></td>
   				           </tr>
                           <tr>
           				        <td bgcolor="#CCCCCC">VALOR MODIFICACIÓN:</td>
           				        <td>
                                <input type="text" name="modificacion" id="modificacion"></td>
   				           </tr>
           				      <tr>
           				        <td colspan="2"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='producto.php?grupo=<?php echo $id_grupo?>';" ></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				  </div>
           				</div>
                        </div>
    </body>
