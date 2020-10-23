<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="200" valign="top">
<!-- left table start -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" id="badge" align="left">
							<tr>
								<td colspan="2" align="center">&nbsp;</td>
							</tr>
							<tr>
								<td align="center">
									<?php if(!empty($memberDetails['company_id'])) {if(!empty($memberDetails['logo'])) { ?>
									<img src="gallery/logos/thumbs/<?php echo $memberDetails['logo'] ?>" align="middle"/>
									<?php } else { ?>
									<img src="gallery/logos/thumbs/default.png" align="middle"/>
									<?php }} ?>
								</td>
								<td align="center">
									<?php if(!empty($memberDetails['member_photo'])) { ?>
									<img src="gallery/photos/thumbs/<?php echo $memberDetails['member_photo'] ?>" />
									<?php }else { ?>
									<img src="gallery/photos/thumbs/default.png" />
									<?php } ?>
								</td>
							</tr>
							<tr>
								<td rowspan="2"><?php echo $memberDetails['company_name'];?></td>
								<td><?php echo $memberDetails['first_name'];?> <?php echo $memberDetails['last_name'];?></td>
							</tr>
							<tr>
								<td><?php echo $memberDetails['designation'];?></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
    <tr>
		<td align="center"><div class="ads"><?php echo displayBanner(5); ?></div></td>
	</tr>
</table>

<!-- left table end -->
</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="95%" align="center">
<td>



<table cellpadding="0" cellspacing="0" width="100%" align="center" id="table_search">
								<tr>
									<th>
										<div class="box"><span class="count">(<?php echo $resultCount?>)</span> Search Result for "<?php echo $key?>"</div>
									</th>


								</tr>
								<?php if(!empty($results)){ foreach($results as $result){ ?>
								<tr <?=($i++ %2 == 1)?' class="odd"':''?>>
									<td>
										<div class="search_title">
                                       
                                        <?php if(!empty($loginname)) { if($search == 1) {?>
                                        <a href="index.php?view=tenderDetails&project_id=<?=$result['id']?>"><?=$result['name']?></a> 
                                         <?php }else if($search == 2){?>
                                          <a href="index.php?view=showCompany&companyId=<?=$result['id']?>"><?=$result['name']?></a> 
                                         <?php }else if($search == 3){?>
                                          <a href="index.php?view=showMember&memberId=<?=$result['id']?>"><?=$result['name']?></a> 
                                         <?php }else if($search == 4){?>
                                          <a href="index.php?view=showGroup&groupId=<?=$result['id']?>"><?=$result['name']?></a> 
                                         <?php }else if($search == 5){?>
                                          <a href="index.php?view=showEvent&eventId=<?=$result['id']?>"><?=$result['name']?></a> 
                                         <?php }else if($search == 6){?>
                                          <a href="index.php?view=jobDetails&jobId=<?=$result['id']?>"><?=$result['name']?></a> 
                                          <?php }else if($search == 7){?>
                                          <a href="index.php?view=showProject&projectId=<?=$result['id']?>"><?=$result['name']?></a> 
                                         <?php }}else{?>
									               <a href="index.php?view=login"><?=$result['name']?></a> 
		 
											<?php }?>
                                            </div>
									</td>
								</tr>
								<?php } } ?>
								<?php if(!is_array($results)){ ?>
								<tr>
									<td align="left">
										<h1>No Record Found</h1>
										<h1 style="color: #c10000">Please try another Search Keyword</h1>
									</td>
								</tr>
								<?php } ?>
							</table>
</div>

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
<?php include ("inc_rightbar.tpl.php"); ?>
<!-- right table end -->

</td>
</tr>
</table>