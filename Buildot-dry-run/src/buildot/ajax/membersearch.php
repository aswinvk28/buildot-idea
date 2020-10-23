<?php
ini_set("display_errors",0);
$key = strtolower($_REQUEST['q']);
if (!$key) return;


$sql = "SELECT * FROM members WHERE first_name LIKE '%$key%' and status = 1";
$results = $db->select($sql);

foreach($results as $res){
	echo $res['first_name']."\n";
}

?>