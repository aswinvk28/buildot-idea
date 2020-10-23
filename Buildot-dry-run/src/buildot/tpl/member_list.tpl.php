<script type="text/javascript">
$().ready(function() {
	$("#search_mem").autocomplete("index.php?view=membersearch&ajax=1", {
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
<td width="84%"><h2>LIST OF MEMBERS</h2></td>
<td width="16%"><span class="bluefont_lower">(<?php echo $memberCount ?> members)</span></a></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($members)) { foreach ($members as $member) {  ?>
<tr>
<td width="80" valign="top">
<a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:70px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if (!empty($member['member_photo'])) {?>
 <img src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="52" height="52" class="thumbs" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }?>
</td></tr></table>
</a>
</td>
<td width="685">
<div class="comment">

	<div class="comment_box_groups">
    <a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php echo $member['first_name'] ?> <?php echo $member['last_name'] ?></a><br />
    Email: <a href="mailto:<?php echo $member['email'] ?>"><?php echo $member['email'] ?></a><br /><br />
    
<!--checking for tender received details-->
    
 <?php if(!empty($tenderId)) {
 $sql = "SELECT * FROM share_invites 
		WHERE from_member_id = $loggedmember  
		AND to_member_id = ".$member['member_id']." AND page='tenderReceivedDetails' AND id ='$tenderId' ";
	$tender_shareInvites = $db->fetch($sql);
	$tender_count = $db->numrows($sql);
if($tender_count == 0) {?>    
    <div style="width: 110px;" class="btn_share">
<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&tenderId=<?php echo $tenderId?>&joinrequest=1&member_id=<?php echo $member['member_id']?>" >Invite to Share <img src="images/links-arrow.png"></a></div>
<?php }else { ?>
 <div style="width: 110px;" class="btn_share">
<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&tenderId=<?php echo $tenderId?>&stoprequest=1&share_id=<?php echo $tender_shareInvites['share_id']?>" >Stop Share <img src="images/links-arrow.png"></a>
</div>
<?php }} ?>

<!--checking for tender details-->

<?php if(!empty($projectId)) {
$sql = "SELECT * FROM share_invites 
		WHERE from_member_id = $loggedmember  
		AND to_member_id = ".$member['member_id']." AND page='tenderDetails' AND id ='$projectId' ";
	$project_shareInvites = $db->fetch($sql);
	$project_count = $db->numrows($sql);
if($project_count == 0) {?>
<div style="width: 110px;" class="btn_share">
	<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&projectId=<?php echo $projectId?>&joinrequest=1&member_id=<?php echo $member['member_id']?>" >Invite to share <img src="images/links-arrow.png"></a></div>
<?php }else { ?>
<div style="width: 110px;" class="btn_share">
	<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&projectId=<?php echo $projectId?>&stoprequest=1&share_id=<?php echo $project_shareInvites['share_id']?>" >Stop share <img src="images/links-arrow.png"></a></div> 
<?php }} ?>


<!--For inviting tenders from selected members-->

<?php if(!empty($project)) {
	 $sql = "SELECT * FROM share_invites 
		WHERE from_member_id = $loggedmember  
		AND to_member_id = ".$member['member_id']." AND page='inviteTenders' AND id ='$project' ";
	$inviteproject_shareInvites = $db->fetch($sql);
	$inviteproject_count = $db->numrows($sql);
if($inviteproject_count == 0) {?>
<div style="width: 110px;" class="btn_share">
	<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&project=<?php echo $project?>&joinrequest=1&member_id=<?php echo $member['member_id']?>" >Publish Tender <img src="images/links-arrow.png"></a></div>
<?php }else { ?>
	<span class="bluefont_lower">Already published</span>
<?php }} ?>


<!--checking for company-->
<?php 
if(!empty($companyId)) {
$sql = "SELECT * FROM share_invites 
		WHERE from_member_id = $loggedmember  
		AND to_member_id = ".$member['member_id']." AND page='showCompany' AND id ='$companyId' ";
	$company_shareInvites = $db->fetch($sql);
	$company_count = $db->numrows($sql);
if($company_count == 0){?>
<div style="width: 53px;" class="btn_share">
	<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&companyId=<?php echo $companyId?>&joinrequest=1&member_id=<?php echo $member['member_id']?>" >Share <img src="images/links-arrow.png"></a></div> 
<?php 	}else { ?>
		<span class="bluefont_lower">Shared</span>
<?php }} ?>


<!--checking for members-->
<?php
if(!empty($sharememberId)){
 $sql = "SELECT * FROM share_invites 
		WHERE from_member_id = $loggedmember  
		AND to_member_id = ".$member['member_id']." AND page='showMember' AND id ='$sharememberId' ";
	$member_shareInvites = $db->fetch($sql);
	$member_count = $db->numrows($sql);
if($member_count == 0){?>
<div style="width: 53px;" class="btn_share">
<a href="index.php?view=member_list&from_page=<?php echo $fromPage?>&memberId=<?php echo $sharememberId?>&joinrequest=1&member_id=<?php echo $member['member_id']?>" >Share <img src="images/links-arrow.png"></a></div>
<?php 	}else { ?>
		<span class="bluefont_lower">Shared</span>
<?php }} ?>


    </div>

</div>
</td>
</tr>

<?php } }else{?>
No Records Found
<?php } ?>

</table>    
    
    </td>
  </tr>
  
  <tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td style="float: right;">&nbsp;<?php if($fromPage == 'tenderReceivedDetails') {?>
<a href="index.php?view=tenderReceivedDetails&tenderId=<?php echo $tenderId ?>"><div class="btn"> &laquo; go back</span></div></a>
<?php }else if($fromPage == 'tenderDetails') {?>
<a href="index.php?view=tenderDetails&project_id=<?php echo $projectId ?>"><div class="btn"> &laquo; go back</span></div></a>
<?php }else if($fromPage == 'showCompany') {?>
<a href="index.php?view=showCompany&companyId=<?php echo $companyId ?>"><div class="btn"> &laquo; go back</span></div></a>
<?php }else if($fromPage == 'showMember') { ?>
<a href="index.php?view=showMember&memberId=<?php echo $sharememberId ?>"><div class="btn"> &laquo; go back</span></div></a>
<?php }else if($fromPage == 'inviteTenders') { ?>
<a href="index.php?view=inviteTenders"><div class="btn"> &laquo; go back</span></div></a>
<?php }?></td>
    </tr>
</table>



</td>

</tr>
</table>

</div>
