<?php
$url='https://www.trmhoy.co/';
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

// Get URL content
$lines_string=curl_exec($ch);
// close handle to release resources
curl_close($ch);
//output, you can also save it locally on the server
$data=explode("2>",$lines_string) ;
$data=explode("<small>",$data[1]) ;
$data=trim($data[0]);
$data=str_replace("$","",$data);
$data=str_replace(",","",$data);

var_dump(doubleval($data));
?>