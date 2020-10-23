<?php
checkAdmin();

$page = $_GET['page'];
$limit = 20;
$pageURL= 'index.php?view=project_members';

$projectId=$_GET['projectId'];

$loggedmember= $_SESSION['user']['member_id'];


//recent company projects
$sql = "SELECT pp.from_member_id AS member_id,mem.`first_name`,mem.`last_name`,pp.created FROM project_invites AS pp
		LEFT JOIN members AS mem ON (mem.`member_id` = pp.`from_member_id`)
		 WHERE project_id = '$projectId' AND pp.status = 'request approved'
UNION 
		SELECT pp.to_member_id AS member_id,mem.`first_name`,mem.`last_name`,pp.created
			 FROM project_invites AS pp
			LEFT JOIN members AS mem ON (mem.`member_id` = pp.`to_member_id`)
			 WHERE project_id = '$projectId' AND pp.status = 'request accepted'
			 ORDER BY created DESC limit 5";
$recentProjectMembers = $db->select($sql);


$sql = "SELECT pp.from_member_id AS member_id,u.email,mem.`first_name`,mem.`last_name`,mem.`company_id`,mem.`member_photo`,mem.location,
		mem.mobile,comp.`logo`,con.country,con.country_letter,pp.created FROM project_invites AS pp
		LEFT JOIN members AS mem ON (mem.`member_id` = pp.`from_member_id`)
		LEFT JOIN users as u on (u.user_id = mem.user_id)
		LEFT JOIN company AS comp ON (comp.`company_id` = mem.`company_id`)
		LEFT JOIN countries AS con ON (con.countryId = mem.countryId)
		 WHERE project_id = '$projectId' AND pp.status = 'request approved'
UNION 
		SELECT pp.to_member_id AS member_id,u.email,mem.`first_name`,mem.`last_name`,mem.`company_id`,mem.`member_photo`,mem.location,
		mem.mobile,comp.`logo`,con.country,con.country_letter,pp.created FROM project_invites AS pp
			LEFT JOIN members AS mem ON (mem.`member_id` = pp.`to_member_id`)
			LEFT JOIN users as u on (u.user_id = mem.user_id)
			LEFT JOIN company AS comp ON (comp.`company_id` = mem.`company_id`)
			LEFT JOIN countries AS con ON (con.countryId = mem.countryId)
			 WHERE project_id = '$projectId' AND pp.status = 'request accepted'
			 ORDER BY created DESC ";
	
$projectMembers = $db->select($sql,$limit,$page);
$projectMembers_Count = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $projectMembers_Count, $page, $pageURL);

//logged member details
if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>