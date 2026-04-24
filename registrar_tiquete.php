<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<?php 

	//error_reporting(0);

 //Print_r ($_SESSION);


$id_grupo = $_REQUEST['idgrupo'];

if(isset($_REQUEST['aerolinea']) && !isset($_REQUEST['contrato'])){
	$mensaje=$control->registrarTiquete($_REQUEST);

}

if(isset($_REQUEST['aerolinea']) && isset($_REQUEST['contrato'])){
	$mensaje=$control->modificarTiquete($_REQUEST);

}

if(isset($_REQUEST['contrato'])){
	$contrato = $control->datosContrato($_REQUEST['contrato']);


}

//var_dump($contrato);
	
?>

<script>
function calcularConfirmados(){
	
		var solicitados = document.getElementById('cupos_originales').value;
		var sinp = document.getElementById('cancelacion_sinp').value;
		var conp = document.getElementById('cancelacion_conp').value;
		document.getElementById('cupos').value=solicitados-sinp-conp;
		
}
</script>    
   

      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">REGISTRAR CONTRATO AEROLINEA</div>
					<div class="panel-body">
           				  <div class="module-body">
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
       				        <form action="registrar_tiquete.php" method="post" name="form1" id="form1">
                          
           				    <h2>REGISTRAR CONTRATO AEROLINEA</h2>
                           
           				 <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				   
                              <tr>
                              
                              
           				        <td bgcolor="#CCCCCC">NOMBRE:</td>
           				        <td colspan="3">
                               <?php if(isset($_REQUEST['contrato'])){?>
 
                                <input type="hidden" id="contrato" name="contrato" value="<?php echo $_REQUEST['contrato'];?>"> 
                                <?php } ?>
                                <input name="nombre" type="text" id="nombre" placeholder="" size="60" value="<?php echo $contrato['nombre'];?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">PROVEEDOR</td>
           				        <td><input type="text" name="proveedor" id="proveedor" placeholder="" value="<?php echo $contrato['proveedor'];?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">AEROLINEA: </td>
           				        <td><!--<select name="aerolinea" id="aerolinea">
           				          <?php  	$res=$control->listaAerolineas($id_grupo);
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				          <option value="<?php echo $fi['nombre']; ?>"  <?php if($contrato['aerolinea']==$fi['nombre']){ echo 'selected="selected"';} ?>
                                  
                                   ><?php echo $fi['nombre'];?></option>
           				          <?php } ?>
       				            </select>-->
       				            <input type="text" name="aerolinea" id="aerolinea" placeholder="" value="<?php echo $contrato['aerolinea'];?>"></td>
           				        <td bgcolor="#CCCCCC">RECORD:</td>
           				        <td><input type="text" name="record" id="record" placeholder="" value="<?php echo $contrato['record'];?>"></td>
                                
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">ESTADO</td>
           				        <td>
                                  <select name="estado" id="estado">
                                    <option value="EN VERIFICACIÓN" <?php if($contrato['estado']=='EN VERIFICACION'){ echo 'selected="selected"';} ?>>EN VERIFICACIÓN</option>
                                    <option value="APROBADO" <?php if($contrato['estado']=='APROBADO'){ echo 'selected="selected"';} ?>>APROBADO</option>
                                    <option value="RECHAZADO" <?php if($contrato['estado']=='RECHAZADO'){ echo 'selected="selected"';} ?> >RECHAZADO</option>
                                    <option value="CANCELADO" <?php if($contrato['estado']=='CANCELADO'){ echo 'selected="selected"';} ?> >CANCELADO</option>
                                </select></td>
           				        <td bgcolor="#CCCCCC">RADICADO:</td>
           				        <td><input type="text" name="radicado" id="radicado" placeholder="" value="<?php echo $contrato['radicado'];?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">CUPOS CONFIRMADOS:</td>
           				        <td><input type="text" name="cupos" id="cupos" placeholder="" value="<?php echo $contrato['cupos_solicitados'];?>"></td>
           				        <td bgcolor="#CCCCCC">CUPOS SOLICITADOS:</td>
           				        <td><input type="text" name="cupos_originales" id="cupos_originales" placeholder="" value="<?php echo $contrato['cupos_originales'];?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC"><p>ORIGEN
           				          :
                                      
       				             
   				                </p></td>
           				        <td>
									
									<!--<input type="text" name="origen" id="origen" placeholder="" value="<?php echo $contrato['origen'];?>">-->
								  
								  <select class="js-data-example-ajax" style="width: 150px" name="origen" id="origen">
									 <option value="<?php echo $contrato['origen'] ?>" selected="selected"><?php echo $contrato['origen'] ?></option>
									</select>
									
									
									
								  </td>
           				        <td bgcolor="#CCCCCC">DESTINO:</td>
           				        <td>
									<!--<input type="text" name="destino" id="destino" placeholder="" value="<?php echo $contrato['destino'];?>">-->
								  
								  <select class="js-data-example-ajax2" style="width: 150px" name="destino" id="destino">
									 <option value="<?php echo $contrato['destino'] ?>" selected="selected"><?php echo $contrato['destino'] ?></option>
									</select>
									
								  </td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">RUTA:</td>
           				        <td colspan="3"><input name="ruta" type="text" id="ruta" placeholder="" size="60" value="<?php echo $contrato['ruta'];?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">VUELO LLEGADA DESTINO:</td>
           				        <td><input type="text" name="vsalida" id="vsalida" value="<?php echo $contrato['vuelo_llegada_destino'];?>"></td>
           				        <td bgcolor="#CCCCCC">VUELO SALIDA DESTINO:</td>
           				        <td><input type="text" name="vregreso" id="vregreso" value="<?php echo $contrato['vuelo_llegada_origen'];?>"></td>
   				           </tr>
                           <tr>
           				        <td bgcolor="#CCCCCC">FECHA HORA - LLEGADA A DESTINO:</td>
           				        <td><input type="datetime-local" name="fh_llegada" id="fh_llegada" value="<?php echo date("Y-m-d\TH:i:s",strtotime($contrato['fecha_salida'])); ?>"></td>
           				        <td bgcolor="#CCCCCC">FECHA HORA  SALIDA DESTINO:</td>
           				        <td><input type="datetime-local" name="fh_regreso" id="fh_regreso" value="<?php echo date("Y-m-d\TH:i:s",strtotime($contrato['fecha_regreso'])); ?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">NETA:</td>
           				        <td><input type="text" name="neta" id="neta" placeholder="" value="<?php echo $contrato['neta_q'];?>"></td>
           				        <td bgcolor="#CCCCCC">Q:</td>
           				        <td><input type="text" name="q" id="q" placeholder="" value="<?php echo $contrato['q'];?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">TA:</td>
           				        <td><input type="text" name="ta" id="ta" placeholder="" value="<?php echo $contrato['tadmin'];?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">POLITICA TC 1x</td>
           				        <td><input type="text" name="politica_tc" id="politica_tc" placeholder="" value="<?php echo $contrato['politica_tc'];?>"></td>
           				        <td bgcolor="#CCCCCC">VALOR TC:</td>
           				        <td><input type="text" name="valor_tc" id="valor_tc" placeholder=""  value="<?php echo $contrato['vlr_tc'];?>"></td>
   				           </tr>
                              <tr>
                                <td bgcolor="#CCCCCC">RECORD TC:</td>
                                <td><input type="text" name="recordtc" id="recordtc" placeholder="" value="<?php echo $contrato['recordtc'];?>"></td>
                                <td bgcolor="#CCCCCC">&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
           				        <td bgcolor="#CCCCCC">FECHA DEPOSITO:</td>
           				        <td><input type="date" name="fecha_deposito" id="fecha_deposito" value="<?php echo $contrato['f_deposito'];?>"></td>
           				        <td bgcolor="#CCCCCC">DEPOSITO x PAX:</td>
           				        <td><input type="text" name="deposito_pax" id="deposito_pax" value="<?php echo $contrato['deposito_pax'];?>"></td>
   				           </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">FECHA CANCELACIONES SIN PENALIDAD:</td>
           				        <td><input type="date" name="f_nombres" id="f_nombres" value="<?php echo $contrato['f_nombres'];?>"></td>
           				        <td bgcolor="#CCCCCC">FECHA CANCELACION CON PENALIDAD:</td>
           				        <td><input type="date" name="f_cambios" id="f_cambios" value="<?php echo $contrato['f_cambios'];?>"></td>
   				           </tr> 
                           <tr>
           				        <td bgcolor="#CCCCCC">CUPOS CANCELADOS SIN PENALIDAD:</td>
           				        <td><input type="text" name="cancelacion_sinp" id="cancelacion_sinp" value="<?php echo $contrato['cancelacion_sinp'];?>" onChange="calcularConfirmados()"></td>
           				        <td bgcolor="#CCCCCC">CUPOS CANCELADOS CON PENALIDAD:</td>
           				        <td><input type="text" name="cancelacion_conp" id="cancelacion_conp" value="<?php echo $contrato['cancelacion_conp'];?>"  onChange="calcularConfirmados()"></td>
   				           </tr>
                           <tr>
           				        <td bgcolor="#CCCCCC">FECHA EMISION:</td>
           				        <td><input type="date" name="f_emision" id="f_emision" value="<?php echo $contrato['f_emision'];?>"></td>
           				        <td bgcolor="#CCCCCC">FECHA IMPUESTOS:</td>
           				        <td><input type="date" name="f_impuestos" id="f_impuestos" value="<?php echo $contrato['f_impuestos'];?>"></td>
   				           </tr>
							  <tr>
           				        <td bgcolor="#CCCCCC">TRM PAGO (SOLO REGISTRAR PARA LIQUIDAR):</td>
           				        <td><input type="text" name="trm" id="trm" value="<?php echo $contrato['trm'];?>"></td>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
   				           </tr>
                           <tr>
           				        <td bgcolor="#CCCCCC">ITINERARIO:</td>
           				        <td colspan="3">
                             <textarea name="itinerario" cols="60" rows="5" id="itinerario"><?php echo $contrato['itinerario'];?></textarea></td>
   				           </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"> <input type="button" name="button" id="button" value="Volver" onclick="location.href='cupos_aereos.php?historial=0';" ></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
       				        </form>
           				  </div>
           				</div>
                        </div>
                        </div>
                        </div></div>
    </body>
<script>
$('.js-data-example-ajax').select2({
  ajax: {
    url: 'https://eventoursport.travel/crm/api.php',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
	$('.js-data-example-ajax2').select2({
  ajax: {
    url: 'https://eventoursport.travel/crm/api.php',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
</script>

