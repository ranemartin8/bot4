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

foreach ($njson as &$njson) {
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


$url = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/bot_feeds!e2?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$file = file_get_contents($url);
$array = json_decode($file, true);
$tjson = $array['values']['0']['0'];

$namejson = json_decode($tjson, true); 

$champid = $namejson[$champinput]['id'];


$name = $hero_array[$champid . '_name'];
$img = $hero_array[$champid . '_img'];
$classname = $hero_array[$champid . '_class'];
$url_1 = $hero_array[$champid . '_url_1'];
$video = $hero_array[$champid . '_video'];
$seatin_o = $hero_array[$champid . '_seatin_o'];
$seatin_d = $hero_array[$champid . '_seatin_d'];
$ability_string = $hero_array[$champid . '_ability_string'];
$tag_string = $hero_array[$champid . '_tag_string'];

if ($classname == 'tech') {$color = '0x0B5394';} 
elseif ($classname == 'skill') {$color = '0xCC0000';} 
elseif ($classname == 'mutant') {$color = '0xF1C232';} 
elseif ($classname == 'science') {$color = '0x6AA84F';} 
elseif ($classname == 'mystic') {$color = '0x6AA84F';} 
elseif ($classname == 'cosmic') {$color = '0x6FA8DC';} 
else {$classname = '0x4ac5a3';} 



if (!$video){$video='Video Link N/A';}
if (!$seatin_o){$seatin_o='N/A';}
if (!$seatin_d){$seatin_d='N/A';}
if (!$ability_string){$ability_string='N/A';}
if (!$tag_string){$tag_string='N/A';}
if (!$img){$img='https://sms111016.000webhostapp.com/mcoc/images/champ_img/unknown.png';}else{$img = 'https://sms111016.000webhostapp.com/mcoc/images/champ_img/img_' . $champid . '.png';}
if (!$url_1){$url_1='N/A';}
if (!$classname){$classname='N/A';}

$echoarray = array(  
'class_icon' => 'http://sms111016.000webhostapp.com/mcoc/images/icon/' . $classname . '.png',
'color' => $color,
'name' => $name,
'img' => $img,
'nameclass' => $classname,
'url_1' => $url_1,
'video' => $video,
'seatin_o' => $seatin_o,
'seatin_d' => $seatin_d,
'ability_string' => $ability_string,
'tag_string' => $tag_string
);

$newjson = json_encode($echoarray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
echo $newjson;