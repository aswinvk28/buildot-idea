<script type="text/javascript" src="js/jquery.form.js"></script>  
<script type="text/javascript">
function hideshow(which){
if (!document.getElementById)
return
if (which.style.display=="none")
which.style.display="block"
else
which.style.display="none"
}
</script>
<script>
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
<td><h2>EVENT DETAILS</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_gen">
<tr><td>&nbsp;</td></tr>
<tr>
<td width="130" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if (!empty($event['image'])) {
 $info = explode(".",$event['image']);
if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){?>
 <img src="gallery/files/<?php echo $event['image'];?>" width="100" class="thumbs" />
 <?php }else if($info[1] == 'pdf') { ?>
 <a href="gallery/files/<?=$event['image'];?>" target="_blank"><img src="images/icon_pdf.png" width="100" height="100" class="thumbs"/></a>
<?php } }else {?>
<img src="gallery/photos/thumbs/default.jpg" width="100" height="100" class="thumbs" />
<?php }?>
</td></tr></table>
</td>
<td width="635">
<div class="comment">

	<div class="comment_box" style="width:532px;">
    <div class="bluefont"><?php echo $event['event_title'] ?></div><br />
    <span style="float:left">Created By:&nbsp;</span>
    <table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
     <?php if(!empty($event['company_id'])){ if(!empty($event['logo'])) {?>
		<img src="gallery/logos/thumbs/<?php echo $event['logo'];?>" width="42"class="thumbs" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="42" height="42" class="thumbs" />
	<?php }}?></td><td style="padding-top:0px;border:hidden;">
	<?php if (!empty($event['member_photo'])) {?>
			<img src="gallery/photos/thumbs/<?php echo $event['member_photo'];?>" width="42"  class="thumbs" />
	<?php }else {?>
			<img src="gallery/photos/thumbs/default.png" width="42" height="42" class="thumbs" />
	<?php }?></td></tr></table>

<div class="block">
    <a href="index.php?view=showMember&memberId=<?php echo $event['created_by']?>"><?php echo $event['first_name']?> <?php echo $event['last_name']?></a><br /><br /><br /><br />
</div>    
    Website: <a href="http://<?php echo $event['website']?>" target="_blank"><?php echo $event['website']?></a><br />
    Location: <span class="bluefont_lower"><?php echo $event['location']?>, <img src="flags/<?php echo strtolower($event['country_letter']) ?>.png"  /> <?php echo $event['country']?></span><br />
    Date & Time: <span class="bluefont_lower"><?php echo $event['datetime']?></span> <br />
    Description: <?php echo $event['description']?>  <br /><br />

<script type="text/javascript">
$('document').ready(function()
{
	$('#postEventComment').ajaxForm(  {
		target: '#index',
		success: function() {
		//$('#formbox').slideUp('fast');
		
		}
	
	});
	
});
</script>

<form method="post" id="postEventComment" action="">
	<input type="hidden" id="eventId" name="eventId" value="<?php echo $event['event_id'] ?>" />
	<input type="hidden" id="member_Id" name="member_Id" value="<?php echo $loggedmemberId ?>" />
	<input type="hidden" name="aj" value="1" />
	<textarea class="commentbox" placeholder="Write a comment..." rows="2" cols="60" name="comment"></textarea>

	<input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23" />


</form>

    </div>
</div>
<br /><br />



