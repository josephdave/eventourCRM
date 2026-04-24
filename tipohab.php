<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id = $_REQUEST['id'];

	
if(isset($_REQUEST['acomodacion'])){
	$mensaje=$control->registarTarifaHabitacion($_REQUEST['id'],$_REQUEST['acomodacion'],$_REQUEST['desde'],$_REQUEST['hasta'],$_REQUEST['tarifa']);

}
?>

    
   

       <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">TIPO HABITACIÓN</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_tipohab.php" method="post" name="form1" id="form1">
                          
           				    <h2>HABITACIÓN           				    </h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">HOTEL:       				              </td>
           				        <td><?php 
								$habitacion=$control->tipoHabitacion($id);
								
								
								
								echo $habitacion['hotel'];?> </td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">TIPO HABITACIÓN:</td>
           				        <td><?php echo $habitacion['tipo']; ?></td>
           				        <td bgcolor="#CCCCCC">PLAN:</td>
           				        <td><?php echo $habitacion['plan']; ?></td>
   				           </tr>
                           </table>
           				    <p>&nbsp;</p>
       				        </form>
           				    <form action="tipohab.php" method="post"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000" id="list" data-toggle="table">
           				      <thead>
           				        <tr>
           				          <th data-sortable="true" data-field="contrato">ACOMODACION</th>
           				          <th>DESDE</th>
           				          <th>HASTA</th>
           				          <th><strong>TARIFA</strong></th>
       				            </tr>
       				          </thead>
                              <tr>
           				        <td>
                                <input type="hidden" id="id" name="id" value="<?php echo $id?>" />
                                <select name="acomodacion" id="acomodacion">
                                  <option value="SGL">SENCILLA</option>
                                    <option value="DBL">DOBLE</option>
									<option value="TPL">TRIPLE</option>
									<option value="CPL">CUADRUPLE</option>
                                    <option value="EXT">EXTRA</option>
                                      <option value="CHD">NIÑO</option>
                                </select></td>
           				        <td>
                                <input type="date" name="desde" id="desde"></td>
           				        <td> <input type="date" name="hasta" id="hasta"></td>
           				        <td><input type="text" id="tarifa" name="tarifa">
       				            <input type="submit" name="submit" id="submit" value="Guardar"></td>
       				          </tr>
           				      <?php 
							
							$resultado=$control->tarifasHabitacion($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								

	

							?>
           				      
           				      <tr>
           				        <td><?php echo $fi['acomodacion']; ?></td>
           				        <td><?php echo $fi['desde']; ?></td>
           				        <td><?php echo $fi['hasta'];?></td>
           				        <td><?php echo $fi['tarifa'];?></td>
       				          </tr>
           				      <?php } ?>
       				        </table></form>
           				    <p>&nbsp;</p>
           				  </div>
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
