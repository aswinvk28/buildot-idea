<?php
ini_set("display_errors",0);
$key = strtolower($_REQUEST['q']);
if (!$key) return;


$sql = "SELECT * FROM company WHERE company_name LIKE '%$key%'";
$results = $db->select($sql);

foreach($results as $res){
	echo $res['company_name']."\n";
}

?>