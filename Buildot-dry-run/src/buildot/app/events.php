<?php
checkAdmin();
$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=events';

$loggedmember= $_SESSION['user']['member_id'];

if($_GET['delete']==1){
$event_id = $_GET['eventId'];
	
	$sql ="SELECT * from updates where table_name='events' and ids = $event_id";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	
	$db->delete("events","event_id = $event_id");
	$_SESSION['messages'] = "event is deleted";
	header("Location:index.php?view=events");
	exit;
}


$sql = "SELECT * from events ORDER BY created DESC limit 5";
$recentEvents = $db->select($sql);


$sql = "SELECT con.country,con.country_letter,m.first_name,m.last_name,e.* FROM events AS e
		LEFT JOIN members AS m ON (m.member_id = e.created_by) 
		LEFT JOIN countries AS con ON (con.countryId = e.countryId)
		ORDER BY created DESC";
$events = $db->select($sql,$limit,$page);
$eventCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $eventCount, $page, $pageURL);

if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>