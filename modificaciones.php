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
					<div class="panel-heading">VALOR PROGRAMA POR VIAJERO</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 
						  $producto=$control->datosProducto($_REQUEST['grupo']);
						  
						  ?>
                          <style>
						  .table-fixed thead {
  width: 97%;
}
						.table-fixed  tr {
width: 100%;
display: inline-table;
table-layout: fixed;
  
}

.table-fixed{
 height:500px; 
 display: -moz-groupbox;
}
.table-fixed tbody{
  overflow-y: scroll;
  height: 400px;
  width: 100%;
  position: absolute;
}
						  </style>
           				  <table class="table table-hover table-fixed" data-toggle="table" data-show-refresh="false" data-show-toggle="false" data-show-columns="true" data-search="true"  data-filter-control="true" data-pagination="true" data-sort-name="producto" data-sort-order="desc" data-side-pagination="client" data-page-size="100">
           				    <thead>
           				      
           				      
           				      <?php if($_REQUEST['grupo'] == 0){?>
           				    <tr><th>Grupo</th><?php } ?>
           				      <th><strong>Documento</strong></th>
           				      <th><strong>Apellidos</strong></th>
           				      <th data-visible="false" >Factura</th>
           				      <th data-field="tipo" data-filter-control="select">Tipo Viajero</th>
           				      <th data-visible="false" ><strong>Valor TK</strong></th>
           				      <th data-visible="false" >Modificaciones TK</th>
           				      <th><strong>Total TK</strong></th>
           				      <th data-visible="false" >Valor PT</th>
           				      <th data-visible="false" >Modificaciones PT</th>
           				      <th><strong>Total PT</strong></th>
           				      <th>Total Programa</th>
           				  <th>Modificaciones</th>
           				      </thead>
           				    <tr>
           				  
                            
                            <?php 
							
							$resultado=$control->inscritos($_REQUEST['grupo']);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                            <?php if($_REQUEST['grupo'] == 0){?> <td><?php echo $control->nomGrupo($fi['id_grupo']);?></td><?php } ?>
           				      <td><a href="registrar_pago.php?doc=<?php echo $fi['no_documento'];?>" target="_blank"></a><a href="registrar_pago.php?doc=<?php echo $fi['id'];?>" target="_blank"><?php echo $fi['no_documento'];?></a></td>
           				      <td><?php echo strtoupper($fi['apellidos']);?> <?php echo strtoupper($fi['nombres']);?></td>
           				      <td><?php echo strtoupper($fi['facturacion_nombre']);?> -<?php echo $fi['facturacion_nodocumento'];?></td>
                              <?php 
							  
							  ?>
           				      <td><?php echo $fi['otro']?></td>
           				      <td><?php $valortk= $control->valorViajeroTK($fi['otro'],$producto); echo $valortk; ?></td>
           				      <td><?php $valorMtk= $control->consultarModificaciones($fi['id'],$producto['id'],'TK'); echo $valorMtk;?></td>
           				      <td><strong><?php echo  $producto['MONEDA']."$ ".number_format(($valortk+$valorMtk),0,",","."); ?></strong></td>
           				      <td><?php $valorPt= $control->valorViajeroPT($fi['otro'],$producto); echo $valorPt;?></td>
           				      <td><?php $valorMpt= $control->consultarModificaciones($fi['id'],$producto['id'],'PT'); echo $valorMpt;?></td>
           				      <td><strong><?php echo $producto['MONEDA']."$ ".number_format(($valorPt+$valorMpt),0,",","."); ?></strong></td>
           				      <td><?php echo  $producto['MONEDA']."$ ".number_format(($valorPt+$valortk+$valorMpt+$valorMtk),0,",",".");?></td>
                              <td> <button type="button" class="btn-xs btn-primary" onclick="location.href='registrar_modificaciones.php?grupo=<?php echo $_REQUEST['grupo'];?>&viajero=<?php echo $fi['id'];?>'"> MODIFICACIÓN</button></td>
           				</tr>
                            <?php } ?>
         				    </table>
                            
                            
                          <a href="excel.php?grupo=<?php echo $_REQUEST['grupo']?>">Descargar a EXCEL</a> </div>
           				</div>
                        </div>
                        </div>
                        </div>
                      
    </body>
