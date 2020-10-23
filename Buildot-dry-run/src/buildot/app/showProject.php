<?php
checkAdmin();

$page = $_GET['page'];

$projectId = $_GET['projectId'];
$companyId = $_GET['companyId'];

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
			
			if(!empty($_FILES['image']['tmp_name'])){

					$reply_data['attachment'] = DocUpload('image');
					
		}
			$reply_data['created'] = 'NOW()';
			
			$db->insert("company_project_message_reply",$reply_data);
			$cpmreplyId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has replied on the update for:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'company_project_message_reply';
			$update_data['ids'] = $cpmreplyId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=showProject&projectId=$projectId");
		}
		
		//header("Location: index.php?view=showProject&projectId=$projectId");
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
			$post_data['project_id'] = $_POST['projectId'];
			$post_data['member_id'] = $memberId;
			
			
			if(!empty($_FILES['image']['tmp_name'])){

					$post_data['attachment'] = DocUpload('image');
		}
			$post_data['created'] = 'NOW()';
			
			$db->insert("company_project_message",$post_data);
			$projectMessageId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has commented on:';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'company_project_message';
			$update_data['ids'] = $projectMessageId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
		
			//header("Location: index.php?view=showProject&projectId=$projectId");
		}
		
		//header("Location: index.php?view=showProject&projectId=$projectId");
	//exit;
	
}

}
//request for joing a project
if($_GET['joinproject'] == 1){
	$projectId = $_GET['projectId'];
	
	$sql ="SELECT * from company_projects where project_id = '$projectId'";
	$cproject = $db->fetch($sql);
	$companyId = $cproject['companyId'];
	
	//from member details
	$sql ="SELECT * from members where member_id ='$memberId'";
	$frommember = $db->fetch($sql);
	
	//getting the to member details
	$sql ="SELECT m.*,u.email from members as m left join users as u on (u.user_id = m.user_id)
	 		where m.member_id = '".$cproject['project_owner']."'";
	$tomember = $db->fetch($sql);
	$email = $tomember['email'];
	 
	$data = array();
	$data['project_id'] = $projectId;
	$data['from_member_id'] = $memberId;
	$data['to_member_id'] = $cproject['project_owner'];
	$data['status'] = 'request sent';
	 $data['created'] = 'NOW()';
	
	$db->insert("project_invites",$data);
	$pinviteId = $db->insertid();
	
	$update_data = array();
			$update_data['update_message'] = 'has shortlisted';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'project_shortlist';
			$update_data['ids'] = $pinviteId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
	
	$subject = $frommember['first_name']." has sent a request to join the project ".$cproject['project_name'];
	$body = "Hello,".
$frommember['first_name']." has sent a request to join the project ".$project['project_name'].".

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
	$_SESSION['messages'] = "Your request to join the group is sent to the owner.";
	header("Location:index.php?view=showProject&companyId=$companyId&projectId=$projectId");
	exit;
}


//for deleting the messages and the replies
if($_GET['delete'] == 1){
	$reply_id = $_GET['reply_id'];
	$msgId = $_GET['msg_id'];

	if(!empty($reply_id)){
		$sql ="SELECT * from updates where table_name='company_project_message_reply' and ids = '$reply_id'";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("company_project_message_reply","reply_id = $reply_id");
		$_SESSION['messages'] = "reply has been deleted";
	}
	
	
	if(!empty($msgId)){
		$sql ="SELECT * from updates where table_name='company_project_message' and ids = '$msgId'";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("company_project_message","msg_id = '$msgId'");
		$_SESSION['messages'] = "message has been deleted";
	}
	
	header("Location:index.php?view=showProject&projectId=$projectId");
	exit;
	
}


//checking the owner of the group
$sql = "SELECT * FROM company_projects WHERE project_id = $projectId AND project_owner = '$memberId'";
$checkOwner = $db->numrows($sql);

$sql = "SELECT * from company_projects ORDER BY created DESC LIMIT 5";
$recentCompanyProjects = $db->select($sql);


$sql = "SELECT con.country,con.country_letter,cp.*,m.first_name,m.last_name,m.member_photo,comp.logo,comp.website,comp.company_name,DATE_FORMAT(cp.created,'%d-%M-%Y ') AS project_created FROM company_projects AS cp 
		LEFT JOIN members AS m ON (m.member_id = cp.project_owner)
		LEFT JOIN company AS comp ON (comp.company_id = cp.companyId)
		LEFT JOIN countries AS con ON (con.countryId = cp.countryId)
		where cp.project_id = '$projectId'";
$companyProject = $db->fetch($sql);	

$sql ="SELECT pp.from_member_id AS member_id,mem.`first_name`,mem.`last_name`,mem.`company_id`,mem.`member_photo`
		,comp.`logo`,pp.created FROM project_invites AS pp
		LEFT JOIN members AS mem ON (mem.`member_id` = pp.`from_member_id`)
		LEFT JOIN company AS comp ON (comp.`company_id` = mem.`company_id`) WHERE project_id = '$projectId' AND pp.status = 'request approved'
UNION 
		SELECT pp.to_member_id AS member_id,mem.`first_name`,mem.`last_name`,mem.`company_id`,mem.`member_photo`,comp.`logo`
			 ,pp.created FROM project_invites AS pp
			LEFT JOIN members AS mem ON (mem.`member_id` = pp.`to_member_id`)
			LEFT JOIN company AS comp ON (comp.`company_id` = mem.`company_id`)
			 WHERE project_id = '$projectId' AND pp.status = 'request accepted'
			 ORDER BY created DESC limit 12";
$ProjectMembers = $db->select($sql);
$pmCount = $db->select($sql);

$sql ="SELECT * from project_invites where project_id = '$projectId' and status in ( 'request accepted','request approved') 
AND (from_member_id = '$memberId' OR to_member_id = '$memberId')";

$ProjectMemberCount = $db->numrows($sql);


$sql ="SELECT cpm.*,m.first_name,m.last_name,m.member_photo,cp.project_name,cp.companyId,comp.logo,
UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(cpm.created) AS createdunixtime
 FROM company_project_message AS cpm
		LEFT JOIN company_projects AS cp ON (cp.project_id = cpm.project_id)
		LEFT JOIN members AS m ON (m.member_id = cpm.member_id)
		left join company as comp on(comp.company_id = cp.companyId)
		 WHERE cpm.project_id = '$projectId' ORDER BY cpm.created DESC limit 50";
$projectMessages = $db->select($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>