<?php session_start();
	// El nivel de errores lo fija db_config.php segun $APP_ENV.
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
	}else{
		$error = true;
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
	
	$viajero=$control->validarLoginNOMBRE($_REQUEST['usuario'],$_REQUEST['password']);
	
	if($viajero != 0){
		$_SESSION['login']=true;
		$_SESSION['doc']=$viajero['no_documento'];
		
		header ("Location: datos.php");
	}
	}
	
	
	
?>
<!DOCTYPE html>
<!--  Last Published: Wed May 29 2019 02:37:20 GMT+0000 (UTC)  -->
<html data-wf-page="5cdb69c9ded4a01b277c2389" data-wf-site="5cdb69c9ded4a00da77c2385">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="Login" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/components.css" rel="stylesheet" type="text/css">
  <link href="css/user-dashboard.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Varela:400","Karla:regular,700"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <!-- REPLACE ↓↓ -->
  <!--  Temporary Memberstack Code  -->
  <!-- REPLACE ↑↑ -->
  <!-- Crisp Chat Code -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
  <!--<a data-w-id="bb7013ae-656f-0690-1c48-bd5e1e2edbaf" style="height:0PX" href="https://www.memberstack.io/dashboard-tutorial" class="tutorial-alert-bar w-inline-block">
    <div class="video-icon"><img src="https://uploads-ssl.webflow.com/5bbfaf3252489b4c484ba9b9/5c7a1104eaea1d2cb3951624_vdieo.svg" alt="" class="video-svg"></div>
    <div>Tutorial Video: How does this template work?</div>
  </a>-->
  <div class="login-page-wrapper">
    <div class="login-container w-form">
      <div class="login-container"></div>
      <h1 class="login-head"><img src="http://www.eventours.travel/wp-content/uploads/2018/03/EventourS-Logo-300x107.png" alt=""/><br>
      Ingrese para continuar</h1>
      <form id="ingresar" name="wf-form-Sign-up-Form" data-name="Sign up Form" method="post" ms-login="true" class="memberstack-form" action="index.php">
        <div class="field-wrapper"><label for="node" class="signup-label">Primer apellido del viajero</label><input type="text" maxlength="256" required="" ms-field="text" class="signup-field w-input" id="usuario" name="usuario"></div>
        <div class="field-wrapper"><label for="password-2" class="signup-label">Documento de viajero (sin puntos ni comas)</label><input type="password" class="signup-field w-input" maxlength="256" name="password" data-name="Password 2" ms-field="password" id="password" required="" ></div>
      <!--<div class="secondary-action forgot-password"><a ms-forgot="true" href="#" class="login-link">Forgot password?</a></div>--><input type="submit" value="Acceder" data-wait="Ingresando" class="login-button w-button"></form>
      <div class="w-form-done">
        <div>Thank you! Your submission has been received!</div>
      </div>
		<?php if($error){?>
      <div class="error-message w-form-fail" style="display: block;background: rgba(128,0,2,1.00);">
        <div>ERROR: Por favor verifique su datos</div>
      </div>
		<?php }?>
    </div>
   
  </div>
  
  <script src="https://d1tdp7z6w94jbb.cloudfront.net/js/jquery-3.3.1.min.js" type="text/javascript" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <!--<script src="js/user-dashboard.js" type="text/javascript"></script>-->
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  
  <!-- Crisp + MemberStack -->
  
</body>
</html>
