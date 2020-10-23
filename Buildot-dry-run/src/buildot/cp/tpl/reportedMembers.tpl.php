<style>

</style>

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"><h2>Reported Members</h2></td>
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
<th>List of Reported Members<span style="float: right; padding-right: 10px">(<?php echo $reportCount ?>) Updates</span></th>
</tr>

<tr>
<td>

<ul class="cp_members" style="padding-left: 0px;">
<?php if(!empty($abuseReports)) { foreach ($abuseReports as $abuseReport) {  ?>
<li>
<div style="float: left; margin-right: 20px;"><a href="index.php?view=showMember&memberId=<?php echo $abuseReport['id'] ?>">
<?php if(!empty($abuseReport['company_id'])) { if (!empty($abuseReport['logo'])) {?>
 <img src="../gallery/logos/thumbs/<?php echo $abuseReport['logo'];?>" width="40" height="40" />
<?php }else {?>
<img src="../gallery/logos/thumbs/default.png" width="40" height="40" />
<?php }}?>
<?php if (!empty($abuseReport['member_photo'])) {?>
 <img src="../gallery/photos/thumbs/<?php echo $abuseReport['member_photo'];?>" width="40" height="40" />
<?php }else {?>
<img src="../gallery/photos/thumbs/default.png" width="40" height="40" />
<?php }?>
</a></div>
<a href="index.php?view=reportedMembers&deletemember=1&reportId=<?=$abuseReport['report_id'] ?>&memberId=<?=$abuseReport['id']?>" onclick="return confirm('Are you sure you want to delete?')">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png">Delete Member</span></div></a> 

<a href="index.php?view=reportedMembers&deletereport=1&reportId=<?=$abuseReport['report_id']?>" onclick="return confirm('Are you sure you want to delete?')">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png">Delete Report</span></div></a> 
<span class="co_title"></span><br />
<span class="co_title"> <a href="index.php?view=showMember&memberId=<?php echo $abuseReport['id'] ?>"><?php echo $abuseReport['first_name'] ?> <?php echo $abuseReport['last_name'] ?></a></span> 		
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