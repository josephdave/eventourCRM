<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

$id_prospecto= $_REQUEST['idprospecto'];

if(isset($_REQUEST['nombre1']) && isset($_REQUEST['idgrupo'])){
	$mensaje=$control->registrarMultitarifa($_REQUEST['idgrupo'],$_REQUEST['nombre1'],$_REQUEST['aerea1'],$_REQUEST['terrestre1'],$_REQUEST['nombre2'],$_REQUEST['aerea2'],$_REQUEST['terrestre2'],$_REQUEST['nombre3'],$_REQUEST['aerea3'],$_REQUEST['terrestre3'],$_REQUEST['nombre4'],$_REQUEST['aerea4'],$_REQUEST['terrestre4'],$_REQUEST['nombre5'],$_REQUEST['aerea5'],$_REQUEST['terrestre5'],$_REQUEST['nombre6'],$_REQUEST['aerea6'],$_REQUEST['terrestre6'],$_REQUEST['nombre7'],$_REQUEST['aerea7'],$_REQUEST['terrestre7'],$_REQUEST['nombre8'],$_REQUEST['aerea8'],$_REQUEST['terrestre8'],$_REQUEST['nombre9'],$_REQUEST['aerea9'],$_REQUEST['terrestre9'],$_REQUEST['nombre10'],$_REQUEST['aerea10'],$_REQUEST['terrestre10']);

}else if(isset($_REQUEST['nombre1']) && isset($_REQUEST['idprospecto'])){
	$mensaje=$control->registrarMultitarifaProspecto($_REQUEST['idprospecto'],$_REQUEST['nombre1'],$_REQUEST['aerea1'],$_REQUEST['terrestre1'],$_REQUEST['nombre2'],$_REQUEST['aerea2'],$_REQUEST['terrestre2'],$_REQUEST['nombre3'],$_REQUEST['aerea3'],$_REQUEST['terrestre3'],$_REQUEST['nombre4'],$_REQUEST['aerea4'],$_REQUEST['terrestre4'],$_REQUEST['nombre5'],$_REQUEST['aerea5'],$_REQUEST['terrestre5'],$_REQUEST['nombre6'],$_REQUEST['aerea6'],$_REQUEST['terrestre6'],$_REQUEST['nombre7'],$_REQUEST['aerea7'],$_REQUEST['terrestre7'],$_REQUEST['nombre8'],$_REQUEST['aerea8'],$_REQUEST['terrestre8'],$_REQUEST['nombre9'],$_REQUEST['aerea9'],$_REQUEST['terrestre9'],$_REQUEST['nombre10'],$_REQUEST['aerea10'],$_REQUEST['terrestre10']);
}
	
if(isset($_REQUEST['idgrupo'])){
	$prospecto=$control->datosProducto($id_grupo);
}
if(isset($_REQUEST['idprospecto'])){
	$prospecto=$control->datosProspecto($id_prospecto);
}

