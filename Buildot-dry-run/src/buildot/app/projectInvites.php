<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=projectInvites';

$loggedmember= $_SESSION['user']['member_id'];
$first_name= $_SESSION['user']['first_name'];

if($_GET['projectallow'] == 1){

	$project_invite_id = $_GET['project_invite_id'];

	//from member details
	$sql ="SELECT pp.*,u.email,cp.project_name from project_invites as pp
			LEFT JOIN company_projects as cp ON  (cp.project_id = pp.project_id) 
			LEFT JOIN members as mem on (mem.member_id = pp.from_member_id)
			LEFT JOIN users as u on (u.user_id = mem.user_id)
			 where pp.project_invite_id = '$project_invite_id'";
	$projectinvite = $db->fetch($sql); 
	$email = $projectinvite['email'];
	
	$data = array();
	$data['status'] ='request approved';
		
	$db->update("project_invites",$data,"project_invite_id=".$project_invite_id);
	
			$update_data = array();
			$update_data['update_message'] = 'is now viewing ';
			$update_data['member_id'] = $projectinvite['from_member_id'];
			$update_data['table_name'] = 'project_invites';
			$update_data['ids'] = $project_invite_id;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
			
			$subject = "Your request has been approved for the project ".$projectinvite['project_name'];
	$body = "Hello,
Your request to view the project ".$projectinvite['project_name']." has been approved.

Click the below link to access
http://www.buildot.com

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
		
			header("Location:index.php?view=projectInvites");
			exit;
}
if($_GET['projectaccept'] == 1){

	$project_invite_id = $_GET['project_invite_id'];
	$companyId=$_GET['companyId'];
	
	$data = array();
	$data['status'] ='request accepted';
	
	$db->update("project_invites",$data,"project_invite_id=".$project_invite_id);
	
			$update_data = array();
			$update_data['update_message'] = 'is now viewing ';
			$update_data['member_id'] = $loggedmember;
			$update_data['table_name'] = 'project_invites';
			$update_data['ids'] = $project_invite_id;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
			
			//from member details
	$sql ="SELECT pp.*,u.email,cp.project_name from project_invites as pp
			LEFT JOIN company_projects as cp ON  (cp.project_id = pp.project_id) 
			LEFT JOIN members as mem on (mem.member_id = pp.from_member_id)
			LEFT JOIN users as u on (u.user_id = mem.user_id)
			 where pp.project_invite_id = '$project_invite_id'";
	$projectinvite = $db->fetch($sql); 
	$email = $projectinvite['email'];
	
			$subject = $first_name." has accepted your request to view the project ".$projectinvite['project_name'];
	$body = "Hello,".
$first_name." has accepted your request to view the project ".$projectinvite['project_name'].". 


With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");
		
			header("Location:index.php?view=projectInvites");
			exit;
}
if($_GET['projectreject'] == 1){

	$project_invite_id = $_GET['project_invite_id'];
	
	$db->delete("project_invites","project_invite_id = $project_invite_id");
	header("Location:index.php?view=projectInvites");
	exit;
}



//recent company projects
$sql = "SELECT * from company_projects ORDER BY created DESC LIMIT 5";
$recentCompanyProjects = $db->select($sql);

//all the project invites
$sql = "SELECT con.country,con.country_letter,mem.`first_name`,mem.`last_name`,mem.member_photo,comp.logo,comp.company_name,
		p.`project_name`,p.`project_type`,p.`project_location`,p.`project_owner`,p.companyId,DATE_FORMAT(p.created,'%d-%M-%Y ') AS project_created,pp.* FROM project_invites AS pp
		LEFT JOIN company_projects AS p ON (p.`project_id` = pp.`project_id`)
		LEFT JOIN members AS mem ON (mem.`member_id` = p.`project_owner`)
		LEFT JOIN company as comp on (comp.company_id = p.companyId)
		LEFT JOIN countries AS con on (con.countryId = p.countryId)
		WHERE pp.to_member_id = '$loggedmember' OR pp.from_member_id = '$loggedmember'
		ORDER BY pp.created DESC";
$projectInvites = $db->select($sql,$limit,$page);
$projectInvites_Count = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $projectInvites_Count, $page, $pageURL);

//logged member details
if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>