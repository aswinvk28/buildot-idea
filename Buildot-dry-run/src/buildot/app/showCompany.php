<?php
checkAdmin();

$page = $_GET['page'];
$loggedmember = $_SESSION['user']['member_id'];
$loggedcompany = $_SESSION['user']['company_id'];
if($_GET['friendrequest'] == 1){
	
	$companyId = $_GET['companyId'];
	
	$sql ="SELECT * from members where company_id = $companyId";
	$members = $db->select($sql);
	
	if(!empty($members)){
	foreach($members as $member){
			$to_member_id =  $member['member_id'];
			$sql ="SELECT * FROM friend_requests 
			WHERE (from_member_id = $loggedmember OR to_member_id = $loggedmember) 
			AND (from_member_id = $to_member_id OR to_member_id = $to_member_id)";
			$requestCount = $db->numrows($sql);
			if($requestCount == 0){
				$request_data = array();
				$request_data['from_member_id'] = $loggedmember;
				$request_data['to_member_id'] = $to_member_id;
				$request_data['status'] = 'request sent';
				$request_data['created'] = 'NOW()';

				$db->insert("friend_requests",$request_data);
				$_SESSION['messages'] = "members of this company are shortlisted";
				header("Location:index.php?view=showCompany&companyId=$companyId");
				exit;
				
			}
		  }
		}
	
	$_SESSION['messages'] = "members of this company are shortlisted";
	header("Location:index.php?view=showCompany&companyId=$companyId");
	exit;
}

$companyId = $_GET['companyId'];

//company details
$sql = "SELECT comp.* FROM company AS comp
 	    where company_id = $companyId";
$companyDetails = $db->fetch($sql);

//company project details
$sql ="SELECT * from company_projects where companyId='$companyId' ORDER BY created DESC limit 8";
$companyProjects=$db->select($sql);
$companyProjectsCount= $db->numrows($sql);

//getting the company members
$sql ="SELECT m.*,comp.logo from members AS m
	   LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
	  where m.company_id = $companyId limit 6";
$companyMembers = $db->select($sql);
$companyMemberCount = $db->numrows($sql);

//recently added companies
$sql = "SELECT * from company ORDER BY created DESC limit 5";
$recentCompanies = $db->select($sql);

//getting the job openings of the companies
$sql = "SELECT DISTINCT(jo.created_by),COUNT(0) AS count,m.first_name,m.last_name,comp.company_name,m.company_id FROM job_openings AS jo
	LEFT JOIN members AS m ON (m.member_id = jo.created_by)
LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
GROUP BY jo.created_by";
$jobCompanies = $db->select($sql);

//getting the logged in member details
if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>