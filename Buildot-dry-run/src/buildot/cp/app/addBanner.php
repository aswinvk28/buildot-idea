<?php
//ini_set("display_errors",1);

if($_POST){

	$error = 0;
		
		$title = $_POST['title'];
		$category = $_POST['category'];
		$link = $_POST['link'];
		
	
		if(empty($title)){
			$_SESSION['errors'][] = "Please Enter the Title";
			$error = 1;
		}
		
		if(empty($category)){
			$_SESSION['errors'][] = "Please mention the type of category";
			$error = 1;
		}
	
		if(empty($link)){
			$_SESSION['errors'][] = "Please enter the link";
			$error = 1;
		}

		
	if($error != 1){
	
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			
			$banner_data = array();
			$banner_data['banner_title'] =  $title;
			$banner_data['banner_cat_id'] = $category;
			$banner_data['link'] = $link;
			$banner_data['created'] =  'NOW()';
			if(!empty($_FILES['file']['tmp_name'])){
		
				$ext = get_ext($_FILES['file']['tmp_name']);
				$imagepath = $_FILES['file']['tmp_name'];
				$output = 'image' . str_replace('.', '', microtime(true));
				//$result = resizeImage($imagepath,80, 0, true, UPLOADED_LOGO_THUMB_DIR . $output, false);
				$result = resizeImage($imagepath,400, 0, true, UPLOADED_BANNER_DIR . $output, true);
				
				$banner_data['file'] = $output.$ext;
		
			}
			
			$db->insert("banners",$banner_data);
			
			
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Banner has been added";

			header("Location: index.php?view=addBanner");
		
	}

	
	header("Location: index.php?view=addbanner");
	exit;
}

$sql ="SELECT * FROM banner_category";
$bannerCategories= $db->select($sql);
?>