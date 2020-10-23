<style>
body {
	background:url(images/bg.jpg) no-repeat center top  #fff fixed ;
	

}
</style>
<script>
function changeName(val){

	if(val == 0){
		document.getElementById('inddiv').style.display="";
		document.getElementById('companydiv').style.display="none";
		document.getElementById('companyno').checked = "checked";
	}else{
		document.getElementById('inddiv').style.display="none";
		document.getElementById('companydiv').style.display="";
		document.getElementById('companyyes').checked = "checked";
	}
}
</script>
<script>
  $(document).ready(function(){
    $("#indForm").validate({
			rules: {
    		price: {
				number: true
    		}
  		},
			submitHandler: function(form) {
				postCar(1,form);
			}
		});
		$("#compForm").validate({
			rules: {
    		price: {
				number: true
    		}
  		},
			submitHandler: function(form) {
				postCar(1,form);
			}
		});
	
	
  });
</script>
<script>

function validateNumber(event) {
	//alert(event.keyCode);
   var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 8 || event.keyCode == 46
     || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
};

$(document).ready(function(){
    $('[id^=companymobile]').keypress(validateNumber);
	$('[id^=telephone]').keypress(validateNumber);
	$('[id^=fax]').keypress(validateNumber);
});
</script>
<script type="text/javascript">
$().ready(function() {
	$("#companyname").autocomplete("index.php?view=companysearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
	});
	
});

function disableCompany(){
	document.getElementById('website').disabled='disabled';
	document.getElementById('logo').disabled='disabled';
	document.getElementById('companyPortfolio').disabled='disabled';
	document.getElementById('message').style.display="";
}
</script>
<?php if($type == 'ind') {?>
<body onLoad="changeName(0);">
<?php } ?>
<div id="container" style="text-align:left;">
  <table cellpadding="0" cellspacing="0">
    <tr>
      <td width="209" valign="top"><?php include ("inc_login.tpl.php"); ?></td>
      <td width="791" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="general_table">
          <tr>
        	<td>
            <h2>CREATE AN ACCOUNT</h2>
            </td>
          </tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
Personal <input type="radio" name="company" id="companyno" value="0"  onChange="changeName(this.value)" />
Company <input type="radio" id="companyyes" name="company" value="1" checked="checked" onChange="changeName(this.value)" />
<div id="inddiv" style="display: none;">
<form action="" name="indForm" id="indForm" method="post" enctype="multipart/form-data">
<input type="hidden" name="reg" value="1">
<input type="hidden" id="type" name="type" value="ind"/>
<table cellpadding="0" cellspacing="10" width="100%" align="center">

<tr>
<td valign="top">First Name<input type="text" name="firstname" id="firstname"  class="required" value="<?=$firstname?>"/></td>
<td valign="top">Last Name<input type="text" name="lastname" id="lastname"  class="required" value="<?=$lastname?>"/></td>
</tr>

<tr>
<td valign="top">Email<input type="text" name="email" id="email" class="required" value="<?=$email?>"/></td>
<td valign="top">Enter Password<input type="password" name="password" id="password"  class="required"/></td>
<td valign="top">Confirm Password<input type="password" name="cpassword" id="cpassword"  class="required" /></td>
</tr>



<tr>
<td colspan="2" valign="top">
<select name="gender" class="required">
<option>Select Gender</option>
<option <?= ($gender == 'Male')?' Selected':''?>>Male</option>
<option <?= ($gender == 'Female')?' Selected':''?>>Female</option>
</select>
</td>
</tr>


<tr>
<td valign="top">Photo<br /><span class="filefield"><input type="file" name="image" size="18" id="image" style="width:210px" /></span><br /><span class="smalltxt">[jpg, png, gif files only]</span></td>
<td valign="top">CV/Resume<br /><span class="filefield"><input type="file" name="cv" size="18" id="cv"  style="width:210px" /></span><br /><span class="smalltxt">[pdf, doc, docx, ppt, dwg, jpg, png, gif files only]</span></td>
<td valign="top">Portfolio<br /><span class="filefield"><input type="file" name="portfolio" size="18" id="portfolio"  style="width:210px" /></span><br /><span class="smalltxt">[pdf, doc, docx, ppt, dwg, jpg, png, gif]</span></td>
</tr>

