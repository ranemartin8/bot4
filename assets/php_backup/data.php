<?php
if (isset($_GET['c'])) {
    $champtext = $_GET['c'];
   $champinput = str_replace('.', '',str_replace('-', '',str_replace(' ', '',strtolower($champtext)))); //REMOVE SPACES, HYPHENS, PERIODS AND CONVERT TO LOWERCASE


//GET FUNCTIONS 
include "functions.php";

//FUNCTION TO RETURN ARRAY OF HEADERS FROM FIRST ROW OF DATA. INPUTS: FIRST ROW OF DATA
$hjson = getheaders('data!1:1');

//GET ALL DATA FROM API EXCEPT HEADERS. EXTRACT VALUES AND RETURN ARRAY
$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/data!a2:an150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$ndata = $narray['values'];

//FUNCTION TO RETURN CHAMP ID. INPUTS: QUERYSTRING, DATA ARRAY, HEADERS ARRAY
$champid = newcidfinder($champinput,'master_info!a2:r150');

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
            
           // $id . '_sig_Avail' => $njson[intval(array_find('sig_Avail', $hjson))],            
            $id . '_sig_value_type' => $njson[intval(array_find('sig_value_type', $hjson))],
            $id . '_sig_0' => $njson[intval(array_find('sig_0', $hjson))],
            $id . '_sig_20' => $njson[intval(array_find('sig_20', $hjson))],
            $id . '_sig_40' => $njson[intval(array_find('sig_40', $hjson))],
            $id . '_sig_60' => $njson[intval(array_find('sig_60', $hjson))],
            $id . '_sig_80' => $njson[intval(array_find('sig_80', $hjson))],
            $id . '_sig_99' => $njson[intval(array_find('sig_99', $hjson))],
            $id . '_sig_desc' => $njson[intval(array_find('sig_desc', $hjson))],
            
            $id . '_4s_Lvl0' => $njson[intval(array_find('4s_Lvl0', $hjson))],
            $id . '_4s_Lvl20' => $njson[intval(array_find('4s_Lvl20', $hjson))],
            $id . '_4s_Lvl40' => $njson[intval(array_find('4s_Lvl40', $hjson))],
            $id . '_4s_Lvl60' => $njson[intval(array_find('4s_Lvl60', $hjson))],
            $id . '_4s_Lvl80' => $njson[intval(array_find('4s_Lvl80', $hjson))],
            $id . '_4s_Lvl99' => $njson[intval(array_find('4s_Lvl99', $hjson))],
            $id . '_4s_Rank' => $njson[intval(array_find('4s_Rank', $hjson))],
            $id . '_4s_RankbyClass' => $njson[intval(array_find('4s_RankbyClass', $hjson))],
            
            $id . '_5s_Lvl0' => $njson[intval(array_find('5s_Lvl0', $hjson))],
            $id . '_5s_Lvl20' => $njson[intval(array_find('5s_Lvl20', $hjson))],
            $id . '_5s_Lvl40' => $njson[intval(array_find('5s_Lvl40', $hjson))],
            $id . '_5s_Lvl60' => $njson[intval(array_find('5s_Lvl60', $hjson))],
            $id . '_5s_Lvl80' => $njson[intval(array_find('5s_Lvl80', $hjson))],
            $id . '_5s_Lvl99' => $njson[intval(array_find('5s_Lvl99', $hjson))],
            $id . '_5s_Lvl120' => $njson[intval(array_find('5s_Lvl120', $hjson))],
            $id . '_5s_Lvl140' => $njson[intval(array_find('5s_Lvl140', $hjson))],
            $id . '_5s_Lvl160' => $njson[intval(array_find('5s_Lvl160', $hjson))],
            $id . '_5s_Lvl180' => $njson[intval(array_find('5s_Lvl180', $hjson))],
            $id . '_5s_Lvl200' => $njson[intval(array_find('5s_Lvl200', $hjson))],
            $id . '_5s_Rank' => $njson[intval(array_find('5s_Rank', $hjson))],
            $id . '_5s_RankbyClass' => $njson[intval(array_find('5s_RankbyClass', $hjson))]
        );
	$hero_array = array_merge($thisarray,$hero_array); //APPEND EACH LINE TO THE LAST LINE	
};

