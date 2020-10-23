<?php
ini_set("display_errors",0);
$key = strtolower($_REQUEST['q']);
if (!$key) return;


$sql = "SELECT * FROM job_openings WHERE title LIKE '%$key%'";
$results = $db->select($sql);

foreach($results as $res){
	echo $res['title']."\n";
}

?>