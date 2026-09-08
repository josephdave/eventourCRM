<?php
/* Corregido 2026-08-12 tras el incidente del 2026-08-10.
   Antes: la escritura del archivo ocurria ANTES del control de sesion y
   $grupo entraba sin sanear en la ruta (escritura arbitraria sin autenticar). */
include('logged.php');

$grupo = isset($_REQUEST['grupo']) ? $_REQUEST['grupo'] : '';
// El id de grupo siempre viene de prospecto.id: solo digitos.
if (!ctype_digit((string)$grupo)) {
    $grupo = '';
}

if ($grupo !== '' && isset($_POST['imagebase64'])) {
    $grupo = (int)$grupo;
    $bin   = false;

    // Se espera un data URI generado por croppie: data:image/png;base64,....
    if (preg_match('#^data:image/(?:png|jpeg);base64,([A-Za-z0-9+/=\r\n]+)$#', $_POST['imagebase64'], $m)) {
        $decoded = base64_decode(preg_replace('/\s+/', '', $m[1]), true);
        if ($decoded !== false && strlen($decoded) > 0 && strlen($decoded) <= 5242880) {
            $info = @getimagesizefromstring($decoded);
            if ($info !== false && ($info[2] == IMAGETYPE_PNG || $info[2] == IMAGETYPE_JPEG)) {
                $bin = $decoded;
            }
        }
    }

    if ($bin !== false) {
        // Se reconstruye la imagen con GD: cualquier carga util incrustada no sobrevive.
        $image = @imagecreatefromstring($bin);
        if ($image !== false) {
            imagepng($image,  'imagenes/productos/logo_' . $grupo . '.png');
            imagejpeg($image, 'imagenes/productos/logo_' . $grupo . '.jpg', 100);
            imagedestroy($image);
            header('Location: producto.php?grupo=' . $grupo);
            exit;
        }
    }
    $error_logo = 'La imagen no es valida.';
}
?>
<?php include('logged.php');?>
<?php include 'layout/header2.php' ?>



<link href="croppie.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="croppie.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();          
            reader.onload = function (e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
                $('.upload-demo').addClass('ready');
            }           
            reader.readAsDataURL(input.files[0]);
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload').on('change', function () { readFile(this); });
    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'original'
        }).then(function (resp) {
            $('#imagebase64').val(resp);
            $('#form').submit();
        });
    });

});
</script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
           				    
       				      <div class="panel panel-default">
					<div class="panel-heading">CAMBIAR LOGO</div>
					<div class="panel-body">
           				  <div class="module-body">
<form action="upload.php" id="form" method="post">
<p>Seleccione el archivo y ajustelo:  </p>
<p>
  <input type="file" id="upload" value="Choose a file">
  <input type="hidden" id="grupo" name="grupo" value="<?php echo $grupo;?>" >
</p>
<div id="upload-demo"></div>
<input type="hidden" id="imagebase64" name="imagebase64">
<a href="#" class="upload-result">Guardar</a>
</form> </div>
           				</div>
                        </div>
</div>
                        </div>
                        </div>
                        
    </body>