<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

if(isset($_REQUEST['viajero'])){
	
	if(isset($_REQUEST['actividad_check'])){
	$check = 1;
	}else{
	$check = -1;
	}
$mensaje=$control->checkActividad($_REQUEST['viajero'],$_REQUEST['actividad'],$check);


$mensaje=$control->registrarModificacionServicio($_REQUEST['grupo'],$_REQUEST['viajero'],$_REQUEST['actividad'],$check);

}


$prospecto=$control->datosProducto($_REQUEST['grupo']);

?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      <div class="module-body">
        <!--     
           				  <p><a href="insc.php?grupo=0">Ver Todos </a><br>
           				  </p>
           				  <form name="form1" method="post" action="busqueda.php">
           				    <label for="termino"></label>
           				    Busqueda General:
           				    <input type="text" name="termino" id="termino" ><input name="Submit" type="submit" value="Consultar">
         				    </form>
           				  <p>&nbsp; </p>--><div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">ACTIVIDADES VIAJERO</div>
					<div class="panel-body">
					  <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover table-fixed" style="height:700px;">
					    <thead>
					      <tr>
					        <th>Tipo Viajero</th>
					        <th data-sortable="true"><strong>Nombres</strong></th>
					        <?php 
							
							$actividades=array();
							
							$resultado4=$control->consultaServicios($_REQUEST['grupo']);
							$totales = array();
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								if(($fi4['categoria'] != "TIQUETES")&&($fi4['categoria'] != "PROMOCION")&&($fi4['categoria'] != "GUIAS")&&($fi4['categoria'] != "OTROS")&&($fi4['categoria'] != "COMISIONES") && (strpos($fi4['tarifa'],"-1") === false) ){
							?>
                            
                            <th>
							<p style="writing-mode: tb-rl;"><?php 
							$actividades[]=$fi4;
							$totales[]=0;
							echo substr($fi4['nombre'],0,20);?></p></th>
                           
                            <?php
							}
							
							} ?>
                             <th>TK</th>
                            <th>PT</th>
					    
			            </thead>
					    <tr style="height:140px;">
					      <?php 
							
							$resultado=$control->viajeroActividades($_REQUEST['grupo']);
							 
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { if($fi['estado'] == 'VIAJA'){
							?>
					     
					      <td>
						  <p style="writing-mode: tb-rl;font-size:90%;width:100%;">
						  <?php echo strtoupper($fi['otro']);?>
					        <?php if($fi['acompanante_de']!=''){
					$acom=$control->datosViajero($fi['acompanante_de']);									//  echo "</br>Acomañante de:".$acom['nombres']."".$acom['apellidos'];
															  }?></p></td>
					      <td><p style="writing-mode: tb-rl;font-size:90%;width:100%;"><a href="registrar_pago.php?doc=<?php echo $fi['id']?>" target="_blank"><?php echo strtoupper($fi['nombres']);?> <?php echo strtoupper($fi['apellidos']);?></a></td>
					      <?php 
						
						 $n=0;
						 
						 foreach ($actividades as $ac){ 
						 
						
						 ?><td>
						 <form action="actividades_grupo.php" method="post">
                         
                         <input type="hidden" id="grupo" name="grupo" value="<?php echo $_REQUEST['grupo']?>">
                         <input type="hidden" id="viajero" name="viajero" value="<?php echo $fi['id']?>">
                         
                         <input type="hidden" id="actividad" name="actividad" value="<?php echo $ac['id'];?>">
                         
                         <input type="checkbox" id="actividad_check" name="actividad_check"
                         
                         <?php $valida_actividad = $control->validarActividad($fi['id'],$ac['id']); 
						 
						 if($valida_actividad['poner']==1){
						 echo "checked";
						 $totales[$n]++;
						 }else{
						 
					$f=$ac['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
				if($t==0 && $t!=''){
				if($valida_actividad['poner']==-1){	
				}else{
				 echo "checked";
				$totales[$n]++;
				}
				}else{
					if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi['otro']){if($valida_actividad['poner']==-1){	
				}else{
				 echo "checked";
				$totales[$n]++;
				}
					}

				
				}
				
				}
				}
						 
						 
						 
						 }
						 
						 ?>
                         onChange="this.form.submit()" >
                         
						 
						 <?php 
						 
				
						
							$n++;
							?> 
                         
                        </form> 
                         </td>
					
                         <?php } ?>
                              <td>
                          
                          <?php $valortk= $control->valorViajeroTK($fi['otro'],$prospecto); 
						  
						  
						  $valorMtk= $control->consultarModificaciones($fi['id'],$prospecto['id'],'TK'); 
						  
						  //echo $valorMtk;
						  
						 ?>
                          
                          
      <?php   echo $prospecto['MONEDA']." ".($valortk+$valorMtk);?></td>
					     <td><?php $valorpt= $control->valorViajeroPT($fi['otro'],$prospecto); 
						  
						  
						  $valorMpt= $control->consultarModificaciones($fi['id'],$prospecto['id'],'PT'); 
						  
						  //echo $valorMtk;
						  
						 ?>
                          
                          
      <?php   echo $prospecto['MONEDA']." ".($valorpt+$valorMpt);?></td>
				        </tr>
                        <?php } } ?>
					    <tfoot>
					      <tr>
					      <td>TOTAL </td>
					      <td>&nbsp;</td>
					      <?php 
						  $s=0;

						  foreach ($actividades as $ac){?>
					      <td><?php echo $totales[$s]; $s++; ?></td>
					      
                          <?php } ?>
                          <td>&nbsp;</td>
					      <td>&nbsp;</td>
				        </tfoot>
					    
				      </table>
                      <h2>OPCIONALES</h2>
                      <p>&nbsp;</p>
                      <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover table-fixed" style="height:700px;">
                        <thead>
                          <tr>
                            <th>Tipo Viajero</th>
                            <th data-sortable="true"><strong>Nombres</strong></th>
                            <?php 
							
							$actividades=array();
							
							$resultado4=$control->consultaServicios($_REQUEST['grupo']);
							$totales = array();
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								if(($fi4['categoria'] != "PROMOCION")&&($fi4['categoria'] != "GUIAS")&&($fi4['categoria'] != "COMISIONES") && (strpos($fi4['tarifa'],"-1") !== false) ){
							?>
                            <th> <p style="writing-mode: tb-rl;">
                              <?php 
							$actividades[]=$fi4;
							$totales[]=0;
							echo substr($fi4['nombre'],0,20);?>
                            </p></th>
                            <?php
							}
							
							} ?>
                            <th>TK</th>
                            <th>PT</th>
                        </thead>
                        <tr style="height:140px;">
                          <?php 
							
							$resultado=$control->viajeroActividades($_REQUEST['grupo']);
							 
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { if($fi['estado'] == 'VIAJA'){
							?>
                          <td><p style="writing-mode: tb-rl;font-size:90%;width:100%;"> <?php echo strtoupper($fi['otro']);?>
                            <?php if($fi['acompanante_de']!=''){
					$acom=$control->datosViajero($fi['acompanante_de']);									//  echo "</br>Acomañante de:".$acom['nombres']."".$acom['apellidos'];
															  }?>
                          </p></td>
                          <td><p style="writing-mode: tb-rl;font-size:90%;width:100%;"><a href="registrar_pago.php?doc=<?php echo $fi['id']?>" target="_blank"><?php echo strtoupper($fi['nombres']);?> <?php echo strtoupper($fi['apellidos']);?></a></td>
                          <?php 
						
						 $n=0;
						 
						 foreach ($actividades as $ac){ 
						 
						
						 ?>
                          <td><form action="actividades_grupo.php" method="get">
                          <input type="hidden" id="grupo" name="grupo" value="<?php echo $_REQUEST['grupo']?>">
                         <input type="hidden" id="viajero" name="viajero" value="<?php echo $fi['id']?>">
                         
                         <input type="hidden" id="actividad" name="actividad" value="<?php echo $ac['id'];?>">
                         <input type="checkbox" id="actividad_check" name="actividad_check"
                         
                         <?php $valida_actividad = $control->validarActividad($fi['id'],$ac['id']); 
						 
						 if($valida_actividad['poner']==1){
						 echo "checked";
						 $totales[$n]++;
						 }else{
						 
					$f=$ac['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
				if($t==0 && $t!=''){
				if($valida_actividad['poner']==-1){	
				}else{
				 echo "checked";
				$totales[$n]++;
				}
				}else{
					if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi['otro']){if($valida_actividad['poner']==-1){	
				}else{
				 echo "checked";
				$totales[$n]++;
				}
					}

				
				}
				
				}
				}
						 
						 
						 
						 }
						 
						 ?>
                         onChange="this.form.submit()" >
                            <?php 
						 
				
						
							$n++;
							?>
                          </form></td>
                          <?php } ?>
                          <td><?php $valortk= $control->valorViajeroTK($fi['otro'],$prospecto); 
						  
						  
						  $valorMtk= $control->consultarModificaciones($fi['id'],$prospecto['id'],'TK'); 
						  
						  //echo $valorMtk;
						  
						 ?>
                            <?php   echo $prospecto['MONEDA']." ".($valortk+$valorMtk);?></td>
                          <td><?php $valorpt= $control->valorViajeroPT($fi['otro'],$prospecto); 
						  
						  
						  $valorMpt= $control->consultarModificaciones($fi['id'],$prospecto['id'],'PT'); 
						  
						  //echo $valorMtk;
						  
						 ?>
                            <?php   echo $prospecto['MONEDA']." ".($valorpt+$valorMpt);?></td>
                        </tr>
                        <?php } } ?>
                        <tfoot>
                          <tr>
                            <td>TOTAL </td>
                            <td>&nbsp;</td>
                            <?php 
						  $s=0;

						  foreach ($actividades as $ac){?>
                            <td><?php echo $totales[$s]; $s++; ?></td>
                            <?php } ?>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tfoot>
                      </table>
                      <p>&nbsp;</p>
                      <p>
                        <?php 						 // var_dump($totales); ?>
                      </p>
                      <p>&nbsp;</p>
				  </div>
                                                        </div>
                                                                                    </div>
       
           				  </div>
           				</div>
                        </div>
    </body>
