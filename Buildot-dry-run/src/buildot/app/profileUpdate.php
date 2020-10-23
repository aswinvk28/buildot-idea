<?php
//ini_set("display_errors",1);
checkAdmin();
if($_POST){
	
	$userId = $_POST['userId'];
	$memberId = $_POST['memberId'];
	$companyId = $_POST['companyId'];
	$error = 0;
	if(empty($companyId)){
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$mobile = $_POST['mobile'];
		$location = $_POST['mem_location'];
		$countryId = $_POST['countryId'];
		$gender = $_POST['gender'];
		$birthdate = explode("-",$_POST['birthdate']);
		
	
		if(empty($firstname)){
			$_SESSION['errors'][] = "Please Enter First Name";
			$error = 1;
		}
		if(empty($lastname)){
			$_SESSION['errors'][] = "Please Enter Last Name";
			$error = 1;
		}
		if(empty($gender)){
			$_SESSION['errors'][] = "Please enter the gender";
			$error = 1;
		}
		
		if(md($password) != md($cpassword) && !empty($password) && !empty($cpassword)){
			$_SESSION['errors'][] = "Password does not match";
			$error = 1;
		}
	
		if(md($password) == md($cpassword) && !empty($password) && !empty($cpassword) && strlen($password) < 4){
			$_SESSION['errors'][] = "Password cannot be less than 4 characters";
			$error = 1;
		}

		
	if($error != 1){
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			$user_data = array();
			if(!empty($password)){
			$user_data['password'] =  md($password);
			$user_data['modified'] = 'NOW()';
			$db->update("users",$user_data,"user_id = $userId");
			}

			$member_data = array();
			//$member_data['user_id'] =  $userId;
			$member_data['first_name'] = $firstname;
			$member_data['last_name'] = $lastname;
			$member_data['mobile'] = $mobile;
			$member_data['location'] = $location;
			$member_data['countryId'] = $countryId;
			$member_data['gender'] =  $gender;
			$member_data['modified'] = 'NOW()';
			
			$member_data['dateOfBirth'] = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
			
		if(!empty($_FILES['image']['tmp_name'])){
		
		$ext = get_ext($_FILES['image']['tmp_name']);
		$imagepath = $_FILES['image']['tmp_name'];
		$output = 'image' . str_replace('.', '', microtime(true));
		$result = resizeImage($imagepath,80, 0, true, UPLOADED_PHOTO_THUMB_DIR . $output, false);
		$result = resizeImage($imagepath,400, 0, true, UPLOADED_PHOTO_DIR . $output . "-big", true);
		//$result = resizeImage($imagepath,400, 0, true, UPLOADED_PHOTO_DIR . $output, true);
		$member_data['member_photo'] = $output.$ext;
		
		}
		if(!empty($_FILES['cv']['tmp_name'])){

					$member_data['cv'] = DocUpload('cv');
		}
		if(!empty($_FILES['portfolio']['tmp_name'])){

					$member_data['portfolio'] = DocUpload('portfolio');
		}
			
			$db->update("members",$member_data,"member_id = $memberId");
			
			$update_data = array();
			$update_data['update_message'] = 'has updated the profile';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'profile';
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$db->sqlQuery("COMMIT");
			$_SESSION['messages'] = "Your Profile has been updated";

			header("Location: index.php?view=profile");

	}
	}else{
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$designation = $_POST['designation'];
	$companymobile = $_POST['companymobile'];
    $companyname = $_POST['companyname'];

	$funcArea = $_POST['funcArea'];
	$companytype = $_POST['companytype'];
	$password = $_POST['password1'];
	$cpassword = $_POST['cpassword1'];
	$telephone = $_POST['telephone'];
	$fax = $_POST['fax'];
	$website = $_POST['website'];
	$location = $_POST['comp_location'];
	$countryId = $_POST['countryId'];
	
	if(empty($fname)){
			$_SESSION['errors'][] = "Please Enter Your First Name";
			$error = 1;
		}
		if(empty($designation)){
			$_SESSION['errors'][] = "Please Enter Your Designation";
			$error = 1;
		}
		if(empty($companyname)){
			$_SESSION['errors'][] = "Please Enter Company Name";
			$error = 1;
		}
		if(empty($funcArea)){
			$_SESSION['errors'][] = "Please enter the functional Area";
			$error = 1;
		}
		if(empty($companytype)){
			$_SESSION['errors'][] = "Please enter the company type";
			$error = 1;
		}
		if(md($password) != md($cpassword) && !empty($password) && !empty($cpassword)){
			$_SESSION['errors'][] = "Password does not match";
			$error = 1;
		}
	
		if(md($password) == md($cpassword) && !empty($password) && !empty($cpassword) && strlen($password) < 4){
			$_SESSION['errors'][] = "Password cannot be less than 4 characters";
			$error = 1;
		}
		
		if($error != 1){
		
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			$user_data = array();
			//$user_data['email'] =  $companyemail;
			if(!empty($password)){
			$user_data['password'] =  md($password);
			$user_data['modified'] = 'NOW()';
			$db->update("users",$user_data,"user_id = $userId");
			}
			
	
			
				$company_data = array();
			
				$company_data['company_name'] = $companyname;
				$company_data['website'] =  $website;
				if(!empty($_FILES['companyPortfolio']['tmp_name'])){

					$portfolio = DocUpload('companyPortfolio');
					$company_data['portfolio'] = $portfolio;
		        }
			    
			    $company_data['modified'] = 'NOW()';

				if(!empty($_FILES['logo']['tmp_name'])){
		
					$ext = get_ext($_FILES['logo']['tmp_name']);
					$imagepath = $_FILES['logo']['tmp_name'];
					$output = 'image' . str_replace('.', '', microtime(true));
					$result = resizeImage($imagepath,80, 0, true, UPLOADED_LOGO_THUMB_DIR . $output, false);
					$result = resizeImage($imagepath,400, 0, true, UPLOADED_LOGO_DIR . $output . "-big", true);
					
					$company_data['logo'] = $output.$ext;
		 		}
			
				$db->update("company",$company_data,"company_id = $companyId");
		
			$member_data = array();
			
			$member_data['first_name'] = $fname;
			$member_data['last_name'] = $lname;
			$member_data['designation'] = $designation;
			$member_data['mobile'] =  $companymobile;
			$member_data['company_type'] = $companytype;
			$member_data['company_functional_area_id'] =  $funcArea;
			$member_data['telephone'] =  $telephone;
			$member_data['fax'] =  $fax;
			$member_data['location'] = $location;
			$member_data['countryId'] =  $countryId;
			$member_data['modified'] = 'NOW()';
			
			if(!empty($_FILES['image']['tmp_name'])){
		
					$ext = get_ext($_FILES['image']['tmp_name']);
					$imagepath = $_FILES['image']['tmp_name'];
					$output = 'image' . str_replace('.', '', microtime(true));
					$result = resizeImage($imagepath,80, 0, true, UPLOADED_PHOTO_THUMB_DIR . $output, false);
					$result = resizeImage($imagepath,400, 0, true, UPLOADED_PHOTO_DIR . $output . "-big", true);
					
					$member_data['member_photo'] = $output.$ext;
		
			}
		
			
			$db->update("members",$member_data,"member_id = $memberId");
			
			$update_data = array();
			$update_data['update_message'] = 'has updated the profile';
			$update_data['member_id'] = $memberId;
			$update_data['table_name'] = 'profile';
			$update_data['created'] ='NOW()';
			$db->insert("updates",$update_data);
			
			$db->sqlQuery("COMMIT");
			
			$_SESSION['messages'] = "Your Profile has been updated";

			header("Location: index.php?view=profile");

	   }
	}
	

	
	header("Location: index.php?view=profile");
	exit;
}

?>