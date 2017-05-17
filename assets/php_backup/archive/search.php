<?php
if (isset($_GET['c'])) {
    $input = $_GET['c'];
 
    $champStatus = "success";
}else{
    $champStatus = "failure";
}

$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

$tag_array = array();
foreach ($njson as &$njson) {
        $id = $njson[0];
        $name_v = $njson[1];
        $tag_string_all = $njson[9] . ', ' . $njson[10];
        $thisarray = array(
			$name_v => $tag_string_all,
        );
	
	$tag_array = array_merge($thisarray,$tag_array);	
	
};

function array_find( $needle, $haystack ){
    $result = '';  //set default value
    foreach ($haystack as $key => $value) {
            if (false !== stripos($value,$needle))
                {$result .= $key . '<br>';
            }
	    }
    echo $result;
}

echo array_find($input, $tag_array);