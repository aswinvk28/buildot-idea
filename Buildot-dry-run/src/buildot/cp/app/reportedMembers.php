<?php

$page = $_GET['page'];
$limit = 50;
$pageURL= 'index.php?view=reportedUpdates';

//For deleting the updates
if($_GET['deletemember']==1){
$report_id = $_GET['reportId'];
$member_id = $_GET['memberId'];

	if($report_id){
		
	if($member_id){
		$sql = "SELECT * from members where member_id = '$member_id'";
		$member = $db->fetch($sql);
		
		$db->delete("users","user_id = ".$member['user_id']);
		
		}
		$db->delete("abuse_reports","report_id = ".$report_id);
		$_SESSION['messages'] = "Member has been deleted successfully";
		
}
			header("Location: index.php?view=reportedMembers");
			exit;
}
if($_GET['deletereport']==1){
$report_id = $_GET['reportId'];

	if($report_id){
		$db->delete("abuse_reports","report_id = ".$report_id);
		$_SESSION['messages'] = "Report has been deleted successfully";
	}
			header("Location: index.php?view=reportedMembers");
			exit;
}
if($_GET['disable'] == 1 && $_GET['memberId'] > 0){

	$memberId = $_GET['memberId'];
	$sql ="SELECT * from members where member_id = '$memberId'";
	$member = $db->fetch($sql);
	
	$db->update("members",array('status' => '0'),"member_id = '$memberId'");
	$db->update("users",array('status' => '0'),"user_id = '".$member['user_id']."'");
	$_SESSION['messages'] = "Member has been disabled successfully";
	header("Location: index.php?view=members");
	exit;
}

	 $sql = "SELECT ar.report_id,ar.id,m.first_name,m.last_name,m.member_photo,m.company_id,comp.logo FROM abuse_reports AS ar
	LEFT JOIN members AS m ON (m.member_id = ar.id)
	LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
	WHERE ar.table_name = 'members'
	ORDER BY ar.created DESC";

$abuseReports = $db->select($sql,$limit,$page);
$reportCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $reportCount, $page, $pageURL);


?>