<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
 $id_grupo = $_REQUEST['grupo'];

$id_post = $id_grupo;

if(isset($_REQUEST["borrarcontacto"]) ){
	$resultado=$control->borrarContacto($_REQUEST['borrarcontacto']);
	
	}
	
if(isset($_POST["estado"]) ){
	$resultado=$control->registrarEstadoGrupo($_REQUEST['grupo'],$_REQUEST['estado']);
	
	}

if(isset($_POST["estado2"]) ){
	$resultado=$control->registrarEstadoContacto($_REQUEST['id_contacto'],$_REQUEST['estado2']);
	
	}
	
	if(isset($_POST["fecha_presentacion"]) ){
	$resultado=$control->registrarFechaPresentacion($_REQUEST['grupo'],$_REQUEST['fecha_presentacion']);
	
	}

?>

      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
   

                      
           				    <h3>GRUPO PROSPECTO</h3>
       				      
           				  <div class="module-body">
                          <div class="col-lg-12">
				<div class="panel panel-default">
									<div class="panel-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						 
	$prospecto=$control->datosProspecto($id_grupo);
	//var_dump($viajero);?>
    
       <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
                            <h2>GRUPO PROSPECTO: <?php echo $prospecto['nombre_grupo']; ?>
                              <input type="button" name="button3" id="button3" value="Modificar" onClick="location.href='registrar_grupoprospecto.php?id=<?php echo $id_grupo?>';" >
                            </h2>    
                          <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Nombre:</strong></td>
    <td><?php echo $prospecto['nombre_grupo']; ?></td>
    <td bgcolor="#CCCCCC"><strong>Viajeros Estimados:</strong></td>
    <td><?php echo $prospecto['cantidad_viajeros']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Fecha Salida Desde:</strong></td>
    <td><?php echo $prospecto['fecha_salida']; ?></td>
    <td bgcolor="#CCCCCC"><strong>Fecha Regreso:</strong></td>
    <td><?php echo $prospecto['fecha_regreso']; ?></td>
    </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Origen:</strong></td>
    <td><?php echo $prospecto['origen'] ?></td>
    <td bgcolor="#CCCCCC">Destino:</td>
    <td><?php echo $prospecto['destino'] ?></td>
  </tr>
  
  <tr>
    <td bgcolor="#CCCCCC"><strong>Estado:</strong></td>
    <td> <form id="form1" name="form1" method="post"  action="prospecto.php" style="margin:0 !important;">
    <input type="hidden" value="<?php echo $id_grupo?>" name="grupo" id="grupo"/>
     <select name="estado" id="estado" onchange="getElementById('form1').submit()">
                                <?php  	$res=$control->listaEstadosProspecto('PROSPECTO');
							while ($fi = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
	            <option value="<?php echo $fi['estado']; ?>"<?php if($fi['estado'] == $prospecto['estado']){ echo "selected";}?> ><?php echo $fi['estado'];?></option><?php } ?>
       				            </select>
    </form></td>
    <td bgcolor="#CCCCCC"><strong>Encargado:</strong></td>
    <td><?php  $usuario=$control->datosUsuario($prospecto['encargado']);
							  echo strtoupper($usuario['nombre']);?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>OBSERVACIONES:</strong></td>
    <td colspan="3"><?php echo $prospecto['observaciones'] ?></td>
    </tr>
                          </table>
                          <p><!--
