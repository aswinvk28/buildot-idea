
<script type="text/javascript" src="js/jquery.form.js"></script>

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

<table border="0" cellspacing="0" cellpadding="0" id="general_table">
  <tr>
    <td>

<table cellpadding="0" cellspacing="0" style="width: 100%">
<tr>
<td width="86%"><h2>Group Details</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_gen">
<tr><td style="line-height: 1px;">&nbsp;</td></tr>
<tr>
<td width="80" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if (!empty($group['group_image'])) {?>
	<img src="gallery/logos/thumbs/<?php echo $group['group_image'];?>" width="52" class="thumbs" />
<?php }else {?>
	<img src="gallery/logos/thumbs/default.jpg" width="52" height="52" class="thumbs" />
<?php }?>
</td></tr></table>
</td>
<td width="685">
<div class="comment">
<span class="bluefont"><?php echo $group['group_name'] ?></span><br />
Type: </span><?php echo $group['group_type']?>
	<div class="comment_box_groups">
    <table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding:0px ">
    <?php if(!empty($group['company_id'])){ if(!empty($group['logo'])) {?> 
		<img src="gallery/logos/thumbs/<?php echo $group['logo'];?>" width="42" class="thumbs" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="42" height="42" class="thumbs" />
	<?php }}?></td><td style="paddingp:0px ">
	<?php if (!empty($group['member_photo'])) {?>
			<img src="gallery/photos/thumbs/<?php echo $group['member_photo'];?>" width="42"  class="thumbs" />
	<?php }else {?>
			<img src="gallery/photos/thumbs/default.png" width="42" height="42" class="thumbs" />
	<?php }?>
	</td></tr></table>
	 <a href="index.php?view=showMember&memberId=<?php echo $group['group_owner']?>"><?php echo $group['first_name']?> <?php echo $group['last_name']?></a>, <a href="index.php?view=showCompany&companyId=<?php echo $group['company_id'] ?>"><?php echo $group['company_name'] ?></a><br />
<br /><br /><br />
    Website: <a href="http://<?php echo $group['website']?>" target="_blank"><?php echo $group['website']?></a><br />
    Privacy: <?php echo $group['privacy']?><br />
    Summary: <?php echo $group['summary']?><br />
    Description:
	<?php echo $group['description']?><br /><br />
    <div class="border">&nbsp;</div>
    <?php if($checkOwner == 0) { if($memberCount == 0) {?>
   	 	<a href="index.php?view=showGroup&joingroup=1&groupId=<?php echo $group['group_id']?>" >
    	<span class="btn_light">JOIN GROUP <img src="images/links-arrow.png" /></span>
   		 </a>
 	<?php }else { ?>
 		<a href="index.php?view=showGroup&amp;leavegroup=1&amp;groupId=<?php echo $group['group_id']?>" >
        	<span class="btn_light">LEAVE GROUP <img src="images/links-arrow.png" /></span>
   		</a>
	<?php } }?>

    </div>
</div>
</td>
</tr>
<tr>
<td colspan="2"><h2>GROUP MEMBERS</h2>

<div id="groups">
<ul id="five">
<?php if(!empty($groupMembers)) { foreach($groupMembers as $groupMember) {?>
<li style="min-height:125px !important;">
<a href="index.php?view=showMember&memberId=<?php echo $groupMember['member_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px;height:80px; float:left;"><tr><td style="padding-top:0px ">
	<?php if(!empty($groupMember['company_id'])) { if(!empty($groupMember['logo'])){?>
			<img class="thumbs" src="gallery/logos/thumbs/<?php echo $groupMember['logo']?>" width="52" />
	<? }else { ?>
			<img class="thumbs" src="gallery/logos/thumbs/default.png" width="52" height="52"  />
	<?php }}?></td><td style="padding-top:0px ">
	<?php if(!empty($groupMember['member_photo'])){?>
			<img class="thumbs" src="gallery/photos/thumbs/<?php echo $groupMember['member_photo']?>" width="52"  />
	<? }else { ?>
			<img class="thumbs" src="gallery/photos/thumbs/default.png" width="52" height="52" />
	<?php }?></td></tr></table></a>
<p><a href="index.php?view=showMember&memberId=<?php echo $groupMember['member_id'] ?>"><?php echo $groupMember['first_name']?> <?php echo $groupMember['last_name']?></a></p>                        
</li>

<?php }} ?>
</ul>
</div>


