<?php
checkAdmin();
$page = $_GET['page'];
//$limit = 10;
//$pageURL= 'index.php?view=members';

$project_id = $_GET['project_id'];
$tender_id = $_GET['tenderId'];
$loggedmember= $_SESSION['user']['member_id'];

//for updating the read projects
if(!empty($project_id) && $_GET['published'] == 1){

$sql ="SELECT * from read_projects where member_id = '$loggedmember' AND project_id = '$project_id'";
$count = $db->numrows($sql);

	if($count == 0){
		$data = array();
		$data['member_id'] = $loggedmember;
		$data['project_id'] = $project_id;

	 $db->insert("read_projects",$data);
	}
}

/*
if(!empty($tender_id)){

	$sql = "UPDATE tenders SET `read` = 0 WHERE tender_id = '$tender_id'";
	$db->SQLQuery($sql);
	
	$sql = "UPDATE tenders SET count = count+1 WHERE tender_id = '$tender_id' AND member_id <> $loggedmember";
	$db->SQLQuery($sql);

}*/
 $sql = "SELECT p.*,mem.*,comp.logo FROM projects AS p
		LEFT JOIN members AS mem ON (mem.member_id = p.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		WHERE p.publishto = 1 AND mem.status = 1 AND( p.member_id = $loggedmember
		OR p.member_id IN(SELECT from_member_id FROM friend_requests WHERE (from_member_id = $loggedmember OR to_member_id = $loggedmember) AND STATUS ='request accepted')
		OR p.member_id IN(SELECT to_member_id FROM friend_requests WHERE (from_member_id = $loggedmember OR to_member_id = $loggedmember) AND STATUS ='request accepted'))
		ORDER BY p.created DESC limit 5";
$recentTenders = $db->select($sql);

$sql = "SELECT mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.company_name,comp.logo,con.country,con.country_letter,
con.currency,p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATEDIFF(p.closing_date,NOW()) as date_diff from projects as p
LEFT JOIN members AS mem ON (mem.member_id = p.member_id)
LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
left join countries as con on (con.countryId = p.countryId )
where p.project_id = $project_id";
$tenderDetails = $db->fetch($sql);


if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>