<tr>
<td colspan="2">Type the characters you see in the picture left side<br /><br />
<img src="images/captcha.jpg"  style="float:left;" /><input style="float:left"; type="text" name="security_code" id="security_code" maxlength="4" placeholder="captcha" />
</td>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="2"><input width="96" type="image" height="27" border="0" src="images/sign-me-up-btn.jpg" name=""></td>
<td>&nbsp;</td>
</tr>


</table>
</form>
</div>

<div id="companydiv">
<form action="" name="compForm" id="compForm" method="post" enctype="multipart/form-data">
<input type="hidden" name="reg" value="1">
<input type="hidden" id="type" name="type" value="comp"/>
<table cellpadding="0" cellspacing="10" width="100%" align="center">

<tr>
<td valign="top">First Name<input type="text" name="fname" id="fname" class="required" value="<?=$fname?>" /></td>
<td valign="top">Last Name<input type="text" name="lname" id="lname" class="required" value="<?=$lname?>"/></td>
<td valign="top">Designation<input type="text" name="designation" id="designation" class="required" value="<?=$designation?>"/></td>
</tr>

<tr>
<td valign="top">Mobile<input type="text" name="companymobile" id="companymobile" class="required" value="<?=$companymobile?>"/></td>
<td valign="top">Company Name<input type="text" name="companyname" id="companyname" class="required" value="<?=$companyname?>"/></td>
<td valign="top">Company Type<input type="text" name="companytype" id="companytype" value="<?=$companytype?>" /></td>
</tr>

<tr>
<td colspan="3">
<select name="funcArea" id="funcArea" >
<option value="">Functional Area</option>
<?php foreach($CompanyFuncAreas as $CompanyFuncArea){ ?>
<option value="<?php echo $CompanyFuncArea['id'] ?>" <?= ($funcArea == $CompanyFuncArea['id'])?' Selected':''?>><?php echo $CompanyFuncArea['name'] ?></option>
				 <?php } ?>
</select>
</td>
</tr>

<tr>
<td valign="top">Email<input type="text" name="companyemail" id="companyemail" class="required" value="<?=$companyemail?>" /></td>
<td valign="top">Enter Password<input type="password" name="password1" id="password1" class="required" /></td>
<td valign="top">Confirm Password<input type="password" name="cpassword1" id="cpassword1" class="required"/></td>
</tr>

<tr>
<td valign="top">Telephone<input type="text" name="telephone" id="telephone" value="<?=$telephone?>" /></td>
<td valign="top">Fax<input type="text" name="fax" id="fax" value="<?=$fax?>" /></td>
<td valign="top">Website<input type="text" name="website" id="website" value="<?=$website?>"/></td>
<td>&nbsp;</td>
</tr>

<tr>
<td align="left" valign="top">
<select name="country" id="country" style="margin-top:10px">
<option value="182">United Arab Emirates</option>
<?php foreach($countries as $country){ ?>
<option value="<?php echo $country['countryId'] ?>" <?= ($countryId == $country['countryId'])?' Selected':''?>><?php echo $country['country'] ?></option>
				 <?php } ?>
</select>
</td>
<td valign="top">Location<input type="text" name="location" id="location" value="<?=$location?>" /></td>
</tr>



<tr>
<td valign="top">Photo<br /><input type="file" name="companyphoto" size="18" id="companyphoto"  style="width:210px"/><br /><span class="smalltxt">[jpg, png, gif files only]</span></td>
<td valign="top">Logo<br /><input type="file" name="logo" size="18" id="logo"  style="width:210px"/><br /><span class="smalltxt">[jpg, png, gif files only]</span></td>
<td valign="top">Company Portfolio<br /><input type="file" size="18" name="companyPortfolio" id="companyPortfolio"  style="width:210px"/><br /><span class="smalltxt">[pdf, doc, docx, ppt, dwg, jpg, png, gif]</span></td>
</tr>

<tr>
<td colspan="2">Type the characters you see in the picture left side<br /><br />
<img src="images/captcha1.jpg" style="float:left;" /><input style="float:left"; type="text" name="security_code1" id="security_code1" maxlength="4" placeholder="captcha" />
</td>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="2"><input width="96" type="image" height="27" border="0" src="images/sign-me-up-btn.jpg" name=""></td>
<td>&nbsp;</td>
</tr>

<div id="message" style="display:none">Company is already registered</div>
</table>
</form>
</div>
</td>
</tr>

          
        </table>
      </td>
    </tr>
  </table>
</div>
