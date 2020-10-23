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
<td width="84%"><h2>List of groups <span class="bluefont">(<?php echo $groupCount ?>)</span></h2></td>
<td width="16%"><a href="index.php?view=createGroup"><div class="createnew">+ Create Group</div></a></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($groups)) { foreach ($groups as $group) {  ?>
<tr>
<td width="81" valign="middle">
<a href="index.php?view=showGroup&groupId=<?php echo $group['group_id'] ?>">
	<table border="0" cellpadding="0" cellspacing="0" style="width:60px; height:80px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
	<?php if (!empty($group['group_image'])) {?>
		<img src="gallery/logos/thumbs/<?php echo $group['group_image'];?>" width="52" class="thumbs" />
	<?php }else {?>
		<img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs"/>
	<?php }?>
    </td></tr></table>
</a>
</td>
<td width="684">
<div class="comment">
<?php if($loggedmember == $group['group_owner']) {?>
	<ul id="hide-report">
		<li><a href="index.php?view=groups&delete=1&groupId=<?=$group['group_id']?>"><img src="images/close.gif"></a>
					
			<div class="clear"></div>
		</li>
	</ul>
<?php }?>    
	<div class="comment_box_groups_page">

    <a href="index.php?view=showGroup&groupId=<?php echo $group['group_id'] ?>"><?php echo $group['group_name'] ?> </a><br />
    Members <span class="bluefont"><a href="index.php?view=group_members&groupId=<?php echo $group['group_id'] ?>">(<?php echo $group['memberCount']?>)</a></span> / <span class="bluefont_lower"><?php echo $group['privacy']?></span><br />
    </div>
    
</div>
</td>
</tr>
<?php }} ?>


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

</div>
