<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=tendersReceived';
$memberId = $_SESSION['user']['member_id'];
$userId = $_SESSION['user']['user_id'];

$sql ="SELECT m.company_id,m.member_photo,m.first_name,m.last_name,m.designation,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = $userId";

$memberDetails = $db->fetch($sql);

$sql = "SELECT con.currency,comp.logo,m.member_photo,m.first_name,m.last_name,t.member_id AS memberTender,t.description AS remarks,t.*,p.* FROM tenders AS t
			LEFT JOIN projects AS p ON p.project_id = t.project_id 
			LEFT JOIN members AS m ON m.member_id = t.member_id
			LEFT JOIN countries AS con ON (con.countryId = m.countryId)
			LEFT JOIN company AS comp ON comp.company_id = m.company_id
				WHERE p.member_id = $memberId
				ORDER BY t.created DESC limit 10";
$receivedTenders = $db->select($sql);

$sql = "SELECT con.currency,m.first_name,m.last_name,p.* FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		LEFT JOIN countries AS con ON (con.countryId = p.countryId)
		LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
		WHERE m.member_id <> $memberId AND (fr.from_member_id = $memberId OR fr.to_member_id = $memberId) 
		AND fr.status='request accepted'
		ORDER BY p.created DESC limit 10";
$invitedTenders = $db->select($sql);

?>