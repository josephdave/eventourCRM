<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);
	
	if(isset($_REQUEST['borrar']) && $_REQUEST['borrar'] != 0){
	
	$resultado=$control->borrarRegistro($_REQUEST['borrar']);
	}
	
	if($_POST["estado"] == 1){
	$resultado=$control->registrarEstado($_REQUEST['documento'],$_REQUEST['estado_viaje']);
	
	}
?>
	
 
    
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">Inscritos <?php echo $control->nomGrupo($_REQUEST['grupo']); ?></div>
					<div class="panel-body">
           				  <div class="module-body"><p>&nbsp;</p>
           				  <table data-toggle="table" border="1" bordercolor="#000000" cellpadding="10" cellspacing="0" id="list" width="100%" data-sort-name="programa" data-sort-order="desc" data-show-columns="true" data-search="true" class="table table-hover table-fixed" >
           			 	    <thead>
           				      <th>&nbsp;</th>
           				      <th>Estado</th>
           				      <?php if($_REQUEST['grupo'] == 0){?><th>Grupo</th><?php } ?>
           				      <th><strong>Documento</strong></th>
           				      <th data-sortable="true"><strong>Nombres</strong></th>
           				      <th  data-visible="false"><strong>F Nacimiento</strong></th>
           				      <th><p><strong>Edad</strong></p></th>
           				      <th><strong>email</strong></th>
           				      <th  data-visible="false"><strong>Telefono</strong></th>
           				      <th><strong>celular</strong></th>
           				      <th  data-visible="false"><strong>ciudad</strong></th>
           				      <th  data-visible="false"><strong>direccion</strong></th>
           				      <th  data-visible="false"><strong>pasaporte</strong></th>
           				      <th  data-visible="false"><strong>vigencia</strong></th>
           				      <th  data-visible="false"><strong>visa</strong></th>
           				      <th  data-visible="false"><strong>vigencia</strong></th>
           				     <?php if($_REQUEST['grupo'] != 8){?> <th><strong>Acudiente 1</strong></th>
           				      <th  data-visible="false"><strong>Telefono Acudiente 1</strong></th>
           				      <th  data-visible="false"><strong>Email Acudiente 1</strong></th>
           				      <th><strong>Acudiente 2</strong></th>
           				      <th  data-visible="false"><strong>Telefono Acudiente 2</strong></th>
           				      <th  data-visible="false"><strong>Email Acudiente 2</strong></th><?php }else{ ?>
                               <th><strong>Viaja Con</strong></th>
                              <?php } ?>
           				      <th  data-visible="false"><strong>Facturacion</strong></th>
           				      <th  data-visible="false"><strong>Documento</strong></th>
           				      <th  data-visible="false"><strong>Direccion</strong></th>
           				      <th  data-visible="false"><strong>Documentos</strong></th>
       				        </thead>
           				    <tr>
           				  
                            
                            <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                            <td>
                              <p>
                                <?php 
								//var_dump($_SESSION);
								
								if($_SESSION['nivel'] > 8){
								$acceso = 1;	
								}
								if(($_SESSION['user'] == "servicios@eventoursport.com")){
								$acceso = 1;	
								}
								if(($_SESSION['user'] == "gerencia@eventoursport.com")){
								$acceso = 1;	
								}
								if($acceso == 1){ ?>
                              <a href="editar_super.php?id=<?php echo $fi['id'];?>">EDITAR</a></p>
                              <p><a href="insc.php?grupo=<?php echo $_REQUEST['grupo']?>&borrar=<?php echo $fi['id'];?>" onclick="return confirm('Desea Borrar el registro?')">BORRAR</a></p>                              <?php } ?></td>
                            <td><form id="form<?php echo  $fi['no_documento'];?>" name="form1" method="post" action="insc.php">
                            <input type="hidden" id="grupo" name="grupo" value="<?php echo $_REQUEST['grupo'];?>">
                            <input type="hidden" id="documento" name="documento" value="<?php echo  $fi['no_documento'];?>">
                            <input type="hidden" id="estado" name="estado" value="1">
                            
                              <select name="estado_viaje" id="estado_viaje" style="width:70px" onchange="getElementById('form<?php echo  $fi['no_documento'];?>').submit()">
                                <option value="VIAJA" <?php if($fi['estado'] == "VIAJA"){echo "selected";}?>>VIAJA</option>
                                 <option value="PENDIENTE" <?php if($fi['estado'] == "PENDIENTE"){echo "selected";}?>>PENDIENTE</option>
                                <option value="NO VIAJA" <?php if($fi['estado'] == "NO VIAJA"){echo "selected";}?>>NO VIAJA</option>
                              </select>
                            </form></td>
                               <?php if($_REQUEST['grupo'] == 0){?> <td><?php echo $control->nomGrupo($fi['id_grupo']);?></td><?php } ?>
           				      <td><?php echo $fi['documento'];?> <a href="datos.php?doc=<?php echo $fi['no_documento'];?>" target="_blank"><?php echo $fi['no_documento'];?></a><br/> <a href="registrar_pago.php?doc=<?php echo $fi['id'];?>" target="_blank">(PAGOS)</a></td>
           				      <td><?php echo strtoupper($fi['nombres']);?> <?php echo strtoupper($fi['apellidos']);?></td>
           				      <td><?php echo $fi['fnacimiento'];?></td>
           				      <td><?php echo $control->edad($fi['fnacimiento'],$_REQUEST['grupo']);?></td>
           				      <td><?php echo $fi['email'];?></td>
           				      <td><?php echo $fi['telefono'];?></td>
           				      <td><?php echo $fi['celular'];?></td>
           				      <td><?php echo $fi['ciudad'];?></td>
           				      <td><?php echo $fi['direccion'];?></td>
           				      <td><?php echo $fi['pasaporte'];?></td>
           				      <td><?php echo $fi['pasaporte_vigencia'];?></td>
           				      <td><?php echo $fi['visa_americana'];?></td>
           				      <td><?php echo $fi['visa_vigencia'];?></td>
           				     <?php if($_REQUEST['grupo'] != 8){?>   <td><?php echo strtoupper($fi['acudiente1_nombre']);?> <?php echo strtoupper($fi['acudiente1_apellido']);?></td>
           				      <td><?php echo $fi['acudiente1_telefono'];?></td>
           				      <td><?php echo $fi['acudiente1_email'];?></td>
           				      <td><?php echo strtoupper($fi['acudiente2_nombre']);?> <?php echo strtoupper($fi['acudiente2_apellido']);?></td>
           				      <td><?php echo $fi['acudiente2_telefono'];?></td>
           				      <td><?php echo $fi['acudiente2_email'];?></td> <?php } else{ ?>
                              <td><?php echo strtoupper($fi['acompanante_de']);?></td>
                              <?php } ?>
           				      <td><?php echo strtoupper($fi['facturacion_nombre']);?></td>
           				      <td><?php echo $fi['facturacion_nodocumento'];?></td>
           				      <td><?php echo $fi['facturacion_direccion'];?> <?php echo $fi['facturacion_ciudad'];?></td>
           				      <td>
							  <?php if($fi['doc_identidad']!= ""){echo "<a href='documentos/".$fi['doc_identidad']."' target='_blank'>Documento Identidad</a><br/>";
							  }?><?php if($fi['doc_pasaporte']!= ""){echo "<a href='documentos/".$fi['doc_pasaporte']."' target='_blank'>Pasaporte</a><br/>";
							  }?>
                              <?php if($fi['doc_permiso']!= ""){echo "<a href='documentos/".$fi['doc_Permiso']."' target='_blank'>Permiso</a><br/>";
							  }?><?php if($fi['doc_rut']!= ""){echo "<a href='documentos/".$fi['doc_rut']."' target='_blank'>RUT</a><br/>";
							  }?>
                              <?php if($fi['doc_visa']!= ""){echo "<a href='documentos/".$fi['doc_visa']."' target='_blank'>Visa Americana</a><br/>";
							  }?></td>
       				        </tr>
                            <?php } ?>
         				    </table>
                              <script src="js/footable.filter.js" type="text/javascript"></script>
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
                          <a href="excel.php?grupo=<?php echo $_REQUEST['grupo']?>">Descargar a EXCEL</a> </div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
