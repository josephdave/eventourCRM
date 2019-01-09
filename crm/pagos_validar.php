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
 
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGOS POR VALIDAR</div>
					<div class="panel-body">
           				  <div class="module-body">
                          
           				    <form id="form1" name="form1" method="post" action="pagos_validados.php">
           				      <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;padding:10px;" class="table demo">       				        <thead>
           				          <tr>
           				            <th>Producto</th>
           				            <th><strong>Documento</strong></th>
           				            <th><strong>Nombre</strong></th>
           				            <th>Fecha Pago</th>
           				            <th>Fecha Registro</th>
           				            <th>Medio</th>
           				            <th>Moneda</th>
           				            <th>Abono PT</th>
           				            <th>Abono TIK</th>
           				            <th>Fee</th>
           				            <th>TRM</th>
           				            <th>VALIDADO</th>
           				            <th>BORRAR</th>
   				                </thead>
           				        <tr>
           				          <?php 
							
							$resultado=$control->pagosRegistradosValidar();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
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
           				          <td><?php echo $fi['moneda']?></td>
           				          <td><?php echo number_format($fi['valor_PT'],0,",",".");?></td>
           				          <td><?php echo number_format($fi['valor_TIK'],0,",",".");?></td>
           				          <td><?php echo number_format($fi['fee'],0,",",".");?></td>
           				          <td><?php echo $fi['trm']?></td>
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
								  
								  
								  $desc.=" Producto: ".$control->nomGrupoSimple($fi['id_producto'])." - Viajero(s): ".$control->listaNombres($viajero['facturacion_nodocumento'],$viajero['id_grupo']);
								
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
		  $concepto="CONSIG USD BANCO DE BOGOTA";					
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
								  
								  $linea=$date->format('dmY').";".$fi['moneda'].";".trim(preg_replace('/\s+/', '', $viajero['facturacion_nodocumento'])).";".$desc." id:".$fi['id'].";".str_replace("COLEGIO","COL",$control->nomCentroCosto($fi['id_producto'])).";".$abono.";".$med.";".$fi['numero'].";".$fi['comprobante'].";".$fi['aut'].";".$concepto;
								  
								  if($fi['moneda']=="Pesos"){
								  $pag=($fi['valor_PT']+$fi['valor_TIK']+$fi['fee'])*$fi['trm'];
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
								  
								  $correo="
								  <p style='color:#000'>Adjunto remito para su control recibo de caja expedido por su pago efectuado el ".$fi['fecha']." por ".$pag.". Con este pago se abonaron:</p>
<p style='color:#000'>".trim($mon).", a ".trim($tipo).".</p>
<p style='color:#000'>El saldo por pagar después de este abono es así:</br>" 
.$datosproducto['MONEDA']." ".($totalTK-$totalAbonoTK)." por tarifa aérea</br>"
.$datosproducto['MONEDA']." ".($totalPT-$totalAbonoPT)." por porción terrestre</br> 
<p style='color:#000'>Estaremos atentos en caso de que requiera información adicional.</p>
<p style='color:#000'>Cordialmente,</p>";
								  
								 
								  
								 // echo $linea;
								  ?>
                                    <button type="button" data-clipboard-text="<?php echo $linea?>">Copiar</button>
                                  <input type="checkbox" name="validado[]" value="<?php echo $fi['id']?>" id="checkbox">
                                  <br>
                                 <a href="#" onClick="verCorreo('correo<?php echo $fi['id']?>')"> Correo </a>
                                  <div style="width:100%;display:none;" id="correo<?php echo $fi['id']?>"><?php echo $correo;?></div></td>
           				          <td><a href="pagos_validar.php?borrar=<?php echo $fi['id']?>" onclick="return confirm('Desea Borrar?')">X</a>
                             </td>
       				            </tr>
           				        <?php } ?>
       				          </table>
                              
           				      <p>
           				        <input type="submit" name="submit" id="submit" value="Validar">
           				      </p>
       				        </form>
                            <script>
							function verCorreo(iddiv){
							//	window.alert(iddiv);
							if(document.getElementById(iddiv).style.display == "inline"){
							document.getElementById(iddiv).style.display="none";
							}else{
							document.getElementById(iddiv).style.display="inline";	
							}
							}
							</script>
           				  
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
                      
    </body>
