<script type="text/javascript">
$().ready(function() {
	$("#search_company").autocomplete("index.php?view=companysearch&ajax=1", {
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
<td width="86%"><h2>JOB DETAILS</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_gen">
<tr><td>&nbsp;</td></tr>
<tr>
<td width="80" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($jobDetails['company_id'])) { if(!empty($jobDetails['logo'])){?>
	<img src="gallery/logos/thumbs/<?php echo $jobDetails['logo'];?>" width="52" class="thumbs" />
<?php } else { ?>
	<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }}else { ?></td><td style="padding:0px;border:hidden;">
<?php if(!empty($jobDetails['member_photo'])){?>
	<img src="gallery/photos/thumbs/<?php echo $jobDetails['member_photo'];?>" width="52" class="thumbs" />
<?php } else { ?>
	<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }} ?>
</td></tr></table>
</td>
<td width="685">
<div class="comment">


<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr><td colspan="2"><span class="bluefont"><?php echo $jobDetails['title']?></span></td></tr>
<tr><td colspan="2">
<?php if(!empty($jobDetails['company_id'])) { ?>
<a href="index.php?view=showCompany&companyId=<?php echo $jobDetails['company_id']?>"><?php echo $jobDetails['company_name']?></a>
<?php }else {?>
<a href="index.php?view=showMember&memberId=<?php echo $jobDetails['created_by']?>"><?php echo $jobDetails['first_name']?> <?php echo $jobDetails['last_name']?></a>
<?php } ?>
</td></tr>
<tr><td width="13%">Location:</td><td width="87%"><span class="bluefont_lower"><?php echo $jobDetails['location']?>, <img src="flags/<?php echo strtolower($jobDetails['country_letter']) ?>.png"  /> <?php echo $jobDetails['country'] ?></span></td></tr>
<tr><td width="13%">Contact No:</td><td width="87%"><?php echo $jobDetails['contact_number']?></td></tr>
<tr><td width="13%">Email:</td><td width="87%"><a href="mailto:<?php echo $jobDetails['email']?>"><?php echo $jobDetails['email']?></a></td></tr>
<tr><td width="13%">Created:</td><td width="87%"><span class="bluefont_lower"><?php echo $jobDetails['job_created']?></span></td></tr>
<tr><td width="13%">Expiry Date:</td><td width="87%"><span class="bluefont_lower"><?php echo $jobDetails['expiryDate']?></span></td></tr>
<tr><td width="13%">Description:</td><td width="87%"><?php echo $jobDetails['description']?>.</td></tr>
</table>
<?php if(empty($myCompanyId)) { if($jobDetails['date_diff'] > 0) {?>
						<div style="margin-left: 20px;" align="center">
							<input type="submit" id="apply" value="Interested" onclick="javascript:window.location.href = 'index.php?view=jobDetails&apply=1&jobId=<?php echo $JobId?>'"/>
						</div>
						<?php }else{?>
						<div style="margin-top: 30px; margin-left: 20px;" align="center">
							<input type="submit" id="apply" value="Job Opening Closed" disabled="disabled"/>
						</div>
						<?php }} ?>
</div>
</td>
</tr>



</table>
</td>


</tr>

</table>    
    
    </td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
