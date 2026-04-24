<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 


 $actividades= array("Planeación/Descripción del programa",
"Planeación/Contrato con contacto estratégico",
"Planeación/Definición mercado objetivo",
"Planeación/Viaje de inspección",
"Planeación/Cotización de cupos aéreos",
"Planeación/Cotización servicios terrestres",
"Planeación/Definición de personal",
"Planeación/Costeo",
"Planeación/Aprobación del costeo",
"Planeación/Bloqueo de cupos aéreos",
"Planeación/Reserva de servicios terrestres",
"Planeación/Elaboración del programa Final","Plan de mercadeo/Definición de canales",
"Plan de mercadeo/Definición fuerza de ventas",
"Plan de mercadeo/Definición piezas publicitarias por canal",
"Plan de mercadeo/Definir actividades de lanzamiento",
"Plan de mercadeo/Elaborar encuesta de satisfacción",
"Plan de mercadeo/Cronograma por pieza (periodo de venta)","Ventas/Lanzamiento",
"Ventas/Ejecución de cronograma de piezas",
"Ventas/Reunión de ventas Externas",
"Ventas/Reunión de ventas Internas",
"Ventas/Seguimiento a clientes",
"Ventas/Ultima fecha de reducción cupos aéreos","Logística/Recepción de los pagos",
"Logística/Emisión tiquetes aéreos",
"Logística/Confirmación de los receptivos",
"Logística/Elaboración y envío de vouchers de Servicios",
"Logística/Contratación de personal",
"Logística/Capacitación de personal",
"Logística/Operación en destino",
"Logística/Encuesta de satisfacción",
"Logística/Viaje");
 
 $id_grupo=$_REQUEST['grupo'];
 
$prod=$control->datosProducto($id_grupo);

 
 //var_dump($vouchers);
if(isset($_REQUEST['actividad'])){
	var_dump("OK**");
	$resultado=$control->registrarTablero($id_grupo,$_REQUEST['actividad'],$_REQUEST['encargado'],$_REQUEST['fecha']);
}

?>

    <script type="text/javascript" src="programas/accordion.js"></script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="module-body">
            <form id="form1" name="form1" method="post" action="tablero_control.php">
            
            <input type="hidden" name="grupo" id="grupo" value="<?php echo $id_grupo;?>">
      
                  <div class="panel panel-default">
                    <div class="panel-heading">TABLERO DE CONTROL <?php echo $prod['grupo']?></div>
                    <div class="panel-body">
                      <div class="module-body">
                        <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						 
	$prospecto=$control->datosProducto($id_grupo);
	//var_dump($viajero);?>
                        <?php if(isset($mensaje)){?>
                        <div class="alert">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                          <?php echo $mensaje;?></div>
                        <?php } ?>
                        <table data-toggle="false" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
                          <thead>
                            <tr>
                              <th><strong>Actividad</strong></th>
                              <th><strong>Responsable</strong></th>
                              <th ><strong>Fecha</strong></th>
                            </thead>
                            </tr>
                          <tr>
                            <?php 
							
							foreach ($actividades as $id=>$actividad) {
							?>
                            
                            <td><?php echo $actividad;?>
                            <input type="hidden" name="actividad[<?php echo $id; ?>]" id="actividad[<?php echo $id; ?>]" value="<?php echo $actividad;?>"></td>
                            <td><select name="encargado[<?php echo $id; ?>]" id="encargado[<?php echo $id; ?>]">
                              <?php  	$res=$control->listaUsuarios();
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
                              <option value="<?php echo $fi['user_id']; ?>"<?php if($_SESSION['id'] == $fi['user_id']){ echo "selected";}?> ><?php echo $fi['nombre'];?></option>
                              <?php } ?>
                            </select></td>
                            <td>
                              <input type="date" name="fecha[<?php echo $id; ?>]" id="fecha[<?php echo $id; ?>]" style="line-height: 14px;"></td>
                            </tr>
                          <?php } ?>
                        </table>
                        <p>
                          <input type="submit" name="submit" id="submit" value="Registrar">
                          <input name="grupo" type="hidden" id="grupo" value="<?php echo $id_grupo ?>">
                        </p>
                      </div>
                    </div>
                  </div>
                                 <strong></strong>              
            
            </form>
          </div></div> 
        </div>
      
</div>
    </div>
                        </div>
                        
    </body>
