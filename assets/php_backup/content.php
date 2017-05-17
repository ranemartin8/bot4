<?php

if (isset($_GET['c'])) {
$cmdtext = $_GET['c'];
$cmdlower = strtolower($cmdtext);
$cmdspaces = str_replace(' ', '', $cmdlower);

$cmdinput = $cmdspaces;
    $cmdStatus = "success";
} else {
$cmdStatus = "failure";
$cmdinput = "list";
}

$url = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/bot_feeds!k2?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$file = file_get_contents($url);
$gjson = json_decode($file, true);
$str = $gjson['values']['0']['0'];

$values = json_decode($str, true); 

$json = $values[$cmdinput];

$command = $json['0']['command'];

//if($json['0']['title'] != null) {$title = "";} else { $title = $json['0']['title']; }
//if($json['0']['desc'] == null) {$desc = "";} else { $desc = $json['0']['desc']; }
//if($json['0']['img'] == null) {$img = "";} else { $img = $json['0']['img']; }
//if($json['0']['url'] == null) {$link = "";} else { $link = $json['0']['url']; }

//if($json['0']['color'] == null) {$color = "14471279";} else { $color = $json['0']['color']; }

if ($command == null) {
$desc = "Sorry, command not found.";
}

if($json['0']['title'] <> null) { print "**" . $json['0']['title'] . "**\n"; }
if($json['0']['desc'] <> null) { print "\n" . $json['0']['desc'] . "\n"; }
if($json['0']['img'] <> null) { print "\n" . $json['0']['img'] . "\n"; }
if($json['0']['url'] <> null) { print "\n" . $json['0']['url'] . "\n"; }


//$arr = array(
   // 'name' => $title,
   // 'quick' => $desc,
   // 'img' => $img,
   // 'click' => $link,
   // 'color' => $color
//);
//echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);