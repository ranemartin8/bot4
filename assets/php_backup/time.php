<?php
$_SESSION['time_zone'] = (isset($_SESSION['time_zone'])) ? $_SESSION['time_zone'] : '';
if (isset($_GET['bg'])) {
    $bg = $_GET['bg'];
}else{
$bg= "all";
}
$gurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/bot_feeds!a2?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$gfile = file_get_contents($gurl);
$gjson = json_decode($gfile, true);
$str = $gjson['values']['0']['0'];

$json = json_decode($str, true); 

$group1 = $json[$bg];
$current_date = gmdate("h:i:s A");

foreach ($group1 as $group1) {
     if ($group1['tz'] == 'Unknown') {
        print "\n" . $group1['name'] . ": Unknown\n";
        }else {
        $timezone = $group1['tz'];
        $dt_obj = new DateTime($current_date." UTC");
        $dt_obj->setTimezone(new DateTimeZone($timezone));
	print "\n" . $group1['name'] . ":   **" . date_format($dt_obj, 'g:i A') . "**\n";
         }
}