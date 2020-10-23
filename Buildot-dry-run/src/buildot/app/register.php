<?php
//ini_set("display_errors",1);
$type= $_POST['type'];
if($_POST){
	
	//$company = $_POST['company'];
	 $type = $_POST['type'];
	$error = 0;
	if($type == 'ind'){
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		$gender = $_POST['gender'];
		$scode = $_POST['security_code'];
		
	
		if(empty($firstname)){
			$_SESSION['errors'][] = "Please Enter First Name";
			$error = 1;
		}
		if(empty($lastname)){
			$_SESSION['errors'][] = "Please Enter Last Name";
			$error = 1;
		}
		if(empty($email)){
			$_SESSION['errors'][] = "Email id is invalid";
			$error = 1;
		}
		if(empty($password)){
			$_SESSION['errors'][] = "Please Enter password";
			$error = 1;
		}
		if(empty($cpassword)){
			$_SESSION['errors'][] = "Please re-enter the password";
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
		if(!validateEmail($email)){
			$_SESSION['errors'][] = "Email id is invalid";
			$error = 1;
		}	
		if(empty($scode)){
			$error = 1;
			$_SESSION['errors'][] = "Please enter the security code"; 
		}elseif(!$s->captcha()){
			$error = 1;
			$_SESSION['errors'][] = "Security Code is wrong. Please enter again";
		}
		
	if($error != 1){
		
		$sql = "SELECT * FROM users where email = '$email'";
		$row = $db->numrows($sql);
		if($row > 0){
			$_SESSION['errors'][] = "Email id already exists ";
		}
		else{
		
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			$user_data = array();
			$user_data['email'] =  $email;
			$user_data['password'] =  md($password);
			$user_data['created'] =  'NOW()';
			$db->insert("users",$user_data);
			$userId = $db->insertid();
			
			$member_data = array();
			$member_data['user_id'] =  $userId;
			$member_data['first_name'] = $firstname;
			$member_data['last_name'] = $lastname;
			$member_data['gender'] =  $gender;
			$member_data['created'] =  'NOW()';
		if(!empty($_FILES['image']['tmp_name'])){
		
		$ext = get_ext($_FILES['image']['tmp_name']);
		$imagepath = $_FILES['image']['tmp_name'];
		$output = 'image' . str_replace('.', '', microtime(true));
		$result = resizeImage($imagepath,80, 0, true, UPLOADED_PHOTO_THUMB_DIR . $output, false);
		$result = resizeImage($imagepath,400, 0, true, UPLOADED_PHOTO_DIR . $output . "-big", true);
		$member_data['member_photo'] = $output.$ext;
		
		}
		if(!empty($_FILES['cv']['tmp_name'])){

					$member_data['cv'] = DocUpload('cv');
		}
		if(!empty($_FILES['portfolio']['tmp_name'])){

					$member_data['portfolio'] = DocUpload('portfolio');
		}
				
			
			$db->insert("members",$member_data);
			$memberId = $db->insertid();
			
			$code = microtime(true);
			$code = str_replace(".","",$code);
			$data = array();
			$data['member_id'] = $memberId;
			$data['code'] = $code;
			$data['created'] = 'NOW()';
			$sql = "SELECT activation_id FROM activation WHERE member_id = ".$memberId;
			if($db->numrows($sql) > 0){
				//$_SESSION['messages'] = "You have been already Registered,you will receive an email for activation soon";
			}else{
			$rs = $db->insert("activation",$data);
			}
			if($rs){

			$subject = "Activation mail for buildot.com Account";
			$body = "Hello,
You are receiving this e-mail because you have registered in buildot.com account.
Please Click on the following link and activate your account:

http://www.buildot.com/activate.html/$code

email: $email
password: $password

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");

			//$_SESSION['messages']  = "Activation mail has been sent to your email $email";
		}
			
			$db->sqlQuery("COMMIT");
			//$_SESSION['messages'] = "You have been sucessfully Registered, an email will be sent to your email address";

			header("Location: index.php?view=message");
			exit;
		}
		header("Location: index.php?view=login&type=ind");
		exit;
	}
	header("Location: index.php?view=login&type=ind");
		exit;
}else{
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$designation = $_POST['designation'];
	$companyname = $_POST['companyname'];
	$companyemail = $_POST['companyemail'];
	$funcArea = $_POST['funcArea'];
	$companytype = $_POST['companytype'];
	$password = $_POST['password1'];
	$cpassword = $_POST['cpassword1'];
	$telephone = $_POST['telephone'];
	$fax = $_POST['fax'];
	$companymobile = $_POST['companymobile'];
	$location = $_POST['location'];
	$countryId = $_POST['country'];
	$website = $_POST['website'];
	$scode1 = $_POST['security_code1'];
	
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
		if(empty($password)){
			$_SESSION['errors'][] = "Please Enter password";
			$error = 1;
		}
		if(empty($cpassword)){
			$_SESSION['errors'][] = "Please re-enter the password";
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
		if(!validateEmail($companyemail)){
			$_SESSION['errors'][] = "Email id is invalid";
			$error = 1;
		}	
		if(empty($scode1)){
			$error = 1;
			$_SESSION['errors'][] = "Please enter the security code"; 
		}elseif(!$s->captcha1()){
			$error = 1;
			$_SESSION['errors'][] = "Security Code is wrong.Please enter again";
		}
		
		if($error != 1){
		
		$sql = "SELECT * FROM users where email = '$companyemail'";
		$row = $db->numrows($sql);
		if($row > 0){
			$_SESSION['errors'][] = "Email Id Already exists";
		}
		else{
		
			$db->sqlQuery("SET autocommit=0");
			$db->sqlQuery("START TRANSACTION");
			$user_data = array();
			$user_data['email'] =  $companyemail;
			$user_data['password'] =  md($password);
			$user_data['created'] =  'NOW()';
			
			$db->insert("users",$user_data);
			$userId = $db->insertid();
			
			$sql = "SELECT * FROM company where company_name = '$companyname'";
			$company = $db->fetch($sql);
			$row = $db->numrows($sql);
			if($row > 0){
			//$_SESSION['errors'][] = EMAIL_ALREADY_EXISTS;
			$company_id = $company['company_id'];
		    }else{
			
				$company_data = array();
			
				$company_data['company_name'] = $companyname;
				$company_data['website'] =  $website;
				if(!empty($_FILES['companyPortfolio']['tmp_name'])){

					$portfolio = DocUpload('companyPortfolio');
				}
				$company_data['portfolio'] = $portfolio;
				$company_data['created'] =  'NOW()';

				if(!empty($_FILES['logo']['tmp_name'])){
		
					$ext = get_ext($_FILES['logo']['tmp_name']);
					$imagepath = $_FILES['logo']['tmp_name'];
					$output = 'image' . str_replace('.', '', microtime(true));
					$result = resizeImage($imagepath,80, 0, true, UPLOADED_LOGO_THUMB_DIR . $output, false);
					$result = resizeImage($imagepath,400, 0, true, UPLOADED_LOGO_DIR . $output . "-big", true);
					
					$company_data['logo'] = $output.$ext;
		
			}
			
			$db->insert("company",$company_data);
			$companyId = $db->insertid();
		 }
			$member_data = array();
			$member_data['user_id'] =  $userId;
			if(!empty($company_id)){
				
				$member_data['company_id'] =  $company_id;
			}else{
				
			$member_data['company_id'] =  $companyId;
			}
			$member_data['first_name'] = $fname;
			$member_data['last_name'] = $lname;
			$member_data['designation'] = $designation;
			$member_data['company_type'] = $companytype;
			$member_data['company_functional_area_id'] =  $funcArea;
			$member_data['telephone'] = $telephone;
			$member_data['fax'] = $fax;
			$member_data['mobile'] =  $companymobile;
			$member_data['location'] = $location;
			$member_data['countryId'] =  $countryId;
			$member_data['created'] =  'NOW()';
			if(!empty($_FILES['companyphoto']['tmp_name'])){
		
					$ext = get_ext($_FILES['companyphoto']['tmp_name']);
					$imagepath = $_FILES['companyphoto']['tmp_name'];
					$output = 'image' . str_replace('.', '', microtime(true));
					$result = resizeImage($imagepath,80, 0, true, UPLOADED_PHOTO_THUMB_DIR . $output, false);
					$result = resizeImage($imagepath,400, 0, true, UPLOADED_PHOTO_DIR . $output . "-big", true);
					
					$member_data['member_photo'] = $output.$ext;
		
			}
		
			
			$db->insert("members",$member_data);
			$memberId = $db->insertid();
			
			$code = microtime(true);
			$code = str_replace(".","",$code);
			$data = array();
			$data['member_id'] = $memberId;
			$data['code'] = $code;
			$data['created'] = 'NOW()';
			$sql = "SELECT activation_id FROM activation WHERE member_id = ".$memberId;
			if($db->numrows($sql) > 0){
				//$_SESSION['messages'] = "You have been already Registered,you will receive an email for activation soon";
			}else{
			$rs = $db->insert("activation",$data);
			}
			if($rs){

			$subject = "Activation mail for buildot.com Account";
			$body = "Hello,
			
You are receiving this e-mail because you have registered in buildot.com account.
Please Click on the following link and activate your account:

http://www.buildot.com/activate.html/$code

email: $companyemail
password: $password

With our best wishes and good luck for your business!
Best Regards
buildot.com team";

		@mail($companyemail,$subject,$body,"From: Buildot <noreply@buildot.com>");

			//$_SESSION['messages']  = "Activation mail has been sent to your email $email";
		}
			$db->sqlQuery("COMMIT");
			
			//$_SESSION['messages'] = "You have been sucessfully Registered, an email will be sent to your email address";

			header("Location: index.php?view=message");
			exit;
		}
		header("Location: index.php?view=login&type=comp");
		exit;
		}
	header("Location: index.php?view=login&type=comp");
	exit;
	}
header("Location: index.php?view=login&type=comp");
	exit;
}

?>