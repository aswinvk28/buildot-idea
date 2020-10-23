<?php
//ini_set("display_errors",1);
checkAdmin();

$page = $_GET['page'];
$limit = 50;
$pageURL= 'index.php?view=moreUpdates';
$memberId = $_SESSION['user']['member_id'];
$updateuId = $_GET['updateuId'];


if($_POST){
	$update_id = $_POST['update_id'];
	if(!empty($update_id)){
		
		$message = $_POST['comment'];
	
	if(empty($message)){
			$_SESSION['errors'][] = "Please Enter the Comment";
			$error = 1;
		}
		
		if($error != 1){
			$reply_data = array();
			$reply_data['message'] = $message;
			$reply_data['send_by'] = $memberId;
			$reply_data['update_id'] = $update_id;
			$reply_data['created'] = 'NOW()';
			
			$db->insert("update_reply",$reply_data);
			$updatereplyId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has replied on the update for:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'update_reply';
			$update_data['ids'] = $updatereplyId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=moreUpdates#update_$update_id");
		}
		
		//header("Location: index.php?view=moreUpdates#update_$update_id");
	//exit;
	}
}
//for hiding the updates
if($_GET['hide'] == 1){
	 $updateId = $_GET['updateId'];
	
	$hide_data = array();
	$hide_data['member_id'] = $memberId;
	$hide_data['update_id'] = $updateId;
	$hide_data['created'] = 'NOW()';
	
	$db->insert("hide_updates",$hide_data);
	$_SESSION['messages'] = "The update is hidden <a href='index.php?view=moreUpdates&hide=2&updateId=$updateId'>Undo</a>" ;
	header("Location: index.php?view=moreUpdates");
	exit;
	
	}else if($_GET['hide'] == 2){
		 $updateId = $_GET['updateId'];
		
		$db->delete("hide_updates","update_id = $updateId");
	}
//for reporting the abuse	
if($_GET['report'] == 1){
	 $updateId = $_GET['updateId'];
	
	$abuse_data = array();
	$abuse_data['table_name'] = 'updates';
	$abuse_data['id'] = $updateId;
	$abuse_data['created'] = 'NOW()';
	
	$db->insert("abuse_reports",$abuse_data);
	$_SESSION['messages'] = 'The abuse has been reported';
	header("Location: index.php?view=moreUpdates");
	exit;
	
	}
if($_GET['delete'] == 1){
	$reply_id = $_GET['reply_id'];
	$updateId = $_GET['update_id'];

	if(!empty($reply_id)){
		$sql ="SELECT * from updates where table_name='update_reply' and ids = '$reply_id'";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
			if(!empty($updateId)){
			$db->delete("updates","id = $updateId");
		}
		
		$db->delete("update_reply","reply_id = $reply_id");
		$_SESSION['messages'] = "reply has been deleted";
	}
	
	
	if(!empty($updateId)){
		$db->delete("updates","id = '$updateId'");
		$_SESSION['messages'] = "update has been deleted";
	}
	
	header("Location:index.php?view=moreUpdates");
	exit;
	
}
$member_email = $_SESSION['user']['email'];
$memberId = $_SESSION['user']['member_id'];

$sql = "SELECT * FROM members ORDER BY created DESC LIMIT 8";
$members = $db->select($sql);

$sql = "SELECT * from groups ORDER BY created DESC LIMIT 8";
$groups = $db->select($sql);

$sql = "SELECT * from company ORDER BY created DESC LIMIT 7";
$companies = $db->select($sql);

$sql = "SELECT * from events ORDER BY created DESC LIMIT 8";
$events = $db->select($sql);

$filter = '';
if(!empty($updateuId)){
	$filter .= " AND upd.id = '$updateuId'";
}

$sql="SELECT m.first_name,m.last_name,m.member_photo,upd.*,DATE_FORMAT(upd.created,'%d-%m-%Y %h:%i %p') AS datetime, comp.logo,m.company_id,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(upd.created) AS createdunixtime FROM updates AS upd
		LEFT JOIN members AS m ON m.member_id = upd.member_id
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE 1=1 $filter AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
		AND fr.status='request accepted' AND upd.table_name <> 'job_application' AND upd.id NOT IN (SELECT update_id FROM hide_updates WHERE member_id = '$memberId' UNION SELECT id from abuse_reports where table_name = 'updates')
	UNION
	SELECT m.first_name,m.last_name,m.member_photo,upd.*,DATE_FORMAT(upd.created,'%d-%m-%Y %h:%i %p') AS datetime,comp.logo,m.company_id,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(upd.created) AS createdunixtime FROM updates AS upd
		LEFT JOIN members AS m ON m.member_id = upd.member_id
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN job_openings AS jo ON (jo.job_opening_id = upd.ids)
		WHERE  1=1 $filter AND  jo.created_by = '$memberId' AND
		upd.table_name = 'job_application' AND upd.id NOT IN (SELECT update_id FROM hide_updates WHERE member_id = '$memberId' UNION SELECT id from abuse_reports where table_name = 'updates')
		ORDER BY created DESC";
$updates = $db->select($sql,$limit,$page);
$updatesCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $updatesCount, $page, $pageURL);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>