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
<td colspan="3" valign="top"><h2>LIST OF PROJECTS </h2></td>
<td width="14%"><span class="bluefont_lower">(<?php echo $projectInvites_Count ?> projects)</span></td>
</tr>
</table>    
<br />    
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="jobs">
<?php if(!empty($projectInvites)){  foreach ($projectInvites as $projectInvite) {  ?>
<tr>
<td width="199" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($projectInvite['companyId'])){ if(!empty($projectInvite['logo'])) {?>
		<img src="gallery/logos/thumbs/<?php echo $projectInvite['logo'];?>" width="52" class="thumbs" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
	<?php }}?></td><td style="padding-top:0px;border:hidden;">
	<?php if (!empty($projectInvite['member_photo'])) {?>
			<img src="gallery/photos/thumbs/<?php echo $projectInvite['member_photo'];?>" width="52" class="thumbs" />
	<?php }else {?>
			<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
	<?php }?></td></tr></table>
</td>
<td>
<div class="comment">
	<div class="comment_box">
<div style="float:right; border-left: 1px solid #ebebeb; height:50px; padding: 0px 0px 15px 15px;"><img src="flags/<?php echo strtolower($projectInvite['country_letter']) ?>.png" width="24" height="20"></div>


<a href="index.php?view=showProject&companyId=<?php echo $projectInvite['companyId']?>&projectId=<?php echo $projectInvite['project_id'] ?>"><?php echo $projectInvite['project_name'] ?></a> <br />
Type: <?php echo $projectInvite['project_type']?> <br />
Added by: <a href="index.php?view=showMember&memberId=<?php echo $projectInvite['project_owner']?>"><?php echo $projectInvite['first_name'] ?> <?php echo $projectInvite['last_name'] ?>, <a href="index.php?view=showCompany&companyId=<?php echo $projectInvite['companyId'] ?>"><?php echo $projectInvite['company_name'] ?></a> <br />
Location: <span class="bluefont_lower"><?php echo $projectInvite['project_location'] ?>, <?php echo $projectInvite['country'] ?></span> <br />
Created On: <span class="bluefont_lower"><?php echo $projectInvite['project_created']?></span> <br /><br />
<?php  
$sql ="SELECT * from members where member_id = '".$projectInvite['from_member_id']."'";
	$request_from = $db->fetch($sql);
	$sql ="SELECT * from members where member_id = '".$projectInvite['to_member_id']."'";
	$request_to = $db->fetch($sql);
	
	?>
 

 <?php
if($projectInvite['to_member_id'] == $projectInvite['project_owner'] && $projectInvite['project_owner'] == $loggedmember && $projectInvite['status'] == 'request sent'){
	
	?>
    From:  <a href="index.php?view=showMember&memberId=<?php echo $projectInvite['from_member_id']?>"><?php echo $request_from['first_name']?> <?php echo $request_from['last_name']; ?></a>:
    <a href="index.php?view=projectInvites&projectallow=1&companyId=<?php echo $projectInvite['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>" ><span class="btn_highlight">Allow <img src="<?=IMAGEURL?>icons/check.gif"></span></a>
    <a href="index.php?view=projectInvites&projectreject=1&companyId=<?php echo $projectInvite['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>">
<span class="btn_highlight">Reject <img src="<?=IMAGEURL?>icons/close.gif"></span></a>
	<?php }else if ($projectInvite['to_member_id'] == $loggedmember && $projectInvite['status'] == 'request sent') { ?>
 
<a href="index.php?view=projectInvites&projectaccept=1&companyId=<?php echo $projectInvite['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>" ><span class="btn_highlight">Accept<img class="icons" src="<?=IMAGEURL?>icons/check.gif"></span></a> <a href="index.php?view=projectInvites&projectreject=1&companyId=<?php echo $projectInvite['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>"><span class="btn_highlight"> Reject
<img class="icons" src="<?=IMAGEURL?>icons/close.gif"></span></a>
<?php }else if($projectInvite['to_member_id'] <> $projectInvite['project_owner'] && $projectInvite['project_owner'] == $loggedmember && $projectInvite['status'] == 'request sent'){?>
 To:  <a href="index.php?view=showMember&memberId=<?php echo $projectInvite['to_member_id']?>"><?php echo $request_to['first_name']?> <?php echo $request_to['last_name']; ?></a>:
 <?php echo $projectInvite['status']; ?>

<?php }else{
    echo $projectInvite['status'];
	
		}?>  <br />


</div>
    
</div>
</td>
</tr>

<?php }} ?>
</table>    
    </td>
  </tr>
  
  <tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
</table>



</td>

</tr>
</table>

</div>
