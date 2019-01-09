<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>
<?php 

	//error_reporting(0);

function convert($from, $to, $retry = 0)
{
    $ch = curl_init("http://download.finance.yahoo.com/d/quotes.csv?s=$from$to=X&f=l1&e=.csv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    $rate = curl_exec($ch);
    curl_close($ch);
    if ($rate) {
        return (float)$rate;
    } elseif ($retry > 0) {
        return convert($from, $to, --$retry);
    }
    return false;
}



if(isset($_REQUEST['idproveedor'])){
//var_dump($_REQUEST['valor']);
	//INSERT INTO `pago_proveedor`(`id`, `id_servicio`, `fecha`, `medio`, `moneda`, `valor`, `observaciones`, `usuario`) 
	$mensaje=$control->registrarPagoProveedor($_REQUEST['idproveedor'],$_REQUEST['date'],$_REQUEST['valor'],$_REQUEST['observaciones'],$_REQUEST['moneda'],$_REQUEST['usuario']);
	
	

//var_dump($mensaje);
}
	
?>

    
   

       <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">PAGO</div>
					<div class="panel-body">
           				  <div class="module-body">
                          <?php 	
						  $programa_tk=0;
						  $programa_pt=0;
						  
						  $documento_viajero = $_REQUEST['doc'];
	$viajero=$control->datosViajero($documento_viajero);
	//var_dump($viajero);?>
    
      
       				        <form action="registrar_pago_proveedor.php" method="post" name="form1" id="form1">
       				        <h2>REGISTRAR PAGO </h2>
           				   
     <?php if(isset($mensaje)){?>
                              <div class="alert">
           				        <button type="button" class="close" data-dismiss="alert">×</button>
           				        <?php echo $mensaje;?>           				      </div><?php } ?>
           				    <table border="1" cellspacing="0" cellpadding="2" style="font-size:13px;" class="table demo">
           				      <tr>
           				        <td bgcolor="#CCCCCC">PROVEEDORES:</td>
           				        <td>
                                <?php if(isset($_REQUEST['id'])){
									
								$viajero=$control->datosViajeroID($_REQUEST['id']);
								echo $viajero['nombres']." ".$viajero['apellidos'];
									?>
                                <input type="hidden" id="idviajero" name="idviajero" value="<?php echo $viajero['id'];?>">
                                
                                <?php } else { ?>
									
                                <select name="idproveedor" id="idprovedor" data-placeholder="Seleccione Viajero" class="chosen-select" >
                                <option value="0" selected>SELECCIONE PROVEEDOR</option>
                                 <?php 
							
							$resultado=$control->serviciosLista(0);
							while ($fi = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
							?>
                                  <option value="<?php echo $fi['idprov'] ?>"><?php echo strtoupper($fi['nombre'])."";?></option><?php } ?>
                                </select><?php } ?>
                                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id'];?>">
                                <br><span id="saldo"></span></td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Fecha pago Proyectado:           				          </td>
           				        <td>


                                <input type="date" name="date" id="date" value="<?php echo date("Y-m-j");?>" onChange="valortrm()"></td>
           				        <td>Moneda:</td>
           				        <td>
                                  <select name="moneda" id="moneda"  >
                                    <option value="Dolar">Dolar</option>
                                    <option value="Pesos">Pesos</option>
                                    <option value="Euro">Euro</option>
                                </select></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Valor Pago</td>
           				        <td><p>
           				          <input type="number" name="valor" id="valor" placeholder="valor" step="any">
         				          </p>
           				          <p>
       				              <!--<input type="number" name="tik2" id="tik2" onKeyUp="actualizarTIK()" onChange="actualizarTIK()" placeholder="valor COP">--></p>
                                  
                                  </td>
           				        <td>&nbsp;</td>
           				        <td><p>&nbsp;</p>
           				          <p>
           				            <!--<input type="number" name="pt2" id="pt2" placeholder="valor COP" onKeyUp="actualizarPT()" onChange="actualizarPT()">-->
       				              </p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td>&nbsp;</td>
           				        <td><p><script>
								  
								  </script>
         				          </p>
           				          <p>
           				         <!--   <input type="number" name="fee2" id="fee2" placeholder="valor COP" onKeyUp="actualizarFEE()" onChange="actualizarFEE()">--></p></td>
       				          </tr>
           				      <tr>
           				        <td bgcolor="#CCCCCC">Observaciones</td>
           				        <td colspan="3"><textarea  name="observaciones" cols="100" rows="5" id="observaciones"></textarea></td>
       				          </tr>
           				      <tr>
           				        <td colspan="4"><input type="submit" name="Registrar" id="Registrar" value="Registrar"></td>
       				          </tr>
       				        </table>
           				    <p>&nbsp;</p>
         				    </form>
           				  </div>
           				</div>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                                                
                            <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
    </body>
