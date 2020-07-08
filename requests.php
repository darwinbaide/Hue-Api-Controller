<?php
echo "At start";


//$xml = file_get_contents("http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/lights/7");
//var_dump($xml);


/* //The url you wish to send the POST request to
$url = "http://192.168.1.212//api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/lights/7/state";

//The data you want to send via POST
$fields = [
    'on'      => "true",
    'bri' => "254",
    'sat'         => '254'
]; */




//The URL that we want to send a PUT request to.
$url = 'http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/lights/7/state';
 
$arrData['on'] = true;
$arrData['sat'] = 254;
$arrData['bri'] = 254;

$data = json_encode($arrData);
echo $data;

//$url = "http://MYSITE/api/1234567890/lights/1/state";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PORT, 8078);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

$response = curl_exec($ch);
echo $response; 


?>