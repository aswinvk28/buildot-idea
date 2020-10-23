<?php
checkAdmin();
$page = $_GET['page'];

$eventId = $_GET['eventId'];
$loggedmemberId = $_SESSION['user']['member_id'];
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
			$reply_data['member_id'] = $loggedmemberId;
			$reply_data['msg_id'] = $msg_id;
			$reply_data['created'] = 'NOW()';
			
			$db->insert("event_message_reply",$reply_data);
			$emreplyId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has replied on the update for:';
			$update_data['member_id'] = $loggedmemberId;
			$update_data['table_name'] = 'event_message_reply';
			$update_data['ids'] = $emreplyId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=showEvent&eventId=$eventId");
		}
		
		//header("Location: index.php?view=showEvent&eventId=$eventId");
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
			$post_data['event_id'] = $_POST['eventId'];
			$post_data['member_id'] = $loggedmemberId;
			$post_data['created'] = 'NOW()';
			
			$db->insert("event_message",$post_data);
			$eventMessageId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has commented on:';
			$update_data['member_id'] = $loggedmemberId;
			$update_data['table_name'] = 'event_message';
			$update_data['ids'] = $eventMessageId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=showEvent&eventId=$eventId");
		}
		
		//header("Location: index.php?view=showEvent&eventId=$eventId");
	//exit;
	
}

}
 if($_GET['delete'] == 1){
	$reply_id = $_GET['reply_id'];
	$msgId = $_GET['msg_id'];

	if(!empty($reply_id)){
		$sql ="SELECT * from updates where table_name='event_message_reply' and ids = '$reply_id'";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("event_message_reply","reply_id = $reply_id");
		$_SESSION['messages'] = "reply has been deleted";
	}
	
	
	if(!empty($msgId)){
		$sql ="SELECT * from updates where table_name='event_message' and ids = $msgId";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("event_message","msg_id = '$msgId'");
		$_SESSION['messages'] = "message has been deleted";
	}
	
	header("Location:index.php?view=showEvent&eventId=$eventId");
	exit;
	
}
$sql = "SELECT * from events ORDER BY created DESC limit 5";
$recentEvents = $db->select($sql);


$sql = "SELECT e.*,m.first_name,m.last_name,m.member_photo,m.company_id,comp.logo,con.country,con.country_letter,DATE_FORMAT(event_date,'%d-%m-%Y %h:%i %p') AS datetime  from events AS e
		LEFT JOIN members AS m ON (m.member_id = e.created_by)
		LEFT JOIN company As comp ON (comp.company_id = m.company_id)
		LEFT JOIN countries AS con ON (con.countryId = e.countryId)
		WHERE e.event_id = $eventId";
$event = $db->fetch($sql);	

$sql ="SELECT em.*,m.first_name,m.last_name,m.member_photo,m.company_id,e.event_title,comp.logo,
UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(em.created) AS createdunixtime
 FROM event_message AS em
		LEFT JOIN events AS e ON (e.event_id = em.event_id)
		LEFT JOIN members AS m ON (m.member_id = em.member_id)
		left join company as comp on(comp.company_id = m.company_id)
		 WHERE em.event_id = '$eventId' ORDER BY em.created DESC limit 50";
$eventMessages = $db->select($sql);

if(!empty($loggedmemberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmemberId'";
$memberDetails = $db->fetch($sql);
}
?>