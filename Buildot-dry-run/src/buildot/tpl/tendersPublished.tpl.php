<script type="text/javascript">
$().ready(function() {
	$("#location").autocomplete("index.php?view=locationsearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
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
<td width="88%"><h2>TENDERS PUBLISHED</h2></td>
<td width="12%"><span class="bluefont_lower">(<?php echo $tenderCount ?> tenders)</span></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">

<tr>
  <td colspan="2" valign="top">

<div align="right">
	<form style="text-align:center" method="post" action="" name="form">
		Country 
		<select name="country" id="country" onChange="javascript:this.form.submit();" style="width: 200px;">
			<option value="">Select Country</option>
			<?php foreach($countries as $country){ ?>
			<option value="<?php echo $country['countryId'] ?>" <?=($country['countryId'] == $countryId)?' Selected':''?>><?php echo $country['country'] ?></option>
			<?php } ?>
		</select>
&nbsp; &nbsp; &nbsp; Location   		
		 <input type="text" onblur="this.form.submit();" title="enter the location" name="location" id="location" autocomplete="off" class="ac_input">
	</form>
</div>  
<br />    
  </td>
</tr>
<?php if(!empty($tenders)) { foreach ($tenders as $tender) {
	$sql ="SELECT * from read_projects WHERE member_id = '$memberId' AND project_id = ".$tender['project_id'];
	$count = $db->numrows($sql);?>

<tr><td colspan="2" style="line-height: 10px;">&nbsp;</td></tr>

<tr style="background-color: #f3f3f3;">	
<td width="157" valign="top" <?=($count == 0)?' class="unread1"':''?>>
<a href="index.php?view=showMember&memberId=<?php echo $tender['member_id']?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($tender['company_id'])) { if(!empty($tender['logo'])){?>
<img src="gallery/logos/thumbs/<?php echo $tender['logo'];?>" width="52"  class="thumbs" />
<?php } else { ?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }} ?></td><td style="padding-top:0px;border:hidden;">
<?php if(!empty($tender['member_photo'])){?>
<img src="gallery/photos/thumbs/<?php echo $tender['member_photo'];?>" width="52" class="thumbs" />
<?php } else { ?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php } ?></td></tr></table>
</a>
</td>
<td width="608" <?=($count == 0)?' class="unread2"':' class="co_cat"'?>>
<div>
	<div>
       
<table cellpadding="0" cellspacing="0" width="100%" align="center">

<tr>
<td width="187">
<a href="index.php?view=tenderDetails&project_id=<?php echo $tender['project_id'] ?>&published=1"><?php echo $tender['project_name'] ?></a><br />
<?php if(!empty($tender['company_id'])) { ?>
 <a href="index.php?view=showCompany&companyId=<?php echo $tender['company_id']?>"> <?php echo $tender['company_name'] ?></a>
<?php }else{ ?>
	<a href="index.php?view=showMember&memberId=<?php echo $tender['member_id']?>"><?php echo $tender['first_name']; echo $tender['last_name']?></a>
	<?php }?>
</td>
<td width="285" style="border-left:1px solid #ebebeb;padding-left:10px;">
Opening date:<span class="bluefont"><?php echo $tender['opening_date'] ?></span><br />
Closing date:<span class="bluefont"><?php echo $tender['closing_date'] ?></span><br />
Location:<span class="bluefont_lower"><?php echo $tender['project_location'] ?>,  <?php echo $tender['country'] ?></span><br />
</td>
<td width="52">
<div style="float:right; border-left: 1px solid #ebebeb; height:50px; padding: 10px 10px 0px 15px;">
<img src="flags/<?php echo strtolower($tender['country_letter']) ?>.png" />
</div>
</td>
</tr>
<tr><td style="line-height: 1px;">&nbsp;</td></tr>
</table>



</div>

</div>
</td>
</tr>

<?php }}else{ echo "No Record Found";} ?>

</table>    
    
    </td>
  </tr>
  
  <tr>
      <td colspan="2" align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>



</td>

</tr>
</table>

</div>
