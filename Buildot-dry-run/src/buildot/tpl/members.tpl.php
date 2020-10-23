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
<td width="82%"><h2>LIST OF MEMBERS</h2></td>
<td width="18%"><div class="bluefont_lower">(<?php echo $memberCount ?> members)</div></td>
</tr>
</table>

<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($members)) { foreach ($members as $member) {  ?>
<tr>
<td width="200" valign="middle">

<a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($member['company_id'])) { if (!empty($member['logo'])) {?>
 <img src="gallery/logos/thumbs/<?php echo $member['logo'];?>" width="52" class="thumbs" />
<?php }else {?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }}?></td><td style="padding-top:0px;border:hidden;">
<?php if (!empty($member['member_photo'])) {?>
 <img src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="52" class="thumbs" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }?>
</td></tr></table>
</a>
</td>
<td>
<div class="comment">
	
	<div class="comment_box_members_page">
    <a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php echo $member['first_name'] ?> <?php echo $member['last_name'] ?></a><br />
<div style="float:right; border-left: 1px solid #ebebeb; height:50px; padding: 0px 0px 0px 15px;">
<?php if(!empty($member['location'])) { ?>
<img src="flags/<?php echo strtolower($member['country_letter']) ?>.png" />
<?php }?>
</div>
    Email: <a href="mailto:<?php echo $member['email']?>"><?php echo $member['email'] ?></a><br />
    Mobile: <?php echo $member['mobile'] ?><br />
    Location: <span class="bluefont_lower"><?php echo $member['location'] ?>, <?php echo $member['country'] ?></span><br />
   
    <?php if ($member['to_member_id'] == $memberId && $member['status'] == 'request sent') { ?>
<a href="index.php?view=members&friendaccept=1&friend_request_id=<?php echo $member['friend_request_id']?>" ><span class="btn_highlight" > Accept<img src="<?=IMAGEURL?>icons/check.gif"></span></a> 
<a href="index.php?view=members&friendreject=1&friend_request_id=<?php echo $member['friend_request_id']?>"><span class="btn_highlight">Reject<img src="<?=IMAGEURL?>icons/close.gif"></span></a>
<?php }else if($member['status'] == 'request sent') { echo $member['status']; } ?>
</div>
 </div>
</div>
</td>
</tr>
<?php } }?>

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
