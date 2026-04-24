<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

if(isset($_REQUEST['tipo_costeo'])){
	$mensaje=$control->registrarServicioProveedor($_REQUEST['proveedor'],$_REQUEST['nombre'],$_REQUEST['tipo_costeo']);
	
}

if(isset($_REQUEST['pax_desde'])){
	$mensaje=$control->registarTarifaServicio($_REQUEST['id_servicio'],$_REQUEST['pax_desde'],$_REQUEST['pax_hasta'],$_REQUEST['desde'],$_REQUEST['hasta'],$_REQUEST['tarifa'],$_REQUEST['observaciones']);
	
}

$proveedor=$control->datosProveedor($_REQUEST['proveedor']);




 
	
?>


    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">SERVICIOS PROVEEDOR</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                            <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
           				        <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				          <tr>
           				            <td bgcolor="#CCCCCC">Nombre Proveedor:</td>
           				            <td><?php echo $proveedor['nombre'];?></td>
           				            <td bgcolor="#CCCCCC">Categoría:</td>
           				            <td><?php echo $proveedor['categoria'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Pais:           				              </td>
           				            <td><?php echo $proveedor['pais'];?></td>
           				            <td bgcolor="#CCCCCC">Ciudad:</td>
           				            <td><?php echo $proveedor['ciudad'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Servicio</td>
           				            <td><p><?php echo $proveedor['servicio'];?></p></td>
           				            <td bgcolor="#CCCCCC">Metodologia de Pago</td>
           				            <td><p><?php echo $proveedor['formas_pago'];?></p></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">RUT /Nro Fiscal:</td>
           				            <td><?php echo $proveedor['rut'];?></td>
           				            <td bgcolor="#CCCCCC">Direccion Fiscal:</td>
           				            <td><?php echo $proveedor['direccion'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Celular:</td>
           				            <td><?php echo $proveedor['celular'];?></td>
           				            <td bgcolor="#CCCCCC">Telefono:</td>
           				            <td><?php echo $proveedor['telefono'];?></td>
       				              </tr>
           				          <tr>
           				            <td bgcolor="#CCCCCC">Email:</td>
           				            <td><?php echo $proveedor['email'];?></td>
           				            <td bgcolor="#CCCCCC">&nbsp;</td>
           				            <td>&nbsp;</td>
       				              </tr>
   				            </table>
							  
           				        <h2>REGISTRAR SERVICIO</h2>
							  <form method="post" action="proveedor_servicios.php">
           				        <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				          <tr>
           				            <td bgcolor="#CCCCCC">Nombre Servicio:</td>
           				            <td>
           				              <input type="hidden" id="proveedor" name="proveedor" value="<?php echo $_REQUEST['proveedor'];?>">
           				           
       				                  <input type="text" name="nombre" id="nombre" placeholder="nombre servicio" >
       				                  <br>
           				              <span id="saldo"></span></td>
           				            <td>Tipo Costeo:</td>
           				            <td><select name="tipo_costeo" id="tipo_costeo"  >
           				              <option value="DIRECTO">DIRECTO</option>
           				              <option value="GRUPAL">GRUPAL</option>
           				              <option value="POR NOCHE">POR NOCHE</option>
										<option value="POR DIA">POR DIA</option>
       				                </select></td>
       				              </tr>
           				          <tr>
           				            <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"></td>
       				              </tr>
   				            </table>
						    </form>
           				        <p>&nbsp;</p>
							  <form action="proveedor_servicios.php" method="post"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000" id="list" data-toggle="table">
           				      <thead>
           				        <tr>
           				          <th data-sortable="true" data-field="contrato">SERVICIO</th>
           				          <th>OBSERVACIONES</th>
           				          <th>PAX DESDE</th>
           				          <th>PAX HASTA</th>
           				          <th>FECHA DESDE</th>
           				          <th>FECHA HASTA</th>
           				          <th><strong>TARIFA</strong></th>
       				            </tr>
       				          </thead>
                              <tr>
           				        <td>
                                <input type="hidden" id="proveedor" name="proveedor" value="<?php echo $_REQUEST['proveedor']?>" />
                                <select name="id_servicio" id="id_servicio" data-placeholder="Seleccione Servicio" class="chosen-select" >
                                  <option value="0" selected disabled>SELECCIONE SERVICIO</option>
                                  <?php 
							
							$resultado=$control->listaServiciosProveedor($_REQUEST['proveedor']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                                  <option value="<?php echo $fi['id'] ?>"><?php echo strtoupper($fi['nombre'])."()".strtoupper($fi['tipo_costeo']).")";?></option>
                                  <?php } ?>
                                </select></td>
           				        <td><input type="text" id="observaciones" name="observaciones"></td>
           				        <td><input type="number" id="pax_desde" name="pax_desde" value="0"></td>
           				        <td><input type="number" id="pax_hasta" name="pax_hasta" value="1000"></td>
           				        
           				        <td>
                                <input type="date" name="desde" id="desde"></td>
           				        <td> <input type="date" name="hasta" id="hasta"></td>
           				        <td><input type="text" id="tarifa" name="tarifa">
       				            <input type="submit" name="submit" id="submit" value="Guardar"></td>
       				          </tr>
           				      <?php 
							
							$resultado=$control->tarifasServiciosProveedor($_REQUEST['proveedor']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								

	

							?>
           				      
           				      <tr>
           				        <td><?php echo $fi['nombre']." - ".$fi['tipo_costeo']; ?></td>
           				        <td><?php echo $fi['observaciones']; ?></td>
           				        <td><?php echo $fi['desde_pax']; ?></td>
           				        <td><?php echo $fi['hasta_pax']; ?></td>
           				        <td><?php echo $fi['desde_fecha']; ?></td>
           				        <td><?php echo $fi['hasta_fecha'];?></td>
           				        <td><?php echo number_format($fi['tarifa'],0);?></td>
       				          </tr>
           				      <?php } ?>
       				        </table></form>
           				  </div>
   				      <h2>&nbsp;	</h2>
					</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
