<ul class="nav menu">
                            <?php if(isset($_SESSION['user']) && !isset($_SESSION['nivel']) ){ ?>
                                <li class="active"><a href="index.php"><i class="menu-icon "></i>Mis Datos</a></li>
                                <?php } ?>
                                <?php 
								$viajero=$control->datosViajero($documento);
								$grupo=$control->datosProducto($viajero['id_grupo']);
								if($grupo['blog']!=''){
								
								?>
                                <li class="active"><a href="<?php echo $grupo['blog'];?>" target="_blank">Mi Viaje</a></li>
                                <?php } ?>
                                <?php if($_SESSION['nivel'] >2 ){ ?>
                                 <li class="active"><a href="gruposprospecto.php" >Prospectos </a></li>    <li class="active"><a href="grupos.php" target="_blank">Grupos </a></li>
                           
                                 <li class="active"><a href="insc.php?grupo=0" target="_blank">Ver Inscritos</a></li>
                                  <li class="active"><a href="index.php?salir=1" >Salir</a></li>
                                <?php } ?>
                             
                           <!--     <li class="active"><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Item1 </a>
                                  <ul id="togglePages" class="collapse unstyled">
                                    <li><a href="other-login.html"><i class="icon-inbox"></i>1</a></li>
                                    <li><a href="other-user-profile.html"><i class="icon-inbox"></i>2 </a></li>
                                    <li><a href="other-user-listing.html"><i class="icon-inbox"></i>3 </a></li>
                                  </ul>
                                </li>
                                 <li class="active"><a class="collapsed" data-toggle="collapse" href="#togglePages2"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Item 2 </a>
                                   <ul id="togglePages2" class="collapse unstyled">
                                    <li><a href="other-login.html"><i class="icon-inbox"></i>1 </a></li>
                                    <li><a href="other-user-profile.html"><i class="icon-inbox"></i>2 </a></li>
                                    <li><a href="other-user-listing.html"><i class="icon-inbox"></i>3 </a></li>
                                    </ul>
                                </li>-->
  </ul>
                           <!-- <ul class="widget widget-menu unstyled">
                                <li><a href="#"><i class="menu-icon icon-signout"></i>Logout </a></li>-->
  </ul>
                     
                        <!--/.sidebar-->