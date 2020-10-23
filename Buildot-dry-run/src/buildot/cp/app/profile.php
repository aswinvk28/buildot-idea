<?php

if($_POST){
	
	$userId = $_SESSION['user']['user_id'];
	
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
	if(md($password) != md($cpassword) && !empty($password) && !empty($cpassword)){
			$_SESSION['errors'][] = "Password does not match";
			$error = 1;
		}
	
		if(md($password) == md($cpassword) && !empty($password) && !empty($cpassword) && strlen($password) < 4){
			$_SESSION['errors'][] = "Password cannot be less than 4 characters";
			$error = 1;
		}
		
		if($error != 1){
			
			$user_data = array();
			if(!empty($password)){
			$user_data['password'] =  md($password);
			$user_data['modified'] = 'NOW()';
			$db->update("users",$user_data,"user_id = $userId");
			}
			$_SESSION['messages'] = "Your Password has been updated";

			header("Location: index.php?view=profile");
			exit;
		}
		
}

?>