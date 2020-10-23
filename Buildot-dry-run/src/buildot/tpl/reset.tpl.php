<h2>RESET PASSWORD</h2>

<table cellpadding="0" cellspacing="0" align="center" width="980px">
	<tr>
<td valign="top">
			<form action="reset.html" method="post">
            <input type="hidden" id="code" name="code" value="<?php echo $_GET['code']?>"/>
				<table cellpadding="5" cellspacing="0" align="left">
					<tr>
						<td width="26%">
							<label for="newpassword">New Password<span class="star"> *</span></label>
						</td>
						<td width="74%">
							<input type="password" id="password" name="password" style="width: 200px;"/>
						</td>
					</tr>
					<tr>
						<td width="26%">
							<label for="confirmpassword">Confirm Password<span class="star"> *</span></label>
						</td>
						<td width="74%">
							<input type="password" id="cpassword" name="cpassword" style="width: 200px;" />
						</td>
					</tr>
					
					
					
                    <tr><td>&nbsp;</td></tr>
					
                      <tr><td>&nbsp;</td></tr>
					<tr>
						<td width="26%" valign="top"> </td>
						<td width="74%">
							<input type="submit" value="Submit" />
						</td>
					</tr>
				</table>
			</form>
		</td>

	</tr>
</table>
