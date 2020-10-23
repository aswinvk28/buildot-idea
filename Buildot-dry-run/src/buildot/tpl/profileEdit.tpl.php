<script type="text/javascript" src="js/calendar.js"></script>
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

<table cellpadding="0" cellspacing="0" style="width: 100%">
<tr>
<td width="88%"><h2>Edit Profile</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">
				<tr>
				  <th>&nbsp;</th>
			    </tr>
				<tr>
					<th>Basic Information</th>
				</tr>
				<tr>
					<td><form action="profileUpdate.html" method="post" enctype="multipart/form-data">
							<input type="hidden" id="companyId" name="companyId" value="<?php echo $memDetails['company_id']?>" />
							<input type="hidden" id="memberId" name="memberId" value="<?php echo $memDetails['member_id']?>" />
							<input type="hidden" id="userId" name="userId" value="<?php echo $memDetails['user_id']?>" />
							<?php if(empty($memDetails['company_id'])) { ?>
							<table cellpadding="5" cellspacing="0" width="100%" align="center">
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td><label for="firstname" id="firstname">First Name</label></td>
									<td><label for="lastname" id="lastname">Last Name</label></td>
								</tr>
								<tr>
									<td><input type="text" name="firstname" id="firstname" value="<?php echo $memDetails['first_name']?>"/>
										<br />
										<span id="name_error" class="error_span"></span></td>
									<td><input type="text" name="lastname" id="lastname" value="<?php echo $memDetails['last_name']?>" />
										<br />
										<span id="name_error" class="error_span"></span></td>
								</tr>
								
									<td><label for="email">Your Email</label></td>
									<td><label for="password">Password</label></td>
								</tr>
								<tr>
									<td><input type="text" name="email" id="email" disabled="disabled" value="<?php echo $memDetails['email']?>" />
										<br />
										<span id="email_error" class="error_span"></span></td>
									<td><input type="password" name="password" id="password" />
										<br />
										<span id="password_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="password">Confirm Password</label></td>
									<td><label for="mobile">Mobile</label></td>
								</tr>
								<tr>
									<td><input type="password" name="cpassword" id="cpassword" />
										<br />
										<span id="cpassword_error" class="error_span"></span></td>
									<td><input type="text" name="mobile" id="mobile" size="15" maxlength="10" value="<?php echo $memDetails['mobile']?>"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
										<br />
										<span id="mobile_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="mem_location">Location</label></td>
									<td><label for="countryId">Country</label></td>
								</tr>
								<tr>
									<td><input type="text" name="mem_location" id="mem_location" size="15" value="<?php echo $memDetails['location']?>"/>
										<br />
										<span id="mobile_error" class="error_span"></span></td>
									<td><select name="countryId" id="countryId">
											<?php foreach($countries as $country){ ?>
											<option value="<?=$country['countryId']?>" <?=($memDetails['countryId'] == $country['countryId'])?'Selected':''?>>
											<?=$country['country']?>
											</option>
											<?php } ?>
										</select></td>
								</tr>
								<tr>
									<td><label for="gender">Gender</label></td>
									<td><label for="dateOfBirth">Date Of Birth</label></td>
								</tr>
								<tr>
									<td><select name="gender">
											<option value="<?php echo $memDetails['gender']?>"><?php echo $memDetails['gender']?></option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										<br />
										<span id="mobile_error" class="error_span"></span></td>
									<td><input type="text" name="birthdate" id="birthdate" class="txtbox-short1" value="<?=$memDetails['birth_date']?>" />
										<script type="text/javascript">calendar.set("birthdate");</script></td>
								</tr>
								<tr>
									<td><label>Photo(gif,jpg,png files only)</label></td>
									<td><label>CV Upload(pdf,doc,docx,ppt,dwg,jpg,png,jif)</label></td>
									<td></td>
								</tr>
								<tr>
									<td valign="top"><input id="image" type="file" class="small" name="image" /></td>
									<td valign="top"><input id="cv" type="file" class="small" name="cv" /></td>
								</tr>
								<tr>
									<td><label>Portfolio(pdf,doc,docx,ppt,dwg,jpg,png,jif)</label></td>
								</tr>
								<tr>
									<td valign="top"><input id="portfolio" type="file" class="small" name="portfolio" /></td>
								</tr>
							</table>    
<?php } else {?>
							<table cellpadding="2" cellspacing="0" width="100%" align="center">
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><label for="fname">First Name</label></td>
									<td><label for="lname">Last Name</label></td>
								</tr>
								<tr>
									<td><input type="text" name="fname" id="fname" value="<?php echo $memDetails['first_name']?>"/>
										<br />
										<span id="name_error" class="error_span"></span></td>
									<td><input type="text" name="lname" id="lname" value="<?php echo $memDetails['last_name']?>" />
										<br />
										<span id="name_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="designation" id="designation">Designation</label></td>
									<td><label for="companymobile">Mobile</label></td>
								</tr>
								<tr>
									<td><input type="text" name="designation" id="designation" value="<?php echo $memDetails['designation']?>"/>
										<br />
										<span id="name_error" class="error_span"></span></td>
									<td><input type="text" name="companymobile" id="companymobile" size="15" maxlength="10" value="<?php echo $memDetails['mobile']?>"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
										<br />
										<span id="mobile_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="companyname" id="companyname">Company Name</label></td>
									<td><label for="companyemail">Company Email</label></td>
								</tr>
								<tr>
									<td><input type="text" name="companyname" id="companyname" value="<?php echo $compDetails['company_name']?>" readonly="readonly"/>
										<br />
										<span id="name_error" class="error_span"></span></td>
									<td><input type="text" name="companyemail" id="companyemail" disabled="disabled" value="<?php echo $memDetails['email']?>" />
										<br />
										<span id="email_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="funcArea">Functional Area</label></td>
									<td><label for="companytype">Company Type</label></td>
								</tr>
								<tr>
									<td><select name="funcArea" id="funcArea">
											<?php foreach($companyFuncAreas as $companyFuncArea){ ?>
											<option value="<?=$companyFuncArea['id']?>" <?=($memDetails['company_functional_area_id'] == $companyFuncArea['id'])?'Selected':''?>>
											<?=$companyFuncArea['name']?>
											</option>
											<?php } ?>
										</select></td>
									<td><input type="text" name="companytype" id="companytype" value="<?php echo $memDetails['company_type']?>" />
										<br />
										<span id="email_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="password">Password</label></td>
									<td><label for="password">Confirm Password</label></td>
								</tr>
								<tr>
									<td><input type="password" name="password1" id="password1" />
										<br />
										<span id="password_error" class="error_span"></span></td>
									<td><input type="password" name="cpassword1" id="cpassword1" />
										<br />
										<span id="cpassword_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="telephone">Telephone</label></td>
									<td><label for="fax">Fax</label></td>
								</tr>
								<tr>
									<td><input type="text" name="telephone" id="telephone" size="15" maxlength="10" value="<?php echo $memDetails['telephone']?>" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
										<br />
										<span id="mobile_error" class="error_span"></span></td>
									<td><input type="text" name="fax" id="fax" size="15" maxlength="10" value="<?php echo $memDetails['fax']?>"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" />
										<br />
										<span id="fax_error" class="error_span"></span></td>
								</tr>
								<tr>
									<td><label for="comp_location">Location</label></td>
									<td><label for="countryId">Country</label></td>
									<td></td>
								</tr>
								<tr>
									<td><input type="text" name="comp_location" id="comp_location" size="15" value="<?php echo $memDetails['location']?>"/>
										<br />
										<span id="mobile_error" class="error_span"></span></td>
									<td><select name="countryId" id="countryId">
											<option value="182">United Arab Emirates</option>
											<?php foreach($countries as $country){ ?>
											<option value="<?=$country['countryId']?>" <?=($memDetails['countryId'] == $country['countryId'])?'Selected':''?>>
											<?=$country['country']?>
											</option>
											<?php } ?>
										</select></td>
								</tr>
								<tr>
									<td><label for="website">Website</label></td>
									<td><label>Logo <span class="comments">(jpg, png, gif files only)</span></label></td>
								</tr>
								<tr>
									<td><input type="text" name="website" id="website" value="<?php echo $compDetails['website']?>" readonly="readonly" />
										<br />
										<span id="website_error" class="error_span"></span></td>
									<td valign="top"><?php if(!empty($compDetails['logo'])) { ?>
										<img src="gallery/logos/thumbs/<?php echo $compDetails['logo'] ?>" align="middle"/>
										<?php } else { ?>
										<input id="logo" type="file" class="small" name="logo" />
										<?php } ?></td>
								</tr>
								<tr>
									<td><label>Photo</label></td>
									<td><label>Portfolio </label></td>
								</tr>
								<tr>
									<td valign="top"><input id="image" type="file" class="small" name="image" />
										<br/>
										<span class="smalltxt">(jpg, png, gif files only)</span></td>
									<td valign="top"><input id="companyPortfolio" type="file" class="small" name="companyPortfolio" />
										<br />
										<span class="smalltxt">(pdf, doc, docx, ppt, dwg, jpg, png, gif)</span></td>
								</tr>
							</table>
							<?php } ?>

<!--needs styling-->
		<p>
							<div style="margin-top: 20px; margin-left: 20px;" align="left">
								<input type="submit" src="images/btn_signmeup.png" id="register" value="Save Changes"/>
								or <a href="index.php?view=profile"><span class="button">Back to Profile</span></a></div>
							</p>
    </form>
<div style="padding-top: 20px;">
To edit the company details please contact <a href="mailto:support@buildot.com">support@buildot.com</a>
</div>
</td>
  </tr>
</table>



</td>

</tr>
</table>
</td>
</tr></table>
</div>
