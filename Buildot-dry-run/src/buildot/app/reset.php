<?php

if(!empty($_GET['code']) && empty($_POST['code']))
{

	$code = $_GET['code'];
	 $sql = "SELECT * FROM forget_password WHERE code = '$code'";
	if($db->numrows($sql) > 0){
	}else{
		$_SESSION['errors']  = "Invalid Confirmation Code";
		header("Location: ".SITEURL."forget.html");
		exit;
	}
	
}
elseif(!empty($_POST['code'])){

	$code = $_POST['code'];
	$_password = $_POST['password'];
	$_cpassword = $_POST['cpassword'];
	$error = 0;
	
	if(empty($_password)){
		$error = 1;
			$_SESSION['errors'][] = "Please Enter Password";
	}
	if(empty($_cpassword)){
			$_SESSION['errors'][] = "Please Enter Confirm Password";
		$error = 1;
	}
	if(md($_password) != md($_cpassword)){
		$_SESSION['errors'][] = "Password not match";
		$error = 1;
	}
	if(!empty($_password) && strlen($_password) < 4){
		
		$_SESSION['errors'][] = "Password must be atleast 4 characters long";
		$error = 1;
	}
	
	if($error == 0){
		$sql = "SELECT * FROM forget_password WHERE code = '$code'";
		if($db->numrows($sql) > 0){
			$user = $db->fetch($sql);
			$data = array();
			$data['password'] = md($_password);
			$rs = $db->update("users",$data,"user_id=".$user['userId']);

			$_SESSION['messages'] = "Your password has been updated";
			
			$db->delete("forget_password","code = '$code'");
			header("Location: ".SITEURL."login.html");
			exit;
		}else{
			$_SESSION['errors']  = "Invalid Confirmation Code";
			header("Location: ".SITEURL."forget.html");
		}	
	}
}
else
{
	header("Location: ".SITEURL."forget.html");
}

?>

