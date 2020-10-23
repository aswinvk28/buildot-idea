<?php
//include("../lib/config.php");

$banner_id = request("banner_id");
if($_POST){
	$bannerId = $_POST["banner_id"];
	$data = array();
	$data['banner_title'] = $_POST["title"];
	$data['banner_cat_id'] = $_POST["category"];
	$data['link'] = $_POST["link"];
	$data['modified'] = 'NOW()';
	
	if(!empty($_FILES['file']['tmp_name'])){
		$ext = get_ext($_FILES['file']['tmp_name']);
		$imagepath = $_FILES['file']['tmp_name'];
		$output = 'image' . str_replace('.', '', microtime(true));
		$result = resizeImage($imagepath,400, 0, true, UPLOADED_BANNER_DIR . $output, true);
		$data['file'] = $output.$ext;
	}
	$db->update("banners",$data,"banner_id = '$bannerId'");
	$_SESSION['messages'] = "Banner is edited";
	header("Location: index.php?view=viewBanners");
exit;
}



if($banner_id > 0)
{
	$sql = "SELECT b.*,bc.banner_category FROM banners AS b
			LEFT JOIN banner_category AS bc ON (bc.banner_cat_id = b.banner_cat_id)
			WHERE banner_id = ".$banner_id;
	$banner = $db->fetch($sql);
}

$sql ="SELECT * from banner_category";
$banner_categories= $db->select($sql);
?>
