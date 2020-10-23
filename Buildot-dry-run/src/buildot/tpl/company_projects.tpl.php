<script type="text/javascript">
$().ready(function() {
	$("#search_prj").autocomplete("index.php?view=projectsearch&ajax=1", {
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
	<td colspan="3" valign="top"><h2>Projects</h2></td>
	<td width="14%"><span class="bluefont_lower">(<?php echo $companyProjects_Count ?> Projects)</span></td>    
</tr>
</table>
<br />



<table cellpadding="0" cellspacing="0" width="100%" align="left">
<tr>
<td>

<?php if(!empty($companyProjects)){  foreach ($companyProjects as $companyProject) {  ?>

<div class="comment comment_box_groups" style="margin-bottom: 10px;">

    
<?php if($loggedmember == $companyProject['project_owner']) {?>
<a href="index.php?view=company_projects&delete=1&projectId=<?=$companyProject['project_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/close.gif"></span></a>
<?php }?>

 <a href="index.php?view=showProject&companyId=<?php echo $companyProject['companyId']?>&projectId=<?php echo $companyProject['project_id'] ?>"><?php echo $companyProject['project_name'] ?> </a><br />
Type: <?php echo $companyProject['project_type']?><br />
	<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
	<?php if(!empty($companyProject['companyId'])){ if(!empty($companyProject['logo'])) {?>
		<img src="gallery/logos/thumbs/<?php echo $companyProject['logo'];?>" width="52" class="thumbs" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
	<?php }}?></td><td style="padding-top:0px;border:hidden;">
	<?php if (!empty($companyProject['member_photo'])) {?>
			<img src="gallery/photos/thumbs/<?php echo $companyProject['member_photo'];?>" width="52" class="thumbs" />
	<?php }else {?>
			<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
	<?php }?>
</td></tr></table>
<a href="index.php?view=showMember&memberId=<?php echo $companyProject['project_owner']?>"><?php echo $companyProject['first_name'] ?> <?php echo $companyProject['last_name'] ?></a> :: <a href="index.php?view=showCompany&companyId=<?php echo $companyProject['companyId'] ?>"><?php echo $companyProject['company_name'] ?></a>
<div class="loc">
Location:<span class="bluefont_lower"><?php echo $companyProject['project_location'] ?>, <img src="flags/<?php echo strtolower($companyProject['country_letter']) ?>.png"  />  <?php echo $companyProject['country'] ?></span><br />
Created On: <span class="bluefont_lower"><?php echo $companyProject['project_created']?></span>

<br class="clear" />
<div class="loc"></div>

<?php   $sql ="SELECT pp.*,cp.`project_owner`,mem.`first_name`,mem.`last_name` FROM project_invites AS pp
				LEFT JOIN company_projects AS cp ON (cp.`project_id` = pp.`project_id`)
				LEFT JOIN members AS mem ON (mem.`member_id` = pp.`from_member_id`)
				 WHERE pp.project_id =".$companyProject['project_id'];
$projectInvites = $db->select($sql);
if(!empty($projectInvites)){ foreach($projectInvites as $projectInvite){

if($projectInvite['to_member_id'] == $projectInvite['project_owner'] && $projectInvite['project_owner'] == $loggedmember && $projectInvite['status'] == 'request sent'){?>

From: <a href="index.php?view=showMember&memberId=<?php echo $projectInvite['from_member_id']?>"><?php echo $projectInvite['first_name']?> <?php echo $projectInvite['last_name']; ?></a>:
    <a href="index.php?view=company_projects&projectallow=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>" ><span class="btn_highlight">Allow <img src="<?=IMAGEURL?>icons/check.gif"></span></a>
    <a href="index.php?view=company_projects&projectreject=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>"><span class="btn_highlight">Reject <img src="<?=IMAGEURL?>icons/close.gif"></span></a>
    
	<?php }else if ($projectInvite['to_member_id'] == $loggedmember && $projectInvite['status'] == 'request sent') { ?>
    
    <?php echo $projectInvite['first_name']?> <?php echo $projectInvite['last_name']; ?>:
<a href="index.php?view=company_projects&projectaccept=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>" ><span class="btn_highlight">Accept<img src="<?=IMAGEURL?>icons/check.gif"> </span></a> <a href="index.php?view=company_projects&projectreject=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>">

<span class="btn_highlight">Reject<img src="<?=IMAGEURL?>icons/close.gif"></span></a>

<?php } }} ?>
</div>
<br class="clear" />
</div>
<?php }} ?>

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
  <tr>
					<td align="center">
						<?=$paginate?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
</table>


    
    </td>
  </tr>
</table>



</td>

</tr>
</table>


</div>