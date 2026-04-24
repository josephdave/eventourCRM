<?php include('logged.php'); ?>
<?php include 'layout/header2.php' ?>
<?php

//error_reporting(0);

setlocale(LC_TIME, "es_ES.UTF-8");
$idgrupo = $_REQUEST['id'];

$tiquetes = $_REQUEST['tiquete'];
$records = $_REQUEST['record_emitido'];
if (isset($tiquetes)) {
	$resultado = $control->registrarTiquetes($tiquetes);
	$resultado = $control->registrarRecords($records);
}
//
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">



	<h3> REPORTE SILLAS</h3>

	<div class="module-body">
		<!--     
           				  <p><a href="insc.php?grupo=0">Ver Todos </a><br>
           				  </p>
           				  <form name="form1" method="post" action="busqueda.php">
           				    <label for="termino"></label>
           				    Busqueda General:
           				    <input type="text" name="termino" id="termino" ><input name="Submit" type="submit" value="Consultar">
         				    </form>
           				  <p>&nbsp; </p>-->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">CONTRATO AEROLINEA <button id="btnExport">Descargar</button></div>
				<div class="panel-body">

					<form method="post" action="reporte_sillas.php">
						<input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>" />
						<div id="table_wrapper">
							<table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="contrato" data-sort-order="desc">
								<thead>
									<tr>
										<th data-sortable="true" data-field="contrato">CONTRATO</th>
										<th>AEROLINEA</th>
										<th>RECORD</th>
										<th><strong>NOMBRES</strong> </th>
										<th><strong>APELLIDOS
											</strong> </th>
										<th>TIQUETE</th>
										<th>RECORD EMITIDO</th>
										<th><strong>ORIGEN</strong> </th>
										<th data-sortable="true" data-field="vllegada">VUELO LLEGADA</th>
										<th data-sortable="true" data-field="fllegada"><strong>FECHA LLEGADA</strong> </th>
										<th data-sortable="true" data-field="vregreso">VUELO REGRESO</th>
										<th data-sortable="true" data-field="fregreso"><strong>FECHA REGRESO</strong> </th>





									</tr>
								</thead>

								<?php

								$resultado = $control->viajerosViajanRecord($_REQUEST['id']);
								while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {


									if ($fi['record'] == '') {
										$contrato = $control->sillaPrincipalPrograma($idgrupo);
									} else {
										$contrato = $control->datosContratoRecord($fi['record']);
									}



								?>
									<tr>
										<td><a href="detalle_aerolinea.php?id=<?php echo $contrato['id']; ?>" target="_blank"><?php echo $contrato['nombre']; ?></a></td>
										<td><?php echo $contrato['aerolinea']; ?></td>
										<td><?php echo $contrato['record']; ?></td>
										<td><?php echo strtoupper($fi['nombres']); ?></td>
										<td><?php echo strtoupper($fi['apellidos']); ?></td>
										<td class="remover" id="<?php echo  $fi['tiquete']; ?>">

											<input type="text" name="tiquete[<?php echo $fi['id'] ?>]" id="tiquete[<?php echo $fi['id'] ?>]" value="<?php echo  $fi['tiquete']; ?>">
										</td>
										<td class="remover" id="<?php echo  $fi['record_emitido']; ?>">

											<input type="text" name="record_emitido[<?php echo $fi['id'] ?>]" id="record_emitido[<?php echo $fi['id'] ?>]" value="<?php echo  $fi['record_emitido']; ?>">
										</td>
										<td><?php echo $contrato['origen']; ?></td>
										<td><?php echo $contrato['vuelo_llegada_destino']; ?></td>
										<td><?php echo strftime("%A, %d de %B  %H:%M", strtotime($contrato['fecha_salida'])); ?></td>
										<td><?php echo $contrato['vuelo_llegada_origen']; ?></td>
										<td><?php

											echo strftime("%A, %d de %B  %H:%M", strtotime($contrato['fecha_regreso']));
											?></td>
									</tr>
								<?php } ?>



							</table>
						</div>
						<input type="submit" value="Guardar">
					</form>

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
			});
		</script>
	</div>
</div>
</div>
</body>