<?php



$xml = file_get_contents("http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/groups");
$data= json_decode($xml);
$room= $data->{"4"};

//var_dump($data);
var_dump($room);


foreach ($data as $group){
    echo "\n".($group->name)."\n";
    if(($group->state->all_on) == true){
        echo "ON";
    }else{

        echo "OFF";
    }


}



//$xml = file_get_contents("http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/lights");
//$data= json_decode($xml);
//var_dump($data);
 
$arrData['on'] = true;
$arrData['sat'] = 254;
$arrData['bri'] = 254;

$data = json_encode($arrData);
  $target="lights/7/state";


//echo sendPut($data,$target);

function sendPut($data, $target){
//The URL that we want to send a PUT request to.
$url = 'http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/'.$target;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PORT, 8078);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

$response = curl_exec($ch);
return $response; 
}

?>