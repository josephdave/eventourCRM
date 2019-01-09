<?php
require_once("config.php");
require_once("control/control.php");
setlocale(LC_TIME, "es_ES");
$control = new Control();
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EventourCRM - Listado de Colegios</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/bootstrap-table-fixed-columns.css" rel="stylesheet">

<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>

<script src="js/clipboard.min.js" type="text/javascript"></script> 
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<!--<script src="js/chart-data.js"></script>-->
	<!--<script src="js/easypiechart.js"></script>-->
	<!--<script src="js/easypiechart-data.js"></script>-->
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js?v=4"></script>
    <script src="js/bootstrap-table-fixed-columns.js"></script>
    <!--<script src="js/bootstrap-table-filter-control.js"></script>-->
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
        
        
        
         <script src="scripts/jquery.validate.js"></script>
         <script src="combodate.js"></script>
         
         
        
	
	<script src="js/bootstrap-tab.js" type="text/javascript"></script>
    <script src="js/demos.js" type="text/javascript"></script>
           <link rel="stylesheet" href="chosen.min.css">
<script src="chosen.jquery.min.js" type="text/javascript"></script>

<script src="js/bootstrap-tab.js" type="text/javascript"></script>
 <script src="js/demos.js" type="text/javascript"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
            <script>
			function togglebar(){
				document.getElementsByClassName('main').item(0).setAttribute("style","width:100%;margin-left:0");
				
			}
			
			</script>
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse" onClick="togglebar()">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Eventour®</span>CRM</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $control->nombreUsuario($_SESSION['id']); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							
							<li><a href="cambiar_contra.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Cambiar contraseña</a></li>
                            <li><a href="index.php?salir=1"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Salir</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		<?php if($_SESSION['id'] != "" && strpos(strtolower($_SESSION['password']),"eventour") === false){?>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<!--		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar">
			</div>
		</form>-->
        
		<ul class="nav menu">
           
			<li><a href="dashboard.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Inicio</a></li>
            <li class="parent ">
			  <a href="#">
					<span data-toggle="collapse" href="#sub-item-0" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use>
					</svg> Proveedores</a> </a>
                    <ul class="children collapse" id="sub-item-0">
               <li class="active"> <a class="" href="proveedores.php"> <svg class="glyph stroked table">
                        <use xlink:href="#stroked-table"></use>
                      </svg>
                      Ver Proveedor</a></li>
                      <li class="active"> <a class="" href="registrar_pago_proveedor.php"> <svg class="glyph stroked table">
                        <use xlink:href="#stroked-table"></use>
                      </svg>
                      Pago a Proveedor</a></li>
						<?php if($_SESSION['nivel'] == "10"){?>
					<li>
						<a class="" href="pagos_proveedores_validar.php">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Validar Pagos Proveedores
						</a></li>
                        <?php } ?>
						  <li class="active"> <a class="" href="pagos_proveedores.php"> <svg class="glyph stroked table">
                        <use xlink:href="#stroked-table"></use>
                      </svg>
                     Ver Pagos</a></li>
                    </ul>
			</li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use>
					</svg> Preparación</a> </a>
                    <ul class="children collapse" id="sub-item-1">
                      <li class="active"> <a class="" href="gruposprospecto.php"> <svg class="glyph stroked table">
                        <use xlink:href="#stroked-table"></use>
                      </svg> Ver Prospectos</a> </li>
                       <li class="active"> <a class="" href="gruposprospecto_historico.php"> <svg class="glyph stroked table">
                        <use xlink:href="#stroked-table"></use>
                      </svg> Historico Prospectos</a> </li>
                      <li class="active"><a class="" href="seguro_asistencia.php"> 
                        <svg class="glyph stroked table">
                          <use xlink:href="#stroked-table"></use>
                        </svg>
                        Ver Seguro Asistencia</a> </li>
                    </ul>
			</li>
			<!--<li><a href="ventas.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Ventas</a></li>-->
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-2" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Programas</span></a>
				</a>
				<ul class="children collapse" id="sub-item-2" >
					<li >
						<a class="" href="grupos.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Ver Programas
						</a>
					</li>
                    <li >
						<a class="" href="grupos_historico.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Historico
						</a>
					</li>
					<li>
						<a class="" href="registrar_producto.php">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Crear Programa
						</a>
					</li>
					
				</ul>
			</li>
			                         <li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-3" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg>Viajeros</span></a>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li>
						<a class="" href="insc_busqueda.php?grupo=0">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Ver Viajeros
						</a>
					</li>
                    <li>
						<a class="" href="insc_historico.php?grupo=0">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Historico
						</a>
					</li>
                    <li>
						<a class="" href="registro.php" target="_self">
							<svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use>
							</svg> Registrar Viajero
						</a>
					</li>
				
				</ul>
			</li>
            <li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-4" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg>Pagos</span></a>
				</a>
				<ul class="children collapse" id="sub-item-4">
					<li>
						<a class="" href="pagos_grupo.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Ver Pagos</a>
					</li>
					<li>
						<a class="" href="pagos_grupo_historico.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Ver Pagos Historico</a>
					</li>
                    <li>
						<a class="" href="registrar_pago_general.php">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Registrar Pagos
						</a>
					</li>
                    <?php if($_SESSION['nivel'] == "10"){?>
					<li>
						<a class="" href="pagos_validar.php">
							<svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Validar Pagos
						</a></li>
                        <?php } ?>
                        	<li>
						<a class="" href="pagos_registrados.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
							</svg>Ver Registros</a>
					</li>
                    	<li>
						<a class="" href="trm.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
							</svg>TRM</a>
					</li>
                    
                    <li>
						<a class="" href="informe_pagos.php">
							<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
							</svg>Consolidado Pagos</a>
					</li>
				</ul>
                
				</li>
                <li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-5" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use>
					</svg>Operativo</span></a>
				</a>
				<ul class="children collapse" id="sub-item-5">
					<li>
						<a class="" href="cupos_aereos.php?historial=0">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Ver Contratos Aerolinea</a></li>
                        <li>
						<a class="" href="cupos_aereos.php?historial=1">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Ver Contratos Aerolinea Historico</a></li>
                        <li>
						<a class="" href="registrar_tiquete.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Registrar Contrato Aerolinea</a></li>
                         <li>
						<a class="" href="cupos_aereos_fechas.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Fechas Contratos Aerolineas</a></li>
                        <li>	<a class="" href="tipo_habitaciones.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Habitaciones y Tarifas</a></li>
                         <li>
						<a class="" href="asistencia.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Registrar Tarjetas de Asistencia</a></li>
                         <li> <a class="" href="asistencia_copy.php" target="_blank"> <svg class="glyph stroked table">
                           <use xlink:href="#stroked-table"></use>
                         </svg>Reporte de Tarjetas por Emitir</a></li>
                         <li> <a class="" href="reportes_grupos.php"> <svg class="glyph stroked table">
                           <use xlink:href="#stroked-table"></use>
                         </svg>Reportes Grupos</a></li>
					<li> <a class="" href="reportes_grupos_historico.php"> <svg class="glyph stroked table">
                           <use xlink:href="#stroked-table"></use>
                         </svg>Reportes Grupos Historico</a></li>
                    
				</ul>
				</li>
                
                <li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-6" class="collapsed"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use>
					</svg>Reportes</span></a>
				</a>
				<ul class="children collapse" id="sub-item-6">
					<li>
						<a class="" href="status.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Status Grupos</a></li>
                        
                        <li>
						<a class="" href="reporte_crecimiento.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Crecimiento Viajeros</a></li>
                    
                    <li>
						<a class="" href="fechas.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Calendario Pagos</a>
					</li>
                    <li>
						<a class="" href="fechas2.php">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use>
						</svg>Calendario Viajes</a>
					</li>
                    
				</ul>
				</li>
                      
		</ul>


	</div><!--/.sidebar-->
		<?php } else {?>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<!--		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar">
			</div>
		</form>-->
        
		<ul class="nav menu">
           Debe cambiar la contraseña para seguir trabajando
			<li><a href="cambiar_contra.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Cambiar contraseña</a></li>
		</ul>
</div>
		
        <?php } ?>