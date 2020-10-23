<div id="container">

<table cellpadding="0" cellspacing="0">
<tr>
<td width="209" valign="top">
<?php include ("inc_leftbar.tpl.php"); ?>
</td>

<td width="791" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="general_table">
  <tr>
    <td>
<h2>CREATE GROUP</h2>
<form action="" method="post" enctype="multipart/form-data">
<div id="inddiv">


<table width="95%" cellspacing="10" cellpadding="0" align="center">
<tbody><tr>
	<td width="19%">&nbsp;</td>
	<td width="81%">&nbsp;</td>
</tr>
<tr>
	<td><label for="groupname">Group Name</label></td>
	<td><input type="text" id="groupname" name="groupname"> <br> <span class="error_span" id="name_error"></span></td>
</tr>
<tr>
	<td><label for="grouptype">Group Type</label></td>
	<td><input type="text" id="grouptype" name="grouptype"> <br> <span class="error_span" id="ytpe_error"></span></td>
</tr>
<tr>
	<td><label for="groupowner">Group Owner</label></td>
	<td><input type="text" value="support@kunoozdubai.com" id="groupowner" name="groupowner">  <br> <span class="error_span" id="email_error"></span></td>
</tr>
<tr>
	<td><label for="website">Website</label></td>
	<td><input type="text" id="website" name="website">  <br> <span class="error_span" id="website_error"></span></td>
</tr>

<tr>
	<td><label for="privacy">Access</label></td>
	<td>
		<select name="privacy">
		<option value="">Select Access</option>
		<option value="Open">Open</option>
		<option value="Closed">Closed</option>
		<option value="Secret">Secret</option>
		</select> <br> <span class="error_span" id="privacy_error"></span>
	</td>
</tr>

<tr>
	<td><label>Summary</label></td>
	<td><textarea cols="25" rows="4" name="summary">		</textarea></td>
</tr>
<tr>
	<td><label>Description</label></td>
	<td><textarea cols="25" rows="4" name="description">		</textarea></td>
</tr>
<tr>
<td><label>Logo</label></td>
<td>
<input type="file" name="logo" class="small" id="logo" style="width:220px">
<br><span class="comments">(jpg, png, gif files only)</span>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<div align="left">
			<input type="submit" value="Create Group" name="create group" id="create">
		</div>
	</td>
</tr>

</tbody></table>

</div>
</form>
    
</td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
