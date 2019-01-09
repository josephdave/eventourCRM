<?php
require_once("config.php");
require_once("control/control.php");

$control = new Control();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    
   
    
    
    
    <link href="http://eventoursport.travel/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EVENTOUR - CRM</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
   
        
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
            
            <link href="http://eventoursport.travel/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
             <link rel="stylesheet" href="css/chosen.css">
                 <!--<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>-->
                  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
       <!-- <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>-->
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
      <!--  <script src="scripts/common.js" type="text/javascript"></script>-->
      <script src="js/chosen.jquery.js" type="text/javascript"></script> 
          
            <script src="js/clipboard.min.js" type="text/javascript"></script> 

<link rel="stylesheet" href="remodal.css">
<link rel="stylesheet" href="remodal-default-theme.css">  

<script src="remodal.js"></script>      
		   <!--<script src="scripts/jquery.js"></script>-->
		
         <script src="scripts/jquery.validate.js"></script>
         <script src="combodate.js"></script>
         
         
          <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link href="css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css"/>
    <link href="css/footable-demos.css" rel="stylesheet" type="text/css"/>
  
    <script src="js/footable.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
	<script src="js/bootstrap-tab.js" type="text/javascript"></script>
    <script src="js/demos.js" type="text/javascript"></script>
    <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/example.css">
        <link rel="stylesheet" href="chosen.min.css">
<script src="chosen.jquery.min.js" type="text/javascript"></script>
         
            
           <style>
		   .widget-menu>li>a {
	background-color: <?php echo COLOR1;?>;
	color: <?php echo COLOR2;?>;
		   }
		   
		   .widget-menu .menu-icon {
	 	color: <?php echo COLOR2;?>;
		   }
		   .module-head {
	
	color: <?php echo COLOR2;?>;
background-color: <?php echo COLOR3;?>;
		   }
		   </style>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php"><img src="http://www.eventours.travel/wp-content/uploads/2018/03/EventourS-Logo-300x107.png" width="168" height="59"> <!--<?php echo APP_NAME ?>--> </a>
                        <div class="nav-collapse collapse navbar-inverse-collapse">
                      <!-- ICONOS 
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul> -->
                        
                        <!-- BUSQUEDA 
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form> -->
                        <!-- DROPDOWN
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Item No. 1</a></li>
                                    <li><a href="#">Don't Click</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Example Header</li>
                                    <li><a href="#">A Separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Your Profile</a></li>
                                    <li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            
            <?php if ($_SESSION['nivel'] >2){?>
            
            <div id='cssmenu'>
<ul>
	<?php
    $resultado_permiso=$control->consulta("SELECT nivel FROM usuarios WHERE user_id = ".$_SESSION['id'].";");
	if($resultado_permiso != null){
	 while ($fi = mysql_fetch_array($resultado_permiso, MYSQL_ASSOC)) {
		$permiso=$fil["nivel"];
	 }}	
	
	$resultado=$control->consulta("SELECT menu.idmenu,link,nombre,nivel FROM menu WHERE menu.idpadre = 0;");
    while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
		$resultado2=$control->consulta("SELECT menu.idmenu,link,nombre,nivel FROM menu WHERE menu.idpadre = ".$fila["idmenu"].";");
		$filas = mysql_num_rows($resultado2);
		if($filas > 0){
		//	var_dump($fila['nivel']);			
			
  		 echo "<li class='has-sub'><a href='".$fila["link"]."'><span>".$fila["nombre"]."</span></a>";
			
		    	
				echo "<ul>";
 		   		while ($fil = mysql_fetch_array($resultado2, MYSQL_ASSOC)) {
					
  				 echo "<li><a href='".$fil["link"]."'><span>".$fil["nombre"]."</span></a></li>";    
 				   
				}
				echo "</ul></li>";
		}else{
			
		echo "<li><a href='".$fila["link"]."'><span>".$fila["nombre"]."</span></a>";
			
		}
    } ?>
	
</ul>
</div>
<?php }?>
            
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->