<?php
//exit;
checkAdmin();

$page = $_GET['page'];
$limit = 5;

$userId = $_SESSION['user']['user_id'];
$memberId = $_SESSION['user']['member_id'];
$myCompanyId=$_SESSION['user']['company_id'];

if($_POST){
	
	//this section for the replies to the updates.
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
		
			//header("Location: index.php?view=member_home#update_$update_id");
		}
		
		//header("Location: index.php?view=member_home#update_$update_id");
	//exit;
	}else{
		//this section for the posts 
		$message = $_POST['message'];
	
	if(empty($message)){
			$_SESSION['errors'][] = "Please Enter the Comment";
			$error = 1;
		}
		
		if($error != 1){
			$post_data = array();
			$post_data['message'] = $message;
			$post_data['send_by'] = $memberId;
			if(!empty($_FILES['image']['tmp_name'])){

					$post_data['attachment'] = DocUpload('image');
					
		}
		
			$post_data['created'] = 'NOW()';
			
			$db->insert("posts",$post_data);
			$postId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has shared an update';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'posts';
			$update_data['ids'] = $postId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			header("Location: index.php?view=member_home");
		}
		
		header("Location: index.php?view=member_home");
	exit;
		
		}
}
if($_GET['hide'] == 1){
	 $updateId = $_GET['updateId'];
	
	$hide_data = array();
	$hide_data['member_id'] = $memberId;
	$hide_data['update_id'] = $updateId;
	$hide_data['created'] = 'NOW()';
	
	$db->insert("hide_updates",$hide_data);
	$_SESSION['messages'] = "The update is hidden <a href='index.php?view=member_home&hide=2&updateId=$updateId'>Undo</a>" ;
	header("Location: index.php?view=member_home");
	exit;
	
	}else if($_GET['hide'] == 2){
		 $updateId = $_GET['updateId'];
		
		$db->delete("hide_updates","update_id = $updateId");
	}
	
if($_GET['report'] == 1){
	 $updateId = $_GET['updateId'];
	
	$abuse_data = array();
	$abuse_data['table_name'] = 'updates';
	$abuse_data['id'] = $updateId;
	$abuse_data['created'] = 'NOW()';
	
	$db->insert("abuse_reports",$abuse_data);
	$_SESSION['messages'] = 'The abuse has been reported';
	header("Location: index.php?view=member_home");
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
	
	header("Location:index.php?view=member_home");
	exit;
	
}
//$sql ="SELECT p.*,mem.*,comp.logo FROM posts AS p
//LEFT JOIN members AS mem ON (mem.member_id = p.send_by)
//LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
//WHERE send_by = $memberId
//OR send_by IN(SELECT from_member_id FROM friend_requests WHERE (from_member_id = $memberId OR to_member_id = $memberId) AND //STATUS ='request accepted')
//OR send_by IN(SELECT to_member_id FROM friend_requests WHERE (from_member_id = $memberId OR to_member_id = $memberId) AND //STATUS ='request accepted')
//ORDER BY p.created DESC limit 10";
//$posts = $db->select($sql);
$sql = "SELECT * from hide_updates where member_id = '$memberId'";
$hideUpdates = $db->select($sql);


$sql="SELECT m.first_name,m.last_name,m.member_photo,upd.*,DATE_FORMAT(upd.created,'%d-%m-%Y %h:%i %p') AS datetime, comp.logo,m.company_id,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(upd.created) AS createdunixtime FROM updates AS upd
		LEFT JOIN members AS m ON m.member_id = upd.member_id
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
		AND fr.status='request accepted' AND m.status = 1 AND upd.table_name <> 'job_application' AND upd.id NOT IN (SELECT update_id FROM hide_updates WHERE member_id = '$memberId' UNION SELECT id from abuse_reports where table_name = 'updates')
	UNION
	SELECT m.first_name,m.last_name,m.member_photo,upd.*,DATE_FORMAT(upd.created,'%d-%m-%Y %h:%i %p') AS datetime,comp.logo,m.company_id,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(upd.created) AS createdunixtime FROM updates AS upd
		LEFT JOIN members AS m ON m.member_id = upd.member_id
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN job_openings AS jo ON (jo.job_opening_id = upd.ids)
		WHERE  jo.created_by = '$memberId' AND m.status = 1 AND
		upd.table_name = 'job_application' AND upd.id NOT IN (SELECT update_id FROM hide_updates WHERE member_id = '$memberId' UNION SELECT id from abuse_reports where table_name = 'updates')
		ORDER BY created DESC LIMIT 30";
$updates =$db->select($sql);
$updateCount = $db->numrows($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}


?>