<?php
checkAdmin();

$page = $_GET['page'];

$userId = $_SESSION['user']['user_id'];


$sql = "SELECT u.email,con.country,con.country_letter,m.* ,DATE_FORMAT(m.dateOfBirth,'%d-%m-%Y') AS birth_date from members AS m
		LEFT JOIN users AS u ON (u.user_id= m.user_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		 where m.user_id = '$userId'";
$memberDetails = $db->fetch($sql);
if(!empty($memberDetails['company_id'])){
$companyId= $memberDetails['company_id'];
$sql = "SELECT comp.* from company AS comp
		 where company_id = $companyId";
$companyDetails = $db->fetch($sql);
}

?>