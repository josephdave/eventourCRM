<?php  include 'layout/header.php';

?>
<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){
z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='https://v2.zopim.com/?5BDN2o1z1ic34zAekLKGOrc5xgcnkXY0';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zendesk Chat Script-->
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
			
   $mensaje=$control->registrarViajero($_POST['nombres'],$_POST['apellidos'],$_POST['documento'],$_POST['no_docuento'],$fnacimiento,$_POST['email'],$_POST['telefono'],$_POST['celular'],$_POST['ciudad'],$_POST['direccion'],$_POST['pasaporte'],$fpasaporte,$_POST['no_visa'],$fvisa,$_POST['p1nombre'],$_POST['p1apellido'],$_POST['p1telefono'],$_POST['p1email'],$_POST['p2nombre'],$_POST['p2apellido'],$_POST['p2telefono'],$_POST['p2email'],$_POST['facnombre'],$_POST['facdocumento'],$_POST['facnumero'],$_POST['facciudad'],$_POST['facdireccion'],$_POST['facemail'],$_POST['plan'],$_POST['otro'],$_POST['estado_viajero'],$_POST['observaciones'],$_POST['acudiente1_tipodoc'],$_POST['acudiente1_documento']);
   
     
  
   
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
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div>
                              <p>
                                <?php } ?>
                                
                                <?php if(!isset($paso)){?>
                              </p>
                              <h2> REGISTRO DEL VIAJERO</h2>
                              <p>&nbsp;</p>
                              
                          <p align="justify" style="font-size:80%">Siguiendo los lineamientos de nuestra política interna y nuestra filosofía sobre el manejo y tratamiento de información personal, queremos ratificar que sus datos personales son tratados de forma privada y confidencial y que, por lo tanto, garantizamos la seguridad y confidencialidad de su información a través de un almacenamiento seguro que impide el acceso a terceras personas ajenas a nuestra organización empresarial.  Su información será manejada de acuerdo con lo establecido por la Ley Estatutaria 1581 de 2012 (Ley de protección de datos personales).</p>
                          <p align="justify" style="font-size:80%">&nbsp;</p>
                     
                              <form action="registro.php#modal" method="post" class="form-horizontal row-fluid" id="registro">
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
           				              <option value="TI" >Tarjeta de Identidad</option>
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
                                  <?php if($datos_producto['nombre_tarifa2'] != "" &&  strpos($producto['nombre_tarifa2'],'interno')=== false){?>
                                <div class="control-group">
           				          <label class="control-label" for="basicinput3">Tipo de Viajero</label>
                                  
                                
           				          <div class="controls">
           				          
                                   <?php  if($datos_producto['nombre_tarifa2'] != "" && strpos($datos_producto['nombre_tarifa2'],'interno')=== false){?>
                                    <select name="otro" class="span8" id="otro" tabindex="1" data-placeholder="Select here..">
           				              <option value="<?php echo $datos_producto['nombre_tarifa1'];?>" selected="selected"><?php echo $datos_producto['nombre_tarifa1'];?></option>
                                      <option value="<?php echo $datos_producto['nombre_tarifa2'];?>"><?php echo $datos_producto['nombre_tarifa2'];?></option>
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
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput7">Telefono Fijo:</label>
         				          
<div class="controls">
           				            <input name="telefono" type="text" class="span8" id="telefono" placeholder="">
       				              </div>
       				            </div>
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
           				        <!--
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
           				          <label class="control-label" for="basicinput10">Fecha Vigencia</label>
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
<br>
           				          </div>
       				            </div>-->
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
           				          <div class="controls">Por favor indique los datos  de la persona o empresa a quien se deban emitir  recibos de caja y facturas:</div>
           				          <br>
           				        </div>
                                <div class="control-group">
           				          <label class="control-label" for="facdireccion">Nombre/Razón Social <br>
       				              (De quien Firmará el contrato)*</label>
           				          <div class="controls">
           				            <input name="facnombre"  id="facnombre" type="text" class="span8" placeholder="" minlength="2" required style="text-transform:uppercase" >
       				              </div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="basicinput3">Documento de Identificación para Factura</label>
        				          
<div class="controls">
<script>
function nit(){
	var documento = document.getElementById('facdocumento');
	if(documento.value == "NIT"){
	document.getElementById('nit').setAttribute("style", "display: block;");
	}else{
	
	document.getElementById('nit').setAttribute("style", "display: none;");
	}
}
</script>
           				            <p>
           				              <select name="facdocumento" class="span8" id="facdocumento" tabindex="1" data-placeholder="Select here.." onChange="nit()">
           				                <option value="Cedula">Cedula</option>
           				                <option value="NIT">NIT</option>
           				                <option value="Pasaporte">Pasaporte</option>
       				                  </select>
		              </p>
           				           <span id="nit" style="display:none"> <p><strong>*IMPORTANTE:</strong> Si selecciona la opción NIT por favor enviar una copia escaneada del RUT de la empresa </br>al correo: info@eventoursport.com para completar el registro</p></span>
</div>
       				            </div>
           				        <div class="control-group">
           				          <label class="control-label" for="facdireccion">Numero Documento*</label>
           				          <div class="controls">
           				            <input name="facnumero" type="number" class="span8" id="facnumero" placeholder="" minlength="2" required>
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
       				              Si viaja con un acompañante debera registrar sus datos a continuación
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
                                
       				          Mediante el registro de sus datos personales en el presente formulario usted autoriza a EventourSport para la recolección, almacenamiento y uso de los mismos con la finalidad de realizar la inscripción y solicitud de todos los servicios contratados, así como para informarle sobre otros eventos organizados por esta Entidad, relacionados con nuestras funciones, sobre los servicios que prestamos, las publicaciones que elaboramos y para solicitarle que evalúe la calidad de nuestros servicios. Como Titular de información tiene derecho a conocer, actualizar y rectificar sus datos personales, solicitar prueba de la autorización otorgada para su tratamiento, ser informado sobre el uso que se ha dado a los mismos, presentar quejas ante la SIC por infracción a la ley, revocar la autorización y/o solicitar la supresión de sus datos en los casos en que sea procedente y acceder en forma gratuita a los mismos. 
                              </form>
                              <p>
                              <?php } if ($paso==2){?>
                               <form action="registro.php" method="post" class="form-horizontal row-fluid" id="registro">
                               
                                 <div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <h1 style="color:#F00">¡IMPORTANTE!</h1>
  <p style="font-size:120%;">
    Usted ha quedado registrado con su información básica, si requiere modificar alguno de los datos ingresados puede hacerlo a través de este link: <a href="https://eventoursport.travel/crm" target="_blank">https://eventoursport.travel/crm</a> con la siguiente información de acceso:<p>
<strong>Usuario:</strong><?php echo $_REQUEST['email'];?><br>
<strong>Contraseña:</strong> <?php echo $_REQUEST['no_docuento'];?><br>
  </p>
  <br>
  
  <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>

    
                                 <div class="control-group">
                               
                                 <div style="width:80%;margin:0 auto;">  <h2> VERIFICACI&Oacute;N Y FIRMA DE ACEPTACIÓN</h2>
                                 <p>
                                   <iframe width="100%" height="350px" style="margin:0 auto;width:100%" src="<?php echo $url_contrato;?>?accion=print&firma=<?php echo $_REQUEST['no_docuento']?>&txt=1&plan=<?php echo $_REQUEST['plan'];?>"></iframe>
                                 </p>
                                 </div>
                                   <div style="width:80%;margin:0 auto;">
                         
                                   
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
                                <?php } if($paso == 4){ ?>
                              </p>
                              <h2> DOCUMENTACIÓN</h2>
                              <p>Adjunte únicamente, si tiene los documentos con los que va a viajar. 
                                De lo contrario omita este paso y adjuntelos posteriormente.</p>
                              <p>Formatos admitidos (doc, pdf, jpg, png,zip).</p>
                              <p>DOCUMENTACIÓN REQUERIDA:<br>
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
                              <p>                                <br>
                              </p>
                              <form action="registro.php" method="post" enctype="multipart/form-data" class="form-horizontal row-fluid" id="registro2">
                               <input name="paso" type="hidden" id="paso" value="5">    <input name="document" type="hidden" id="document" value="<?php if(isset($_POST['document'])){echo $_POST['document'];} else{
								  echo $_REQUEST['no_docuento'];
								   }?>">
                               
                   <?php                                         if($_POST['siacompanante'] == 'si' ){
	   
	echo '<input type="hidden" id="acompanante_de" name="acompanante_de" value="'.$_POST['no_docuento'].'">';
   		
   }if (isset($_REQUEST['ac'])&& $_REQUEST['ac']!=""){
   echo '<input type="hidden" id="acompanante_de" name="acompanante_de" value="'.$_REQUEST['ac'].'">';
   }
   ?>
                                  </span><span class="controls">
                                  <input name="email" type="hidden" id="email" value="<?php echo $_POST['email']?>">
                                <div class="control-group">
                                  <label class="control-label" for="facdireccion">Documentos del Viajero</label>
                                  <span class="control-group">
                                  <input name="plan" type="hidden" id="plan" value="<?php echo $_REQUEST['plan']?>">
                                     <input name="ac" type="hidden" id="ac"  value="<?php echo $_REQUEST['ac'] ?>"  />
                                     <input type="hidden" id="acompanante_de" name="acompanante_de" value="<?php echo $_POST['acompanante_de']?>">
                                  </span>: <br>
                                  <br>
                                 <!-- <div class="controls">
                      <label for="cedula"></label>
                                    <input type="file" name="cedula" id="cedula">
                                   
                                  </div>
                                  <span class="controls">
                              
                                  </span></div> -->    
                                <div class="control-group">
                                    <label class="control-label" for="facdireccion8" style="width: 60%;
    padding: 10px;"> Documento de Identidad <strong><u>Actual</u></strong> del Viajero (Tarjeta de Identidad/Cédula/Otro)<br>
                                  </label>
                                    <div class="controls">
                                      <label for="cedula7"></label>
                                      <input type="file" name="cedula" id="cedula">
                                    </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="facdireccion"  style="width: 60%;
    padding: 10px;"><strong>Pasaporte</strong><br>
                                  Adjunte la copia en este momento, únicamente si cuenta con el pasaporte con el que va a viajar. Si el viajero necesita hacer cambio de pasaporte, espere a renovarlo y cárguerlo por este medio en ese momento</label>
                                  <div class="controls">
                                    <label for="cedula"></label>
                                    <input type="file" name="pasaporte" id="pasaporte">
                                  </div>
                                  
                                </div>
                                
                                 <div class="control-group">
                                  <label class="control-label" for="facdireccion"  style="width: 60%;
    padding: 10px;"><strong>Permiso de Salida</strong><br>
                                   Si el viajero sale del país como menor de edad favor diligenciar el documento adjunto en nuestro programa completo en la pestaña de documentación. Recuerde que debe ser autenticado en notaria con firma de padre y madre. Este documento debe ser cargado por este medio solo 30 días antes del viaje, solo en ese momento adjúntelo</label>
                                  <div class="controls"> <a href="https://eventoursport.travel/crm/impresion/pdf/permiso_pdf.php?firma=<?php echo $_POST['document'];?>" target="_blank">FORMATO PERMISO DE SALIDA DEL PAIS </a></div>
                                  
                                </div>
                         
                                   <div class="control-group">
                                     <label class="control-label" for="facdireccion4"  style="width: 60%;
    padding: 10px;"><strong>Registro Civil</strong><br>
                                       Copia original del registro civil no mayor a 60 días de la salida del grupo.</label>
                                     <div class="controls">
                                       <label for="cedula3"></label>
                                     </div>
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
                                  Rut de la empresa a nombre de quien se va a facturar</label>
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
                                  
                                    <button type="submit" class="btn" id="enviar" name="enviar">Registrar</button>
                           &nbsp;   &nbsp;      
                                    <button type="submit" class="btn" id="enviar" name="enviar" style="background-color:#aab5fd !important">No tengo los documentos todavia</button>
                                    *Puede resgistrarlos posteriormente
                                  </div>
                                </div>
                              </form>
                              <p>&nbsp;</p>
                              <p>
                                <?php } if($paso == 5 ){
									
									if($unidadnegocio == 'GRUPOS JUVENILES'){
									
									$ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://www.emedia.co/mail/Send_Mail_Registro.php?destinatario=".$_POST['email']."&key=1as12321sdsadaa2&usuario=".$_POST['email']."&contrasena=".$_POST['document']."&plan=".$_POST['plan']."&nombre_plan=".str_replace(" ","_",$datos_producto['grupo'])); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 

        // close curl resource to free up system resources 
        curl_close($ch); 
		
		//var_dump($_SESSION['acompanante_de']);
									}
		
		?>
                                
                                
                              Sus datos han sido registrados exitosamente, si desea actualizar, sus documentos o verificar su información registrada ingrese con el email del viajero y numero de documento en siguiente link: <a href="https://eventoursport.travel/crm/"><strong>https://eventoursport.travel/crm/</strong></a></p>
                              <p><strong>Su Usuario : <?php echo $_POST['email']?><br>
                              Su Contraseña : <?php echo $_POST['document']?></strong></p>
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