//FIND THE VALUES SPECIFIC TO THE INPUT CHAMPION FROM THE QUERYSTRING
$name = $hero_array[$champid . '_name'];
$img = $hero_array[$champid . '_img'];
$heroclass_name = $hero_array[$champid . '_class'];

//$sig_Avail = $hero_array[$champid . '_sig_Avail'];
$sig_value_type = $hero_array[$champid . '_sig_value_type'];
$sig_0 = $hero_array[$champid . '_sig_0'];
$sig_20 = $hero_array[$champid . '_sig_20'];
$sig_40 = $hero_array[$champid . '_sig_40'];
$sig_60 = $hero_array[$champid . '_sig_60'];
$sig_80 = $hero_array[$champid . '_sig_80'];
$sig_99 = $hero_array[$champid . '_sig_99'];
$sig_desc = $hero_array[$champid . '_sig_desc'];
    
$fourStrLvl0 = $hero_array[$champid . '_4s_Lvl0'];
$fourStr_Lvl20 = $hero_array[$champid . '_4s_Lvl20'];
$fourStr_Lvl40 = $hero_array[$champid . '_4s_Lvl40'];
$fourStr_Lvl60 = $hero_array[$champid . '_4s_Lvl60'];
$fourStr_Lvl80 = $hero_array[$champid . '_4s_Lvl80'];
$fourStr_Lvl99 = $hero_array[$champid . '_4s_Lvl99'];
$fourStr_Rank = $hero_array[$champid . '_4s_Rank'];
$fourStr_RankbyClass = $hero_array[$champid . '_4s_RankbyClass'];
    
$fiveStr_Lvl0 = $hero_array[$champid . '_5s_Lvl0'];
$fiveStr_Lvl20 = $hero_array[$champid . '_5s_Lvl20'];
$fiveStr_Lvl40 = $hero_array[$champid . '_5s_Lvl40'];
$fiveStr_Lvl60 = $hero_array[$champid . '_5s_Lvl60'];
$fiveStr_Lvl80 = $hero_array[$champid . '_5s_Lvl80'];
$fiveStr_Lvl99 = $hero_array[$champid . '_5s_Lvl99'];
$fiveStr_Lvl120 = $hero_array[$champid . '_5s_Lvl120'];
$fiveStr_Lvl140 = $hero_array[$champid . '_5s_Lvl140'];
$fiveStr_Lvl160 = $hero_array[$champid . '_5s_Lvl160'];
$fiveStr_Lvl180 = $hero_array[$champid . '_5s_Lvl180'];
$fiveStr_Lvl200 = $hero_array[$champid . '_5s_Lvl200'];
$fiveStr_Rank = $hero_array[$champid . '_5s_Rank'];
$fiveStr_RankbyClass = $hero_array[$champid . '_5s_RankbyClass'];
    

if ($sig_0 || $sig_20 || $sig_40 || $sig_60 || $sig_80 || $sig_99) {
    $sig_head = '[b][b]**Signature Ability**';
    $sig_subhead = '[b][b]';
}

if ($sig_value_type) { $sig_value_type_f = '[b][b] - *Type:* **' . $sig_value_type . '**';}
if ($sig_0) { $sig_0_f = '0 [a] ' . $sig_0 . '  |  ';}
if ($sig_20) { $sig_20_f = '20 [a] ' . $sig_20 . '  |  ';}
if ($sig_40) { $sig_40_f = '40 [a] ' . $sig_40 . '  |  ';}
if ($sig_60) { $sig_60_f = '60 [a] ' . $sig_60 . '  |  ';}
if ($sig_80) { $sig_80_f = '80 [a] ' . $sig_80 . '  |  ';}
if ($sig_99) { $sig_99_f = '99 [a] ' . $sig_99 . '';}
if ($sig_desc) { $sig_desc_f = '[b] - *Description:* ' . $sig_desc . '';} 

