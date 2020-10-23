<table cellpadding="0" cellspacing="0" align="center" width="980px">

<tr>
<td width="209" valign="top">
<?php include ("inc_leftbar.tpl.php"); ?>
</td>


<td width="600px" valign="top">
<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">

<tr>
<th>List of Members<span style="float: right; padding-right: 10px">(<?php echo $memberCount ?>) Members</span></th>
</tr>
<tr>
<td>&nbsp;

</td></tr>
<tr>
<form method="post">

<td>
	<input type="hidden" id="projectId" name="projectId" value="<?php echo $projectId?>" />
    
    Enter the email:<input type="text" id="email" name="email"/>
	<input type="submit" value="send invite"/>
</td>
</form>
</tr>

<tr>
<td>

<ul class="company" style="padding-left: 0px;">
<?php if(!empty($members)) { foreach ($members as $member) {  ?>
<li>
<div style="float: left; margin-right: 20px;"><a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php if (!empty($member['member_photo'])) {?>
 <img src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="40" height="40" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.png" width="40" height="40" />
<?php }?>
</a></div>
<span class="co_title"> <a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php echo $member['first_name'] ?> <?php echo $member['last_name'] ?></a></span> <br />
<span class="co_cat">Email:<a href="mailto:<?php echo $member['email'] ?>"><?php echo $member['email'] ?></a></span><br />



<!--checking for tender details-->

<?php if(!empty($projectId)) {
$sql = "SELECT * FROM project_invites 
		WHERE from_member_id = $loggedmember  
		AND to_member_id = ".$member['member_id']." AND project_id ='$projectId'
UNION 
		SELECT * FROM project_invites 
		WHERE `from_member_id` = ".$member['member_id']." AND `project_id` = '$projectId'";
	$project_Invites = $db->fetch($sql);
	$project_count = $db->numrows($sql);
if($project_count == 0) {?>
	<a href="index.php?view=project_invitee_list&projectId=<?php echo $projectId?>&joinrequest=1&to_member_id=<?php echo $member['member_id']?>" ><div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/inviteshare.png"> Invite</span></div></a>
<?php }else { ?>
	<a href="index.php?view=project_invitee_list&projectId=<?php echo $projectId?>&stoprequest=1&project_invite_id=<?php echo $project_Invites['project_invite_id']?>" ><div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/stopshare.png">Block</span></div></a> 
<?php }} ?>

</li>
<?php } }else{?>
No Records Found
<?php } ?>

</ul>
</td>
</tr>
<tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td style="float: right;">&nbsp;
<a href="index.php?view=showProject&projectId=<?php echo $projectId ?>"><div class="btn"> &laquo; go back</span></div></a>
</td>
    </tr>
</table>
</td>


</tr>
</table>