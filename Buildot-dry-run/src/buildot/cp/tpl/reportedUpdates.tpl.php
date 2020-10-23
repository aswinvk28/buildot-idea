<style>

</style>

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"><h2>Reported Updates</h2></td>
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
<th>List of Reported Updates<span style="float: right; padding-right: 10px">(<?php echo $reportCount ?>) Updates</span></th>
</tr>

<tr>
<td>

<ul class="cp_members" style="padding-left: 0px;">
<?php if(!empty($abuseReports)) { foreach ($abuseReports as $abuseReport) {  ?>
<li>
<div style="float: left; margin-right: 20px;"><a href="index.php?view=showMember&memberId=<?php echo $abuseReport['member_id'] ?>">
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

<a href="index.php?view=reportedUpdates&deleteupdate=1&reportId=<?=$abuseReport['report_id']?>" onclick="return confirm('Are you sure you want to delete?')">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png">Delete Update</span></div></a> 
<a href="index.php?view=reportedUpdates&deletereport=1&reportId=<?=$abuseReport['report_id']?>" onclick="return confirm('Are you sure you want to delete?')">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png">Delete Report</span></div></a> 
<span class="co_title"> <a href="index.php?view=showMember&memberId=<?php echo $abuseReport['member_id'] ?>"><?php echo $abuseReport['first_name'] ?> <?php echo $abuseReport['last_name'] ?></a></span> 
<span class="co_cat"><?php echo $abuseReport['update_message'] ?></a></span> 

				
				<?php if($abuseReport['table_name'] == 'groups'){
					$sql ="select * from groups where group_id=".$abuseReport['ids'];
					$group = $db->fetch($sql);?>
  <center><span class="details_box">
                     <a href="index.php?view=showGroup&groupId=<?php echo $group['group_id']?>">
									<?php if (!empty($group['group_image'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $group['group_image'];?>" height="80px" width="80px" class="indent" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="80px" height="80px" class="indent" />
									<?php }?>
									<?php echo $group['group_name']?></a></span></center><br />
									<?php }else if($abuseReport['table_name'] == 'events') {
                    $sql ="select * from events where event_id=".$abuseReport['ids'];
					$event = $db->fetch($sql);?>
				<center><span class="details_box">
                                    <a href="index.php?view=showEvent&eventId=<?php echo $event['event_id']?>">
									<?php if (!empty($event['image'])) {?>
									<img src="gallery/photos/thumbs/<?php echo $event['image'];?>" width="60px;" height="60px;" />
									<?php }else {?>
									<img src="gallery/photos/thumbs/default.jpg" width="40px" height="40px" />
									<?php }?>
									<?php echo $event['event_title']?></a></span></center><br />
									<?php }else if($abuseReport['table_name'] == 'projects') {
                    $sql ="select p.*,m.first_name,m.last_name from projects as p
							left join members as m on (m.member_id =p.member_id)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$abuseReport['ids'];
					$project = $db->fetch($sql);?>
              <center><span class="details_box">      
									<a href="index.php?view=tenderDetails&project_id=<?php echo $project['project_id']?>">
									<?php echo $project['project_name']?> (<?php echo $project['project_ref_no']?>)</a><br />
									<?php echo $project['first_name']?> <?php echo $project['last_name']?><br />
                                    <?php echo $project['project_location']?></span></center><br />
									<?php }else if($abuseReport['table_name'] == 'tenders') {
                    $sql ="SELECT mem.first_name,mem.last_name,mem.company_id,comp.company_name,t.*,p.project_id,
					p.project_name,p.project_ref_no,p.member_id as project_owner FROM tenders AS t 
					LEFT JOIN projects AS p ON (p.project_id = t.project_id)
					LEFT JOIN members AS mem ON (mem.member_id = t.member_id)
					LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
					WHERE tender_id=".$abuseReport['ids'];
					$tender = $db->fetch($sql);?>

<center><span class="details_box">
                    <?php if($tender['project_owner'] == $memberId || $tender['member_id'] == $memberId ) {?>
									<a href="index.php?view=tenderReceivedDetails&project_id=<?php echo $tender['project_id']?>&tenderId=<?php echo $tender['tender_id']?>">
									<?php echo $tender['project_name']?> (<?php echo $tender['project_ref_no']?>)</a>
                                    <br />
                                    Budget:<?php echo $tender['proposed_budget']?><br />
                                    <?php echo $tender['first_name']?> <?php echo $tender['last_name']?>::<?php echo $tender['company_name']?>
                                    <?php }else { ?>
                                    <?php echo $tender['project_name']?> (<?php echo $tender['project_ref_no']?>)
                                    <?php } ?></span></center>
									<?php }else if($abuseReport['table_name'] == 'job_openings') {
                    $sql ="SELECT jo.*,mem.first_name,mem.last_name,mem.company_id FROM job_openings AS jo
							LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
							WHERE jo.job_opening_id=".$abuseReport['ids'];
					$jobOpening = $db->fetch($sql);?>
                    <center><span class="details_box">
									<a href="index.php?view=jobOpenings&companyId=<?php echo $jobOpening['company_id']?>"> <?php echo $jobOpening['title']?></a></span></center><br />
									<?php }else if($abuseReport['table_name'] == 'friend_requests') {
                    $sql ="SELECT fr.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo FROM friend_requests AS fr
							LEFT JOIN members AS mem ON (mem.member_id = fr.from_member_id)
							LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
							WHERE friend_request_id=".$abuseReport['ids'];
					$friend = $db->fetch($sql);?>
                    <center><span class="details_box"> 
									<a href="index.php?view=showMember&memberId=<?php echo $friend['from_member_id']?>">
									<?php if(!empty($friend['company_id'])) { if (!empty($friend['logo'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $friend['logo'];?>" width="40" height="40" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="40" height="40" />
									<?php }}?>
									<?php if (!empty($friend['member_photo'])) {?>
									<img src="gallery/photos/thumbs/<?php echo $friend['member_photo'];?>" width="40" height="40" />
									<?php }else {?>
									<img src="gallery/photos/thumbs/default.jpg" width="40" height="40" />
									<?php }?>
									<?php echo $friend['first_name']?> <?php echo $friend['last_name']?></a></span></center><br />
									<?php } else if($abuseReport['table_name'] == 'job_application'){
										$sql ="SELECT * FROM job_openings 
									WHERE job_opening_id=".$abuseReport['ids'];
									$jobOpening = $db->fetch($sql);
									?>
                    <center><span class="details_box">                
									<a href="index.php?view=jobDetails&jobId=<?php echo $jobOpening['job_opening_id']?>"><?php echo $jobOpening['title']?></a></span></center><br />
						
						<?php  }  else if($abuseReport['table_name'] == 'share_invites'){
						 $sql ="SELECT mem.first_name,mem.last_name,mem.member_photo,si.* FROM share_invites AS si
								LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
								WHERE si.share_id=".$abuseReport['ids'];
						$share = $db->fetch($sql);?>
									<a href="index.php?view=showMember&memberId=<?php echo $share['to_member_id']?>"><?php echo $share['first_name'] ?> <?php echo $share['last_name'];?></a>:
             <center><span class="details_box">
									<?php if($share['page'] == 'showMember') {
							$sql = "SELECT mem.*,comp.company_name,comp.logo FROM members AS mem 
							LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
							WHERE mem.member_id =".$share['id'];
							$member = $db->fetch($sql);
							if (!empty($member['member_photo'])) {?>
									<img src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="40" height="40" />
									<?php }else {?>
									<img src="gallery/photos/thumbs/default.jpg" width="40" height="40" />
									<?php } ?>
									<a href="index.php?view=showMember&memberId=<?php echo $member['member_id']?>"><?php echo $member['first_name'];?> <?php echo $member['last_name'] ?></a><br />
									<?php }else if($share['page'] == 'showCompany') {
                        	$sql = "SELECT * from company where company_id=".$share['id'];
							$company = $db->fetch($sql);
							if (!empty($company['logo'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $company['logo'];?>" height="40" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="40" height="40" />
									<?php } ?>
									<a href="index.php?view=showCompany&companyId=<?php echo $company['company_id']?>"><?php echo $company['company_name']?></a><br />
									<?php }else if($share['page'] == 'tenderReceivedDetails') {
						 	$sql ="SELECT p.project_name,t.* FROM tenders AS t
									LEFT JOIN projects AS p ON (p.project_id = t.project_id)
									WHERE t.tender_id =".$share['id'];
								$projectTender = $db->fetch($sql); ?>
									Project Name:<a href="index.php?view=tenderReceivedDetails&tenderId=<?php echo $projectTender['tender_id']?>"><?php echo $projectTender['project_name'];?></a><br />
									<?php } else if($share['page'] == 'tenderDetails') {
						 	$sql ="SELECT p.* FROM projects AS p
									WHERE p.project_id =".$share['id'];
								$project = $db->fetch($sql); ?>
									Project Name:<a href="index.php?view=tenderDetails&project_d=<?php echo $project['project_id']?>"><?php echo $project['project_name'];?></a><br />
									<?php } ?>
                                    </span></center>
									<?php   }  ?>

 <?php $updateId = $abuseReport['id'];
						$sql ="SELECT * from update_reply where update_id=".$updateId;
						$replyCount=$db->numrows($sql);
						if($replyCount <3){
						
							$sql="SELECT  ur.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,
							DATE_FORMAT(ur.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(ur.created) AS createdunixtime FROM update_reply  AS ur
									LEFT JOIN members AS mem ON (mem.member_id = ur.send_by)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE ur.update_id = '$updateId' 
									ORDER BY ur.created DESC limit 2";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                    <?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
									<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40pt;" height="40pt;"/>
									<?php }else { ?>
									<img src="gallery/logos/thumbs/default.png" width="40pt;" height="40pt;" />
									<?php } }?>
									<?php if(!empty($reply['member_photo'])) { ?>
									<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40pt;" height="40pt;"/>
									<?php }else { ?>
									<img src="gallery/photos/thumbs/default.png" width="40pt;" height="40pt;" />
									<?php } ?>
									<a href="index.php?view=showMember&memberId=<?php echo $reply['send_by']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
									<?php echo $reply['message']?> 
									<div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
									
                                     <?php if( $reply['send_by'] == $memberId) {?>
                                   <a href="index.php?view=member_home&delete=1&memberId=<?php echo $update['member_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/delete.png" />Delete</span>
</a>
<?php } ?>
                                    <br />
									<?php }}}else{?>
<img src="images/icons/comment.png" /> <a href="javascript:void(0)" onclick="displayText('reply<?php echo $update['id'] ?>')">View all <?php echo $replyCount?> Comments</a>


									<div id="reply<?php echo $update['id'] ?>" style="display:none">
										<?php $sql="SELECT ur.*,mem.first_name,mem.last_name,mem.member_photo,
										mem.company_id,comp.logo,
										DATE_FORMAT(ur.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(ur.created) AS createdunixtime FROM update_reply  AS ur
									LEFT JOIN members AS mem ON (mem.member_id = ur.send_by)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE ur.update_id = '$updateId' 
									ORDER BY ur.created DESC";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                     <?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
									<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40pt;" height="40pt;"/>
									<?php }else { ?>
									<img src="gallery/logos/thumbs/default.png" width="40pt;" height="40pt;" />
									<?php } }?>
                                  
										<?php if(!empty($reply['member_photo'])) { ?>
										<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40pt;" height="40pt;"/>
										<?php }else { ?>
										<img src="gallery/photos/thumbs/default.png" width="40pt;" height="40pt;" />
										<?php }?>
										<a href="index.php?view=showMember&memberId=<?php echo $reply['send_by']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
										<?php	echo $reply['message']?> <div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
										    <?php if( $reply['send_by'] == $memberId) {?>
<a href="index.php?view=member_home&delete=1&memberId=<?php echo $update['member_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/delete.png" />Delete</span></a>
					<?php } ?>
                                        <br />
                                        
										<?php }}?>
									</div>
								<?php }?>
				
                                  
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