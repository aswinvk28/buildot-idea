<?php

$page = $_GET['page'];
$limit = 30;
$pageURL= 'index.php?view=viewBanners';


if($_GET['action']== 'delete'){
$banner_id = $_GET['banner_id'];
	
	$sql ="SELECT * from banners where banner_id = $banner_id";
	$banner = $db->fetch($sql);
	
	unlink(UPLOADED_BANNER_DIR.$banner['file']);
	$db->delete("banners","banner_id = $banner_id");
	
	$_SESSION['messages'] = "Banner has been deleted successfully";

	header("Location: index.php?view=viewBanners");
	exit;
}

$sql = "SELECT b.*,bc.banner_category FROM banners AS b
		LEFT JOIN banner_category AS bc ON (bc.banner_cat_id = b.banner_cat_id) ORDER BY created DESC";

$banners = $db->select($sql,$limit,$page);
$bannerCount = $db->numrows($sql);		

$paginate = $db->PHPPaginator($limit, $bannerCount, $page, $pageURL);



?>