<?php
$page = $_GET['page'];
//$limit = 10;
//$pageURL= 'index.php?view=members';
$loggedmember = $_SESSION['userInfo']['member_id'];
$memberId = $_GET['memberId'];

$sql = "SELECT m.member_id,m.first_name,m.last_name FROM members AS m 
		ORDER BY m.created DESC LIMIT 5";
$recentMembers = $db->select($sql);

$sql = "SELECT u.email,con.country,con.country_letter,m.* ,DATE_FORMAT(m.dateOfBirth,'%d-%m-%Y') AS birth_date from members AS m
		LEFT JOIN users AS u ON (u.user_id= m.user_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		 where member_id = $memberId";
$memberDetails = $db->fetch($sql);
if(!empty($memberDetails['company_id'])){
$companyId= $memberDetails['company_id'];
$sql = "SELECT comp.* from company AS comp
		 where company_id = $companyId";
$companyDetails = $db->fetch($sql);
}

?>