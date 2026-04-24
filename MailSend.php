	<?php
// require('control/Mailin.php');
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$from=$_REQUEST['from'];
$mensaje=$_REQUEST['mensaje'];
$to=$_REQUEST['to'];
$sub=$_REQUEST['subject'];
$bcc=$_REQUEST['bcc'];
$attachment=$_REQUEST['attachment'];
$attachment_name=$_REQUEST['attachment_name'];



$post = [
    'sender' => ["email"=>$from,"name"=>"Eventours"],
	'to'=>[["email"=>$to]],
	'subject'=>$sub,
	'htmlContent'=>$mensaje
  ];

  if($attachment!='' && $attachment_name !=''){

	//$attachment=explode("base64,",$attachment);

	$post['attachment']=[["content"=>$attachment,"name"=>$attachment_name]];
  }

  var_dump($post);

$url = "https://api.sendinblue.com/v3/smtp/email";
    $headers = array('Content-Type: application/json', 'api-key: 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', 'accept: application/json');
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
 	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);


	var_dump($response);
// $mailin = new Mailin('https://api.sendinblue.com/v2.0','2mUNn4KyjYgABhW8', 5000);	// Optional parameter: Timeout in MS


// $data = array( "to" => array($to=>$to),
// 		//	"cc" => array("cc@example.net"=>"cc whom!"),
// 			"bcc" =>array($bcc=>"Eventours"),
// 			"from" => array($from,"Eventours"),
// 			"replyto" => array($from,"Eventours"),
// 			"subject" => $sub,
// 			//"text" => "This is the text",
			  
			  
			  
// 			"html" => $mensaje,
// 			"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1")
// );
// var_dump($data);
// $mailin->send_email($data);




?>