?>

    
   <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">SUBPROGRAMAS</div>
					<div class="panel-body">
           				  <div class="module-body">
                       
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_multitarifa.php" method="post" name="form1" id="form1">
								<?php if(isset($_REQUEST['idgrupo'])){?>
                          <input type="hidden" value="<?php echo $id_grupo ?>" id="idgrupo" name="idgrupo" />
								<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
                          <input type="hidden" value="<?php echo $id_prospecto ?>" id="idprospecto" name="idprospecto" />
								<?php } ?>
           				    <h2>REGISTRAR</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa Base
       				            </strong>           				          </td>
           				        <td><input type="text" name="nombre1" id="nombre1" placeholder="" value="<?php echo $prospecto['nombre_tarifa1']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>
									<?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=1">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=1">Costeo</a>
								  	<?php } ?>
								  </td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea1" id="aerea1" placeholder="" value="<?php echo $prospecto['valor_aereo'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre1" id="terrestre1" placeholder="" value="<?php echo $prospecto['valor_terrestre'];?>"></td>
   				           </tr>
           				      <tr>
                              
                              
                              
                              
                                <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 2
       				            </strong>           				          </td>
           				        <td><input type="text" name="nombre2" id="nombre2" placeholder="" value="<?php echo $prospecto['nombre_tarifa2']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=2">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=2">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea2" id="aerea2" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa2'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre2" id="terrestre2" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa2'];?>"></td>
   				           </tr>
                           
                           <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 3
       				            </strong>           				          </td>
           				        <td><input type="text" name="nombre3" id="nombre3" placeholder="" value="<?php echo $prospecto['nombre_tarifa3']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=3">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=3">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea3" id="aerea3" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa3'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre3" id="terrestre3" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa3'];?>"></td>
   				           </tr>
                           
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 4
       				            </strong>           				          </td>
           				        <td><input type="text" name="nombre4" id="nombre4" placeholder="" value="<?php echo $prospecto['nombre_tarifa4']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=4">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=4">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea4" id="aerea4" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa4'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre4" id="terrestre4" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa4'];?>"></td>
   				           </tr>
                           
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 5</strong></td>
           				        <td><input type="text" name="nombre5" id="nombre5" placeholder="" value="<?php echo $prospecto['nombre_tarifa5']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=5">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=5">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea5" id="aerea5" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa5'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre5" id="terrestre5" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa5'];?>"></td>
   				           </tr>
                           
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 6</strong></td>
           				        <td><input type="text" name="nombre6" id="nombre6" placeholder="" value="<?php echo $prospecto['nombre_tarifa6']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=6">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=6">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea6" id="aerea6" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa6'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre6" id="terrestre6" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa6'];?>"></td>
   				           </tr>
                           
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 7</strong></td>
           				        <td><input type="text" name="nombre7" id="nombre7" placeholder="" value="<?php echo $prospecto['nombre_tarifa7']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=7">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=7">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea7" id="aerea7" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa7'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre7" id="terrestre7" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa7'];?>"></td>
   				           </tr>
                           
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 8</strong></td>
           				        <td><input type="text" name="nombre8" id="nombre8" placeholder="" value="<?php echo $prospecto['nombre_tarifa8']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=8">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=8">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea8" id="aerea8" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa8'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre8" id="terrestre8" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa8'];?>"></td>
   				           </tr>
                           
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 9</strong></td>
           				        <td><input type="text" name="nombre9" id="nombre9" placeholder="" value="<?php echo $prospecto['nombre_tarifa9']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=9">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=9">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea9" id="aerea9" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa9'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre9" id="terrestre9" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa9'];?>"></td>
   				           </tr>
                           
                            <!----->
                           
                           <tr>
           				        <td bgcolor="#CCCCCC"><strong>Nombre Tarifa 10</strong></td>
           				        <td><input type="text" name="nombre10" id="nombre10" placeholder="" value="<?php echo $prospecto['nombre_tarifa10']; ?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td><?php if(isset($_REQUEST['idgrupo'])){?>
									<a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=10">Costeo</a>
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_prospecto ?>&multitarifa=10">Costeo</a>
								  	<?php } ?></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Aerea:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="aerea10" id="aerea10" placeholder="" value="<?php echo $prospecto['valor_aereo_tarifa10'];?>"></td>
           				        <td bgcolor="#CCCCCC">Terrestre:</td>
           				        <td><?php echo $prospecto['MONEDA'] ?>
       				            <input type="text" name="terrestre10" id="terrestre10" placeholder="" value="<?php echo $prospecto['valor_terrestre_tarifa10'];?>"></td>
   				           </tr>
                           
                           
                           
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar">
									
									<?php if(isset($_REQUEST['idgrupo'])){?>
									<input type="button" name="button" id="button" value="Volver" onclick="location.href='producto.php?grupo=<?php echo $id_grupo?>';" >
								  	<?php } ?>
									<?php if(isset($_REQUEST['idprospecto'])){?>
									<input type="button" name="button" id="button" value="Volver" onclick="location.href='prospecto.php?grupo=<?php echo $id_prospecto?>';" >
								
								  	<?php } ?>
									
									</td>
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
