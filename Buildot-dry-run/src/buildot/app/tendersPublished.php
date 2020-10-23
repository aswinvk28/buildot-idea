<?php
checkAdmin();

$page = $_GET['page'];
$limit = 10;
$pageURL= 'index.php?view=tendersPublished';
$userId = $_SESSION['user']['user_id'];
$memberId = $_SESSION['user']['member_id'];
$myCompanyId = $_SESSION['user']['company_id'];

$companyId = $_GET['companyId'];
$countryId = $_POST['country'];
$location = $_POST['location'];

//$sql = "SELECT * from projects ORDER BY created DESC limit 5";
 $sql = "SELECT p.*,mem.*,comp.logo FROM projects AS p
		LEFT JOIN members AS mem ON (mem.member_id = p.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
		WHERE p.publishto = 1 AND mem.status = 1 AND( p.member_id = $memberId
		OR p.member_id IN(SELECT from_member_id FROM friend_requests WHERE (from_member_id = $memberId OR to_member_id = $memberId) AND STATUS ='request accepted')
		OR p.member_id IN(SELECT to_member_id FROM friend_requests WHERE (from_member_id = $memberId OR to_member_id = $memberId) AND STATUS ='request accepted'))
		ORDER BY p.created DESC limit 5";
$recentTenders = $db->select($sql);

if(!empty($location) && !empty($countryId)){
$sql = "SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,
con.country,con.country_letter,p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE  m.status = 1 AND p.publishto = 1 AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id)
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' AND p.countryId = '$countryId' and p.project_location = '$location'
UNION
	SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
	LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE  m.status = 1 AND p.publishto = 2 AND si.page='inviteTenders' AND si.to_member_id = '$memberId'
	AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' AND p.countryId = '$countryId' and p.project_location = '$location'
	ORDER BY created DESC";
}elseif(!empty($countryId)){
$sql = "SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE  m.status = 1 AND p.publishto = 1 AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id)
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' AND p.countryId = '$countryId'
UNION
	SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
	LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE  m.status = 1 AND p.publishto = 2 AND si.page='inviteTenders' AND si.to_member_id = '$memberId'
	AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' AND p.countryId = '$countryId'
	ORDER BY created DESC";
}elseif(!empty($location)){
$sql = "SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE  m.status = 1 AND p.publishto = 1 AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id)
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' and p.project_location = '$location'
UNION
	SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
	LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE  m.status = 1 AND p.publishto = 2 AND si.page='inviteTenders' AND si.to_member_id = '$memberId'
	AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' and p.project_location = '$location'
	ORDER BY created DESC";
}elseif(!empty($companyId)){
 $sql = "SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE m.status = 1 AND p.publishto = 1 AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id)
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' AND comp.company_id = '$companyId'
UNION
	SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
	LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE m.status = 1 AND p.publishto = 2 AND si.page='inviteTenders' AND si.to_member_id = '$memberId'
	AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND	fr.status='request accepted' AND p.member_id <> '$memberId' AND comp.company_id = '$companyId'
	ORDER BY created DESC";
}else{
	 $sql = "SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE m.status = 1 AND p.publishto = 1 AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND (fr.from_member_id = p.member_id OR fr.to_member_id = p.member_id)
	AND	fr.status='request accepted' AND p.member_id <> '$memberId'
	
UNION
 SELECT comp.company_name,comp.logo,m.company_id,m.first_name,m.last_name,m.member_photo,con.country,con.country_letter,
	p.*,DATE_FORMAT(p.opening_date,'%d-%m-%Y') AS opening_date,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closing_date,DATE_FORMAT(p.created,'%d-%m-%Y') AS project_created
	FROM projects AS p
	LEFT JOIN members AS m ON m.member_id = p.member_id
	LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
	LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
	LEFT JOIN company AS comp ON comp.company_id = m.company_id
	LEFT JOIN countries AS con ON con.countryId = p.countryId
	LEFT JOIN friend_requests AS fr ON (fr.from_member_id = m.member_id OR fr.to_member_id = m.member_id)
	WHERE m.status = 1 AND p.publishto = 2 AND si.page='inviteTenders' AND si.to_member_id = '$memberId'
	AND (fr.from_member_id = '$memberId' OR fr.to_member_id = '$memberId') 
	AND	fr.status='request accepted' AND p.member_id <> '$memberId'
	ORDER BY created DESC";
	}
$tenders = $db->select($sql,$limit,$page);
$tenderCount = $db->numrows($sql);

$paginate = $db->PHPPaginator($limit, $tenderCount, $page, $pageURL);

if(!empty($myCompanyId)){
$sql = "SELECT DISTINCT(m.company_id),COUNT(0) AS COUNT FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
		LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
		WHERE m.company_id <> '$myCompanyId' AND p.publishto = 1
		GROUP BY m.company_id order by p.created limit 10";
}else{
	$sql = "SELECT DISTINCT(m.company_id),COUNT(0) AS COUNT FROM projects AS p
		LEFT JOIN members AS m ON m.member_id = p.member_id
		LEFT JOIN share_invites AS si ON (si.id = p.project_id ) 
		LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
		WHERE p.publishto = 1
		GROUP BY m.company_id order by p.created limit 10";
	}
$companyTenders = $db->select($sql);


$sql ="SELECT m.member_photo,m.first_name,m.last_name,m.designation,m.company_id,comp.logo,comp.company_name FROM members AS m
		LEFT JOIN company AS comp ON comp.company_id = m.company_id
 		WHERE user_id = '$userId'";

$memberDetails = $db->fetch($sql);

$sql ="SELECT * from countries";
$countries = $db->select($sql);

?>