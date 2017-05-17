
<?php

// GET HEADER POSITIONS
$hurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a1:r1?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$hfile = file_get_contents($hurl);
$harray = json_decode($hfile, true);
$hjson = $harray['values'][0];

function array_find( $needle, $haystack ){
    $result = '';  //set default value
    foreach ($haystack as $key => $value) {
            if ($value == $needle)
                {$result .= $key . '<br>';
}
}
    return $result;
}


$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

//$first = true;

foreach ($njson as $njson) {
	
$img = $njson[intval(array_find('img', $hjson))];
$url = $njson[intval(array_find('url_1', $hjson))];
$video = $njson[intval(array_find('video', $hjson))];

if(strlen($img)<1){
$imghtml = "<img id='c_icon' src='https://assgardians.000webhostapp.com/mcoc_db/imgs/champs2/unknown.png'/>";
}else{
$imghtml = "<img id='c_icon' src='" . $img . "'/>";
}

if(strlen($url)<1){
$urlhtml = "";
}else{
$urlhtml = "<a id='c_url' target='_blank' href='" . $url . "' >Learn More</a>";
}

if(strlen($video)<1){
$videohtml = "";
}else{
       $videohtml = "<a id='c_vide' target='_blank' href='" . $video . "' >See Special Attacks</a>";
}
    	$abedit = str_replace(' (a)', '*',   $njson[intval(array_find('tag_ability', $hjson))]);
        $abfinal = str_replace(' (e)', '**',   $abedit);

        $hero_array[] = array(
	    'id' => $njson[intval(array_find('id', $hjson))],
            'name' => $njson[intval(array_find('name', $hjson))],
            'class' => ucwords(strtolower($njson[intval(array_find('class', $hjson))])), 
            'img' => $imghtml, 
            'url_1' => $urlhtml, 
            'video' => $videohtml, 
            'seatin_o' => $njson[intval(array_find('seatin_o', $hjson))], 
            'seatin_d' => $njson[intval(array_find('seatin_d', $hjson))], 
            'ability_string' => $abfinal, 
            'tag_string' => $njson[intval(array_find('tag_game', $hjson))]           
        );
	
};
echo json_encode($hero_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


//$allthedata = json_encode($hero_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

//echo $allthedata;
//echo json_encode($hero_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);





----------------



<?php

// GET HEADER POSITIONS
$hurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a1:r1?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$hfile = file_get_contents($hurl);
$harray = json_decode($hfile, true);
$hjson = $harray['values'][0];

function array_find( $needle, $haystack ){
    $result = '';  //set default value
    foreach ($haystack as $key => $value) {
            if ($value == $needle)
                {$result .= $key . '<br>';
}
}
    return $result;
}


$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

//$first = true;

foreach ($njson as $njson) {

	// $add = $njson[intval(array_find('id', $hjson))] . '_';
	$id_v = $njson[intval(array_find('id', $hjson))];
        $name_v = $njson[intval(array_find('name', $hjson))];
        $class_v = $njson[3];
        $img_v = $njson[4];
        $url_1_v = $njson[5];
        $video_v = $njson[6];
        $seatin_o_v = $njson[7];
        $seatin_d_v = $njson[8];
        $ability_string_v = $njson[9];
        $tag_string_v = $njson[10];  
    
    	$abedit = str_replace(' (a)', '*',   $ability_string_v);
        $abfinal = str_replace(' (e)', '**',   $abedit);
        $titleclass = ucwords(strtolower($class_v));

if($img_v==null){
$imghtml = "<img id='c_icon' src='https://assgardians.000webhostapp.com/mcoc_db/imgs/champs2/unknown.png'/>";
}else{
$imghtml = "<img id='c_icon' src='" . $img_v . "'/>";
}

if(strlen($url_1_v)<3){
$urlhtml = "";
}else{
$urlhtml = "<a id='c_url' target='_blank' href='" . $url_1_v . "' >Learn More</a>";
}

if(strlen($video_v)<3){
$videohtml = "";
}else{
       $videohtml = "<a id='c_vide' target='_blank' href='" . $video_v . "' >See Special Attacks</a>";
}
       

		$id_n = 'id';
        $name_n =  'name';	
        $class_n =  'class';
        $img_n = 'img';   
        $url_1_n =  'url_1';      
        $video_n =  'video';   
        $seatin_o_n =  'seatin_o';
        $seatin_d_n =  'seatin_d';    
        $ability_string_n =  'ability_string';
        $tag_string_n = 'tag_string';

        $hero_array[] = array(
			$id_n => $id_v,
			$name_n => $name_v,
            $class_n => $titleclass, 
            $img_n => $imghtml, 
            $url_1_n => $urlhtml, 
            $video_n => $videohtml, 
            $seatin_o_n => $seatin_o_v, 
            $seatin_d_n => $seatin_d_v,
            $ability_string_n => $abfinal, 
            $tag_string_n => $tag_string_v            
        );
	
};
echo json_encode($hero_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


//$allthedata = json_encode($hero_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

//echo $allthedata;
//echo json_encode($hero_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);