<?php
checkAdmin();
$page = $_GET['page'];

$userId = $_SESSION['user']['user_id'];


$sql = "SELECT u.email,con.country,m.* ,DATE_FORMAT(m.dateOfBirth,'%d-%m-%Y') AS birth_date from members AS m
		LEFT JOIN users AS u ON (u.user_id= m.user_id)
		LEFT JOIN countries AS con ON (con.countryId = m.countryId)
		 where m.user_id = $userId";
$memDetails = $db->fetch($sql);
$dateOfBirth = explode("-",$memDetails['dateOfBirth']);
if(!empty($memDetails['company_id'])){
$companyId= $memDetails['company_id'];
$sql = "SELECT comp.* from company AS comp
		 where company_id = $companyId";
$compDetails = $db->fetch($sql);
}


$sql ="SELECT * from countries";
$countries = $db->select($sql);

$sql = "SELECT * from company_functional_area";
$companyFuncAreas = $db->select($sql);
?>