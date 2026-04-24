<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
  $prospecto=$control->datosProducto($_REQUEST['id']);
	//
	 $info = $_REQUEST['info'];
	 if(isset($info)){
	$resultado=$control->registrarInfoActividad($info);
	
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3> REPORTE ACTIVIDADES</h3>
       				      
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
                             
				<div class="panel panel-default">  <?php 
							
								$resultado4=$control->consultaServicios($_REQUEST['id']);
							
							while ($fi4 = mysql_fetch_array($resultado4, MYSQL_ASSOC)) {
								
							?>
					<div class="panel-heading">  <?php echo $fi4['nombre'] ?> &nbsp;
<button id="btnExport<?php echo $fi4['id'] ?>">Descargar</button></div>
					<div class="panel-body">
                     <form method="post" action="reporte_actividades.php" >
                     <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>"/> 
                     <div id="table_wrapper<?php echo $fi4['id'] ?>">
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="contrato" data-sort-order="desc">
					        <thead>
					          <tr>
					            <th>SERVICIO</th>
					            <th><strong>NOMBRES</strong> </th>
				                <th><strong>APELLIDOS
                                </strong> </th>
				                <th><strong>EDAD</strong> </th>
			                    <th ><strong>FECHA </strong> </th>
                                <th >PROVEEDOR</th>
                                <th >INFORMACIÓN</th>
	                          </tr>
			                </thead>

					  <?php 
					  $viajeros=0;
							
							$resultado=$control->viajeroActividades($_REQUEST['id']);
							 
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) { if($fi['estado'] == 'VIAJA'){
								$va=false;
								
								$valida_actividad = $control->validarActividad($fi['id'],$fi4['id']);
								 
								if($valida_actividad['poner']==1){
									$va=true;
									
								}else if($valida_actividad['poner']==-1){
								
								$va=false;
								
								}else{
									
								
									$f=$fi4['tarifa'];
				$s=explode(";",$f);
				foreach ($s as $t){
					
					
				//var_dump($t);
						if($t>0){
				if($prospecto['nombre_tarifa'.$t] == $fi['otro']){
					$va=true;
					}
					
					

				
				}
				
				if($t==0 && $t!=""){
					$va=true;
					}
				}
								
								}
								if($va){
									
							?>
					        <tr>
					          <td><?php 
							  $viajeros++;
							  echo $fi4['nombre'];?></td>
					          <td><?php echo strtoupper($fi['nombres']);?></td>
					          <td><?php echo strtoupper($fi['apellidos']);?></td>
					          <td><?php echo $control->edad($fi['fnacimiento'],$_REQUEST['grupo']);?></td>
					          <td><?php echo $fi4['fecha'];?></td>
                               <td><?php echo $fi4['proveedor'];?></td>
                              <td class="remover" id="<?php echo  $valida_actividad['registro']; ?>">
                            
                              <input type="text" name="info[<?php echo $fi['id']?>-<?php echo  $fi4['id']; ?>]" id="info[<?php echo $fi['id']?>-<?php echo  $fi4['id']; ?>]" value="<?php echo  $valida_actividad['registro']; ?>"></td>
					          </tr>
					        <?php } } }?>
                            
                           
				          </table> 
                          Total de Asistentes a la activiad: <?php echo $viajeros; ?>                         
					</div>
					 <input type="submit" value="Guardar">
                          </form>  
                    </div>
                        
                    
                    <script>
							$(document).ready(function() {
  $("#btnExport<?php echo $fi4['id'] ?>").click(function(e) {
    e.preventDefault();
	var x = document.getElementsByClassName("remover");
var i;
for (i = 0; i < x.length; i++) {
    x[i].innerHTML = x[i].id;
}

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper<?php echo $fi4['id'] ?>');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
	

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});
							</script>
                    
                     <?php   } ?>                                                    
                       </div>
                                                                                   
                                
                                                                                    </div>
                             
           				  </div>
           				</div>
                        </div>
    </body>
