<?php

$page = $_GET['page'];

$banner_id = $_GET['banner_id'];


$sql = "SELECT b.*,bc.banner_category FROM banners AS b
LEFT JOIN banner_category AS bc ON (bc.banner_cat_id = b.banner_cat_id)
 WHERE banner_id = $banner_id";
$banner = $db->fetch($sql);


?>