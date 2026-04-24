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
				                <th>PAGOS TK</th>
				                <th>FORMATO</th>
				                <th><strong>ORIGEN</strong> </th>
			                    <th><strong>DESTINO</strong> </th>
			                    <th >ADT                               </th>
			                    <th >CHD                                </th>
			                    <th >RECORD</th>
		                        <th ><strong>FECHA VIAJE</strong> </th>
		                        
					            
					            
					            
					            
					            </tr>
			                </thead>

					        <?php 
							
							
							$resultado=$control->viajerosRecord($_REQUEST['id']);
							$n=1;
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								
								
							?>
					        <tr>
					          <td><?php echo $n++; ?></td>
					          <td><?php  $producto=$control->datosProducto($fi['id_grupo']);
							  echo strtoupper($producto['grupo']);?></td>
					          <td><?php 
							 
							  $nombres=explode(" ",$fi['nombres']);
							  echo strtoupper($control->tildes($fi['nombres']));?></td>
					          <td><?php 
							  $apellidos=explode(" ",$fi['apellidos']);
							  echo strtoupper($control->tildes($fi['apellidos']));?></td>
					          <td><?php 
								  $pagos=$control->pagosViajero($fi['idviajero']);
							//	var_dump($pagos);
									echo $pagos['pagosTIK'];echo $fi['control'];
								 if(strpos(strtoupper($fi['otro']),"STAFF")!== false)
								{
								   echo "<br/>STAFF";
								}
								  ?></td>
					          <td>NM
				              1 <?php 
							  $apellidos=explode(" ",$fi['apellidos']);
							  echo strtoupper($control->tildes($fi['apellidos']));?>/<?php 
							  $nombres=explode(" ",$fi['nombres']);
							  echo strtoupper($control->tildes($fi['nombres']));
							  
							  // Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.genderize.io/?name='.$nombres[0],
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$datos=json_decode($resp);

$genero=$datos->{'gender'};

echo "MR";
if($genero=='female'){
echo "S";
}
							  
							  
							  ?></td>
					          <td><?php echo $contrato['origen'];?></td>
					          <td><?php echo $contrato['destino'];?></td>
					          <td><?php $ed=$control->edad($fi['fnacimiento'],$fi['id_grupo']);
							  if($ed > 12){
							  echo "X";
							  }
							  
							  ?></td>
					          <td><?php 
							  							  if($ed <= 12){
							  echo "X";
							  }
							  ?></td>
					          <td><?php echo $contrato['record'];?></td>
					          <td><?php echo $contrato['fecha_salida'];?></td>
				            </tr>
					        <?php } ?>
                            
                            <?php 
							
							
							$resultado=$control->viajerosPrincipal($_REQUEST['id']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
								
								
							?>
					        <tr>
					          <td><?php echo $n++; ?></td>
					          <td><?php  $producto=$control->datosProducto($fi['id_grupo']);
							  echo strtoupper($producto['grupo']);?></td>
					          <td><?php 
							 $nombres=explode(" ",$fi['nombres']);
							  echo strtoupper($control->tildes($fi['nombres']));?></td>
					          <td><?php 
							  $apellidos=explode(" ",$fi['apellidos']);
							  echo strtoupper($control->tildes($fi['apellidos']));?></td>
					          <td><?php 
								//var_dump($fi);
								  $pagos=$control->pagosViajero($fi['idviajero']);
								//var_dump($pagos);
									echo $pagos['pagosTIK'];
								if(strpos(strtoupper($fi['otro']),"STAFF")!== false)
								{
								   echo "<br/>STAFF";
								}?></td>
								
					          <td>NM1 <?php 
							  $apellidos=explode(" ",$fi['apellidos']);
							  echo strtoupper($control->tildes($fi['apellidos']));?>/<?php 
							  $nombres=explode(" ",$fi['nombres']);
							  echo strtoupper($control->tildes($fi['nombres']));
							  
							  // Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.genderize.io/?name='.$nombres[0],
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$datos=json_decode($resp);

$genero=$datos->{'gender'};

echo "MR";
if($genero=='female'){
echo "S";
}
							  
							  
							  ?></td>
					          <td><?php echo $contrato['origen'];?></td>
					          <td><?php echo $contrato['destino'];?></td>
					          <td><?php $ed=$control->edad($fi['fnacimiento'],$fi['id_grupo']);
							  if($ed > 12){
							  echo "X";
							  }
							  
							  ?></td>
					          <td><?php 
							  							  if($ed <= 12){
							  echo "X";
							  }
							  ?></td>
					          <td><?php echo $contrato['record'];?></td>
					          <td><?php echo $contrato['fecha_salida'];?></td>
				            </tr>
					        <?php } ?>
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
