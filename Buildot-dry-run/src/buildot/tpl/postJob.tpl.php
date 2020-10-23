<link rel="stylesheet" href="css/jquery.ui.datepicker.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.datepicker.js"></script>

<script>
	$(function() {
			var edate = $( "#expirydate" ).datepicker({
			changeMonth: false,
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 1,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				edate.not( this ).datepicker( "option", option, date );
			}
		});
	});
</script>

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
<td width="90%"><h2>Post A Job</h2></td>
</tr>
</table>
<form action="" method="post" enctype="multipart/form-data">
<div id="inddiv">
<table width="95%" cellspacing="10" cellpadding="0" align="center">
<tbody><tr>
<td colspan="2" style="line-height: 1px;">&nbsp;</td>
</tr>
<tr>
<td width="19%">
<label for="jobtitle">Job Title</label>
</td>
<td width="81%">
<input type="text" id="jobtitle" name="jobtitle">
<br>
<span class="error_span" id="name_error"></span></td>
</tr>
<tr>
<td>
<label for="location">Location</label>
</td>
<td>
<input type="text" id="location" name="location">
<br>
<span class="error_span" id="type_error"></span></td>
</tr>
<tr>
<td>
<label for="contactnum">Contact Number</label>
</td>
<td>
<input type="text" id="contactnum" name="contactnum">
<br>
<span class="error_span" id="email_error"></span></td>
</tr>
<tr>
<td>
<label for="email">Email</label>
</td>
<td>
<input type="text" id="email" name="email">
<br>
<span class="error_span" id="email_error"></span></td>
</tr>
<tr>
<td>
<label for="category">Job Category</label>
</td>
<td>
<select id="category" name="category">
                                    <option value="1">Administration Jobs</option>
                                    <option value="2">Art/Design/Creative Jobs</option>
                                    <option value="3">Customer Service Jobs</option>
                                    <option value="4">Education/Training Jobs</option>
                                    <option value="5">Engineering Jobs</option>
                                    <option value="6">Healthcare/Medical Jobs</option>
                                    <option value="7">Human Resources/Personnel Jobs</option>
                                    <option value="8">IT Jobs</option>
                                    <option value="9">Banking &amp; Finance</option>
                                    <option value="10">Managerial &amp; Supervisory</option>
                                    <option value="11">Skilled Labour</option>
                                    <option value="12">Unskilled Labour</option>
                                </select>
<br>
<span class="error_span" id="category_error"></span> </td>
</tr>
<tr>
<td>
<label>Description</label>
</td>
<td>
<textarea name="description" cols="25"></textarea>
</td>
</tr>
<tr>
<td>
<label for="expirydate">Expiry Date</label>
</td>
<td>
<input type="text" readonly="readonly" id="expirydate" name="expirydate" >
<br>
<span class="error_span" id="date_error"></span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<input type="submit" value="Post Job" name="postjob" id="post">
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
