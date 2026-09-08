<?php  include 'layout/header.php';
require('MailSendRegistro.php');

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

	$acudientes = true;
	$visa = false;
	$facturacion=true;
	$facturacion_invisible=false;
	$carta_aceptacion=0;
	$contrato=true;
	$url_contrato="https://eventoursport.travel/crm/programas/grupo-print.php";


if(isset($_REQUEST['ac'])){
	$acmp=$control->datosViajero($_REQUEST['ac']);	
	$facturacion_invisible=true;
			
}
	if(isset($_REQUEST['plan'])){
		$producto = $control->equivProducto($_REQUEST['plan']);
		$datos_producto=$control->datosProducto($_REQUEST['plan']);
		if(strpos($datos_producto['parametros'], 'inscripcion-aviatur') !== false){
			$contrato = false;
		}
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
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
		
			}
		
	}
	
	$estado_viajero='PENDIENTE';
	
	
	
	if($_REQUEST['plan'] == 133){
		$acudientes = false;
		$visa=false;
		$acompanante=true;
		$contacto_emergencia=true;
		$otro=true;
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
			
		
			}
		}
		
			if($_REQUEST['plan'] == 141){
		$acudientes = false;
		$visa=false;
		$acompanante=true;
		$contrato=true;
		$contacto_emergencia=true;
		$otro=true;
		$carta_aceptacion=1;
		
		$url_contrato="https://eventoursport.travel/crm/programas/grupo_print.php";
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
			
		
			}
		}
		
		if($_REQUEST['plan'] == 140){
		$acudientes = false;
		$visa=false;
		$acompanante=true;
		$contacto_emergencia=true;
		$otro=true;
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
			
		
			}
		}
		
		if($_REQUEST['plan'] == 135){
		$acudientes = false;
		$visa=false;
		$acompanante=false;
		$contacto_emergencia=true;
		$otro=true;
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
		
			}
		}
		
		if($_REQUEST['plan'] == 137){
		$acudientes = false;
		$visa=false;
		$acompanante=false;
		$contacto_emergencia=true;
		$otro=true;
		
		if(isset($_REQUEST['ac'])){
			$facturacion=false;
		
			}
		}
		
		if($_REQUEST['plan'] == 25){
		$acudientes = false;
		$visa=false;
		$acompanante=true;
		$contacto_emergencia=true;
		$otro=false;
		}

	if((isset($_POST['nombres'])&& $_POST['paso'] == 2) || (!$contrato && $_POST['paso'] == 4)){
		
		$fnacimiento=$_POST['anio_nacimiento']."/".$_POST['mes_nacimiento']."/".$_POST['dia_nacimiento'];
		
		$fpasaporte=$_POST['anio_pasaporte']."/".$_POST['mes_pasaporte']."/".$_POST['dia_pasaporte'];
		
		$fvisa=$_POST['anio_visa']."/".$_POST['mes_visa']."/".$_POST['dia_visa'];
	 
	 if(!isset($_REQUEST['plan'])|| $_REQUEST['plan']=="" || $_REQUEST['plan']=="0"){
		 $_REQUEST['plan']=$_REQUEST['plan2'];
	 }

	 if($_POST['facnombres']!=''&& $_POST['facapellidos']!=""){
		$_POST['facnombre']=$_POST['facnombres']." ".$_POST['facapellidos'];
	 }
			
   $mensaje=$control->registrarViajero($_POST['nombres'],$_POST['apellidos'],$_POST['documento'],$_POST['no_docuento'],$fnacimiento,$_POST['email'],$_POST['telefono'],$_POST['celular'],$_POST['ciudad'],$_POST['direccion'],$_POST['pasaporte'],$fpasaporte,$_POST['no_visa'],$fvisa,$_POST['p1nombre'],$_POST['p1apellido'],$_POST['p1telefono'],$_POST['p1email'],$_POST['p2nombre'],$_POST['p2apellido'],$_POST['p2telefono'],$_POST['p2email'],$_POST['facnombre'],$_POST['facdocumento'],$_POST['facnumero'],$_POST['facciudad'],$_POST['facdireccion'],$_POST['facemail'],$_POST['plan'],$_POST['otro'],$_POST['estado_viajero'],$_POST['observaciones'],$_POST['acudiente1_tipodoc'],$_POST['acudiente1_documento'],$_POST['facnombres'],$_POST['facapellidos']);
   
     $idviajero=$control->idViajero($_POST['no_docuento']);
		$control->registrarSARLAFT($idviajero,'VIAJERO','REGISTRADO',$_POST['peps_recursos_publicos'],$_POST['peps_poder_publico'],$_POST['peps_reconocimiento_publico'],$_POST['peps_vinculo'],$_POST['actividad_economica'],$_POST['financiero_entidad'],$_POST['financiero_tipocuenta'],$_POST['financiero_nro'],$_POST['financiero_titular'],$_POST['financiero_documento'],$_POST['financiero_monedaextranjera'],$_POST['financiero_tipo_monedaextranjera'],0);
		
		$control->registrarSARLAFT($idviajero,'TERCERO','REGISTRADO',$_POST['peps_recursos_publicos2'],$_POST['peps_poder_publico2'],$_POST['peps_reconocimiento_publico2'],$_POST['peps_vinculo2'],$_POST['actividad_economica2'],$_POST['financiero_entidad2'],$_POST['financiero_tipocuenta2'],$_POST['financiero_nro2'],$_POST['financiero_titular2'],$_POST['financiero_documento2'],$_POST['financiero_monedaextranjera2'],$_POST['financiero_tipo_monedaextranjera2'],0);
  
   
   if(isset($_POST['acompanante']) && $_POST['acompanante']!=""){
   			$control->actualizarCampo("acompanante_de",$_POST['acompanante'],"no_documento",$_POST['no_docuento']);
		}
	}
	if(isset($_REQUEST['paso'])){
	$paso= $_REQUEST['paso'];
	}else{
		$paso = null;
	}
	//$paso= 3;
	if($paso == 3){
	$mensaje = $control->registrarFirma($_POST['document'],$_POST['firma']);
	
	}
	
	if($paso== 5){
		
		$documento = $_POST['document'];
		
		// obtenemos los datos del archivo 
	$tamano = $_FILES["cedula"]['size'];
	$tipo = $_FILES["cedula"]['type'];
	$archivo = $_FILES["cedula"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_identidad.".$extension;
		$destino =  "documentos/".$nombrearchivo;
		if (copy($_FILES['cedula']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
			 $mensaje=$control->actualizarCampo("doc_identidad",$nombrearchivo,"no_documento",$documento);
			
			
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
	
	
	// obtenemos los datos del archivo 
	$tamano = $_FILES["pasaporte"]['size'];
	$tipo = $_FILES["pasaporte"]['type'];
	$archivo = $_FILES["pasaporte"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_pasaporte.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['pasaporte']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_pasaporte",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
	
        
        // obtenemos los datos del archivo 
	$tamano = $_FILES["cc"]['size'];
	$tipo = $_FILES["cc"]['type'];
	$archivo = $_FILES["cc"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_pasaporte.".$extension;
		$destino =  "documentos/". $nombrearchivo;
		if (copy($_FILES['cc']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_cc",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
	
	
	// obtenemos los datos del archivo 
	$tamano = $_FILES["permiso"]['size'];
	$tipo = $_FILES["permiso"]['type'];
	$archivo = $_FILES["permiso"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_permiso.".$extension;
		$destino =  "documentos/".$nombrearchivo;
		if (copy($_FILES['pasaporte']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_permiso",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
	
	
	
	
	// obtenemos los datos del archivo 
	$tamano = $_FILES["rut"]['size'];
	$tipo = $_FILES["rut"]['type'];
	$archivo = $_FILES["rut"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_rut.".$extension;
		$destino =  "documentos/".$nombrearchivo;
		if (copy($_FILES['rut']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_rut",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
	
	
	// obtenemos los datos del archivo 
	$tamano = $_FILES["visa"]['size'];
	$tipo = $_FILES["visa"]['type'];
	$archivo = $_FILES["visa"]['name'];
	$prefijo = substr(md5(uniqid(rand())),0,6);
	$extension = pathinfo($archivo, PATHINFO_EXTENSION);
	
	if ($archivo != "") {
		// guardamos el archivo a la carpeta files
		$nombrearchivo = $documento."_visa.".$extension;
		$destino =  "documentos/".$nombrearchivo;
		if (copy($_FILES['visa']['tmp_name'],$destino)) {
			$status = "Archivo subido: <b>".$archivo."</b>";
						 $mensaje=$control->actualizarCampo("doc_visa",$nombrearchivo,"no_documento",$documento);
		} else {
			$status = "Error al subir el archivo";
		}
	} else {
		$status = "Error al subir archivo";
	}
	
	
	
	
		
	}
?>

<!-- this, preferably, goes inside head element: -->
<!--[if lt IE 9]>
<script type="text/javascript" src="jsignature/flashcanvas.js"></script>
<![endif]-->
	
    <script>
	

	
	$().ready(function() {
		// validate the comment form when it is submitted
		//$("#registro").validate();


		
	});
	</script>
    <script>
 $().ready(function() {
  //  $( "#fnacimiento" ).datepicker();
  });
  </script>
<style>
.advertencia{
padding:10px;
font-weight:bold;
color:#000;

}
</style>


        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                  
                    <!--/.span3-->
                    <div class="span12">
                        <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				  <div class="module-head">
           				    <h3> Registro</h3>
       				      </div>
           				  <div class="module-body">
           				    <div class="chart inline-legend grid">
           				      <?php if(isset($mensaje)){?>
                              <!--<div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div>-->
                              <p>
                                <?php } ?>
                                
                                <?php if(!isset($paso)){?>
                              </p>
                              <h2> REGISTRO DEL VIAJERO</h2>
                              <p>&nbsp;</p>
                              
                          <p align="justify" style="font-size:80%">Siguiendo los lineamientos de nuestra política interna y nuestra filosofía sobre el manejo y tratamiento de información personal, queremos ratificar que sus datos personales son tratados de forma privada y confidencial y que, por lo tanto, garantizamos la seguridad y confidencialidad de su información a través de un almacenamiento seguro que impide el acceso a terceras personas ajenas a nuestra organización empresarial.  Su información será manejada de acuerdo con lo establecido por la Ley Estatutaria 1581 de 2012 (Ley de protección de datos personales).</p>
                          <p align="justify" style="font-size:80%">&nbsp;</p>
                     
                              <form action="registro.php" method="post" class="form-horizontal row-fluid" id="registro">
           				        <div class="control-group">
           				          <label class="control-label" for="facdireccion2">Grupo:</label>
           				          <div class="controls">
           				            <p>
                                    <input name="producto" type="hidden" id="producto"  placeholder="" value="<?php echo $producto ?>"  />
                                    <input name="plan" type="hidden" id="plan"  placeholder="" value="<?php echo $_REQUEST['plan'] ?>"  />
                                    <?php if($contrato){?>
           				            <input name="paso" type="hidden" value="2" /><?php }else {?>
                           <input name="paso" type="hidden" value="4" />         
                                    <?php } ?>
										
                                    <?php if($unidadnegocio != 'GRUPOS JUVENILES'){
										$estado_viajero='PENDIENTE';}
										?>
                                        <input id="estado_viajero" name="estado_viajero" type="hidden" value="<?php echo $estado_viajero;?>" />
           				            <strong>
									
									<?php if($_REQUEST['plan']== 23){echo "GOLF POR LA LEYENDA DEL VINO 2016";}else{echo $control->nomGrupo($_REQUEST['plan']);} ?>
           				            </strong>
           				            <?php if(!isset($_REQUEST['plan'])|| $_REQUEST['plan']=="" || $_REQUEST['plan']=="0"){
?>
           				            <select name="plan2" id="plan2">
           				              <?php  	$res=$control->grupos();
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				              <option value="<?php echo $fi['id']; ?>" ><?php echo $fi['grupo'];?></option>
           				              <?php } ?>
         				              </select>
           				            <?php } ?>
           				         </div>
       				            </div>
                                
                                <div class="control-group">
           				          <strong>
           				          <label class="control-label" for="facdireccion2"><strong>Datos del Viajero:</strong></label>
           				          </strong>
           				        
           				          <div class="controls">
           				              <span class="advertencia"><strong>Los campos con (*) son obligatorios</strong></span>
<input name="ac2" type="hidden" id="ac2"  value="<?php echo $_REQUEST['ac'] ?>"  />
           				          <input name="acompanante" type="hidden" id="acompanante"  value="<?php echo $_REQUEST['ac'] ?>"  />
           				          </div>
       				            </div>
                                
                                
                                
           				        <div class="control-group">
           				          <label class="control-label" for="facdireccion">Nombres*</label>
           				          <div class="controls">
           				            <input name="nombres" type="text" class="span8" id="nombres" placeholder="" minlength="2" required style="text-transform:uppercase" >
                                       
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="facdireccion">Apellidos*</label>
           				          <div class="controls">
           				            <input name="apellidos" type="text" class="span8" id="apellidos" placeholder="" minlength="2" required style="text-transform:uppercase" >
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput3">Documento de Identificación</label>
           				          <div class="controls">
           				            <select name="documento" class="span8" id="documento" tabindex="1" data-placeholder="Select here..">
           				              
									
									<option value="CC" selected="selected">Seleccione</option>
                                      <option value="CC">Cedula</option>
                                      <option value="RC">Registro civil de nacimiento</option>
									  <option value="TI" >Tarjeta de Identidad</option>
                                      <option value="TE">Tarjeta de extranjeria</option>
                                      <option value="CE">Tipo de documento extranjero</option>
                                      <option value="NIT">NIT</option>
                                      <option value="Pasaporte" >Pasaporte</option>
       				                </select>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="facdireccion">Numero Documento*</label>
           				          <div class="controls">
           				            
                                    <script>
function validarRegistro() {
	str=document.getElementById("no_docuento").value;
    if (str == "") {
       return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				
				var respuesta = this.responseText;
				var lista = respuesta.split(";");
				document.getElementById("respuesta").innerHTML = lista[0];
			  
				if(lista.length > 4){
                document.getElementById("respuesta").innerHTML = lista[0];
			  document.getElementById("nombres").value= lista[1];
			   document.getElementById("apellidos").value= lista[2];
			   
			   var fech = lista[3].split("-");
			   
			  // window.alert(lista[14]);
			  // window.alert(lista[15]);
			  //  window.alert(lista[16]);
			   			   
			     document.getElementById("dia_nacimiento").value= Number(fech[2]);
				  document.getElementById("mes_nacimiento").selectedIndex= Number(fech[1]);
				    document.getElementById("anio_nacimiento").value= fech[0];
					
					
					   document.getElementById("email").value= lista[4];
					    document.getElementById("telefono").value= lista[5];
						 document.getElementById("celular").value= lista[6];
						 
	  document.getElementById("p1nombre").value= lista[7];
            
	 document.getElementById("p1apellido").value= lista[8];
	 document.getElementById("p1telefono").value= lista[9];
	 document.getElementById("p1email").value= lista[10];
	 
	 document.getElementById("p2nombre").value= lista[11];
       /*     
	 document.getElementById("p2apellido").value= lista[12];
	 document.getElementById("p2telefono").value= lista[13];
	 document.getElementById("p2email").value= lista[14];
	 
	 */
	 
	 document.getElementById("facnombre").value= lista[14];
	 document.getElementById("facdocumento").value= lista[15];
	 
	  document.getElementById("facnodocumento").value= lista[16];
	  
	 document.getElementById("facciudad").value= lista[17];
	 
	  document.getElementById("facdireccion").value= lista[18];
	   document.getElementById("facemail").value= lista[19];
				
				}else if(lista[0] == "VIAJERO YA REGISTRADO"){
				
				//window.alert("DETENER");
				document.getElementById("envio").disabled=true;
				}else { 
				document.getElementById("envio").disabled=false;
				}
					}
        };
        xmlhttp.open("GET","api.php?viajero="+str+"&plan=<?php echo $_REQUEST['plan'];?>",true);
        xmlhttp.send();
    }
}
</script>
                                    
                                    <input name="no_docuento" type="text" class="span8" id="no_docuento" placeholder="" minlength="2" required onChange="validarRegistro()">
           				          <span id="respuesta" style="color:#F00;font-weight:bold"></span></div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput5">Fecha Nacimiento*</label>
           				          <div class="controls">
                                  
           				            <p>
           				              <select name="dia_nacimiento" id="dia_nacimiento" style="width: auto;">
           				                <option value="0">Dia</option>
           				                <option value="1">1</option>
           				                <option value="2">2</option>
           				                <option value="3">3</option>
           				                <option value="4">4</option>
           				                <option value="5">5</option>
           				                <option value="6">6</option>
           				                <option value="7">7</option>
           				                <option value="8">8</option>
           				                <option value="9">9</option>
           				                <option value="10">10</option>
           				                <option value="11">11</option>
           				                <option value="12">12</option>
           				                <option value="13">13</option>
           				                <option value="14">14</option>
           				                <option value="15">15</option>
           				                <option value="16">16</option>
           				                <option value="17">17</option>
           				                <option value="18">18</option>
           				                <option value="19">19</option>
           				                <option value="20">20</option>
           				                <option value="21">21</option>
           				                <option value="22">22</option>
           				                <option value="23">23</option>
           				                <option value="24">24</option>
           				                <option value="25">25</option>
           				                <option value="26">26</option>
           				                <option value="27">27</option>
           				                <option value="28">28</option>
           				                <option value="29">29</option>
           				                <option value="30">30</option>
           				                <option value="31">31</option>
       				                  </select>
&nbsp;
<select name="mes_nacimiento" id="mes_nacimiento" style="width: auto;">
  <option value="0">Mes</option>
  <option value="1">Ene</option>
  <option value="2">Feb</option>
  <option value="3">Mar</option>
  <option value="4">Abr</option>
  <option value="5">May</option>
  <option value="6">Jun</option>
  <option value="7">Jul</option>
  <option value="8">Ago</option>
  <option value="9">Sep</option>
  <option value="10">Oct</option>
  <option value="11">Nov</option>
  <option value="12">Dic</option>
</select>
&nbsp;
<select name="anio_nacimiento" id="anio_nacimiento" style="width: auto;">
  <option value="0">A&ntilde;o</option>
  <option value="2015">2015</option>
  <option value="2014">2014</option>
  <option value="2013">2013</option>
  <option value="2012">2012</option>
  <option value="2011">2011</option>
  <option value="2010">2010</option>
  <option value="2009">2009</option>
  <option value="2008">2008</option>
  <option value="2007">2007</option>
  <option value="2006">2006</option>
  <option value="2005">2005</option>
  <option value="2004">2004</option>
  <option value="2003">2003</option>
  <option value="2002">2002</option>
  <option value="2001">2001</option>
  <option value="2000">2000</option>
  <option value="1999">1999</option>
  <option value="1998">1998</option>
  <option value="1997">1997</option>
  <option value="1996">1996</option>
  <option value="1995">1995</option>
  <option value="1994">1994</option>
  <option value="1993">1993</option>
  <option value="1992">1992</option>
  <option value="1991">1991</option>
  <option value="1990">1990</option>
  <option value="1989">1989</option>
  <option value="1988">1988</option>
  <option value="1987">1987</option>
  <option value="1986">1986</option>
  <option value="1985">1985</option>
  <option value="1984">1984</option>
  <option value="1983">1983</option>
  <option value="1982">1982</option>
  <option value="1981">1981</option>
  <option value="1980">1980</option>
  <option value="1979">1979</option>
  <option value="1978">1978</option>
  <option value="1977">1977</option>
  <option value="1976">1976</option>
  <option value="1975">1975</option>
  <option value="1974">1974</option>
  <option value="1973">1973</option>
  <option value="1972">1972</option>
  <option value="1971">1971</option>
  <option value="1970">1970</option>
    <option value="1969">1969</option>
  <option value="1968">1968</option>
  <option value="1967">1967</option>
  <option value="1966">1966</option>
  <option value="1965">1965</option>
  <option value="1964">1964</option>
  <option value="1963">1963</option>
  <option value="1962">1962</option>
  <option value="1961">1961</option>
  <option value="1960">1960</option>
      <option value="1959">1959</option>
  <option value="1958">1958</option>
  <option value="1957">1957</option>
  <option value="1956">1956</option>
  <option value="1955">1955</option>
  <option value="1954">1954</option>
  <option value="1953">1953</option>
  <option value="1952">1952</option>
  <option value="1951">1951</option>
  <option value="1950">1950</option>
      <option value="1949">1949</option>
  <option value="1948">1948</option>
  <option value="1947">1947</option>
  <option value="1946">1946</option>
  <option value="1945">1945</option>
  <option value="1944">1944</option>
  <option value="1943">1943</option>
  <option value="1942">1942</option>
  <option value="1941">1941</option>
  <option value="1940">1940</option>
      <option value="1939">1939</option>
  <option value="1938">1938</option>
  <option value="1937">1937</option>
  <option value="1936">1936</option>
  <option value="1935">1935</option>
  <option value="1934">1934</option>
  <option value="1933">1933</option>
  <option value="1932">1932</option>
  <option value="1931">1931</option>
  <option value="1930">1930</option>
<option value="1929">1929</option>
  <option value="1928">1928</option>
  <option value="1927">1927</option>
  <option value="1926">1926</option>
  <option value="1925">1925</option>
  <option value="1924">1924</option>
  <option value="1923">1923</option>
  <option value="1922">1922</option>
  <option value="1921">1921</option>
  <option value="1920">1920</option>
</select>
           				            </p>
           				          </div>
       				            </div>
                                  <?php if(($datos_producto['nombre_tarifa2'] != "" &&  strpos($producto['nombre_tarifa2'],'interno')=== false)||($datos_producto['nombre_tarifa3'] != "" &&  strpos($producto['nombre_tarifa3'],'interno')=== false)||($datos_producto['nombre_tarifa4'] != "" &&  strpos($producto['nombre_tarifa4'],'interno')=== false)){?>
                                <div class="control-group">
           				          <label class="control-label" for="basicinput3">Tipo de Viajero</label>
                                  
                                
           				          <div class="controls">
           				          
<?php if(($datos_producto['nombre_tarifa2'] != "" &&  strpos($producto['nombre_tarifa2'],'interno')=== false)||($datos_producto['nombre_tarifa3'] != "" &&  strpos($producto['nombre_tarifa3'],'interno')=== false)||($datos_producto['nombre_tarifa4'] != "" &&  strpos($producto['nombre_tarifa4'],'interno')=== false)){?>
                                    <select name="otro" class="span8" id="otro" tabindex="1" data-placeholder="Select here..">
           				             
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
                                    
           				           
       				              <?php } ?>
                                  
       				              </div>
       				            </div>
                                <?php }else{?>
                                <input name="otro2" type="hidden" id="otro2" value="">
                                <?php } ?>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput6">E-mail*</label>
           				          <div class="controls">
           				            <input name="email" type="email" class="span8" id="email" placeholder="" minlength="5" required>
       				              </div>
       				            </div>
           				      <!--  <div class="control-group">
           				          <label class="control-label" for="basicinput7">Telefono Fijo:</label>
         				          
<div class="controls">
           				            <input name="telefono" type="text" class="span8" id="telefono" placeholder="">
       				              </div>
       				            </div>-->
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput8">Celular del Viajero*:</label>
           				          <div class="controls">
           				            <input name="celular" type="text" class="span8" id="celular" placeholder=""  required>
       				              </div>
       				            </div>
           				        <div class="control-group">
                                 <label class="control-label" for="basicinput8">Ciudad de Residencia</label>
           				          <div class="controls">
           				            <select name="ciudad" class="span8" id="ciudad" tabindex="1" data-placeholder="Select here..">
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
                                
                                 <div class="control-group">
           				          <label class="control-label" for="basicinput13">Condiciones Especiales:</label>
           				          <div class="controls">
           				            
										    
   				                        <input type="radio" name="RadioGroup1" value="No" id="RadioGroup1_1" checked>
   				                      No</label>
       				                  <label>
       				                    <input type="radio" name="RadioGroup1" value="si" id="RadioGroup1_0">
       				                    Si</label> 
       				                  <label>
       				                
Cual: 
       				                  <input name="observaciones" type="text" class="span8" id="observaciones" placeholder="">
       				                  <br>
       				                  Si el viajero cuenta con alguna condición médica, alimentación especial, o requerimiento
           				          específico que debamos conocer, por favor detállelo, de lo contrario omita este campo </p>
								    <p>El manejo de la información sobre condiciones médicas especiales de nuestros viajeros es CONFIDENCIAL y  será manejada de acuerdo con lo establecido por la Ley Estatutaria 1581 de 2012 (Ley de protección de datos personales).</p>
           				          </div>
       				            </div>
           				 <!--       <div class="control-group"><span class="control-label">Dirección</span>
           				          <div class="controls">
           				            <input name="direccion" type="text" class="span8" id="direccion" placeholder="" style="text-transform:uppercase" >
           				          </div>
       				            </div>-->
           				        
           				        <div class="control-group">
           				          <div class="control-group">
           				            <div class="controls"></div>
       				              </div>
           				          <label class="control-label" for="basicinput9">No. Pasaporte</label>
           				          <div class="controls">
           				            <input name="pasaporte" type="text" class="span8" id="basicinput9" placeholder="0 (cero) si no tiene">
       				                <br>
           				          Pasaporte vigente durante el viaje </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput10">Fecha Vencimiento Pasaporte:</label>
           				          <div class="controls">
           				            <select name="dia_pasaporte" style="width: auto;">
           				              <option value="0">Dia</option>
           				              <option value="1">1</option>
           				              <option value="2">2</option>
           				              <option value="3">3</option>
           				              <option value="4">4</option>
           				              <option value="5">5</option>
           				              <option value="6">6</option>
           				              <option value="7">7</option>
           				              <option value="8">8</option>
           				              <option value="9">9</option>
           				              <option value="10">10</option>
           				              <option value="11">11</option>
           				              <option value="12">12</option>
           				              <option value="13">13</option>
           				              <option value="14">14</option>
           				              <option value="15">15</option>
           				              <option value="16">16</option>
           				              <option value="17">17</option>
           				              <option value="18">18</option>
           				              <option value="19">19</option>
           				              <option value="20">20</option>
           				              <option value="21">21</option>
           				              <option value="22">22</option>
           				              <option value="23">23</option>
           				              <option value="24">24</option>
           				              <option value="25">25</option>
           				              <option value="26">26</option>
           				              <option value="27">27</option>
           				              <option value="28">28</option>
           				              <option value="29">29</option>
           				              <option value="30">30</option>
           				              <option value="31">31</option>
       				                </select>
&nbsp;
<select name="mes_pasaporte" style="width: auto;">
  <option value="0">Mes</option>
  <option value="1">Ene</option>
  <option value="2">Feb</option>
  <option value="3">Mar</option>
  <option value="4">Abr</option>
  <option value="5">May</option>
  <option value="6">Jun</option>
  <option value="7">Jul</option>
  <option value="8">Ago</option>
  <option value="9">Sep</option>
  <option value="10">Oct</option>
  <option value="11">Nov</option>
  <option value="12">Dic</option>
</select>
&nbsp;
<select name="anio_pasaporte" style="width: auto;">
  <option value="0">A&ntilde;o</option>
<option value="2030">2040</option>
<option value="2030">2039</option>
<option value="2030">2038</option>
<option value="2030">2037</option>
<option value="2030">2036</option>
<option value="2030">2035</option>
<option value="2030">2034</option>
<option value="2030">2033</option>
<option value="2030">2032</option>
<option value="2030">2031</option>
<option value="2030">2030</option>
<option value="2029">2029</option>
<option value="2028">2028</option>
<option value="2027">2027</option>
<option value="2026">2026</option>
<option value="2025">2025</option>
<option value="2024">2024</option>
  <option value="2023">2023</option>
</select>
<br>
           				          </div>
       				            </div>
                                <?php if($visa){ ?>
           				        <div class="control-group">
           				          <label class="control-label">Tiene Visa Americana?</label>
           				          <div class="controls">
           				            <label class="radio">
           				              <input type="radio" name="visa" id="visa" value="si" checked="">
           				              Si</label>
           				            <label class="radio">
           				              <input type="radio" name="visa" id="visa" value="no">
           				              No</label>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput11">No. Visa</label>
           				          <div class="controls">
           				            <input name="no_visa" type="text" class="span8" id="basicinput11" placeholder="">
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput12">Fecha Vencimiento</label>
           				          <div class="controls">
           				            <p>
                                      <select name="dia_visa" style="width: auto;">
                                        <option value="0">Dia</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                      </select>
&nbsp;
<select name="mes_visa" style="width: auto;">
  <option value="0">Mes</option>
  <option value="1">Ene</option>
  <option value="2">Feb</option>
  <option value="3">Mar</option>
  <option value="4">Abr</option>
  <option value="5">May</option>
  <option value="6">Jun</option>
  <option value="7">Jul</option>
  <option value="8">Ago</option>
  <option value="9">Sep</option>
  <option value="10">Oct</option>
  <option value="11">Nov</option>
  <option value="12">Dic</option>
</select>
&nbsp;
<select name="anio_visa" style="width: auto;">
  <option value="0">A&ntilde;o</option>
  <option value="2025">2025</option>
<option value="2024">2024</option>
  <option value="2023">2023</option>
  <option value="2022">2022</option>
  
    <option value="2021">2021</option>
      <option value="2020">2020</option>
        <option value="2019">2019</option>
          <option value="2018">2018</option>  
          <option value="2017">2017</option>  
          <option value="2016">2016</option>
  <option value="2015">2015</option>
  <option value="2014">2014</option>
  <option value="2013">2013</option>
  <option value="2012">2012</option>
  <option value="2011">2011</option>
  <option value="2010">2010</option>
  <option value="2009">2009</option>
  <option value="2008">2008</option>
  <option value="2007">2007</option>
  <option value="2006">2006</option>
  <option value="2005">2005</option>
  <option value="2004">2004</option>
  <option value="2003">2003</option>
  <option value="2002">2002</option>
  <option value="2001">2001</option>
  <option value="2000">2000</option>
  <option value="1999">1999</option>
  <option value="1998">1998</option>
  <option value="1997">1997</option>
  <option value="1996">1996</option>
  <option value="1995">1995</option>
  <option value="1994">1994</option>
  <option value="1993">1993</option>
  <option value="1992">1992</option>
  <option value="1991">1991</option>
  <option value="1990">1990</option>
  <option value="1989">1989</option>
  <option value="1988">1988</option>
  <option value="1987">1987</option>
  <option value="1986">1986</option>
  <option value="1985">1985</option>
  <option value="1984">1984</option>
  <option value="1983">1983</option>
  <option value="1982">1982</option>
  <option value="1981">1981</option>
  <option value="1980">1980</option>
  <option value="1979">1979</option>
  <option value="1978">1978</option>
  <option value="1977">1977</option>
  <option value="1976">1976</option>
  <option value="1975">1975</option>
  <option value="1974">1974</option>
  <option value="1973">1973</option>
  <option value="1972">1972</option>
  <option value="1971">1971</option>
  <option value="1970">1970</option>
</select>
                                    </p>
           				          </div>
       				            </div>
                                <?php  } ?>
                                
                                <div class="control-group">
           				          <label class="control-label" for="basicinput15"><strong>SAGRLAFT</strong></label>
           				          :
           				          <div class="controls"><span class="advertencia">Información para el control de lavado de activos</span>           				          </div>
       				            </div>
                                
                              <div class="control-group">
           				          <label class="control-label" for="basicinput13">Actividad Económica del Viajero</label>
           				          <div class="controls">
           				            <input name="actividad_economica" type="text" class="span8" id="actividad_economica" placeholder="" required>
       				              </div>
       				            </div>
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Maneja recursos públicos?</label>
           				          <div class="controls">
           				         
									<select name="peps_recursos_publicos" class="span8" id="peps_recursos_publicos" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Ejerce algun tipo de poder público?</label>
           				          <div class="controls">
           				         
									<select name="peps_poder_publico" class="span8" id="peps_poder_publico" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Goza de Reconocimiento público?</label>
           				          <div class="controls">
           				         
									<select name="peps_reconocimiento_publico" class="span8" id="peps_reconocimiento_publico" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Tiene algun vinculo con una persona públicamente expuesta?</label>
           				          <div class="controls">
           				         
									<select name="peps_vinculo" class="span8" id="peps_vinculo" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput15"></label>
           				          <div class="controls"><span class="advertencia"><strong>OPERACIONES EN MONEDA EXTRANJERA</strong></span>           				          </div>
       				            </div>
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">Realiza operaciones en moneda extranjera</label>
           				          <div class="controls">
           				         
									<select name="financiero_monedaextranjera" class="span8" id="financiero_monedaextranjera" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">Tipo de operaciones</label>
           				          <div class="controls">
           				         
									<select name="financiero_tipo_monedaextranjera" class="span8" id="financiero_tipo_monedaextranjera" tabindex="1" >
           				              <option value="NINGUNA" selected="selected">NINGUNA</option>
                                      <option value="IMPORTACIONES">IMPORTACIONES</option>
                                      <option value="EXPORTACIONES">EXPORTACIONES</option>
                                      <option value="INVERSIONES">INVERSIONES</option>
                                      <option value="PRESTAMOS">PRESTAMOS</option>
                                      <option value="GIROS">GIROS</option>
                                      <option value="TRANSFERENCIAS">TRANSFERENCIAS</option>
                                      <option value="OTROS">OTROS</option>
           				             </select>
									</div>
       				            </div>
								
                                <div class="control-group">
           				          <label class="control-label" for="basicinput13">Programa de Viajero Frecuente (si aplica)</label>
           				          <div class="controls">
           				            <input name="p2telefono" type="text" class="span8" id="basicinput13" placeholder="">
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput14">Nro Viajero Frecuente</label>
           				          <div class="controls">
           				            <input name="p2email" type="text" class="span8" id="basicinput14" placeholder="">
       				              </div>
       				            </div>
                                  <?php if($contacto_emergencia){?>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput15"><strong>Contacto de Emergencia</strong></label>
           				          <div class="controls">Por favor dejenos un contacto en caso de alguna eventualidad:           				          </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Nombre *</label>
           				          <div class="controls">
           				            <input name="p1nombre" type="text" class="span8" id="p1nombre" placeholder="" minlength="4" style="text-transform:uppercase" >
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Apellidos </label>
           				          *
           				          <div class="controls">
           				            <input name="p1apellido" type="text" class="span8" id="p1apellido" placeholder="" style="text-transform:uppercase" >
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Telefono</label>
           				          *
           				          <div class="controls">
           				            <input name="p1telefono" type="text" class="span8" id="p1telefono" placeholder="(572) XXXXXX">
       				              </div>
       				            </div>
           				        <?php } ?>
                             
                                <?php if($acudientes){?>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput15"><strong>Acudientes</strong></label>
           				          :
           				          <div class="controls"><span class="advertencia">Por favor ingrese al menos un contacto de acudiente:</span>           				          </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Nombre Acudiente 1*</label>
           				          <div class="controls">
           				            <input name="p1nombre" type="text" class="span8" id="p1nombre" placeholder="" minlength="4" style="text-transform:uppercase" required>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Apellidos Acudiente 1</label>
           				          *
           				          <div class="controls">
           				            <input name="p1apellido" type="text" class="span8" id="p1apellido" placeholder="" style="text-transform:uppercase" required>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput10">Tipo Documento de Identificación</label>
           				          <div class="controls">
           				            <select name="acudiente1_tipodoc" class="span8" id="acudiente1_tipodoc" tabindex="1" data-placeholder="Select here..">
           				              <option value="CC" selected="selected">Seleccione</option>
           				              <option value="CC">Cedula</option>
           				              <option value="TI" >Tarjeta de Identidad</option>
           				              <option value="Pasaporte" >Pasaporte</option>
       				                </select>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput9">No Documento Acudiente 1</label>
           				          *
  <div class="controls">
    <input name="acudiente1_documento" type="text" class="span8" id="acudiente1_documento" placeholder="" style="text-transform:uppercase" required>
  </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Telefono</label>
           				          *
           				          <div class="controls">
           				            <input name="p1telefono" type="text" class="span8" id="p1telefono" placeholder="" required>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">E-mail</label>
           				          *
           				          <div class="controls">
           				            <input name="p1email" type="email" class="span8" id="p1email" placeholder="" required>
       				              </div>
       				            </div>
                                
                                  <div class="control-group">
           				          <label class="control-label" for="basicinput13">Nombre Acudiente 2</label>
           				          <div class="controls">
           				            <input name="p2nombre" type="text" class="span8" id="p2nombre" placeholder="" style="text-transform:uppercase" >
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Apellidos Acudiente 2</label>
           				          <div class="controls">
           				            <input name="p2apellido" type="text" class="span8" id="p2apellido" placeholder="" style="text-transform:uppercase" >
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">Telefono</label>
           				          <div class="controls">
           				            <input name="p2telefono" type="text" class="span8" id="basicinput13" placeholder="">
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput13">E-mail</label>
           				          <div class="controls">
           				            <input name="p2email" type="email" class="span8" id="p2email" placeholder="">
       				              </div>
       				            </div>
                                <?php } ?>
                                <?php if($facturacion_invisible){ ?>
                                
								 <input type="hidden" name="facnombre" id="facnombre"  value="<?php echo $acmp['facturacion_nombre'] ?>">
                                 <input type="hidden" name="facdocumento"  id="facdocumento"  value="<?php echo $acmp['facturacion_documento'] ?>">
                                 <input  type="hidden" name="facnumero" id="facnumero"  value="<?php echo $acmp['facturacion_nodocumento'] ?>">
                                 
                                 <input name="facdireccion"  type="hidden" id="fadireccion"  value="<?php echo $acmp['facturacion_direccion'] ?>">
                                 
                                  <input name="facemail" type="hidden" id="facemail"  value="<?php echo $acmp['facturacion_email'] ?>" >
                                 
                                 
								<?php } ?>
								
                                <?php if($facturacion){ ?>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput2"><strong>Datos para Facturación</strong></label>
           				          <div class="controls">Por favor indique los datos  de la persona o empresa a quien se deban emitir  recibos de caja y facturas,
									 por favor adjuntar el Rut correspondiente detallando el correo al que requieran se envíe la factura :
									<br> <a href="#!" onClick="copiarViajero()">COPIAR DATOS DEL VIAJERO</a>
									</div>
									<script>
										function copiarViajero(){
											
											console.log();
											$("#actividad_economica2").val($("#actividad_economica").val());
											$("#facnombre").val($("#nombres").val()+" "+$("#apellidos").val());
											$("#facnombres").val($("#nombres").val());
											$("#facapellidos").val($("#apellidos").val());
										
											$("#facdocumento").val($("#documento").val());
											$("#facnumero").val($("#no_documento").val());
											
												$("#peps_recursos_publicos2").val($("#peps_recursos_publicos").val());
												$("#peps_poder_publico2").val($("#peps_poder_publico").val());
												$("#peps_reconocimiento_publico2").val($("#peps_reconocimiento_publico").val());
												$("#peps_vinculo2").val($("#peps_vinculo").val());
												$("#financiero_entidad2").val($("#financiero_entidad").val());
												$("#financiero_tipocuenta2").val($("#financiero_tipocuenta").val());
												$("#financiero_nro2").val($("#financiero_nro").val());
												$("#financiero_titular2").val($("#financiero_titular").val());
												$("#financiero_documento2").val($("#financiero_documento2").val());
												$("#financiero_monedaextranjera2").val($("#financiero_monedaextranjera").val());
												$("#financiero_tipo_monedaextranjera2").val($("#financiero_tipo_monedaextranjera").val());
												$("#facemail").val($("#email").val());
											
										}
										
									</script>
           				          <br>
           				        </div>

								   <div class="control-group">
           				          <label class="control-label" for="basicinput3">Documento de Identificación para Factura</label>
        				          
<div class="controls">
<script>
function nit(){
	var documento = document.getElementById('facdocumento');
	if(documento.value == "NIT"){
	document.getElementById('nit').setAttribute("style", "display: block;");
	document.getElementById('rs').setAttribute("style", "display: block;");
	document.getElementById('ap1').setAttribute("style", "display: none;");
	document.getElementById('nm1').setAttribute("style", "display: none;");

}else{
	
	document.getElementById('nit').setAttribute("style", "display: none;");
	document.getElementById('rs').setAttribute("style", "display: none;");
	document.getElementById('ap1').setAttribute("style", "display: block;");
	document.getElementById('nm1').setAttribute("style", "display: block;");
	}
}
</script>
           				            <p>
           				              <select name="facdocumento" class="span8" id="facdocumento" tabindex="1" data-placeholder="Select here.." onChange="nit()">
           				                <option value="Cedula">Cedula</option>
           				                <option value="NIT">NIT</option>
										 <option value="Cedula de extranjeria">Cedula de extranjeria</option>
           				                <option value="Pasaporte">Pasaporte</option>
       				                  </select>
		              </p>
           				        
</div>
       				            </div>
								   
							  
           				        <div class="control-group">
           				          <label class="control-label" for="facdireccion">Numero Documento*</label>
           				          <div class="controls">
           				            <input name="facnumero" type="number" class="span8" id="facnumero" placeholder="" minlength="2" required>
       				              </div>
       				            </div>



                                <div class="control-group" id="rs" style="display:none;">
           				          <label class="control-label" for="facdireccion">Razón Social <br>
       				              (De quien Firmará el contrato)*</label>
           				          <div class="controls">
           				            <input name="facnombre"  id="facnombre" type="text" class="span8" placeholder="" minlength="2"  style="text-transform:uppercase" >
       				              </div>
       				            </div>

								   <div class="control-group" id="nm1" >
           				          <label class="control-label" for="facdireccion">Nombres <br>
       				             </label>
           				          <div class="controls">
           				            <input name="facnombres"  id="facnombres" type="text" class="span8" placeholder="" minlength="2"  style="text-transform:uppercase" >
       				              </div>
       				            </div>

								   <div class="control-group" id="ap1" >
           				          <label class="control-label" for="facdireccion">Apellidos <br>
       				             </label>
           				          <div class="controls">
           				            <input name="facapellidos"  id="facapellidos" type="text" class="span8" placeholder="" minlength="2"  style="text-transform:uppercase" >
       				              </div>
       				            </div>

                                          
								<div id="nit" style="display:none;"><div style="margin-top: 13px;  padding-top: 13px;  border-top: 1px solid #f5f5f5; border-bottom: 1px solid #f5f5f5;"> <p><strong>*IMPORTANTE:</strong> Si selecciona la opción NIT deberá adjuntar una copia escaneada del RUT de la empresa </p>
									   <div class="control-group">
									   <label class="control-label" for="facdireccion">Numero Documento Representante Legal*</label>
           				          <div class="controls">
           				            <input name="no_documento_replegal" type="number" class="span8" id="no_documento_replegal" placeholder="" minlength="2">
       				              </div>
       				            	</div>
									   
									    <div class="control-group">
									   <label class="control-label" for="facdireccion">Nombre Representante Legal*</label>
           				          <div class="controls">
           				            <input name="nombre_replegal" type="text" class="span8" id="nombre_replegal" placeholder="" minlength="2">
       				              </div>
       				            	</div>
									   </div>
								</div>
								
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput18">Ciudad</label>
           				          *
           				          <div class="controls">
           				            <select name="facciudad" class="span8" id="facciudad" tabindex="1" data-placeholder="Select here..">
           				              <option value="Cali">Cali</option>
           				              <option value="Bogota">Bogota</option>
           				              <option value="Pereira">Pereira</option>
           				              <option value="Armenia">Armenia</option>
           				              <option value="Popayan">Popayan</option>
           				              <option value="Barranquilla">Barranquilla</option>
           				              <option value="Santa Marta">Santa Marta</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
           				              <option value="Otra">Otra</option>
       				                </select>
           				          </div>
       				            </div>

								   <div class="control-group">
           				          <label class="control-label" for="basicinput4">Direccion*</label>
           				          <div class="controls">
           				            <input name="facdireccion" type="text" class="span8" id="facdireccion" placeholder="" minlength="2" required>
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput3">E-mail</label>
           				          <div class="controls">
           				            <input name="facemail" type="text" class="span8" id="facemail" placeholder="">
       				              </div>
       				            </div>
								
								 <div class="control-group">
           				          <label class="control-label" for="basicinput15"><strong>SAGRLAFT</strong></label>
           				          :
           				          <div class="controls"><span class="advertencia">Información para el control de lavado de activos</span>           				          </div>
       				            </div>
                                
                              <div class="control-group">
           				          <label class="control-label" for="basicinput13">Actividad Económica del Tercero</label>
           				          <div class="controls">
           				            <input name="actividad_economica2" type="text" class="span8" id="actividad_economica2" placeholder="" required>
       				              </div>
       				            </div>
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Maneja recursos públicos?</label>
           				          <div class="controls">
           				         
									<select name="peps_recursos_publicos2" class="span8" id="peps_recursos_publicos2" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Ejerce algun tipo de poder público?</label>
           				          <div class="controls">
           				         
									<select name="peps_poder_publico2" class="span8" id="peps_poder_publico2" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Goza de Reconocimiento público?</label>
           				          <div class="controls">
           				         
									<select name="peps_reconocimiento_publico2" class="span8" id="peps_reconocimiento_publico2" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">¿Tiene algun vinculo con una persona públicamente expuesta?</label>
           				          <div class="controls">
           				         
									<select name="peps_vinculo2" class="span8" id="peps_vinculo2" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								
								<div class="control-group">
           				          <label class="control-label" for="basicinput15"></label>
           				          <div class="controls"><span class="advertencia"><strong>OPERACIONES EN MONEDA EXTRANJERA</strong></span>           				          </div>
       				            </div>
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">Realiza operaciones en moneda extranjera</label>
           				          <div class="controls">
           				         
									<select name="financiero_monedaextranjera2" class="span8" id="financiero_monedaextranjera2" tabindex="1" >
           				              <option value="NO" selected="selected">NO</option>
                                      <option value="SI">SI</option>
           				             </select>
									</div>
       				            </div>
								<div class="control-group">
           				          <label class="control-label" for="basicinput13">Tipo de operaciones</label>
           				          <div class="controls">
           				         
									<select name="financiero_tipo_monedaextranjera2" class="span8" id="financiero_tipo_monedaextranjera2" tabindex="1" >
           				              <option value="NINGUNA" selected="selected">NINGUNA</option>
                                      <option value="IMPORTACIONES">IMPORTACIONES</option>
                                      <option value="EXPORTACIONES">EXPORTACIONES</option>
                                      <option value="INVERSIONES">INVERSIONES</option>
                                      <option value="PRESTAMOS">PRESTAMOS</option>
                                      <option value="GIROS">GIROS</option>
                                      <option value="TRANSFERENCIAS">TRANSFERENCIAS</option>
                                      <option value="OTROS">OTROS</option>
           				             </select>
									</div>
       				            </div>
								
								
           				       
           				        <?php if($acompanante){?>
                                <div class="control-group">
           				          <label class="control-label" for="basicinput3"><strong>Acompa&ntilde;ante</strong></label>
           				          :
           				          <div class="controls">
           				            <input  type="radio" id="siacompanante" name="siacompanante" value="si" checked="checked"  />
           				           SI
                                      <input type="radio" id="siacompanante" name="siacompanante" value="no" />
           				         NO
       				              <br />
       				              Si viaja con un acompañante debera registrar sus datos al finalizar este registro
           				          </div>
                                  
                                 
       				            </div>
                                 <?php } ?>
                                <?php } ?>
           				       <!-- <div class="control-group">
           				          <label class="control-label" for="basicinput16">Terminos y condiciones</label>
           				          <div class="controls">
           				            <p>Al registrar su información y hacer clic en el botón registrar usted está aceptando nuestras <strong><a href="https://eventoursport.travel/crm/programas/grupo.php?plan=<?php echo $_REQUEST['plan'];?>">Clausulas de Responsabilidad (Clic para ver)</a></strong> del programa.</p>
           				            <p>
           				              <script>
									 EnableSubmit = function(val)
{
    var sbmt = document.getElementById("envio");

    if (val.checked == true)
    {
        sbmt.disabled = false;
    }
    else
    {
        sbmt.disabled = true;
    }
}      
									  </script>
           				              <input type="checkbox" name="acepto" id="acepto" onClick="EnableSubmit(this)">
           				              He aceptado los terminos y condiciones</p>
       				              </div>
       				            </div>-->
           				        <p>&nbsp;</p>
           				        <div class="control-group">
           				          <div class="controls">
           				            <input type="hidden" id="firma" name="firma" value="">
           				            <button type="submit" class="btn"  id="envio" name="envio"> <?php if($contrato){?>Continuar<?php } else{?>Continuar<?php } ?></button>
       				              </div>
       				            </div>
                                
       				         Mediante el registro de sus datos personales en el presente formulario, usted autoriza a Eventour Sport para la recolección, almacenamiento y uso de los mismos, con la finalidad de realizar la inscripción y solicitud de todos los servicios contratados, así como para informarle sobre otros eventos organizados por Eventour Sport, relacionados con nuestras funciones, sobre los servicios que prestamos, las publicaciones que elaboramos y para solicitarle que evalúe la calidad de nuestros servicios. Como Titular de información tiene derecho a conocer, actualizar y rectificar sus datos personales, solicitar prueba de la autorización otorgada para su tratamiento, ser informado sobre el uso que se ha dado a los mismos, presentar quejas ante la SIC por infracción a la ley, revocar la autorización y/o solicitar la supresión de sus datos en los casos en que sea procedente, y acceder en forma gratuita a los mismos.
                              </form>
                              <p>
                              <?php } if ($paso==2){?>
                               <form action="registro.php#modal" method="post" class="form-horizontal row-fluid" id="registro">
                               
                                 

    
                                 <div class="control-group">
                               
                                 <div style="width:80%;margin:0 auto;">  <h2> VERIFICACI&Oacute;N Y FIRMA DE ACEPTACIÓN DEL CONTRATO:</h2>
                                 <p>
                                   <iframe width="100%" height="350px" style="margin:0 auto;width:100%" src="<?php echo $url_contrato;?>?accion=print&firma=<?php echo $_REQUEST['no_docuento']?>&txt=1&plan=<?php echo $_REQUEST['plan'];?>"></iframe>
                                 </p>
                                 </div>
                                   <div style="width:80%;margin:0 auto;">
									   <p><strong>Declaración de Origen de Fondos</strong><br>
								    Me permito realizar las siguientes declaraciones sobre la  fuente y origen de fondos y actividades licitas:</p>
                                    <ol>
                                      <li>Declaro  que mis bienes y recursos provienen de actividades lícitas, de conformidad con  la normatividad Colombiana.</li>
                                      <li>Que  no admitiré que terceros efectúen depósitos en mis cuentas con fondos  provenientes de las actividades ilícitas contempladas en el código Penal  Colombiano o en cualquier otra norma que lo adicione; ni efectuaré  transacciones destinadas a tales actividades o a favor de personas relacionadas  con las mismas. </li>
                                      <li>Que  todas las actividades e ingresos que se perciben provienen de actividades  licitas. </li>
                                      <li>Que  no me (nos)  encontramos en ninguna lista  de reporte internacional o bloqueado por actividades de narcotráfico, lavado de  activos, o delitos asociados al turismo sexual en menores de edad. </li>
                                      <li>Que  en mi (nuestra) contra no se adelanta ningún proceso en instancias nacionales o  internacionales por ninguno de los aspectos anteriores. </li>
                                      <li>Autorizo  a resolver cualquier acuerdo, beneficio, subsidio, negocio o contrato celebrado  la empresa Eventour Sport SAS en caso de  infracción de cualquiera de los numerales contenidos en este documento  eximiendo a la entidad de toda responsabilidad que se derive por información  errónea, falsa o inexacta que yo hubiere proporcionado en este documento, o de  la violación del mismo. </li>
                                      <li>Me  comprometo a informar oportunamente, cualquier cambio de la composición  accionaria en caso de ser una sociedad comercial.</li>
                                    </ol>
                         
                                   
                                     <h2>FIRMA</h2>
                                     <p>
                                       <input type="hidden" id="firma" name="firma">
                                          <input name="ac" type="hidden" id="ac"  value="<?php echo $_REQUEST['ac'] ?>"  />
<?php                                         if($_POST['siacompanante'] == 'si' ){
	   
	echo '<input type="hidden" id="acompanante_de" name="acompanante_de" value="'.$_POST['no_docuento'].'">';
   		
   }if (isset($_REQUEST['ac'])){
   echo '<input type="hidden" id="acompanante_de" name="acompanante_de" value="'.$_REQUEST['ac'].'">';
   }
   ?>
                                       *<strong>Realice la firma o escriba sus iniciales con el mouse dentro del siguiente recuadro</strong> para la aceptación del programa, para que el contrato tenga validez debe ser firmado por el acudiente responsable:</p>
                                     <p>
                                       <input type="checkbox" name="checkbox" id="checkbox" checked>
                                       
                                    He leido y Acepto los <a href="programas/grupo.php?plan=<?php echo $_REQUEST['plan'];?>" target="_blank">Términos y Condiciones del programa</a>.<br>
                                     El hecho de inscribirme y pagar la primera cuota es la condicion tácita e implicita de que acepto todos los terminos y condiciones del programa</p>
                                   </div>
                           
                                   <div id="signature" style="width: 80%;
    background: #f7f7f7;
    margin: 0 auto;
    border: 1px solid;
    max-width: 600px;"></div>        <div id="tools" style="text-align:center;"></div>
                                   <div id="resultado"></div>
                                   <input type="hidden" id="paso" name="paso" value="3">
									 <input type="hidden" id="no_documento" name="no_documento" value="<?php echo $_REQUEST['no_docuento'];?>">
									 <input type="hidden" id="apellidos" name="apellidos" value="<?php echo $_REQUEST['apellidos'];?>">
                                   <input name="email" type="hidden" id="email" value="<?php echo $_REQUEST['email']?>">
<input name="document" type="hidden" id="document" value="<?php echo $_REQUEST['no_docuento']?>">
<input name="plan" type="hidden" id="plan" value="<?php echo $_REQUEST['plan']?>">
<input name="facdocumento" type="hidden" id="facdocumento" value="<?php echo $_REQUEST['facdocumento']?>">
									 
									
<button type="submit" class="btn" disabled  id="envio" name="envio"> Continuar</button>
                                   <!-- you load jquery somewhere before jSignature ... -->
                                   <script src="jsignature/jSignature.min.js"></script>
                                   <script>
    $(document).ready(function() {
        var $sigdiv =$("#signature").jSignature()
		$tools = $('#tools')
		
		$('<input type="button" value="Borrar Firma">').bind('click', function(e){
		$sigdiv.jSignature('reset')
		$('#envio').prop('disabled',true);
	}).appendTo($tools)
	
	$("#signature").bind('change', function(e){ /* 'e.target' will refer to div with "#signature" */
	
	var datapair = $sigdiv.jSignature("getData", "svgbase64") ;
var i = new Image();
i.src = "data:" + datapair[0] + "," + datapair[1];
$("#firma").val(i.src);
$('#envio').prop('disabled',false); // append the image (SVG) to DOM.
 })
    })
                                   </script>
                                
                                 </div>
                                 </form>
                                 <p>&nbsp;</p>
                                 
                                <?php } if($paso == 3){ ?>
                                
                              </p>
						
						<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <h1 style="color:#F00">¡IMPORTANTE!</h1>
  <p style="font-size:120%;">
    Usted ha quedado registrado con su información básica, si requiere modificar alguno de los datos, revisar su estado de cuenta y liquidación de pagos puede hacerlo a través de este link: <a href="https://eventoursport.travel/crm" target="_blank">https://eventoursport.travel/crm</a> con la siguiente información de acceso:<p>
<strong>Usuario:</strong><?php $ap=$_REQUEST['apellidos']; $ape=split(" ",trim($ap)); echo $ape[0];  ?><br>(PRIMER APELLIDO)<br>
<strong>Contraseña:</strong><?php $ap1=$_REQUEST['no_documento']; $apedoc=str_replace(".","",trim($ap1)); echo $apedoc;  ?><br> (NRO DE DOCUMENTO DEL VIAJERO)<br>
  </p>
  <br>
  
  <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>
						
                         <!--     <h2><strong>DESCARGA DEL DOCUMENTO DE ACEPTACIÓN</strong></h2>-->
						<div style="width:80%;margin:0 auto;">  <h2> SU CONTRATO FIRMADO</h2>
                                 <p>
                                   <iframe width="100%" height="350px" style="margin:0 auto;width:100%" src="https://eventoursport.travel/crm/impresion/pdf/contrato_pdf.php?firma=<?php echo $_REQUEST['document']?>&carta_aceptacion=<?php echo $carta_aceptacion;?>&descarga=fi"></iframe>
                                 </p>
                                 </div>
						
                              <p> Descargue copia del documento firmado aquí  <a href="https://eventoursport.travel/crm/impresion/pdf/contrato_pdf.php?firma=<?php echo $_REQUEST['document']?>&carta_aceptacion=<?php echo $carta_aceptacion;?>" target="_blank">DESCARGAR</a>. <br>
                              Conserve la copia del PDF en su equipo. </p>
                              </p>
                              <form action="registro.php" method="post" enctype="multipart/form-data" class="form-horizontal row-fluid" id="registro3">
                                <input name="paso" type="hidden" id="paso" value="4">
                      <input type="hidden" id="acompanante_de" name="acompanante_de" value="<?php echo $_POST['acompanante_de']?>">
                        <input name="ac" type="hidden" id="ac"  value="<?php echo $_REQUEST['ac'] ?>"  />
                        <input name="apellido_login" type="hidden" id="apellido_login"  value="<?php echo $ape[0]; ?>"  />
                        <input name="doc_login" type="hidden" id="doc_login"  value="<?php echo $apedoc; ?>"  />
                                <input name="document" type="hidden" id="document" value="<?php echo $_POST['document']?>">
                                </span><span class="controls">
                                <input name="email" type="hidden" id="email" value="<?php echo $_POST['email']?>">
                                <span class="control-group">
                                <input name="plan3" type="hidden" id="plan3" value="<?php echo $_REQUEST['plan']?>"> 
                                <input name="facdocumento" type="hidden" id="facdocumento" value="<?php echo $_REQUEST['facdocumento']?>">
                                </span><span class="controls">
                                <input name="plan" type="hidden" id="plan"  placeholder="" value="<?php echo $_REQUEST['plan'] ?>"  />
                                </span><br>
  <br>
  <!-- <div class="controls">
                      <label for="cedula"></label>
                                    <input type="file" name="cedula" id="cedula">
                                   
                                  </div>
                                  <span class="controls">
                              
                                  </span></div> --><!-- <div class="control-group">
                                  <label class="control-label" for="facdireccion">Permiso de salida del país*</label>
                                  <div class="controls">
                                    <label for="cedula"></label>
                                    <input type="file" name="permiso" id="cedula">
                                  </div>
                                </div>-->
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn" id="enviar2" name="enviar">Continuar</button>
      &nbsp;   &nbsp;</div>
</div>
                              </form>
                              <p>
                                <?php } if($paso == 4){
                                    // Cuando se salta el paso de firma, calcular credenciales desde los campos del formulario
                                    if(empty($_REQUEST['apellido_login'])){
                                        $ap = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
                                        $ape = explode(" ", trim($ap));
                                        $_REQUEST['apellido_login'] = $ape[0];
                                    }
                                    if(empty($_REQUEST['doc_login'])){
                                        $ap1 = isset($_POST['no_docuento']) ? $_POST['no_docuento'] : (isset($_POST['document']) ? $_POST['document'] : '');
                                        $_REQUEST['doc_login'] = str_replace(".", "", trim($ap1));
                                    }
                                ?>
                              </p>
                              <h2> DOCUMENTACIÓN</h2>
                              <p><span style="color: red">El Documento del viajero y del pagador de programa son OBLIGATORIOS para poder continuar.</span></p>
                              <p>Formatos admitidos (doc, pdf, jpg, png,zip).</p>
                            <!--  <p>DOCUMENTACIÓN REQUERIDA:<br>
                              <u><strong>Para mayores de 18 años:</strong></u></p>
                              <ul>
                                <li>Cédula de ciudadanía</li>
                                <li>Pasaporte Vígente</li>
                              </ul>
                              <p><u><strong>Para menores de edad:</strong></u></p>
                              <ul>
                                <li>Tarjeta de identidad</li>
                                <li>Pasaporte Vígente</li>
                                <li>Permiso de salida del país debidamente autenticado en notaría, con vigencia no mayor a 60 días, firmado por sus dos padres. <a href="https://eventoursport.travel/crm/programas/documentos/autorizacion_salida.pdf" target="_blank">Clic aquí para descargar formato</a></li>
                                <li>Copia  del registro civil de nacimiento del menor</li>
                              </ul>
-->
                            <form action="registro.php" method="post" enctype="multipart/form-data" class="form-horizontal row-fluid" id="registro2">
                              <input name="paso" type="hidden" id="paso" value="5">    <input name="document" type="hidden" id="document" value="<?php if(isset($_POST['document'])){echo $_POST['document'];} else{
								  echo $_REQUEST['no_docuento'];
								   }?>">
                               
                   <?php                                         if(isset( $_REQUEST['acompanante_de'])){
	   
	echo '<input type="hidden" id="acompanante_de" name="acompanante_de" value="'.$_POST['acompanante_de'].'">';
   		
   }if (isset($_REQUEST['ac'])&& $_REQUEST['ac']!=""){
   echo '<input type="hidden" id="acompanante_de" name="acompanante_de" value="'.$_REQUEST['ac'].'">';
   }
   ?>
                   <span class="controls">
                                  <input name="email" type="hidden" id="email" value="<?php echo $_POST['email']?>">
					   <input name="apellido_login" type="hidden" id="apellido_login"  value="<?php echo $_REQUEST['apellido_login']; ?>"  />
                        <input name="doc_login" type="hidden" id="doc_login"  value="<?php echo $_REQUEST['doc_login']; ?>"  />
                                <div class="control-group">
                                <br>
                                  <br>
                                 <!-- <div class="controls">
                      <label for="cedula"></label>
                                    <input type="file" name="cedula" id="cedula">
                                   
                                  </div>
                                  <span class="controls">
                              
                                  </span></div> -->    
                                <div class="control-group">
                                    <label class="control-label" for="facdireccion8" style="width: 60%;
    padding: 10px;"> Documento de Identidad <strong><u>Actual</u></strong> del Viajero (Tarjeta de Identidad/Cédula/Otro/Pasaporte)<br>
										<span style="color: red">OBLIGATORIO</span>
                                      <br>
                                  </label>
                                    <div class="controls">
                                      <label for="cedula7"></label>
                                      <input type="file" name="cedula" id="cedula">
                                    </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="facdireccion"  style="width: 60%;
    padding: 10px;"><strong>Cedula TERCERO</strong><br>
                                  Adjunte el rut de quien firma el contrato, a nombre de quien saldrá la factura, si es una persona juridica debe adjuntar la cedula del representante legal <br><span style="color: red">OBLIGATORIO</span></label>
                                  <div class="controls">
                                    <label for="cedula"></label>
                                    <input type="file" name="pasaporte" id="pasaporte">
                                  </div>
                                  
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="facdireccion8" style="width: 60%;
    padding: 10px;">Cámara de Comercio del TERCERO *Para efectios de facturación<br>
										<span style="color: red">SOLAMENTE SI ES PERSONA JÚRIDICA</span>
                                      <br>
                                  </label>
                                    <div class="controls">
                                      <label for="cedula7"></label>
                                      <input type="file" name="cc" id="cc">
                                    </div>
                                </div>
                                 <div class="control-group">
                                  <label class="control-label" for="facdireccion"  style="width: 60%;
    padding: 10px;"><strong>Permiso de Salida</strong><br>
                                   Si el viajero sale del país como menor de edad favor diligenciar el documento adjunto en nuestro programa completo en la pestaña de documentación. Recuerde que debe ser autenticado en notaria con firma de padre y madre. Este documento debe ser cargado por este medio solo 30 días antes del viaje, solo en ese momento adjúntelo<br>
								   Tambien debe adjuntar copia original del registro civil no mayor a 60 días de la salida del grupo.</label>
                                  <div class="controls"> <a href="https://eventoursport.travel/crm/impresion/pdf/permiso_pdf.php?firma=<?php echo $_POST['document'];?>" target="_blank">FORMATO PERMISO DE SALIDA DEL PAIS </a></div>
                                  
                                </div>
                         
                                   
                              <?php //var_dump($_POST['facdocumento']); 
								if($_POST['visa'] == "si"){ ?>  <div class="control-group">
                                  <label class="control-label" for="facdireccion7"  style="width: 60%;
    padding: 10px;"><strong>Visa Americana</strong><br>
                                    Página donde aparece la visa Americana</label>
                                  <div class="controls">
                                    <label for="cedula6"></label>
                                    <input type="file" name="visa" id="visa">
                                    <br>
                                    No es obligatorio para el registro, pero si es indispensable para viajar, podra subirla posteriormente por este medio
                                  </div>
                                </div><?php } ?>
                                <?php //var_dump($_POST['facdocumento']); 
								if($_POST['facdocumento'] == "NIT"){ ?>
                                <div class="control-group">
                                  <label class="control-label" for="facdireccion3"  style="width: 60%;
    padding: 10px;"><strong>RUT</strong><br>
                                  Rut de la empresa a nombre de quien se va a facturar<br><span style="color: red">OBLIGATORIO</span></label>
                                  <div class="controls">
                                    <label for="cedula2"></label>
                                    <input type="file" name="rut" id="rut">
                                  </div>
                                </div><?php }?>
                               <!-- <div class="control-group">
                                  <label class="control-label" for="facdireccion">Permiso de salida del país*</label>
                                  <div class="controls">
                                    <label for="cedula"></label>
                                    <input type="file" name="permiso" id="cedula">
                                  </div>
                                </div>-->
                                <p><span class="controls">
                                  <input name="plan" type="hidden" id="plan"  placeholder="" value="<?php echo $_REQUEST['plan'] ?>"  />
                                </span></p>
                                
                                
                                <div class="control-group">
                                  <div class="controls">
                                  <p>Recuerde que la copia del pasaporte vigente, es requisito indispensable para viajes internacionales y debe ser enviado al correo juevenil@eventours.travel, seis meses antes del viaje</p>
                                    <button type="submit" class="btn" id="enviar" name="enviar">Registrar</button>
                           &nbsp;   &nbsp;      
                                <!--    <button type="submit" class="btn" id="enviar" name="enviar" style="background-color:#aab5fd !important">No tengo los documentos todavia</button>
                                    *Puede resgistrarlos posteriormente-->
                                  </div>
                                </div>
                              </form>
                              <p>&nbsp;</p>
                              <p>
                                <?php } if($paso == 5 ){
									//MODIFICACIONE ASOMEGOLF
	
	
									if($unidadnegocio == 'GRUPOS JUVENILES' && $_POST['plan']!=334 && $_POST['plan']!=335){
									
		// 							$ch = curl_init(); 

        // // set url 
        // curl_setopt($ch, CURLOPT_URL, "http://www.emedia.co/mail/Send_Mail_Registro.php?destinatario=".$_POST['email']."&key=1as12321sdsadaa2&usuario=".$_POST['email']."&contrasena=".$_POST['document']."&plan=".$_POST['plan']."&nombre_plan=".str_replace(" ","_",$datos_producto['grupo'])); 

        // //return the transfer as a string 
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // // $output contains the output string 
        // $output = curl_exec($ch); 

        // // close curl resource to free up system resources 
        // curl_close($ch); 
		
		//var_dump($_SESSION['acompanante_de']);
//		$destino,
//		$usuario,
//$producto,
//$plan,
//$nombre_plan

	$datos_producto['login']=$_POST['apellido_login'];
	$datos_producto['contra']=$_POST['doc_login'];
	
										
			sendEmail($_POST['email'],$_POST['email'],$_POST['plan'],str_replace(" ","_",$datos_producto['grupo']),$_POST['document'],$datos_producto);
										
									}
		
		?>
              
                                
                              Sus datos han sido registrados exitosamente, si requiere modificar alguno de los datos, revisar su estado de cuenta y liquidación de pagos puede hacerlo a través de este link: <a href="https://eventoursport.travel/crm" target="_blank">https://eventoursport.travel/crm</a> con la siguiente información de acceso:</p>
                              <p><strong>Su Usuario : <?php echo $_POST['apellido_login']?><br>
                              Su Contraseña : <?php echo $_POST['doc_login']?></strong></p>
                             <?php if(isset($_POST['acompanante_de'])){ ?> 
                             <br>
                             <p><a href="registro.php?ac=<?php echo $_POST['acompanante_de']; ?>&plan=<?php echo $_REQUEST['plan']?>" style="background:#006;color:#FFF;padding:6px;">Haga clic aqui para registrar su Acompañante</a><strong><?php } ?>
                                <?php } ?>
                              </strong></p>
           				    </div>
       				      </div>
         				  </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
               <?php include 'layout/footer.php'?>
            </div>
        </div>
   <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
   <script type="text/javascript" src="https://cdn.trustedsite.com/js/1.js" async></script>
      
    </body>