<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_home">
<?php if(!empty($eventMessages)) { $co = 1; foreach($eventMessages as $eventMessage) { ?>
<tr>
<td width="154" valign="top">
	<a href="index.php?view=showMember&memberId=<?php echo $eventMessage['member_id']?>">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
			<?php if(!empty($eventMessage['company_id'])) { if(!empty($eventMessage['logo'])) { ?>
				<img src="gallery/logos/thumbs/<?php echo $eventMessage['logo'] ?>" width="52"  class="thumbs"/>
			<?php }else { ?>
				<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
			<?php } }?></td><td style="padding-top:0px;border:hidden;">
			<?php if(!empty($eventMessage['member_photo'])) { ?>
				<img src="gallery/photos/thumbs/<?php echo $eventMessage['member_photo'] ?>" width="52"  class="thumbs"/>
			<?php }else { ?>
				<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
			<?php }?>
            </td></tr></table>
     </a>
</td>
<td width="585" style="border-top:none;">
<div class="comment">

<div class="clear"></div>
		
<a href="index.php?view=showMember&memberId=<?php echo $eventMessage['member_id']?>"> <?php echo $eventMessage['first_name']?> <?php echo $eventMessage['last_name']?> :</a>

 <?php if( $eventMessage['member_id'] == $loggedmemberId ) {?>
<a  href="index.php?view=showEvent&delete=1&eventId=<?php echo $event['event_id'] ?>&msg_id=<?php echo $eventMessage['msg_id']?>"><span style="float: right;"><img src="images/close.gif" /></span></a>

<?php } ?> 
	<div class="comment_box_groups" style="width:400px !important;">
    
<?php echo $eventMessage['message']?> 
   
</div>
<div>
    <p class="smalltxt"><?=compare_dates($eventMessage['curunixtime'],$eventMessage['createdunixtime'])?> . <a href="javascript:void(0)" onclick="displayText('replytext<?php echo $eventMessage['msg_id'] ?>')">Reply</a></p>	
    </div>
    </div>
    <br /><br /> <br /><br /> 
    <!--This is the section for displaying the reply for the comments-->
    <?php $msgId = $eventMessage['msg_id'];
						$sql ="SELECT * from event_message_reply where msg_id=".$msgId;
						$replyCount=$db->numrows($sql);
						
						if($replyCount <3 || $_REQUEST['reply'] == 1){
			
					$sql="SELECT em.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(em.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(em.created) AS createdunixtime FROM event_message_reply  AS em
									LEFT JOIN members AS mem ON (mem.member_id = em.member_id)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE em.msg_id = '$msgId' 
									ORDER BY em.created";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                    <div class="commentbox replys">
								<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>">
								<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
								<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
								<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40" class="thumbs"/>
								<?php }else { ?>
								<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs"/>
								<?php }}?></td><td style="padding:0px;border:hidden;">
								<?php if(!empty($reply['member_photo'])) { ?>
								<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" class="thumbs"/>
								<?php }else { ?>
								<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
								<?php }?>
                                </td></tr></table>
                                </a>
								<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:<?php echo $reply['reply_message']?>
                                <?php if($loggedmemberId == $reply['member_id']) {?>
                 <a href="index.php?view=showEvent&delete=1&eventId=<?php echo $event['event_id'] ?>&reply_id=<?php echo $reply['reply_id']?>">
<span style="float: right;"><img src="images/close.gif" /></span></a>

<?php } ?>
                                <div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
                                <br />
		<br />
        </div>
								<?php }}?><?php }else{?>
                                
								<a href="javascript:void(0)" onclick="displayText('reply<?php echo $eventMessage['msg_id'] ?>')" class="viewcomments">View all <?php echo $replyCount?> Comments</a>
								<div id="reply<?php echo $eventMessage['msg_id'] ?>" style="display:none">
									<?php $sql="SELECT em.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(em.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(em.created) AS createdunixtime FROM event_message_reply  AS em
									LEFT JOIN members AS mem ON (mem.member_id = em.member_id)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE em.msg_id = '$msgId'
									ORDER BY em.created ";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                    <div class="commentbox replys">
                                 <a  href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>">
									<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
									<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
									<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>"  width="40" class="thumbs"/>
									<?php }else { ?>
									<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
									<?php }} ?></td><td style="padding-top:0px;border:hidden;">
									<?php if(!empty($reply['member_photo'])) { ?>
									<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" class="thumbs"/>
									<?php }else { ?>
									<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs"/>
									<?php } ?>
                                    </td></tr></table>
                                 </a>
                               
									<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
									<?php	echo $reply['reply_message']?> 
                                     <?php if( $reply['member_id'] == $loggedmemberId ) {?>
                                    <a  href="index.php?view=showEvent&delete=1&eventId=<?php echo $event['event_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span style="float: right;"><img src="images/close.gif" /></span></a>
<?php } ?>
									<div style="padding-left: 0px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
                                   
                                   
                                 </div>
                                
									<br />
									<?php }}?>
                                     </div>
								
								<?php }?>
 <div id="loading<?php echo $eventMessage['msg_id'] ?>"></div>
<div class="replaytext" id="replytext<?php echo $eventMessage['msg_id'] ?>" style="width: 391px; background-color:#F3F3F3; display:none; float:left; padding:5px 15px 10px 15px;">
<script type="text/javascript">
$('document').ready(function()
{
	$('#formEvent<?=$co?>').ajaxForm(  {
		target: '#index',
		success: function() {
		//$('#formbox').slideUp('fast');
		
		}
	
	});
	
});
</script>
			<form method="post" id="formEvent<?=$co++?>" action="">
			<input type="hidden" id="msg_id" name="msg_id" value="<?php echo $eventMessage['msg_id'] ?>" />
            <input type="hidden" name="aj" value="1" />
            <input type="hidden" name="reply" value="1" />
			<textarea name="message" cols="55" rows="2" placeholder="Write a comment..." class="commentbox" id="replytextbox<?php echo $eventMessage['msg_id'] ?>"></textarea><br />
			<input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23" onclick="hidebox('<?php echo $eventMessage['msg_id'] ?>')">
		
									</form>
								</div> 


</div>
</td>
</tr>

<?php }} ?>

</table>

</td>
</tr>

</table>    
    </td>
  </tr>
</table>



</td>

</tr>
</table>

</div>
