<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	setlocale(LC_TIME,"es_ES.UTF-8");
  $idgrupo = $_REQUEST['id'];
	//
	
	 $acomodaciones = $_REQUEST['acomodacion'];
  if(isset($acomodaciones)){
	$resultado=$control->registrarAcomodaciones($acomodaciones,$idgrupo);
}
?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>ACOMODACIÓN</h3>
       				      
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
					
					<div class="panel-body">
                     <div id="table_wrapper">
                       <form id="form1" name="form1" method="post" action="acomodacion.php">
                         <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>"/>
                      
					                 <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="apellidos" data-sort-order="asc" data-search="true">
					        <thead>
					          <tr>
					            <th data-sortable="true" data-field="posicion">POSICIÓN</th>
					            <th data-sortable="true" data-field="nombres"><strong>NOMBRES</strong> </th>
				                <th data-sortable="true" data-field="apellidos"><strong>APELLIDOS
                                </strong> </th>
				                <th ><strong>FECHA LLEGADA</strong> </th>
                                <th ><strong>FECHA REGRESO</strong> </th>
		                        
					            
					            
					            
					            
					            </tr>
			                </thead>

					       <?php 
							
							$resultado=$control->viajerosViajanRooming($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
							
	if($fi['record']==''){
$contrato=$control->sillaPrincipalPrograma($idgrupo);

	}else{
	$contrato=$control->datosContratoRecord($fi['record']);
	}
	
	

							?>
					        <tr>
					          <td>
                              <input type="text" name="acomodacion[<?php echo $fi['id'] ?>]" id="acomodacion[<?php echo $fi['id'] ?>]" width="30" value="<?php 
							  $acom=$control->acomodacion($fi['id']);
							  if($acom != null){
								  echo $acom['posicion'];
							  }
							  
							  
							  ?>"></td>
					          <td><?php echo strtoupper($fi['nombres']);?></td>
					          <td><?php echo strtoupper($fi['apellidos']);?></td>
					          <td><?php  echo strftime("%A, %d de %B  %H:%M", strtotime($contrato['fecha_salida']));?></td>
                              <td><?php  
							  
							 echo strftime("%A, %d de %B  %H:%M", strtotime($contrato['fecha_regreso']));
							  ?></td>
				            </tr>
					        <?php } ?>
                            
                           
				          </table> 
                          <input type="submit" value="Guardar">
                          <button type="button" class="btn-xs btn-primary" onClick="location.href='roominglist2.php?id=<?php echo $_REQUEST['id'] ?>'">ROOMING LIST</button>
                           </form>
                           
                                                    
					</div>
					</div>
                       </div>
                                                                                    </div>
                             <script>
							$(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
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
