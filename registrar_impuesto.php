<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$idrecord = $_REQUEST['idrecord'];

if(isset($_REQUEST['impuesto'])){
	$mensaje=$control->registrarImpuesto($_REQUEST['idrecord'],$_REQUEST['impuesto'],$_REQUEST['valor']);

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
       				        <form action="registrar_impuesto.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR IMPUESTO <?php echo $idrecord ?></h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">IMPUESTO: 
       				              <input type="hidden" value="<?php echo $idrecord ?>" id="idrecord" name="idrecord" /></td>
           				        <td><input type="text" name="impuesto" id="impuesto" list="impuestonombre">
                                <datalist id="impuestonombre">
           				          <option value="CO (Tasa Aeroportuaria)">CO (Tasa Aeroportuaria)</option>
           				          <option value="DG (Impuesto de Salida)">DG (Impuesto de Salida)</option>
           				          <option value="AH (Tasa seguridad Aeropuerto)">AH (Tasa seguridad Aeropuerto)</option>
           				          <option value="UX (Tasa de Aeropuerto)">UX (Tasa de Aeropuerto)</option>
           				          <option value="VB (Fee infraestructura Aeropuerto)">VB (Fee infraestructura Aeropuerto)</option>
           				          <option value="AA (Impuesto de salida DO)">AA (Impuesto de salida DO)</option>
           				          <option value="YS (iva)">YS (iva)</option>
           				          <option value="BO (iva Bolivia)">BO (iva Bolivia)</option>
           				          <option value="YW (Impuesto de salida BO)">YW (Impuesto de salida BO)</option>
           				          <option value="A7 (Cargo por servicio al pax)">A7 (Cargo por servicio al pax)</option>
           				          <option value="XD (Tarifa uso aeropuerto)">XD (Tarifa uso aeropuerto)</option>
           				          <option value="UK (Imp de turismo)">UK (Imp de turismo)</option>
           				          <option value="DY (Llegadas Nacionales)">DY (Llegadas Nacionales)</option>
           				          <option value="Hw (Salida Perú)">Hw (Salida Perú)</option>
           				          <option value="CU (Servicios Aeropuerto CUBA)">CU (Servicios Aeropuerto CUBA)</option>
                                    <option value="
US  (Impuesto Federal de Transporte internacional US)">US  (Impuesto Federal de Transporte internacional US)</option>
 <option value="YC (Impuesto Federal de Aduana US)">YC (Impuesto Federal de Aduana US)</option>
 <option value="XY (Impuesto Federal de inspección US)">XY (Impuesto Federal de inspección US)</option>
 <option value="XA (Impuesto Federal por Servicio APHIS US)">XA (Impuesto Federal por Servicio APHIS US)</option>
 <option value="AY (Impuesto Federal de Seguridad US)">AY (Impuesto Federal de Seguridad US)</option>
  <option value="XF (Impuesto por facilidades del Aeropuerto US)">XF (Impuesto por facilidades del Aeropuerto US)</option>
                                </datalist></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">AEREA:</td>
           				        <td><p>
           				          <input type="text" name="valor" id="valor" placeholder="">
           				        </p></td>
       				          </tr>
           				      <tr>
           				        <td colspan="2"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='cupos_aereos.php';" ></td>
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
