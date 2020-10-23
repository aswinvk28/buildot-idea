<?php
ini_set("display_errors",0);
$key = strtolower($_REQUEST['q']);
if (!$key) return;


$sql = "SELECT * FROM company_projects WHERE project_name LIKE '%$key%'";
$results = $db->select($sql);

foreach($results as $res){
	echo $res['project_name']."\n";
}

?>