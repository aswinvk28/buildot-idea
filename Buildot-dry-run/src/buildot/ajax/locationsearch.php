<?php
ini_set("display_errors",0);
$key = strtolower($_REQUEST['q']);
if (!$key) return;


$sql = "SELECT distinct(project_location) FROM projects WHERE project_location LIKE '%$key%'";
$results = $db->select($sql);

foreach($results as $res){
	echo $res['project_location']."\n";
}

?>