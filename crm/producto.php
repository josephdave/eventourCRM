<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
 $id_grupo = $_REQUEST['grupo'];
 
 $prospecto=$control->datosProducto($id_grupo);

$id_post = "p"+$id_grupo;
$carta_aceptacion=0;

if($id_grupo == 141){
	$carta_aceptacion=1;
	}
if(isset($_REQUEST['borrar']) && $_REQUEST['borrar'] != 0){
	
	$resultado=$control->borrarRegistro($_REQUEST['borrar']);
	}

if($_POST["estado_viajero"] == 1){
	$resultado=$control->registrarEstadoID($_REQUEST['idviajero'],$_REQUEST['estado_viaje']);
	
	}


if(isset($_REQUEST["borra_calendario"]) ){
	$resultado=$control->borrarCalendario($_REQUEST['borra_calendario'],$_REQUEST["grupo"]);
	
	}
	
	if(isset($_REQUEST["borrarcontacto"]) ){
	$resultado=$control->borrarContacto($_REQUEST['borrarcontacto']);
	
	}
	
if(isset($_REQUEST["archivar"]) ){
	$resultado=$control->archivarPrograma($_REQUEST['archivar'],$_REQUEST['estado_final']);
	
	}

if(isset($_POST["estado"]) ){
	$resultado=$control->registrarEstadoGrupo($_REQUEST['grupo'],$_REQUEST['estado']);
	
	}

if(isset($_POST["estado2"]) ){
	$resultado=$control->registrarEstadoContacto($_REQUEST['id_contacto'],$_REQUEST['estado2']);
	
	}

if(isset($_REQUEST["borra_tiquete"]) ){
	$resultado=$control->borraTiquetes($_REQUEST['borra_tiquete']);
	
	}
	
	
if(isset($_REQUEST["borra_hotel"]) ){
	$resultado=$control->borraHotel($_REQUEST['borra_hotel']);
	
	}

if(isset($_REQUEST["borra_adicional"]) ){
	$resultado=$control->borraAdicional($_REQUEST['borra_adicional']);
	
	}
	
	
if(isset($_POST["estado"]) ){
	$resultado=$control->registrarEstadoProducto($_REQUEST['grupo'],$_REQUEST['estado']);
	
	}
	
	
if(isset($_POST["observaciones"]) ){
	$resultado=$control->registrarObservaciones($_REQUEST['idviajero'],$_REQUEST['observaciones']);
	
	}

if(isset($_POST["estado2"]) ){
	$resultado=$control->registrarEstadoContacto($_REQUEST['id_contacto'],$_REQUEST['estado2']);
	
	}
	
	
	if(isset($_POST["record"]) ){
	$resultado=$control->registrarRecord($_REQUEST['idviajero'],$_REQUEST['record']);
	
	$contrato = $control->datosRecordPrograma($_REQUEST['record'],$id_grupo);
	
	
	
	$viaj=$control->datosViajeroID($_REQUEST['idviajero']);
	
	$valortk= $control->valorViajeroTK($viaj['otro'],$prospecto);
	
	if(($contrato['modificacion_valor'] != 0) || ($contrato['ppal'] == 3)){
	
		$control->registrarModificaciones($id_grupo,$_REQUEST['idviajero'],-$valortk,'TK','Retiro Tiquete Principal');
	
	
		$control->registrarModificaciones($id_grupo,$_REQUEST['idviajero'],$contrato['modificacion_valor'],'TK','Modificacion tiquete RECORD:'.$_REQUEST['record']);
		
	
	}
	
	
	
	}
	
	
	
	if(isset($_POST["fecha_presentacion"]) ){
	$resultado=$control->registrarFechaPresentacion($_REQUEST['grupo'],$_REQUEST['fecha_presentacion']);
	
	}

