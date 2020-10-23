<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=tenders';
$memberId = $_SESSION['user']['member_id'];
$myCompanyId = $_SESSION['user']['company_id'];

 if($_GET['delete'] == 1){
	$project_id = $_GET['project_id'];
	
	$sql ="SELECT * from updates where table_name='projects' and ids = '$project_id'";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	$db->delete("projects","project_id = $project_id");
	
	$_SESSION['messages'] = "Your Tender has been deleted";
	header("Location:index.php?view=tenders");
	exit;
	
	}
	
//$sql = "SELECT * from projects ORDER BY created DESC limit 5";
$sql = "SELECT p.*,mem.*,comp.logo FROM projects AS p
		LEFT JOIN members AS mem ON (mem.member_id = p.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		WHERE mem.status =1 AND (p.member_id = $memberId
		OR p.member_id IN(SELECT from_member_id FROM friend_requests WHERE (from_member_id = $memberId OR to_member_id = $memberId) AND STATUS ='request accepted')
		OR p.member_id IN(SELECT to_member_id FROM friend_requests WHERE (from_member_id = $memberId OR to_member_id = $memberId) AND STATUS ='request accepted'))
		ORDER BY p.created DESC limit 5";
$recentTenders = $db->select($sql);


$sql = "SELECT comp.company_name,comp.logo,m.first_name,m.last_name,m.member_photo,m.company_id,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = m.countryId
	WHERE p.member_id= $memberId AND m.status = 1
	ORDER BY p.created DESC";
$tenders = $db->select($sql,$limit,$page);
$tenderCount = $db->numrows($sql);

$paginate = $db->PHPPaginator($limit, $tenderCount, $page, $pageURL);

if(!empty($myCompanyId)){
$sql = "SELECT DISTINCT(m.company_id),COUNT(0) AS COUNT FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		WHERE m.company_id <> $myCompanyId AND p.publishto = 1
		GROUP BY m.company_id";
}else{
$sql = "SELECT DISTINCT(m.company_id),COUNT(0) AS COUNT FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		GROUP BY m.company_id";
	}
$companyTenders = $db->select($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>