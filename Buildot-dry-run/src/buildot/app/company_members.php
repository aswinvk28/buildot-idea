<?php
checkAdmin();

$page = $_GET['page'];
$limit = 20;
$pageURL= 'index.php?view=company_members';

$companyId=$_GET['companyId'];

$loggedmember= $_SESSION['user']['member_id'];

if($_GET['delete']==1){
$project_id = $_GET['projectId'];
	
	$sql ="SELECT * from updates where table_name='company_projects' and ids = $project_id";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	//$db->delete("group_members","group_id = $group_id");
	$db->delete("project_id","project_id = $project_id");
	
	$_SESSION['messages'] = "Project is deleted";
	header("Location:index.php?view=company_projects&companyId=$companyId");
	exit;
}

//recent company projects
$sql = "SELECT * from members WHERE company_id = '$companyId' ORDER BY created DESC LIMIT 5";
$recentCompanyMembers = $db->select($sql);

//all the members of a company
if(!empty($searchvalue)){	
$sql = "SELECT u.email,m.*,comp.logo,con.country,con.country_letter FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		WHERE ( m.first_name LIKE '%$searchvalue%' OR m.last_name LIKE '%$searchvalue%')  AND m.status = 1	
		AND m.member_id NOT IN ( SELECT id from abuse_reports where table_name = 'members')
		AND m.company_id = '$companyId'
		ORDER BY m.created DESC";
}else{
$sql = "SELECT u.email,m.*,comp.logo,con.country,con.country_letter FROM members AS m 
		LEFT JOIN users AS u ON (u.user_id = m.user_id)
		LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		
		WHERE   m.status = 1	
		AND m.member_id NOT IN ( SELECT id from abuse_reports where table_name = 'members')
		AND m.company_id = '$companyId'
		ORDER BY m.created DESC";
	}
$companyMembers = $db->select($sql,$limit,$page);
$companyMembers_Count = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $companyMembers_Count, $page, $pageURL);

//logged member details
if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>