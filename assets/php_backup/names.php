<?php
$json ='';
$champinput = "bw";

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

$id = $hero_array[$champinput];
//echo $id;