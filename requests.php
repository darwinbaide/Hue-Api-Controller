<?php


$version = $_POST['version'];// grabs the version to see what function to go into
//$version="toggleLight";



if($version == "getButtons"){
    
    $xml = file_get_contents("http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/");
    $data= json_decode($xml);
    $lights1=$data->lights;
    $groups1= $data->groups; 
    $lightHTML="";
    $groupHTML="";
    foreach ($lights1 as $key => $light){
        //var_dump($light->name);
        //echo "\n Light:   ".$key."  :   ".($light->name)."\n";

        $lightHTML.=' <div class="col-sm" style="margin:10px;"> <div class="btn btn-secondary btn-circle btn-xl align-middle" onclick="toggleLight(\''.$key.'\');">'.$light->name.'</div>  </div>';
        
    }
    foreach ($groups1 as $key => $group){
        //echo "\n Group:   ".$key."  :   ".($group->name)."\n";
        $groupHTML.=' <div class="col-sm" style="margin:10px;"> <div class="btn btn-primary btn-circle btn-xl align-middle" onclick="toggleGroup(\''.$key.'\');">'.$group->name.'</div>  </div>';
    }

    $arr = array('Done' => 'yes', 'lights' =>$lightHTML, 'groups' =>$groupHTML);// sends back data to display 
    echo json_encode($arr);// sends the response with correct json
}




if($version == "toggleLight"){
    
    $index1 = $_POST['index'];
    //$index1="7";
    $getUrl="lights/".strval($index1)."\n";// target to get current state
    $data=getData($getUrl);//gets the data for this light
    if($data->state->{'on'} == true){// simple boolean test to see what action should be
        $arrData['on'] = false;
    }else{
        $arrData['on'] = true;
    }
    $target="lights/".strval($index1)."/state";  // target action   
     
    $data = json_encode($arrData);// convert to json
    echo sendPut($data,$target);// send action
}

if($version == "toggleGroup"){
    
    $index1 = $_POST['index'];
    $getUrl="groups/".strval($index1)."\n";// target to get current state
    $data=getData($getUrl);//gets the data for this light
    if($data->action->on == true){// simple boolean test to see what action should be
        $arrData['on'] = false;
    }else{
        $arrData['on'] = true;
    }
    $target="groups/".strval($index1)."/action";  // target action  
    
    $data = json_encode($arrData);// convert to json
    echo sendPut($data,$target);// send action
}
function getData($target){// gets the content for the given target
    $url = 'http://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/'.$target;
    $xml = file_get_contents($url);
    $data= json_decode($xml);
    //var_dump($data);
    return $data;
}



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
