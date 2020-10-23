<?php
checkAdmin();

$page = $_GET['page'];

$groupId = $_GET['groupId'];
$memberId= $_SESSION['user']['member_id'];
if($_POST){
	$msg_id = $_POST['msg_id'];
	if(!empty($msg_id)){
		
		$message = $_POST['message'];
	
	if(empty($message)){
			$_SESSION['errors'][] = "Please Enter the Comment";
			$error = 1;
		}
		
		if($error != 1){
			$reply_data = array();
			$reply_data['reply_message'] = $message;
			$reply_data['member_id'] = $memberId;
			$reply_data['msg_id'] = $msg_id;
			$reply_data['created'] = 'NOW()';
			
			$db->insert("group_message_reply",$reply_data);
			$gmreplyId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has replied on the update for:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'group_message_reply';
			$update_data['ids'] = $gmreplyId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
		
			//header("Location: index.php?view=showGroup&groupId=$groupId");
		}
		
		//header("Location: index.php?view=showGroup&groupId=$groupId");
	//exit;
}else{
	$message = $_POST['comment'];
	
	if(empty($message)){
			$_SESSION['errors'][] = "Please Enter the Comment";
			$error = 1;
		}
		
		if($error != 1){
			$post_data = array();
			$post_data['message'] = $message;
			$post_data['group_id'] = $_POST['groupId'];
			$post_data['member_id'] = $memberId;
			$post_data['created'] = 'NOW()';
			
			$db->insert("group_message",$post_data);
			$groupMessageId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has commented on:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'group_message';
			$update_data['ids'] = $groupMessageId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=showGroup&groupId=$groupId");
		}
		
		//header("Location: index.php?view=showGroup&groupId=$groupId");
	//exit;
	
}

}
if($_GET['joingroup'] == 1){
	$group_id = $_GET['groupId'];
	
	$data = array();
	$data['group_id'] = $group_id;
	$data['member_id'] = $memberId;
	
	$db->insert("group_members",$data);
	$_SESSION['messages'] = "You have joined the group";
	header("Location:index.php?view=showGroup&groupId=$group_id");
	exit;
}
if($_GET['leavegroup'] == 1){
	$group_id = $_GET['groupId'];
	
	$sql ="SELECT gm.*,g.group_name from group_members as gm
			left join groups as g on (g.group_id = gm.group_id)
			 where gm.group_id= $group_id and gm.member_id = $memberId";
	$memberGroup = $db->fetch($sql);
	$db->delete("group_members","member_group_id =".$memberGroup['member_group_id']);
	$_SESSION['messages'] = "You have left the group ".$memberGroup['group_name'];
	header("Location:index.php?view=showGroup&groupId=$group_id");
	exit;
}
//for deleting the messages and the replies
if($_GET['delete'] == 1){
	$reply_id = $_GET['reply_id'];
	$msgId = $_GET['msg_id'];

	if(!empty($reply_id)){
		$sql ="SELECT * from updates where table_name='group_message_reply' and ids = $reply_id";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("group_message_reply","reply_id = $reply_id");
		$_SESSION['messages'] = "reply has been deleted";
	}
	
	
	if(!empty($msgId)){
		
		$sql ="SELECT * from updates where table_name='group_message' and ids = $msgId";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("group_message","msg_id = '$msgId'");
		$_SESSION['messages'] = "message has been deleted";
	}
	
	//header("Location:index.php?view=showGroup&groupId=$groupId");
	//exit;
	
}
$sql = "SELECT * from group_members where group_id = $groupId and member_id = $memberId";
$memberCount = $db->numrows($sql);

//checking the owner of the group
$sql = "SELECT * FROM groups WHERE group_id = $groupId AND group_owner = $memberId";
$checkOwner = $db->numrows($sql);

$sql = "SELECT * from groups ORDER BY created DESC LIMIT 5";
$recentGroups = $db->select($sql);


$sql = "SELECT g.*,m.first_name,m.last_name,m.company_id,m.member_photo,comp.logo,comp.company_name FROM groups AS g 
		LEFT JOIN members AS m ON (m.member_id = g.group_owner)
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		where g.group_id = $groupId";
$group = $db->fetch($sql);	

$sql="SELECT gm.*,m.first_name,m.last_name,m.member_photo,m.company_id,comp.logo FROM group_members AS gm 
		LEFT JOIN members AS m ON (m.member_id = gm.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		WHERE gm.group_id = '$groupId' ORDER BY gm.created DESC limit 12";
$groupMembers = $db->select($sql);

$sql ="SELECT gm.*,m.first_name,m.last_name,m.member_photo,m.company_id,g.group_name,comp.logo,
UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(gm.created) AS createdunixtime
 FROM group_message AS gm
		LEFT JOIN groups AS g ON (g.group_id = gm.group_id)
		LEFT JOIN members AS m ON (m.member_id = gm.member_id)
		left join company as comp on(comp.company_id = m.company_id)
		 WHERE gm.group_id = '$groupId' ORDER BY gm.created DESC limit 50";
$groupMessages = $db->select($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>