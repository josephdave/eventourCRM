<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	if(isset($_REQUEST['borrar'])){
	
		$control->borrarPago($_REQUEST['borrar']);
		
	}
	 if($_SESSION['nivel'] == "10"){
?>
	
 
   <style>
  
   </style>
 <script src="https://cdn.ckeditor.com/4.11.4/basic/ckeditor.js"></script>

<script>
 
 String.prototype.replaceAll = function(search, replace)
{
    //if replace is not sent, return original string otherwise it will
    //replace search string with 'undefined'.
    if (replace === undefined) {
        return this.toString();
    }

    return this.replace(new RegExp('[' + search + ']', 'g'), replace);
};
							$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

//	var toolbar= document.getElementsByClassName("fixed-table-toolbar");
//	toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/US\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
//	

	  var table_html = table_html.replaceAll('.', '');
var table_html = table_html.replaceAll(',', ',');	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGOS POR VALIDAR</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <button id="btnExport">Descargar</button>
                          
           				    <form id="form1" name="form1" method="post" action="pagos_validados.php">
           				     <div id="table_wrapper"> <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;padding:10px;" class="table demo">       				        <thead>
           				          <tr>
           				            <th>Producto</th>
           				            <th><strong>Documento</strong></th>
           				            <th><strong>Nombre</strong></th>
           				            <th>Fecha Pago</th>
           				            <th>Fecha Registro</th>
           				            <th>Medio</th>
           				            <th>Moneda PROGRAMA</th>
           				            <th>Abono PT</th>
           				            <th>Abono TIK</th>
           				            <th>Fee</th>
           				            <th>TRM</th>
           				            <th>VALIDADO</th>
           				            <th>MAIL</th>
           				            <th>OBSERVACIONES</th>
           				            <th>BORRAR</th>
   				                </thead>
           				        <tr>
           				          <?php 
							
							$resultado=$control->pagosRegistradosValidar();
		 					$ne=0;
		 
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								$ne++;
								if(true){
							?>
           				          <td><?php echo $control->nomGrupoSimple($fi['id_producto']);
								  
								  $datosproducto=$control->datosProducto($fi['id_producto']);?></td>
           				          <td><?php 
							  $viajero=$control->datosViajeroID($fi['id_viajero']);
							  
							  echo $viajero['facturacion_documento'];?>
           				            <a href="registrar_pago.php?doc=<?php echo $viajero['id'];?>" target="_blank"><?php echo $viajero['no_documento'];?></a><br>
           				            <a href="dtos.php?doc=<?php echo $viajero['no_documento'];?>" target="_blank">(Ver Tercero)</a></td>
           				          <td><?php echo strtoupper($viajero['apellidos']);?> <?php echo strtoupper($viajero['nombres']);?></td>
           				          <td><?php echo $fi['fecha']?></td>
           				          <td><?php echo $fi['fecha_registro']?></td>
           				          <td><?php echo $fi['medio']?></td>
           				          <td><?php echo $datosproducto['MONEDA']?><?php echo $fi['moneda']?></td>
           				          <td><?php if($fi['moneda'] =='Pesos'){echo '$';} 
									  if($fi['moneda'] =='Dolar'){echo 'US$';}
									  if($fi['moneda'] =='Euro'){echo '€';}?><?php echo number_format($fi['valor_PT'],0,",",".");?></td>
           				          <td><?php if($fi['moneda'] =='Pesos'){echo '$';} 
									  if($fi['moneda'] =='Dolar'){echo 'US$';}
									  if($fi['moneda'] =='Euro'){echo '€';}?>           				            <?php echo number_format($fi['valor_TIK'],0,",",".");?></td>
           				          <td><?php echo number_format($fi['fee'],0,",",".");?></td>
           				          <td><?php echo  number_format($fi['trm'],2,",",".");?></td>
           				          <td><?php 
								  $abono = $fi['valor_PT']+$fi['valor_TIK']+$fi['fee'];
								  $mon="USD";
								  if($fi['moneda']== 'Pesos'){
									  
									  if($datosproducto['MONEDA']=='COP'){
										    $abono = ($abono);
									  }else{
									  $abono = ($abono*$fi['trm']);
								  $mon="COP";
								  $abono=number_format($abono,0,"","");
									  }
								  }
								  



								  $desc = "Abono";
								  $tipo="";
								  if($fi['valor_PT']>0){
									  $desc.=" Porcion Terrestre ";
									  $tipo=" Porción Terrestre ";
								  }
								  
								  								  if(($fi['valor_TIK'])>0){
									  $desc.=" Tarifa Aerea ";
									  $tipo.=" Tarifa Aerea ";
								  }
								  
						  
									  if($datosproducto['MONEDA']=='COP'){
								 $desc.=" COP $".number_format($fi['valor_PT']+$fi['valor_TIK'],0,",",".");
										  
									  }else{
								  $desc.=" USD $".number_format($fi['valor_PT']+$fi['valor_TIK'],0,",",".")."x".$fi['trm']."(TRM)";}
								  
					//			  var_dump($fi['valor_FEE']);
								  
								  if(($fi['fee'])>0){
									  $desc.="+".$fi['fee']." FEE Bancario ";
									  }
								  
								  
								  
								  				  
					/*  if($mon=="COP"){
								 $desc.=$mon." $".number_format($fi['valor_PT']+$fi['valor_TIK'],0,",",".");	  if(($fi['fee'])>0){
									  $desc.="+$".$fi['fee']." FEE Bancario ";
									  }
								 $desc.=" - TRM:".$fi['trm']." ";
								  
							
								  }*/
								  

								    ///CODIGO VALOR TOTAL PAQUETE
									$producto = $datosproducto;
									$nitviajero=$viajero['facturacion_nodocumento'];
									$viajeroNIT=$control->listaViajeros($nitviajero,$producto['id']);
									$totalTK=0;
									$totalPT=0;
									
									$totalAbonoTK=0;
									$totalAbonoPT=0;
									
									while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
										
										//var_dump($di['nombres']);
					  $valortk= $control->valorViajeroTK($di['otro'],$producto); 
					 $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					 
					 $totalTK=$totalTK+($valortk+$valorMtk);
					 
					 
				   $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					$valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					
					$totalPT=$totalPT+($valorpt+$valorMpt);
					}
					
					$resultado2=$control->pagosHistorialViajeroNIT($nitviajero,$producto['id']);
						  while ($pi = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
							  $totalAbonoTK=$totalAbonoTK+$pi['valor_TIK'];
							  $totalAbonoPT=$totalAbonoPT+$pi['valor_PT'];
							  
						  }
			
									
									
									/// END

									if($fi['moneda']=="Pesos" && $datosproducto['MONEDA']!='COP'){
										$pag=($fi['valor_PT']+$fi['valor_TIK']+$fi['fee'])*$fi['trm'];
											
										$pagvalor=($fi['valor_PT']+$fi['valor_TIK']+$fi['fee'])*$fi['trm'];
									   // $pag=round($pag/1000)*1000;
										
										$pag="COP $".number_format($pag,0,",",".");
										
										}	else if($fi['moneda']=="Pesos" && $datosproducto['MONEDA']=='COP'){
										$pag=($fi['valor_PT']+$fi['valor_TIK']+$fi['fee']);
											
										$pagvalor=($fi['valor_PT']+$fi['valor_TIK']+$fi['fee']);
									   // $pag=round($pag/1000)*1000;
										
										$pag="COP $".number_format($pag,0,",",".");
										
										}else{
										
										$pag=($fi['valor_PT']+$fi['valor_TIK']+$fi['fee']);
										
										$pag="USD $".number_format($pag,0,",",".");
	  
										
										}
										
										  if($datosproducto['MONEDA']=='COP'){
									   $mon=" COP $".number_format($fi['valor_PT']+$fi['valor_TIK'],0,",",".");
												
											}else{
										$mon=" USD $".number_format($fi['valor_PT']+$fi['valor_TIK'],0,",",".")."x".$fi['trm']."(TRM)";
										
										
										}
										
						  //			  var_dump($fi['valor_FEE']);
										
										if(($fi['fee'])>0){
											$mon.="+".$fi['fee']." FEE Bancario ";
											}
											
											
								  
								  $desc.=" Producto: ".$control->nomGrupoSimple($fi['id_producto'])." - Viajero(s): ".$control->listaNombres($viajero['facturacion_nodocumento'],$viajero['id_grupo']);


								  $desc2=strtoupper($viajero['nombres'])." ".strtoupper($viajero['apellidos'])." ".
								  $control->nomGrupoSimple($fi['id_producto'])." pago efectuado el "
								  .$fi['fecha']." por ".$pag." Con este pago se abonaron:";

								  $desc3="";

								  if($fi['valor_PT']>0){
									$desc3.="".$datosproducto['MONEDA']." $".$fi['valor_PT']." a Porción Terrestre.";
								  }

								  if($fi['valor_TIK']>0){
									$desc3.="".$datosproducto['MONEDA']." $".$fi['valor_TIK']." a Tickete Aéreo";
								  }

								
		$concepto="";
								
		if($fi['medio'] == "TARJETA DEBITO"){
			$concepto = "TARJETA DEBITO";
		}else if($fi['medio'] == "TC VISA" || $fi['medio'] == "TC MASTER CARD" || $fi['medio'] == "TC AMERICAN" ){
		  $concepto="TC OTRAS";					
		}else if($fi['medio'] == "TC DINERS" ){
		  $concepto="DINERS TC";					
	    }else if($fi['medio'] == "CHEQUE" || $fi['medio'] == "BANCOLOMBIA REFERENCIADO"){
		  $concepto="BANCOLOMBIA CONSIG";					
	    }else if($fi['medio'] == "EFECTIVO" ){
		  $concepto="EFECTIVO";					
		}else if($fi['medio'] == "BOTON PSE B.BOGOTA" || $fi['medio'] == "BANCO DE BOGOTA CTA CORRIENTE"  ){
		  $concepto="BANCO DE BOGOTA PSE";					
		}else if($fi['medio'] == "BOTON PSE BANCOLOMBIA" || $fi['medio'] == "BANCOLOMBIA CTA AHORROS"  ){
		  $concepto="PSE BANCOLOMBIA";					
		}else if($fi['medio'] == "CONSIGNACION DOLARES CORPBANCA" || $fi['medio'] == "CONSIGNACION DOLARES ITAU"  ){
		  $concepto="BANCO ITAU CONSIG";					
		}else if($fi['medio'] == "TC EN AEROLINEA (AVIATUR)" ){
		  $concepto="(AVIATUR)";					
	    }else if($fi['medio'] == "TC EN AEROLINEA (SU LOGISTICA)" ){
		  $concepto="(SU LOGISTICA)";					
	    }else if($fi['medio'] == "TC EN AEROLINEA (COPA)" ){
		  $concepto="(COPA)";					
	    }else if($fi['medio'] == "BANCO DE BOGOTA DOLARES" ){
		  $concepto="CONSIG USD";					
	    }else{
			$concepto="EFECTIVO";
		}
								
								//var_dump($fi['medio']."=".$concepto);
								  
								  
		if($fi['medio'] == "EFECTIVO" || $fi['medio'] == "BOTON PSE B.BOGOTA" || $fi['medio'] == "BOTON PSE BANCOLOMBIA" || $fi['medio'] == "BANCOLOMBIA REFERENCIADO" || $fi['medio'] == "BANCOLOMBIA CTA AHORROS"  || $fi['medio'] == "TC EN AEROLINEA"  ){
								  $med="EFECT";
							}else if($fi['medio'] == "TC VISA"){
		  $med="T. VI";					
							}else if($fi['medio'] == "TC MASTER CARD"){
		  $med="T. MASTER";					
							}else if($fi['medio'] == "TC DINERS"){
		  $med="T. DIN";					
							}else if($fi['medio'] == "TC AMERICAN"){
		  $med="T.";					
							}else if($fi['medio'] == "TARJETA DEBITO"){
		  $med="T. DEBI";					
							}else{
							  $med="EFECT";
							}
							
							$date = new DateTime($fi['fecha']);

								  
								  //$linea=$date->format('dmY').";".$fi['moneda'].";".trim(preg_replace('/\s+/', '', $viajero['facturacion_nodocumento'])).";".$desc.";2017 LICEO FRANCES PEREIRA;".$abono.";".$med.";".$fi['numero'].";".$fi['comprobante'].";".$fi['aut'];
								  
								  //$linea=$date->format('dmY').";".$fi['moneda'].";".trim(preg_replace('/\s+/', '', $viajero['facturacion_nodocumento'])).";".$desc." id:".$fi['id'].";".str_replace("COLEGIO","COL",$control->nomCentroCosto($fi['id_producto'])).";".$abono.";".$med.";".$fi['numero'].";".$fi['comprobante'].";".$fi['aut'].";".$concepto;
								  //											CENTROC COSTO
								  $centrocosto="";
								  $obs="";
								  $linea="1	1	117	2864	116099		319	"."$centrocosto"."							".date('d/m/Y')." 12:00:00 a. m.	".'	'.$desc3.'	'.$abono.'	0	0	0	0	0	0	0	0	0	0	0	0	0	'.$abono."	-1												Lina	".date('d/m/Y')." 12:00:00 a. m.	A	";
								  
								  
									  
									
								  $subject=strtoupper($viajero['nombres'])." ".strtoupper($viajero['apellidos']).", ".
								  $control->nomGrupoSimple($fi['id_producto']) ;

								  $correo="
								  <p style='color:#000'>".strtoupper($viajero['nombres'])." ".strtoupper($viajero['apellidos'])." ".
								  $control->nomGrupoSimple($fi['id_producto'])."<br/>Adjunto remito para su control recibo de caja expedido por su pago efectuado el "
								  .$fi['fecha']." por <span id='valor_correo'><strong>".$pag."</strong></span>. Con este pago se abonaron:</p>";

								  if($fi['valor_PT']>0){
									$correo.="<p style='color:#000'>".$datosproducto['MONEDA']." $".$fi['valor_PT']." a Porción Terrestre.</p>	";
								  }

								  if($fi['valor_TIK']>0){
									$correo.="<p style='color:#000'>".$datosproducto['MONEDA']." $".$fi['valor_TIK']." a Tickete Aéreo.</p>	";
								  }

								  $correo.="<p style='color:#000'>El saldo por pagar después de este abono es así:</br><p><strong>"
.$datosproducto['MONEDA']." ".($totalTK-$totalAbonoTK)."</strong> por tarifa aérea</br></p><p><strong>"
.$datosproducto['MONEDA']." ".($totalPT-$totalAbonoPT)."</strong> por porción terrestre</br></p> 
<p style='color:#000'>Estaremos atentos en caso de que requiera información adicional.</p>
<p style='color:#000'>Cordialmente,</p>
<p>&nbsp;</p>
<p><strong>Eventours</strong></p>
<p>57 602 660 4000 - info@eventours.travel</p>";
								  
								 
								  
								 // echo $linea;
								  ?>
                                    <button type="button" data-clipboard-text="<?php echo $linea?>">Copiar</button>
                                      <button class="button_export" id="<?php echo $fi['id'] ?>">Exportar Transacción</button>
									  
									  <table cellspacing="0" cellpadding="0" id="table2excel_<?php echo $fi['id'] ?>" style="display: none" >
  <tr>
    <td>compania</td>
    <td>sucursal</td>
    <td>tipo_documento</td>
    <td>documento</td>
    <td>contador</td>
    <td>documento_id</td>
    <td>sub_tipo</td>
    <td>centro_costo</td>
    <td>doc_tipo_documento</td>
    <td>doc_documento</td>
    <td>mov_tipo_documento</td>
    <td>mov_documento</td>
    <td>mov_contador</td>
    <td>tercero</td>
    <td>fecha</td>
    <td>referencia</td>
    <td>observacion</td>
    <td>bruto</td>
    <td>porc_descuento</td>
    <td>descuento</td>
    <td>porc_retencion</td>
    <td>retencion</td>
    <td>auto_retencion</td>
    <td>iva</td>
    <td>impoconsumo</td>
    <td>retencion_iva</td>
    <td>porc_retencion_ica</td>
    <td>retencion_ica</td>
    <td>porc_cree</td>
    <td>cree</td>
    <td>auto_cree</td>
    <td>neto</td>
    <td>es_debito</td>
    <td>fecha_reporte</td>
    <td>autorizacion</td>
    <td>activo</td>
    <td>orden_servicio</td>
    <td>orden_servicio_contador</td>
    <td>contrato</td>
    <td>id_orden</td>
    <td>id_prima_prevision</td>
    <td>id_cuota_prenecesidad</td>
    <td>id_cuota_credito</td>
    <td>mantenimiento_detalle</td>
    <td>usuario</td>
    <td>grabada</td>
    <td>action</td>
    <td>doc_documento_id</td>
  </tr>
  <tr>
    <td>1</td>
    <td>1</td>
    <td>117</td>
    <td></td>
    <td>102891</td>
    <td></td>
    <td>319</td>
    <td>230</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php echo date('m/d/Y h:mm') ?></td>
    <td></td>
    <td><?php echo $desc ?></td>
    <td><?php echo $abono ?></td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
    <td><?php echo $abono ?></td>
    <td>-1</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php echo date('m/d/Y h:mm') ?></td>
    <td>A</td>
    <td></td>
  </tr>
</table>
									  
                                  <input type="checkbox" name="validado[]" value="<?php echo $fi['id']?>" id="checkbox">
									    <input type="text" name="validado_recibo_<?php echo $fi['id'];?>" value="" id="val" placeholder="RECIBO DE CAJA">
                                  <br/>
                                  <br/>
								  <p><?php echo $desc2." ".$desc3;?></p>
                                 </td>
           				          <td><p>Destinatario:<br>
           				            <input type="text" id="destinatario_<?php echo $fi['id']?>" value="<?php echo $viajero['facturacion_email']?>"  placeholder="Destinatario">
           				            <br>
           				          </p>
           				            <p><a href="#" onClick="verCorreo('correo<?php echo $fi['id']?>')">Correo </a>
       				                </p>
           				            <div style="width:300px;display:none;" id="correo<?php echo $fi['id']?>">
									<input type="hidden" value="<?php echo $subject?>" id="sub_<?php echo $fi['id']?>" />
									
									<textarea id="texto_<?php echo $fi['id']?>" class="texto_correo"><?php echo $correo;?></textarea>
								
										
										   <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'texto_<?php echo $fi['id']?>',{
      height: 150
    } );
											  CKEDITOR.config.removeButtons = 'Bold,Italic,Underline,Copy,Cut,Paste,Undo,Redo,Print,Form,TextField,Textarea,Button,SelectAll,NumberedList,BulletedList,CreateDiv,Table,PasteText,PasteFromWord,Select,HiddenField';
											
            </script>
										
									  
									  </div>
									  <!-- <input type="file" id="file_<?php echo $fi['id']?>" > -->
									  <button type="button" id="botonenviar_<?php echo $fi['id']?>" onClick="enviarCorreo(<?php echo $fi['id']?>)">Enviar Corrreo</button>
								  </td>
           				          <td><?php echo $fi['observaciones']?></td>
           				          <td><a href="pagos_validar.php?borrar=<?php echo $fi['id']?>" onclick="return confirm('Desea Borrar?')">X</a>
                             </td>
       				            </tr>
           				        <?php } } ?>
       				          </table>
								   </div>
                              
           				      <p>
           				        <input type="submit" name="submit" id="submit" value="Validar">
           				      </p>
       				        </form>
                              
                              

         
							
                            <script>

const convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = (error) => {
            reject(error);
        };
    });
};
								
async function enviarCorreo(iddiv) {
								
								var email = document.getElementById("texto_"+iddiv).value;
								var sub = document.getElementById("sub_"+iddiv).value;

								var file = document.getElementById("file_"+iddiv);

								// if(file !=''){

								// base64 = await convertBase64(file.files[0]);

								// var filename = $("#file_"+iddiv).val().replace(/C:\\fakepath\\/i, '');

								// console.log(base64);
								// }

								console.log(email);
								var destinatario = document.getElementById("destinatario_"+iddiv).value;
								console.log(destinatario);

							

							$.post('MailSend.php', {from:'pagos@eventours.travel', to: destinatario,mensaje:email,subject:'Registro de Pago,'+sub,bcc:'pagos@eventours.travel',attachment:'',attachment_name:''}, function(response){ 
      alert("El Correo ha sido enviado");
								document.getElementById('botonenviar_'+iddiv).style.display="none"
     // $("#mypar").html(response.amount);
});
							}	
							function verCorreo(iddiv){
							//	window.alert(iddiv);
							if(document.getElementById(iddiv).style.display == "block"){
							document.getElementById(iddiv).style.display="none";
							}else{
							document.getElementById(iddiv).style.display="block";	
							}
							}
							</script>
           				  
       				      <script type="text/javascript">
        $(function () {
			//$('table').footable();

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
							
    
     <script>
    var btns = document.querySelectorAll('button');
    var clipboard = new Clipboard(btns);

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
    
  </script></div>
           				</div>
                        </div>
                        </div>
                        </div>
                        
                        <?php } ?>
             <script src="js/jquery.table2excel.js"></script>
<script>
    $(".button_export").click(function(event){
		
		
      
          event.stopPropagation();
    event.stopImmediatePropagation();
        event.preventDefault();
  $("#table2excel_"+event.target.id).table2excel({
    name: "karing export",
    filename: "karing_"+event.target.id, //do not include extension
    fileext: ".xls" // file extension
  }); 
});
</script>
    </body>
