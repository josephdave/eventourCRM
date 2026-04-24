<?php session_start();
	//error_reporting(0);
	
	require_once("control/control.php");

$control = new Control();
	
	if($_REQUEST['salir'] == 1){
	session_destroy();
	}
	
	
	if($_SESSION['login'] && $permiso > 2){
	header ("Location: grupos.php");
	}
	
	if(isset($_REQUEST['usuario'])){
	
	$_SESSION['user']=$_REQUEST['usuario'];
	
	if($control->login($_REQUEST['usuario'],$_REQUEST['password'])){
		$_SESSION['login']=true;
		
		header ("Location: grupos.php");
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
<?php include 'layout/header.php' ?>


	
 
    
   

        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                       <?php include 'layout/menu.php' ?> 
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				  <div class="module-head">
           				    <h3> Login</h3>
       				      </div>
           				  <div class="module-body">
           				  <form name="form1" method="post" action="index.php">
                               <p>
                                 <label for="usuario">Usuario</label>
                                 <input type="text" name="usuario" id="usuario">
                                 <label for="password">Contraseña:</label>
                                 <input type="password" name="password" id="password">
                               </p>
                               <p>
                                 <input type="submit" name="Login" id="Login" value="Acceder">
                               </p>
                             </form>
                          </div>
           				</div>
                        </div>
    </body>
