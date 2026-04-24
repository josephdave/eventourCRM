
<?php
require 'Send_Mail.php';

/*$to = array ('director@eventoursport.com','jdmal2004@gmail.com','jhonsaav@hotmail.com','jmaldonado@emedia.co','jhsaavedra@elpais.com.co');*/
$cc = "";

$to ['probandojosee@mailinator.com']="MENSAJE1";
$to ['probandojosef@mailinator.com']="MENSAJE2";
$to ['probandojoseg@mailinator.com']="MENSAJE3";
$to ['probandojoseh@mailinator.com']="MENSAJE4";

$subject = "Prueba de correo - Desde lunas de mielR";
$body = "Probando<br/>123<br/>123"; // HTML  tags
Send_Mail_Masivo_Personalizado($to,$subject)

?>