<script>
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
    $('[id^=totBudget]').keypress(validateNumber);
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
    
<table cellpadding="0" cellspacing="0" width="100%" align="center" id="member_home">
<tr>
<td><h2>Quote a Tender</h2></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<th><?php if(!empty($memberDetails['company_id'])) { echo $memberDetails['company_name']?>/<?php }?><?php echo $memberDetails['first_name']?> is quotting for the tender send by <?php if(!empty($projectDetails['company_id'])) { echo $projectDetails['company_name']?>/ <?php }?><?php echo $projectDetails['first_name']?></th>
</tr>
<div>
<tr>
<td>
<form action="" method="post" enctype="multipart/form-data" >
<table cellpadding="0" cellspacing="10" width="95%" align="center">
<input type="hidden" id="projectId" name="projectId" value="<?=$projectDetails['project_id']?>" />
<tr>
  <td width="20%">&nbsp;</td>
  <td width="80%">&nbsp;</td>
</tr>
<tr>
<td><label for="prjrefnum">Project Ref. No.</label></td>
<td><input type="text" name="prjrefnum" id="prjrefnum" disabled="disabled" value="<?php echo $projectDetails['project_ref_no']?>"/> <br /> <span id="name_error" class="error_span"></span></td>
</tr>

<tr>
<td><label for="totBudget" >Total Budget</label></td>
<td><input type="text"  name="totBudget" id="totBudget" maxlength="10" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" /> <br /> <span id="name_error" class="error_span"></span></td>
</tr>
<tr>
<td><label for="sector" >Sector</label></td>
<td><input type="text" name="sector" id="sector" /> <br /> <span id="name_error" class="error_span"></span></td>
</tr>
<tr>
<td><label for="description">Description</label></td>
<td>  <textarea name="description" cols="25" style="margin-top: 7px;" ></textarea></td>
</tr>
<tr>
<td><label>Upload</label></td>
<td><input id="file" type="file" class="small" name="file" style="width:220px" /></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>
    <input type="submit"  id="publish" value="Send Quote"/>
</td>
</tr>
</table>
</form>


    </td>
  </tr>
   </div>
</table>



</td>

</tr>
</table>
</td>
</tr>
</table>
</div>
