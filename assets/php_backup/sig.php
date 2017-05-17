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
if (isset($_GET['l'])) {
    $level = $_GET['l'];
    $levelStatus = "success";
}else{
    $levelStatus = "failure";
}
$namecheck = file_get_contents('https://assgardians.000webhostapp.com/mcoc_db/names.json');
$namejson = json_decode($namecheck, true); // decode the JSON into an associative array

$champ = $namejson[$champinput]['name'];

$str = file_get_contents('https://assgardians.000webhostapp.com/mcoc_db/sig.json');
$json = json_decode($str, true); // decode the JSON into an associative array

$value = $json[$champ][$level];
$desc = $json[$champ]['desc'];
$img = $json[$champ]['img'];
$name = $json[$champ]['name_clean'];
$class = $json[$champ]['class'];
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
    'level' => $level,
    'value' => $value,
    'desc' => $desc,
    'img' => $img,
    'name' => $name,
    'classname' => $class,
    'class_icon' => $class_icon,
    'color' => $color
);



if ($level == "0" || $level == "20" || $level == "40" || $level == "60" || $level == "80"|| $level == "99"){  
if ($json == null) {
$errorMsg = "Champion not found. Check name spelling.";
echo $errorMsg;
} else {
echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
}else {
$errorMsg = "Level must be one of the following values: 0, 20, 40, 60, 80, 99 ";
echo $errorMsg;
}