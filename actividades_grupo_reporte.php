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
					<div class="panel-heading">ACTIVIDADES VIAJERO</div>
					<div class="panel-body">
                    <div id="table_wrapper">
                     <button id="btnExport">Descargar</button>
                     
					  <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-pagination="false" data-sort-name="producto" data-sort-order="desc" class="table table-hover">
					    <thead>
					      <tr>
					        <th data-sortable="true"><strong>Nombres</strong></th>
					        <?php 
							
							$actividades=array();
							
							$resultado4=$control->consultaServicios($_REQUEST['grupo']);
							$totales = array();
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								if(($fi4['categoria'] != "TIQUETES")&&($fi4['categoria'] != "PROMOCION")&&($fi4['categoria'] != "GUIAS")&&($fi4['categoria'] != "OTROS")&&($fi4['categoria'] != "COMISIONES")){
							?>
                            
                            <th>
							<p style="writing-mode: tb-rl;"><?php 
							$actividades[]=$fi4;
							$totales[]=0;
							echo $fi4['nombre'];?></p></th>
                           
                            <?php
							}
							
							} ?>
                             <th>TK</th>
                            <th>PT</th>
					    
			            </thead>
					    <tr style="height:140px;">
					      <?php 
							
							$resultado=$control->viajeroActividades($_REQUEST['grupo']);
							 
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { if($fi['estado'] == 'VIAJA'){
							?>
					     
					      <td><p style="font-size:90%;width:100%;"><?php echo strtoupper($fi['nombres']);?> <?php echo strtoupper($fi['apellidos']);?></td>
					      <?php 
						
						 $n=0;
						 
						 foreach ($actividades as $ac){ 
						 
						
						 ?><td>
						
                         
                        
                         <?php $valida_actividad = $control->validarActividad($fi['id'],$ac['id']); 
						 
						 if($valida_actividad['poner']==1){
						 echo "X";
						 $totales[$n]++;
						 }else{
						 
					$f=$ac['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
				if($t==0 && $t!=''){
				if($valida_actividad['poner']==-1){	
				}else{
				 echo "X";
				$totales[$n]++;
				}
				}else{
					if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi['otro']){if($valida_actividad['poner']==-1){	
				}else{
				 echo "X";
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
                              <td>
                          
                          <?php $valortk= $control->valorViajeroTK($fi['otro'],$prospecto); 
						  
						  
						  $valorMtk= $control->consultarModificaciones($fi['id'],$prospecto['id'],'TK'); 
						  
						  //echo $valorMtk;
						  
						 ?>
                          
                          
      <?php   echo $prospecto['MONEDA']." ".($valortk+$valorMtk);?></td>
					     <td><?php $valorpt= $control->valorViajeroPT($fi['otro'],$prospecto); 
						  
						  
						  $valorMpt= $control->consultarModificaciones($fi['id'],$prospecto['id'],'PT'); 
						  
						  //echo $valorMtk;
						  
						 ?>
                          
                          
      <?php   echo $prospecto['MONEDA']." ".($valorpt+$valorMpt);?></td>
				        </tr>
                        <?php } } ?>
					    <tfoot>
					      <tr>
					      <td>TOTAL</td>
					      <?php 
						  $s=0;

						  foreach ($actividades as $ac){?>
					      <td><?php echo $totales[$s]; $s++; ?></td>
					      
                          <?php } ?>
                          <td>&nbsp;</td>
					      <td>&nbsp;</td>
				        </tfoot>
					    
				      </table>
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
	
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

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
