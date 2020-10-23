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
<td width="12%"><div class="bluefont_lower">(<?php echo $projectMembers_Count ?> members)</div></td>
</tr>
</table>    
<br />
    
    
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($projectMembers)) { foreach ($projectMembers as $projectMember) {  ?>
<tr>
<td width="151" valign="middle">

<a href="index.php?view=showMember&memberId=<?php echo $projectMember['member_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($projectMember['company_id'])) { if (!empty($projectMember['logo'])) {?>
 <img src="gallery/logos/thumbs/<?php echo $projectMember['logo'];?>" width="52" class="thumbs"/>
<?php }else {?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }}?></td><td style="padding-top:0px;border:hidden;">
<?php if (!empty($projectMember['member_photo'])) {?>
 <img src="gallery/photos/thumbs/<?php echo $projectMember['member_photo'];?>" width="52" class="thumbs" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }?></td></tr></table>
</a>
</td>
<td width="614">
<div class="comment">
	<div>
	
	</div>
	<div class="comment_box_wide">
    <a href="index.php?view=showMember&memberId=<?php echo $projectMember['member_id'] ?>"><?php echo $projectMember['first_name'] ?> <?php echo $projectMember['last_name'] ?></a>
    <br />
<div style="float:right; border-left: 1px solid #ebebeb; height:50px; padding: 0px 0px 15px 15px;">
<img src="flags/<?php echo strtolower($projectMember['country_letter']) ?>.png" /></div>
    Email: <a href="mailto:<?php echo $projectMember['email']?>"><?php echo $projectMember['email'] ?></a><br />
    Mobile: <?php echo $projectMember['mobile'] ?><br />
    Location: <span class="bluefont_lower"><?php echo $projectMember['location'] ?>, <?php echo $projectMember['country'] ?></span><br />
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
