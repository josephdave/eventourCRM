<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	if(isset($_REQUEST['historial'])){
	$mensaje=$control->prospectoHistorial($_REQUEST['historial'],$_REQUEST['estado']);
	}
	
	if(isset($_REQUEST['reunion'])){
	
	 $mensaje=$control->actualizarCheklist($_REQUEST['reunion'],$_REQUEST['id']);
	 
	 
	 }
	 
	 if(isset($_REQUEST['costeo'])){
	
	 $mensaje=$control->actualizarCheklist($_REQUEST['costeo'],$_REQUEST['id']);
	 
	 
	 }
	 if(isset($_REQUEST['programa'])){
	
	 $mensaje=$control->actualizarCheklist($_REQUEST['programa'],$_REQUEST['id']);
	 
	 
	 }
	 if(isset($_REQUEST['presentacion'])){
	
	 $mensaje=$control->actualizarCheklist($_REQUEST['presentacion'],$_REQUEST['id']);
	 
	 
	 }
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>GRUPOS PROSPECTO</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
           				    <p>
           				      <input type="button" name="button" id="button" value="Registrar Grupo " onclick="location.href='registrar_grupoprospecto.php';" >
           				    </p>
									  <h2>GRUPOS JUVENILES</h2>
           				    <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="false"          data-sort-order="desc" class="table table-hover table-fixed">
					    
           				    <thead>
           				      <tr>
           				      <th><strong>Grupo</strong></td>
           				      <th><strong>Origen</strong></td>
           				      <th><strong>Des<?php echo strtoupper( $fi['fecha_regreso']);?>tino</strong></td>
           				      <th><strong>Viajeros</strong> Estimados</td>
           				      <th>Fecha de Viaje estimado
         				        <th><strong>Estado</strong>
           				      <th><span title="Reunion">RE</span>                              
           				      <th><span title="Costeo">CO</span>                              
           				      <th><span title="Programa">PG</span>                              
           				      <th><span title="Presentacion">PR</span>                              
           				      <th><strong>Encargado</strong>
           				      <th>Convertir<th><strong>Ver</strong></td>
       				        </thead>
                            
           				   
                            
                            <?php 
							$total_insc=0;
						
							$resultado=$control->prospectos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								if($fi['unidad_negocio']=='GRUPOS JUVENILES'){
				
									$color_estado = $control->colorEstado($fi['estado']);
								
							?>
                             <tr bgcolor="<?php echo $color_estado;?>">
           				      <td><a href="prospecto.php?grupo=<?php echo $fi['id'];?>" target="_self"><?php echo strtoupper($fi['nombre_grupo']);?></a></td>
           				      <td><?php echo strtoupper($fi['origen']);?></td>
           				      <td><?php echo strtoupper( $fi['destino']);?></td>
           				      <td><?php echo $fi['cantidad_viajeros'];
							  $total_insc=$total_insc+$fi['cantidad_viajeros'];?></td>
           				      <td><?php 
							  
							  $salida = new DateTime($fi['fecha_salida']);
					$llegada = new DateTime($fi['fecha_regreso']);
	$fecha_max= $control->proximaFecha($fi['id']);

     $datediff = strtotime($fecha_max)- strtotime(date("Y-m-d"));
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['fecha_salida']);?></td>
           				      <td><?php $color_estado = $control->colorEstado($fi['estado']);?><span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
           				      <td><form action="gruposprospecto.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>"><input type="hidden" id="reunion" name="reunion" value="<?php if(strpos($fi['checklist'],"reunion;") !== false ){
							 echo str_replace("reunion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'reunion;"';
							 
							 }?>">
                              <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"reunion;") !== false ){ echo 'checked'; }?>
                              
                              ></form></td>
           				      <td><form action="gruposprospecto.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>"><input type="hidden" id="costeo" name="costeo" value="<?php if(strpos($fi['checklist'],"costeo;") !== false ){
							 echo str_replace("costeo;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'costeo;"';
							 
							 }?>">
                              <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"costeo;") !== false ){ echo 'checked'; }?>
                              
                              ></form></td>
           				      <td><form action="gruposprospecto.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>"><input type="hidden" id="programa" name="programa" value="<?php if(strpos($fi['checklist'],"programa;") !== false ){
							 echo str_replace("programa;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'programa;"';
							 
							 }?>">
                              <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"programa;") !== false ){ echo 'checked'; }?>
                              
                              ></form></td>
           				      <td><form action="gruposprospecto.php" method="post"><input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>"><input type="hidden" id="presentacion" name="presentacion" value="<?php if(strpos($fi['checklist'],"presentacion;") !== false ){
							 echo str_replace("presentacion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'presentacion;"';
							 
							 }?>">
                              <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"presentacion;") !== false ){ echo 'checked'; }?>
                              
                              ></form></td>
           				      <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
           				      <td>
                               <button type="button" class="btn-xs btn-primary" onClick="location.href='registrar_producto.php?prospecto=<?php echo $fi['id'];?>'">PROGRAMA</button>
                            
                            </td>
           				      <td>
                                   <button type="button" class="btn-xs btn-primary" onClick="location.href='prospecto.php?grupo=<?php echo $fi['id'];?>'">VER</button>
                                   
                                     <button type="button" class="btn-xs btn-primary" onClick="location.href='costeo.php?id_costeo=<?php echo $fi['id'];?>'">COSTEO</button>
                                     
                                     <button type="button" class="btn-xs btn-primary" onClick="location.href='gruposprospecto.php?historial=<?php echo $fi['id'];?>&estado=<?php echo $fi['estado'];?>'">HISTORIAL</button>
                                   
                           </td>
       				        </tr>
           				 
                            <?php
								}
								} ?>
                               <tr>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td><?php echo $total_insc;?></td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
           				      <td>&nbsp;</td>
       				        </tr>
         				    </table>
           				    <p>&nbsp;</p>
		<h2>GRUPOS ESPECIALES</h2>
           				<table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="false"          data-sort-order="desc" class="table table-hover">
           				      <thead>
           				        <tr>
           				          <th><strong>Grupo</strong>
           				            </td>
       				              <th><strong>Origen</strong>
         				              </td>
       				              <th><strong>Des<?php echo strtoupper( $fi['fecha_regreso']);?>tino</strong>
       				                </td>
   				                  <th><strong>Viajeros</strong> Estimados
     				                  </td>
   				                  <th>Fecha de Viaje estimado
			                      <th><strong>Estado</strong> 
		                          <th><span title="Reunion">RE</span> 
		                          <th><span title="Costeo">CO</span> 
	                              <th><span title="Programa">PG</span> 
	                              <th><span title="Presentacion">PR</span> 
                                  <th><strong>Encargado</strong> 
                                  <th>Convertir
                                  <th><strong>Ver</strong>
 				                                        </td>
                              </thead>
           				      <?php 
							$total_insc=0;
						
							$resultado=$control->prospectos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								if($fi['unidad_negocio']=='EVENTOS ESPECIALES' || $fi['unidad_negocio']=='EVENTOS DEPORTIVOS' ){
				
									$color_estado = $control->colorEstado($fi['estado']);
								
							?>
           				      <tr bgcolor="<?php echo $color_estado;?>">
           				        <td><a href="prospecto.php?grupo=<?php echo $fi['id'];?>" target="_self"><?php echo strtoupper($fi['nombre_grupo']);?></a></td>
           				        <td><?php echo strtoupper($fi['origen']);?></td>
           				        <td><?php echo strtoupper( $fi['destino']);?></td>
           				        <td><?php echo $fi['cantidad_viajeros'];
							  $total_insc=$total_insc+$fi['cantidad_viajeros'];?></td>
           				        <td><?php 
							  
							  $salida = new DateTime($fi['fecha_salida']);
					$llegada = new DateTime($fi['fecha_regreso']);
	$fecha_max= $control->proximaFecha($fi['id']);

     $datediff = strtotime($fecha_max)- strtotime(date("Y-m-d"));
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['fecha_salida']);?></td>
           				        <td><?php $color_estado = $control->colorEstado($fi['estado']);?>
           				          <span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="reunion" name="reunion" value="<?php if(strpos($fi['checklist'],"reunion;") !== false ){
							 echo str_replace("reunion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'reunion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"reunion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="costeo" name="costeo" value="<?php if(strpos($fi['checklist'],"costeo;") !== false ){
							 echo str_replace("costeo;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'costeo;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"costeo;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="programa" name="programa" value="<?php if(strpos($fi['checklist'],"programa;") !== false ){
							 echo str_replace("programa;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'programa;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"programa;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="presentacion" name="presentacion" value="<?php if(strpos($fi['checklist'],"presentacion;") !== false ){
							 echo str_replace("presentacion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'presentacion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"presentacion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='registrar_producto.php?prospecto=<?php echo $fi['id'];?>'">PROGRAMA</button></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='prospecto.php?grupo=<?php echo $fi['id'];?>'">VER</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='costeo.php?id_costeo=<?php echo $fi['id'];?>'">COSTEO</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='gruposprospecto.php?historial=<?php echo $fi['id'];?>&estado=<?php echo $fi['estado'];?>'">HISTORIAL</button></td>
       				          </tr>
           				      <?php
								}
								} ?>
           				      <tr>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td><?php echo $total_insc;?></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
       				          </tr>
         				      </table>
           				    <p>
								
									<h2>GRUPOS VACACIONALES</h2>
           				  <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="false"          data-sort-order="desc" class="table table-hover">
           				      <thead>
           				        <tr>
           				          <th><strong>Grupo</strong>
           				            </td>
       				              <th><strong>Origen</strong>
         				              </td>
       				              <th><strong>Des<?php echo strtoupper( $fi['fecha_regreso']);?>tino</strong>
       				                </td>
   				                  <th><strong>Viajeros</strong> Estimados
     				                  </td>
   				                  <th>Fecha de Viaje estimado
			                      <th><strong>Estado</strong> 
		                          <th><span title="Reunion">RE</span> 
		                          <th><span title="Costeo">CO</span> 
	                              <th><span title="Programa">PG</span> 
	                              <th><span title="Presentacion">PR</span> 
                                  <th><strong>Encargado</strong> 
                                  <th>Convertir
                                  <th><strong>Ver</strong>
 				                                        </td>
                              </thead>
           				      <?php 
							$total_insc=0;
						
							$resultado=$control->prospectos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								if($fi['unidad_negocio']=='GRUPOS VACACIONALES'){
				
									$color_estado = $control->colorEstado($fi['estado']);
								
							?>
           				      <tr bgcolor="<?php echo $color_estado;?>">
           				        <td><a href="prospecto.php?grupo=<?php echo $fi['id'];?>" target="_self"><?php echo strtoupper($fi['nombre_grupo']);?></a></td>
           				        <td><?php echo strtoupper($fi['origen']);?></td>
           				        <td><?php echo strtoupper( $fi['destino']);?></td>
           				        <td><?php echo $fi['cantidad_viajeros'];
							  $total_insc=$total_insc+$fi['cantidad_viajeros'];?></td>
           				        <td><?php 
							  
							  $salida = new DateTime($fi['fecha_salida']);
					$llegada = new DateTime($fi['fecha_regreso']);
	$fecha_max= $control->proximaFecha($fi['id']);

     $datediff = strtotime($fecha_max)- strtotime(date("Y-m-d"));
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['fecha_salida']);?></td>
           				        <td><?php $color_estado = $control->colorEstado($fi['estado']);?>
           				          <span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="reunion" name="reunion" value="<?php if(strpos($fi['checklist'],"reunion;") !== false ){
							 echo str_replace("reunion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'reunion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"reunion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="costeo" name="costeo" value="<?php if(strpos($fi['checklist'],"costeo;") !== false ){
							 echo str_replace("costeo;",";",$fi['checklist']);
							 }else {

							 echo $fi['checklist'].'costeo;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"costeo;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="programa" name="programa" value="<?php if(strpos($fi['checklist'],"programa;") !== false ){
							 echo str_replace("programa;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'programa;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"programa;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="presentacion" name="presentacion" value="<?php if(strpos($fi['checklist'],"presentacion;") !== false ){
							 echo str_replace("presentacion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'presentacion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"presentacion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='registrar_producto.php?prospecto=<?php echo $fi['id'];?>'">PROGRAMA</button></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='prospecto.php?grupo=<?php echo $fi['id'];?>'">VER</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='costeo.php?id_costeo=<?php echo $fi['id'];?>'">COSTEO</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='gruposprospecto.php?historial=<?php echo $fi['id'];?>&estado=<?php echo $fi['estado'];?>'">HISTORIAL</button></td>
       				          </tr>
           				      <?php
								}
								} ?>
           				      <tr>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td><?php echo $total_insc;?></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
       				          </tr>
         				      </table>
           				    <p>
								
								<h2>RESERVAS INDIVIDUALES</h2>
           				  <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="false"          data-sort-order="desc" class="table table-hover">
           				      <thead>
           				        <tr>
           				          <th><strong>Grupo</strong>
           				            </td>
       				              <th><strong>Origen</strong>
         				              </td>
       				              <th><strong>Des<?php echo strtoupper( $fi['fecha_regreso']);?>tino</strong>
       				                </td>
   				                  <th><strong>Viajeros</strong> Estimados
     				                  </td>
   				                  <th>Fecha de Viaje estimado
			                      <th><strong>Estado</strong> 
		                          <th><span title="Reunion">RE</span> 
		                          <th><span title="Costeo">CO</span> 
	                              <th><span title="Programa">PG</span> 
	                              <th><span title="Presentacion">PR</span> 
                                  <th><strong>Encargado</strong> 
                                  <th>Convertir
                                  <th><strong>Ver</strong>
 				                                        </td>
                              </thead>
           				      <?php 
							$total_insc=0;
						
							$resultado=$control->prospectos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								if($fi['unidad_negocio']=='RESERVAS INDIVIDUALES'){
				
									$color_estado = $control->colorEstado($fi['estado']);
								
							?>
           				      <tr bgcolor="<?php echo $color_estado;?>">
           				        <td><a href="prospecto.php?grupo=<?php echo $fi['id'];?>" target="_self"><?php echo strtoupper($fi['nombre_grupo']);?></a></td>
           				        <td><?php echo strtoupper($fi['origen']);?></td>
           				        <td><?php echo strtoupper( $fi['destino']);?></td>
           				        <td><?php echo $fi['cantidad_viajeros'];
							  $total_insc=$total_insc+$fi['cantidad_viajeros'];?></td>
           				        <td><?php 
							  
							  $salida = new DateTime($fi['fecha_salida']);
					$llegada = new DateTime($fi['fecha_regreso']);
	$fecha_max= $control->proximaFecha($fi['id']);

     $datediff = strtotime($fecha_max)- strtotime(date("Y-m-d"));
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['fecha_salida']);?></td>
           				        <td><?php $color_estado = $control->colorEstado($fi['estado']);?>
           				          <span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="reunion" name="reunion" value="<?php if(strpos($fi['checklist'],"reunion;") !== false ){
							 echo str_replace("reunion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'reunion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"reunion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="costeo" name="costeo" value="<?php if(strpos($fi['checklist'],"costeo;") !== false ){
							 echo str_replace("costeo;",";",$fi['checklist']);
							 }else {

							 echo $fi['checklist'].'costeo;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"costeo;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="programa" name="programa" value="<?php if(strpos($fi['checklist'],"programa;") !== false ){
							 echo str_replace("programa;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'programa;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"programa;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="presentacion" name="presentacion" value="<?php if(strpos($fi['checklist'],"presentacion;") !== false ){
							 echo str_replace("presentacion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'presentacion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"presentacion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='registrar_producto.php?prospecto=<?php echo $fi['id'];?>'">PROGRAMA</button></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='prospecto.php?grupo=<?php echo $fi['id'];?>'">VER</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='costeo.php?id_costeo=<?php echo $fi['id'];?>'">COSTEO</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='gruposprospecto.php?historial=<?php echo $fi['id'];?>&estado=<?php echo $fi['estado'];?>'">HISTORIAL</button></td>
       				          </tr>
           				      <?php
								}
								} ?>
           				      <tr>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td><?php echo $total_insc;?></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
       				          </tr>
         				      </table>
           				    <p>
								
									<h2>GRUPOS RECEPTIVOS</h2>
           				    <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" 
data-show-export="false"          data-sort-order="desc" class="table table-hover">
           				      <thead>
           				        <tr>
           				          <th><strong>Grupo</strong>
           				            </td>
       				              <th><strong>Origen</strong>
         				              </td>
       				              <th><strong>Des<?php echo strtoupper( $fi['fecha_regreso']);?>tino</strong>
       				                </td>
   				                  <th><strong>Viajeros</strong> Estimados
     				                  </td>
   				                  <th>Fecha de Viaje estimado
			                      <th><strong>Estado</strong> 
		                          <th><span title="Reunion">RE</span> 
		                          <th><span title="Costeo">CO</span> 
	                              <th><span title="Programa">PG</span> 
	                              <th><span title="Presentacion">PR</span> 
                                  <th><strong>Encargado</strong> 
                                  <th>Convertir
                                  <th><strong>Ver</strong>
 				                                        </td>
                              </thead>
           				      <?php 
							$total_insc=0;
						
							$resultado=$control->prospectos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								if($fi['unidad_negocio']=='GRUPOS RECEPTIVOS'){
				
									$color_estado = $control->colorEstado($fi['estado']);
								
							?>
           				      <tr bgcolor="<?php echo $color_estado;?>">
           				        <td><a href="prospecto.php?grupo=<?php echo $fi['id'];?>" target="_self"><?php echo strtoupper($fi['nombre_grupo']);?></a></td>
           				        <td><?php echo strtoupper($fi['origen']);?></td>
           				        <td><?php echo strtoupper( $fi['destino']);?></td>
           				        <td><?php echo $fi['cantidad_viajeros'];
							  $total_insc=$total_insc+$fi['cantidad_viajeros'];?></td>
           				        <td><?php 
							  
							  $salida = new DateTime($fi['fecha_salida']);
					$llegada = new DateTime($fi['fecha_regreso']);
	$fecha_max= $control->proximaFecha($fi['id']);

     $datediff = strtotime($fecha_max)- strtotime(date("Y-m-d"));
     $dias= floor($datediff/(60*60*24))+1;
							  
							  echo strtoupper( $fi['fecha_salida']);?></td>
           				        <td><?php $color_estado = $control->colorEstado($fi['estado']);?>
           				          <span style="background-color:<?php echo $color_estado;?>;padding:5px;"><?php echo strtoupper( $fi['estado']);?></span></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="reunion" name="reunion" value="<?php if(strpos($fi['checklist'],"reunion;") !== false ){
							 echo str_replace("reunion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'reunion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"reunion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="costeo" name="costeo" value="<?php if(strpos($fi['checklist'],"costeo;") !== false ){
							 echo str_replace("costeo;",";",$fi['checklist']);
							 }else {

							 echo $fi['checklist'].'costeo;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"costeo;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="programa" name="programa" value="<?php if(strpos($fi['checklist'],"programa;") !== false ){
							 echo str_replace("programa;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'programa;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"programa;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><form action="gruposprospecto.php" method="post">
           				          <input type="hidden" id="id" name="id" value="<?php echo $fi['id']?>">
           				          <input type="hidden" id="presentacion" name="presentacion" value="<?php if(strpos($fi['checklist'],"presentacion;") !== false ){
							 echo str_replace("presentacion;",";",$fi['checklist']);
							 }else {
							 echo $fi['checklist'].'presentacion;"';
							 
							 }?>">
           				          <input type="checkbox"   onChange="this.form.submit()"
                             <?php if(strpos($fi['checklist'],"presentacion;") !== false ){ echo 'checked'; }?>
                              
                              >
         				          </form></td>
           				        <td><?php  $usuario=$control->datosUsuario($fi['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='registrar_producto.php?prospecto=<?php echo $fi['id'];?>'">PROGRAMA</button></td>
           				        <td><button type="button" class="btn-xs btn-primary" onClick="location.href='prospecto.php?grupo=<?php echo $fi['id'];?>'">VER</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='costeo.php?id_costeo=<?php echo $fi['id'];?>'">COSTEO</button>
           				          <button type="button" class="btn-xs btn-primary" onClick="location.href='gruposprospecto.php?historial=<?php echo $fi['id'];?>&estado=<?php echo $fi['estado'];?>'">HISTORIAL</button></td>
       				          </tr>
           				      <?php
								}
								} ?>
           				      <tr>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td><?php echo $total_insc;?></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
       				          </tr>
         				      </table>
           				    <p>
                               <script type="text/javascript">
        $(function () {
			$('table').footable();

            $('.sort-column').click(function (e) {
                e.preventDefault();

                //get the footable sort object
                var footableSort = $('table').data('footable-sort');

                //get the index we are wanting to sort by
                var index = $(this).data('index');

                footableSort.doSort(index, 'toggle');
            });
        });
                               </script>
                             </p>
			              </div>
           				</div>
                        </div>
                        </div>
                        </div>
    </body>
