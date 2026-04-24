<?php require_once("config.php");
require_once("control/control.php");

$control = new Control();
require('MailSendRegistro.php');
	$acudientes = true;
	$visa = false;
	$facturacion=true;
	$facturacion_invisible=false;
	$carta_aceptacion=0;
	$contrato=true;
	$url_contrato="https://eventoursport.travel/crm/programas/grupo-print.php";
?>
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+573148906440", // WhatsApp number
            call_to_action: "Ayuda ", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<?php


if(isset($_REQUEST['ac'])){
	$acmp=$control->datosViajero($_REQUEST['ac']);	
	$facturacion_invisible=true;
			
}
	if(isset($_REQUEST['plan'])){
		$producto = $control->equivProducto($_REQUEST['plan']);
		$datos_producto=$control->datosProducto($_REQUEST['plan']);
	} else {
		$producto = "";
	}
	
	
	$unidadnegocio=$datos_producto['unidad_negocio'];
	if($unidadnegocio != 'GRUPOS JUVENILES'){
		$acudientes=false;
		$contacto_emergencia=true;
		$acompanante=true;
		$url_contrato="https://eventoursport.travel/crm/programas/grupo_print.php";
		
		$carta_aceptacion=1;
		
		
		
	}
	
	$estado_viajero='PENDIENTE';
	
	
	
		
			
		
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
			
		
			}
		
		

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Inscripcion del Viajero</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style-registro.css">
	</head>
	<body>
		<div class="wrapper">
		<div><img src="http://www.eventours.travel/wp-content/uploads/2018/03/EventourS-Logo-300x107.png" width="168" height="59"></div>
            <form action="" id="wizard">
        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
                    <h3 ><?php echo $control->nomGrupo($_REQUEST['plan']); ?></br>DATOS DEL VIAJERO</h3>
                	<div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi zmdi-account"></i>
                            <input type="text" class="form-control" placeholder="Nombres" id="nombres" name="nombres" >
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account"></i>
                            <input type="text" class="form-control" placeholder="Apellidos" id="apellidos" name="apellidos">
                        </div>
                	</div>
                    <div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi account-box-o"></i>
                            <select name="documento" class="form-control" id="documento" tabindex="1" >
           				              <option value="CC" selected="selected" disabled>TIPO DOCUMENTO</option>
                                      <option value="CC">Cedula</option>
           				              <option value="TI" >Tarjeta de Identidad</option>
                                      <option value="Pasaporte" >Pasaporte</option>
                                      <option value="CE" >Cedula de Extranjería</option>
       				                </select>
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account-box-o"></i>
                            <input type="text" class="form-control" placeholder="Nro de Documento" name="no_docuento" id="no_docuento">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder">
                             <i class="zmdi zmdi-calendar"></i>
                            <input type="text" class="form-control" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" id="fnacimiento" name="fnacimiento">
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-city"></i>
                            <select name="ciudad" class="form-control" id="ciudad" tabindex="1" >
       				             <option value="Cali" selected disabled>CIUDAD DE RESIDENCIA</option>
       				                      
								<option value="Cali">Cali</option>
       				                  <option value="Bogota">Bogota</option>
                                      <option value="Pereira">Pereira</option>
                                       <option value="Armenia">Armenia</option>
                                                      <option value="Popayan">Popayan</option>
       				                  <option value="Barranquilla">Barranquilla</option>
       				                  <option value="Santa Marta">Santa Marta</option>
       				
                                                     <option value="Otra">Otra</option>
   				                    </select>
                        </div>
                    </div>
                    <div class="form-row">
						
						
                        
                          
							
							
							
                       
                        
						
						<div class="form-holder">
                            <i class="zmdi zmdi-email"></i>
                            <input type="email" class="form-control" placeholder="Email Viajero" name="email" id="email">
                        </div>
						<div class="form-holder">
                            <i class="zmdi zmdi-phone"></i>
                          <input type="text" class="form-control" placeholder="Telefono Viajero" name="celular" id="celular">
                        </div>
						 </div>
					<?php if(($datos_producto['nombre_tarifa2'] != "" &&  strpos($producto['nombre_tarifa2'],'interno')=== false)||($datos_producto['nombre_tarifa3'] != "" &&  strpos($producto['nombre_tarifa3'],'interno')=== false)||($datos_producto['nombre_tarifa4'] != "" &&  strpos($producto['nombre_tarifa4'],'interno')=== false)){?>
						<div class="form-row">
							
					
						<div class="form-holder w-100">
							<span>PROGRAMA DE VIAJE:</span>
							  <i class="zmdi zmdi-airplane"></i>
                                    <select name="otro" id="otro" tabindex="1" class="form-control">
           				             
										   <?php if($datos_producto['nombre_tarifa1'] != "" &&  strpos($datos_producto['nombre_tarifa1'],'interno')=== false){?>
										<option value="<?php echo $datos_producto['nombre_tarifa1'];?>" selected="selected"><?php echo $datos_producto['nombre_tarifa1'];?></option>
										<?php }?>
										   <?php if($datos_producto['nombre_tarifa2'] != "" &&  strpos($datos_producto['nombre_tarifa2'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa2'];?>"><?php echo $datos_producto['nombre_tarifa2'];?></option>
										<?php }?>
                                      <?php if($datos_producto['nombre_tarifa3'] != "" &&  strpos($datos_producto['nombre_tarifa3'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa3'];?>"><?php echo $datos_producto['nombre_tarifa3'];?></option>
                                      <?php } ?>
                                      
                                      <?php if($datos_producto['nombre_tarifa4'] != "" &&  strpos($datos_producto['nombre_tarifa4'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa4'];?>"><?php echo $datos_producto['nombre_tarifa4'];?></option>
                                      <?php } ?>
                                      <?php if($datos_producto['nombre_tarifa5'] != "" &&  strpos($datos_producto['nombre_tarifa5'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa5'];?>"><?php echo $datos_producto['nombre_tarifa5'];?></option>
                                      
                                      <?php } ?>
                                      
                                       <?php if($datos_producto['nombre_tarifa6'] != "" &&  strpos($datos_producto['nombre_tarifa6'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa6'];?>"><?php echo $datos_producto['nombre_tarifa6'];?></option>
                                      
                                      <?php } ?>
                                      
                                       <?php if($datos_producto['nombre_tarifa7'] != "" &&  strpos($datos_producto['nombre_tarifa7'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa7'];?>"><?php echo $datos_producto['nombre_tarifa7'];?></option>
                                      
                                      <?php } ?>
                                       <?php if($datos_producto['nombre_tarifa8'] != "" &&  strpos($datos_producto['nombre_tarifa8'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa8'];?>"><?php echo $datos_producto['nombre_tarifa8'];?></option>
                                      
                                      <?php } ?>
                                       <?php if($datos_producto['nombre_tarifa9'] != "" &&  strpos($datos_producto['nombre_tarifa9'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa9'];?>"><?php echo $datos_producto['nombre_tarifa9'];?></option>
                                      
                                      <?php } ?>
           				              <?php if($datos_producto['nombre_tarifa10'] != "" &&  strpos($datos_producto['nombre_tarifa10'],'interno')=== false){?>
                                      <option value="<?php echo $datos_producto['nombre_tarifa10'];?>"><?php echo $datos_producto['nombre_tarifa10'];?></option>
                                      
                                      <?php } ?>
       				                </select>
                                    
           				            </div>
       				              
						
						
						
						
                    </div><?php } ?>
                </section>

				<!-- SECTION 2 -->
                <h4></h4>
                <section>
                	<h3>CONDICIONES MEDICAS ESPECIALES</h3>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control" placeholder="Presenta algun tipo de alergias">
                            <i class="zmdi zmdi-hospital"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control" placeholder="Necesita algun tipo de medicamento">
                            <i class="zmdi zmdi-hospital"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="text" class="form-control" placeholder="Presenta algun tipo de enfermedad o discapacidad">
                            <i class="zmdi zmdi-hospital"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-holder w-100">
Si el viajero cuenta con alguna condición médica, alimentación especial, o requerimiento específico que debamos conocer, por favor detállelo, de lo contrario omita este campo
El manejo de la información sobre condiciones médicas especiales de nuestros viajeros es CONFIDENCIAL y  será manejada de acuerdo con lo establecido por la Ley Estatutaria 1581 de 2012 (Ley de protección de datos personales).
                      </div>
                    </div>
                </section>

                <!-- SECTION 3 -->
                <h4></h4>
                <section>
                  <h3 >ACUDIENTES / CONTACTO DE EMERGENCIA</h3>
					  <div class="form-row">
                        <div class="form-holder w-100">
							<h4>CONTACTO DE EMERGENCIA</h4>
                      </div>
                    </div>
                  <div class="form-row">
                    <div class="form-holder"> <i class="zmdi zmdi-account"></i>
                  <input name="p1nombre" type="text" class="form-control" id="p1nombre" placeholder="Nombres" style="text-transform:uppercase" >
					</div>
                    <div class="form-holder"> <i class="zmdi zmdi-account"></i>
                      <input type="text" class="form-control" placeholder="Apellidos" id="p1apellido" name="p1apellido" style="text-transform:uppercase">
                    </div>
                  </div>
                  
                  
                  <div class="form-row">
                    <div class="form-holder"> <i class="zmdi zmdi-email"></i>
                      <input type="email" class="form-control" placeholder="Email contacto" name="email2" id="email2">
                    </div>
                    <div class="form-holder"> <i class="zmdi zmdi-phone"></i>
                      <input type="text" class="form-control" placeholder="Telefono contacto" name="celular2" id="celular2">
                    </div>
                  </div>
					<div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi account-box-o"></i>
                            <select name="documento" class="form-control" id="documento" tabindex="1" >
           				              <option value="CC" selected="selected" disabled>TIPO DOCUMENTO</option>
                                      <option value="CC">Cedula</option>
           				              <option value="TI" >Tarjeta de Identidad</option>
                                      <option value="Pasaporte" >Pasaporte</option>
                                      <option value="CE" >Cedula de Extranjería</option>
       				                </select>
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account-box-o"></i>
                            <input type="text" class="form-control" placeholder="Nro de Documento" name="no_docuento" id="no_docuento">
                        </div>
                    </div>
					<div class="form-row">
                        <div class="form-holder w-100">
							<h4>CONTACTO SECUNDARIO (OPCIONAL)</h4>
                      </div>
                    </div>
					 <div class="form-row">
                    <div class="form-holder"> <i class="zmdi zmdi-account"></i>
                  <input name="p2nombre" type="text" class="form-control" id="p2nombre" placeholder="Nombres" style="text-transform:uppercase" >
					</div>
                    <div class="form-holder"> <i class="zmdi zmdi-account"></i>
                      <input type="text" class="form-control" placeholder="Apellidos" id="p2apellido" name="p2apellido" style="text-transform:uppercase">
                    </div>
                  </div>
                  
                  
                  <div class="form-row">
                    <div class="form-holder"> <i class="zmdi zmdi-email"></i>
                      <input type="email" class="form-control" placeholder="Email contacto" name="email2" id="email2">
                    </div>
                    <div class="form-holder"> <i class="zmdi zmdi-phone"></i>
                      <input type="text" class="form-control" placeholder="Telefono contacto" name="celular2" id="celular2">
                    </div>
                  </div>
					<div class="form-row">
                        <div class="form-holder">
                            <i class="zmdi account-box-o"></i>
                            <select name="documento" class="form-control" id="documento" tabindex="1" >
           				              <option value="CC" selected="selected" disabled>TIPO DOCUMENTO</option>
                                      <option value="CC">Cedula</option>
           				              <option value="TI" >Tarjeta de Identidad</option>
                                      <option value="Pasaporte" >Pasaporte</option>
                                      <option value="CE" >Cedula de Extranjería</option>
       				                </select>
                        </div>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account-box-o"></i>
                            <input type="text" class="form-control" placeholder="Nro de Documento" name="no_docuento" id="no_docuento">
                        </div>
                    </div>
                  
                </section>
                <!-- SECTION 4 -->
              <h4></h4>
                <section>
                    <h3>Cart Totals</h3>
                    <div class="cart_totals">
                        <table cellspacing="0" class="shop_table shop_table_responsive">
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>110.00
                                    </span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal shipping">
                                <th>Shipping:</th>
                                <td data-title="Subtotal">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="shipping" checked> Free Shipping
                                            <span class="checkmark"></span>
                                        </label>
                                        <label>
                                            <input type="radio" name="shipping"> Local pickup: <span>$</span><span>0.00</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <span>Calculate shipping</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Service <span>(estimated for Vietnam)</span></th>
                                <td data-title="Subtotal">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>5.60
                                    </span>
                                </td>
                            </tr>
                            <tr class="order-total border-0">
                                <th>Total</th>
                                <td data-title="Total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>64.69
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </section>
            </form>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		
		<!-- JQUERY STEP -->
		<script src="js/jquery.steps.js"></script>

		<script src="js/main.js"></script>

<!-- Template created and distributed by Colorlib -->
</body>
</html>