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
<td width="88%"><h2>LIST OF MEMBERS</h2></td>
<td width="12%"><div class="bluefont_lower">(<?php echo $groupMembers_Count ?> members)</div></td>
</tr>
</table>    
<br />
<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_home">
<?php if(!empty($groupMembers)) { foreach ($groupMembers as $groupMember) {  ?>
<tr>
<td width="199" valign="middle">
<a href="index.php?view=showMember&memberId=<?php echo $groupMember['member_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($groupMember['company_id'])) { if (!empty($groupMember['logo'])) {?>
 <img src="gallery/logos/thumbs/<?php echo $groupMember['logo'];?>" width="52"  class="thumbs" />
<?php }else {?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }}?></td><td style="padding-top:0px;border:hidden;">
<?php if (!empty($groupMember['member_photo'])) {?>
 <img src="gallery/photos/thumbs/<?php echo $groupMember['member_photo'];?>" width="52" class="thumbs" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }?>
</td></tr></table>
</a>
</td>
<td>
<div class="comment" style="padding:10px 10px 10px 4px;">
	<div>
	
	</div>
	<div class="comment_box">
    <a href="index.php?view=showMember&memberId=<?php echo $groupMember['member_id'] ?>"><?php echo $groupMember['first_name'] ?> <?php echo $groupMember['last_name'] ?></a><br />
<div style="float:right; border-left: 1px solid #ebebeb; height:50px; padding: 0px 0px 15px 15px;">
<img src="flags/<?php echo strtolower($groupMember['country_letter']) ?>.png" width="24" height="20" /></div>
    Email: <a href="mailto:<?php echo $groupMember['email']?>"><?php echo $groupMember['email'] ?></a><br />
    Mobile:  <?php echo $groupMember['mobile'] ?><br />
    Location: <span class="bluefont_lower"><?php echo $groupMember['location'] ?>, <?php echo $groupMember['country'] ?></span><br />
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
