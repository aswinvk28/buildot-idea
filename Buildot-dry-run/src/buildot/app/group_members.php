<?php
checkAdmin();

$page = $_GET['page'];
$limit = 20;
$pageURL= 'index.php?view=group_members_members';

$groupId=$_GET['groupId'];

$loggedmember= $_SESSION['user']['member_id'];


//recent company projects
$sql = "SELECT gm.member_id,mem.first_name,mem.last_name from group_members AS gm
		LEFT JOIN members as mem ON (mem.member_id = gm.member_id)
		 WHERE group_id = '$groupId' ORDER BY gm.created DESC LIMIT 5";
$recentGroupMembers = $db->select($sql);

//all the members of a company

$sql = "SELECT gm.member_id,u.email,mem.first_name,mem.last_name,mem.designation,mem.company_id,mem.mobile,mem.member_photo,mem.location,mem.countryId,con.country,con.country_letter,comp.logo from group_members as gm
		LEFT JOIN members as mem on (mem.member_id = gm.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		LEFT JOIN users as u ON (u.user_id = mem.user_id)
		LEFT JOIN countries AS con ON (con.countryId = mem.countryId)
		WHERE  mem.status = 1	
		AND mem.member_id NOT IN ( SELECT id from abuse_reports where table_name = 'members')
		AND gm.group_id = '$groupId'
		ORDER BY gm.created DESC ";

$groupMembers = $db->select($sql,$limit,$page);
$groupMembers_Count = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $groupMembers_Count, $page, $pageURL);

//logged member details
if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>