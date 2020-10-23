<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=jobOpenings';
$loggedmember = $_SESSION['user']['member_id'];
$companyId = $_GET['companyId'];
$searchvalue = $_POST['search_job'];

//for deleting the job openings
if($_GET['delete'] == 1){
	
	$job_opening_id = $_GET['job_opening_id'];

	
	if(!empty($job_opening_id)){
		
		$sql ="SELECT * from updates where table_name='job_openings' and ids = $job_opening_id";
		$update = $db->fetch($sql);
		$updateId = $update['id'];
	if(!empty($updateId)){
		$db->delete("updates","id = $updateId");
	}
		$db->delete("job_openings","job_opening_id = '$job_opening_id'");
		$_SESSION['messages'] = "job has been deleted";
	}
	
	header("Location:index.php?view=jobOpenings");
	exit;
	
}
if(!empty($searchvalue)){
	$sql ="SELECT comp.company_name,mem.company_id,mem.first_name,mem.last_name,jo.*,DATE_FORMAT(jo.created,'%d-%m-%Y') AS job_created,DATE_FORMAT(jo.expiry_date,'%d-%M-%Y ') AS expiryDate FROM job_openings AS jo
		LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		WHERE jo.title LIKE '%$searchvalue%' AND mem.status = 1
		ORDER BY created DESC";
}else if(!empty($companyId)){
$sql ="SELECT comp.company_name,mem.company_id,mem.first_name,mem.last_name,jo.*,DATE_FORMAT(jo.created,'%d-%m-%Y') AS job_created,DATE_FORMAT(jo.expiry_date,'%d-%M-%Y ') AS expiryDate FROM job_openings AS jo
		LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		WHERE comp.company_id = $companyId AND mem.status = 1
		ORDER BY created DESC";
}else{
$sql ="SELECT comp.company_name,mem.company_id,mem.first_name,mem.last_name,jo.*,DATE_FORMAT(jo.created,'%d-%m-%Y') AS job_created,DATE_FORMAT(jo.expiry_date,'%d-%M-%Y ') AS expiryDate  FROM job_openings AS jo
		LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		WHERE mem.status = 1
		ORDER BY created DESC";
	}
$jobOpenings = $db->select($sql,$limit,$page);
$jobCount = $db->numrows($sql);

$paginate = $db->PHPPaginator($limit, $companyCount, $page, $pageURL);
$sql = "SELECT DISTINCT(jo.created_by),COUNT(0) AS COUNT,m.first_name,m.last_name,comp.company_name,m.company_id FROM job_openings AS jo
	LEFT JOIN members AS m ON (m.member_id = jo.created_by)
LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
GROUP BY jo.created_by";
$jobCompanies = $db->select($sql);

if(!empty($loggedmember)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$loggedmember'";
$memberDetails = $db->fetch($sql);
}
?>