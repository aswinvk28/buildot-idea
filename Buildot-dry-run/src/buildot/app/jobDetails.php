<?php
checkAdmin();

$page = $_GET['page'];
$JobId = $_GET['jobId'];
$memberId = $_SESSION['user']['member_id'];
$myCompanyId = $_SESSION['user']['company_id'];

if($_GET['apply'] == 1){

$sql ="SELECT * from job_openings where job_opening_id = $JobId";
$job= $db->fetch($sql);
			$update_data = array();
			$update_data['update_message'] = 'is interested in ';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'job_application';
			$update_data['ids'] = $JobId;
			$update_data['created'] ='NOW()';
			
			$db->insert("updates",$update_data);
			$_SESSION['messages'] = "Your profile has been sent";

			//header("Location: index.php?view=jobDetails");
			
}

$sql ="SELECT con.country,con.country_letter,mem.company_id,mem.first_name,mem.last_name,mem.member_photo,comp.company_name,comp.logo,jo.*,DATE_FORMAT(jo.created,'%d-%M-%Y') AS job_created,DATE_FORMAT(jo.expiry_date,'%d-%M-%Y ') AS expiryDate,DATEDIFF(jo.expiry_date,NOW()) as date_diff FROM job_openings AS jo
		LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		LEFT JOIN countries AS con ON (con.countryId = mem.countryId)
		WHERE jo.job_opening_id = $JobId";

$jobDetails = $db->fetch($sql);

$sql = "SELECT DISTINCT(jo.created_by),COUNT(0) AS COUNT,m.first_name,m.last_name,comp.company_name,m.company_id FROM job_openings AS jo
	LEFT JOIN members AS m ON (m.member_id = jo.created_by)
LEFT JOIN company AS comp ON (comp.company_id = m.company_id)
GROUP BY jo.created_by";
$jobCompanies = $db->select($sql);

if(!empty($memberId)){
$sql ="SELECT m.*,comp.* from members as m 
left join company as comp on (comp.company_id = m.company_id)
where member_id='$memberId'";
$memberDetails = $db->fetch($sql);
}
?>