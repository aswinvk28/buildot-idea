<?php 
$page = $_GET['page'];
$limit = 30;
$pageURL= 'index.php?view=companyTendersList';
$memberId = $_SESSION['user']['member_id'];
$myCompanyId = $_SESSION['user']['company_id'];

//$sql = "SELECT * from projects where member_id = $memberId";
if(!empty($myCompanyId)){
$sql = "SELECT DISTINCT(m.company_id),COUNT(0) AS COUNT FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		WHERE m.company_id <> '$myCompanyId' AND p.publishto = 1
		GROUP BY m.company_id order by p.created DESC ";
}else{
	$sql = "SELECT DISTINCT(m.company_id),COUNT(0) AS COUNT FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		WHERE p.publishto = 1
		GROUP BY m.company_id order by p.created DESC";
	}
$companyTenders = $db->select($sql,$limit,$page);
$tenderCount = $db->numrows($sql);
$paginate = $db->PHPPaginator($limit, $tenderCount, $page, $pageURL);

?>