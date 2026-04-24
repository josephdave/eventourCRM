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
	$mensaje=$control->registrarPago($_REQUEST['idviajero'],$_REQUEST['date'],$_REQUEST['tik'],$_REQUEST['pt'],$_REQUEST['trm'],$_REQUEST['fee'],$_REQUEST['medio'],$_REQUEST['producto'],$_REQUEST['observaciones']);

}

if(isset($_REQUEST['borrarModificacion'])){
	$mensaje=$control->borrarModificacion($_REQUEST['borrarModificacion']);

}

if(isset($_REQUEST['usuario'])){
	$mensaje=$control->registrarObs($_REQUEST['doc'],$_REQUEST['usuario'],$_REQUEST['observacion']);

}
	
?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGO VIAJERO</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 
						  
						  	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $documento_viajero = $_REQUEST['doc'];
	$viajero=$control->datosViajeroID($documento_viajero);
	
	$producto=$control->datosProducto($viajero['id_grupo']);
	
	//var_dump($producto);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                                
                          <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Nombres:</strong></td>
    <td colspan="3"><?php
		  //$producto = $datosproducto;
									  $nitviajero=$viajero['facturacion_nodocumento'];
									  $viajeroNIT=$control->listaViajeros($nitviajero,$viajero['id_grupo']);
									  $totalTK=0;
									  $totalPT=0;
									  $viaj="";
									  
									  $totalAbonoTK=0;
									  $totalAbonoPT=0;
									  
									  while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
										  
						$viaj=$viaj." ".$di['nombres']." ".$di['apellidos'];
							if($di['estado']=="NO VIAJA"){	
							$viaj=$viaj." (NO VIAJA)";
							}
										  $viaj=$viaj." - ";
						
						//var_dump($di['nombres']);
									
										  //var_dump($di['nombres']);
						if($di['estado']=="VIAJA"){				  
						$valortk= $control->valorViajeroTK($di['otro'],$producto); 
					
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
								}else{
								$valortk= 0; 
					
						
						//var_dump($valortk);
						
					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk+$valorMtk);
					   
					   
					 $valorpt= 0; 
					  $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt+$valorMpt);
						}
					  }
					  
	
	 echo $viaj; ?>     </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Documento Facturacion:</strong></td>
    <td><?php echo $viajero['facturacion_nodocumento'] ?></td>
    <td bgcolor="#CCCCCC"><strong>Celular:</strong></td>
    <td><?php echo $viajero['celular']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Grupo:</strong></td>
    <td colspan="3"><a href="producto.php?grupo=<?php echo $producto['id'];?>" target="_parent"><?php echo $control->nomGrupo($viajero['id_grupo'])." ".$viajero['otro'];?></a></td>
    </tr>
     <tr>
    <td bgcolor="#CCCCCC"><strong>Expediente:</strong></td>
    <td colspan="3"><?php echo $viajero['expediente']?></td>
    </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Valor TK:</strong></td>
    <td> <?php 
						
						  
						  //echo $valorMtk;
						  
						 ?>
                          
                          
      <?php   echo $producto['MONEDA']." ".($totalTK);?></td>
    <td bgcolor="#CCCCCC"><strong>Valor PT:</strong></td>
    <td>
	
                          <?php 
						  
						 ?>
                          
                          
      <?php   echo $producto['MONEDA']." ".($totalPT);?>
	</td>
  </tr>
