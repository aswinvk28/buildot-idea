<?php
if($_POST['email'])
{
	$email = $_POST['email'];
	$sql = "SELECT user_id FROM users WHERE email = '$email' AND usertype = 1";
	if($db->numrows($sql) > 0){
		$user = $db->fetch($sql);
		$code = microtime(true);
		$code = str_replace(".","",$code);
		$data = array();
		$data['userId'] = $user['user_id'];
		$data['code'] = $code;
		$data['created'] = 'NOW()';
		$sql = "SELECT fid FROM forget_password WHERE userId = ".$user['user_id'];
		if($db->numrows($sql) > 0){
			$forget = $db->fetch($sql);
			$rs = $db->update("forget_password",$data,"fid = ".$forget['fid']);
		}else{
			$rs = $db->insert("forget_password",$data);
		}
		if($rs){

			$subject = "Password reset for buildot.com Account";
			$body = "Hello,
You are receiving this e-mail because you have requested a password reset for your buildot.com account.

Please Click on the following link and choose a new password:

http://www.buildot.com/index.php?view=reset&code=$code

With our best wishes and good luck for your business!

Best Regards
buildot.com team";

		@mail($email,$subject,$body,"From: Buildot <noreply@buildot.com>");

			$_SESSION['messages']  = "Password reset Link has been sent to your email $email";
		}
		
	}else{
			$_SESSION['errors']  = "There is no account registered with $email";
		
	}
	
}
elseif($_POST)
{
		$_SESSION['errors'] = "Please Enter Email Address";
}


?>

