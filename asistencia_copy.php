<html>
<head>
<meta charset="utf-8">
<meta lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<?php 
require_once("config.php");
require_once("control/control.php");
$control = new Control();

	//error_reporting(0);
 $id_grupo = $_REQUEST['grupo'];
 $vouchers=$_REQUEST['voucher'];
 
 
 
 //var_dump($vouchers);
if(isset($vouchers)){
	$resultado=$control->registrarVouchers($vouchers);
}
 $num=1;
?>

    <script type="text/javascript" src="programas/accordion.js"></script>
     <button id="btnExport">Descargar</button>
 <div id="table_wrapper">
     <table border="1" bordercolor="#000000" cellpadding="5px" cellspacing="0" id="list"  >
           				      <thead>
   				              <tr>
   				                <th>No.</th>
   				                <th>Grupo</th>
       				            <?php if($_REQUEST['grupo'] == 0){?>
         				          <?php } ?>
         				          <th><strong>Apellidos</strong></th>
         				          <th><strong>Nombres</strong></th>
         				          <th >Tipo ID</th>
         				          <th >ID Number</th>
         				          <th ><strong>F Nacimiento</strong></th>
         				          <th >Telefono</th>
         				          <th >Correo</th>
         				          <th >Fecha Salida</th>
         				          <th >Fecha Regreso</th>
         				          <?php if($_REQUEST['grupo'] != 8){?>
         				          <?php }else{ ?>
         				          <?php } ?>
         				          </thead>
                              <tr>
                                
       				                                          <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) 
							{
							//var_dump($fi);	
					 $programa = $control->datosProducto($fi['id_grupo']);
							if( ($control->voucher($fi['id'])) == null && $programa['estado']== 'ACEPTADO' ){
									if(strpos($programa['parametros'],'sinasistencia')!== false){
							}else{
							
						
								
								$pagos=$control->pagosNITsinvalidar($fi['facturacion_nodocumento']);
									//	var_dump($pagos);
								$hapagado=$pagos['pagosTIK']+$pagos['pagosPT'];
								if($hapagado > 0 && $fi['estado']== 'VIAJA'){
							
							?>
       				                                          <?php if($_REQUEST['grupo'] == 0){?>
       				                                          <?php } ?>
                                                              <td><?php echo $num; $num++;?></td>
                                                              <td><?php echo strtoupper($control->nomGrupoSimple($fi['id_grupo']));
															  
															  $programa = $control->datosProducto($fi['id_grupo']);?></td>
       				                                          <td><?php echo strtoupper($fi['apellidos']);?></td>
       				                                          <td><?php echo strtoupper($fi['nombres']);?></td>
       				                                          <td><?php echo $fi['documento'];?></td>
       				                                          <td><?php echo $fi['no_documento'];?></td>
       				                                          <td><?php echo date_format(date_create($fi['fnacimiento']),"d-m-Y");?></td>
       				                                          <td>+57 (2) 660 4000</td>
       				                                          <td>soporte@eventours.travel</td>
       				                                          <td>
															  <?php if($fi['record']!=''){
																  $rec=$control->datosContratoRecord($fi['record']);
																  
																  echo
date_format(date_create($rec['fecha_salida']),"d-m-Y");
																  
																  }else{
																   echo date_format(date_create($programa['f_salida']),"d-m-Y");}?></td>
       				                                          <td>  <?php if($fi['record']!=''){
																  $rec=$control->datosContratoRecord($fi['record']);
																  
																  echo date_format(date_create($rec['fecha_regreso']),"d-m-Y");}else{
																	  echo date_format(date_create($programa['f_llegada']),"d-m-Y");}?></td>
       				                                          <?php if($_REQUEST['grupo'] != 8){?>
       				                                          <?php } else{ ?>
       				                                          <?php } ?>
                              </tr>
           				      <?php 
								}
							}} }?>
       				        </table>
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
    </body>
