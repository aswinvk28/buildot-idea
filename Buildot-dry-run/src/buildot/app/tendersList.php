<?php 
$page = $_GET['page'];
$limit = 30;
$pageURL= 'index.php?view=tendersList';
$memberId = $_SESSION['user']['member_id'];

//$sql = "SELECT * from projects where member_id = $memberId";
$sql ="SELECT distinct p.* FROM projects AS p 
LEFT JOIN share_invites AS si ON (si.to_member_id = $memberId)
WHERE p.member_id = $memberId OR p.member_id = si.from_member_id ORDER BY p.created DESC ";
$projects = $db->select($sql,$limit,$page);
$projectCount = $db->numrows($sql);
$paginate = $db->PHPPaginator($limit, $projectCount, $page, $pageURL);

?>