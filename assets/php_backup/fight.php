<?php
if (isset($_GET['c'])) {
    $champtext = $_GET['c'];
   $champinput = str_replace('.', '',str_replace('-', '',str_replace(' ', '',strtolower($champtext)))); //REMOVE SPACES, HYPHENS, PERIODS AND CONVERT TO LOWERCASE


//GET FUNCTIONS 
include "functions.php";

//FUNCTION TO RETURN ARRAY OF HEADERS FROM FIRST ROW OF DATA. INPUTS: FIRST ROW OF DATA
$hjson = getheaders('fight!1:1');

//GET ALL DATA FROM API EXCEPT HEADERS. EXTRACT VALUES AND RETURN ARRAY
$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/fight!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$ndata = $narray['values'];

//FUNCTION TO RETURN CHAMP ID. INPUTS: QUERYSTRING, DATA ARRAY, HEADERS ARRAY
$champid = newcidfinder($champinput,'master_info!a2:w150');

//BUILD NEW ARRAY ASSIGNING EACH VALUE TO A UNIQUE KEY NAME THAT INCLUDES CID
$hero_array = array();

foreach ($ndata as $njson) {  //RENAME NDATA AS NJSON
       $id = $njson[intval(array_find('id', $hjson))]; //FOR EACH LINE IN THE DATA ARRAY, FIND THE TEXT 'ID' IN THE HEADERS ARRAY VALUES, RETURN THE INDEX KEY STRING (#) AND CONVERT THAT STRING INTO A INTEGER. THEN APPLY THAT INTEGER TO THE DATA ARRAY TO RETURN THE VALUE AND ASSIGN IT TO THE UNIQUE KEY NAME. 

        $thisarray = array(
            $id . '_id' => $id,
	    $id . '_name' => $njson[intval(array_find('name', $hjson))], 
            $id . '_class' => $njson[intval(array_find('class', $hjson))], 
            $id . '_img' => $njson[intval(array_find('img', $hjson))],
            $id . '_video' => $njson[intval(array_find('video', $hjson))],           
            $id . '_sp1_name' => $njson[intval(array_find('sp1_name', $hjson))],
            $id . '_sp2_name' => $njson[intval(array_find('sp2_name', $hjson))],
            $id . '_sp3_name' => $njson[intval(array_find('sp3_name', $hjson))], 
            $id . '_sp1_desc' => $njson[intval(array_find('sp1_desc', $hjson))],
            $id . '_sp2_desc' => $njson[intval(array_find('sp2_desc', $hjson))],
            $id . '_sp3_desc' => $njson[intval(array_find('sp3_desc', $hjson))], 
            $id . '_sp1_hits' => $njson[intval(array_find('sp1_hits', $hjson))],
            $id . '_sp2_hits' => $njson[intval(array_find('sp2_hits', $hjson))],
            $id . '_sp1_howto' => $njson[intval(array_find('sp1_howto', $hjson))],
            $id . '_sp2_howto' => $njson[intval(array_find('sp2_howto', $hjson))],  
            $id . '_notes' => $njson[intval(array_find('notes', $hjson))]
        );
	$hero_array = array_merge($thisarray,$hero_array); //APPEND EACH LINE TO THE LAST LINE	
};

//FIND THE VALUES SPECIFIC TO THE INPUT CHAMPION FROM THE QUERYSTRING
$name = $hero_array[$champid . '_name'];
$img = $hero_array[$champid . '_img'];
$heroclass_name = $hero_array[$champid . '_class'];

$sp1_name = $hero_array[$champid . '_sp1_name'];
$sp2_name = $hero_array[$champid . '_sp2_name'];
$sp3_name = $hero_array[$champid . '_sp3_name'];
$sp1_desc = $hero_array[$champid . '_sp1_desc'];
$sp2_desc = $hero_array[$champid . '_sp2_desc'];
$sp3_desc = $hero_array[$champid . '_sp3_desc'];
$sp1_hits = $hero_array[$champid . '_sp1_hits'];
$sp2_hits = $hero_array[$champid . '_sp2_hits'];
$sp1_howto = $hero_array[$champid . '_sp1_howto'];
$sp2_howto = $hero_array[$champid . '_sp2_howto'];
$video = $hero_array[$champid . '_video'];
$notes = $hero_array[$champid . '_notes']; 
    
    
    if ($sp1_name) { $sp1_name_f = '[b][b]L1:** ' . $sp1_name . '**[b]';}
    if ($sp2_name) { $sp2_name_f = '[b][b]L2:** ' . $sp2_name . '**[b]';}
    if ($sp3_name) { $sp3_name_f = '[b][b]L3:** ' . $sp3_name . '**[b]';}
    
    if (sp1_hits) { $sp1_hits_f = '[b][b]** - Hits:** ' . $sp1_hits;}
    if ($sp2_hits) { $sp2_hits_f = '[b][b]** - Hits:** ' . $sp2_hits;}
    
    if ($sp1_howto) { $sp1_howto_f = '[b][b]** - Strategy:** ' . $sp1_howto;}
    if ($sp2_howto) { $sp2_howto_f = '[b][b]** - Strategy:** ' . $sp2_howto;}
    
    if ($video){ $video_f = '[b][b]Watch Specials: ' . $video;}
    if ($notes) { $notes_f = '[b][b]** - Notes:** ' . $notes;}
    
    
$heroclass_icon = 'https://assgardians.000webhostapp.com/mcoc_db/imgs/class_icons/' . $heroclass_name . '.png';
    
$specials = $sp1_name_f . $sp1_desc . $sp1_hits_f . $sp1_howto_f . $sp2_name_f . $sp2_desc . $sp2_hits_f . $sp2_howto_f . $sp3_name_f . $sp3_desc . $notes_f . $video_f;

//print_r($specials);

//print_r($hero_array);



$class_colors = array(
"tech" => 0x3333F7,
"skill" => 0xCC0000,
"mutant" => 0xF1C232,
"science" => 0x6AA84F,
"mystic" => 0xDB13D5,
"cosmic" => 0x6FA8DC
);

$color = $class_colors[$heroclass_name];

if (!$name){
$status = 'failure';
$name='Champion not found. Check the spelling and try again.';
}else{
$status = 'success';}

    
if (!$img){$img='https://sms111016.000webhostapp.com/mcoc/images/champ_img/unknown.png';}
if (!$heroclass_name){
$heroclass_name='N/A';
$heroclass_icon='https://sms111016.000webhostapp.com/mcoc/images/champ_img/unknown.png';
}


$echoarray = array(  
'status' => $status,
'heroclass_icon' => $heroclass_icon,
'color' => $color,
'name' => $name,
'img' => $img,
'heroclass_name' => $heroclass_name,
'specials' => $specials
);

$newjson = json_encode($echoarray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 

}else{
  
$echoarray = array(  
'status' => 'failure',
'heroclass_icon' => 'https://sms111016.000webhostapp.com/mcoc/images/champ_img/unknown.png',
'color' => 'N/A',
'name' => 'Champion not found. Check the spelling and try again.',
'img' => 'https://sms111016.000webhostapp.com/mcoc/images/champ_img/unknown.png',
'heroclass_name' => 'N/A',
'specials' => 'N/A'
);
$newjson = json_encode($echoarray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
}

echo $newjson;
