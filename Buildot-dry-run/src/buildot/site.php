<?php

$page = $_GET['page'];
$limit = 10;

$loginname = $_SESSION['user']['email'];
//$first_name= $_SESSION['user']['first_name'];
//$last_name= $_SESSION['user']['last_name'];
//$member_photo= $_SESSION['user']['member_photo'];
//$memberId = $_SESSION['user']['member_id'];
$loggedmember = $_SESSION['user']['member_id'];
if(!empty($loggedmember)){
 $sql = "SELECT comp.logo,m.member_photo,m.first_name,m.last_name,t.tender_id,t.project_id,t.description AS remarks,
			t.proposed_budget,t.sector,t.attachment,p.project_ref_no,p.project_name FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
			WHERE p.member_id = '$loggedmember' 
			ORDER BY t.created DESC";
}
$tenderReceivedCount = $db->numrows($sql);		

 $sql = "SELECT * from read_tenders where member_id = '$loggedmember'";
  $readTenderCount = $db->numrows($sql);

  $unread_receivedtendercount = $tenderReceivedCount - $readTenderCount;

if(!empty($loggedmember)){

 $sql = "SELECT comp.company_name,comp.logo,m.first_name,m.last_name,m.member_photo,con.country,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,
	DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id)
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = m.countryId
	WHERE p.member_id <> '$loggedmember' AND m.status = 1 AND p.publishto = 1
	AND ((fr.from_member_id = '$loggedmember' OR fr.to_member_id = '$loggedmember') AND (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id) AND fr.status = 'request accepted') 
UNION
 SELECT comp.company_name,comp.logo,m.first_name,m.last_name,m.member_photo,con.country,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
	LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE m.status = 1 AND p.publishto = 2 AND si.page='inviteTenders' AND si.to_member_id = '$loggedmember'
	AND (fr.from_member_id = '$loggedmember' OR fr.to_member_id = '$loggedmember') 
	AND	fr.status='request accepted' AND p.member_id <> '$loggedmember'
	ORDER BY created DESC";
}
 $tenderPublishedCount = $db->numrows($sql);	

$sql = "SELECT * from read_projects where member_id = '$loggedmember'";
$readProjectCount = $db->numrows($sql);

 $unread_projectcount = $tenderPublishedCount - $readProjectCount;

 $totalTenders = $unread_receivedtendercount + $unread_projectcount;
	
$sql ="SELECT * FROM friend_requests WHERE to_member_id = '$loggedmember' AND STATUS = 'request sent'";	
@$friendRequests = $db->numrows($sql);

if(!empty($loggedmember)){
$sql="SELECT * from members where member_id = $loggedmember";
$member=$db->fetch($sql);	
}

$sql = "SELECT * FROM members ORDER BY created DESC LIMIT 8";
$totalmembers = $db->select($sql);

$sql = "SELECT * from groups ORDER BY created DESC LIMIT 8";
$totalgroups = $db->select($sql);

$sql = "SELECT * from company ORDER BY created DESC LIMIT 6";
$totalcompanies = $db->select($sql);

$sql = "SELECT * from events ORDER BY created DESC LIMIT 8";
$totalevents = $db->select($sql);

 $sql = "SELECT mem.`first_name`,mem.`last_name`,mem.member_photo,comp.logo,comp.company_name,
		p.`project_name`,p.`project_type`,p.`project_location`,p.`project_owner`,p.companyId,pp.* FROM project_invites AS pp
		LEFT JOIN company_projects AS p ON (p.`project_id` = pp.`project_id`)
		LEFT JOIN members AS mem ON (mem.`member_id` = pp.`from_member_id`)
		LEFT JOIN company as comp on (comp.company_id = p.companyId)
		WHERE to_member_id = '$loggedmember' AND pp.status = 'request sent'
		ORDER BY pp.created DESC";
//$projectInvites = $db->select($sql,$limit,$page);
$projectInvitesCount = $db->numrows($sql);	




if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memDetails = $db->fetch($sql);
}
?>