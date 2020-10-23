<?php

$page = $_GET['page'];
$limit = 50;
$pageURL= 'index.php?view=companies';

$searchvalue = $_POST['search_company'];
//Disabling the company
if($_GET['disabled'] == 1 && $_GET['companyId'] > 0){

	$companyId = $_GET['companyId'];
	$db->update("company",array('company_status' => '0'),"company_id = '$companyId'");
	
	$sql ="SELECT * from members where company_id ='$companyId'";
	$member = $db->fetch($sql);
	
	$db->update("members",array('status' => '0'),"member_id = '".$member['member_id']."'");
	$db->update("users",array('status' => '0'),"user_id = '".$member['user_id']."'");
	
	$_SESSION['messages'] = "Company has been disabled successfully";
	header("Location: index.php?view=companies");
	exit;
}

//Enabling the company
if($_GET['enabled'] == 1 && $_GET['companyId'] > 0){
	$companyId = $_GET['companyId'];

	$db->update("company",array('company_status' => '1'),"company_id = '$companyId'");
	$sql ="SELECT m.*,u.email FROM members AS m
			LEFT JOIN users AS u ON (u.user_id = m.user_id)
			WHERE company_id ='$companyId'";
	$member = $db->fetch($sql);
	
	$db->update("members",array('status' => '1'),"member_id = '".$member['member_id']."'");
	$db->update("users",array('status' => '1'),"user_id = '".$member['user_id']."'");
	
	$subject = "Activation mail for buildot.com Account";
			$body = "Hello,
			
Your registration for the company is approved and u can start using your account.

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($member['email'],$subject,$body,"from: Buildot<noreply@buildot.com>");
	$_SESSION['messages'] = "Company has been enabled successfully";
	header("Location: index.php?view=companies");
	exit;
}
//For deleting the company
if($_GET['delete']==1){
$company_id = $_GET['companyId'];
	
	$sql ="SELECT * from members where company_id = '$company_id'";
	$companyMembers = $db->select($sql);
	
	if(!empty($companyMembers)){
	foreach($companyMembers as $companyMember){
		$user_id = $companyMember['user_id'];
		$db->delete("users","user_id = '$user_id'");
	}
		}
	
	$db->delete("company","company_id = '$company_id'");
	
	
	$_SESSION['messages'] = "Company has been deleted successfully";

			header("Location: index.php?view=companies");
			exit;
}


if(!empty($searchvalue)){
 $sql = "SELECT * from company 
	WHERE company_name LIKE '%$searchvalue%' 
	ORDER BY created DESC";
}else{
	 $sql = "SELECT * from company
	ORDER BY created DESC";
	}
$companies = $db->select($sql,$limit,$page);
$companyCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $companyCount, $page, $pageURL);


?>