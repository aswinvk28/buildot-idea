<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=companies';
$userId = $_SESSION['user']['user_id'];
$searchvalue = $_POST['search_company'];

$sql = "SELECT * from company WHERE company_status = 1 ORDER BY created DESC limit 5";
$recentCompanies = $db->select($sql);
if(!empty($searchvalue)){
$sql ="SELECT 
		(SELECT COUNT(0) FROM job_openings WHERE created_by = c.company_id) AS jobCount,
		c.* FROM company AS c
		where c.company_name LIKE '%$searchvalue%' AND c.company_status = 1
		ORDER BY c.created DESC";
}else{
$sql ="SELECT 
			(SELECT COUNT(0) FROM job_openings AS jo
			LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
			LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
			WHERE comp.company_id = c.company_id) AS jobCount,
		c.* FROM company AS c
		WHERE c.company_status = 1
		ORDER BY c.created DESC";
}
$companies = $db->select($sql,$limit,$page);
$companyCount = $db->numrows($sql);

$paginate = $db->PHPPaginator($limit, $companyCount, $page, $pageURL);
$sql = "SELECT DISTINCT(jo.created_by),COUNT(0) AS COUNT,m.first_name,m.last_name,comp.company_name,m.company_id FROM job_openings AS jo
	LEFT JOIN members AS m ON (m.member_id = jo.created_by)
LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
GROUP BY jo.created_by";
$jobCompanies = $db->select($sql);

$sql ="SELECT m.company_id,m.member_photo,m.first_name,m.last_name,m.designation,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);

?>