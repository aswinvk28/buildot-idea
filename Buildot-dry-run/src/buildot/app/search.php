<?php
$key = $_REQUEST['key'];
$search = $_REQUEST['search'];

$memberId = $_SESSION['user']['member_id'];

if(empty($key)){
	$key = " ";
}


	if($search == 1){
		$sql = "SELECT project_id AS id,project_name AS name,'tenders' AS table_name FROM projects WHERE project_name LIKE '%$key%'" ;
	}else if($search == 2){
		$sql = "SELECT company_id AS id,company_name AS name,'companies' AS table_name from company where company_name LIKE '%$key%' ";
	}else if($search == 3){
		$sql = "SELECT member_id AS id,CONCAT(first_name, ' ', last_name) AS name,'members' AS table_name from members where first_name LIKE '%$key%' OR last_name LIKE '%$key%'";
	}else if($search == 4){			
		$sql = "SELECT group_id AS id,group_name AS name,'groups' AS table_name from groups where group_name LIKE '%$key%'";
	}else if($search == 5){	
		$sql = "SELECT event_id AS id,event_title AS name,'events' AS table_name from events where event_title LIKE '%$key%'";		
	}else if($search == 6){	
		$sql = "SELECT job_opening_id AS id,title AS name,'job_openings' AS table_name from job_openings where title LIKE '%$key%'";		
	}else if($search == 7){
		$sql = "SELECT project_id AS id,project_name AS name,'company_projects' AS table_name from company_projects where project_name LIKE '%$key%'";
		
	}else{
		$sql = "SELECT project_id AS id,project_name AS name,'tenders' AS table_name FROM projects WHERE project_name LIKE '%$key%'
				UNION SELECT company_id AS id,company_name AS name,'companies' AS table_name from company where company_name LIKE '%$key%'
				UNION SELECT member_id AS id,CONCAT(first_name, ' ', last_name) AS name,'members' AS table_name from members where first_name LIKE '%$key%' OR last_name LIKE '%$key%'
				UNION SELECT group_id AS id,group_name AS name,'groups' AS table_name from groups where group_name LIKE '%$key%'
				UNION SELECT event_id AS id,event_title AS name,'events' AS table_name from events where event_title LIKE '%$key%'
				UNION SELECT job_opening_id AS id,title AS name,'job_openings' AS table_name from job_openings where title LIKE '%$key%'
				UNION SELECT project_id AS id,project_name AS name,'company_projects' AS table_name from company_projects where project_name LIKE '%$key%'	" ;
		
	}
	$results = $db->select($sql);
	$resultCount= $db->numrows($sql);



if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>