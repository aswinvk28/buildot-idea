<link rel="stylesheet" href="css/jquery.ui.datepicker.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.slider.js"></script>
<script>
	$(function() {
		
		$('#eventtime').datetimepicker({
			ampm: false,
			dateFormat: 'dd-mm-yy',
			timeOnlyTitle: 'Time',
			timeText: 'Time',
			hourText: 'Hour',
			minuteText: 'Minute',
			secondText: 'Second',
			currentText: 'Current',
			closeText: 'Done'
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
<td colspan="3" valign="top"><h2>CREATE AN EVENT</h2></td>
</tr>
</table>    
    
<form action="" class="cssform" id="myform" method="post" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="10" align="center" width="100%">
<tr>
<td><label for="eventname">Event Name</label></td>
<td><input type="text" name="eventname" id="eventname"></td>
</tr>

<tr>
<td><label for="location">Location</label></td>
<td><input type="text" name="location" id="location"></td>
</tr>

<tr>
<td><label for="country">Country</label></td>
<td><select name="country" id="country" style="width: 222px;">
    <option value="182">United Arab Emirates</option>
		<?php foreach($countries as $country){ ?>
		<option value="<?php echo $country['countryId'] ?>"><?php echo $country['country'] ?></option>
				 <?php } ?>
		</select></td>
</tr>

<tr>
<td><label for="eventtime">Event Time</label></td>
<td><input type="text" name="eventtime" id="eventtime" class="calender_box"  readonly="readonly"></td>
</tr>

<tr>
<td><label for="website">Website</label></td>
<td><input type="text" name="website" id="website"></td>
</tr>

<tr>
<td><label>Description</label></td>
<td><textarea cols="25" rows="4"  name="description"></textarea></td>
</tr>

<tr>
<td><label for="image">Image</label></td>
<td><input type="file" name="file" id="file" style="width:220px"><br /><span class="smalltxt">(jpg, png, gif, pdf files only)</span></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" class="button" value="Create Event" id="createEvent" ></td>
</tr>




</table>
</form>


    
    </td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
