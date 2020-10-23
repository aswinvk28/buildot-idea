<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=groups';

$loggedmember= $_SESSION['user']['member_id'];
if($_GET['delete']==1){
$group_id = $_GET['groupId'];
	
	$sql ="SELECT * from updates where table_name='groups' and ids = $group_id";
	$update = $db->fetch($sql);
	$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
	$db->delete("group_members","group_id = $group_id");
	$db->delete("groups","group_id = $group_id");
	
	$_SESSION['messages'] = "group is deleted";
	header("Location:index.php?view=groups");
	exit;
}

$sql = "SELECT * from groups ORDER BY created DESC LIMIT 5";
$recentGroups = $db->select($sql);


$sql = "SELECT grp.*,(SELECT COUNT(0) FROM group_members WHERE group_id = grp.group_id) AS memberCount 
		FROM groups AS grp
		ORDER BY created DESC";
$groups = $db->select($sql,$limit,$page);
$groupCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $groupCount, $page, $pageURL);


if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>