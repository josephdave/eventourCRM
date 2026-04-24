<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);





if(isset($_REQUEST['borrarimpuesto'])){
	$mensaje=$control->borrarImpuesto($_REQUEST['borrarimpuesto']);

}
	
?>

    
   
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">DETALLE CONTRATO AEROLINEA  <button type="button" class="btn-xs btn-primary" onclick="location.href='registrar_tiquete.php?contrato=<?php echo $_REQUEST['id'];?>'">MODIFICAR</button></div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $idcontrato = $_REQUEST['id'];
	$viajero=$control->datosContrato($idcontrato);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                            <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                                
                          <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Nombre:</strong></td>
    <td><?php echo $viajero['nombre']; ?></td>
    <td bgcolor="#CCCCCC"><strong>Aerolinea:</strong></td>
    <td><?php echo $viajero['aerolinea']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Record:</strong></td>
    <td><?php echo $viajero['record']; ?></td>
    <td bgcolor="#CCCCCC"><strong>Radicado:</strong></td>
    <td><?php echo $viajero['radicado']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Cupos Solicitados:</td>
    <td><?php echo $viajero['cupos_originales']; ?></td>
    <td bgcolor="#CCCCCC">Cupos con registro en CRM:</td>
    <td><?php 
							 
							 $usados=$control->cuposRecord($viajero['id']);
							
							 
							 echo $usados;?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Cupos Confirmados:</td>
    <td><?php echo $viajero['cupos_solicitados']; ?></td>
    <td bgcolor="#CCCCCC">Proveedor:</td>
    <td><?php echo $viajero['proveedor']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Estado:</strong></td>
    <td><?php echo $viajero['estado'] ?></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
  <tr>
    <td bgcolor="#CCCCCC"><strong>Origen:</strong></td>
    <td><?php echo $viajero['origen']; ?></td>
    <td bgcolor="#CCCCCC"><strong>Destino:</strong></td>
    <td><?php echo $viajero['destino']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Ruta:</strong></td>
    <td colspan="3"><?php echo $viajero['ruta']; ?></td>
    </tr>
     <tr>
    <td bgcolor="#CCCCCC">Fecha Llegada Destino</td>
    <td><?php echo $viajero['fecha_salida']; ?> - <?php echo $viajero['vuelo_llegada_destino']; ?></td>
    <td bgcolor="#CCCCCC">Fecha Salida Destino:</td>
    <td><?php echo $viajero['fecha_regreso']; ?> - <?php echo $viajero['vuelo_llegada_origen']; ?></td>
  </tr>
     <tr>
       <td bgcolor="#CCCCCC">Fecha Deposito:</td>
       <td><?php echo $viajero['f_deposito']; ?></td>
       <td bgcolor="#CCCCCC">Deposito x PAX:</td>
       <td><?php echo $viajero['deposito_pax']; ?></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">Politica TC</td>
       <td><?php echo $viajero['politica_tc']; ?></td>
       <td bgcolor="#CCCCCC">Valor TC</td>
       <td><?php echo $viajero['vlr_tc']; ?></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">Record TC</td>
       <td><?php echo $viajero['recordtc']; ?></td>
       <td bgcolor="#CCCCCC">&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">Fecha Cancelacion sin penalidad:</td>
       <td><?php echo $viajero['f_nombres']; ?></td>
       <td bgcolor="#CCCCCC">Fecha Cancelacion con penalidad:</td>
       <td><?php echo $viajero['f_cambios']; ?></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">Cupos sin penalidad:</td>
       <td><?php echo $viajero['cancelacion_sinp']; ?></td>
       <td bgcolor="#CCCCCC">Cupos con penalidad</td>
       <td><?php echo $viajero['cancelacion_conp']; ?></td>
     </tr>
     <tr>
       <td bgcolor="#CCCCCC">Fecha Emision</td>
       <td><?php echo $viajero['f_emision']; ?></td>
       <td bgcolor="#CCCCCC">Fecha de Pago Impuestos</td>
       <td><?php echo $viajero['f_impuestos']; ?></td>
     </tr>
                          </table>
                          <h2>VALORES CONTRATO: TRM(<?php echo $viajero['trm']; ?>)</h2>
							          <button type="button" class="btn-xs btn-primary" onclick="location.href='registrar_impuesto.php?idrecord=<?php echo $idcontrato; ?>'">AÑADIR IMPUESTO</button>
                          <table class="table table-hover">
          <thead>
                              <tr>
                                <th bgcolor="#CCCCCC">Item</th>
                                <th bgcolor="#CCCCCC">Valor</th>
                                <th bgcolor="#CCCCCC">Valor Pesos</th>
                                <th bgcolor="#CCCCCC">&nbsp;</th>
            </thead>
                            <?php 
							
							$totalmtk=0;
							
				
							?>
                            <tr>
                              <td><strong>NETA</strong></td>
                              <td><?php echo $viajero['neta_q']; 
							  $totalmtk+=$viajero['neta_q'];
							  ?></td>
                              <td><?php echo "$".number_format($viajero['neta_q']*$viajero['trm'],0); 
							 
							  ?></td>
                              <td>&nbsp;</td>
                            </tr>
                          
                            <tr>
                              <td><strong>Q</strong></td>
                      
                              <td><?php echo $viajero['q']; 
							  $totalmtk+=$viajero['q'];?></td>
                              <td><?php echo "$".number_format($viajero['q']*$viajero['trm'],0); 
							 
							  ?></td>
                              <td>&nbsp;</td>
                            </tr>
                             <tr>
                                  <td>NETA+Q</td>
                                  <td><?php echo $viajero['q']+$viajero['neta_q']; 
							?></td>
                                  <td><?php echo "$".number_format(($viajero['q']+$viajero['neta_q'])*$viajero['trm'],0); 
							 
							  ?></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>IMPUESTOS</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                            <?php $resultado=$control->impuestosContrato($viajero['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								?>
                               
                                <tr>
                              <td><strong><?php echo $fi['impuesto']?></strong></td>
                      
                              <td><?php echo $fi['valor'];
							  
							  $totalmtk+=$fi['valor'];?></td>
                              <td><?php echo "$".number_format($fi['valor']*$viajero['trm'],0); 
							 
							  ?></td>
                              <td><a href="detalle_aerolinea.php?borrarimpuesto=<?php echo $fi['id']."&id=".$idcontrato; ?>">X</a></td>
                            </tr>

                                
                                <?php } ?>
                           
                            <tr style="background:#333">
                              <td bgcolor="#CCCCCC"><strong>SUBTOTAL:</strong></td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totalmtk;?></strong></td>
                              <td bgcolor="#CCCCCC"><?php echo "$".number_format($totalmtk*$viajero['trm'],0); 
							 
							  ?></td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><strong>Tasa Administrativa</strong></td>
                              <td><?php echo $viajero['tadmin']; 
							  $totalmtk+=$viajero['tadmin'];
							  ?></td>
                              <td><?php echo "$".number_format($viajero['tadmin']*$viajero['trm'],0); 
							 
							  ?></td>
                              <td>&nbsp;</td>
                            </tr>
                             <tr>
                              <td><strong>IVA Tasa Administrativa</strong></td>
                              <td><?php echo number_format(($viajero['tadmin']*0.19),0);
							  $totalmtk+=number_format(($viajero['tadmin']*0.19),0);
							  ?></td>
                              <td><?php echo "$".number_format($viajero['tadmin']*0.19*$viajero['trm'],0); 
							 
							  ?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr style="background:#333">
                              <td bgcolor="#CCCCCC">TOTAL:</td>
                              <td bgcolor="#CCCCCC"><strong><?php echo $totalmtk;?></strong></td>
                              <td bgcolor="#CCCCCC"><?php echo "$".number_format($totalmtk*$viajero['trm'],0); 
							 
							  ?></td>
                              <td bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                            </table>
           				  </div>
   				      <h2>LIQUIDACION CONTRATO</h2>
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th bgcolor="#CCCCCC">Item</th>
                                <th bgcolor="#CCCCCC">PAX</th>
                                <th bgcolor="#CCCCCC">VALOR</th>
                                <th bgcolor="#CCCCCC">TOTAL</th>
                                <th bgcolor="#CCCCCC">TOTAL COP</th>
                                <th bgcolor="#CCCCCC">FECHA</th>
                            </thead>
                            <?php 
							
						
							
				
							?>
                            <tr>
                              <td><strong>DEPOSITO</strong></td>
                              <td><?php echo $viajero['cupos_solicitados']; ?></td>
                              <td><?php echo $viajero['deposito_pax']; ?></td>
                              <td><?php echo ( $viajero['cupos_solicitados']*$viajero['deposito_pax']);?></td>
                              <td><?php echo "$".number_format(( $viajero['cupos_solicitados']*$viajero['deposito_pax']*$viajero['trm']),0);?></td>
                              <td><?php echo $viajero['f_deposito']; ?></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><strong>TOUR CONDUCTOR</strong></td>
                              <td><?php $total_tc=floor($usados/$viajero['politica_tc']);
							  
							  echo $total_tc; 
							  
							  ?></td>
                              <td><?php echo $viajero['vlr_tc']; ?></td>
                              <td><?php echo ($total_tc*$viajero['vlr_tc']); ?></td>
                              <td><?php echo "$".number_format(($total_tc*$viajero['vlr_tc']*$viajero['trm']),0); ?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><strong> VIAJEROS</strong></td>
                              <td><?php echo $usados-$total_tc; 
							  
							  ?></td>
                              <td><strong><?php echo $totalmtk;?></strong></td>
                              <td><?php echo (($usados-$total_tc)*$totalmtk); ?></td>
                              <td><?php echo "$".number_format((($usados-$total_tc)*$totalmtk*$viajero['trm']),0); ?></td>
                              <td><?php echo $viajero['f_emision']; ?></td>
                            </tr>
                            <tr>
                              <td>PENALIDADES</td>
                              <td><?php echo $viajero['cupos_solicitados']-$usados; ?></td>
                              <td><?php echo $viajero['deposito_pax']; ?></td>
                              <td><?php $penalidad= $viajero['deposito_pax']*($viajero['cupos_solicitados']-$usados);
								  echo $penalidad;?></td>
                              <td><?php
								  echo "$".number_format($penalidad*$viajero['trm'],0);?></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><strong>TOTAL</strong></td>
                              <td><?php echo $usados+($viajero['cupos_solicitados']-$usados); 
							  
							  ?></td>
                              <td>&nbsp;</td>
                              <td><?php echo (($usados-$total_tc)*$totalmtk)+($total_tc*$viajero['vlr_tc'])+$penalidad; ?></td>
                              <td><?php echo "$".number_format(((($usados-$total_tc)*$totalmtk)+($total_tc*$viajero['vlr_tc'])+$penalidad)*$viajero['trm'],0); ?></td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
					</div>
                        </div>
                        </div>
                        </div>
                        </div>
    </body>
