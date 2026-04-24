<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	
  $idcontrato = $_REQUEST['id'];
	$contrato=$control->datosContrato($idcontrato);
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> REPORTE CONTRATO - <?php echo $contrato['nombre']?></h3>
       				      
           				  <div class="module-body">
                     <!--     
           				  <p><a href="insc.php?grupo=0">Ver Todos </a><br>
           				  </p>
           				  <form name="form1" method="post" action="busqueda.php">
           				    <label for="termino"></label>
           				    Busqueda General:
           				    <input type="text" name="termino" id="termino" ><input name="Submit" type="submit" value="Consultar">
         				    </form>
           				  <p>&nbsp; </p>--><div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">CONTRATO AEROLINEA   <button id="btnExport">Descargar
					</button>
					</div>
					<div class="panel-body">
                     <div id="table_wrapper">
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" >
					        <thead>
					          <tr>
					            <th>N.</th>
					            <th>GRUPO</th>
					            <th><strong>NOMBRES</strong> </th>
				                <th><strong>APELLIDOS
                                </strong> </th>
				                <th><strong>ORIGEN</strong> </th>
			                    <th><strong>DESTINO</strong> </th>
			                    <th >RECORD</th>
			                    <th >TIQUETE</th>
			                    <th >FECHA IDA</th>
		                        <th ><strong>FECHA REGRESO</strong> </th>
		                        <th >NETA+Q</th>
		                        <th >YS</th>
		                        <th >CO</th>
		                        <th >Otros Impuestos</th>
		                        <th >TA</th>
		                        <th >IVA TA</th>
		                        <th >TOTAL COP</th>
		                        <th >TOTAL USD</th>
		                        
					            
					            
					            
					            
					            </tr>
			                </thead>

					        <?php 
							
							
							$resultado=$control->viajerosRecord($_REQUEST['id']);
							$n=1;
								$usados=$control->cuposRecord($contrato['id']);
								$total_tc=floor($usados/$viajero['politica_tc']);
								$totalNQ=0;
								$totalYS=0;
								$totalCO=0;
								$totalIMP=0;
								$totalTA=0;
								$totalIVATA=0;
								$totalCOP=0;
								$totalUSD=0;
								
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								
								
							?>
					        <tr>
					          <td><?php echo $n++;
								  if(($n-1)%$viajero['politica_tc']==0 && $n-1!=1){
								  echo "TC";
								  }
								  ?></td>
					          <td><?php  $producto=$control->datosProducto($fi['id_grupo']);
							  echo strtoupper($producto['grupo']);?></td>
					          <td><?php 
							 
							  $nombres=explode(" ",$fi['nombres']);
							  echo strtoupper($control->tildes($fi['nombres']));?></td>
					          <td><?php 
							  $apellidos=explode(" ",$fi['apellidos']);
							  echo strtoupper($control->tildes($fi['apellidos']));?></td>
					          <td><?php echo $contrato['origen'];?></td>
					          <td><?php echo $contrato['destino'];?></td>
					          <td><?php echo $contrato['record'];?></td>
					          <td><?php
															
								echo  $fi['tiquete']; 
								?></td>
					          <td><?php echo $contrato['fecha_salida'];?></td>
					          <td><?php echo $contrato['fecha_regreso'];?></td>
					          <td><?php
								$totalmtk=0;
								
								
								
								$viajero = $contrato;
								if(($n-1)%$viajero['politica_tc']!=0){
								$totalmtk+=$viajero['neta_q'];
									$totalNQ+=$viajero['neta_q']+$viajero['q'];
								$totalmtk+=$viajero['q'];
								echo "$".number_format(($viajero['q']+$viajero['neta_q'])*$viajero['trm'],0); 	
								}else{
								echo "$".number_format(0,0); 
								
									}
							 
							  ?></td>
					          <td><?php 
								$ys=0;
								$co = 0;
								$otrosimp=0;
								
								if(($n-1)%$viajero['politica_tc']!=0){
								$resultado2=$control->impuestosContrato($viajero['id']);
							while ($fi2 = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
								 $totalmtk+=$fi2['valor'];
                               
                              if(strpos($fi2['impuesto'],"YS")!==false){
								$ys+=$fi2['valor'];
								$totalYS+=$fi2['valor']; 
							  }else	if(strpos($fi2['impuesto'],"CO")!==false){
								$co+=$fi2['valor'];
								  $totalCO+=$fi2['valor'];
							  }else{
								  $otrosimp+=$fi2['valor'];
								  $totalIMP+=$fi2['valor'];
							  }
							 
							 

                                
                               }  echo "$".number_format($ys*$viajero['trm'],0);
								}else{
									$otrosimp=$viajero['vlr_tc'];
										$totalmtk+=$otrosimp;
										$co=0;
									 echo "$".number_format(0,0);
								}
								  ?></td>
					          <td><?php echo "$".number_format($co*$viajero['trm'],0);?></td>
					          <td><?php echo "$".number_format($otrosimp*$viajero['trm'],0);?></td>
					          <td><?php 
								if(($n-1)%$viajero['politica_tc']!=0){
								echo "$".number_format($viajero['tadmin']*$viajero['trm'],0);
								  $totalmtk+=$viajero['tadmin'];
									$totalTA +=$viajero['tadmin'];
								$totalmtk+=number_format(($viajero['tadmin']*0.19),0);
									$totalIVATA+=number_format(($viajero['tadmin']*0.19),0);
								}else{
									echo "$".number_format(0,0);
								}
							 
							  ?></td>
					          <td><?php
									if(($n-1)%$viajero['politica_tc']!=0){
								echo "$".number_format($viajero['tadmin']*0.19*$viajero['trm'],0); 
									}else{
										echo "$".number_format(0,0); 
									}
							 
							  ?></td>
					          <td><?php 
								$totalCOP+=$totalmtk*$viajero['trm'];
								echo "$".number_format($totalmtk*$viajero['trm'],0); 
							 
							  ?></td>
					          <td><strong><?php
								$totalUSD+=$totalmtk;
								echo $totalmtk;?></strong></td>
					          </tr>
					        <?php } ?>
                            
                            <?php 
							
							
							$resultado=$control->viajerosPrincipal($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								
								
							?>
					        <tr>
					          <td><?php echo $n++;
								   if(($n-1)%$viajero['politica_tc']==0 && $n-1!=1){
								  echo "TC";
								  }
								  ?></td>
					          <td><?php  $producto=$control->datosProducto($fi['id_grupo']);
							  echo strtoupper($producto['grupo']);?></td>
					          <td><?php 
							 $nombres=explode(" ",$fi['nombres']);
							  echo strtoupper($control->tildes($fi['nombres']));?></td>
					          <td><?php 
							  $apellidos=explode(" ",$fi['apellidos']);
							  echo strtoupper($control->tildes($fi['apellidos']));?></td>
					          <td><?php echo $contrato['origen'];?></td>
					          <td><?php echo $contrato['destino'];?></td>
					          <td><?php echo $contrato['record'];?></td>
					          <td><?php
															
								echo  $fi['tiquete']; 
								?></td>
					          <td><?php echo $contrato['fecha_salida'];?></td>
					          <td><?php echo $contrato['fecha_regreso'];?></td>
					          <td><?php
								$totalmtk=0;
								
								
								
								$viajero = $contrato;
								if(($n-1)%$viajero['politica_tc']!=0){
								$totalmtk+=$viajero['neta_q'];
									$totalNQ+=$viajero['neta_q']+$viajero['q'];
								$totalmtk+=$viajero['q'];
								echo "$".number_format(($viajero['q']+$viajero['neta_q'])*$viajero['trm'],0); 	
								}else{
								echo "$".number_format(0,0); 
								
									}
							 
							  ?></td>
					          <td><?php 
								$ys=0;
								$co = 0;
								$otrosimp=0;
								
								if(($n-1)%$viajero['politica_tc']!=0){
								$resultado2=$control->impuestosContrato($viajero['id']);
							while ($fi2 = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
								 $totalmtk+=$fi2['valor'];
                               
                              if(strpos($fi2['impuesto'],"YS")!==false){
								$ys+=$fi2['valor'];
								$totalYS+=$fi2['valor']; 
							  }else	if(strpos($fi2['impuesto'],"CO")!==false){
								$co+=$fi2['valor'];
								  $totalCO+=$fi2['valor'];
							  }else{
								  $otrosimp+=$fi2['valor'];
								  $totalIMP+=$fi2['valor'];
							  }
							 
							 

                                
                               }  echo "$".number_format($ys*$viajero['trm'],0);
								}else{
									$otrosimp=$viajero['vlr_tc'];
										$totalmtk+=$otrosimp;
										$co=0;
									 echo "$".number_format(0,0);
								}
								  ?></td>
					          <td><?php echo "$".number_format($co*$viajero['trm'],0);?></td>
					          <td><?php echo "$".number_format($otrosimp*$viajero['trm'],0);?></td>
					          <td><?php 
								if(($n-1)%$viajero['politica_tc']!=0){
								echo "$".number_format($viajero['tadmin']*$viajero['trm'],0);
								  $totalmtk+=$viajero['tadmin'];
									$totalTA +=$viajero['tadmin'];
								$totalmtk+=number_format(($viajero['tadmin']*0.19),0);
									$totalIVATA+=number_format(($viajero['tadmin']*0.19),0);
								}else{
									echo "$".number_format(0,0);
								}
							 
							  ?></td>
					          <td><?php
									if(($n-1)%$viajero['politica_tc']!=0){
								echo "$".number_format($viajero['tadmin']*0.19*$viajero['trm'],0); 
									}else{
										echo "$".number_format(0,0); 
									}
							 
							  ?></td>
					          <td><?php 
								$totalCOP+=$totalmtk*$viajero['trm'];
								echo "$".number_format($totalmtk*$viajero['trm'],0); 
							 
							  ?></td>
					          <td><strong>
					            <?php
								$totalUSD+=$totalmtk;
								echo $totalmtk;?>
					            </strong></td>
					          </tr>
										   <?php } ?>
					        <tr>
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
					          <td><?php
								  echo "$".number_format($totalNQ*$viajero['trm'],0);
								?></td>
					          <td><?php
								  echo "$".number_format($totalYS*$viajero['trm'],0);
								?></td>
					          <td><?php
								  echo "$".number_format($totalCO*$viajero['trm'],0);
								?></td>
					          <td><?php
								  echo "$".number_format($totalIMP*$viajero['trm'],0);
								?></td>
					          <td><?php
								  echo "$".number_format($totalTA*$viajero['trm'],0);
								?></td>
					          <td><?php
								  echo "$".number_format($totalIVATA*$viajero['trm'],0);
								?></td>
					          <td><?php
								  echo "$".number_format($totalCOP,0);
								?></td>
					          <td><?php
								  echo "".number_format($totalUSD,0);
								?></td>
					          </tr>
					      
				          </table>                          
					</div>
					</div>
                                                        </div>
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

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');

	 var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
//	

	  var table_html = table_html.replaceAll('.', '');
var table_html = table_html.replaceAll(',', '.');	
	  
	  
    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>
           				  </div>
           				</div>
                        </div>
    </body>
