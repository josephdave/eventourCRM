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
            title: 'Inscritos por grupo',
            subtitle: 'Reporte de inscritos y pagos',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
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
					<div class="panel-heading">Informe de Ventas</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<div id="columnchart_material" style="width: 100%; height: 400px;"></div>
                        <!--    <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>-->
						</div>
					</div>
				</div>
			</div>
            <!--/.row-->
          
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
		</div><!--/.row-->
		</div>
		</div><!--/.row-->
		
		
								
	
                        </div>
    </body>
