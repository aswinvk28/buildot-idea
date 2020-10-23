<?php


if($_POST){
	
	$name = $_POST['name'];
	$company = $_POST['company'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$website = $_POST['website'];
	$feedback = $_POST['feedback'];
	
	$error = 0;
	
	if(empty($name)){
		$_SESSION['errors'][] = "Please Enter Your Name";
		$error = 1;
	}
	if(empty($email)){
		$_SESSION['errors'][] = "Please Enter Your Email";
		$error = 1;
	}
	if(empty($phone)){
		$_SESSION['errors'][] = "Please Enter Your Phone";
		$error = 1;
	}

	if(empty($feedback)){
		$_SESSION['errors'][] = "Please Enter Your Message";
		$error = 1;
	}
	
	if($error == 0){
		
		$to = "info@gulfcomposite.com";
		//$to = "umer05@gmail.com";
		$subject = "New Feedback at Buildot";
		$body = "Dear Admin

There is a New Feedback at Gulf Buildot

Name: $name
Company: $company
Email: $email
Phone: $phone
Website: $website
Message: $feedback


";

	@mail($to,$subject,$body,"From: Buildot <noreply@buildot.com>");
	$_SESSION['messages'] = "<div style='text-align: left; font-size: 11pt; color: #00789f; font-weight: normal;'>Thanks for contacting us, We will get back to you shortly!</div>";
	}

}

?>