<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 


	//error_reporting(0);
	
	
	if(isset($_REQUEST['borrar'])){
	
	
		
		$mensaje=$control->borrarProducto($_REQUEST['borrar']);
		
	
}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Grupo', 'Estimados','Inscritos', 'Con Pago']
		  
		  
		  
		   <?php 
							
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) == "GRUPOS JUVENILES"){		

if($fi['estado']!="RECHAZADO"){						
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
                            ,['<?php 
							
							$nom=str_replace("GIMNASIO","",str_replace("LICEO","",str_replace("COLEGIO","",strtoupper($fi['grupo']))));
							echo $nom;?>', <?php echo $fi['cant_viajeros'];
							  ?>, <?php echo $control->cantGrupo($fi['id']);
							  ?>, <?php echo $control->viajeroConPago($fi['id']);?> ]
							
							  
							  
                            <?php }} }?>
		  
          
         
         
        ]);

        var options = {
          chart: {
            title: 'UN JUVENIL',
            subtitle: 'Reporte de inscritos y pagos',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>

  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Grupo', 'Estimados','Inscritos', 'Con Pago']
		  
		  
		  
		   <?php 
							
							$resultado=$control->grupos();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
if(strtoupper( $fi['unidad_negocio']) != "GRUPOS JUVENILES"){		

if($fi['estado']!="RECHAZADO"){						
								$color_estado = $control->colorEstado($fi['estado']);
								
							?>
                            ,['<?php 
							
							$nom=str_replace("GIMNASIO","",str_replace("LICEO","",str_replace("COLEGIO","",strtoupper($fi['grupo']))));
							echo $nom;?>', <?php echo $fi['cant_viajeros'];
							  ?>, <?php echo $control->cantGrupo($fi['id']);
							  ?>, <?php echo $control->viajeroConPago($fi['id']);?> ]
							
							  
							  
                            <?php }} }?>
		  
          
         
         
        ]);

        var options = {
          chart: {
            title: 'PROGRAMAS RESTANTES',
            subtitle: 'Reporte de inscritos y pagos',
          }
        };

        var chart2 = new google.charts.Bar(document.getElementById('columnchart_material_2'));

        chart2.draw(data, options);
      }
    </script>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Panel Principal</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Panel de Administración</h1>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                <?php if( strpos($_SESSION['password'],"eventour") !== false){ echo "Debe renovar su contraseña para seguir utilizando el CRM<p><a href='http://eventoursport.travel/crm/cambiar_contra.php'>haga clic aqui para continuar</a></p>"; die();}?>
					<div class="panel-heading">CONTRATOS AEROLINEAS PRÓXIMOS</div>
					<div class="panel-body">
						<style>
							.table th{
								text-align: center;
							}
								.table td{
								text-align: center;
							}
						</style>
					  <table data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="false" data-search="false" data-select-item-name="toolbar1" data-pagination="false" class="table table-hover table-fixed" data-sort-name="disp" data-sort-order="desc" >
					    <thead>
					      <tr>
					        <th ><strong>Nombre</strong>
					          </td>
				            <th><strong>Record</strong> 
				            <th><strong>Cupos </strong> 
			                <th ><strong>Utilizados     </strong>                         
			                <th data-sortable="true" data-field="disp"><strong>Disponibles</strong>
							<th data-hide="all" data-visible="false"><strong>Destino</strong> 
		                    <th><strong>Total Tiquete</strong></th>
					        <th  data-hide="all" data-visible="false"><strong>Politica TC</strong></th>
					        <th  data-hide="all" data-visible="false"><strong>Vlr TC</strong></th>
					        <th ><strong>Fecha<br>Deposito</strong></th>
					        <th  data-hide="all" data-visible="false"><strong>Deposito xPAx</strong></th>
					        <th ><strong>Fecha<br>Cambios</strong></th>
					        <th ><strong>Fecha<br>Nombres</strong></th>
					        <th><strong>Fecha<br>Emision</strong></th>
					        <th  data-hide="all" data-visible="false"><strong>F<br>Impuestos</strong></th>
			            </thead>
					    <?php 
							  /////BLOQUE DE CALCULO DE FECHAS/////
							  
							  function diasDiferencia($fecha){
							  $date1 = date_create(date("d-m-Y", strtotime($fecha)));
							  if($date1 != null){
$date2 = date_create("now");

//difference between two dates
$diff = date_diff($date2,$date1);

//count days
$dias=$diff->format("%r%a");

//// FIN BLOQUE
							  }else{
								return -1;  
							  }
							  
							  return $dias;
							  }
							  
							  function colores($dias){
								if($dias < 5){
								return "#FF0000";
								}else if ($dias < 10){
								return "#FFFF00";
								}else if ($dias >= 10){
								return "#66FF00";
								}
							  }
							  ?>
					    <?php 
							
							
							$resultado=$control->cuposAereosFechas();
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
								
			//					$producto=$control->datosProducto($fi['id_grupo']);
								
								if($fi['estado']=='APROBADO'){
								
								
								
							?>
					    <tr>
					      <td><a href="detalle_aerolinea.php?id=<?php echo $fi['id'];?>"><?php echo strtoupper($fi['nombre']);?> - <?php echo strtoupper($fi['aerolinea']);?></a></td>
					      <td><?php echo strtoupper($fi['record']);?></td>
					      <td><?php echo $fi['cupos_solicitados'];?></td>
					      <td><?php 
							 
							 $usados=$control->cuposRecord($fi['id']);
							
							 
							 echo $usados;?></td>
					      <td><?php $cuposdisponibles=$fi['cupos_solicitados']-$usados;
									$col="#36BF06";
									if($cuposdisponibles<0){
										$col="#FF3200";
									}
									
									echo '<span  style="background:'.$col.' !important;padding: 3px;line-height: 26px;">'.$cuposdisponibles.'</span>';
							  		
							  ?></td>
					      <td><?php echo $fi['destino'];?></td>
					      <td><?php echo "$".$producto['MONEDA']." ". number_format(($fi['tadmin']*1.19)+$fi['neta_q']+$fi['q']+$control->impuestosRecord($fi['id']),0,',','.')?></td>
					      <td><?php echo strtoupper($fi['politica_tc']);?></td>
					      <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['vlr_tc'],0,',','.')?></td>
					      <td><?php echo date("d-m-Y", strtotime($fi['f_deposito']));
		$d=diasDiferencia(	$fi['f_deposito']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							 
							  
							  ?></td>
					      <td><?php echo "$".$producto['MONEDA']." ". number_format($fi['deposito_pax'],0,',','.')?></td>
					      <td><?php echo date("d-m-Y", strtotime($fi['f_cambios']));
							  
							  $d=diasDiferencia(	$fi['f_cambios']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							  ?></td>
					      <td><?php echo date("d-m-Y", strtotime($fi['f_nombres']));
							  $d=diasDiferencia(	$fi['f_nombres']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}

							 ?></td>
					      <td><?php echo date("d-m-Y ", strtotime($fi['f_emision']));
							    $d=diasDiferencia(	$fi['f_emision']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							  ?></td>
					      <td><?php echo date("d-m-Y", strtotime($fi['f_impuestos']));
							 $d=diasDiferencia(	$fi['f_impuestos']);	 
if($d >= 0){
echo '</br><span  style="background:'.colores($d).' !important;padding: 3px;line-height: 26px;">'.$d.' dias</span>';
}
							?></td>
				        </tr>
					    <?php }} ?>
				      </table>
					</div>
				</div>
				<div class="panel panel-default">
                <?php if( strpos($_SESSION['password'],"eventour") !== false){ echo "Debe renovar su contraseña para seguir utilizando el CRM<p><a href='http://eventoursport.travel/crm/cambiar_contra.php'>haga clic aqui para continuar</a></p>"; die();}?>
					<div class="panel-heading">Informe de Ventas</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							
							
							<div id="columnchart_material" style="width: 100%; height: 400px;"></div>
                        <!--    <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>-->
						</div>
						<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $control->panel1('GRUPOS JUVENILES'); ?></div>
							<div class="text-muted">Grupos Aceptados</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $control->panelA('GRUPOS JUVENILES'); ?></div>
							<div class="text-muted">Viajeros Estimados</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $control->panel2(); ?></div>
							<div class="text-muted">Viajeros Inscritos</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $control->viajeroConPago(0);
							?></div>
							<div class="text-muted">Viajeros con Pago</div>
						</div>
					</div>
				</div>
			</div>
		</div>
						<div class="canvas-wrapper">
							<div id="columnchart_material_2" style="width: 100%; height: 400px;"></div>
                        <!--    <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>-->
						</div>
					</div>
				</div>
			</div>
            <!--/.row-->
          
          <!--/.row-->
		</div>
		</div><!--/.row-->
		
		
								
	
                        </div>
    </body>