</td>
</tr>

<tr><td colspan="2"><div class="border" style="width:96%; height:5px;">&nbsp;</div></td></tr>


<tr>
<td colspan="2"><a href="index.php?view=group_members&groupId=<?php echo $groupId?>"><span class="btn_light">MEMBERS LIST <img src="images/links-arrow.png" /></span></a>

<?php if($memberCount <> 0){?>
<script type="text/javascript">
$('document').ready(function()
{
	$('#postComment').ajaxForm(  {
		target: '#index',
		success: function() {
		//$('#formbox').slideUp('fast');
		
		}
	
	});
	
});
</script>
<form method="post" id="postComment">
<input type="hidden" id="groupId" name="groupId" value="<?php echo $group['group_id'] ?>" />
<input type="hidden" id="memberId" name="memberId" value="<?php echo $memberId ?>" />
<input type="hidden" name="aj" value="1" />
<div class="comment_box_wide" style="padding: 10px; margin-top:10px;">
<textarea name="comment" cols="80" rows="2" placeholder="Write a comment..." class="commentbox" style="padding-top: 5px;"></textarea><br />
<input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23" />
</div>
</form>	

</td>
</tr>
<?php if(!empty($groupMessages)) { $co = 1; foreach($groupMessages as $groupMessage) { ?>
<tr>
<td colspan="2">
<table width="100%">
<tr>
<td width="156" valign="top">
 <a href="index.php?view=showMember&memberId=<?php echo $groupMessage['member_id']?>">
 <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;">
	<?php if(!empty($groupMessage['company_id'])) { if(!empty($groupMessage['logo'])) { ?>
		<img src="gallery/logos/thumbs/<?php echo $groupMessage['logo'] ?>" width="52"  class="thumbs" />
	<?php }else { ?>
		<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
	<?php }}?>
    
    </td><td style="padding-top:0px;">
	<?php if(!empty($groupMessage['member_photo'])) { ?>
		<img src="gallery/photos/thumbs/<?php echo $groupMessage['member_photo'] ?>" width="52"  class="thumbs"/>
	<?php }else { ?>
		<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
	<?php }?>
    </td></tr></table>
 </a>
</td>
<td>
<div class="commentareathree">

<div class="clear"></div>
</li>
</ul>
	<div>
	<a href="index.php?view=showMember&memberId=<?php echo $groupMessage['member_id']?>"> <?php echo $groupMessage['first_name']?> <?php echo $groupMessage['last_name']?> : </a>
	</div>
  
	<div class="comment_box_groups">
	<?php echo $groupMessage['message']?>   <?php if($memberId == $groupMessage['member_id']) {?>
                 <a href="index.php?view=showGroup&delete=1&groupId=<?php echo $group['group_id'] ?>&msg_id=<?php echo $groupMessage['msg_id']?>"><span style="float: right;"><img src="images/close.gif" /></span></a>    
<?php } ?><br />
    </div>
   
    <div>
    <p class="smalltxt"><?=compare_dates($groupMessage['curunixtime'],$groupMessage['createdunixtime'])?> . <a href="javascript:void(0)" onclick="displayText('replytext<?php echo $groupMessage['msg_id'] ?>')">Reply</a></p>
</div>
</div>
<!--This section is for the replies of the comments-->

<?php $msgId = $groupMessage['msg_id'];
						$sql ="SELECT * from group_message_reply where msg_id=".$msgId;
						$replyCount=$db->numrows($sql);
						
						if($replyCount <3 || $_REQUEST['reply'] == 1){
						
							$sql="SELECT gm.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(gm.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(gm.created) AS createdunixtime FROM group_message_reply  AS gm
									LEFT JOIN members AS mem ON (mem.member_id = gm.member_id)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE gm.msg_id = '$msgId' 
									ORDER BY gm.created ";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                    <div class="commentareathree replys">
								<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>">
                                <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px ">
								<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
								<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40"  class="thumbs"/>
								<?php }else { ?>
								<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
								<?php }}?></td><td style="padding:0px ">
								<?php if(!empty($reply['member_photo'])) { ?>
								<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40"  class="thumbs"/>
								<?php }else { ?>
								<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
								<?php }?></td></tr></table>
</a>
<!--for the delete-->
<?php if($memberId == $reply['member_id']) {?>
<a href="index.php?view=showGroup&delete=1&groupId=<?php echo $group['group_id'] ?>&reply_id=<?php echo $reply['reply_id']?>">
<span style="float: right;"><img src="images/close.gif" /></span></a>
<?php } ?>
<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:<?php echo $reply['reply_message']?> 

	<div style="width: 200px; padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?>

	</div></div>

                        
								<?php }}}else{?>
								<a href="javascript:void(0)" onclick="displayText('reply<?php echo $groupMessage['msg_id'] ?>')" class="viewcomments" >View all <?php echo $replyCount?> Comments</a>
                                
								<div id="reply<?php echo $groupMessage['msg_id'] ?>" style="display:none">
									<?php $sql="SELECT gm.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(gm.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(gm.created) AS createdunixtime FROM group_message_reply  AS gm
									LEFT JOIN members AS mem ON (mem.member_id = gm.member_id)
									LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
									WHERE gm.msg_id = '$msgId' 
									ORDER BY gm.created ";
								$replies = $db->select($sql);
								if(!empty($replies)){
									foreach($replies as $reply){?>
                                      <div class="commentareathree replys">
									<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px ">
									<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
									<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>"  width="40" class="thumbs"/>
									<?php }else { ?>
									<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs"/>
									<?php }} ?></td><td style="padding:0px ">
									<?php if(!empty($reply['member_photo'])) { ?>
									<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" class="thumbs"/>
									<?php }else { ?>
									<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
									<?php } ?>
                                   </td></tr></table> </a>
                              <!--for the delete button-->
							  <?php if($memberId == $reply['member_id']) {?>
                 <a href="index.php?view=showGroup&delete=1&groupId=<?php echo $group['group_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"><span style="float: right;"><img src="images/close.gif" /></span></a>
<?php } ?>
									<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
									<?php	echo $reply['reply_message']?> 
									<div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?></div>
								
                                    <br />
                                    </div>
									<?php }}?>
								
                               </div>
								<?php }?>
            
            <div id="loading<?php echo $groupMessage['msg_id'] ?>"></div>                  
<div id="replytext<?php echo $groupMessage['msg_id'] ?>"  style="width: 492px; background-color:#F3F3F3; border:1px solid #EBEBEB; display:none; float:left; padding:10px 15px 10px 15px;">
<script type="text/javascript">
$('document').ready(function()
{
	$('#formGroup<?=$co?>').ajaxForm(  {
		target: '#index',
		success: function() {
		//$('#formbox').slideUp('fast');
		
		}
	
	});
	
});
</script>

<form method="post" id="formGroup<?=$co++?>" action="">
<input type="hidden" id="msg_id" name="msg_id" value="<?php echo $groupMessage['msg_id'] ?>" />
<input type="hidden" name="aj" value="1" />
<input type="hidden" name="reply" value="1" />
<textarea style="padding-top: 5px;" name="message" cols="55" rows="2" class="commentbox" placeholder="Write a comment..." id="replytextbox<?php echo $groupMessage['msg_id'] ?>"></textarea><br />
<input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23" onclick="hidebox('<?php echo $groupMessage['msg_id'] ?>')" />
</form>
</div>


</td>
</tr>
</table>
</td>


</tr>
<?php }  }?>
<?php } ?>
</table>    
    
    </td>
  </tr>
</table>

</td>

</tr>
</table>

</div>
