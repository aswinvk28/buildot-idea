<script>
function displayText(id){

	document.getElementById(id).style.display="";
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
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<tr><td colspan="2"><h2>Member Details</h2></td></tr>

<tr class="blue-gradient-bg">
<td width="159" valign="top">
<div style="padding-left: 10px;">
  <?php if(!empty($memberDetails['company_id'])) { if (!empty($companyDetails['logo'])){?>
		<img src="gallery/logos/thumbs/<?php echo $companyDetails['logo'];?>" width="52" height="52" class="thumbs" />
  <?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
  <?php }}?>

  <?php if (!empty($memberDetails['member_photo'])) {?>
	    <img src="gallery/photos/thumbs/<?php echo $memberDetails['member_photo'];?>" width="52" height="52" class="thumbs" />
  <?php }else {?>
		<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
  <?php }?>

</div>
</td>
<td width="630">
<div class="comment">
	
	<div style="border-bottom: 1px solid #ebebeb; padding-bottom: 10px; padding-left: 10px;">
    <div class="bluefont"><?php echo $memberDetails['first_name'] ?> <?php echo $memberDetails['last_name'] ?></div>
    Email: <a href="mailto:<?php echo $memberDetails['email'] ?>"><?php echo $memberDetails['email'] ?></a><br />
    Designation: <?php echo $memberDetails['designation'] ?>
     <ul id="hide-report">
		<li><a href="#"><img src="images/hide-report-arrow.png" width="10" height="14"></a>
			<ul style="display: block;">
				<li><a href="index.php?view=members&frienddelete=1&fr_id=<?php echo $friend['friend_request_id']?>">Delete</a></li>
				<li><a href="index.php?view=members&report=1&memberId=<?php echo $memberDetails['member_id']?>">Report</a></li>
			</ul>			
			<div class="clear"></div>
		</li>
	</ul>
    </div>
<br />
	<div>
    Functional Area: <?php echo $memberDetails['name'] ?><br />
    Company Type: <?php echo $memberDetails['company_type'] ?><br />
    Telephone: <?php if(!empty($memberDetails['telephone'])) { echo $memberDetails['telephone'];}else{ echo " -";} ?><br />
    Fax: <?php if(!empty($memberDetails['fax'])) { echo $memberDetails['fax']; }else{ echo " - ";} ?><br />    
    </div>
<br />
	<div>
    Location: <?php echo $memberDetails['location'] ?>, <img src="flags/<?php echo strtolower($memberDetails['country_letter']) ?>.png"  /> <?php echo $memberDetails['country'] ?><br />
    Company: <?php echo $companyDetails['company_name'] ?><br />
    Website: <a href="http://<?php echo $companyDetails['website'] ?>" target="_blank"><?php echo $companyDetails['website'] ?></a><br />        
    
    </div>

    <div style="border-top: 1px solid #fff; padding: 10px 0px; text-align:right; padding-right:20px">
		<?php if($count == 0) {?>
						
						<a href="index.php?view=members&friendrequest=1&memberId=<?php echo $memberDetails['member_id']?>">
						 Add Contact /</a>
											
						<?php }?>
						<?php if(empty($memberDetails['company_id'])) {?>
						<?php if(!empty($memberDetails['cv'])) {?>					
						<a href="gallery/files/<?=$memberDetails['cv']?>" target="_blank">View CV</a>				
						<?php }else{ ?>
						View CV 
						<?php } ?>
						<?php if(!empty($memberDetails['portfolio'])) {?>
						<a href="gallery/files/<?=$memberDetails['portfolio']?>" target="_blank">View Portfolio</a>
						<?php }else { ?>
						View Portfolio
						<?php } ?>
						<?php }else { ?>
						<?php if(!empty($companyDetails['portfolio'])) {?>
						<a href="gallery/files/<?=$companyDetails['portfolio']?>" target="_blank">View Portfolio</a>
						<?php }else { ?>
						View Portfolio 
						<?php } ?>
						<?php } ?> / <a href="index.php?view=member_list&from_page=showMember&memberId=<?php echo $memberDetails['member_id']?>">Share</a>
    </div>
   
</div>
</td>
</tr>
<?php if(!empty($updates)) { foreach($updates as $update) {?>
<tr>
<td width="159" valign="top">
<?php if(!empty($update['company_id'])){ if(!empty($update['logo'])) { ?>
	<img src="gallery/logos/thumbs/<?php echo $update['logo'] ?>" width="52" height="52" class="thumbs"/>
<?php }else { ?>
	<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }} ?>

<?php if(!empty($update['member_photo'])) { ?>
	<a href="index.php?view=showMember&memberId=<?php echo $update['member_id']?>"><img src="gallery/photos/thumbs/<?php echo $update['member_photo'] ?>" width="52" height="52" class="thumbs"/></a>
<?php }else { ?>
	<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }?>
</td>
<td width="630">
<div class="comment">

<ul id="hide-report">
<li><a href="#"><img src="images/hide-report-arrow.png" width="10" height="14"></a>
<ul style="display: block;">
<li><a href="index.php?view=member_home&hide=1&updateId=<?php echo $update['id']?>">Hide</a></li>
<li><a href="index.php?view=member_home&report=1&updateId=<?php echo $update['id']?>">Report</a></li>
</ul>			
<div class="clear"></div>
</li>
</ul>
	<div>
	<a href="index.php?view=showMember&memberId=<?php echo $update['member_id']?>"><?php echo $update['first_name']?> <?php echo $update['last_name']?></a> <?php echo $update['update_message']; ?>
	</div>
	<div class="comment_box">
   
				<!--updates for groups table-->
	<?php if($update['table_name'] == 'groups'){
					$sql ="select * from groups where group_id=".$update['ids'];
					$group = $db->fetch($sql);?>
  
                     <a href="index.php?view=showGroup&groupId=<?php echo $group['group_id']?>">
									<?php if (!empty($group['group_image'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $group['group_image'];?>" height="80px" width="80px" class="indent" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="80px" height="80px" class="indent" />
									<?php }?>
									<?php echo $group['group_name']?></a><br />
                                    <span class="caption">Type:</span><?php echo $group['group_type']?><br />
                                    <span class="caption">Website:</span><a href="http://<?php echo $group['website']?>" target="_blank"><?php echo $group['website']?></a>
                                    
                                    <br />
                            
                             <!--updates for group_message table-->       
      <?php }else if($update['table_name'] == 'group_message') { 
									$sql ="select gm.*,g.group_name,g.group_image,g.group_type,g.website from group_message as gm
											left join groups as g on (g.group_id = gm.group_id)
											 where msg_id=".$update['ids'];
									$groupMessage = $db->fetch($sql);
									
									$query ="SELECT * from group_members where member_id = '$memberId' AND group_id = ".$groupMessage['group_id'];
									$memberCount = $db->numrows($query);
									?>
                                
                                     <?php if($memberCount > 0) {?>
                     <a href="index.php?view=showGroup&groupId=<?php echo $groupMessage['group_id']?>">
									<?php if (!empty($groupMessage['group_image'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $groupMessage['group_image'];?>" height="80px" width="80px" class="indent" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="80px" height="80px" class="indent" />
									<?php }?>
									<?php echo $groupMessage['group_name']?></a><br />
                                     <span class="caption">Type:</span><?php echo $groupMessage['group_type']?><br />
                                    <span class="caption">Website:</span><a href="http://<?php echo $groupMessage['website']?>" target="_blank"><?php echo $groupMessage['website']?></a>
                                    <?php }else{ ?>
                                    <?php if (!empty($groupMessage['group_image'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $groupMessage['group_image'];?>" height="80px" width="80px" class="indent" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="80px" height="80px" class="indent" />
									<?php }?>
									<?php echo $groupMessage['group_name']?><br />
                                     <span class="caption">Type:</span><?php echo $groupMessage['group_type']?><br />
                                    <span class="caption">Website:</span><a href="http://<?php echo $groupMessage['website']?>" target="_blank"><?php echo $groupMessage['website']?></a>
                                   
                                    <?php } ?>
                                    <br />
                          
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
              
									<?php if($memberCount > 0) {?>
                     <a href="index.php?view=showGroup&groupId=<?php echo $groupUpdateReply['group_id']?>">
									<?php if (!empty($groupUpdateReply['group_image'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $groupUpdateReply['group_image'];?>" height="80px" width="80px" class="indent" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="80px" height="80px" class="indent" />
									<?php }?>
									<?php echo $groupUpdateReply['group_name']?></a><br />
                                     <span class="caption">Type:</span><?php echo $groupUpdateReply['group_type']?><br />
                                    <span class="caption">Website:</span><a href="http://<?php echo $groupUpdateReply['website']?>" target="_blank"><?php echo $groupUpdateReply['website']?></a>
                                    
                                    <?php }else{ ?>
                                    <?php if (!empty($groupUpdateReply['group_image'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $groupUpdateReply['group_image'];?>" height="80px" width="80px" class="indent" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="80px" height="80px" class="indent" />
									<?php }?>
									<?php echo $groupUpdateReply['group_name']?><br />
                                     <span class="caption">Type:</span><?php echo $groupUpdateReply['group_type']?><br />
                                    <span class="caption">Website:</span><a href="http://<?php echo $groupUpdateReply['website']?>" target="_blank"><?php echo $groupUpdateReply['website']?></a>
                                    <?php } ?>
                                    <br />
                  
                  <!--updates for events table-->                  
	<?php }else if($update['table_name'] == 'events') {
                    $sql ="select *,DATE_FORMAT(event_date,'%d-%m-%Y %h:%i %p') AS eventDate from events where event_id=".$update['ids'];
					$event = $db->fetch($sql);?>

                                    <a href="index.php?view=showEvent&eventId=<?php echo $event['event_id']?>">
								<?php if (!empty($event['image'])) {
									 $info = explode(".",$event['image']);
									if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
										 <img src="gallery/files/<?php echo $event['image'];?>" width="80px;" height="80px;" />
									 <?php }else if($info[1] == 'pdf') { ?>
										<img src="images/icon_pdf.png" width="80px;" height="80px;"/>
									<?php } }else {?>
										<img src="gallery/photos/thumbs/default.jpg" width="80px;" height="80px;" />
									<?php }?>
									<?php echo $event['event_title']?></a><br />
                                    <span class="caption">Date & Time:</span><?php echo $event['eventDate']?><br />
                                    <span class="caption">Location:</span><?php echo $event['location'] ?>
                                    <br />
               
                <!--updates for event_message table-->                    
    <?php }else if($update['table_name'] == 'event_message') { 
									$sql ="select em.*,e.*,DATE_FORMAT(e.event_date,'%d-%m-%Y %h:%i %p') AS eventDate from event_message as em
											left join events as e on (e.event_id = em.event_id)
											 where msg_id=".$update['ids'];
									$eventMessage = $db->fetch($sql);
									
									?>
                                               
                     <a href="index.php?view=showEvent&eventId=<?php echo $eventMessage['event_id']?>">
									<?php if (!empty($eventMessage['image'])) {
										 $info = explode(".",$eventMessage['image']);
										if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
										 <img src="gallery/files/<?php echo $eventMessage['image'];?>" width="80px;" height="80px;" />
										 <?php }else if($info[1] == 'pdf') { ?>
										<img src="images/icon_pdf.png" width="80px;" height="80px;"/>
										<?php } }else {?>
										<img src="gallery/photos/thumbs/default.jpg" width="80px;" height="80px;" />
										<?php }?>
									<?php echo $eventMessage['event_title']?></a><br />
                                    <span class="caption">Date & Time:</span><?php echo $eventMessage['eventDate']?><br />
                                    <span class="caption">Location:</span><?php echo $eventMessage['location'] ?><br />
      
       <!--updates for event_message_reply table-->                             
       <?php } else if($update['table_name'] == 'event_message_reply'){
						 $sql ="SELECT emr.*,em.event_id,e.`event_title`,e.image,e.location,
						 DATE_FORMAT(e.event_date,'%d-%m-%Y %h:%i %p') AS eventDate FROM event_message_reply AS emr 
										LEFT JOIN event_message AS em ON (em.`msg_id` = emr.`msg_id`)
										LEFT JOIN events AS e ON (e.`event_id` = em.`event_id`)
										WHERE emr.reply_id=".$update['ids'];
									$eventUpdateReply = $db->fetch($sql);
									?>
                                   
									<a href="index.php?view=showEvent&eventId=<?php echo $eventUpdateReply['event_id']?>">
									<?php if (!empty($eventUpdateReply['image'])) {
										 $info = explode(".",$eventUpdateReply['image']);
										if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
										 <img src="gallery/files/<?php echo $eventUpdateReply['image'];?>" width="80px;" height="80px;" />
										 <?php }else if($info[1] == 'pdf') { ?>
										<img src="images/icon_pdf.png" width="80px;" height="80px;"/>
										<?php } }else {?>
										<img src="gallery/photos/thumbs/default.jpg" width="80px;" height="80px;" />
										<?php }?>
									<?php echo $eventUpdateReply['event_title']?></a><br />
                                  <span class="caption">Date & Time:</span><?php echo $eventUpdateReply['eventDate']?><br />
                                  <span class="caption">Location:</span><?php echo $eventUpdateReply['location'] ?> <br />
         
          <!--updates for projects table-->   
	<?php }else if($update['table_name'] == 'projects') {
                    $sql ="select p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y ') AS closingDate,m.first_name,m.last_name from projects as p
							left join members as m on (m.member_id =p.member_id)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$update['ids'];
					$project = $db->fetch($sql);?>
                
									<span class="caption">Project Name:</span><a href="index.php?view=tenderDetails&project_id=<?php echo $project['project_id']?>">
									<?php echo $project['project_name']?> (<?php echo $project['project_ref_no']?>)</a><br />
									<span class="caption">Closing Date</span><?php echo $project['closingDate']?><br />
                                    <span class="caption">Location:</span><?php echo $project['project_location']?><br />
               
                <!--updates for projects published to selected members-->               
                <?php  }else if($update['table_name'] == 'projects_selected') {
                    $sql ="select p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closingDate,m.first_name,m.last_name from projects as p
							left join members as m on (m.member_id =p.member_id)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$update['ids'];
					$sproject = $db->fetch($sql);?>
             
              <?php $sql ="SELECT * from share_invites where page='inviteTenders' and id=".$update['ids'];
			  			$shareDetails=$db->fetch($sql);
						?>    
              <?php if($sproject['project_owner'] == $memberId || $shareDetails['to_member_id'] == $memberId ) {?>
									<span class="caption">Project Name:</span><a href="index.php?view=tenderDetails&project_id=<?php echo $sproject['project_id']?>">
									<?php echo $sproject['project_name']?> (<?php echo $sproject['project_ref_no']?>)</a><br />
									<span class="caption">Closing Date:</span><?php echo $sproject['closingDate']?><br />
                                    <span class="caption">Location:</span><?php echo $sproject['project_location']?>
                                    <?php }else{ ?>
                                    <span class="caption">Project Name:</span><?php echo $sproject['project_name']?> (<?php echo $sproject['project_ref_no']?>)<br />
                                    <span class="caption">Closing Date:</span><?php echo $sproject['closingDate']?><br />
                                    <span class="caption">Location:</span><?php echo $sproject['project_location']?>
                                    <?php } ?>
                                    <br />     
                                  
      <!--updates for company_projects table-->                         
      <?php }else if($update['table_name'] == 'company_projects') {
                    $sql ="select p.*,m.first_name,m.last_name from company_projects as p
							left join members as m on (m.member_id =p.project_owner)
							left join company as comp on(comp.company_id = m.company_id) where p.project_id=".$update['ids'];
					$comp_project = $db->fetch($sql);?>
                  
									<span class="caption">Project Name:</span><a href="index.php?view=showProject&companyId=<?php echo $comp_project['companyId']?>&projectId=<?php echo $comp_project['project_id']?>"><?php echo $comp_project['project_name']?> </a><br />
                                    <span class="caption">Type:</span><?php echo $comp_project['project_type']?><br />
                                    <span class="caption">Location:</span><?php echo $comp_project['project_location']?><br />
                               
                               <!--updates for company_project_message table-->
          <?php }else if($update['table_name'] == 'company_project_message') { 
									$sql ="select cpm.*,cp.* from company_project_message as cpm
											left join company_projects as cp on (cp.project_id = cpm.project_id)
											 where msg_id=".$update['ids'];
									$companyProjectMessage = $db->fetch($sql);
									?>
                                
              <span class="caption">Project Name:</span><a href="index.php?view=showProject&companyId=<?php echo $companyProjectMessage['companyId']?>&projectId=<?php echo $companyProjectMessage['project_id']?>">												             
               <?php echo $companyProjectMessage['project_name']?></a><br />
              <span class="caption">Type:</span><?php echo $companyProjectMessage['project_type']?><br />
              <span class="caption">Location:</span><?php echo $companyProjectMessage['project_location']?><br />
                                   <!--updates for company_project_message_reply table--> 
                                     <?php } else if($update['table_name'] == 'company_project_message_reply'){
						 $sql ="SELECT cpmr.*,cpm.project_id,p.`project_name`,p.companyId,p.project_type,p.project_location FROM company_project_message_reply AS cpmr 
										LEFT JOIN company_project_message AS cpm ON (cpm.`msg_id` = cpmr.`msg_id`)
										LEFT JOIN company_projects AS p ON (p.`project_id` = cpm.`project_id`)
										WHERE cpmr.reply_id=".$update['ids'];
									$projectUpdateReply = $db->fetch($sql);
									?>
                                  
									<span class="caption">Project Name:</span><a href="index.php?view=showProject&companyId=<?php echo $projectUpdateReply['companyId']?>&projectId=<?php echo $projectUpdateReply['project_id']?>"><?php echo $projectUpdateReply['project_name']?></a><br />
                        <span class="caption">Type:</span><?php echo $projectUpdateReply['project_type']?><br />
              <span class="caption">Location:</span><?php echo $projectUpdateReply['project_location']?>
                                   <br />
                                   
           <!--updates for the projec_invites table-->                        
        <?php }else if($update['table_name'] == 'project_invites') {
					$sql ="SELECT pp.*,cp.project_name,cp.project_type,cp.project_location,cp.companyId from project_invites as pp
												LEFT JOIN company_projects as cp on (cp.project_id = pp.project_id)
												WHERE pp.project_invite_id=".$update['ids'];
											
							$projectInvite = $db->fetch($sql);?>     
						<span class="caption">Project Name:</span><a href="index.php?view=showProject&companyId=<?php echo $projectInvite['companyId']?>&projectId=<?php echo $projectInvite['project_id']?>"><?php echo $projectInvite['project_name']?> </a><br />
                        <span class="caption">Type:</span><?php echo $projectInvite['project_type']?><br />
                        <span class="caption">Location:</span><?php echo $projectInvite['project_location']?><br />
      
      <!--updates for the project_requests sent-->
                         <?php }else if($update['table_name'] == 'project_requests') {
									    $sql ="SELECT mem.first_name,mem.last_name,pp.*,cp.project_name,cp.project_type,cp.project_location,cp.companyId from project_invites as pp
												LEFT JOIN company_projects as cp on (cp.project_id = pp.project_id)
												LEFT JOIN members as mem on (mem.member_id = pp.to_member_id)
												WHERE pp.project_invite_id=".$update['ids'];
											
											$projectRequest = $db->fetch($sql);?>
                                    <a href="index.php?view=showMember&memberId=<?php echo $projectRequest['to_member_id']?>"><?php echo $projectRequest['first_name']?> <?php echo $projectRequest['last_name']?></a> to view:
     
						<span class="caption">Project Name:</span><a href="index.php?view=showProject&companyId=<?php echo $projectRequest['companyId']?>&projectId=<?php echo $projectRequest['project_id']?>">
						<?php echo $projectRequest['project_name']?> </a><br />
                        <span class="caption">Type:</span><?php echo $projectRequest['project_type']?><br />
                        <span class="caption">Location:</span><?php echo $projectRequest['project_location']?><br />
                        <!--updates for the shortlisting of the projects-->
                         <?php }else if($update['table_name'] == 'project_shortlist') {
									    $sql ="SELECT pp.*,cp.project_name,cp.project_type,cp.project_location,cp.companyId from project_invites as pp
												LEFT JOIN company_projects as cp on (cp.project_id = pp.project_id)
												WHERE pp.project_invite_id=".$update['ids'];
											
											$projectShortlist = $db->fetch($sql);?>
    
						<span class="caption">Project Name:</span><a href="index.php?view=showProject&companyId=<?php echo $projectShortlist['companyId']?>&projectId=<?php echo $projectShortlist['project_id']?>">
						<?php echo $projectShortlist['project_name']?> </a><br />
                        <span class="caption">Type:</span><?php echo $projectShortlist['project_type']?><br />
                        <span class="caption">Location:</span><?php echo $projectShortlist['project_location']?><br />
                        
			<!--updates for the tenders table-->						        
		<?php }else if($update['table_name'] == 'tenders') {
                    $sql ="SELECT mem.first_name,mem.last_name,mem.company_id,comp.company_name,t.*,p.project_id,
					p.project_name,p.project_ref_no,p.member_id as project_owner FROM tenders AS t 
					LEFT JOIN projects AS p ON (p.project_id = t.project_id)
					LEFT JOIN members AS mem ON (mem.member_id = t.member_id)
					LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
					WHERE tender_id=".$update['ids'];
					$tender = $db->fetch($sql);?>

                    <?php if($tender['project_owner'] == $memberId || $tender['member_id'] == $memberId ) {?>
									<span class="caption">Project Name:</span><a href="index.php?view=tenderReceivedDetails&project_id=<?php echo $tender['project_id']?>&tenderId=<?php echo $tender['tender_id']?>">
									<?php echo $tender['project_name']?> (<?php echo $tender['project_ref_no']?>)</a>
                                    <br />
                                    <span class="caption">Budget:</span><?php echo $tender['proposed_budget']?><br />
                                    <span class="caption">Sector:</span><?php echo $tender['sector']?>
                                    
                                    <?php }else { ?>
                                    <span class="caption">Project Name:</span><?php echo $tender['project_name']?> (<?php echo $tender['project_ref_no']?>)<br />
                                    <span class="caption">Sector:</span><?php echo $tender['sector']?>
                                    <?php } ?><br />
		
        <!--updates for the tender_comments table-->							
		<?php }else if($update['table_name'] == 'tender_comments') {
                 $sql ="SELECT tc.*,t.*,p.*,p.member_id AS project_owner,t.member_id AS quotted_by from tender_comments AS tc 
					LEFT JOIN tenders as t ON (t.tender_id = tc.tender_id)
					LEFT JOIN projects AS p ON (p.project_id = t.project_id)
					WHERE tc.tender_comment_id=".$update['ids'];
					$tenderComment = $db->fetch($sql);?>

                    <?php if($tenderComment['project_owner'] == $memberId) {?>
						<span class="caption">Project Name:</span><a href="index.php?view=tenderReceivedDetails&project_id=<?php echo $tenderComment['project_id']?>&tenderId=<?php echo $tenderComment['tender_id']?>">
						<?php echo $tenderComment['project_name']?> (<?php echo $tenderComment['project_ref_no']?>)</a><br />
                        <span class="caption">Budget:</span><?php echo $tenderComment['proposed_budget']?><br />
                        <span class="caption">Sector:</span><?php echo $tenderComment['sector']?>
                                    <br />
                    <?php }else if($tenderComment['quotted_by'] == $memberId){ ?>
						<span class="caption">Project Name:</span><a href="index.php?view=sendQuoteDetails&project_id=<?php echo $tenderComment['project_id']?>&tenderId=<?php echo $tenderComment['tender_id']?>">
						<?php echo $tenderComment['project_name']?> (<?php echo $tenderComment['project_ref_no']?>)</a>	<br />
                        <span class="caption">Budget:</span><?php echo $tenderComment['proposed_budget']?><br />
                        <span class="caption">Sector:</span><?php echo $tenderComment['sector']?>						
					<?php	} else { ?>
                         <span class="caption">Project Name:</span><?php echo $tenderComment['project_name']?> (<?php echo $tenderComment['project_ref_no']?>)<br />
                         <span class="caption">Budget:</span><?php echo $tenderComment['proposed_budget']?><br />
                        <span class="caption">Sector:</span><?php echo $tenderComment['sector']?>
                    <?php } ?><br />
                 
                 <!--updates for the job_openings table-->                   
	<?php }else if($update['table_name'] == 'job_openings') {
                    $sql ="SELECT jo.*,mem.first_name,mem.last_name,mem.company_id,
							DATE_FORMAT(jo.expiry_date,'%d-%m-%Y') AS expiryDate FROM job_openings AS jo
							LEFT JOIN members AS mem ON (mem.member_id = jo.created_by)
							WHERE jo.job_opening_id=".$update['ids'];
					$jobOpening = $db->fetch($sql);?>
                   
									<span class="caption">Job Title:</span><a href="index.php?view=jobOpenings&companyId=<?php echo $jobOpening['company_id']?>"> 			                   <?php echo $jobOpening['title']?></a><br />
                                    <span class="caption">Expiry Date:</span><?php echo $jobOpening['expiryDate']?>
                                    
                                    <br />
         
              <!--updates for the friend_requests table-->                        
	<?php }else if($update['table_name'] == 'friend_requests') {
                    $sql ="SELECT fr.*,mem.first_name,mem.last_name,mem.member_photo,mem.designation,mem.company_id,comp.logo,company_name FROM friend_requests AS fr
							LEFT JOIN members AS mem ON (mem.member_id = fr.from_member_id)
							LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
							WHERE friend_request_id=".$update['ids'];
					$friend = $db->fetch($sql);?>
                    
									<a href="index.php?view=showMember&memberId=<?php echo $friend['from_member_id']?>">
									<?php if(!empty($friend['company_id'])) { if (!empty($friend['logo'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $friend['logo'];?>" width="40" height="40" class="thumbs" />
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="40" height="40" class="thumbs" />
									<?php }}?>
									<?php if (!empty($friend['member_photo'])) {?>
									<img src="gallery/photos/thumbs/<?php echo $friend['member_photo'];?>" width="40" height="40" class="thumbs"/>
									<?php }else {?>
									<img src="gallery/photos/thumbs/default.jpg" width="40" height="40" class="thumbs"/>
									<?php }?>
									<?php echo $friend['first_name']?> <?php echo $friend['last_name']?></a><br />
                                    <?php if(!empty($friend['company_id'])) {?>
                                    <span class="caption">Company:</span><?php echo $friend['company_name']?><br />
                                    <span class="caption">Designation:</span><?php echo $friend['designation']?>
                                    <?php } ?>
                                    <br />
                                    
                                    <!--updates for the job_application table--> 
	<?php } else if($update['table_name'] == 'job_application'){
										$sql ="SELECT *,DATE_FORMAT(expiry_date,'%d-%m-%Y') AS expiryDate FROM job_openings 
									WHERE job_opening_id=".$update['ids'];
									$jobApplication = $db->fetch($sql);
									?>							
                                   
									<span class="caption">Job Title:</span><a href="index.php?view=jobDetails&jobId=<?php echo $jobApplication['job_opening_id']?>"><?php echo $jobApplication['title']?></a><br />
                                    <span class="caption">Expiry Date:</span><?php echo $jobApplication['expiryDate']?><br />
			
            <!--updates for the update_reply table--> 
            <?php } else if($update['table_name'] == 'update_reply'){
						 $sql ="SELECT ur.*,u.`member_id`,mem.`first_name`,mem.`last_name`,mem.member_photo,mem.company_id,mem.designation,comp.logo,comp.company_name FROM update_reply AS ur
								LEFT JOIN updates AS u ON (u.`id` = ur.`update_id`)
								LEFT JOIN members AS mem ON (mem.`member_id` = u.`member_id`)
								LEFT JOIN company as comp ON (comp.company_id = mem.company_id)
								 WHERE reply_id=".$update['ids'];
									$memberUpdateReply = $db->fetch($sql);
									?>
                                  
									<a href="index.php?view=showMember&memberId=<?php echo $memberUpdateReply['member_id']?>">
									<?php if (!empty($memberUpdateReply['company_id'])) { if(!empty($memberUpdateReply['logo'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $memberUpdateReply['logo'];?>" width="40" height="40" class="thumbs"/>
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="40" height="40" class="thumbs" />
									<?php }} 
							if (!empty($memberUpdateReply['member_photo'])) {?>
									<img src="gallery/photos/thumbs/<?php echo $memberUpdateReply['member_photo'];?>" width="40" height="40" class="thumbs"/>
									<?php }else {?>
									<img src="gallery/photos/thumbs/default.jpg" width="40" height="40"class="thumbs" />
									<?php } ?>
									
									<?php echo $memberUpdateReply['first_name']?> <?php echo $memberUpdateReply['last_name']?></a><br />
                                     <?php if(!empty($memberUpdateReply['company_id'])) {?>
                                    <span class="caption">Company:</span><?php echo $memberUpdateReply['company_name']?><br />
                                    <span class="caption">Designation:</span><?php echo $memberUpdateReply['designation']?>
                                    <?php } ?><br />
            
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
									<a href="index.php?view=showMember&memberId=<?php echo $member['member_id']?>">
								<?php if (!empty($member['company_id'])) { if(!empty($member['logo'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $member['logo'];?>" width="40" height="40" class="thumbs"/>
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="40" height="40" class="thumbs"/>
									<?php }} 
							if (!empty($member['member_photo'])) {?>
									<img src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="40" height="40" class="thumbs"/>
									<?php }else {?>
									<img src="gallery/photos/thumbs/default.jpg" width="40" height="40" class="thumbs" />
									<?php } ?>
									<?php echo $member['first_name'];?> <?php echo $member['last_name'] ?></a><br />
									<?php }else if($share['page'] == 'showCompany') {
                        	$sql = "SELECT * from company where company_id=".$share['id'];
							$company = $db->fetch($sql);
							if (!empty($company['logo'])) {?>
									<img src="gallery/logos/thumbs/<?php echo $company['logo'];?>" height="40" width="40"  class="thumbs"/>
									<?php }else {?>
									<img src="gallery/logos/thumbs/default.jpg" width="40" height="40" class="thumbs" />
									<?php } ?>
									<a href="index.php?view=showCompany&companyId=<?php echo $company['company_id']?>"><?php echo $company['company_name']?></a><br />
									<?php }else if($share['page'] == 'tenderReceivedDetails') {
						 	$sql ="SELECT p.project_name,t.* FROM tenders AS t
									LEFT JOIN projects AS p ON (p.project_id = t.project_id)
									WHERE t.tender_id =".$share['id'];
								$projectTender = $db->fetch($sql); ?>
									<span class="caption">Project Name:</span><a href="index.php?view=tenderReceivedDetails&tenderId=<?php echo $projectTender['tender_id']?>"><?php echo $projectTender['project_name'];?></a><br />
                                    <span class="caption">Budget:</span><?php echo $projectTender['proposed_budget']?><br />
                                    <span class="caption">Sector:</span><?php echo $projectTender['sector']?>
									<?php } else if($share['page'] == 'tenderDetails') {
						 	$sql ="SELECT p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closingDate FROM projects AS p
									WHERE p.project_id =".$share['id'];
								$project = $db->fetch($sql); 							
								?>            
									<span class="caption">Project Name:</span>
              <?php if($project['member_id'] == $memberId || $share['to_member_id'] == $memberId ) {?><a href="index.php?view=tenderDetails&project_id=<?php echo $project['project_id']?>"><?php echo $project['project_name'];?></a><br />
              				 <span class="caption">Closing Date:</span><?php echo $project['closingDate']?><br />
                                    <span class="caption">Location:</span><?php echo $project['project_location']?>
              <?php }else{?>
              <span class="caption">Project Name:</span><?php echo $project['project_name'];?><br />
              <span class="caption">Closing Date:</span><?php echo $project['closingDate']?><br />
              <span class="caption">Location:</span><?php echo $project['project_location']?>
              <?php } ?>
              <br />
															
									<?php }else if($share['page'] == 'inviteTenders') {
						 	$sql ="SELECT p.*,DATE_FORMAT(p.closing_date,'%d-%m-%Y') AS closingDate FROM projects AS p
									
									WHERE p.project_id =".$share['id'];
								$sharedproject= $db->fetch($sql); 
									if($sharedproject['member_id'] == $memberId || $share['to_member_id'] == $memberId){?>
                                    <span class="caption">Project Name:</span><a href="index.php?view=tenderDetails&project_id=<?php echo $sharedproject['project_id']?>"><?php echo $sharedproject['project_name'];?></a><br />
                                    <span class="caption">Closing Date:</span><?php echo $sharedproject['closingDate']?><br />
                                    <span class="caption">Location:</span><?php echo $sharedproject['project_location']?>
                                    <?php }else{?>
                                    <span class="caption">Project Name:</span><?php echo $sharedproject['project_name'];?><br />
                                    <span class="caption">Closing Date:</span><?php echo $sharedproject['closingDate']?><br />
                                    <span class="caption">Location:</span><?php echo $sharedproject['project_location']?>
                                    <?php }?>
                                    
                                    <br />
									<?php } ?>
                                
									<?php   }  ?>
                                
    </div>
    <div>
       <?=compare_dates($update['curunixtime'],$update['createdunixtime'])?>. <a href="javascript:void(0)" onclick="displayText('replytext<?php echo $update['id'] ?>')">Reply</a><br /><br />
      <!--This is the section where replies are displayed-->
       <?php $updateId = $update['id'];
						$sql ="SELECT * from update_reply where update_id=".$updateId;
						$replyCount=$db->numrows($sql);
						if($replyCount <3){
						
							$sql="SELECT  ur.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,
							DATE_FORMAT(ur.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(ur.created) AS createdunixtime FROM update_reply  AS ur
									LEFT JOIN members AS mem ON (mem.member_id = ur.send_by)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE ur.update_id = $updateId 
									ORDER BY ur.created  limit 2";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                    <?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
									<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40" height="40" class="thumbs"/>
									<?php }else { ?>
									<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
									<?php } }?>
									<?php if(!empty($reply['member_photo'])) { ?>
									<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" height="40" class="thumbs"/>
									<?php }else { ?>
									<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs"/>
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


<div style="background: #edeff4; width: 500px; margin: auto; 	overflow-x: hidden;">
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
<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40" height="40" class="thumbs"/>
<?php }else { ?>
<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs"/>
<?php } }?>

<?php if(!empty($reply['member_photo'])) { ?>
<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" height="40" class="thumbs"/>
<?php }else { ?>
<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs"/>
<?php }?>
<?php if( $reply['send_by'] == $memberId) {?>
<a href="index.php?view=member_home&delete=1&memberId=<?php echo $update['member_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/delete.png" />Delete</span></a>
<?php } ?>

<a href="index.php?view=showMember&memberId=<?php echo $reply['send_by']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
<?php	echo $reply['message']?> <div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
<hr />

<?php }}?>
</div>
<?php }?>

</div>
       <div id="replytext<?php echo $update['id'] ?>" style="display:none">
										<form method="post">
											<input type="hidden" id="update_id" name="update_id" value="<?php echo $update['id'] ?>" />
											<input type="hidden" id="memberId" name="memberId" value="<?php echo $memberId ?>" />
<table cellpadding="0" cellspacing="0" class="comment_box">
	<tr>
		<td>
			<textarea name="comment" cols="50" rows="1" placeholder="Write a comment..." class="textarea_comment"></textarea>
		</td>
		<td valign="bottom">
			<input type="submit" value="Post">
		</td>
	</tr>
</table>
										</form>
									</div>&nbsp; &nbsp; &nbsp;
    
</div>
</td>
</tr>
<?php } } ?>

</table>    
    </td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
