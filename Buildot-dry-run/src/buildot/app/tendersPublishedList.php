<?php 
$page = $_GET['page'];
$limit = 30;
$pageURL= 'index.php?view=tendersPublishedList';
$memberId = $_SESSION['user']['member_id'];


$sql = "SELECT * from projects where member_id <> $memberId ORDER BY created DESC ";
$projects = $db->select($sql,$limit,$page);
$projectCount = $db->numrows($sql);
$paginate = $db->PHPPaginator($limit, $projectCount, $page, $pageURL);
?>