<?php

$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

foreach ($njson as $njson) {

	    $add = $njson[0] . '_';
		$id_v = $njson[0];
        $name_v = $njson[1];
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
            $img_n => $img_v, 
            $url_1_n => $url_1_v, 
            $video_n => $video_v, 
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