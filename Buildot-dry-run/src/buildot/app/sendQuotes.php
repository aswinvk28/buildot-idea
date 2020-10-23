<?php
checkAdmin();
$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=tendersReceived';
$memberId = $_SESSION['user']['member_id'];
$userId = $_SESSION['user']['user_id'];
$projectId = $_REQUEST['projectId'];

if($_POST){
	$tender_id = $_POST['tender_id'];
	$comment = $_POST['replytext'];
	
	if(empty($comment)){
			$_SESSION['errors'][] = "Please Enter the Comment";
			$error = 1;
		}
		
		if($error != 1){
			$comment_data = array();
			$comment_data['tender_id'] = $tender_id;
			$comment_data['comment'] = $comment;
			$comment_data['member_id'] = $memberId;
			$comment_data['created'] = 'NOW()';
			
			$db->insert("tender_comments",$comment_data);

			header("Location: index.php?view=sendQuotes");
		}
		
		header("Location: index.php?view=sendQuotes");
	exit;
}

if($_GET['delete'] == 1){
	$tender_id = $_GET['tender_id'];
	
	$sql ="SELECT * from updates where table_name='tenders' and ids = '$tender_id'";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	
	//for deleting the tender_comments updates from updates table.
	$sql = "SELECT * FROM updates WHERE ids IN (SELECT tender_comment_id FROM tender_comments WHERE tender_id = '$tender_id')";
	$tenderupdates = $db->select($sql);
	
	if(!empty($tenderupdates)){ 
	foreach ($tenderupdates as $tenderupdate){
		
		$update_id = $tenderupdate['id'];
		$db->delete("updates","id = $update_id");
		}}
	
	$db->delete("tenders","tender_id = $tender_id");
	
	$_SESSION['messages'] = "tender has been deleted";
	header("Location:index.php?view=sendQuotes");
	exit;
	
	}
	
if(!empty($projectId)){
$sql = "SELECT con.currency,comp.logo,m.company_id,m.member_photo,m.first_name,m.last_name,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,p.project_ref_no,p.project_name FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
				WHERE t.member_id = $memberId  AND p.project_id = $projectId
		ORDER BY p.created DESC";
}else{
	$sql = "SELECT con.currency,comp.logo,m.company_id,m.member_photo,m.first_name,m.last_name,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,p.project_ref_no,p.project_name FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
				WHERE t.member_id = $memberId
				ORDER BY t.created DESC";
}
$tendersSent = $db->select($sql,$limit,$page);
$tenderCount = $db->numrows($sql);
$paginate = $db->PHPPaginator($limit, $tenderCount, $page, $pageURL);



$sql = "SELECT * from projects where member_id <> $memberId ORDER BY created DESC limit 10";
$projects = $db->select($sql);

$sql ="SELECT m.company_id,m.member_photo,m.first_name,m.last_name,m.designation,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);

?>