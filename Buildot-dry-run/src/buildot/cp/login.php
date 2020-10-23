<?php
session_start();
include_once('../lib/global.inc.php');
include_once(LIBPATH.'common.inc.php');
include_once(LIBPATH.'db.inc.php');
include_once(LIBPATH.'session.inc.php');
include_once(LIBPATH.'upload.inc.php');
include_once(LIBPATH.'functions.inc.php');

if(isset($_GET['reg']) || $_POST){
	
	if($_GET['reg'] == 1){
		$email = $_SESSION['tmp_reg']['email'];
		$password = $_SESSION['tmp_reg']['password'];
		$_SESSION['tmp_reg'] = '';

	}else{
		
		$email = $_POST['email'];
		$password = md($_POST['password']);
		
	}

	$s->login($email,$password);
}



$sql = "SELECT * from company_functional_area";
$CompanyFuncAreas = $db->select($sql);

$sql = "SELECT * from countries";
$countries = $db->select($sql);
?>
<script>
function changeName(val){
	if(val == 0){
		document.getElementById('inddiv').style.display="";
		document.getElementById('companydiv').style.display="none";
	}else{
		document.getElementById('inddiv').style.display="none";
		document.getElementById('companydiv').style.display="";
	}
}
</script>
<script>
function validateRegister(){
	
	var name = document.getElementById('firstname');
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	var cpassword = document.getElementById('cpassword');

	var fl = 0;
	var ps = 0;
	
	if(!validate(name)){
		error_span('name_error', '<?=PLEASE_ENTER_NAME?>');
		fl = 1;
	}else{
		error_span('name_error', '');
	}
	if(!validate(email)){
		error_span('email_error', '<?=PLEASE_ENTER_EMAIL?>');
		fl = 1;
	}else if(!emailValidate(email)){
		error_span('email_error', 'Invalid Email id and Password');
		fl = 1;
	}else{
		error_span('email_error', '');
	}
	
	if(fl == 1){
		return false;
	}else{
		return true;
	}
}
</script>
<script type="text/javascript">
$().ready(function() {
	$("#companyname").autocomplete("index.php?view=companysearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
	});
});
</script>


<style>
#wrapper{
	width: 980px;
	margin: auto;
}

</style>

<link rel="stylesheet" type="text/css" href="css/login.css" media="all" />
<div id="wrapper">
<div align="left" style="padding-top:5px"><img src="../images/logo.png" /></div>
<div class="box">
	<div class="welcome" id="welcometitle">Welcome to Buildot.com<!--//  Welcome message -->
</div>
  
  
  <div id="fields"> 
<form method="post" action="">
							<table cellpadding="0" cellspacing="0" width="90%" align="center">
								<tr>
									<td>
										<label>Enter Username</label>
									</td>
								</tr>
								<tr>
									<td>
										<input type="text" id="email" name="email" />
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td>
										<label>Enter Password</label>
									</td>
								</tr>
								<tr>
									<td>
										<input type="password" id="password" name="password" />
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="left">
										<input type="image" src="images/btn_login.png" id="submit" name="submit" />
									</td>
								</tr>
							</table>
							<table>
							</table>
						</form>
  </div>
  
  
  <div class="login" id="lostpassword"></div>
</div>
</div>