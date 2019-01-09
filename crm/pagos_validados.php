<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	$cadena="";
	//var_dump($_REQUEST['validado']);
	if(isset($_REQUEST['validado'])){
	
	$registros = $_REQUEST['validado'];
	
	}
	
	foreach($registros as $validados) {
	$control->validarPago($validados);
	
	$pago= $control->consultarPago($validados);
	$cadena.="".$pago['fecha'].";".$pago['valor_TIK'];
}
	
?>
	
 
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">VALIDACIÓN DE PAGO</div>
					<div class="panel-body">
           				  <div class="module-body">
           				    <p>Se han validado los pagos</p>
           				    <button type="button" class="btn-xs btn-primary" onClick="location.href='pagos_validar.php'">VOLVER</button>
           				    <p>&nbsp;</p>
       				      <script type="text/javascript">
        $(function () {
			$('table').footable();

            $('.sort-column').click(function (e) {
                e.preventDefault();

                //get the footable sort object
                var footableSort = $('table').data('footable-sort');

                //get the index we are wanting to sort by
                var index = $(this).data('index');

                footableSort.doSort(index, 'toggle');
            });
        });
    </script></div>
           				</div>
                        </div>
                        </div>
                      
    </body>
