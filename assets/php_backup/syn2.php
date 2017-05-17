<?php
if (isset($_GET['c'])) {
    $champtext = $_GET['c'];
   $champinput = str_replace('.', '',str_replace('-', '',str_replace(' ', '',strtolower($champtext)))); //REMOVE SPACES, HYPHENS, PERIODS AND CONVERT TO LOWERCASE

include 'functions.php';
    
$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/syn!a2:f845?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

$hjson = getheaders('syn!1:1');
    
foreach ($njson as $njson) {
        $id = $njson[intval(array_find('id', $hjson))];
        $name = $njson[intval(array_find('name', $hjson))];
        $stars = $njson[intval(array_find('stars', $hjson))];
        $to_name = $njson[intval(array_find('to_name', $hjson))];
        $syn_name = $njson[intval(array_find('merge_desc', $hjson))];
        $direction = $njson[intval(array_find('direction', $hjson))];

$arr[] = array('id' => $id,'name' => $name,'stars' => $stars,'to_name' => $to_name,'syn_name' => $syn_name,'direction' => $direction);

};

$newjson = json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 

$champnum = newcidfinder($champinput,'master_info!a2:r150');


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

    if (!$champnum) { 
        echo 'No synergies found.';
    }else{
foreach ($redecode[0][$champnum][$champnum] as $champinfo){
    $direct = $champinfo['DIRECTION'];
        if ($direct == 'incoming'){$arrow = '**[r]**';}else{ $arrow = '**[l]**';}

        echo $arrow . " " . $champinfo['STARS'] . " [s] " . $champinfo['TO_NAME'] . ":  **" . $champinfo['SYN_NAME'] . "** " . "\n";
        }
}


}else{
print 'A champion name must be provided.';
}