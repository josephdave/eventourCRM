<?php 
session_start();
if(!$_SESSION['login']){
header ("Location: login.php");
exit;
}
?>
<?php include 'layout/header.php' ?>
<?php 

	error_reporting(0);
?>
	
 
    
   

        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                 <!--   <div class="span3">
                       <?php include 'layout/menu.php' ?> 
                    </div>-->
                    <!--/.span3-->
                    <div class="span9" style="width:100%">
                        <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				  <div class="module-head">
           				    <h3> Viajero</h3>
       				      </div>
           				  <div class="module-body">
                           <?php require_once("viajero.php");?>
           				  </div>
           				</div>
                        </div>
    </body>
