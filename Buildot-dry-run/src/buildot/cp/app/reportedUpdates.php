<?php

$page = $_GET['page'];
$limit = 50;
$pageURL= 'index.php?view=reportedUpdates';

//For deleting the updates
if($_GET['deleteupdate']==1){
$report_id = $_GET['reportId'];
	
	$sql ="SELECT * from abuse_reports where report_id = '$report_id'";
	$abusereport = $db->fetch($sql);
	
	$db->delete("updates","id = ".$abusereport['id']);
	$db->delete("abuse_reports","report_id = ".$report_id);
	
	$_SESSION['messages'] = "Update has been deleted successfully";

			header("Location: index.php?view=reportedUpdates");
			exit;
}
if($_GET['deletereport']==1){
$report_id = $_GET['reportId'];

	$db->delete("abuse_reports","report_id = ".$report_id);
	
	$_SESSION['messages'] = "Report has been deleted successfully";

			header("Location: index.php?view=reportedUpdates");
			exit;
}

	 $sql = "SELECT ar.report_id,ar.id,u.*,m.first_name,m.last_name,m.member_photo,m.company_id,comp.logo FROM abuse_reports AS ar 
	LEFT JOIN updates AS u ON (u.id = ar.id)
	LEFT JOIN members AS m ON (m.member_id = u.member_id)
	LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
	WHERE ar.table_name = 'updates'
	ORDER BY ar.created DESC";

$abuseReports = $db->select($sql,$limit,$page);
$reportCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $reportCount, $page, $pageURL);


?>