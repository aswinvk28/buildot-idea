<?php
session_start();
include_once('../lib/global.inc.php');
include_once(LIBPATH.'common.inc.php');
include_once(LIBPATH.'db.inc.php');
include_once(LIBPATH.'session.inc.php');
include_once(LIBPATH.'functions.inc.php');

if($_POST){
$username = $_POST['username'];
$password = md($_POST['password']);

$sql = "SELECT userId, username, userType, name FROM users 
		WHERE username = '$username' AND password = '$password' AND 
		userType <> 1 AND status = 1";

$result = $db->numrows($sql);

if($result > 0){
	$userInfo = $db->fetch($sql);
	$_SESSION['userInfo'] = $userInfo;
	header("Location: ".SITEURL."admin/index.php");	 

}else{
	header("Location: ".SITEURL."admin/login.php?login=failed");	 

}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
	<head>
		
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	  
		
		<title>Emirates Express Admin | Sign In</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="css/invalid.css" type="text/css" media="screen" />	
		<link rel="stylesheet" href="css/red.css" type="text/css" media="screen" />  
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->
	  
		<!-- jQuery -->
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="js/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="js/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
		
	</head>
  
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
<div style="margin: 80px 20px 20px 20px; font-size: 15pt; float: right; color: #fff;">
الإمارات اكسبرس - لوحة التحكم الادارية 
</div>
				<div style="margin: 80px 20px 20px 20px; font-size: 15pt; float: left; color: #fff;">
					Emirates Express Admin Panel</div>
				<!-- Logo (221px width) -->
				<img id="logo" src="images/logo.png" alt="KabayanWeekly" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="" method="post">
				<?php if($_GET['login'] == 'failed'){ ?>
				<div class="notification error png_bg"> <a href="#" class="close"><img src="images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
		<div> Invalid Username / Password. </div>
	</div>
				<?php } ?>
					<div class="notification information png_bg">
						<div>
							Enter Username And Passowrd 
						</div>
					</div>
					
					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="username" value="support@kunoozdubai.com" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name="password" value="password" />
					</p>
					<div class="clear"></div>
					
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="Sign In" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
		
  </body>
  
</html>
