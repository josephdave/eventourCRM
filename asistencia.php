<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
 $id_grupo = $_REQUEST['grupo'];
 $vouchers=$_REQUEST['voucher'];
 $fvouchers=$_REQUEST['fvoucher'];
  $vlr_diario=$_REQUEST['vlr_diario'];
 $facvouchers=$_REQUEST['facvoucher'];
 
 //var_dump($vouchers);
if(isset($vouchers)){
	$resultado=$control->registrarVouchers($vouchers);
	$resultado=$control->registrarFVouchers($fvouchers);
$resultado=$control->registrarVlrDiario($vlr_diario);

	$resultado=$control->registrarFacVouchers($facvouchers);
}

$prospecto=$control->datosProducto($id_grupo);
?>

    <script type="text/javascript" src="programas/accordion.js"></script>
   

      
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">ASISTENCIA <?php echo $prospecto['grupo'];?> <a href="asistencia_copy.php?grupo=<?php echo $id_grupo?>" target="_blank">(ver reporte)</a></div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						 
	
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                            <h2><?php echo $prospecto['grupo']; ?></h2>
                            <button id="btnExport">Descargar</button>
                            <form id="form1" name="form1" method="post" action="asistencia.php">
                            <div id="table_wrapper">
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="programa" data-sort-order="desc" data-show-columns="true" data-search="true" class="table table-" >
           				      <thead>
   				              <tr>
   				                <th data-sortable="true" data-field="programa">Programa</th>
       				            <?php if($_REQUEST['grupo'] == 0){?>
         				          <?php } ?>
         				          <th><strong>Documento</strong></th>
         				          <th><strong>Nombres<br>
         				          </strong></th>
         				          <th style="width:40px !important" >Edad</th>
         				          <th data-hide="all" data-visible="false" ><strong>F Nacimiento</strong></th>
         				          <th data-sortable="true" data-field="fin"  data-hide="all" data-visible="false">FECHA IN</th>
         				          <th data-sortable="true" data-field="fout" data-hide="all" data-visible="false">FECHA OUT</th>
         				          <th >Dias</th>
         				          <?php if($_REQUEST['grupo'] != 8){?>
         				          <?php }else{ ?>
         				          <?php } ?>
         				          <th ><strong>Voucher</strong></th>
         				          <th >VALOR DIARIO</th>
         				          <th >Total USD</th>
         				          <th >TRM</th>
         				          <th >TOTAL COP</th>
                                    <th ><strong>Fecha Emision Voucher</strong></th><th ><strong>Factura Voucher</strong></th>
                                </thead>
                             
       				                                          <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							$grant_total_usd=0;$grant_total_cop=0;
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { 
							
							$prd=$control->datosProducto($fi['id_grupo']);
							
							if(strpos($prd['parametros'],'sinasistencia')!== false){
							}else{
							if($fi['id']!=141 && date('Y', strtotime($fi['f_salida'])) != 2020 ){
							?>
       				                                          <?php if($_REQUEST['grupo'] == 0){?>
       				                                          <?php } ?>
                                                               <tr>
                                <td><?php echo strtoupper($control->nomGrupoSimple($fi['id_grupo']));
															  
															  $programa = $control->datosProducto($fi['id_grupo']);?></td>
       				                                          <td><?php echo $fi['documento'];?> <a href="registrar_pago.php?doc=<?php echo $fi['no_documento'];?>" target="_blank"><?php echo $fi['no_documento'];?></a><br/>
       				                                           </td>
       				                                          <td><?php echo strtoupper($fi['nombres']);?> <?php echo strtoupper($fi['apellidos']);?></td>
       				                                          <td><?php echo $control->edad($fi['fnacimiento'],$fi['id_grupo']);?></td>
       				                                          <td><?php echo $fi['fnacimiento'];?></td>
       				                                          <td id="<?php echo $control->voucher($fi['id']);?>"><?php 
															  
															  if($fi['record']!=''){
																  $rec=$control->datosContratoRecord($fi['record']);
																  
																  echo
date_format(date_create($rec['fecha_salida']),"d-m-Y");
$fecha_INOK=$rec['fecha_salida'];
																  
																  }else{
																   echo date_format(date_create($fi['f_salida']),"d-m-Y");
																   $fecha_INOK=$fi['f_salida'];
																   }?></td>
       				                                          <td id="<?php echo $control->voucher($fi['id']);?>"><?php if($fi['record']!=''){
																  $rec=$control->datosContratoRecord($fi['record']);
																  
																  echo date_format(date_create($rec['fecha_regreso']),"d-m-Y");
																  $fecha_OUTOK=$rec['fecha_regreso'];
																  }else{
																	  echo date_format(date_create($fi['f_llegada']),"d-m-Y");
																	  $fecha_OUTOK=$fi['f_llegada'];
																	  }?></td>
       				                                          <td ><?php 
															    $salida = new DateTime($fecha_INOK);
					$llegada = new DateTime($fecha_OUTOK);
					
     $datediff = strtotime($fi['f_llegada'])- strtotime($fi['f_salida']);
     $dias= floor($datediff/(60*60*24))+1;
	 
	 echo $dias;
															  ?></td>
       				                                          <?php if($_REQUEST['grupo'] != 8){?>
       				                                          <?php } else{ ?>
       				                                          <?php } ?>
                                                             <?php $datos_voucher=$control->datosVoucher($fi['id']);?>
       				                                          <td class="remover" id="<?php echo $datos_voucher['voucher']?>"><input name="voucher[<?php echo $fi['id']?>]" type="text" id="voucher[<?php echo $fi['id']?>]" size="30" value="<?php echo $control->voucher($fi['id']);?>">
   				                                              </td>
       			
                <?php $vlr_d= $datos_voucher['vlr_diario'];
				
				if($vlr_d==''){
				$vlr_d = 2.5;
				}
				if($control->voucher($fi['id']) == ''){
					$vlr_d=0;
					}?>	                                           <td class="remover" id="<?php echo $vlr_d?>"><input name="vlr_diario[<?php echo $fi['id']?>]" type="text" id="vlr_diario[<?php echo $fi['id']?>]" size="10" value="<?php echo $vlr_d?>">
   				                                              </td>
       				                                          <td><?php 
															  
	if($control->voucher($fi['id']) == ''){
	echo $total_usd=0;
	}else{echo $total_usd=$vlr_d*$dias;
	}
															  $grant_total_usd=$grant_total_usd+$total_usd;
															   ?></td>
       				                                          <td><?php
															  
	$trm=mysql_fetch_row($control->dolar($datos_voucher['fecha_emision']));
	//var_dump($trm);
												  
				echo $trm[0];
															  ?></td>
       				                                          <td ><?php echo $total_usd*$trm[0];
															  $grant_total_cop=$grant_total_cop+($total_usd*$trm[0]); ?></td>
                                                              <td class="remover" id="<?php echo $datos_voucher['fecha_emision']?>"><input name="fvoucher[<?php echo $fi['id']?>]" type="date" id="fvoucher[<?php echo $fi['id']?>]" size="30" value="<?php echo $datos_voucher['fecha_emision'];?>">
   				                                              </td>
                                                               <td class="remover" id="<?php echo $datos_voucher['factura'];?>"><input name="facvoucher[<?php echo $fi['id']?>]" type="text" id="facvoucher[<?php echo $fi['id']?>]" size="30" value="<?php echo $datos_voucher['factura'];?>">
   				                                              </td>
                              </tr>
           				      <?php
							  
							}
							}
							
							} ?>
       				        </table>
                            <p><strong>Total USD: <?php echo $grant_total_usd?> - Total COP: <?php echo $grant_total_cop?></strong></p>
                            </div>
                            <p>
                              <input type="submit" name="submit" id="submit" value="Registrar">
                              <input name="grupo" type="hidden" id="grupo" value="<?php echo $id_grupo ?>">
                            </p>
                            </form>
           				  </div>
           				</div>
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
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}


    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
	
   var table_html = table_div.outerHTML.replaceAll(' ', '%20');
	var table_html = table_html.replaceAll('#', '');
	  var table_html = table_html.replace(/USD\$/g, '');
	var table_html = table_html.replace(/COP\$/g, '');
//	

	  var table_html = table_html.replaceAll('.', ',');
var table_html = table_html.replaceAll(',', ',');	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>
                        
    </body>
