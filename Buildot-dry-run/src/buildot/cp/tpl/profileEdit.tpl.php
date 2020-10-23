<style>

</style>

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"><h2>Edit Profile</h2></td>
	</tr>
<tr>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="200" valign="top">
<!-- left table start -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
<td><div class="ads"><?php include ("ads/200x600/200x600.php"); ?></div>
</td>
	</tr>
	</table>

<!-- left table end -->
</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">

<tr>
<th>Basic Information</th>
</tr><tr>
<td>
<form action="profileUpdate.html" method="post" enctype="multipart/form-data" onclick="return validateRegister()">
<input type="hidden" id="companyId" name="companyId" value="<?php echo $memDetails['company_id']?>" />
<input type="hidden" id="memberId" name="memberId" value="<?php echo $memDetails['member_id']?>" />
<input type="hidden" id="userId" name="userId" value="<?php echo $memDetails['user_id']?>" />
<?php if(empty($memDetails['company_id'])){ ?>
<table cellpadding="2" cellspacing="0" width="95%" align="center">
<tr>
<td><label for="firstname" id="firstname">First Name</label></td>
<td><label for="lastname" id="lastname">Last Name</label></td>
</tr>
<tr>
<td><input type="text" name="firstname" id="firstname" value="<?php echo $memDetails['first_name']?>"/> <br /> <span id="name_error" class="error_span"></span></td>
<td><input type="text" name="lastname" id="lastname" value="<?php echo $memDetails['last_name']?>" /> <br /> <span id="name_error" class="error_span"></span></td>
</tr>

<td><label for="email">Your Email</label></td>
<td><label for="password">Password</label></td>
</tr>
<tr>
<td><input type="text" name="email" id="email" disabled="disabled" value="<?php echo $memDetails['email']?>" />  <br /> <span id="email_error" class="error_span"></span></td>
<td><input type="password" name="password" id="password" />  <br /> <span id="password_error" class="error_span"></span></td>
</tr>

<tr>
<td><label for="password">Confirm Password</label></td>
<td><label for="mobile">Mobile</label></td>
</tr>

<tr>
<td><input type="password" name="cpassword" id="cpassword" />  <br /> <span id="cpassword_error" class="error_span"></span></td>
<td><input type="text" name="mobile" id="mobile" size="15" maxlength="10" value="<?php echo $memDetails['mobile']?>"/>  <br /> <span id="mobile_error" class="error_span"></span></td>
</tr>

<tr>
<td><label for="mem_location">Location</label></td>
<td><label for="countryId">Country</label></td>
</tr>
<tr>
<td><input type="text" name="mem_location" id="mem_location" size="15" value="<?php echo $memDetails['location']?>"/>  <br /> <span id="mobile_error" class="error_span"></span></td>
<td>
<select name="countryId" id="countryId">
<?php foreach($countries as $country){ ?>
<option value="<?=$country['countryId']?>" <?=($memDetails['countryId'] == $country['countryId'])?'Selected':''?>><?=$country['country']?></option>		
		 <?php } ?>
</select>
</td>
</tr>

<tr>
<td><label for="gender">Gender</label></td>
<td><label for="dateOfBirth">Birthday</label></td>
</tr>
<tr>
<td>
<select name="gender">
<option value="<?php echo $memDetails['gender']?>"><?php echo $memDetails['gender']?></option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select> <br /> <span id="mobile_error" class="error_span"></span>
</td>
<td>
<select name="month" style="width:auto;">
<option value=""><?php if($dateOfBirth[1] == 01)echo Jan;
if($dateOfBirth[1] == 02)echo Feb;
if($dateOfBirth[1] == 03)echo Mar;
if($dateOfBirth[1] == 04)echo Apr;
if($dateOfBirth[1] == 05)echo May;
if($dateOfBirth[1] == 06)echo Jun;
if($dateOfBirth[1] == 07)echo Jul;
if($dateOfBirth[1] == 08)echo Aug;
if($dateOfBirth[1] == 09)echo Sep;
if($dateOfBirth[1] == 10)echo Oct;
if($dateOfBirth[1] == 11)echo Nov;
if($dateOfBirth[1] == 12)echo Dec;
?></option>
<option value="01">Jan</option><option value="02">Feb</option>
<option value="03">Mar</option><option value="04">Apr</option>
<option value="05">May</option><option value="06">Jun</option>
<option value="07">Jul</option> <option value="08">Aug</option>
<option value="09">Sep</option><option value="10">Oct</option>
<option value="11">Nov</option><option value="12">Dec</option>
</select>
<select name="day" style="width:auto;">
<option value=""><?php echo $dateOfBirth[2]?></option>
<option value="1">1</option><option value="2">2</option>
<option value="3">3</option><option value="4">4</option>
<option value="5">5</option><option value="6">6</option>
<option value="7">7</option><option value="8">8</option>
<option value="9">9</option><option value="10">10</option>
<option value="11">11</option><option value="12">12</option>
<option value="13">13</option><option value="14">14</option>
<option value="15">15</option><option value="16">16</option>
<option value="17">17</option><option value="18">18</option>
<option value="19">19</option><option value="20">20</option>
<option value="21">21</option><option value="22">22</option>
<option value="23">23</option><option value="24">24</option>
<option value="25">25</option><option value="26">26</option>
<option value="27">27</option><option value="28">28</option>
<option value="29">29</option><option value="30">30</option>
<option value="31">31</option>
</select>
<select name="year" style="width:auto;">
<option value=""><?php echo $dateOfBirth[0]?></option>
<option value="2012">2012</option><option value="2011">2011</option>
<option value="2010">2010</option><option value="2009">2009</option>
<option value="2008">2008</option><option value="2007">2007</option>
<option value="2006">2006</option><option value="2005">2005</option>
<option value="2004">2004</option><option value="2003">2003</option>
<option value="2002">2002</option><option value="2001">2001</option>
<option value="2000">2000</option><option value="1999">1999</option>
<option value="1998">1998</option><option value="1997">1997</option>
<option value="1996">1996</option><option value="1995">1995</option>
<option value="1994">1994</option><option value="1993">1993</option>
<option value="1992">1992</option><option value="1991">1991</option>
<option value="1990">1990</option><option value="1989">1989</option>
<option value="1988">1988</option><option value="1987">1987</option>
<option value="1986">1986</option><option value="1985">1985</option>
<option value="1984">1984</option><option value="1983">1983</option>
<option value="1982">1982</option><option value="1981">1981</option>
<option value="1980">1980</option><option value="1979">1979</option>              
<option value="1978">1978</option><option value="1977">1977</option>
<option value="1976">1976</option><option value="1975">1975</option>
<option value="1974">1974</option><option value="1973">1973</option>
<option value="1972">1972</option><option value="1971">1971</option>
<option value="1970">1970</option><option value="1969">1969</option>
<option value="1968">1968</option><option value="1967">1967</option>
<option value="1966">1966</option><option value="1965">1965</option>
<option value="1964">1964</option><option value="1963">1963</option>
<option value="1962">1962</option><option value="1961">1961</option>
<option value="1960">1960</option><option value="1959">1959</option>
<option value="1958">1958</option><option value="1957">1957</option>
<option value="1956">1956</option><option value="1955">1955</option>
<option value="1954">1954</option><option value="1953">1953</option>
<option value="1952">1952</option><option value="1951">1951</option>
<option value="1950">1950</option><option value="1949">1949</option>
<option value="1948">1948</option><option value="1947">1947</option>
<option value="1946">1946</option><option value="1945">1945</option>
<option value="1944">1944</option><option value="1943">1943</option>
<option value="1942">1942</option><option value="1941">1941</option>
<option value="1940">1940</option><option value="1939">1939</option>
<option value="1938">1938</option><option value="1937">1937</option>
<option value="1936">1936</option><option value="1935">1935</option>
<option value="1934">1934</option><option value="1933">1933</option>
<option value="1932">1932</option><option value="1931">1931</option>
<option value="1930">1930</option><option value="1929">1929</option>
<option value="1928">1928</option><option value="1927">1927</option>
<option value="1926">1926</option><option value="1925">1925</option>
<option value="1924">1924</option><option value="1923">1923</option>
<option value="1922">1922</option><option value="1921">1921</option>
<option value="1920">1920</option>
</select> <br /> <span id="mobile_error" class="error_span"></span>
</td>

</tr>

<tr>
<td><label>Photo</label></td>
<td><label>CV Upload</label></td>
<td></td>
</tr>
<tr>
<td valign="top"><input id="image" type="file" class="small" name="image" /></td>
<td valign="top"><input id="file" type="file" class="small" name="file" /></td>

</tr>

</table>
<?php } else {?>
<table cellpadding="2" cellspacing="0" width="95%" align="center">
<tr>
<td><label for="fname">First Name</label></td>
<td><label for="lname">Last Name</label></td>
</tr>
<tr>
<td><input type="text" name="fname" id="fname" value="<?php echo $memDetails['first_name']?>"/> <br /> <span id="name_error" class="error_span"></span></td>
<td><input type="text" name="lname" id="lname" value="<?php echo $memDetails['last_name']?>" /> <br /> <span id="name_error" class="error_span"></span></td>
</tr>
<tr>
<td><label for="designation" id="designation">Designation</label></td>
<td><label for="companyname" id="companyname">Company Name</label></td>
</tr>
<tr>
<td><input type="text" name="designation" id="designation" value="<?php echo $memDetails['designation']?>"/> <br /> <span id="name_error" class="error_span"></span></td>
<td><input type="text" name="companyname" id="companyname" value="<?php echo $compDetails['company_name']?>" /> <br /> <span id="name_error" class="error_span"></span></td>
</tr>
<td><label for="companyemail">Company Email</label></td>
<td><label for="funcArea">Functional Area</label></td>
</tr>
<tr>
<td><input type="text" name="companyemail" id="companyemail" disabled="disabled" value="<?php echo $memDetails['email']?>" />  <br /> <span id="email_error" class="error_span"></span></td>
<td>
<select name="funcArea" id="funcArea">
<?php foreach($companyFuncAreas as $companyFuncArea){ ?>
<option value="<?=$companyFuncArea['id']?>" <?=($compDetails['company_functional_area_id'] == $companyFuncArea['id'])?'Selected':''?>><?=$companyFuncArea['name']?></option>		
		 <?php } ?>
</select>
</td>
</tr>
<tr>
<td><label for="companytype">Company Type</label></td>
<td><label for="password">Password</label></td>
</tr>
<tr>
<td><input type="text" name="companytype" id="companytype" value="<?php echo $compDetails['company_type']?>" />  <br /> <span id="email_error" class="error_span"></span></td>
<td><input type="password" name="password1" id="password1" />  <br /> <span id="password_error" class="error_span"></span></td>
</tr>
<tr>
<td><label for="password">Confirm Password</label></td>
<td><label for="telephone">Telephone</label></td>
</tr>

<tr>
<td><input type="password" name="cpassword1" id="cpassword1" />  <br /> <span id="cpassword_error" class="error_span"></span></td>
<td><input type="text" name="telephone" id="telephone" size="15" maxlength="10" value="<?php echo $compDetails['telephone']?>"/>  <br /> <span id="mobile_error" class="error_span"></span></td>
</tr>

<tr>
<td><label for="companymobile">Mobile</label></td>
<td><label for="comp_location">Location</label></td>
</tr>
<tr>
<td><input type="text" name="companymobile" id="companymobile" size="15" maxlength="10" value="<?php echo $memDetails['mobile']?>"/>  <br /> <span id="mobile_error" class="error_span"></span></td>

<td><input type="text" name="comp_location" id="comp_location" size="15" value="<?php echo $memDetails['location']?>"/>  <br /> <span id="mobile_error" class="error_span"></span></td>

</tr>


<tr>
<td><label for="countryId">Country</label></td>
<td><label>Photo</label></td>
<td></td>
</tr>
<tr>
<td>
<select name="countryId" id="countryId">
<?php foreach($countries as $country){ ?>
<option value="<?=$country['countryId']?>" <?=($memDetails['countryId'] == $country['countryId'])?'Selected':''?>><?=$country['country']?></option>		
		 <?php } ?>
</select>
</td>
<td valign="top"><input id="image" type="file" class="small" name="image" /></td>
</tr>
<tr><td><label>Logo</label></td></tr>
<tr><td valign="top"><input id="logo" type="file" class="small" name="logo" /></td></tr>
</table>
<?php } ?>
<p>
<div style="margin-left: 20px;" align="left"><input type="submit" src="images/btn_signmeup.png" id="register" value="Save Changes"/> or <a href="index.php?view=profile"> Back to Profile</a></div> 
</p>
</form>
</td>
</tr>
<tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
</table>
<!-- middle table end -->
</td>

<td width="200" valign="top">
<!-- right table start -->
<?php include ("inc_rightbar.tpl.php"); ?>
<!-- right table end -->

</td>
</tr>
</table>