if ($fourStr_Lvl0) { $fourStr_Lvl0_f = '0 [a] ' . $fourStr_Lvl0 . '  |  ';}
if ($fourStr_Lvl20) { $fourStr_Lvl20_f = '20 [a] ' . $fourStr_Lvl20 . '  |  ';}
if ($fourStr_Lvl40) { $fourStr_Lvl40_f = '40 [a] ' . $fourStr_Lvl40 . '  |  ';}
if ($fourStr_Lvl60) { $fourStr_Lvl60_f = '60 [a] ' . $fourStr_Lvl60 . '  |  ';}
if ($fourStr_Lvl80) { $fourStr_Lvl80_f = '80 [a] ' . $fourStr_Lvl80 . '  |  ';}
if ($fourStr_Lvl99) { $fourStr_Lvl99_f = '99 [a] ' . $fourStr_Lvl99 . '';}
if ($fourStr_Rank) { 
    $fourStr_Rank_f = ' [b] [b] - *PI Rank Overall:* **' . $fourStr_Rank . '**';
    $fourStr_head = ' [b] [b] **4 [s]5/50 ' . $name. ' - PI**';
    $fourStr_subhead = '[b][b]';
}
if ($fourStr_RankbyClass) { $fourStr_RankbyClass_f = '[b] - *PI Rank by Class:* **' . $fourStr_RankbyClass . '**';}
    
if ($fiveStr_Lvl0) { $fiveStr_Lvl0_f = '0 [a] ' . $fiveStr_Lvl0 . '  |  ';}
if ($fiveStr_Lvl20) { $fiveStr_Lvl20_f = '20 [a] ' . $fiveStr_Lvl20 . '  |  ';}
if ($fiveStr_Lvl40) { $fiveStr_Lvl40_f = '40 [a] ' . $fiveStr_Lvl40 . '  |  ';}
if ($fiveStr_Lvl60) { $fiveStr_Lvl60_f = '60 [a] ' . $fiveStr_Lvl60 . '  |  ';}
if ($fiveStr_Lvl80) { $fiveStr_Lvl80_f = '80 [a] ' . $fiveStr_Lvl80 . '  |  ';}
if ($fiveStr_Lvl99) { $fiveStr_Lvl99_f = '99 [a] ' . $fiveStr_Lvl99 . '  |  ';}
if ($fiveStr_Lvl120) { $fiveStr_Lvl120_f = '120 [a] ' . $fiveStr_Lvl120 . '  |  ';}
if ($fiveStr_Lvl140) { $fiveStr_Lvl140_f = '140 [a] ' . $fiveStr_Lvl140 . '  |  ';}
if ($fiveStr_Lvl160) { $fiveStr_Lvl160_f = '160 [a] ' . $fiveStr_Lvl160 . '  |  ';}
if ($fiveStr_Lvl180) { $fiveStr_Lvl180_f = '180 [a] ' . $fiveStr_Lvl180 . '  |  ';}
if ($fiveStr_Lvl200) { $fiveStr_Lvl200_f = '200 [a] ' . $fiveStr_Lvl200 . '';}
if ($fiveStr_Rank) {
    $fiveStr_head = '[b][b]**5 [s]4/45 ' . $name. ' - PI**';
    $fiveStr_subhead = '[b][b]';
    $fiveStr_Rank_f = '[b][b] - *PI Rank Overall:* **' . $fiveStr_Rank . '**';
}
if ($fiveStr_RankbyClass) { $fiveStr_RankbyClass_f = '[b] - *PI Rank by Class:* **' . $fiveStr_RankbyClass . '**';}   
    

$heroclass_icon = 'https://assgardians.000webhostapp.com/mcoc_db/imgs/class_icons/' . $heroclass_name . '.png';
    
$datavalues = $sig_head . $sig_subhead . $sig_0_f . $sig_20_f . $sig_40_f . $sig_60_f . $sig_80_f . $sig_99_f . $sig_value_type_f . $sig_desc_f . $fourStr_head . $fourStr_subhead . $fourStr_Lvl0_f . $fourStr_Lvl20_f . $fourStr_Lvl40_f . $fourStr_Lvl60_f . $fourStr_Lvl80_f . $fourStr_Lvl99_f . $fourStr_Rank_f . $fourStr_RankbyClass_f . $fiveStr_head . $fiveStr_subhead . $fiveStr_Lvl0_f . $fiveStr_Lvl20_f . $fiveStr_Lvl40_f . $fiveStr_Lvl60_f . $fiveStr_Lvl80_f . $fiveStr_Lvl99_f . $fiveStr_Lvl120_f . $fiveStr_Lvl140_f . $fiveStr_Lvl160_f . $fiveStr_Lvl180_f . $fiveStr_Lvl200_f . $fiveStr_Rank_f . $fiveStr_RankbyClass_f;

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
'datavalues' => $datavalues
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
'datavalues' => 'N/A'
);
$newjson = json_encode($echoarray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
}

echo $newjson;
