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

$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/bot_feeds!e2?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values']['0']['0'];

$namejson = json_decode($njson, true); 

$id = $namejson[$champinput]['id'];

$url = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/bot_feeds!g2?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$file = file_get_contents($url);
$gjson = json_decode($file, true);
$str = $gjson['values']['0']['0'];

$json = json_decode($str, true); 

$offense = $json[$id]['o'];
$defense = $json[$id]['d'];
$name = $json[$id]['name'];
$img = $json[$id]['img'];
$class = $json[$id]['class'];
$class_icon = 'https://assgardians.000webhostapp.com/mcoc_db/imgs/class_icons/' . $class . '.png';

$class_colors = array(
"tech" => 0x3333F7,
"skill" => 0xCC0000,
"mutant" => 0xF1C232,
"science" => 0x6AA84F,
"mystic" => 0xDB13D5,
"cosmic" => 0x6FA8DC
);

$color = $class_colors[$class];

$arr = array(
    'o' => $offense,
    'd' => $defense,
    'img' => $img,
    'name' => $name,
    'classname' => $class,
    'class_icon' => $class_icon,
    'color' => $color
);

if ($id == null) {
$errorMsg = "Champion not found. Check name spelling.";
echo $errorMsg;
} else {
echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}