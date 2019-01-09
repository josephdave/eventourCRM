<?php include('logged.php');?>
<?php include 'layout/header.php' ?>
<?php 

	//error_reporting(0);
?>
	
 
    
   

       <div class="wrapper">
           
                <div >
                    <!--/.span3-->
                    <div style="padding:10px;">
                        <div class="content">
           				<!-- contenido aqui -->
           				<div class="module">
           				  <div class="module-head">
           				    <h3>Busqueda</h3>
       				      </div>
           				  <div class="module-body">
                            <form name="form1" method="post" action="busqueda.php">
           				    <label for="termino"></label>
           				    Busqueda General:
           				    <input type="text" name="termino" id="termino" ><input name="Submit" type="submit" value="Consultar">
         				    </form>
           				  <table width="100%" border="1" cellspacing="0" cellpadding="2" style="font-size:11px;">
           				    <tr>
           				      <td bgcolor="#999999">&nbsp;</td>
           				      <td bgcolor="#999999"><strong>Grupo</strong></td>
           				      <td bgcolor="#999999"><strong>Documento</strong></td>
           				      <td bgcolor="#999999"><strong>Nombres</strong></td>
           				      <td bgcolor="#999999"><strong>Apellidos</strong></td>
           				      <td bgcolor="#999999"><strong>F Nacimiento</strong></td>
           				      <td bgcolor="#999999"><strong>Edad</strong></td>
           				      <td bgcolor="#999999"><strong>email</strong></td>
           				      <td bgcolor="#999999"><strong>Telefono</strong></td>
           				      <td bgcolor="#999999"><strong>celular</strong></td>
           				      <td bgcolor="#999999"><strong>ciudad</strong></td>
           				      <td bgcolor="#999999"><strong>direccion</strong></td>
           				      <td bgcolor="#999999"><strong>pasaporte</strong></td>
           				      <td bgcolor="#999999"><strong>vigencia</strong></td>
           				      <td bgcolor="#999999"><strong>visa</strong></td>
           				      <td bgcolor="#999999"><strong>vigencia</strong></td>
           				      <td bgcolor="#999999"><strong>Acudiente 1</strong></td>
           				      <td bgcolor="#999999"><strong>Telefono</strong></td>
           				      <td bgcolor="#999999"><strong>Email</strong></td>
           				      <td bgcolor="#999999"><strong>Acudiente 2</strong></td>
           				      <td bgcolor="#999999"><strong>Telefono</strong></td>
           				      <td bgcolor="#999999"><strong>Email</strong></td>
           				      <td bgcolor="#999999"><strong>Facturacion</strong></td>
           				      <td bgcolor="#999999"><strong>Documento</strong></td>
           				      <td bgcolor="#999999"><strong>Direccion</strong></td>
           				      <td bgcolor="#999999"><strong>Documentos</strong></td>
       				        </tr>
           				    <tr>
           				     
           			
                            
                            <?php 
							$resultado=$control->busqueda($_REQUEST['termino']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?> <td>
                            
                              <?php if(($_SESSION['user'] == "gerencia@eventoursport.com") || ($_SESSION['user'] == "eventos@eventoursport.com")){ ?>
                              <a href="editar.php?doc=<?php echo $fi['no_documento'];?>">EDITAR</a>
                              <?php } ?></td>
                            	      <td><?php echo $control->nomGrupo($fi['id_grupo']);?></td>
           				      <td><?php echo $fi['documento'];?> <a href="datos.php?doc=<?php echo $fi['no_documento'];?>" target="_blank"><?php echo $fi['no_documento'];?></a></td>
           				      <td><?php echo strtoupper($fi['nombres']);?></td>
           				      <td><?php echo strtoupper($fi['apellidos']);?></td>
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
           				      <td><?php echo strtoupper($fi['acudiente1_nombre']);?> <?php echo strtoupper($fi['acudiente1_apellido']);?></td>
           				      <td><?php echo $fi['acudiente1_telefono'];?></td>
           				      <td><?php echo $fi['acudiente1_email'];?></td>
           				      <td><?php echo strtoupper($fi['acudiente2_nombre']);?> <?php echo strtoupper($fi['acudiente2_apellido']);?></td>
           				      <td><?php echo $fi['acudiente2_telefono'];?></td>
           				      <td><?php echo $fi['acudiente2_email'];?></td>
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
                          <a href="excel.php?grupo=<?php echo $_REQUEST['grupo']?>">Descargar a EXCEL</a> </div>
           				</div>
                      
    </body>
