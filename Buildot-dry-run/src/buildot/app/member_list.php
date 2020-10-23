<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$fromPage = $_GET['from_page'];
$companyId = $_GET['companyId'];
$sharememberId = $_GET['memberId'];
$tenderId = $_GET['tenderId'];
$projectId = $_GET['projectId'];
$project = $_GET['project'];
$searchvalue = $_POST['search_mem'];

if(!empty($companyId)){
	$pageURL= "index.php?view=member_list&from_page=$fromPage&companyId=$companyId";
}else if(!empty($sharememberId)){
	$pageURL= "index.php?view=member_list&from_page=$fromPage&memberId=$sharememberId";
}else if(!empty($tenderId)){
	$pageURL= "index.php?view=member_list&from_page=$fromPage&tenderId=$tenderId";
}else if(!empty($projectId)){
	$pageURL= "index.php?view=member_list&from_page=$fromPage&projectId=$projectId";
}else if(!empty($project)){
	$pageURL= "index.php?view=member_list&from_page=$fromPage&projectId=$project";
}
$loggedmember = $_SESSION['user']['member_id'];
$myCompanyId = $_SESSION['user']['company_id'];
$userId = $_SESSION['user']['user_id'];

//for start sharing
if($_GET['joinrequest'] == 1){
	$from_member_id = $loggedmember;
	$to_member_id = $_GET['member_id'];
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
	$request_data['page'] = $fromPage;
	if(!empty($companyId)){
		$request_data['id'] = $companyId;
	}else if(!empty($sharememberId)){
		 $request_data['id'] = $sharememberId;
	}else if(!empty($tenderId)){
		$request_data['id'] = $tenderId;
	}else if(!empty($projectId)){
		$request_data['id'] = $projectId;
	}else if(!empty($project)){
		$request_data['id'] = $project;
	}
	$request_data['status'] = 'invited';
	$request_data['created'] = 'NOW()';

	$db->insert("share_invites",$request_data);
	$shareId = $db->insertid();
			
			$update_data = array();
			$update_data['update_message'] = 'has shared with';
			$update_data['member_id'] = $loggedmember;
			$update_data['table_name'] = 'share_invites';
			$update_data['ids'] = $shareId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);

		$_SESSION['messages'] = "invite request sent";
			if(!empty($companyId)){
				$sql ="SELECT * from company where company_id = '$companyId'";
				$company = $db->fetch($sql);
				$subject = $frommember['first_name']." has shared a company with you";
			$body = "Hello,".
$frommember['first_name']." has shared a company ".$company['company_name']." with you.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
			header("Location: index.php?view=member_list&from_page=$fromPage&companyId=$companyId");
			exit;
			}else if(!empty($sharememberId)){
				$sql ="SELECT * from members where member_id = '$sharememberId'";
				$member = $db->fetch($sql);
				$subject = $frommember['first_name']." has shared a member with you";
			$body = "Hello,".
$frommember['first_name']." has shared a company ".$member['first_name']." with you.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
				header("Location: index.php?view=member_list&from_page=$fromPage&memberId=$sharememberId");
				exit;
			}else if(!empty($tenderId)){
				$sql ="SELECT t.*,p.project_name from tenders AS t 
						LEFT JOIN projects as p on (p.project_id = t.project_id)
						where t.tender_id = '$tenderId'";
				$tender = $db->fetch($sql);
				$subject = $frommember['first_name']." has shared a received tender with you";
			$body = "Hello,".
$frommember['first_name']." has shared a tender recieved for  ".$tender['project_name']." with you.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
				header("Location: index.php?view=member_list&from_page=$fromPage&tenderId=$tenderId");
				exit;
			}else if(!empty($projectId)){
				$sql ="SELECT * from projects where project_id = '$projectId'";
				$project = $db->fetch($sql);
				$subject = $frommember['first_name']." has shared a tender with you";
			$body = "Hello,".
$frommember['first_name']." has shared a tender ".$project['project_name']." with you.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
				header("Location: index.php?view=member_list&from_page=$fromPage&projectId=$projectId");
				exit;
			}else if(!empty($project)){
				$sql ="SELECT * from projects where project_id = '$project'";
				$sproject = $db->fetch($sql);
				$subject = $frommember['first_name']." has shared a tender with you";
			$body = "Hello,".
$frommember['first_name']." has shared a tender ".$sproject['project_name']." with you.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
				header("Location: index.php?view=member_list&from_page=$fromPage&project=$project");
				exit;
			}
}
//for stop sharing
if($_GET['stoprequest'] == 1){

	$share_id = $_GET['share_id'];
	$sql ="SELECT * from updates where table_name='share_invites' and ids = $share_id";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	
	$db->delete("share_invites","share_id = $share_id");
}

if(($fromPage == 'tenderReceivedDetails' || $fromPage == 'tenderDetails' ) ){
	if(!empty($myCompanyId)){
 $sql = "SELECT u.email,m.*,fr.* FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE ( m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%') and m.member_id <> '$loggedmember' AND (fr.from_member_id = '$loggedmember' OR fr.to_member_id = '$loggedmember')
		AND m.company_id = '$myCompanyId' AND m.status = 1	
		ORDER BY m.created DESC";
	}else{
		 $sql = "SELECT u.email,m.*,fr.* FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE ( m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%') and m.member_id <> '$loggedmember' AND (fr.from_member_id = '$loggedmember' OR fr.to_member_id = '$loggedmember')
		AND m.status = 1	
		ORDER BY m.created DESC";
		
		
		}
}else if(!empty($searchvalue)){
	$sql = "SELECT u.email,m.*,fr.* FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE ( m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%') and m.member_id <> '$loggedmember' AND (fr.from_member_id = '$loggedmember' OR fr.to_member_id = '$loggedmember')	AND m.status = 1
		ORDER BY m.created DESC";
	}else{
		$sql = "SELECT u.email,m.*,fr.* FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE m.member_id <> '$loggedmember' AND m.status = 1 AND (fr.from_member_id = '$loggedmember' OR fr.to_member_id = '$loggedmember')	
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