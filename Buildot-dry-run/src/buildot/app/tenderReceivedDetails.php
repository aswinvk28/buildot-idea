<?php
checkAdmin();

$page = $_GET['page'];
$memberId = $_SESSION['user']['member_id'];
$userId = $_SESSION['user']['user_id'];
$projectId = $_REQUEST['projectId'];
$tenderId = $_REQUEST['tenderId'];

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
			
			$tenderCommentId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has commented on:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'tender_comments';
			$update_data['ids'] = $tenderCommentId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
			//$_SESSION['messages'] = "Your Project has been added";
			
			header("Location: index.php?view=tenderReceivedDetails&tenderId=$tender_id");
			exit;
		}
		
			header("Location: index.php?view=tenderReceivedDetails&tenderId=$tender_id");
	exit;
}

//for updating the read tenders
if(!empty($tenderId)){

$sql ="SELECT * from read_tenders where member_id = '$memberId' AND tender_id = '$tenderId'";
$count = $db->numrows($sql);
	
	if($count == 0){
		$data = array();
		$data['member_id'] = $memberId;
		$data['tender_id'] = $tenderId;

	  $db->insert("read_tenders",$data);
	  $sql = "UPDATE tenders SET count = count+1 WHERE tender_id = '$tenderId' AND member_id <> '$memberId'";
	$db->SQLQuery($sql);		
	}
	
	
}
			
//for deleting the tender comments			
if($_GET['delete'] == 1){
	$tenderId = $_GET['tenderId'];
	$tender_comment_id = $_GET['tender_comment_id'];

	if(!empty($tender_comment_id)){
		
		$sql ="SELECT * from updates where table_name='tender_comments' and ids = $tender_comment_id";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	
		$db->delete("tender_comments","tender_comment_id = $tender_comment_id");
		$_SESSION['messages'] = "comment has been deleted";
	}
	

	header("Location:index.php?view=tenderReceivedDetails&tenderId=$tenderId");
	exit;
	
}
if(!empty($projectId) && !empty($tenderId)){
  $sql = "SELECT comp.logo,comp.company_name,m.company_id,m.member_photo,m.first_name,m.last_name,m.member_id,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,t.count,p.project_ref_no,p.project_name,con.currency FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
				WHERE p.project_id = '$projectId' and t.tender_id = '$tenderId'";
}else if(!empty($projectId)){
 $sql = "SELECT comp.logo,comp.company_name,m.company_id,m.member_photo,m.first_name,m.last_name,m.member_id,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,t.count,p.project_ref_no,p.project_name,con.currency FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
				WHERE p.project_id = '$projectId'";
}else if(!empty($tenderId)){
  $sql = "SELECT comp.logo,comp.company_name,m.company_id,m.member_photo,m.first_name,m.last_name,m.member_id,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,t.count,p.project_ref_no,p.project_name,con.currency FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
				WHERE t.tender_id = '$tenderId'";
}else{
	 $sql = "SELECT con.currency,comp.logo,comp.company_name,m.company_id,m.member_photo,m.first_name,m.last_name,m.member_id,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,t.count,p.project_ref_no,p.project_name FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
				WHERE p.member_id = '$memberId' and t.tender_id ='$tenderId'";
}
$tenderReceived = $db->fetch($sql);

//$sql = "SELECT * from projects where member_id = $memberId";
$sql ="SELECT p.* FROM projects AS p 
LEFT JOIN share_invites AS si ON (si.to_member_id = $memberId)
WHERE p.member_id = $memberId OR p.member_id = si.from_member_id";
$projects = $db->select($sql);

$sql ="SELECT m.member_photo,m.first_name,m.last_name,m.company_id,m.designation,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);

?>