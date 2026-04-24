<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 


//consultaInsertar
	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['hotel'])){
	$mensaje=$control->registarHabitacion($_REQUEST['hotel'],$_REQUEST['acomodacion'],$_REQUEST['tipo'],$_REQUEST['plan']);

}
//	var_dump($mensaje);
?>

    
   

       <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">REGISTRAR TIPO HABITACIÓN</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_tipohab.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR TIPO HABITACIÓN</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">HOTEL:       				              </td>
           				        <td><input type="text" name="hotel" id="hotel" placeholder=""></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><input type="hidden" id="acomodacion" name="acomodacion" value="">
                                <!--<select name="acomodacion" id="acomodacion">
                                  <option value="SGL">SENCILLA</option>
                                    <option value="DBL">DOBLE</option>
                                    <option value="TPL">TRIPLE</option>
                                    <option value="CPL">CUADRUPLE</option>
                                </select>--></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">TIPO HABITACIÓN:</td>
           				        <td><input type="text" name="tipo" id="tipo" placeholder=""></td>
           				        <td bgcolor="#CCCCCC">PLAN:</td>
           				        <td><select name="plan" id="plan">
           				          <option value="ALL INCLUSIVE">ALL INCLUSIVE</option>
           				          <option value="SOLO DESAYUNO">SOLO DESAYUNO</option>
                                </select></td>
   				           </tr>
                           <tr>
       				         <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='tipo_habitaciones.php';" ></td>
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
