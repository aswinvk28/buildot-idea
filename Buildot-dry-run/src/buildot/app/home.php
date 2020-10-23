<?php
//session_start();
//include_once(LIBPATH.'common.inc.php');
//include_once(LIBPATH.'db.inc.php');
//include_once(LIBPATH.'session.inc.php');
//include_once(LIBPATH.'functions.inc.php');

$page = $_GET['page'];
$limit = 5;

$sql = "SELECT * FROM members ORDER BY created DESC LIMIT 8";
$members = $db->select($sql);

$sql = "SELECT * from groups ORDER BY created DESC LIMIT 8";
$groups = $db->select($sql);

$sql = "SELECT * from company ORDER BY created DESC LIMIT 7";
$companies = $db->select($sql);

$sql = "SELECT * from events ORDER BY created DESC LIMIT 8";
$events = $db->select($sql);


$sql = "SELECT m.first_name,m.last_name,comp.company_name,con.country,con.country_letter,p.* ,
	DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS openingDate,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS 			     closingDate,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
LEFT JOIN members AS m ON m.member_id = p.member_id
LEFT JOIN company AS comp ON comp.company_id = m.company_id
LEFT JOIN countries AS con ON con.countryId = m.countryId
WHERE m.status = 1
ORDER BY created DESC limit 20";
$projects = $db->select($sql);


$sql = "SELECT * from job_categories";
$jobCategories = $db->select($sql);


?>