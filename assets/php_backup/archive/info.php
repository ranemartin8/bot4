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

$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

$hero_array = array();

foreach ($njson as $njson) {
        $id = $njson[0];
        $name_v = $njson[1];
        $class_v = $njson[3];
        $img_v = $njson[4];
        $url_1_v = $njson[5];
        $video_v = $njson[6];
        $seatin_o_v = $njson[7];
        $seatin_d_v = $njson[8];
        $ability_string_v = $njson[9];
        $tag_string_v = $njson[10];  
    
        $name_n = $id . '_name';	
        $class_n = $id . '_class';
        $img_n = $id . '_img';   
        $url_1_n = $id . '_url_1';      
        $video_n = $id . '_video';   
        $seatin_o_n = $id . '_seatin_o';
        $seatin_d_n = $id . '_seatin_d';    
        $ability_string_n = $id . '_ability_string';
        $tag_string_n = $id . '_tag_string';

        $thisarray = array(
	    $name_n => $name_v,
            $class_n => $class_v, 
            $img_n => $img_v, 
            $url_1_n => $url_1_v, 
            $video_n => $video_v, 
            $seatin_o_n => $seatin_o_v, 
            $seatin_d_n => $seatin_d_v,
            $ability_string_n => $ability_string_v, 
            $tag_string_n => $tag_string_v            
        );
	
	$hero_array = array_merge($thisarray,$hero_array);	
};

//$names_url = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';

$narray = json_decode($nfile, true);
$njson = $narray['values'];

$allnamesarray = array();

foreach ($njson as $njson) {
        $heroid = $njson[0];
        $alt_name_v_1 = $njson[11];
        $alt_name_v_2 = $njson[12];
        $alt_name_v_3 = $njson[13];
        $alt_name_v_4 = $njson[14];
        $alt_name_v_5 = $njson[15];
	
        $namessubarray = array(
	    $alt_name_v_1 => $heroid,
            $alt_name_v_2 => $heroid, 
            $alt_name_v_3 => $heroid, 
            $alt_name_v_4 => $heroid, 
            $alt_name_v_5 => $heroid 
           );
	$allnamesarray = array_merge($namessubarray,$allnamesarray);	
};

$champid = $allnamesarray[$champinput];

//print_r($njson);

$name = $hero_array[$champid . '_name'];
$img = $hero_array[$champid . '_img'];
$heroclass_name = $hero_array[$champid . '_class'];
$url_1 = $hero_array[$champid . '_url_1'];
$video = $hero_array[$champid . '_video'];
$seatin_o = $hero_array[$champid . '_seatin_o'];
$seatin_d = $hero_array[$champid . '_seatin_d'];
$ability_string = $hero_array[$champid . '_ability_string'];
$tag_string = $hero_array[$champid . '_tag_string'];

$class_colors = array(
"tech" => 0x3333F7,
"skill" => 0xCC0000,
"mutant" => 0xF1C232,
"science" => 0x6AA84F,
"mystic" => 0xDB13D5,
"cosmic" => 0x6FA8DC
);

$color = $class_colors[$heroclass_name];


if (!$name){$video='Champion not found.';}
if (!$video){$video='Video Link N/A';}
if (!$seatin_o){$seatin_o='N/A';}
if (!$seatin_d){$seatin_d='N/A';}
if (!$ability_string){$ability_string='N/A';}
if (!$tag_string){$tag_string='N/A';}
if (!$img){$img='https://sms111016.000webhostapp.com/mcoc/images/champ_img/unknown.png';}
if (!$url_1){$url_1='N/A';}
if (!$heroclass_name){$heroclass_name='N/A';}

$echoarray = array(  
'heroclass_icon' => 'https://assgardians.000webhostapp.com/mcoc_db/imgs/class_icons/' . $heroclass_name . '.png',
'color' => $color,
'name' => $name,
'img' => $img,
'heroclass_name' => $heroclass_name,
'url_1' => $url_1,
'video' => $video,
'seatin_o' => $seatin_o,
'seatin_d' => $seatin_d,
'ability_string' => $ability_string,
'tag_string' => $tag_string
);

$newjson = json_encode($echoarray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
echo $newjson;