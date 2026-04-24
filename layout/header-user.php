<?php require_once("config.php");
require_once("control/control.php");
setlocale(LC_TIME, "es_ES");
$control = new Control();
?>
  <meta charset="utf-8">
  <title>Panel de Control</title>
  <meta content="preview" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/components.css" rel="stylesheet" type="text/css">
  <link href="css/user-dashboard.css" rel="stylesheet" type="text/css">

  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">WebFont.load({  google: {    families: ["Varela:400","Karla:regular,700"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
</head><body><div class="page-wrapper"><div class="top-nav" style="background: #00467f;">
  <a href="#" class="logo-link w-nav-brand">
  <div style="color: #fff"><img src="images/eventours_blanco.png" width="125" height="43" alt=""/> - PANEL DE CLIENTE</div>
  </a>
      <div data-hover="1" data-delay="100" class="dropdown w-dropdown">
      <a class="navigation-item w-inline-block w-tab-link" href="https://eventoursport.travel/crm/index.php?salir=1">
          <div class="navigation-icon"></div>
              <div>Salir</div>
  </a>
        <!--<nav class="nav-dropdown-list w-dropdown-list">
          <div class="webflow-diamond"></div>
          <div class="nav-drop-list-padding">
            <a ms-profile="true" href="#" class="navigation-item dropdown-nav-item w-inline-block">
              <div class="navigation-icon"></div>
              <div>Profile</div>
            </a>
            <a href="#" class="navigation-item dropdown-nav-item w-inline-block">
              <div class="navigation-icon"></div>
              <div>Support</div>
            </a>
            <a ms-logout="true" href="#" class="navigation-item logout-link w-inline-block">
              <div class="navigation-icon"></div>
              <div>Log out</div>
            </a>
          </div>
        </nav>-->
      </div>
</div>
    <div data-duration-in="300" data-duration-out="100" class="tabs w-tabs">
      <div class="navigation-menu w-tab-menu">
        <a  class="navigation-item w-inline-block w-tab-link w--current" href="datos.php">
          <div class="navigation-icon"></div>
          <div>Estado de Cuenta</div>
        </a>
       
        <a class="navigation-item w-inline-block w-tab-link" href="user-liquidacion.php">
          <div class="navigation-icon"></div>
          <div>Liquidar mi cuota</div>
        </a>
          
          <a class="navigation-item w-inline-block w-tab-link" href="dtos.php">
          <div class="navigation-icon"></div>
          <div>Subir Documentos</div>
        </a>
        
</div>
      <div class="dash-tab-wrapper w-tab-content">
        <div data-w-tab="Overview" class="dashboard-section w-tab-pane w--tab-active">