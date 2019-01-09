<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

function convert($from, $to, $retry = 0)
{
    $ch = curl_init("http://download.finance.yahoo.com/d/quotes.csv?s=$from$to=X&f=l1&e=.csv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    $rate = curl_exec($ch);
    curl_close($ch);
    if ($rate) {
        return (float)$rate;
    } elseif ($retry > 0) {
        return convert($from, $to, --$retry);
    }
    return false;
}



if(isset($_REQUEST['idviajero'])){
	$mensaje=$control->registrarPago($_REQUEST['idviajero'],$_REQUEST['date'],$_REQUEST['tik'],$_REQUEST['pt'],$_REQUEST['trm'],$_REQUEST['fee'],$_REQUEST['medio'],$_REQUEST['producto'],$_REQUEST['observaciones'],$_REQUEST['moneda'],$_REQUEST['numero'],$_REQUEST['comprobante'],$_REQUEST['aut'],$_REQUEST['usuario']);
	
	if($_REQUEST['pt'] > 0 || $_REQUEST['tik'] > 0){	
	$control->registrarEstadoID($_REQUEST['idviajero'],"VIAJA");
	}

//var_dump($mensaje);
}
	
?>

    
   

       <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGO</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $documento_viajero = $_REQUEST['doc'];
	$viajero=$control->datosViajero($documento_viajero);
	//var_dump($viajero);?>
    
      
       				        <form action="registrar_pago_general.php" method="post" name="form1" id="form1">
       				        <h2>REGISTRAR PAGO </h2>
           				    <script>
							function actualizarTIK(){
					tikCOP= document.getElementById('tik2').value;
				trm=document.getElementById('trm').value
				document.getElementById('tik').value=  Math.round(tikCOP / trm);
							}
							</script>
           				    <script>
							function actualizarPT(){
							ptCOP= document.getElementById('pt2').value;
							trm=document.getElementById('trm').value
							document.getElementById('pt').value= Math.round(ptCOP / trm)
							}
							</script>
           				    <script>
							function actualizarFEE(){
							feeCOP= document.getElementById('fee2').value;
							trm=document.getElementById('trm').value
							document.getElementById('fee').value= Math.round(feeCOP / trm)
							}
							</script>
                            <script>
                            function Comma(Num) { //function to add commas to textboxes
        Num += '';
        Num = Num.replace(',', ''); Num = Num.replace(',', ''); Num = Num.replace(',', '');
        Num = Num.replace(',', ''); Num = Num.replace(',', ''); Num = Num.replace(',', '');
        x = Num.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        return x1 + x2;
    }
                            </script>
     <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
           				    <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">VIAJERO:</td>
           				        <td>
                                <?php if(isset($_REQUEST['id'])){
									
								$viajero=$control->datosViajeroID($_REQUEST['id']);
								echo $viajero['nombres']." ".$viajero['apellidos'];
									?>
                                <input type="hidden" id="idviajero" name="idviajero" value="<?php echo $viajero['id'];?>">
                                
                                <?php } else { ?>
									
                                <select name="idviajero" id="idviajero" data-placeholder="Seleccione Viajero" class="chosen-select" onChange="saldo()">
                                <option value="0" selected>SELECCIONE VIAJERO</option>
                                 <?php 
							
							$resultado=$control->inscritos(0);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                                  <option value="<?php echo $fi['id'] ?>"><?php echo strtoupper($fi['nombres'])." ".strtoupper($fi['apellidos'])." ".$fi['no_documento']." - ".$fi['producto'];?></option><?php } ?>
                                </select><?php } ?>
                                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id'];?>">
                                <br><span id="saldo"></span></td>
           				        <td>Consignación en PESOS:<br>
           				          <p>
           				            <label>FEE:
           				              <input type="radio" name="Fee" value="si" id="FeeAC1" checked>
           				              si</label>
           				            
           				            <label>
           				              <input type="radio" name="Fee" value="no" id="FeeAC2">
           				              no</label>
           				            <br>
   				                </p></td>
           				        <td>
                                <script>
								
								function precisionRound(number, precision) {
  var factor = Math.pow(10, precision);
  return Math.round(number * factor) / factor;
}

								function calc(hacia){
								document.getElementById("tik").value= 0;
				
					document.getElementById("pt").value= 0;
								
								document.getElementById("fee").value=0;	
									
									
								trm=document.getElementById("trm").value;
								
								if(trm == 0){
								window.alert("La TRM debe ser un valor válido");
								}
								
								consignacion=document.getElementById("consignacion").value;
								
								dolares=precisionRound(consignacion/trm, 0);
								
								if (document.getElementById('FeeAC1').checked && hacia == "pt") {
								
								abono = precisionRound(dolares/1.02,0);
								
								fee= precisionRound(dolares-abono,0);
								document.getElementById(hacia).value= abono;
								
								document.getElementById("fee").value=fee;
								}else{
								
									dolares=precisionRound(consignacion/trm, 0);
									document.getElementById(hacia).value= dolares;
									
								
								}
								
								}
								</script>
                                <input type="number" name="consignacion" id="consignacion" placeholder="valor" >
       				            <br>
       				            <input type="button" name="button" id="button" value="Calcular A TK" onClick="calc('tik')">
       				            <input type="button" name="button2" id="button2" value="Calcular A PT" onClick="calc('pt')"></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Fecha Pago:           				          </td>
           				        <td><script>
