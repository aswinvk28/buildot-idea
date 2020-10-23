<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=members';
$memberId = $_SESSION['user']['member_id'];
$searchvalue = $_POST['search_mem'];

if($_GET['friendrequest'] == 1){
	$from_member_id = $_SESSION['user']['member_id'];
	$to_member_id = $_GET['memberId'];
	
	$request_data = array();
	$request_data['from_member_id'] = $from_member_id;
	$request_data['to_member_id'] = $to_member_id;
	$request_data['status'] = 'request sent';
	$request_data['created'] = 'NOW()';

	$db->insert("friend_requests",$request_data);

		$_SESSION['messages'] = "friend request sent";

			header("Location: index.php?view=members");
			exit;
}
 if($_GET['frienddelete'] == 1){
	$fr_id = $_GET['fr_id'];
	
	$db->delete("friend_requests","friend_request_id = $fr_id");
	
	$_SESSION['messages'] = "member has been deleted from your list";
	header("Location:index.php?view=members");
	exit;
	
	}
if($_GET['friendaccept'] == 1){

	$friend_request_id = $_GET['friend_request_id'];
	
	$data = array();
	$data['status'] ='request accepted';
	
	$db->update("friend_requests",$data,"friend_request_id=".$friend_request_id);
	
			$update_data = array();
			$update_data['update_message'] = 'is now connected to ';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'friend_requests';
			$update_data['ids'] = $friend_request_id;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
			header("Location:index.php?view=members");
			exit;
}
if($_GET['friendreject'] == 1){

	$friend_request_id = $_GET['friend_request_id'];
	
	$db->delete("friend_requests","friend_request_id = $friend_request_id");
	header("Location:index.php?view=members");
	exit;
}
if($_GET['report'] == 1){
	 $member_Id = $_GET['memberId'];
	
	$abuse_data = array();
	$abuse_data['table_name'] = 'members';
	$abuse_data['id'] = $member_Id;
	$abuse_data['created'] = 'NOW()';
	
	$db->insert("abuse_reports",$abuse_data);
	$_SESSION['messages'] = 'The abuse has been reported';
	header("Location: index.php?view=members");
	exit;
	
	}

$sql = "SELECT m.member_id,m.first_name,m.last_name,fr.created FROM members AS m 
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE m.member_id <> $memberId AND m.status = 1 AND (fr.from_member_id = $memberId OR fr.to_member_id = $memberId) AND fr.status='request accepted'
		ORDER BY fr.created DESC LIMIT 5";
$recentMembers = $db->select($sql);

//$sql = "SELECT u.email,m.* FROM members AS m 
	//	LEFT JOIN users AS u ON (u.user_id = m.user_id)
		//ORDER BY created DESC";
if(!empty($searchvalue)){		
// $sql = "SELECT u.email,m.*,fr.*,con.country,con.country_letter FROM members AS m 
		//LEFT JOIN users AS u ON (u.user_id = m.user_id)
	//	LEFT JOIN countries AS con ON (con.countryId = m.countryId)
	//	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	//	WHERE ( m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%') and  m.member_id <> $memberId AND (fr.from_member_id = $memberId OR fr.to_member_id = $memberId) AND m.status = 1	
	//	ORDER BY fr.created DESC";
	
$sql = "SELECT u.email,m.*,comp.logo,con.country,con.country_letter FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		WHERE ( m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%')  AND m.status = 1	
		AND m.member_id NOT IN ( SELECT id from abuse_reports where table_name = 'members')
		ORDER BY m.created DESC";
}else{
$sql = "SELECT u.email,m.*,comp.logo,fr.*,con.country,con.country_letter FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE m.member_id <> $memberId AND (fr.from_member_id = $memberId OR fr.to_member_id = $memberId) AND m.status = 1	
		AND m.member_id NOT IN ( SELECT id from abuse_reports where table_name = 'members')
		ORDER BY fr.created DESC";
	}
$members = $db->select($sql,$limit,$page);
 $memberCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $memberCount, $page, $pageURL);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>