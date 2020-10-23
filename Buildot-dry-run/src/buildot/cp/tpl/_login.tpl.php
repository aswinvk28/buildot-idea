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


<table cellpadding="0" cellspacing="0" align="center" id="signinup_container">
	<tr>
		<td width="290" valign="top"> 
			
			<!-- signin table start -->
			
			<table cellpadding="0" cellspacing="0" align="center" id="signin">
				<tr>
					<td valign="top"><div style="font-weight: 900; width: 98%; background: #1ba1c7; color: #fff; padding: 3px;">SIGN IN BUILDOT ADMIN PANEL</div></td>
				</tr>
<tr>
<td>
<form method="post" action="login.html">
							<table cellpadding="0" cellspacing="0" width="90%" align="center">
								<tr>
									<td>
										<label>Enter Username</label>
									</td>
								</tr>
								<tr>
									<td>
										<input type="text" id="email" name="email" value="admin" />
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
										<input type="password" id="password" name="password" value="password" />
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="left">
										<input style="height: auto;" type="image" src="images/btn_signmein.png" />
									</td>
								</tr>

							</table>
							<table>
							</table>
						</form>
</td>
</tr>
				
			</table>
			
			<!-- signin table end --> 
			
		</td>
		<td width="650" valign="top">
			
		</td>
	</tr>
</table>