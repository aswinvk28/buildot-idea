<?php
checkAdmin();
$page = $_GET['page'];

//logged in member
$loggedmember = $_SESSION['user']['member_id'];

$memberId = $_GET['memberId'];

//for replies of the updates in the member details page
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
			$reply_data['send_by'] = $loggedmember;
			$reply_data['update_id'] = $update_id;
			$reply_data['created'] = 'NOW()';
			
			$db->insert("update_reply",$reply_data);
			$updatereplyId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has replied on the update for:';
			$update_data['member_id'] = $loggedmember;
			$update_data['table_name'] = 'update_reply';
			$update_data['ids'] = $updatereplyId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=showMember&memberId=$memberId");
		}
		
		//header("Location: index.php?view=showMember&memberId=$memberId");
	//exit;
	}
}

//for hiding the message
if($_GET['hide'] == 1){
	 $updateId = $_GET['updateId'];
	
	$hide_data = array();
	$hide_data['member_id'] = $loggedmember;
	$hide_data['update_id'] = $updateId;
	$hide_data['created'] = 'NOW()';
	
	$db->insert("hide_updates",$hide_data);
	$_SESSION['messages'] = "The update is hidden <a href='index.php?view=showMember&memberId=$memberId&hide=2&updateId=$updateId'>Undo</a>" ;
	header("Location: index.php?view=showMember&memberId=$memberId");
	exit;
	
	}else if($_GET['hide'] == 2){
		 $updateId = $_GET['updateId'];
		
		$db->delete("hide_updates","update_id = $updateId");
	}
//for reporting the updates	
if($_GET['report'] == 1){
	 $updateId = $_GET['updateId'];
	
	$abuse_data = array();
	$abuse_data['table_name'] = 'updates';
	$abuse_data['id'] = $updateId;
	$abuse_data['created'] = 'NOW()';
	
	$db->insert("abuse_reports",$abuse_data);
	$_SESSION['messages'] = 'The abuse has been reported';
	header("Location: index.php?view=showMember&memberId=$memberId");
	exit;
	
	}

//for deleting the updates and its replies
if($_GET['delete'] == 1){
	$reply_id = $_GET['reply_id'];
	$updateId = $_GET['update_id'];

	if(!empty($reply_id)){
		$sql ="SELECT * from updates where table_name='update_reply' and ids = $reply_id";
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
	
	header("Location:index.php?view=showMember&memberId=$memberId");
	exit;
	
}
//getting the recent added members
$sql = "SELECT m.member_id,m.first_name,m.last_name,fr.created FROM members AS m 
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE m.member_id <> $loggedmember AND (fr.from_member_id = $loggedmember OR fr.to_member_id = $loggedmember) AND fr.status='request accepted'
		ORDER BY fr.created DESC LIMIT 5";
$recentMembers = $db->select($sql);

//member details
$sql = "SELECT cfa.name,u.email,con.country,con.country_letter,m.* ,DATE_FORMAT(m.dateOfBirth,'%d-%m-%Y') AS birth_date from members AS m
		LEFT JOIN users AS u ON (u.user_id= m.user_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		LEFT JOIN company_functional_area AS cfa ON (cfa.id = m.company_functional_area_id)
		 where member_id = '$memberId'";
$memberDetails = $db->fetch($sql);
if(!empty($memberDetails['company_id'])){
$companyId= $memberDetails['company_id'];
$sql = "SELECT comp.* from company AS comp
		 where company_id = '$companyId'";
$companyDetails = $db->fetch($sql);
}

//checking whether already friends or not.
$sql = "SELECT * FROM friend_requests 
		WHERE (from_member_id = '$loggedmember' OR to_member_id= '$loggedmember') 
		AND( from_member_id = '$memberId' OR to_member_id = '$memberId')";
		$friend = $db ->fetch($sql);
	$count = $db->numrows($sql);
	
//getting the updates of this member.
$sql ="SELECT upd.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.company_name,comp.logo,DATE_FORMAT(upd.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(upd.created) AS createdunixtime FROM updates AS upd
LEFT JOIN members AS mem ON (mem.member_id = upd.member_id)
LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
WHERE upd.member_id = '$memberId' AND upd.id NOT IN (SELECT update_id FROM hide_updates WHERE member_id = '$memberId' UNION SELECT id from abuse_reports where table_name = 'updates')
ORDER BY upd.created DESC LIMIT 30";
$updates = $db->select($sql);

/*if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memDetails = $db->fetch($sql);
}*/
?>