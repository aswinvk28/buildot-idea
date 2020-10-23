<?php
$memberId= $_SESSION['user']['member_id'];
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

		//	$db->insert("group_message_reply",array("reply_message" => $message, 'msg_id' => $_POST['msg_id'], 'member_id' => 26));
			
			$db->insert("group_message_reply",$reply_data);
			$gmreplyId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has replied on the update for:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'group_message_reply';
			$update_data['ids'] = $gmreplyId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
		}
	}
?>