<?php
checkAdmin();

$page = $_GET['page'];
$limit = 15;

$projectId = $_GET['projectId'];
$searchval = $_POST['search_invite'];

 if(!empty($projectId)){
	$pageURL= "index.php?view=project_invitee_list&projectId=$projectId";
}

$loggedmember = $_SESSION['user']['member_id'];
$myCompanyId = $_SESSION['user']['company_id'];
$userId = $_SESSION['user']['user_id'];

if(!empty($_POST['email'])){
	 $error = 0;
	 
  $invite_email = $_POST['email'];
 
 if(!validateEmail($invite_email)){
			$_SESSION['errors'][] = "Email id is invalid";
			$error = 1;
		}	
if($error != 1){
 $sql ="SELECT * from members where member_id = '$loggedmember'";
 $from_member = $db->fetch($sql);
	
	$subject = $from_member['first_name']." has sent a request to join BUILDOT.COM";
			$body = "Hello,".
$from_member['first_name']." has sent a request to join BUILDOT.COM.

Click the below link to register
http://www.buildot.com


With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($invite_email,$subject,$body,"From: Buildot <noreply@buildot.com>");
		
		$_SESSION['messages'] ='Your invitation is sent';
		header("Location: index.php?view=project_invitee_list&projectId=$projectId");
		exit;
}
	
}
//for start sharing
if($_GET['joinrequest'] == 1){
	$from_member_id = $loggedmember;
	$to_member_id = $_GET['to_member_id'];
	
	//from member details
	$sql ="SELECT * from members where member_id ='$from_member_id'";
	$frommember = $db->fetch($sql);
	
	//getting the to member details
	$sql ="SELECT m.*,u.email from members as m left join users as u on (u.user_id = m.user_id)
	 		where m.member_id = '$to_member_id'";
	$tomember = $db->fetch($sql);
	$email = $tomember['email'];
	
	$request_data = array();
	$request_data['from_member_id'] = $from_member_id;
	$request_data['to_member_id'] = $to_member_id;
	
	 if(!empty($projectId)){
		$request_data['project_id'] = $projectId;
	}
	$request_data['status'] = 'request sent';
	$request_data['created'] = 'NOW()';

	$db->insert("project_invites",$request_data);
	$pinviteId = $db->insertid();
	
	$update_data = array();
			$update_data['update_message'] = 'has invited';
			$update_data['member_id'] = $loggedmember;
			$update_data['table_name'] = 'project_requests';
			$update_data['ids'] = $pinviteId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);

		$_SESSION['messages'] = "invite request sent";
			  if(!empty($projectId)){
				$sql ="SELECT * from projects where project_id = '$projectId'";
				$project = $db->fetch($sql);
				$subject = $frommember['first_name']." has shared a project with you";
			$body = "Hello,".
$frommember['first_name']." has shared a project ".$project['project_name']." with you.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
				
				
				header("Location: index.php?view=project_invitee_list&projectId=$projectId");
				exit;
			}
}
//for stop sharing
if($_GET['stoprequest'] == 1){

	$project_invite_id = $_GET['project_invite_id'];

	$db->delete("project_invites","project_invite_id = $project_invite_id");
}

 if(!empty($searchval)){
	$sql = "SELECT u.email,m.* FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		WHERE ( m.first_name LIKE '%$searchval%' OR m.last_name LIKE '%$searchval%') and m.member_id <> '$loggedmember' AND m.status = 1
		ORDER BY m.created DESC";
	}else{
	$sql = "SELECT u.email,m.* FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		WHERE m.status =1 AND m.member_id <> '$loggedmember' AND m.status = 1
		ORDER BY m.created DESC";
		}
$members = $db->select($sql,$limit,$page);
$memberCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $memberCount, $page, $pageURL);


$sql ="SELECT m.company_id,m.member_photo,m.first_name,m.last_name,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);
?>