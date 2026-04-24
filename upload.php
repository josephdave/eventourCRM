<?php
$grupo=$_REQUEST['grupo'];
    if(isset($_POST['imagebase64'])){
        $data = $_POST['imagebase64'];

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents('imagenes/productos/logo_'.$grupo.'.png', $data);
		
		$image = imagecreatefrompng('imagenes/productos/logo_'.$grupo.'.png');
imagejpeg($image, 'imagenes/productos/logo_'.$grupo.'.jpg', 100);
imagedestroy($image);
header("Location: producto.php?grupo=$grupo");
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