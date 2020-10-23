<?php
$page = $_GET['page'];
//$limit = 10;
//$pageURL= 'index.php?view=members';
//$companyId = $_GET['companyId'];
$companyId = request("companyId");
if($_POST){
	
	$data = array();
	$data['company_name'] = $_POST["companyname"];
	$data['website'] = $_POST["website"];
	$data['modified'] = 'NOW()';
	
	if(!empty($_FILES['logo']['tmp_name'])){
		$ext = get_ext($_FILES['logo']['tmp_name']);
		$imagepath = $_FILES['logo']['tmp_name'];
		$output = 'image' . str_replace('.', '', microtime(true));
		$result = resizeImage($imagepath,80, 0, true, '../gallery/logos/thumbs/'. $output, false);
		$result = resizeImage($imagepath,400, 0, true, '../gallery/logos/'. $output . "-big", true);
		$data['logo'] = $output.$ext;
	}
	
	if(!empty($_FILES['portfolio']['tmp_name'])){
		$portfolio = DocUpload('portfolio');
	}
	$db->update("company",$data,"company_id = '$companyId'");
	$_SESSION['messages'] = "Company is edited";
	header("Location: index.php?view=companies");
exit;
}

$sql = "SELECT * FROM company
		ORDER BY created DESC LIMIT 5";
$recentCompanies = $db->select($sql);

$sql = "SELECT comp.* from company AS comp
		 where company_id = $companyId";
$companyDetails = $db->fetch($sql);


?>