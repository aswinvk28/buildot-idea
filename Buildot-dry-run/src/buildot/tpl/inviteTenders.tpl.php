<link rel="stylesheet" href="css/jquery.ui.datepicker.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/jquery.ui.datepicker.js"></script>

<script>
	$(function() {
		var odate = $( "#openingdate" ).datepicker({
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
				odate.not( this ).datepicker( "option", option, date );
			}
		});
	
			var cdate = $( "#closingdate" ).datepicker({
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
				odate.not( this ).datepicker( "option", option, date );
			}
		});
	});

function validateNumber(event) {
	
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
    $('[id^=allotedbudget]').keypress(validateNumber);
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
<h2>Invite New Tender</h2>

<form action="" method="post" enctype="multipart/form-data" >
<table width="95%" cellspacing="10" cellpadding="0" align="center">
<tbody><tr>
	<td width="24%">&nbsp;</td>
	<td width="76%">&nbsp;</td>
</tr>
<tr>
<td><label for="prjrefnum">Project Ref. No.</label></td>
<td><input type="text" id="prjrefnum" name="prjrefnum"> <br> <span class="error_span" id="name_error"></span></td>

</tr>
<tr>
<td><label for="projectname">Project Name</label></td>
<td><input type="text" id="projectname" name="projectname"> <br> <span class="error_span" id="name_error"></span></td>
</tr>
<tr>
<td><label for="location">Project Location</label></td>
<td><input type="text" id="location" name="location"> <br> <span class="error_span" id="name_error"></span></td>
</tr>
<tr>
	<td>Country</td>
	<td>
     <select name="country" id="country" >
	<option value="182">United Arab Emirates</option>
	<?php foreach($countries as $country){ ?>
	<option value="<?php echo $country['countryId'] ?>"><?php echo $country['country'] ?></option>
				 <?php } ?>
	</select></td>
</tr><tr>
<td><label>Location Map</label></td>
<td><input type="file" name="map" class="small" id="map" style="width:222px"><br /><span class="smalltxt">[jpg, png, gif files only]</span></td>
</tr>

<tr>
<td><label for="openingdate">Opening Date</label></td>
<td><input type="text" readonly="readonly" id="openingdate" name="openingdate" > <br> <span class="error_span" id="date_error"></span></td>
</tr>
<tr>
<td><label for="closingdate">Closing Date</label></td>
<td><input type="text" readonly="readonly" id="closingdate" name="closingdate" > <br> <span class="error_span" id="date_error"></span></td>
</tr>
<tr>
<td><label for="description">Description</label></td>
<td>  <textarea cols="25" name="description"></textarea></td>
</tr>
<tr>
<td><label>Upload Files</label></td>
<td><input type="file" name="file" class="small" id="file" style="width:222px"><br /><span class="smalltxt">[pdf, doc, docx, ppt, dwg, jpg, png, gif files only]</span></td>

</tr>
<tr>
<td><label>To</label></td>
<td><select id="publishto" name="publishto">
	<option value="1">All</option>
    <option value="2">Selected</option></select></td>
</tr>
</tbody></table>
<p>
</p><div align="center" style="margin-left: 20px;"><input type="submit" value="Publish Tender" id="publish">


</div>
<p></p>
</form>

    
</td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
