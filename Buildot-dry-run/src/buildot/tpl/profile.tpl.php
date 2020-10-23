<style>

</style>
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
<td width="89%"><h2>PROFILE DETAILS</h2></td>
<td width="11%"><a href="index.php?view=profileEdit&memberId=<?php echo $memberDetails['member_id'] ?>"><div class="editprofile">edit profile</div></a></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="view_profile">

<tr>
<td width="91" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden; ">
<?php if (!empty($memberDetails['member_photo'])) {?>
<img src="gallery/photos/thumbs/<?php echo $memberDetails['member_photo'];?>" width="52"  class="thumbs" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
<?php }?>
</td></tr></table>
</td>
<td width="674">
<div class="comment">

	<div>

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
<td colspan="2" class="bluefont"><?php echo $memberDetails['first_name'] ?> <?php echo $memberDetails['last_name'] ?></td>
</tr>

<tr>
<td width="19%">Email:</td>
<td width="81%"><a href="mailto:<?php echo $memberDetails['email'] ?>"><?php echo $memberDetails['email'] ?></a></td>
</tr>
<?php if(empty($memberDetails['company_id'])) {?>
<tr>
<td width="19%">Gender:</td>
<td width="81%"><?php  echo $memberDetails['gender'] ?></td>
</tr>

<tr>
<td width="19%">Date Of Birth:</td>
<td width="81%"><?php  echo $memberDetails['birth_date'] ?></td>
</tr>

<tr>
<td width="19%">Mobile:</td>
<td width="81%"><?php echo $memberDetails['mobile'] ?></td>
</tr>

<tr>
<td width="19%">Location:</td>
<td width="81%"><?php echo $memberDetails['location'] ?> <img src="flags/<?php echo strtolower($memberDetails['country_letter']) ?>.png"  />  <?php echo $memberDetails['country'] ?></td>
</tr>

<tr>
<td width="19%">CV:</td>
  <td><?php if(!empty($memberDetails['cv'])){ ?><a href="gallery/files/<?=$memberDetails['cv']?>" target="_blank"><img src="images/pdf-ico.jpg" width="27" height="32" /></a><?php } ?></td>
</tr>

<tr>
<td width="19%">Portfolio:</td>
  <td><?php if(!empty($memberDetails['portfolio'])){ ?><a href="gallery/files/<?=$memberDetails['portfolio']?>" target="_blank"><img src="images/pdf-ico.jpg" width="27" height="32" /></a><?php }else{ echo "Not Available";}?></td>
</tr>

<?php } else {?>
<tr>
<td width="19%">Designation:</td>
<td width="81%"><?php echo $memberDetails['designation'] ?></td>
</tr>

<tr>
<td width="19%">Telephone:</td>
<td width="81%"><?php echo $memberDetails['telephone'] ?></td>
</tr>

<tr>
<td width="19%">Fax:</td>
<td width="81%"><?php echo $memberDetails['fax'] ?></td>
</tr>

<tr>
<td width="19%">Address:</td>
<td width="81%"><?php echo $memberDetails['location'] ?>, <img src="flags/<?php echo strtolower($memberDetails['country_letter']) ?>.png"  /> <?php echo $memberDetails['country'] ?></td>
</tr>

<tr>
<td width="19%">Company:</td>
<td width="81%"><?php echo $companyDetails['company_name'] ?></td>
</tr>

<tr>
<td width="19%">Website:</td>
<td width="81%"><a href="http://<?php echo $companyDetails['website']?>"><?php echo $companyDetails['website']?></a></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>
  <table border="0" cellpadding="0" cellspacing="0" style="width:100px;height:60px; float:left;"><tr><td style="padding-top:0px;border:hidden; ">
  <?php if(!empty($memberDetails['company_id'])) { if (!empty($companyDetails['logo'])) {?>
<img src="gallery/logos/thumbs/<?php echo $companyDetails['logo'];?>" width="86"  class="thumbs"/>
<?php }else {?>
<img src="gallery/logos/thumbs/default.jpg" width="86" height="83" class="thumbs" />
<?php }}?>
</td></tr></table>
  </td>
</tr>

<tr>
<td width="19%">Portfolio:</td>
  <td><?php if(!empty($companyDetails['portfolio'])){ ?><a href="gallery/files/<?=$companyDetails['portfolio']?>" target="_blank"><img src="images/pdf-ico.jpg" width="27" height="32" /></a><?php }else{ echo "Not Available"; } ?></td>
</tr>
<?php } ?>

</table>
    </div>
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

</div>
