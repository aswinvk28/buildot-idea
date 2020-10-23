<table cellpadding="0" cellspacing="0" width="100%" align="center">
<td width="209" valign="top">
<?php include ("inc_leftbar.tpl.php"); ?>
</td>
	<td colspan="3" valign="top"><h2>Projects</h2></td>
	</tr>
<tr>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="200" valign="top">
<!-- left table start -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="200px" valign="top">
		

<!-- left table end -->
</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">
<tr>
<th>List of Projects<span style="float: right; padding-right: 10px">(<?php echo $companyProjects_Count ?>) Projects</span></th>
</tr><tr>
<td>

<ul class="company" style="padding-left: 0px;">
<?php if(!empty($companyProjects)){  foreach ($companyProjects as $companyProject) {  ?>
<li>

<?php if($loggedmember == $companyProject['project_owner']) {?>
<a href="index.php?view=company_projects&delete=1&projectId=<?=$companyProject['project_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/delete.png"> Delete</span></div></a>
<?php }?>

<span class="co_title"> <a href="index.php?view=showProject&companyId=<?php echo $companyProject['companyId']?>&projectId=<?php echo $companyProject['project_id'] ?>"><?php echo $companyProject['project_name'] ?> </a></span><br />
<span class="co_cat"><span class="caption">Type:</span><?php echo $companyProject['project_type']?></span><br />
<span class="co_cat"><span class="caption">Added By:</span>
	
	<?php if(!empty($companyProject['companyId'])){ if(!empty($companyProject['logo'])) {?>
		<img src="gallery/logos/thumbs/<?php echo $companyProject['logo'];?>" width="40" height="40" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="40" height="40" />
	<?php }}?>
	<?php if (!empty($companyProject['member_photo'])) {?>
			<img src="gallery/photos/thumbs/<?php echo $companyProject['member_photo'];?>" width="40" height="40" />
	<?php }else {?>
			<img src="gallery/photos/thumbs/default.png" width="40" height="40" />
	<?php }?>

<a href="index.php?view=showMember&memberId=<?php echo $companyProject['project_owner']?>"><?php echo $companyProject['first_name'] ?> <?php echo $companyProject['last_name'] ?></a>::<a href="index.php?view=showCompany&companyId=<?php echo $companyProject['companyId'] ?>"><?php echo $companyProject['company_name'] ?></a></span><br /><br />
<span class="co_cat"><span class="caption">Location:</span><?php echo $companyProject['project_location'] ?></span>, <img src="flags/<?php echo strtolower($companyProject['country_letter']) ?>.png"  />  <?php echo $companyProject['country'] ?></span><br />
<span class="caption">Created On:</span><?php echo $companyProject['project_created']?><br />
<?php   $sql ="SELECT pp.*,cp.`project_owner`,mem.`first_name`,mem.`last_name` FROM project_invites AS pp
				LEFT JOIN company_projects AS cp ON (cp.`project_id` = pp.`project_id`)
				LEFT JOIN members AS mem ON (mem.`member_id` = pp.`from_member_id`)
				 WHERE pp.project_id =".$companyProject['project_id'];
$projectInvites = $db->select($sql);
if(!empty($projectInvites)){ foreach($projectInvites as $projectInvite){

if($projectInvite['to_member_id'] == $projectInvite['project_owner'] && $projectInvite['project_owner'] == $loggedmember && $projectInvite['status'] == 'request sent'){?>
<?php echo $projectInvite['first_name']?> <?php echo $projectInvite['last_name']; ?>:
    <a href="index.php?view=company_projects&projectallow=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>" ><div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/accept.png"> Allow</span></div></a>
    <a href="index.php?view=company_projects&projectreject=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>">
<div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/reject.png"> Reject</span></div></a>
	<?php }else if ($projectInvite['to_member_id'] == $loggedmember && $projectInvite['status'] == 'request sent') { ?>
    <?php echo $projectInvite['first_name']?> <?php echo $projectInvite['last_name']; ?>:
<a href="index.php?view=company_projects&projectaccept=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>" ><div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/accept.png"> Accept</span></div></a> <a href="index.php?view=company_projects&projectreject=1&companyId=<?php echo $companyProject['companyId']?>&project_invite_id=<?php echo $projectInvite['project_invite_id']?>">
<div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/reject.png"> Reject</span></div></a>
<?php } }} ?>
</li>
<?php }} ?>

</ul>

</td>
</tr>
<tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
</table>
<!-- middle table end -->
</td>


</tr>
</table>