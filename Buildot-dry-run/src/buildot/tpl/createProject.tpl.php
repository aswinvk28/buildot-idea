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
<td width="90%"><h2>Create a Project</h2></td>
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
<label for="projectname">Project Name</label>
</td>
<td width="81%">
<input type="text" id="projectname" name="projectname">
<br>
<span class="error_span" id="name_error"></span></td>
</tr>
<tr>
<td>
<label for="projecttype">Project Type</label>
</td>
<td>
<input type="text" id="projecttype" name="projecttype">
<br>
<span class="error_span" id="type_error"></span></td>
</tr>
<tr>
<td>
<label for="projectlocation">Project Location</label>
</td>
<td>
<input type="text" id="projectlocation" name="projectlocation">
<br>
<span class="error_span" id="location_error"></span></td>
</tr>
<tr>
<td>
<label for="country">Country</label>
</td>
<td>
<select name="country" id="country" >
    <option value="182">United Arab Emirates</option>
		<?php foreach($countries as $country){ ?>
		<option value="<?php echo $country['countryId'] ?>"><?php echo $country['country'] ?></option>
				 <?php } ?>
		</select>
<br>
<span class="error_span" id="country_error"></span> </td>
</tr>
<tr>
<td>
<label for="projectowner">Project Owner</label>
</td>
<td>
<input type="text"  id="projectowner" name="projectowner" value="<?=$member_email?>" />
<br>
<span class="error_span" id="date_error"></span></td>
</tr>
<tr>
<td>
<label>Project Description</label>
</td>
<td>
<textarea name="description" cols="25"></textarea>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<input type="submit" value="Create Project" name="createproject" id="create">
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
