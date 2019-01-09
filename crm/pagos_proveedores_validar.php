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
                          
           				    <form id="form1" name="form1" method="post" action="pagos_validados_proveedores.php">
           				      <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;padding:10px;" class="table demo">       				        <thead>
           				          <tr>
           				            <th><strong>PROVEEDOR</strong></th>
           				            <th>Fecha</th>
           				            <th>Moneda</th>
           				            <th>Valor</th>
           				            <th>Observaciones</th>
           				            <th>Pagado</th>
           				            <th>BORRAR</th>
   				                </thead>
           				        <tr>
           				          <?php 
							
							$resultado=$control->pagosRegistradosProveedorValidar();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
           				          <td><?php echo strtoupper($fi['nombre']);?> </td>
           				          <td><?php echo $fi['fecha']?></td>
           				          <td><?php echo $fi['moneda']?></td>
           				          <td><?php echo number_format($fi['valor'],0,",",".");?></td>
           				          <td><?php echo $fi['obs']?></td>
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
									  
									  
								
					
								 
								  
								 // echo $linea;
								  ?>
                                   <!-- <button type="button" data-clipboard-text="<?php echo $linea?>">Copiar</button>-->
                                  <input type="checkbox" name="validado[]" value="<?php echo $fi['id']?>" id="checkbox">
                                  <br>
                                <!-- <a href="#" onClick="verCorreo('correo<?php echo $fi['id']?>')"> Correo </a>
                                  <div style="width:100%;display:none;" id="correo<?php echo $fi['id']?>"><?php echo $correo;?></div></td>-->
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
