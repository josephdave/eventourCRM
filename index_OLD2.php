<?php session_start();
	//error_reporting(0);
	
	require_once("control/control.php");

$control = new Control();
	
	if($_REQUEST['salir'] == 1){
	session_destroy();
	}
	
	
	if($_SESSION['login'] && $permiso > 2){
	header ("Location: dashboard.php");
	}
	
	if(isset($_REQUEST['usuario'])){
	
	$_SESSION['user']=$_REQUEST['usuario'];
	
	if($control->login($_REQUEST['usuario'],$_REQUEST['password'])){
		$_SESSION['login']=true;
		
		header ("Location: dashboard.php");
	}
	}
	
	/*
	
		if($_REQUEST['usuario'] == 'servicios@eventoursport.com' && $_REQUEST['password'] == 'eventour2014'){
		$_SESSION['login']=true;
		
		header ("Location: grupos.php");
	}
	
		if($_REQUEST['usuario'] == 'eventour' && $_REQUEST['password'] == 'eventour2014'){
		$_SESSION['login']=true;
		
		header ("Location: grupos.php");
	}
	
		if($_REQUEST['usuario'] == 'soporte@eventoursport.com' && $_REQUEST['password'] == 'eventour2014'){
		$_SESSION['login']=true;
		
		header ("Location: grupos.php");
	}*/
	
	
	
	
	if(isset($_REQUEST['usuario'])){
	
	$viajero=$control->validarLogin($_REQUEST['usuario'],$_REQUEST['password']);
	
	if($viajero != 0){
		$_SESSION['login']=true;
		header ("Location: datos.php?doc=".$viajero['no_documento']);
	}
	}
	
	
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EventourCRM - Login</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Bienvenido</div>
				<div class="panel-body">
					<form role="form" action="index.php" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Usuario" name="usuario" id="usuario" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password"  id="password" type="password" value="">
							</div>
							<input type="submit" value="Acceder">
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
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
</body>

</html>
