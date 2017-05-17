<?php

if (isset($_GET['c'])) {
    $champtext = $_GET['c'];
   $champlower = strtolower($champtext);
   $champspaces = str_replace(' ', '', $champlower);
   $champinput = str_replace('-', '', $champspaces);
    $champStatus = "success";
}else{
    $champStatus = "failure";
}

$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/syn!a2:f845?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];


foreach ($njson as &$njson) {
        $id = $njson[0];
        $a_id = $njson[0];
        $name = $njson[1];
        $stars = $njson[2];
        $to_name = $njson[3];
        $syn_name = $njson[4];
        $direction = $njson[5];

$arr[] = array('id' => $id,'name' => $name,'stars' => $stars,'to_name' => $to_name,'syn_name' => $syn_name,'direction' => $direction);

};

$newjson = json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 

$names_url = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$names_file = file_get_contents($names_url);

$names_arr = json_decode($names_file, true);
$names_jso = $names_arr['values'];
$hero_array = array();

foreach ($names_jso as $names_jso) {
        $heroid = $names_jso[0];
        $alt_name_v_1 = $names_jso[11];
        $alt_name_v_2 = $names_jso[12];
        $alt_name_v_3 = $names_jso[13];
        $alt_name_v_4 = $names_jso[14];
        $alt_name_v_5 = $names_jso[15];
	
        $thisarray = array(
	$alt_name_v_1 => $heroid,
            $alt_name_v_2 => $heroid, 
            $alt_name_v_3 => $heroid, 
            $alt_name_v_4 => $heroid, 
            $alt_name_v_5 => $heroid );
	$hero_array = array_merge($thisarray,$hero_array);	
};

$champnum = $hero_array[$champinput];


// Decode your JSON and create a placeholder array
$objects = json_decode($newjson);
$grouped = array();

// Loop JSON objects
foreach($objects as $object) {
	$champ = $object->id;
    $taskObject = new stdClass();

    // Copy the TASK/TASK_NAME
    $taskObject->STARS = $object->stars;
    $taskObject->TO_NAME = $object->to_name;
	$taskObject->SYN_NAME = $object->syn_name;
	$taskObject->DIRECTION = $object->direction;

    // Append this new task to the ITEMS array
    $grouped[$champ]->$champ[] = $taskObject;
}

// We use array_values() to remove the keys used to identify similar objects
// And then re-encode this data :)
$grouped = array($grouped);
$json = json_encode($grouped);

$redecode = json_decode($json, true);
$champinfo = $redecode[$champnum];

$champinfo = $redecode[0][$champnum][$champnum];

foreach ($redecode[0][$champnum][$champnum] as $champinfo){
$direct = $champinfo['DIRECTION'];
if ($direct == 'incoming'){$arrow = '**[r]**';}else{ $arrow = '**[l]**';}

    echo $arrow . " " . $champinfo['STARS'] . " [s] " . $champinfo['TO_NAME'] . ":  **" . $champinfo['SYN_NAME'] . "** " . "\n";
}

//**<---** **--->**\u21E2\u066D

if (!$direct) {
print 'Champion synergies not available.';
}