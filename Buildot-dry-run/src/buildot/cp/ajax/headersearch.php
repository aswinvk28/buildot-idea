<?php
ini_set("display_errors",0);
$key = strtolower($_REQUEST['q']);
if (!$key) return;


$sql = "SELECT project_id,project_name AS title FROM projects WHERE project_name LIKE '%$key%' 
        	UNION 
		SELECT company_id,company_name FROM company where company_name LIKE '%$key%'
			UNION
		SELECT member_id,first_name FROM members where first_name LIKE '%$key%' OR last_name LIKE '%$key%'
			UNION 
		SELECT event_id,event_title FROM events where event_title LIKE '%$key%'
			UNION
		SELECT group_id,group_name FROM groups where group_name LIKE '%$key%'";
$results = $db->select($sql);

foreach($results as $res){
	echo $res['title']."\n";
}

?>