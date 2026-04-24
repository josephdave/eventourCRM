<?php
// api.api to ifttt v0.1
// config
$iftKey = 'b2qgndmJ5JkUSdl2Mk0kok';

$error = '';
// from api.ai
$in = file_get_contents('php://input');
$req = json_decode($in, true);
$action = $req['result']['action'];
$param = $req['result']['parameters'];

// to IFTTT
switch ($action) {
    case 'saludo':
    
        $data['value1'] = 'set_clipboard';
          
     break;
       
    case 'harmony':
        // ...
        break;
    default:
        $error = 'error webhook: action not found';
}

if ($error == '') {
    $maker = 'https://maker.ifttt.com/trigger/' . $action . '/with/key/' . $iftKey;
    $ch = curl_init($maker);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    if (isset($data)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $iftRes = curl_exec($ch);
    curl_close($ch);

    if (substr($iftRes, 0, 16) == 'Congratulations!') {
        $text = 'Command sent';
    } else {
        $error = 'error webhook: IFTTT response';
    }
}

if ($error != '') {
    $text = $error;
}

// to api.ai
$res['speech'] = $text;
$res['displayText'] = $text;
$res['contextOut'] = array();
$res['source'] = 'webhook for ifttt';

header('Content-Type: application/json');
echo json_encode($res);
?>
 