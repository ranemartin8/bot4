<?php
if (isset($_GET['c'])) {
    $input = $_GET['c'];


include 'functions.php';

$nurl = 'https://sheets.googleapis.com/v4/spreadsheets/15Yj-AA3pMYKICzLporqAZTutCdT7fNA8Z3uScmM3guo/values/master_info!a2:r150?key=AIzaSyBugcjKbOABZEn-tBOxkj0O7j5WGyz80uA';
$nfile = file_get_contents($nurl);
$narray = json_decode($nfile, true);
$njson = $narray['values'];

$hjson = getheaders('master_info!1:1');

$tag_array = array();
foreach ($njson as $njson) {
        $id = $njson[intval(array_find('id', $hjson))];
        $name_v = $njson[intval(array_find('name', $hjson))];
        $tag_string_all = $njson[intval(array_find('tag_ability', $hjson))] . ', ' . $njson[intval(array_find('tag_game', $hjson))];
        $thisarray = array(
			$name_v => $tag_string_all,
        );
	$tag_array = array_merge($tag_array,$thisarray);	
};

$searchresults = array_similar($input, $tag_array);

if (!$searchresults) {
echo ':warning: No results found.';

}else {
echo $searchresults;
}

}else{
echo 'A search keyword must be provided.';
}