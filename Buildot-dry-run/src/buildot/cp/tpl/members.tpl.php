<style>

</style>

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"><h2>Members</h2></td>
	</tr>
<tr>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="200" valign="top">&nbsp;</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="100%" align="center" id="co_middle">
<tr>
<th>List of Members<span style="float: right; padding-right: 10px">(<?php echo $memberCount ?>) Members</span></th>
</tr>
<tr>
<td>
<div align="left" style="background: #f1f1f1; padding: 5px; box-shadow: 1px 1px 1px 1px #e1e1e1;">
<form name="form" action="" method="post" style="text-align:left">
<label for="search_member"><span style="font-size: 13pt; color: #999; padding-right: 10px;">SEARCH MEMBER</span></label>
<input placeholder="Enter the name" type="text" name="search_member" id="search_member" autocomplete="off" style="color: #aaa; font-size: 14pt; width: 30%; background: #f1f1f1; text-align:left; box-shadow: none; padding: 3px;" />
<input type="submit" name="Go" id="Go"  value="Go"/>
</form>
</div>
</td>
</tr>
<tr>
<td>

<ul class="cp_members" style="padding-left: 0px;">
<?php if(!empty($members)) { foreach ($members as $member) {  ?>
<li>
<div style="float: left; margin-right: 20px;"><a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php if (!empty($member['member_photo'])) {?>
 <img src="../gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="40" height="40" />
<?php }else {?>
<img src="../gallery/photos/thumbs/default.png" width="40" height="40" />
<?php }?>
</a></div>
<?php if($member['status'] == 1){ ?>

<a href="index.php?view=members&disabled=1&memberId=<?=$member['member_id']?>">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/disable.png"> Disable</span></div></a> 
<?php }else{ ?>
<a href="index.php?view=members&enabled=1&memberId=<?=$member['member_id']?>">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/enable.png"> Enable</span></div></a> 
<?php } ?>
<a href="index.php?view=members&delete=1&memberId=<?=$member['member_id']?>" onclick="return confirm('Are you sure you want to delete?')">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png">Delete</span></div></a> 
<span class="co_title"> <a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php echo $member['first_name'] ?> <?php echo $member['last_name'] ?></a></span> <br />
<span class="co_cat">Email:<a href="mailto:<?php echo $member['email']?>"><?php echo $member['email'] ?></a></span> | 
<span class="co_cat">Mobile:<?php echo $member['mobile'] ?></span> | 
<span class="co_cat">Location:<?php echo $member['location'] ?></span><?php if(!empty($member['country'])) {?>, <img src="../flags/<?php echo strtolower($member['country_letter']) ?>.png"  />  <?php echo $member['country'] ?>
<?php }else{} ?>
</span><br />
</li>
<?php } }?>

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

<td width="200" valign="top">
<!-- right table start --><!-- right table end -->

</td>
</tr>
</table>