</table>
							  <script>
								  function myFunction(id) {
  var x = document.getElementById(id);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
							  </script>
<h2><a href="#" onclick="myFunction('obs')">OBSERVACIONES</a></h2>
							  
<div id="obs" >							  
 <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
  <thead>
    <tr>
     
     
      <th width="74%">Observacion</th>
       <th width="12%">Fecha</th>
        <th width="14%">Usuario</th>
      </thead>
  <?php 
							
							
							$resultado=$control->verObservaciones($_REQUEST['doc']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
  <tr>
    <td><?php echo $fi['comentario'];
							  ?></td>
    <td><?php echo $fi['fecha_registro'];?></td>
    <td><?php 
	 $usuario=$control->datosUsuario($fi['usuario']);
							  echo strtoupper($usuario['nombre']);
                              
	
							  ?></td>
   
    </tr>
     <?php } ?>
 
 
</table>
							 

 <p>&nbsp;</p>
 <form id="form1" name="form1" method="post">
     
      <textarea name="observacion" id="observacion" cols="80" rows="3"></textarea>
      <br>
      <input type="submit" name="submit" id="submit" value="Registrar">
      <input type="hidden" name="doc" id="doc" value="<?php echo $_REQUEST['doc']?>">
      <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['id']?>">
      
    </form>
<p>&nbsp;</p>
 </div>
							  
							  <h2><a href="#" onclick="myFunction('mod')">MODIFICACIONES</a>
                            <input type="button" name="button3" id="button3" value="Registrar Modificación" onclick="location.href='registrar_modificaciones.php?grupo=<?php echo $viajero['id_grupo'];?>&viajero=<?php echo $viajero['id'];?>'" >
                          </h2>
							  <div id="mod">
                          <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
                            <thead>
                              <tr>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Concepto</th>
                                <th>&nbsp;</th>
                            </thead>
                            <?php 
							
							$totalmtk=0;
							$totalmpt=0;
							
							$resultado=$control->datosModificacionesNIT($viajero['facturacion_nodocumento'],$producto['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                            <tr>
                              <td><?php echo $fi['tipo'];?></td>
                      
                              <td><?php echo $fi['valor'];
							  if($fi['tipo']=='TK'){
							  $totalmtk=$totalmtk+$fi['valor'];
							  }else{
								   $totalmpt=$totalmpt+$fi['valor'];
							  }
							  ?></td>
                              <td><?php echo $fi['concepto'];?></td>
                              <td><a href="registrar_pago.php?borrarModificacion=<?php echo $fi['identificador'] ?>&doc=<?php echo $documento_viajero ?>">X</a></td>
                            </tr>
                            <?php } ?>
                            <tr style="background:#333">
                              <td bgcolor="#CCCCCC"><strong>TOTAL TK:</strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totalmtk;?></strong></td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#CCCCCC"><strong>TOTAL PT:</strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totalmpt;?></strong></td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                          </table>
                          </div>
                          <h2>PAGOS REALIZADOS 
                            <input type="button" name="button3" id="button3" value="Registrar Pago" onclick="location.href='registrar_pago_general.php?id=<?php echo $viajero['id'];?>'" >
                           
							  <a href="datos.php?idcd=<?php echo $viajero['no_documento'];?>" target="_blank">Liquidar Viajero</a>
                          </h2>
                            <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
           				    <thead>
           				      
           				      
           				    
           				      
           				        <tr>
           				      <th><strong>Id</strong></th>
           				      <th>Fecha de Pago</th>
           				      <th>Abono TIK</th>
           				      <th>Abono PT</th>
           				      <th>Fee</th>
           				      <th>TRM</th>
           				      <th>Medio</th>
           				      <th>Validado</th>
           				      <th>Recibo No.</th>
           				      <th>Observaciones</th>
           				      
           				  </thead>
                            
                            <?php 
							
							$totaltik=0;
							$totalpt=0;

              var_dump($producto['id']);
							
							$resultado=$control->pagosHistorialViajeroNIT($viajero['facturacion_nodocumento'],$producto['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?><tr>
                           
           				      <td><?php echo $fi['id'];?></td>
           				      <td><?php echo $fi['fecha'];?></td>
                              <?php 
							  
							  
							  
							  ?>
           				      <td><?php 
							 if($fi['validado'] == 1){ $totaltik+=$fi['valor_TIK'];}
							 echo $fi['valor_TIK'];?></td>
           				      <td><?php 
							if($fi['validado'] == 1){ $totalpt+=$fi['valor_PT'];}?> 
                            
                            <?php 		  
							  echo $fi['valor_PT'];?></td>
           				      <td><?php echo $fi['fee'];?></td>
           				      <td><?php echo number_format($fi['trm'],2,",",".");?></td>
           				      <td><?php echo $fi['medio'];?></td>
           				      <td><?php if($fi['validado']==1)
		 echo "SI";
		 else
		 echo "NO";
		 ?></td>
           				      <td><?php echo $fi['recibo_caja'];?></td>
           				      <td><?php echo $fi['observaciones'];?></td>
           				      </tr> <?php } ?>
                            <tr>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC"><strong>TOTAL:</strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totaltik;?></strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totalpt;?></strong></td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC"><strong>SALDO:</strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo ($totalTK)-$totaltik;?></strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo ($totalPT)-$totalpt;?></strong></td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                           
         				    </table>
                            
                          
           				  </p>
           				  </div>
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

	var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
//	

	  var table_html = table_html.replaceAll('.', '');
var table_html = table_html.replaceAll(',', ',');	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
								
								$("#btnExport2").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

	var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper2');
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
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
						
						   <button id="btnExport2">Descargar</button>
                          <div id="table_wrapper2">
       				    <h2>LIQUIDACIÓN - <?php echo $viaj; ?></h2>
                          <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
                            <tr>
                              <td bgcolor="#CCCCCC"><strong>Nombres:</strong></td>
                              <td colspan="3"><?php
		  //$producto = $datosproducto;
									  $nitviajero=$viajero['facturacion_nodocumento'];
									  $viajeroNIT=$control->listaViajeros($nitviajero,$viajero['id_grupo']);
									  $totalTK=0;
									  $totalPT=0;
									  $viaj="";
								  $total_devolver_pesos=0;
									  
									  $totalAbonoTK=0;
									  $totalAbonoPT=0;
									  
									  while ($di = mysql_fetch_array($viajeroNIT, MYSQL_ASSOC)) {
										  
						$viaj=$viaj." ".$di['nombres']." ".$di['apellidos'];
							if($di['estado']=="NO VIAJA"){	
							$viaj=$viaj." (NO VIAJA)";
							}
										  $viaj=$viaj." - ";
						
						//var_dump($di['nombres']);
									
										  //var_dump($di['nombres']);
						if($di['estado']=="VIAJA"){				  
						$valortk= $control->valorViajeroTK($di['otro'],$producto); 
					
						
						//var_dump($valortk);
						
//					   $valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk);
					   
					   
					 $valorpt= $control->valorViajeroPT($di['otro'],$producto); 
					 // $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt);
								}else{
								$valortk= 0; 
					
						
						//var_dump($valortk);
						
					   //$valorMtk= $control->consultarModificaciones($di['id'],$producto['id'],'TK'); 
					   
					   $totalTK=$totalTK+($valortk);
					   
					   
					 $valorpt= 0; 
					 // $valorMpt= $control->consultarModificaciones($di['id'],$producto['id'],'PT'); 
					  
					  $totalPT=$totalPT+($valorpt);
						}
					  }
					  
	
	 echo $viaj; ?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#CCCCCC"><strong>Documento Facturacion:</strong></td>
                              <td><?php echo $viajero['facturacion_nodocumento'] ?></td>
                              <td bgcolor="#CCCCCC"><strong>Celular:</strong></td>
                              <td><?php echo $viajero['celular']; ?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#CCCCCC"><strong>Grupo:</strong></td>
                              <td colspan="3"><?php echo $control->nomGrupo($viajero['id_grupo'])." ".$viajero['otro'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#CCCCCC"><strong>Valor TK:</strong></td>
                              <td><?php 
						
						  
						  //echo $valorMtk;
						  
						 ?>
                                <?php   echo $producto['MONEDA']." ".($totalTK);?></td>
                              <td bgcolor="#CCCCCC"><strong>Valor PT:</strong></td>
                              <td><?php 
						  
						 ?>
                                <?php   echo $producto['MONEDA']." ".($totalPT);?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#CCCCCC"><strong>VALOR TOTAL DEL PROGRAMA</strong></td>
                              <td><?php   echo $producto['MONEDA']." ".($totalPT+$totalTK);?></td>
                              <td bgcolor="#CCCCCC"><strong>VALOR A DESCONTAR (20%)</strong></td>
                              <td><?php
								  $penalidad =($totalPT+$totalTK)*0.2;
								  echo $producto['MONEDA']." ".(round($penalidad));?></td>
                            </tr>
                          </table>
                          <p>&nbsp;</p>
                      <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
                            <thead>
                              <tr>
								   <th>Recibo No.</th>
                                <th>Fecha de Pago</th>
                                <th>Abono TIK</th>
                                <th>Abono PT</th>
                                <th>TRM</th>
                                <th>Valor en Pesos</th>
                                <th>Valor a descontar</th>
                                <th>Valor a devolver</th>
                                <th>Valor a devolver en Pesos</th>
                               
                            </thead>
                            <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->pagosHistorialViajeroNIT($viajero['facturacion_nodocumento'],$producto['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {if($fi['validado']==1){
							?>
                            <tr> <td><?php echo $fi['recibo_caja'];?></td>
                              <td align="right"><?php 
								setlocale(LC_TIME,"es_ES");
								echo  strftime("%d %B %Y", strtotime( $fi['fecha']));
								  ?></td>
                              <?php 
							  
							  
							  
							  ?>
                              <td align="right"><?php 
							 if($fi['validado'] == 1){ $totaltik+=$fi['valor_TIK'];}
							 echo $fi['valor_TIK'];?></td>
                              <td align="right"><?php 
							if($fi['validado'] == 1){ $totalpt+=$fi['valor_PT'];}?>
                                <?php 		  
							  echo $fi['valor_PT'];?></td>
                              <td align="right"><?php echo number_format($fi['trm'],2,",",".");?></td>
                              <td align="right"><?php 
								$total_usd=$fi['valor_TIK']+$fi['valor_PT'];
								echo number_format(($fi['trm']*($total_usd)),0,".",".");?></td>
                              <td align="right"><?php
								$pagopenalidad=0;
								if($penalidad >= $total_usd){
									//echo round($total_usd);
									$pagopenalidad=$total_usd;
									$penalidad=$penalidad-$total_usd;
								
								}else if($penalidad > 0){
									//echo round($penalidad);
									$pagopenalidad=$penalidad;
									$penalidad=$penalidad-$total_usd;
									
								}else{
									//echo 0;
									$pagopenalidad=0;
								}
								echo round($pagopenalidad);
								?></td>
                              <td align="right"><?php echo round($total_usd-$pagopenalidad);?></td>
                              <td align="right"><?php 
								$t=($total_usd-$pagopenalidad)*$fi['trm'];
								$total_devolver_pesos+=$t;
								echo number_format($t,0,".",".");?></td>
                             
                            </tr>
                            <?php } }?>
                            <tr>
								<td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC"><strong>TOTAL:</strong></td>
                              <td bgcolor="#CCCCCC" align="right"><strong><?php echo $totaltik;?></strong></td>
                              <td bgcolor="#CCCCCC" align="right"><strong><?php echo $totalpt;?></strong></td>
                              
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                              <td bgcolor="#CCCCCC" align="right"><strong><?php echo number_format($total_devolver_pesos,0,".",".");?></strong></td>
                            </tr>
                          </table>
						</div>
						
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
					</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
