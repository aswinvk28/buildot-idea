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
<td width="86%"><h2>Tender Details</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_gen">
<tr>
  <td style="line-height: 1px;">&nbsp;</td>
</tr>
<tr>
<td width="685">
<div class="comment">


	<div class="comment_box_groups">
    Project: <span class="bluefont"><?php echo $tenderDetails['project_name'] ?></span><br />
    <div>Project Ref. No:  <span class="red"><?php echo $tenderDetails['project_ref_no'] ?></span></div> <br />
     
	<a href="index.php?view=showMember&memberId=<?php echo $tenderDetails['member_id']?>">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
	<?php if(!empty($tenderDetails['company_id'])){ if(!empty($tenderDetails['logo'])) {?>
		<img src="gallery/logos/thumbs/<?php echo $tenderDetails['logo'];?>" width="42" class="thumbs" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="42" height="42" class="thumbs" />
	<?php }}?></td><td style="padding:0px;border:hidden;">
	<?php if (!empty($tenderDetails['member_photo'])) {?>
			<img src="gallery/photos/thumbs/<?php echo $tenderDetails['member_photo'];?>" width="42" class="thumbs" />
	<?php }else {?>
			<img src="gallery/photos/thumbs/default.png" width="42" height="42" class="thumbs" />
	<?php }?></td></tr></table>
    </a>
     <a href="index.php?view=showMember&memberId=<?php echo $tenderDetails['member_id']?>"><?php echo $tenderDetails['first_name'] ?> <?php echo $tenderDetails['last_name'] ?></a>, <a href="index.php?view=showCompany&companyId=<?php echo $tenderDetails['company_id'] ?>"><?php echo $tenderDetails['company_name'] ?></a><br /><br /><br /><br />
    <div>Project Location:<span class="bluefont_lower"> <?php  echo $tenderDetails['project_location'] ?>, <img src="flags/<?php echo strtolower($tenderDetails['country_letter']) ?>.png">  <?php echo $tenderDetails['country'] ?></span>
    <?php if(!empty($tenderDetails['location_map'])){ ?><a href="gallery/maps/<?=$tenderDetails['location_map']?>" target="_blank"><img src="images/icon_map.png" width="24" height="24"/></a><?php } ?>
    </div>
	
	<div>Opening Date: <span class="bluefont"><?php echo $tenderDetails['opening_date'] ?></span></div>
	<div>Closing Date: <span class="bluefont"><?php echo $tenderDetails['closing_date'] ?></span></div>
    <?php if(!empty($tenderDetails['attachment1'])){ ?><a href="gallery/files/<?=$tenderDetails['attachment1']?>" target="_blank">View the attachment:<img src="images/icon_attach.png" width="28px;" /></a><br /><?php } ?>
    Description: <?php echo $tenderDetails['description'] ?><br /><br />

    </div>
    
 

</div>
</td>
</tr>

<tr>
  <td colspan="2">   <?php if($tenderDetails['member_id'] <> $loggedmember){ if($tenderDetails['date_diff'] > 0) { ?>
<div style="margin-top: 30px;" align="center">
<input type="submit"  id="qoute" value="Quote For This" onclick="javascript:window.location.href = 'index.php?view=tenderQuote&projectId=<?php echo $tenderDetails['project_id'] ?>'"/>&nbsp;

 <a href="index.php?view=member_list&from_page=tenderDetails&projectId=<?php echo $tenderDetails['project_id']?>"><span class="button">Share</span></a>
</div>

<?php }else{ ?>
<div style="margin-top: 30px;" align="center"><input type="submit"  id="qoute" value="Tender is closed" disabled="disabled"/></div>
<?php } }?></td>
  
  
</tr>

</table>    
    
    </td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
