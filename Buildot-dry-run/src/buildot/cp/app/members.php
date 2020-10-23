<?php

$page = $_GET['page'];
$limit = 50;
$pageURL= 'index.php?view=members';

$searchvalue = $_POST['search_member'];
//Disabling the members
if($_GET['disabled'] == 1 && $_GET['memberId'] > 0){

	$memberId = $_GET['memberId'];
	$sql ="SELECT * from members where member_id = '$memberId'";
	$member = $db->fetch($sql);
	
	$db->update("members",array('status' => '0'),"member_id = '$memberId'");
	$db->update("users",array('status' => '0'),"user_id = '".$member['user_id']."'");
	$_SESSION['messages'] = "Member has been disabled successfully";
	header("Location: index.php?view=members");
	exit;
}

//Enabling the members
if($_GET['enabled'] == 1 && $_GET['memberId'] > 0){
	$memberId = $_GET['memberId'];
	//$sql = "UPDATE members SET competitions_status = 0";
	//$db->SQLQuery($sql);
	
	$sql ="SELECT comp.company_status,m.* FROM members AS m 
			LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
			WHERE m.member_id = '$memberId'";
	$member = $db->fetch($sql);
	//debug($member);
	if(!empty($member['company_id'])){
		if($member['company_status'] == 1){ 
			$db->update("members",array('status' => '1'),"member_id = '$memberId'");
			$db->update("users",array('status' => '1'),"user_id = '".$member['user_id']."'");
			$_SESSION['messages'] = "Member has been enabled successfully";
		}else{
			$_SESSION['errors'] = "Company activation is pending";
		}
	}else{
		$db->update("members",array('status' => '1'),"member_id = '$memberId'");
		$db->update("users",array('status' => '1'),"user_id = '".$member['user_id']."'");
		$_SESSION['messages'] = "Member has been enabled successfully";
			
	}
	header("Location: index.php?view=members");
	exit;
}
//For deleting the members
if($_GET['delete']==1){
$member_id = $_GET['memberId'];
	
	$sql ="SELECT * from members where member_id = $member_id";
	$member = $db->fetch($sql);
	
	$db->delete("users","user_id = ".$member['user_id']);
	
	
	$_SESSION['messages'] = "Member has been deleted successfully";

	header("Location: index.php?view=members");
	exit;
}

$sql = "SELECT m.member_id,m.first_name,m.last_name FROM members AS m 
		ORDER BY m.created DESC LIMIT 5";
$recentMembers = $db->select($sql);

if(!empty($searchvalue)){
 $sql = "SELECT con.country,con.country_letter,u.email,m.* FROM members AS m 
	LEFT JOIN users AS u ON (u.user_id = m.user_id)
	LEFT JOIN countries AS con ON (con.countryId = m.countryId)
	WHERE m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%'
	ORDER BY created DESC";
}else{
	 $sql = "SELECT con.country,con.country_letter,u.email,m.* FROM members AS m 
	LEFT JOIN users AS u ON (u.user_id = m.user_id)
	LEFT JOIN countries AS con ON (con.countryId = m.countryId)
	ORDER BY created DESC";
	}
$members = $db->select($sql,$limit,$page);
$memberCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $memberCount, $page, $pageURL);


?>