function valortrm() {
	str=document.getElementById("date").value;
    if (str == "") {
        document.getElementById("trm").value = "0";
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
                document.getElementById("trm").value = this.responseText;
            }
        };
        xmlhttp.open("GET","api.php?dolar="+str,true);
        xmlhttp.send();
    }
}
</script>


<script>
function saldo() {
	str=document.getElementById("idviajero").value;
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("saldo").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","api.php?saldo="+str,true);
        xmlhttp.send();
    }

</script>
                                <input type="date" name="date" id="date" value="<?php echo date("Y-m-j");?>" onChange="valortrm()"></td>
           				        <td>Moneda:</td>
           				        <td>
                                  <select name="moneda" id="moneda"  >
                                    <option value="Dolar">Dolar</option>
                                    <option value="Pesos">Pesos</option>
                                    <option value="Euro">Euro</option>
                                </select></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Abono TIK</td>
           				        <td><p>
           				          <input type="number" name="tik" id="tik" placeholder="valor" step="any">
         				          </p>
           				          <p>
       				              <!--<input type="number" name="tik2" id="tik2" onKeyUp="actualizarTIK()" onChange="actualizarTIK()" placeholder="valor COP">--></p>
                                  
                                  </td>
           				        <td>Abono PT</td>
           				        <td><p>
           				          <input type="number" name="pt" id="pt" placeholder="valor" step="any">
         				          </p>
           				          <p>
           				            <!--<input type="number" name="pt2" id="pt2" placeholder="valor COP" onKeyUp="actualizarPT()" onChange="actualizarPT()">-->
       				              </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">TRM</td>
           				        <td><input type="text" name="trm" id="trm" value="<?php echo round(convert("USD","COP",0),2);?>"></td>
           				        <td>Fee</td>
           				        <td><p>
           				          <input type="number" name="fee" id="fee" placeholder="valor">
                                  
                                  <script>
								  
								  </script>
         				          </p>
           				          <p>
           				         <!--   <input type="number" name="fee2" id="fee2" placeholder="valor COP" onKeyUp="actualizarFEE()" onChange="actualizarFEE()">--></p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Medio</td>
           				        <td colspan="3"><select name="medio" id="medio">
           				          <option value="EFECTIVO" selected>EFECTIVO</option>
           				          <option value="CHEQUE">CHEQUE</option>
           				          <option value="TC VISA">TC VISA</option>
                                  <option value="TC DINERS">TC DINERS</option>
           				          <option value="TC MASTER CARD">TC MASTER CARD</option>
           				          <option value="TC AMERICAN">TC AMERICAN</option>
           				          <option value="TARJETA DEBITO">TARJETA DEBITO</option>
           				          <option value="BOTON PSE B.BOGOTA">BOTON PSE B.BOGOTA</option>
           				          <option value="BOTON PSE BANCOLOMBIA">BOTON PSE BANCOLOMBIA</option>
           				          <option value="BANCOLOMBIA REFERENCIADO">BANCOLOMBIA REFERENCIADO</option>
           				          <option value="BANCOLOMBIA CTA AHORROS">BANCOLOMBIA CTA AHORROS</option>
                                  <option value="BANCO DE BOGOTA CTA CORRIENTE">BANCO DE BOGOTA CTA CORRIENTE</option>
                                  <option value="CONSIGNACION DOLARES CORPBANCA">CONSIGNACION DOLARES CORPBANCA</option>
                                   <option value="DEVOLUCION">DEVOLUCION</option>
                                     <option value="TC EN AEROLINEA (AVIATUR)">TC EN AEROLINEA (AVIATUR)</option>
									 <option value="TC EN AEROLINEA (SU LOGISTICA)">TC EN AEROLINEA (SU LOGISTICA)</option>
									 <option value="TC EN AEROLINEA (COPA)">TC EN AEROLINEA (COPA)</option>
                                     <option value="BANCO DE BOGOTA DOLARES">BANCO DE BOGOTA DOLARES</option>
                                     
                                </select></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Datos Transacción</td>
           				        <td colspan="3"><p>
           				          <input type="text" name="numero" id="numero" placeholder="numero">
           				          <input type="text" name="comprobante" id="comprobante" placeholder="comprobante">
           				          <input type="text" name="aut" id="aut" placeholder="Autorizacion">
           				        </p>
       				            <p>*Ingrese estos valores solo si son necesarios</p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones" cols="100" rows="5" id="observaciones"></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"></td>
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
                        
                                                
                            <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
    </body>
