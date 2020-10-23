<script type="text/javascript" src="js/jquery.form.js"></script>  
<script type="text/javascript">
function displayText(id){
	document.getElementById(id).style.display="";
}

function hidebox(id){
	document.getElementById('loading'+id).innerHTML = '<div align="center" style="width:100%;"><img src="images/loading.gif" /></div>';
	//document.getElementById('replytext'+id).style.display = 'none';
	//document.getElementById('replytextbox'+id).value = '';
}

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
<td width="85%"><h2>UPDATES</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_home_page">
                <?php if(!empty($updates)) { $co = 1; foreach($updates as $update) {?>
                <tr id="update_<?php echo $update['id'] ?>">
                  <td width="508" valign="top">
				  <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
				  <?php if(!empty($update['company_id'])){
		if(!empty($update['logo'])) { ?>
                    <img src="gallery/logos/thumbs/<?php echo $update['logo'] ?>" width="52" class="thumbs"/>
                    <?php }else { ?>
                    <img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
                    <?php }} ?></td><td style="padding-top:0px;border:hidden;">
                    <?php if(!empty($update['member_photo'])) { ?>
                    <a href="index.php?view=showMember&memberId=<?php echo $update['member_id']?>"></a><a href="index.php?view=showMember&memberId=<?php echo $update['member_id']?>"><img src="gallery/photos/thumbs/<?php echo $update['member_photo'] ?>" width="52" class="thumbs"/></a>
                    <?php }else { ?>
                    <img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
                    <?php }?></td></tr></table>
                    </td>
                  <td><div class="comment" style="height:30px">
                      <div> <a href="index.php?view=showMember&memberId=<?php echo $update['member_id']?>"><?php echo $update['first_name']?> <?php echo $update['last_name']?></a> <?php echo $update['update_message']; ?>
                        <ul id="hide-report">
                          <li><a href="#"><img width="10" height="14" src="images/hide-report-arrow.png"></a>
                            <ul style="display: none;">
                              <li><a href="index.php?view=moreUpdates&hide=1&updateId=<?php echo $update['id']?>">Hide</a></li>
                              <li><a href="index.php?view=moreUpdates&report=1&updateId=<?php echo $update['id']?>">Report</a></li>
                            </ul>
                            <div class="clear"></div>
                          </li>
                        </ul>
                        
                        <!--updates for posts table-->
                        <?php if($update['table_name'] == 'posts'){
					$sql ="select * from posts where post_id=".$update['ids'];
					$post = $db->fetch($sql);?>
                        <div class="comment_box_posts">
                          <?php if (!empty($post['attachment'])) {?>
                          <a href="gallery/files/<?=$post['attachment'];?>" target="_blank"><img src="images/icon_attach.png" width="24"  style="padding:15px;" class="thumbs" /></a>
                          <?php }?>
                          <?php echo $post['message']?> </div>
                        
                        <!--updates for groups table-->
                        <?php }else if($update['table_name'] == 'groups'){
					$sql ="select * from groups where group_id=".$update['ids'];
					$group = $db->fetch($sql);?>
                        <div class="comment_box"> <a href="index.php?view=showGroup&groupId=<?php echo $group['group_id']?>">
                          <?php if (!empty($group['group_image'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $group['group_image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>

<?php echo $group['group_name']?></a> <span class="caption">Type:&nbsp;</span> <?php echo $group['group_type']?> <span class="caption">Website:</span> <a href="http://<?php echo $group['website']?>" target="_blank"><?php echo $group['website']?></a> 
</div>
                        
                        <!--updates for group_message table-->
                        <?php }else if($update['table_name'] == 'group_message') { 
									$sql ="select gm.*,g.group_name,g.group_image,g.group_type,g.website from group_message as gm
											left join groups as g on (g.group_id = gm.group_id)
											 where msg_id=".$update['ids'];
									$groupMessage = $db->fetch($sql);
									
									$query ="SELECT * from group_members where member_id = '$memberId' AND group_id = ".$groupMessage['group_id'];
									$memberCount = $db->numrows($query);
									?>
                        <div class="comment_box">
                          <?php if($memberCount > 0) {?>
                          <a href="index.php?view=showGroup&groupId=<?php echo $groupMessage['group_id']?>">
                          <?php if (!empty($groupMessage['group_image'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $groupMessage['group_image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $groupMessage['group_name']?></a><br />
                          <span class="caption">Type:&nbsp;</span> <?php echo $groupMessage['group_type']?><br />
                          <span class="caption">Website:</span> <a href="http://<?php echo $groupMessage['website']?>" target="_blank"><?php echo $groupMessage['website']?></a>
                          <?php }else{ ?>
                          <?php if (!empty($groupMessage['group_image'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $groupMessage['group_image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $groupMessage['group_name']?><br />
                          <span class="caption">Type:&nbsp;</span> <?php echo $groupMessage['group_type']?><br />
                          <span class="caption">Website:</span> <a href="http://<?php echo $groupMessage['website']?>" target="_blank"><?php echo $groupMessage['website']?></a>
                          <?php } ?>
                        </div>
                        
                        <!--updates for group_message_reply table-->
                        <?php } else if($update['table_name'] == 'group_message_reply'){
						 $sql ="SELECT gmr.*,gm.group_id,g.`group_name`,g.group_image,g.group_type,g.website FROM group_message_reply AS gmr 
										LEFT JOIN group_message AS gm ON (gm.`msg_id` = gmr.`msg_id`)
										LEFT JOIN groups AS g ON (g.`group_id` = gm.`group_id`)
										WHERE gmr.reply_id=".$update['ids'];
									$groupUpdateReply = $db->fetch($sql);
									
									$query ="SELECT * from group_members where member_id = '$memberId' AND group_id = ".$groupUpdateReply['group_id'];
									$memberCount = $db->numrows($query);
									
									?>
                        <div class="comment_box">
                          <?php if($memberCount > 0) {?>
                          <a href="index.php?view=showGroup&groupId=<?php echo $groupUpdateReply['group_id']?>">
                          <?php if (!empty($groupUpdateReply['group_image'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $groupUpdateReply['group_image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $groupUpdateReply['group_name']?></a><br />
                          <span class="caption">Type:&nbsp;</span><?php echo $groupUpdateReply['group_type']?><br />
                          <span class="caption">Website:</span><a href="http://<?php echo $groupUpdateReply['website']?>" target="_blank"><?php echo $groupUpdateReply['website']?></a>
                          <?php }else{ ?>
                          <?php if (!empty($groupUpdateReply['group_image'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $groupUpdateReply['group_image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $groupUpdateReply['group_name']?><br />
                          <span class="caption">Type:&nbsp;</span> <?php echo $groupUpdateReply['group_type']?><br />
                          <span class="caption">Website:</span> <a href="http://<?php echo $groupUpdateReply['website']?>" target="_blank"><?php echo $groupUpdateReply['website']?></a>
                          <?php } ?>
                        </div>
                        
                        <!--updates for events table-->
                        <?php }else if($update['table_name'] == 'events') {
                    $sql ="select *,DATE_FORMAT(event_date,'%d-%m-%Y %h:%i %p') AS eventDate from events where event_id=".$update['ids'];
					$event = $db->fetch($sql);?>
                        <div class="comment_box"> <a href="index.php?view=showEvent&eventId=<?php echo $event['event_id']?>">
                          <?php if (!empty($event['image'])) {
$info = explode(".",$event['image']);
if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
                          <img src="gallery/files/<?php echo $event['image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else if($info[1] == 'pdf') { ?>
                          <img src="images/icon_pdf.png" width="24" style="padding:15px;" class="thumbs" />
                          <?php } }else {?>
                          <img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $event['event_title']?></a><br />
                          <span class="caption">Date & Time:</span><?php echo $event['eventDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $event['location'] ?> </div>
                        
                        <!--updates for event_message table-->
                        <?php }else if($update['table_name'] == 'event_message') { 
									$sql ="select em.*,e.*,DATE_FORMAT(e.event_date,'%d-%m-%Y %h:%i %p') AS eventDate from event_message as em
											left join events as e on (e.event_id = em.event_id)
											 where msg_id=".$update['ids'];
									$eventMessage = $db->fetch($sql);									
									?>
                        <div class="comment_box"> <a href="index.php?view=showEvent&eventId=<?php echo $eventMessage['event_id']?>">
                          <?php if (!empty($eventMessage['image'])) {
										 $info = explode(".",$eventMessage['image']);
										if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
                          <img src="gallery/files/<?php echo $eventMessage['image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else if($info[1] == 'pdf') { ?>
                          <img src="images/icon_pdf.png" width="24" style="padding:15px;" class="thumbs" />
                          <?php } }else {?>
                          <img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $eventMessage['event_title']?></a><br />
                          <span class="caption">Date & Time:</span><?php echo $eventMessage['eventDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $eventMessage['location'] ?> </div>
                        
                        <!--updates for event_message_reply table-->
                        <?php } else if($update['table_name'] == 'event_message_reply'){
						 $sql ="SELECT emr.*,em.event_id,e.`event_title`,e.image,e.location,
						 DATE_FORMAT(e.event_date,'%d-%m-%Y %h:%i %p') AS eventDate FROM event_message_reply AS emr 
										LEFT JOIN event_message AS em ON (em.`msg_id` = emr.`msg_id`)
										LEFT JOIN events AS e ON (e.`event_id` = em.`event_id`)
										WHERE emr.reply_id=".$update['ids'];
									$eventUpdateReply = $db->fetch($sql);
									?>
                        <div class="comment_box"> <a href="index.php?view=showEvent&eventId=<?php echo $eventUpdateReply['event_id']?>">
                          <?php if (!empty($eventUpdateReply['image'])) {
										 $info = explode(".",$eventUpdateReply['image']);
										if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
                          <img src="gallery/files/<?php echo $eventUpdateReply['image'];?>" width="52" height="52" class="thumbs" />
                          <?php }else if($info[1] == 'pdf') { ?>
                          <img src="images/icon_pdf.png" width="24" style="padding:15px;" class="thumbs" />
                          <?php } }else {?>
                          <img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }?>
                          <?php echo $eventUpdateReply['event_title']?></a><br />
                          <span class="caption">Date & Time:</span><?php echo $eventUpdateReply['eventDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $eventUpdateReply['location'] ?> </div>
                        
                        <!--updates for projects table-->
                        <?php }else if($update['table_name'] == 'projects') {
                    $sql ="select p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y ') AS closingDate,m.first_name,m.last_name from projects as p
							left join members as m on (m.member_id =p.member_id)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$update['ids'];
					$project = $db->fetch($sql);?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=tenderDetails&project_id=<?php echo $project['project_id']?>"> <?php echo $project['project_name']?> (<?php echo $project['project_ref_no']?>)</a><br />
                          <span class="caption">Closing Date</span> <?php echo $project['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span> <?php echo $project['project_location']?> </div>
                        
                        <!--updates for projects published to selected members-->
                        <?php  }else if($update['table_name'] == 'projects_selected') {
                    $sql ="select p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closingDate,m.first_name,m.last_name from projects as p
							left join members as m on (m.member_id =p.member_id)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$update['ids'];
					$sproject = $db->fetch($sql);?>
                        <?php $sql ="SELECT * from share_invites where page='inviteTenders' and id=".$update['ids'];
			  			$shareDetails=$db->fetch($sql);
						?>
                        <div class="comment_box">
                          <?php if($sproject['project_owner'] == $memberId || $shareDetails['to_member_id'] == $memberId ) {?>
                          <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=tenderDetails&project_id=<?php echo $sproject['project_id']?>"> <?php echo $sproject['project_name']?> (<?php echo $sproject['project_ref_no']?>)</a><br />
                          <span class="caption">Closing Date:</span><?php echo $sproject['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $sproject['project_location']?>
                          <?php }else{ ?>
                          <span class="caption">Project Name:&nbsp;</span><?php echo $sproject['project_name']?> (<?php echo $sproject['project_ref_no']?>)<br />
                          <span class="caption">Closing Date:</span><?php echo $sproject['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $sproject['project_location']?>
                          <?php } ?>
                        </div>
                        
                        <!--updates for company_projects table-->
                        <?php }else if($update['table_name'] == 'company_projects') {
                    $sql ="select p.*,m.first_name,m.last_name from company_projects as p
							left join members as m on (m.member_id =p.project_owner)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$update['ids'];
					$comp_project = $db->fetch($sql);?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=showProject&companyId=<?php echo $comp_project['companyId']?>&projectId=<?php echo $comp_project['project_id']?>"> <?php echo $comp_project['project_name']?> </a><br />
                          <span class="caption">Type:&nbsp;</span><?php echo $comp_project['project_type']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $comp_project['project_location']?> </div>
                        
                        <!--updates for company_project_message table-->
                        <?php }else if($update['table_name'] == 'company_project_message') { 
									$sql ="select cpm.*,cp.* from company_project_message as cpm
											left join company_projects as cp on (cp.project_id = cpm.project_id)
											 where msg_id=".$update['ids'];
									$companyProjectMessage = $db->fetch($sql);
									?>
                        <div class="comment_box"> &nbsp;<span class="caption">Project Name:&nbsp;</span><a href="index.php?view=showProject&companyId=<?php echo $companyProjectMessage['companyId']?>&projectId=<?php echo $companyProjectMessage['project_id']?>"> <?php echo $companyProjectMessage['project_name']?></a><br />
                          <span class="caption">Type:&nbsp;</span>&nbsp;<?php echo $companyProjectMessage['project_type']?><br />
                          <span class="caption">Location:&nbsp;</span>&nbsp;<?php echo $companyProjectMessage['project_location']?> </div>
                        
                        <!--updates for company_project_message_reply table-->
                        <?php } else if($update['table_name'] == 'company_project_message_reply'){
						 $sql ="SELECT cpmr.*,cpm.project_id,p.`project_name`,p.companyId,p.project_type,p.project_location FROM company_project_message_reply AS cpmr 
										LEFT JOIN company_project_message AS cpm ON (cpm.`msg_id` = cpmr.`msg_id`)
										LEFT JOIN company_projects AS p ON (p.`project_id` = cpm.`project_id`)
										WHERE cpmr.reply_id=".$update['ids'];
									$projectUpdateReply = $db->fetch($sql);
									?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=showProject&companyId=<?php echo $projectUpdateReply['companyId']?>&projectId=<?php echo $projectUpdateReply['project_id']?>"> <?php echo $projectUpdateReply['project_name']?></a><br />
                          <span class="caption">Type:&nbsp;</span><?php echo $projectUpdateReply['project_type']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $projectUpdateReply['project_location']?> </div>
                        
                        <!--updates for the projec_invites table-->
                        <?php }else if($update['table_name'] == 'project_invites') {
									    $sql ="SELECT pp.*,cp.project_name,cp.project_type,cp.project_location,cp.companyId from project_invites as pp
												LEFT JOIN company_projects as cp on (cp.project_id = pp.project_id)
												WHERE pp.project_invite_id=".$update['ids'];
											
											$projectInvite = $db->fetch($sql);?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=showProject&companyId=<?php echo $projectInvite['companyId']?>&projectId=<?php echo $projectInvite['project_id']?>"> <?php echo $projectInvite['project_name']?> </a><br />
                          <span class="caption">Type:&nbsp;</span><?php echo $projectInvite['project_type']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $projectInvite['project_location']?> </div>
                        
                        <!--updates for project_requests sent-->
                        <?php }else if($update['table_name'] == 'project_requests') {
									    $sql ="SELECT mem.first_name,mem.last_name,pp.*,cp.project_name,cp.project_type,cp.project_location,cp.companyId from project_invites as pp
												LEFT JOIN company_projects as cp on (cp.project_id = pp.project_id)
												LEFT JOIN members as mem on (mem.member_id = pp.to_member_id)
												WHERE pp.project_invite_id=".$update['ids'];
											
											$projectRequest = $db->fetch($sql);?>
                        <a href="index.php?view=showMember&memberId=<?php echo $projectRequest['to_member_id']?>"><?php echo $projectRequest['first_name']?> <?php echo $projectRequest['last_name']?></a> to view :<br/>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=showProject&companyId=<?php echo $projectRequest['companyId']?>&projectId=<?php echo $projectRequest['project_id']?>"><?php echo $projectRequest['project_name']?> </a><br />
                          <span class="caption">Type:&nbsp;</span><?php echo $projectRequest['project_type']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $projectRequest['project_location']?> </div>
                        
                        <!--updates for the shortlisting of the projects-->
                        <?php }else if($update['table_name'] == 'project_shortlist') {
									    $sql ="SELECT pp.*,cp.project_name,cp.project_type,cp.project_location,cp.companyId from project_invites as pp
												LEFT JOIN company_projects as cp on (cp.project_id = pp.project_id)
												WHERE pp.project_invite_id=".$update['ids'];
											
											$projectShortlist = $db->fetch($sql);?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=projectInvites&companyId=<?php echo $projectShortlist['companyId']?>"> <?php echo $projectShortlist['project_name']?> </a><br />
                          <span class="caption">Type:&nbsp;</span><?php echo $projectShortlist['project_type']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $projectShortlist['project_location']?> </div>
                        
                        <!--updates for the tenders table-->
                        <?php }else if($update['table_name'] == 'tenders') {
                    $sql ="SELECT mem.first_name,mem.last_name,mem.company_id,comp.company_name,t.*,p.project_id,
					p.project_name,p.project_ref_no,p.member_id as project_owner FROM tenders AS t 
					LEFT JOIN projects AS p ON (p.project_id = t.project_id)
					LEFT JOIN members AS mem ON (mem.member_id = t.member_id)
					LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
					WHERE tender_id=".$update['ids'];
					$tender = $db->fetch($sql);?>
                        <div class="comment_box">
                          <?php if($tender['project_owner'] == $memberId || $tender['member_id'] == $memberId ) {?>
                          <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=tenderReceivedDetails&project_id=<?php echo $tender['project_id']?>&tenderId=<?php echo $tender['tender_id']?>"> <?php echo $tender['project_name']?> (<?php echo $tender['project_ref_no']?>)</a> <br />
                          <span class="caption">Budget: </span><?php echo $tender['proposed_budget']?><br />
                          <span class="caption">Sector: </span><?php echo $tender['sector']?>
                          <?php }else { ?>
                          <span class="caption">Project Name:&nbsp;</span><?php echo $tender['project_name']?> (<?php echo $tender['project_ref_no']?>)<br />
                          <span class="caption">Sector:</span><?php echo $tender['sector']?>
                          <?php } ?>
                        </div>
                        
                        <!--updates for the tender_comments table-->
                        <?php }else if($update['table_name'] == 'tender_comments') {
                 $sql ="SELECT tc.*,t.*,p.*,p.member_id AS project_owner,t.member_id AS quotted_by from tender_comments AS tc 
					LEFT JOIN tenders as t ON (t.tender_id = tc.tender_id)
					LEFT JOIN projects AS p ON (p.project_id = t.project_id)
					WHERE tc.tender_comment_id=".$update['ids'];
					$tenderComment = $db->fetch($sql);?>
                        <div class="comment_box">
                          <?php if($tenderComment['project_owner'] == $memberId) {?>
                          <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=tenderReceivedDetails&project_id=<?php echo $tenderComment['project_id']?>&tenderId=<?php echo $tenderComment['tender_id']?>"> <?php echo $tenderComment['project_name']?> (<?php echo $tenderComment['project_ref_no']?>)</a><br />
                          <span class="caption">Budget: </span><?php echo $tenderComment['proposed_budget']?><br />
                          <span class="caption">Sector: </span><?php echo $tenderComment['sector']?> <br />
                          <?php }else if($tenderComment['quotted_by'] == $memberId){ ?>
                          <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=sendQuoteDetails&project_id=<?php echo $tenderComment['project_id']?>&tenderId=<?php echo $tenderComment['tender_id']?>"> <?php echo $tenderComment['project_name']?> (<?php echo $tenderComment['project_ref_no']?>)</a> <br />
                          <span class="caption">Budget: </span><?php echo $tenderComment['proposed_budget']?><br />
                          <span class="caption">Sector: </span><?php echo $tenderComment['sector']?>
                          <?php	} else { ?>
                          <span class="caption">Project Name:&nbsp;</span><?php echo $tenderComment['project_name']?> (<?php echo $tenderComment['project_ref_no']?>)<br />
                          <span class="caption">Budget: </span><?php echo $tenderComment['proposed_budget']?><br />
                          <span class="caption">Sector: </span><?php echo $tenderComment['sector']?>
                          <?php } ?>
                        </div>
                        
                        <!--updates for the job_openings table-->
                        <?php }else if($update['table_name'] == 'job_openings') {
                    $sql ="SELECT jo.*,mem.first_name,mem.last_name,mem.company_id,
							DATE_FORMAT(jo.expiry_date,'%d-%m-%Y') AS expiryDate FROM job_openings AS jo
							LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
							WHERE jo.job_opening_id=".$update['ids'];
					$jobOpening = $db->fetch($sql);?>
                        <div class="comment_box"> <span class="caption">Job Title: </span><a href="index.php?view=jobDetails&jobId=<?php echo $jobOpening['job_opening_id']?>"> <?php echo $jobOpening['title']?></a><br />
                          <span class="caption">Expiry Date: </span><?php echo $jobOpening['expiryDate']?> </div>
                        
                        <!--updates for the friend_requests table-->
                        <?php }else if($update['table_name'] == 'friend_requests') {
                    $sql ="SELECT fr.*,mem.first_name,mem.last_name,mem.member_photo,mem.designation,mem.company_id,comp.logo,company_name FROM friend_requests AS fr
							LEFT JOIN members AS mem ON (mem.member_id = fr.from_member_id)
							LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
							WHERE friend_request_id=".$update['ids'];
					$friend = $db->fetch($sql);?>
<div class="comment_box">
	<div>
<a href="index.php?view=showMember&memberId=<?php echo $friend['from_member_id']?>"> 
<table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden;">   
<?php if(!empty($friend['company_id'])) { if (!empty($friend['logo'])) {?>
<img src="gallery/logos/thumbs/<?php echo $friend['logo'];?>" width="52" class="thumbs" />
<?php }else {?>
<img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
<?php }}?></td><td style="padding-top:0px;border:hidden;">
<?php if (!empty($friend['member_photo'])) {?>
<img src="gallery/photos/thumbs/<?php echo $friend['member_photo'];?>" width="52" class="thumbs" />
<?php }else {?>
<img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
<?php }?>
</td></tr></table>

</div>

<div>
<?php echo $friend['first_name']?> <?php echo $friend['last_name']?></a><br />
<?php if(!empty($friend['company_id'])) {?>
<span class="caption">Company: </span><?php echo $friend['company_name']?><br />
<span class="caption">Designation: </span><?php echo $friend['designation']?>
<?php } ?>
</div>
</div>
                        
                        <!--updates for the job_application table-->
                        <?php } else if($update['table_name'] == 'job_application'){
										$sql ="SELECT *,DATE_FORMAT(expiry_date,'%d-%m-%Y') AS expiryDate FROM job_openings 
									WHERE job_opening_id=".$update['ids'];
									$jobApplication = $db->fetch($sql);
									?>
                        <div class="comment_box"> <span class="caption">Job Title: </span><a href="index.php?view=jobDetails&jobId=<?php echo $jobApplication['job_opening_id']?>"><?php echo $jobApplication['title']?></a><br />
                          <span class="caption">Expiry Date: </span><?php echo $jobApplication['expiryDate']?> </div>
                        
                        <!--updates for the update_reply table-->
                        <?php } else if($update['table_name'] == 'update_reply'){
						 $sql ="SELECT ur.*,u.`member_id`,mem.`first_name`,mem.`last_name`,mem.member_photo,mem.company_id,mem.designation,comp.logo,comp.company_name FROM update_reply AS ur
								LEFT JOIN updates AS u ON (u.`id` = ur.`update_id`)
								LEFT JOIN members AS mem ON (mem.`member_id` = u.`member_id`)
								LEFT JOIN company as comp ON (comp.company_id = mem.company_id)
								 WHERE reply_id=".$update['ids'];
									$memberUpdateReply = $db->fetch($sql);
									?>
                        <div class="comment_box"> <a href="index.php?view=moreUpdates&updateuId=<?php echo $memberUpdateReply['update_id']?>">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
                          <?php if (!empty($memberUpdateReply['company_id'])) { if(!empty($memberUpdateReply['logo'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $memberUpdateReply['logo'];?>" width="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }} ?></td><td style="padding-top:0px;border:hidden;">
						<?php if (!empty($memberUpdateReply['member_photo'])) {?>
                          <img src="gallery/photos/thumbs/<?php echo $memberUpdateReply['member_photo'];?>" width="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php } ?></td></tr></table>
                          <?php echo $memberUpdateReply['first_name']?> <?php echo $memberUpdateReply['last_name']?><br />
                          <?php if(!empty($memberUpdateReply['company_id'])) {?>
                          <span class="blackfontlower">Company: <?php echo $memberUpdateReply['company_name']?></span><br />
                          <span class="blackfontlower">Designation: <?php echo $memberUpdateReply['designation']?></span>
                          <?php } ?>
                          </a>
                        </div>
                        
                        <!--updates for the share_invites table-->
                        <?php  }  else if($update['table_name'] == 'share_invites'){
						 $sql ="SELECT mem.first_name,mem.last_name,mem.member_photo,si.* FROM share_invites AS si
								LEFT JOIN members AS mem ON (mem.member_id = si.to_member_id)
								WHERE si.share_id=".$update['ids'];
						$share = $db->fetch($sql);?>
                        <a href="index.php?view=showMember&memberId=<?php echo $share['to_member_id']?>"><?php echo $share['first_name'] ?> <?php echo $share['last_name'];?></a>:
                        <?php if($share['page'] == 'showMember') {
							$sql = "SELECT mem.*,comp.company_name,comp.logo FROM members AS mem 
							LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
							WHERE mem.member_id =".$share['id'];
							$member = $db->fetch($sql);?>
                        <div class="comment_box"> <a href="index.php?view=showMember&memberId=<?php echo $member['member_id']?>">
                          <table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
						  <?php if (!empty($member['company_id'])) { if(!empty($member['logo'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $member['logo'];?>" width="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php }} ?></td><td style="padding-top:0px;border:hidden;">
							<?php if (!empty($member['member_photo'])) {?>
                          <img src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php } ?></td></tr></table>
                          <?php echo $member['first_name'];?> <?php echo $member['last_name'] ?></a> </div>
                        <?php }else if($share['page'] == 'showCompany') {
                        	$sql = "SELECT * from company where company_id=".$share['id'];
							$company = $db->fetch($sql);?>
                        <div class="comment_box">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
                          <?php	if (!empty($company['logo'])) {?>
                          <img src="gallery/logos/thumbs/<?php echo $company['logo'];?>" width="52" class="thumbs" />
                          <?php }else {?>
                          <img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
                          <?php } ?></td></tr></table>
                          <a href="index.php?view=showCompany&companyId=<?php echo $company['company_id']?>"><?php echo $company['company_name']?></a> </div>
                        <?php }else if($share['page'] == 'tenderReceivedDetails') {
						 	$sql ="SELECT p.project_name,t.* FROM tenders AS t
									LEFT JOIN projects AS p ON (p.project_id = t.project_id)
									WHERE t.tender_id =".$share['id'];
								$projectTender = $db->fetch($sql); ?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=tenderReceivedDetails&tenderId=<?php echo $projectTender['tender_id']?>"><?php echo $projectTender['project_name'];?></a><br />
                          <span class="caption">Budget: </span><?php echo $projectTender['proposed_budget']?><br />
                          <span class="caption">Sector: </span><?php echo $projectTender['sector']?> </div>
                        <?php } else if($share['page'] == 'tenderDetails') {
						 	$sql ="SELECT p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closingDate FROM projects AS p
									WHERE p.project_id =".$share['id'];
								$project = $db->fetch($sql); 							
								?>
                        <div class="comment_box"> <span class="caption">Project Name:&nbsp;</span>
                          <?php if($project['member_id'] == $memberId || $share['to_member_id'] == $memberId ) {?>
                          <a href="index.php?view=tenderDetails&project_id=<?php echo $project['project_id']?>"><?php echo $project['project_name'];?></a><br />
                          <span class="caption">Closing Date:</span><?php echo $project['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $project['project_location']?>
                          <?php }else{?>
                          <span class="caption">Project Name:&nbsp;</span><?php echo $project['project_name'];?><br />
                          <span class="caption">Closing Date:</span><?php echo $project['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $project['project_location']?>
                          <?php } ?>
                        </div>
                        <?php }else if($share['page'] == 'inviteTenders') {
						 	$sql ="SELECT p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closingDate FROM projects AS p
									
									WHERE p.project_id =".$share['id'];
								$sharedproject= $db->fetch($sql); ?>
                        <div class="comment_box">
                          <?php 	if($sharedproject['member_id'] == $memberId || $share['to_member_id'] == $memberId){?>
                          <span class="caption">Project Name:&nbsp;</span><a href="index.php?view=tenderDetails&project_id=<?php echo $sharedproject['project_id']?>"><?php echo $sharedproject['project_name'];?></a><br />
                          <span class="caption">Closing Date:</span><?php echo $sharedproject['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $sharedproject['project_location']?>
                          <?php }else{?>
                          <span class="caption">Project Name:&nbsp;</span><?php echo $sharedproject['project_name'];?><br />
                          <span class="caption">Closing Date:</span><?php echo $sharedproject['closingDate']?><br />
                          <span class="caption">Location:&nbsp;</span><?php echo $sharedproject['project_location']?>
                          <?php }?>
                        </div>
                        <?php } ?>
                        <?php   }  ?>
                        
                          <p class="smalltxt">
                            <?=compare_dates($update['curunixtime'],$update['createdunixtime'])?>
                            . <a href="javascript:void(0)" onclick="displayText('replytext<?php echo $update['id'] ?>')">Reply</a></p>
                        
                      </div>
                    </div>
                     <br />
					  <br />
					    <br />
						  <br />
						    <br />
                    <?php $updateId = $update['id'];
						$sql ="SELECT * from update_reply where update_id=".$updateId;
						$replyCount=$db->numrows($sql);
						
		if($replyCount <3 || $_REQUEST['reply'] == 1){?>
                    <div style="margin-top:20px">
                      <?php
						
							$sql="SELECT  ur.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,
							DATE_FORMAT(ur.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(ur.created) AS createdunixtime FROM update_reply  AS ur
									LEFT JOIN members AS mem ON (mem.member_id = ur.send_by)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE ur.update_id = $updateId 
									ORDER BY ur.created ";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                    <div class="replys">
                      <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
                      <?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
                      <img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40" class="thumbs"/>
                      <?php }else { ?>
                      <img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
                      <?php } }?></td><td style="padding:0px;border:hidden;">
                      <?php if(!empty($reply['member_photo'])) { ?>
                      <img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" class="thumbs" />
                      <?php }else { ?>
                      <img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
                      <?php } ?></td></tr></table>
                      <?php if( $reply['send_by'] == $memberId) {?>
                      <a href="index.php?view=moreUpdates&delete=1&memberId=<?php echo $update['member_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span style="float: right; padding-top: 5px;"><img src="<?=IMAGEURL?>icons/close.gif" /></span></a><br />
                      <?php } ?>
                      <a href="index.php?view=showMember&memberId=<?php echo $reply['send_by']?>"><?php echo $reply['first_name']?><?php echo $reply['last_name']?></a>: <?php echo $reply['message']?> <br />
                      <div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
                      <br />   <br />
                      </div>
                      <?php }}?>
                    </div>
                    <?php }else{?>
                    <img src="images/icons/comment.gif" /> <a href="javascript:void(0)" onclick="displayText('reply<?php echo $update['id'] ?>')">View all <?php echo $replyCount?> Comments</a>
                    <div>
                      <div id="reply<?php echo $update['id'] ?>" style="display:none">
                        <?php $sql="SELECT ur.*,mem.first_name,mem.last_name,mem.member_photo,
mem.company_id,comp.logo,
DATE_FORMAT(ur.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(ur.created) AS createdunixtime FROM update_reply  AS ur
LEFT JOIN members AS mem ON (mem.member_id = ur.send_by)
LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
WHERE ur.update_id = $updateId 
ORDER BY ur.created ";
$replies = $db->select($sql);
if(!empty($replies)){
foreach($replies as $reply){?>
<div class="replys" >
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
                        <?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
                        <img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40" class="thumbs" />
                        <?php }else { ?>
                        <img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
                        <?php } }?></td><td style="padding:0px;border:hidden;">
                        <?php if(!empty($reply['member_photo'])) { ?>
                        <img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" class="thumbs"/>
                        <?php }else { ?>
                        <img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
                        <?php }?></td></tr></table>
                        <?php if( $reply['send_by'] == $memberId) {?>
                        <a href="index.php?view=moreUpdates&delete=1&memberId=<?php echo $update['member_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span style="float: right; padding-top: 5px;"><img src="<?=IMAGEURL?>icons/close.gif" /></span></a><br />
                        <?php } ?>
                        <a href="index.php?view=showMember&memberId=<?php echo $reply['send_by']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
                        <?php	echo $reply['message']?>
                        
                          <div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
                        
                           <br /> <br />
                           </div>
                        <?php }}?>
                      </div>
                      <?php }?>
                    </div>
                     <div id="loading<?php echo $update['id'] ?>"></div>
                    <div id="replytext<?php echo $update['id'] ?>" style="width: 520px; background-color:#F3F3F3; display:none; float:left; padding:5px 15px 10px 15px;">
                      <script type="text/javascript">
$('document').ready(function()
{
	$('#formUpdates<?=$co?>').ajaxForm(  {
		target: '#index',
		success: function() {
		//$('#formbox').slideUp('fast');
		
		}
	
	});
	
});
</script>
                      <form method="post" id="formUpdates<?=$co++?>" action="">
                        <input type="hidden" id="update_id" name="update_id" value="<?php echo $update['id'] ?>" />
                        <input type="hidden" id="memberId" name="memberId" value="<?php echo $memberId ?>" />
                        <input type="hidden" name="aj" value="1" />
                         <input type="hidden" name="reply" value="1" />
                        <table cellpadding="0" cellspacing="0" class="comment_box">
                          <tr>
                            <td style="border:none;"><textarea style="padding-top: 5px;" name="comment" cols="55" rows="2" class="commentbox" placeholder="Write a comment..." id="replytextbox<?php echo $update['id'] ?>"></textarea>
                              <input type="image" value="Post" src="images/post-btn.png" style="padding-top: 5px;" width="46" height="23" onclick="hidebox('<?php echo $update['id'] ?>')" /></td>
                          </tr>
                        </table>
                      </form>
                    </div></td>
                </tr>
                <?php }}?>
              
              </table>    
    </td>
  </tr>
  
  <tr>
					<td align="center">
						<div>
							<?=$paginate?>
						</div>
					</td>
				</tr>
</table>



</td>

</tr>
</table>

</div>
