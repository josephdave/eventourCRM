<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

if(isset($_REQUEST['viajero'])){
	
	if(isset($_REQUEST['actividad_check'])){
	$check = 1;
	}else{
	$check = -1;
	}
$mensaje=$control->checkActividad($_REQUEST['viajero'],$_REQUEST['actividad'],$check);


$mensaje=$control->registrarModificacionServicio($_REQUEST['grupo'],$_REQUEST['viajero'],$_REQUEST['actividad'],$check);

}


$prospecto=$control->datosProducto($_REQUEST['grupo']);

?>
<style>

.table-area {
 
}
	.fixed-table-header-columns{
		
	}
	.fixed-table-container{
		 height: 500px;

	}
	
table.responsive-table {
 height: 500px;
}

table.responsive-table thead {
 
}

table.responsive-table th {
  background: #eee;
}

table.responsive-table td {
  line-height: 2em;
}

table.responsive-table tr > td,
table.responsive-table th {
  text-align: left;
}

</style>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
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
					<div class="panel-heading">LIQUIDACION POR VIAJERO</div>
					<div class="panel-body">
                    <div id="table_wrapper">
                     <button id="btnExport">Descargar</button>
                     <div style="width: 100%;overflow-x: auto;
	white-space: nowrap;height: 500px;" class="table-area">
					  <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover responsive-table"
							  data-fixed-columns="true" 
       data-fixed-number="1" 
							
							 >
					    <thead>
					      <tr style="position: absolute">
					        <th data-sortable="true" width="300px"><strong>Nombres</strong><br>
				            &nbsp;</th>
					        <?php 
							
							$actividades=array();
							
							$resultado4=$control->consultaServicios($_REQUEST['grupo']);
							$totales = array();
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								//if(($fi4['categoria'] != "TIQUETES")&&($fi4['categoria'] != "PROMOCION")&&($fi4['categoria'] != "GUIAS")&&($fi4['categoria'] != "OTROS")&&($fi4['categoria'] != "COMISIONES")){
								if(( $fi4['costo'] != 0)){
							?>
                            
                            <th>
								<!-- style="writing-mode: tb-rl;" -->
							<p ><?php 
							$actividades[]=$fi4;
							$totales[]=0;
							$pieces = explode(" ", $fi4['nombre']);
							$first_part = implode(" ", array_splice($pieces, 0, 4));
							//echo  $first_part;
								//	var_dump($fi4);
								$proveedor=$control->datosProveedor($fi4['proveedor_id']);
								//	var_dump($proveedor);
									
								echo "<b>".$fi4['nombre']."</b><br/>".$proveedor['nombre']." ".$proveedor['razonsocial']." <br/>".$proveedor['rut'];
								?></p></th>
                              <?php
							}
							
							} ?>
							  <th>Costo Total<br></th>
                           
                            <th>Pagos Viajero PT</th>
                            <th>Valor Programa TK</th>
                            <th>Valor Programa PT</th>
                            <th>TOTA PROGRAMA</th>
                            <th>Utilidad</th>
                            <th>Margen</th>
					    
		                </thead>
						  <tbody>
					    <tr style="height:140px;">
					      
					      <?php 
							
							$resultado=$control->viajeroActividades($_REQUEST['grupo']);
							
							$costototal=0;
							$pagosViajeros=0;
							$valorPTtotal=0;
							$valorTKtotal=0;
							$num_viajero = 0;
							$max=30;
							$min=0;
							
							if(isset($_REQUEST['pag'])){
								$min=(($_REQUEST['pag']-1)*($max));
								var_dump($min);
								$max=$_REQUEST['pag']*$max;
								var_dump($max);
								
							}
							
							
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { 
								
								//var_dump($fi);
								$num_viajero++;
								if($fi['estado'] == 'VIAJA' && $num_viajero < $max && $num_viajero>=$min){
									
									
							?>
					     
					      <td><p style="font-size:90%;width:100%;"><strong><?php echo strtoupper($fi['nombres']);?></strong> <strong><?php echo strtoupper($fi['apellidos']);?></strong>
							  
							  <!--<br>
				          <?php echo strtoupper($fi['otro']);?>		-->			      </td>
					      <?php 
						
						 $n=0;
						 $total_costo=0;
						 foreach ($actividades as $ac){ 
						// var_dump($ac);
						
						 ?><td>
						
                         
                        
                         <?php //$valida_actividad = $control->validarActividad($fi['id'],$ac['id']); 
							 
							//var_dump("viajeros ".$control->contarViajerosActividad($ac['id']));
							 
							 
							 
							   $total_usuarios=0;
							  
							  	$resultado23=$control->viajeroActividades($_REQUEST['grupo']);
							 $valida_actividad_real=null;
							 
							while ($fi3 = mysql_fetch_array($resultado23, MYSQL_ASSOC)) { if($fi3['estado'] == 'VIAJA'){
								
								
								$va=false;
								
								$valida_actividad = $control->validarActividad($fi3['id'],$ac['id']);
								
								if( $fi3['id']==$fi['id']){
									$valida_actividad_real = $valida_actividad;
								}
								
							//	var_dump($valida_actividad);
								 
								if($valida_actividad['poner']==1){
									$va=true;
									
								}else if($valida_actividad['poner']==-1){
								
								$va=false;
								
								}else{
									
								
									$f=$ac['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
					
					
				//var_dump($t);
						if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi3['otro']){
					$va=true;
					}
					
					

				
				}
				
				if($t==0 && $t!=""){
					$va=true;
					}
				}
								
								}
								
								if($va){
									$total_usuarios++;
								}
							}
							}
							 $valida_actividad=$valida_actividad_real;
						
							 $viajeros_actividad=$total_usuarios;
						// var_dump($viajeros_actividad);	 
							 
							// $pagado=$control->calcularCostoIndividual($ac,$viajeros_actividad,0);
							 $pagado = $ac['facturado']/$viajeros_actividad;
						// var_dump($pagado);
						 if($valida_actividad['poner']==1){
						// echo $ac['costo'];
							 echo "".number_format($pagado,2);
							 $total_costo=$total_costo+$pagado;
						 $totales[$n]++;
						 }else{
						 
					$f=$ac['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
				if($t==0 && $t!=''){
				if($valida_actividad['poner']==-1){	
					echo "0";
				}else{
				 	  echo "".number_format($pagado,2);
							 $total_costo=$total_costo+$pagado;
				$totales[$n]++;
				}
				}else{
					if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi['otro']){
					
					if($valida_actividad['poner']==-1){	
						echo "0";
				}else{
					//	var_dump($va);
					 echo "".number_format($pagado,2);
							 $total_costo=$total_costo+$pagado;
				$totales[$n]++;
				}
					}

				
				}
					
				
				}
					
				}
						 
						 
						 
						 }
						 
						 ?>
                         
                         
						 
						 <?php 
						 
				
						
							$n++;
							?> 
                         
                      
                         </td>
							<?php } ?>
					      <td><?php   
								$costototal+=$total_costo;
								echo "".number_format($total_costo,0,",","");?></td>
					
                          <td><?php $valorpt= $control->pagosViajero($fi['id']); 
							$cnt= $control->cantidadViajerosNit($fi['id']); 
								
								$valorpt['viajeros']=$cnt['viajeros'];
						 // echo $valorpt['viajeros']."-";
						 
								$valorpt['pagosPT']=$valorpt['pagosPT']/$valorpt['viajeros'];
							?>
                                
                                
                         <a href="registrar_pago.php?doc=<?php echo $fi['id'] ?>" target="_blank"> <?php   
								$pagosViajeros+=$valorpt['pagosPT'];
								echo "".number_format($valorpt['pagosPT'],0,",","");?></a></td>
                          <td> 
							  
							  
							  <?php $valorTk= $control->valorViajeroTK($fi['otro'],$prospecto);?>
                            <?php $valorMtk= $control->consultarModificaciones($fi['id'],$prospecto['id'],'TK');?>
							  <?php
									
							echo "".number_format(($valorTk+$valorMtk),0,",","");
							  $valorTKtotal+=$valorTk+$valorMtk;?>
						  
						  </td>
                          <td>
							  <?php $valorPt= $control->valorViajeroPT($fi['otro'],$prospecto);?>
                            <?php $valorMpt= $control->consultarModificaciones($fi['id'],$prospecto['id'],'PT');?>
                          <?php
									
							echo "".number_format(($valorPt+$valorMpt),0,",","");
							  $valorPTtotal+=$valorPt+$valorMpt;?>
							
							</td>
                          <td><?php
									$totalPrecioPrograma= $valorPt+$valorMpt+$valorTk+$valorMtk;
							echo "".number_format(($totalPrecioPrograma),0,",","");
							?></td>
                          <td><?php   echo "".number_format($totalPrecioPrograma-$total_costo,1);?></td>
                          <td><?php   echo " ".number_format((($totalPrecioPrograma -$total_costo)/$totalPrecioPrograma)*100,2,",","")."%";?></td>
				        </tr>
                        <?php } } ?>
						  </tbody>
						  
						  <!--
					    <tfoot>
					      <tr>
					        <td>TOTAL</td>
					      <?php 
						  $s=0;

						  foreach ($actividades as $ac){?>
					      <td><?php echo $totales[$s]; $s++; ?></td>
					      <?php } ?>
							  <td><?php   echo " ".number_format($costototal,0);?></td>
					      
                          <td><?php   echo " ".number_format($pagosViajeros,0);?></td>
                          <td><?php   echo " ".number_format($valorTKtotal,0);?></td>
                          <td><?php   echo " ".number_format($valorPTtotal,0);?></td>
                          <td><?php 
							  $valorPROGRAMAtotal=$valorTKtotal+$valorPTtotal;
							  echo " ".number_format($valorPROGRAMAtotal,0);?></td>
                          <td><?php   echo " ".number_format($pagosViajeros-$costototal,0);?></td>
                          <td><?php   echo " ".number_format((($pagosViajeros-$costototal)/$pagosViajeros)*100,2,",","")."%";?></td>
			            </tfoot>
					    -->
				      </table>
						
						</div>
						<?php if(!isset($_REQUEST['pag'])){?> 
						 <a href="liquidacion_viajero.php?grupo=<?php echo $prospecto['id'];?>&pag=2">Siguiente></a>
						<?php }else{ ?>
						 <a href="liquidacion_viajero.php?grupo=<?php echo $prospecto['id'];?>&pag=<?php ($_REQUEST['pag']+1); ?>">Siguiente></a>
						<?php } ?>
                      </div>
                      <h2>&nbsp;</h2>
                      <p>
                        <?php 						 // var_dump($totales); ?>
                      </p>
                      <p>&nbsp;</p>
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

	//var toolbar= document.getElementsByClassName("fixed-table-toolbar");
	//toolbar.item(0).innerHTML="";
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
  
  $("#btnExport2").click(function(e) {
    e.preventDefault();
var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

//	var toolbar= document.getElementsByClassName("fixed-table-toolbar2");
	//toolbar.item(0).innerHTML="";
    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper2');
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

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
