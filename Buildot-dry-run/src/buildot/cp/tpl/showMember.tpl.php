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
<td width="200" valign="top">
<!-- left table start -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="center" id="co_left_recent">
				<tr>
					<th>Recent Added Members</th>
				</tr>
				<tr>
					<td>
						<div class="co_all">
							<ul>
								<?php if(!empty($recentMembers)) { foreach ($recentMembers as $recentMember) {  ?>
<li<?=($member_id == $recentMember['member_id'])?' class="current"':''?>>
      <div> <a href="index.php?view=showMember&memberId=<?php echo $recentMember['member_id'] ?>"><?php echo $recentMember['first_name'] ?> <?php echo $recentMember['last_name'] ?></a> </div>
    </li>
 <?php } } ?>
							</ul>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		
	</tr>
</table>

<!-- left table end -->
</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">
<tr>
<th>Member Details</th>
</tr><tr>
<td>


<div style="float: left; margin-right: 20px;"><?php if (!empty($memberDetails['member_photo'])) {?>
<img src="../gallery/photos/thumbs/<?php echo $memberDetails['member_photo'];?>" width="80"  />
<?php }else {?>
<img src="../gallery/photos/thumbs/default.png" width="80" height="60" />
<?php }?>
</div>
<span class="co_title"><?php echo $memberDetails['first_name'] ?> <?php echo $memberDetails['last_name'] ?></span><br />
<span class="co_cat">Email:<a href="mailto:<?php echo $memberDetails['email']?>"><?php echo $memberDetails['email'] ?></a></span><br />
<?php if(empty($memberDetails['company_id'])) {?>
<span class="co_cat"><?php  echo $memberDetails['gender'] ?></span><br />
<span class="co_cat">Date Of Birth:<?php  echo $memberDetails['birth_date'] ?></span><br />
<span class="co_cat">Mobile:<?php echo $memberDetails['mobile'] ?></span><br />
<span class="colocation">Location:<?php echo $memberDetails['location'] ?>
<?php if(!empty($memberDetails['country'])) { ?>,
 <img src="flags/<?php echo strtolower($memberDetails['country_letter']) ?>.png"  />  <?php echo $memberDetails['country'] ?>
 <?php }else{} ?>
 </span><br />
<?php } else {?>
<span class="co_cat">Designation:<?php echo $memberDetails['designation'] ?></span><br />
<span class="co_cat">Company:<?php echo $companyDetails['company_name'] ?></span><br />
<span class="co_cat">Mobile:<?php echo $memberDetails['mobile'] ?></span><br />
<span class="co_cat">Telephone:<?php echo $memberDetails['telephone'] ?></span><br />
<span class="colocation">Location:<?php echo $memberDetails['location'] ?>
<?php if(!empty($memberDetails['country'])) { ?>, <img src="flags/<?php echo strtolower($memberDetails['country_letter']) ?>.png"  />  <?php echo $memberDetails['country']; ?>
<?php }else{} ?></span><br />
<?php if (!empty($companyDetails['logo'])){?>
<img src="../gallery/logos/thumbs/<?php echo $companyDetails['logo'];?>" width="80"  />
<?php }else { ?>
<img src="../gallery/logos/thumbs/default.png" width="80" height="60" />
<?php }?>
<?php } ?>


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
<!-- right table start -->

<!-- right table end -->

</td>
</tr>
</table>