?>

    <script type="text/javascript" src="programas/accordion.js"></script>
   

      
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PROGRAMA</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						 
	
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                            <h2><?php echo $prospecto['grupo']; ?></h2>
                            <table width="100%" border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" style="" class="table demo">
                              <tr>
                                <td colspan="3" align="right" bgcolor="#CCCCCC"><a href="registrar_producto.php?modificar=<?php echo $id_grupo;?>">Modificar</a>   <a href="grupos.php?borrar=<?php echo $id_grupo;?>" onclick="return confirm('Desea Borrar?')">Borrar</a></td>
                                
                               
                              </tr>
                              <tr>
                                <td bgcolor="#CCCCCC">Logo</td>
                                <td><a href="upload.php?grupo=<?php echo $prospecto['id'] ?>">
                                <?php if(file_exists("imagenes/productos/logo_".$prospecto['id'].".jpg")){?><img src="http://eventoursport.travel/crm/imagenes/productos/logo_<?php echo $prospecto['id'] ?>.jpg"  alt="" width="150"/><?php } else{?>
                                <img src="imagenes/productos/nologo.jpg" width="150" height="150"  alt=""/>
                                <?php } ?></a></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
    <td bgcolor="#CCCCCC"><strong>Nombre:</strong></td>
    <td><?php echo $prospecto['grupo']; ?></td>
    <td><?php echo $prospecto['cant_viajeros']; ?></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC"><strong>Fecha Salida:</strong></td>
    <td><?php echo date_format(date_create($prospecto['f_salida']),"d-m-Y"); ?></td>
    <td><?php echo date_format(date_create($prospecto['f_llegada']),"d-m-Y"); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Origen:</strong></td>
    <td><?php echo $prospecto['origen'] ?></td>
    <td><?php echo $prospecto['destino'] ?></td>
  </tr>
  
  <tr>
    <td bgcolor="#CCCCCC"><strong>Estado:</strong></td>
    <td> <form id="form1" name="form1" method="post"  action="producto.php" style="margin:0 !important;">
      <input type="hidden" value="<?php echo $id_grupo?>" name="grupo" id="grupo"/>
      <select name="estado" id="estado" onchange="getElementById('form1').submit()">
        <?php  	$res=$control->listaEstadosProspecto('PROGRAMA');
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
        <option value="<?php echo $fi['estado']; ?>"<?php if($fi['estado'] == $prospecto['estado']){ echo "selected";}?> ><?php echo $fi['estado'];?></option><?php } ?>
        </select>
      &nbsp;&nbsp;&nbsp;<a href="producto.php?archivar=<?php echo $prospecto['id'] ?>&estado_final=<?php echo $prospecto['estado']; ?>&grupo=<?php echo $prospecto['id'] ?>">ARCHIVAR PROGRAMA</a>
    </form></td>
    <td><?php  $usuario=$control->datosUsuario($prospecto['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#003366" ><strong style="color:#FFF !important;">PROGRAMA: <?php if($prospecto['unidad_negocio']!='GRUPOS JUVENILES'){?>
    <a href="https://eventoursport.travel/crm/programas/grupos_especiales.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">https://eventoursport.travel/crm/programas/grupos_especiales.php?plan=<?php echo $prospecto['id'] ?></a>
    <?php }else{ ?>
    <a href="https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $prospecto['id'] ?></a>
    
    <?php } ?></strong></td>
    </tr>
  <tr>
    <td colspan="3" bgcolor="#FFFFFF"><div class="accordion">
      <div class="accordion-section" > <a class="accordion-section-title" href="#accordion-1" >INCLUYE</a>
          <div id="accordion-1" class="accordion-section-content"><?php echo $prospecto['incluye'] ?></div>
          <!--end .accordion-section-content-->
          </div>
        <!--end .accordion-section--><!--end .accordion-section--><!--end .accordion-section-->
        
        <!--end .accordion-section-->
        <!--end .accordion-section-->
    </div>
      <div class="accordion">
        <div class="accordion-section" > <a class="accordion-section-title" href="#accordion-2" >ITINERARIO</a>
          <div id="accordion-2" class="accordion-section-content"><?php echo $prospecto['itinerario'] ?></div>
          <!--end .accordion-section-content-->
        </div>
        <!--end .accordion-section-->
        <!--end .accordion-section-->
        <!--end .accordion-section-->
        <!--end .accordion-section-->
        <!--end .accordion-section-->
      </div>
      <div class="accordion">
        <div class="accordion-section" > <a class="accordion-section-title" href="#accordion-3" >TERMINOS Y CONDICIONES</a>
          <div id="accordion-3" class="accordion-section-content"><?php echo $prospecto['terminoscondiciones'] ?></div>
          <!--end .accordion-section-content-->
        </div>
        <!--end .accordion-section-->
        <!--end .accordion-section-->
        <!--end .accordion-section-->
        <!--end .accordion-section-->
        <!--end .accordion-section-->
      </div></td>
    </tr>
 <!-- <tr>
    <td bgcolor="#CCCCCC">Itinerario:</td>
    <td colspan="3"><?php echo $prospecto['itinerario'] ?></td>
  </tr>-->
  <tr>
    <td colspan="3" bgcolor="#003366"><strong style="color:#FFF !important;">INFORMACIÓN DEL PROGRAMA</strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><p>TIQUETES
      </p>
      <p>
        <input type="button" name="button3" id="button3" value="Registrar Tiquetes" onclick="location.href='registrar_sillasgrupo.php?idgrupo=<?php echo $id_grupo?>';" >
      </p></td>
    <td colspan="2"><table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      <tr>
           				      <th ><strong>Nombre</strong></th>
           				      <th><strong>Aerolinea</strong></th>
           				      <th><strong>Record</strong></th>
           				      <th>Principal</th>
           				      <th> Solicitados</th>
           				      <th><strong> Confirmados</strong></th>
           				      <th > Reservados</th>
           				      <th >
       				           con pago</th>
           				      <th ><strong>Origen</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Destino</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Ruta</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Vuelo llegada a destino </strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Vuelo llegada Origen</strong></th>
           				                               <th><strong>Valor</strong></th>
                                                       
                                <th><strong>Politica TC</strong></th>	                               <th><strong>Vlr TC</strong></th>
                                                            
                                <th data-hide="all" data-visible="false"><strong>F Deposito</strong></th>
                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>Deposito xPAx</strong></th>
                                                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F. Cambios</strong></th>	                               <th data-hide="all" data-visible="false"><strong>F. Nombres</strong></th>	                               <th data-hide="all" data-visible="false"><strong>F. Emision</strong></th>
                                                                                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F. Impuestos</strong></th>
           				      
       				        </thead>
                            
                            
								
           				    
                            
                            <?php 
							$sum_cupo=0;
							$sum_reservados=0;
							$sum_conpago=0;
							$sum_originales=0;
							
							$resultado=$control->cuposAereosPrograma($id_grupo);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								$producto=$control->datosProducto($fi['id_grupo']);
								
								if($producto['estado']!='HISTORIAL' && $fi['principal']!=3){
								
								
								
							?>
                <tr>
                             <td><?php echo strtoupper($fi['nombre']);?></td> <td><?php echo strtoupper($fi['aerolinea']);?></td>
                             <td><?php echo strtoupper($fi['record']);?></td>
                             <td><?php if($fi['principal']==1){echo "SI";}else{echo "NO";}?></td>
                             <td><?php 
							 $sum_originales+=$fi['cupos_originales'];
							 echo $fi['cupos_originales'];?></td>
                             <td><?php 
							 $sum_cupo+=$fi['cupos_solicitados'];
							 echo $fi['cupos_solicitados'];?></td>
                             <td><?php 
							 
							 $usados=$control->cuposRecordsinPago($fi['id_sillas']);
							$sum_reservados+=$usados;
							 
							 echo $usados;?></td>
                             <td><?php 
							 
							 $usados=$control->cuposRecord($fi['id_sillas']);
							 $sum_conpago+=$usados;					
							 
							 echo $usados;?></td>
                             <td><?php echo $fi['origen'];?></td>
                             <td><?php echo $fi['destino'];?></td>
                             <td><?php echo $fi['ruta'];?></td>
           				      <td><?php echo $fi['vuelo_llegada_destino']." ".date("d-m-Y H:m", strtotime($fi['fecha_salida']));?></td>
                              <td><?php echo $fi['vuelo_llegada_origen']." ".date("d-m-Y H:m", strtotime($fi['fecha_regreso']));?></td>
           				      <td><?php 
							  echo "$".$producto['MONEDA']." ". number_format(($fi['tadmin']*1.19)+$fi['neta_q']+$fi['q']+$control->impuestosRecord($fi['ida']),0,',','.')?></td>
                              
                              
			      <td><?php echo strtoupper($fi['politica_tc']);?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['vlr_tc'],0,',','.')?></td>
                              
                              <td><?php echo date("d-m-Y", strtotime($fi['f_deposito']));?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['deposito_pax'],0,',','.')?></td>
                              <td>
                              <?php echo date("d-m-Y", strtotime($fi['f_cambios']));?></td>
                             <td> <?php echo date("d-m-Y", strtotime($fi['f_nombres']));?></td>
                              <td><?php echo date("d-m-Y ", strtotime($fi['f_emision']));?></td>
                            <td>  <?php echo date("d-m-Y", strtotime($fi['f_impuestos']));?></td>
           				        				      
		        
           				 
                            <?php }} ?>
                            </tr>
                <tr>
                  <td>TOTALES</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><?php echo $sum_originales ?></td>
                  
                  <td><?php echo $sum_cupo ?></td>
                  <td><?php echo $sum_reservados ?></td>
                  <td><?php echo $sum_conpago ?></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
                           <div class="accordion">
        <div class="accordion-section" > <a class="accordion-section-title" href="#accordion-4" >CONTRATOS EXTERNOS</a>
          <div id="accordion-4" class="accordion-section-content"> <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      <tr>
           				      <th ><strong>Nombre</strong></th>
           				      <th><strong>Aerolinea</strong></th>
           				      <th><strong>Record</strong></th>
           				      <th>Principal</th>
           				      <th><strong>Cupos </strong></th>
           				      <th >Cupos Reservados</th>
           				      <th ><p>Cupos<br>
           				         con pago</p></th>
           				      <th ><strong>Origen</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Destino</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Ruta</strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Vuelo llegada a destino </strong></th>
           				      <th data-hide="all" data-visible="false"><strong>Vuelo llegada Origen</strong></th>
           				                               <th><strong>Valor</strong></th>
                                                       
                                <th><strong>Politica TC</strong></th>	                               <th><strong>Vlr TC</strong></th>
                                                            
                                <th data-hide="all" data-visible="false"><strong>F Deposito</strong></th>
                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>Deposito xPAx</strong></th>
                                                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F. Cambios</strong></th>	                               <th data-hide="all" data-visible="false"><strong>F. Nombres</strong></th>	                               <th data-hide="all" data-visible="false"><strong>F. Emision</strong></th>
                                                                                                                                                                                                                       	                               <th data-hide="all" data-visible="false"><strong>F. Impuestos</strong></th>
           				      
       				        </thead>
                            
                            
								
           				    
                            
                            <?php 
							
							
							$resultado=$control->cuposAereosPrograma($id_grupo);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								$producto=$control->datosProducto($fi['id_grupo']);
								
								if($producto['estado']!='HISTORIAL' && $fi['principal']==3){
								
								
								
							?>
                <tr>
                             <td><?php echo strtoupper($fi['nombre']);?></td> <td><?php echo strtoupper($fi['aerolinea']);?></td>
                             <td><?php echo strtoupper($fi['record']);?></td>
                             <td><?php if($fi['principal']==1){echo "SI";}else{echo "NO";}?></td>
                             <td><?php echo $fi['cupos_solicitados'];?></td>
                             <td><?php 
							 
							 $usados=$control->cuposRecordsinPago($fi['id_sillas']);
							
							 
							 echo $usados;?></td>
                             <td><?php 
							 
							 $usados=$control->cuposRecord($fi['id_sillas']);
							
							 
							 echo $usados;?></td>
                             <td><?php echo $fi['origen'];?></td>
                             <td><?php echo $fi['destino'];?></td>
                             <td><?php echo $fi['ruta'];?></td>
           				      <td><?php echo $fi['vuelo_llegada_destino']." ".date("d-m-Y H:m", strtotime($fi['fecha_salida']));?></td>
                              <td><?php echo $fi['vuelo_llegada_origen']." ".date("d-m-Y H:m", strtotime($fi['fecha_regreso']));?></td>
           				      <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['neta_q']+$fi['q']+$control->impuestosRecord($fi['record'])+$fi['ta'],0,',','.')?></td>
                              
                              
			      <td><?php echo strtoupper($fi['politica_tc']);?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['vlr_tc'],0,',','.')?></td>
                              
                              <td><?php echo date("d-m-Y", strtotime($fi['f_deposito']));?></td>
                              <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['deposito_pax'],0,',','.')?></td>
                              <td>
                              <?php echo date("d-m-Y", strtotime($fi['f_cambios']));?></td>
                             <td> <?php echo date("d-m-Y", strtotime($fi['f_nombres']));?></td>
                              <td><?php echo date("d-m-Y ", strtotime($fi['f_emision']));?></td>
                            <td>  <?php echo date("d-m-Y", strtotime($fi['f_impuestos']));?></td>
           				        				      
		        </tr>
           				 
                            <?php }} ?>
                            </table></div></div></div>
                            </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><p>ALOJAMIENTO</p>
      <p>
        <input type="button" name="button4" id="button4" value="Registrar Alojamiento" onclick="location.href='registrar_hotel.php?idgrupo=<?php echo $id_grupo?>';" >
      </p></td>
    <td colspan="2">
     <div class="accordion">
        <div class="accordion-section" > <a class="accordion-section-title" href="#accordion-h" >ALOJAMIENTO</a>
          <div id="accordion-h" class="accordion-section-content">
    <table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC"><strong>HOTEL</strong></th>
          <th bgcolor="#CCCCCC">UBICACIÓN</th>
          <th bgcolor="#CCCCCC">DIRECCIÓN</th>
          <th bgcolor="#CCCCCC">TELEFONO</th>
          <th bgcolor="#CCCCCC">FECHA LLEGADA</th>
          <th bgcolor="#CCCCCC">FECHA SALIDA</th>
          <th bgcolor="#CCCCCC"></th>
          </thead>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado3=$control->consultaHotel($id_grupo);
							while ($fi3 = mysql_fetch_array($resultado3, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo $fi3['hotel'];?></td>
        <td><?php echo $fi3['ubicacion'];?></td>
        <td><?php echo $fi3['direccion'];?></td>
        <td><?php echo $fi3['telefono'];?></td>
        <td><?php echo $fi3['fecha_llegada'];?></td>
        <td><?php echo $fi3['fecha_salida'];?></td>
        <td><a href="producto.php?grupo=<?php echo $id_grupo;?>&borra_hotel=<?php echo $fi3['id'];?>" onclick="return confirm('Desea Borrar?')">X</a></td>
        </tr>
      <?php } ?>
    </table></div></div></div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><p>SERIVICIOS</p>
      <p>
        <input type="button" name="button5" id="button5" value="Registrar Servicios" onclick="location.href='registrar_adicionales.php?idgrupo=<?php echo $id_grupo?>';" >
      </p>
      <p>
        <input type="button" name="button7" id="button7" value="Servicios del Grupo" onclick="location.href='actividades_grupo.php?grupo=<?php echo $id_grupo?>';" >
      </p></td>
    <td colspan="2">
    <div class="accordion">
        <div class="accordion-section" > <a class="accordion-section-title" href="#accordion-s" >SERVICIOS</a>
          <div id="accordion-s" class="accordion-section-content"><table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC">SERVICIO</th>
          <th bgcolor="#CCCCCC">PROVEEDOR</th>
          <th bgcolor="#CCCCCC">FECHA</th>
          <th bgcolor="#CCCCCC">COSTO</th>
          <th bgcolor="#CCCCCC">PVENTA</th>
          <th bgcolor="#CCCCCC">TARIFA</th>
          <th bgcolor="#CCCCCC"></th>
          </thead>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado4=$control->consultaServicios($id_grupo);
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo $fi4['nombre'];?></td>
        <td><?php echo $fi4['proveedor'];?></td>
        <td><?php 
		if($fi4['fecha']> $prospecto['f_salida']){
		echo strftime("%d-%b-%Y",strtotime($fi4['fecha']));
		}else{
		echo "N/A";
		}

?></td>
        <td><?php echo $fi4['costo'];?></td>
                <td><?php echo $fi4['pventa'];?></td>        <td><?php 
				$f=$fi4['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
				if($t==0 && $t!=''){
				echo "TODOS";
				}else if($t==-1){
					echo "OPCIONAL";
				}else{
					if($t>0){
				echo $prospecto['nombre_tarifa'.$t];
					}
					echo "<br>";
				}
				}?></td>
        <td><a href="producto.php?grupo=<?php echo $id_grupo;?>&borra_adicional=<?php echo $fi4['id'];?>" onclick="return confirm('Desea Borrar?')">X  </a>    <a href="registrar_adicionales.php?idgrupo=<?php echo $id_grupo?>&id_servicio=<?php echo $fi4['id']?>">MODIFICAR</a></td>
        
        </tr>
      <?php } ?>
      </table></div></div></div></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#003366"><strong style="color:#FFF !important;">VALOR DEL PRODUCTO</strong></td>
    </tr>
  <tr>
    <td bgcolor="#CCCCCC"><p><strong>VALOR PROGRAMA:</strong></p>
      <p>
        <input type="button" name="button6" id="button6" value="Subprogramas" onclick="location.href='registrar_multitarifa.php?idgrupo=<?php echo $id_grupo?>';" >
      </p></td>
    <td colspan="2"><table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
          <tr>
            <th bgcolor="#CCCCCC">TARIFA</th>
            <th bgcolor="#CCCCCC">AEREA</th>
            
            <th bgcolor="#CCCCCC">TERESTRE</th>
            <th bgcolor="#CCCCCC">VIAJEROS</th>
            <th bgcolor="#CCCCCC">COSTEO</th>
            </thead>
        
        <tr>
          <td><?php echo $prospecto['nombre_tarifa1'];?></td>
          <td><?php echo $prospecto['valor_aereo'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre'];?></td>
          
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa1'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=1">COSTEO</a></td>
          </tr>
          
          <?php if($prospecto['nombre_tarifa2'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa2'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa2'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa2'];?></td>
          
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa2'],$prospecto['id']) ?></td>
          <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=2">COSTEO</a></td>
          </tr>
          
          <?php } ?>
          
                    <?php if($prospecto['nombre_tarifa3'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa3'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa3'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa3'];?></td>
          
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa3'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=3">COSTEO</a></td>
          </tr>
          
          <?php } ?>
          
                    <?php if($prospecto['nombre_tarifa4'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa4'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa4'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa4'];?></td>
          
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa4'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=4">COSTEO</a></td>
          </tr>
          
                    <?php if($prospecto['nombre_tarifa5'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa5'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa5'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa5'];?></td>
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa5'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=5">COSTEO</a></td>
          </tr>
          
          
          <?php } ?>
          
             <?php if($prospecto['nombre_tarifa6'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa6'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa6'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa6'];?></td>
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa6'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=6">COSTEO</a></td>
          </tr>
          
          
          <?php } ?>
          
             <?php if($prospecto['nombre_tarifa7'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa7'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa7'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa7'];?></td>
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa7'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=7">COSTEO</a></td>
          </tr>
          
          
          <?php } ?>
          
          
             <?php if($prospecto['nombre_tarifa8'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa8'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa8'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa8'];?></td>
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa8'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=8">COSTEO</a></td>
          </tr>
          
          
          <?php } ?>
             <?php if($prospecto['nombre_tarifa9'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa9'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa9'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa9'];?></td>
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa9'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=9">COSTEO</a></td>
          </tr>
          
          
          <?php } ?>
             <?php if($prospecto['nombre_tarifa10'] != ""){ ?>
          
          <tr>
          <td><?php echo $prospecto['nombre_tarifa10'];?></td>
          <td><?php echo $prospecto['valor_aereo_tarifa10'];?></td>
          
          <td><?php echo $prospecto['valor_terrestre_tarifa10'];?></td>
          <td><?php echo $control->viajerosTarifa($prospecto['nombre_tarifa10'],$prospecto['id']) ?></td>
            <td><a href="costeo_multitarifa.php?id_costeo=<?php echo $id_grupo ?>&multitarifa=10">COSTEO</a></td>
          </tr>
          
          
          <?php } ?>
          <?php } ?>
        
    </table></td>
    
  </tr>
  <!-- <tr>
    <td bgcolor="#CCCCCC">CALENDARIO DE PAGOS:</td>
    <td colspan="3"><table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC">FECHA </th>
          <th bgcolor="#CCCCCC">ABONO TK</th>
          <th bgcolor="#CCCCCC">ABONO PT</th>
          <th bgcolor="#CCCCCC">TOTAL</th>
          <th bgcolor="#CCCCCC">SALDO</th>
        </thead>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->contactosProspecto($id_grupo);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo $fi['nombre'];?></td>
        <td><?php echo $fi['telefono'];?></td>
        <td><?php echo $fi['tipo'];?></td>
        <td>&nbsp;</td>
        <td><?php echo $fi['origen'];?></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>-->
  <tr>
    <td bgcolor="#CCCCCC"><p><strong>CALENDARIO PAGOS:</strong></p>
      <p>
        <input type="button" name="button2" id="button2" value="Registrar Calendario" onclick="location.href='registrar_calendariopagos.php?idgrupo=<?php echo $id_grupo?>';" >
      </p></td>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
      <thead>
        <tr>
          <th bgcolor="#CCCCCC">CUOTA NO</th>
          <th bgcolor="#CCCCCC">FECHA LIMITE</th>
          <th bgcolor="#CCCCCC">AEREA</th>
          <th bgcolor="#CCCCCC">TERESTRE</th>
          <th bgcolor="#CCCCCC"></th>
        </thead>
      <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado5=$control->consultaCalendarioPagos($id_grupo);
							while ($fi5 = mysql_fetch_array($resultado5, MYSQL_ASSOC)) {
							?>
      <tr>
        <td><?php echo $fi5['id'];?></td>
        <td><?php 
echo strftime("%d-%b-%Y",strtotime($fi5['fecha']));
		
		?></td>
        <td><?php echo $fi5['aerea'];?></td>
        <td><?php echo $fi5['terrestre'];?></td>
        <td><a href="producto.php?grupo=<?php echo $id_grupo;?>&borra_calendario=<?php echo $fi5['id'];?>" onclick="return confirm('Desea Borrar?')">X</a></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <tr>
    <td colspan="3" bgcolor="#003366"><strong style="color:#FFF !important;">LINKS</strong></td>
    </tr>
  <tr>
    <td bgcolor="#CCCCCC">PROGRAMA:</td>
    <td colspan="2">
    <?php 
	
	if($prospecto['unidad_negocio']!='GRUPOS JUVENILES'){
		$carta_aceptacion=1;
		?>
    <a href="https://eventoursport.travel/crm/programas/grupos_especiales.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">https://eventoursport.travel/crm/programas/grupos_especiales.php?plan=<?php echo $prospecto['id'] ?></a>
    <?php }else{ ?>
    <a href="https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $prospecto['id'] ?></a>
    
    <?php } ?> </td>
    
    </tr>
  <tr>
    <td bgcolor="#CCCCCC">INSCRIPCION:</td>
    <td colspan="2"><a href="https://eventoursport.travel/crm/registro.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">https://eventoursport.travel/crm/registro.php?plan=<?php echo $prospecto['id'] ?></a></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">LANDING:</td>
    <td colspan="2"><a href="http://eventoursport.travel/landing/index.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">http://eventoursport.travel/landing/index.php?plan=<?php echo $prospecto['id'] ?></a></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">PDF PROGRAMA:</td>
    <td colspan="2"><a href="https://eventoursport.travel/crm/impresion/pdf/programa_pdf.php?plan=<?php echo $prospecto['id'] ?>" target="_blank">https://eventoursport.travel/crm/impresion/pdf/programa_pdf.php?plan=<?php echo $prospecto['id'] ?></a></td>
  </tr>
 
                            </table><!--
<h2>COMENTARIOS</h2>

                         
                         <div class="cmt-container" >
    <?php
	$control->baseDeDatos(); 
    $sql = mysql_query("SELECT * FROM comments WHERE id_post = '$id_post'") or die(mysql_error());;
    while($affcom = mysql_fetch_assoc($sql)){ 
        $name = $affcom['name'];
        $email = $affcom['email'];
        $comment = $affcom['comment'];
        $date = $affcom['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
        $default = "mm";
        $size = 35;
        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;

    ?>
    <div class="cmt-cnt">
        <img src="<?php echo $grav_url; ?>" />
        <div class="thecom">
            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->
    <?php } ?>

<!--
    <div class="new-com-bt">
        <span>Comentarios...</span>
    </div>
    <div class="new-com-cnt">
        <input type="hidden" id="name-com" name="name-com" value="<?php $usuario=$control->datosUsuario($_SESSION['id']);
							  echo strtoupper($usuario['nombre']);?>" />
        <input type="hidden" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" value="a@a.com" />
        <textarea class="the-new-com"></textarea>
        <div class="bt-add-com">Registrar</div>
        <div class="bt-cancel-com">Cancelar</div>
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->


<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                    data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script>
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
    <h2>CONTACTOS
                            <input type="button" name="button" id="button" value="Registrar Contacto" onclick="location.href='registrar_contacto.php?idgrupo=<?php echo $id_grupo?>';" >
                          </h2>
                         <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="Nombre" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      
           				      
           				    
           				      
           				        <tr>
           				      <th bgcolor="#CCCCCC"><strong>Nombre</strong></th>
           				      <th bgcolor="#CCCCCC">Telefono</th>
           				      <th bgcolor="#CCCCCC">Direccion</th>
           				      <th bgcolor="#CCCCCC">Email</th>
           				      <th bgcolor="#CCCCCC">Tipo</th>
           				      <th bgcolor="#CCCCCC">Origen</th>
           				      <th bgcolor="#CCCCCC">Estado</th>
           				      <th bgcolor="#CCCCCC">Observaciones</th>
                               <th bgcolor="#CCCCCC"></th>
           				      </thead>
                            
                            <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->contactosProspecto($id_grupo);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?><tr>
                           
           				      <td><?php echo $fi['nombre'];?></td>
           				      <td><?php echo $fi['telefono'];?></td>
           				      <td><?php echo $fi['direccion'];?> <?php echo $fi['ciudad'];?></td>
           				      <td><?php echo $fi['email'];?></td>
                             
           				      <td><?php echo $fi['tipo'];?></td>
           				      <td><?php echo $fi['origen'];?></td>
           				      <td><form id="form3" name="form1" method="post"  action="producto.php" style="margin:0 !important;">
           				        <input type="hidden" value="<?php echo $id_grupo?>" name="grupo" id="grupo"/>
           				        <select name="estado2" id="estado2" onchange="getElementById('form3').submit()">
           				          <?php  	$res=$control->listaEstadosContacto();
							while ($fi2 = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				          <option value="<?php echo $fi2['estado']; ?>"<?php if($fi2['estado'] == $fi['estado']){ echo "selected";}?> ><?php echo $fi2['estado'];?></option> 
           				          <?php } ?>
       				            </select>
                                <input type="hidden" value="<?php echo $fi['id'];?>" id="id_contacto" name="id_contacto" />
       				          </form> </td>
           				      <td><?php echo $fi['observaciones'];?></td>
                              <td><a href="registrar_contacto.php?idgrupo=<?php echo $fi['id_grupo'];?>&contacto=<?php echo $fi['id']?>" target="_blank">Modificar</a> <a href="producto.php?grupo=<?php echo $fi['id_grupo'];?>&borrarcontacto=<?php echo $fi['id'];?>" onclick="return confirm('Desea Borrar?')">Borrar</a></td>
           				      </tr> <?php } ?>
                           
         				    </table>
           				  <h2> VIAJEROS </h2>
           		
                    <table class="table" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="false" data-sort-name="producto" data-sort-order="desc">
           				      <thead>
   				              <tr>
       				            <th>&nbsp;</th>
         				          <th>Estado</th>
         				          <?php if($_REQUEST['grupo'] == 0){?>
         				          <?php } ?>
         				          <th><strong>Documento</strong></th>
         				          <th data-filter-control="select" data-field="tipo">Tipo Viajero</th>
         				          <th data-sortable="true"data-field="filtroc" data-filter-control="select">Nombre Contrato Aerolinea<br></th>
         				          <th data-sortable="true"data-field="contrato"><p>Contrato Aerolinea Modificable</p></th>
         				          <th data-sortable="true"><strong>Nombres</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>F Nacimiento</strong></th>
         				          <th><p><strong>Edad</strong></p></th>
         				          <th data-hide="all" data-visible="false"><strong>email</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Telefono</strong></th>
         				          <th><strong>celular</strong></th>
         				          <th  data-ignore="true" data-hide="all" data-visible="false"><strong>ciudad</strong></th>
         				          <th data-ignore="true" data-hide="all" data-visible="false"><strong>direccion</strong></th>
         				          <th data-ignore="true" data-hide="all" data-visible="false"><strong>pasaporte</strong></th>
         				          <th data-ignore="true" data-hide="all" data-visible="false"> <strong>vigencia</strong></th>
         				          <th data-ignore="true" data-hide="all" data-visible="false"><strong>visa</strong></th>
         				          <th data-ignore="true" data-hide="all" data-visible="false"><strong>vigencia</strong></th>
         				          <?php if($_REQUEST['grupo'] != 8){?>
         				          <th data-hide="all" data-visible="false"><strong>Acudiente 1</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Telefono Acudiente 1</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Email Acudiente 1</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Acudiente 2</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Telefono Acudiente 2</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Email Acudiente 2</strong></th>
         				          <?php }else{ ?>
         				          <th data-hide="all" data-visible="false"><strong>Viaja Con</strong></th>
         				          <?php } ?>
         				          <th data-hide="all" data-visible="false"><strong>Facturacion</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Documento</strong></th>
         				          <th data-hide="all" data-visible="false"><strong>Direccion</strong></th>
         				          <th>Documento</th>
         				          <th>Permiso</th>
         				          <th>Pasaporte</th>
         				          <th>Contrato</th>
                                   
         				          <th data-hide="all" data-visible="false"><strong>Otros Documentos</strong></th>
                                  <th>Observaciones</th>
                                  <th><strong></strong></th>
         				            </thead>
                              <tr>
       				                                          <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
       				                                          <td>
       				                                            <?php 
								//var_dump($_SESSION);
								
								if($_SESSION['nivel'] > 8){
								$acceso = 1;	
								}
								if(($_SESSION['user'] == "servicios@eventoursport.com")){
								$acceso = 1;	
								}
								if(($_SESSION['user'] == "gerencia@eventoursport.com")){
								$acceso = 1;	
								}
								if($acceso == 1){ ?>
       				                                            <a href="editar_super.php?id=<?php echo $fi['id'];?>" target="_blank">EDITAR</a>
       				                                          
       				                                            <?php } ?></td>
       				                                          <td><form id="form<?php echo  $fi['no_documento'];?>" name="form1" method="post" action="producto.php" style="margin:0;">
       				                                            <input type="hidden" id="grupo" name="grupo" value="<?php echo $_REQUEST['grupo'];?>">
       				                                            <input type="hidden" id="documento" name="documento" value="<?php echo  $fi['no_documento'];?>">
                                                                
                                                                                                 <input type="hidden" id="idviajero" name="idviajero" value="<?php echo  $fi['id'];?>">
       				                                            <input type="hidden" id="estado_viajero" name="estado_viajero" value="1">
																
       				                                            <select name="estado_viaje" id="estado_viaje" style="width:70px" onchange="getElementById('form<?php echo  $fi['no_documento'];?>').submit()">
       				                                              <option value="VIAJA" <?php if($fi['estado'] == "VIAJA"){echo "selected";}?>>VIAJA</option>
       				                                              <option value="PENDIENTE" <?php if($fi['estado'] == "PENDIENTE"){echo "selected";}?>>PENDIENTE</option>
       				                                              <option value="NO VIAJA" <?php if($fi['estado'] == "NO VIAJA"){echo "selected";}?>>NO VIAJA</option>
   				                                                </select>
     				                                            </form></td>
       				                                          <?php if($_REQUEST['grupo'] == 0){?>
       				                                          <?php } ?>
       				                                          <td><?php echo $fi['documento'];?> <a href="registrar_pago.php?doc=<?php echo $fi['id'];?>" target="_blank"><?php echo $fi['no_documento'];?></a><br/>
       				                                           </td>
       				                                          <td><?php echo strtoupper($fi['otro']);?></td>
       				                                          <td><?php
	if($fi['record']==''){
$contratoactual=$control->sillaPrincipalPrograma($id_grupo);

	}else{
	$contratoactual=$control->datosContratoRecord($fi['record']);
	}
	
	echo $contratoactual['nombre'];
	?></td>
       				                                          <td><form id="form2<?php echo  $fi['no_documento'];?>" name="form1" method="post" action="producto.php" style="margin:0;">
       				                                            <input type="hidden" id="grupo" name="grupo" value="<?php echo $_REQUEST['grupo'];?>">
       				                                            <input type="hidden" id="documento" name="documento" value="<?php echo  $fi['no_documento'];?>">
       				                                            <input type="hidden" id="estado3" name="estado3" value="1">

 <input type="hidden" id="idviajero" name="idviajero" value="<?php echo  $fi['id'];?>">
       				
<select name="record" id="record" onchange="getElementById('form2<?php echo  $fi['no_documento'];?>').submit()">
           				              <?php  	$r=$control->cuposAereosPrograma($id_grupo);
							while ($fd = mysql_fetch_array($r, MYSQL_ASSOC)) {?>
           				              <option value="<?php echo $fd['record']; ?>" <?php if($fi['record']=='' && $fd['principal']==1){echo "selected";}?> <?php if($fi['record']==$fd['record']){echo "selected";}?>  ><?php echo $fd['nombre']." ".$fd['aerolinea'];?></option>
           				              <?php } ?>
         				              </select>
       				                                            
     				                                            </form></td>
       				                                          <td><?php echo strtoupper($fi['nombres']);?>
   				                                                 <?php echo strtoupper($fi['apellidos']);?><br>
			                                                  <?php if($fi['acompanante_de']!=''){
					$acom=$control->datosViajero($fi['acompanante_de']);									  echo "</br>Acomañante de:".$acom['nombres']." ".$acom['apellidos'];
															  }?></td>
       				                                          <td><?php echo $fi['fnacimiento'];?></td>
       				                                          <td><?php echo $control->edad($fi['fnacimiento'],$_REQUEST['grupo']);?></td>
       				                                          <td><?php echo $fi['email'];?></td>
       				                                          <td><?php echo $fi['telefono'];?></td>
       				                                          <td><?php echo $fi['celular'];?></td>
       				                                          <td><?php echo $fi['ciudad'];?></td>
       				                                          <td><?php echo $fi['direccion'];?></td>
       				                                          <td><?php echo $fi['pasaporte'];?></td>
       				                                          <td><?php echo $fi['pasaporte_vigencia'];?></td>
       				                                          <td><?php echo $fi['visa_americana'];?></td>
       				                                          <td><?php echo $fi['visa_vigencia'];?></td>
       				                                          <?php if($_REQUEST['grupo'] != 8){?>
       				                                          <td><?php echo strtoupper($fi['acudiente1_nombre']);?> <?php echo strtoupper($fi['acudiente1_apellido']);?></td>
       				                                          <td><?php echo $fi['acudiente1_telefono'];?></td>
       				                                          <td><?php echo $fi['acudiente1_email'];?></td>
       				                                          <td><?php echo strtoupper($fi['acudiente2_nombre']);?> <?php echo strtoupper($fi['acudiente2_apellido']);?></td>
       				                                          <td><?php echo $fi['acudiente2_telefono'];?></td>
       				                                          <td><?php echo $fi['acudiente2_email'];?></td>
       				                                          <?php } else{ ?>
       				                                          <td><?php echo strtoupper($fi['acompanante_de']);?></td>
       				                                          <?php } ?>
       				                                          <td><?php echo strtoupper($fi['facturacion_nombre']);?></td>
       				                                          <td><?php echo $fi['facturacion_nodocumento'];?></td>
       				                                          <td><?php echo $fi['facturacion_direccion'];?> <?php echo $fi['facturacion_ciudad'];?></td>
       				                                          <td><?php if($fi['doc_identidad']!= ""){echo "<a href='documentos/".$fi['doc_identidad']."' target='_blank'><img src='images/icon-download.png' width='20' height='20'  alt='descargar'/></a><br/>";
							  }?>
   				                                              </td>
       				                                          <td><?php if($fi['doc_permiso']!= ""){echo "<a href='documentos/".$fi['doc_permiso']."' target='_blank'><img src='images/icon-download.png' width='20' height='20'  alt='descargar permiso'/></a><br/>";
							  }
							  
							  if($control->edad($fi['fnacimiento'],$_REQUEST['grupo'])>=18){echo "N/A";}?></td>
       				                                          <td><?php if($fi['doc_pasaporte']!= ""){echo "<a href='documentos/".$fi['doc_pasaporte']."' target='_blank'><img src='images/icon-download.png' width='20' height='20'  alt='descargar pasaporte'/></a><br/>";
							  }?></td>
       				                                          <td><p><a href="https://eventoursport.travel/crm/impresion/pdf/contrato_pdf.php?firma=<?php echo $fi['no_documento'];?>&carta_aceptacion=<?php echo $carta_aceptacion;?>&descarga=i" target="_blank"><img src='images/icon-download.png' width='20' height='20'  alt='descargar contrato' title='descargar contrato'/></a><a href="https://eventoursport.travel/crm/registro.php?plan=<?php echo $id_grupo;?>&paso=2&no_docuento=<?php echo $fi['no_documento'] ?>&email=<?php echo $fi['email'] ?>" target="_blank"><img src='images/icon-firmar.png' width='20' height='20'  alt='firmar contrato'  title='firmar contrato'/></a>
   				                                             <a href="http://eventoursport.travel/crm/registro.php?plan=<?php echo $id_grupo;?>&ac=<?php echo $fi['no_documento'] ?>" target="_blank"><img src='images/icon-acompa.png' width='20' height='20'  alt='registrar acompañante'  title='registrar acompañante'/></a></p></td>
       				                                          <td><?php if($fi['doc_rut']!= ""){echo "<a href='documentos/".$fi['doc_rut']."' target='_blank'>RUT</a><br/>";
							  }?>
       				                                            <?php if($fi['doc_visa']!= ""){echo "<a href='documentos/".$fi['doc_visa']."' target='_blank'>Visa Americana</a><br/>";
							  }?></td>
                              <td>
                              <form action="producto.php" method="post">
                              
                                  <input type="hidden" id="grupo" name="grupo" value="<?php echo $_REQUEST['grupo'];?>">
       				                                            <input type="hidden" id="documento" name="documento" value="<?php echo  $fi['no_documento'];?>">
       				                                            <input type="hidden" id="estado3" name="estado3" value="1">

 <input type="hidden" id="idviajero" name="idviajero" value="<?php echo  $fi['id'];?>">
                              <textarea id="observaciones" name="observaciones" ><?php echo $fi['observaciones']?></textarea  >
                              <input type="submit" value="guardar"></form>
                              
                              </td>
                              
                              
                              <td><a href="producto.php?grupo=<?php echo $_REQUEST['grupo']?>&borrar=<?php echo $fi['id'];?>" onclick="return confirm('Desea Borrar el registro?')">X</a></td>
                              </tr>
           				      <?php } ?>
       				        </table>
           				  </div>
           				  <p>&nbsp;</p>
					</div>
                        </div>
</div>
                        </div>
                        </div>
                        
    </body>