<h2>COMENTARIOS</h2>

                         
                         <div class="cmt-container" >
    <?php
	$control->baseDeDatos(); 
    $sql = mysql_query("SELECT * FROM comments WHERE id_post = '$id_post'") or die(mysql_error());;
    while($affcom = mysql_fetch_assoc($sql)){ 
        $name = $affcom['name'];
        $email = $affcom['email'];
        $comment = $affcom['comment'];
        $date = $affcom['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
        $default = "mm";
        $size = 35;
        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;

    ?>
    <div class="cmt-cnt">
        <img src="<?php echo $grav_url; ?>" />
        <div class="thecom">
            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->
                            <?php } ?>
                          </p>
                          
                          <p>&nbsp; </p>
                          <div class="new-com-bt">
                            <span>Comentarios...</span>
                          </div>
    <div class="new-com-cnt">
        <input type="hidden" id="name-com" name="name-com" value="<?php $usuario=$control->datosUsuario($_SESSION['id']);
							  echo strtoupper($usuario['nombre']);?>" />
        <input type="hidden" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" value="a@a.com"/>
        <textarea class="the-new-com"></textarea>
        <div class="bt-add-com">Registrar</div>
        <div class="bt-cancel-com">Cancelar</div>
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->


<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                    data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script>  <h2>ESCENARIOS
          <input type="button" name="button" id="button" value="Registrar " onclick="location.href='registrar_multitarifa.php?idprospecto=<?php echo $id_grupo?>';" >
                          </h2>
                   <table width="100%" border="1" cellspacing="0" cellpadding="2" style="" class="table demo">
                            <thead>
                              <tr>
                                <th bgcolor="#CCCCCC">TARIFA</th>
                                <th bgcolor="#CCCCCC">AEREA</th>
                                <th bgcolor="#CCCCCC">TERESTRE</th>
                                <th bgcolor="#CCCCCC">APROBACIÓN</th>
                                <th bgcolor="#CCCCCC">OBSERVACIONES</th>
                                <th bgcolor="#CCCCCC">ANALISIS ESCALONADO</th>
                                <th bgcolor="#CCCCCC">COSTEO</th>
                            </thead>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa1'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion1']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion1'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=1">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=1">COSTEO</a></td>
                            </tr>
                            <?php if($prospecto['nombre_tarifa2'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa2'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa2']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa2']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion2']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion2'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=2">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=2">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa3'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa3'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa3']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa3']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion3']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion3'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=3">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=3">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa4'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa4'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa4']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa4']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion4']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion4'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=4">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=4">COSTEO</a></td>
                            </tr>
                            <?php if($prospecto['nombre_tarifa5'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa5'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa5']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa5']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion5']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion5'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=5">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=5">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa6'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa6'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa6']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa6']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion6']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion6'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=6">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=6">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa7'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa7'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa7']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa7']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion7']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion7'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=7">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=7">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa8'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa8'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa8']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa8']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion8']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion8'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=8">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=8">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa9'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa9'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa9']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa9']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion9']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion9'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=9">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=9">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php if($prospecto['nombre_tarifa10'] != ""){ ?>
                            <tr>
                              <td><?php echo $prospecto['nombre_tarifa10'];?></td>
                              <td><?php echo number_format($prospecto['valor_aereo_tarifa10']);?></td>
                              <td><?php echo number_format($prospecto['valor_terrestre_tarifa10']);?></td>
                              <td><?php  echo $control->estadoAprobacionCosteoProspecto($prospecto['estado_aprobacion10']);?></td>
                              <td><?php  echo $prospecto['observaciones_aprobacion10'];?></td>
                              <td><a href="costeo_multitarifa_multiple.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=10">ANALISIS</a></td>
                              <td><a href="costeo_multitarifa.php?id_prospecto=<?php echo $id_grupo ?>&multitarifa=10">COSTEO</a></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                          </table>
					
                          <h2>CONTACTOS
                            <input type="button" name="button" id="button" value="Registrar Contacto" onclick="location.href='registrar_contacto.php?idgrupo=<?php echo $id_grupo?>';" >
                          </h2>
                            <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				    <thead>
           				      
           				      
           				    
           				      
           				        <tr>
           				      <th bgcolor="#CCCCCC"><strong>Nombre</strong></th>
           				      <th bgcolor="#CCCCCC">Telefono</th>
           				      <th bgcolor="#CCCCCC">Direccion</th>
           				      <th bgcolor="#CCCCCC">Email</th>
           				      <th bgcolor="#CCCCCC">Tipo</th>
           				      <th bgcolor="#CCCCCC">Origen</th>
           				      <th bgcolor="#CCCCCC">Estado</th>
           				      <th bgcolor="#CCCCCC">Observaciones</th>
                               <th bgcolor="#CCCCCC"></th>
           				      </thead>
                            
                            <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->contactosProspecto($id_grupo);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?><tr>
                           
           				      <td><?php echo $fi['nombre'];?></td>
           				      <td><?php echo $fi['telefono'];?></td>
           				      <td><?php echo $fi['direccion'];?> <?php echo $fi['ciudad'];?></td>
           				      <td><?php echo $fi['email'];?></td>
                             
           				      <td><?php echo $fi['tipo'];?></td>
           				      <td><?php echo $fi['origen'];?></td>
           				      <td><form id="form3" name="form1" method="post"  action="prospecto.php" style="margin:0 !important;">
           				        <input type="hidden" value="<?php echo $id_grupo?>" name="grupo" id="grupo"/>
           				        <select name="estado2" id="estado2" onchange="getElementById('form3').submit()">
           				          <?php  	$res=$control->listaEstadosContacto();
							while ($fi2 = mysql_fetch_array($res, MYSQL_ASSOC)) {?>
           				          <option value="<?php echo $fi2['estado']; ?>"<?php if($fi2['estado'] == $fi['estado']){ echo "selected";}?> ><?php echo $fi2['estado'];?></option> 
           				          <?php } ?>
       				            </select>
                                <input type="hidden" value="<?php echo $fi['id'];?>" id="id_contacto" name="id_contacto" />
       				          </form> </td>
           				      <td><?php echo $fi['observaciones'];?></td>
                              <td><a href="registrar_contacto.php?idgrupo=<?php echo $fi['id_grupo'];?>&contacto=<?php echo $fi['id']?>" target="_blank">Modificar</a> <a href="prospecto.php?grupo=<?php echo $fi['id_grupo'];?>&borrarcontacto=<?php echo $fi['id'];?>" onclick="return confirm('Desea Borrar?')">Borrar</a></td>
           				      </tr> <?php } ?>
                           
         				    </table>
                            <h2>ACTIVIDADES
                              <input type="button" name="button2" id="button2" value="Registrar Actividad" onclick="location.href='registrar_actividad.php?idgrupo=<?php echo $id_grupo?>';" >
                            </h2>
                            <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
                              <thead>
                                <tr>
                                  <th bgcolor="#CCCCCC"><strong>Actividad</strong></th>
                                  <th bgcolor="#CCCCCC">Fecha</th>
                                  <th bgcolor="#CCCCCC">Hora</th>
                                  <th bgcolor="#CCCCCC">lugar</th>
                                  <th bgcolor="#CCCCCC">Contacto</th>
                                  <th bgcolor="#CCCCCC">Observaciones</th>
                              </thead>
                              <?php 
							
							$totaltik=0;
							$totalpt=0;
							
							$resultado=$control->actividadesProspecto($id_grupo);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                              <tr>
                                <td><?php echo $fi['actividad'];?></td>
                                <td><?php echo $fi['fecha'];?></td>
                                <td><?php echo $fi['hora'];?></td>
                                <td><?php echo $fi['lugar'];?></td>
                                <td><?php $contact=$control->datosContacto($fi['contacto']);
								echo $contact['nombre'];?></td>
                                <td><?php echo $fi['observaciones'];?></td>
                              </tr>
                              <?php } ?>
                            </table>
                            
                            <p>
                              <script type="text/javascript">
        $(function () {
			$('table').footable();

            $('.sort-column').click(function (e) {
                e.preventDefault();

                //get the footable sort object
                var footableSort = $('table').data('footable-sort');

                //get the index we are wanting to sort by
                var index = $(this).data('index');

                footableSort.doSort(index, 'toggle');
            });
        });
                              </script>
                            </p>
                            <p>
                              <input type="button" name="button4" id="button4" value="Volver" onClick="location.href='gruposprospecto.php';" >
                            </p>
                            <p>
           				    <script type="text/javascript">
        $(function () {
			$('table').footable();

            $('.sort-column').click(function (e) {
                e.preventDefault();

                //get the footable sort object
                var footableSort = $('table').data('footable-sort');

                //get the index we are wanting to sort by
                var index = $(this).data('index');

                footableSort.doSort(index, 'toggle');
            });
        });
                            </script>
           				  </p>
           				  </div>
           				</div>
                        </div></div></div>
    </body>
