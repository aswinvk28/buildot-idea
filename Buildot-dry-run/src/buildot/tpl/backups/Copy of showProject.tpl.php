<script type="text/javascript" src="js/jquery.form.js"></script>
<script>
function displayText(id){

document.getElementById(id).style.display="";
}

function hidebox(id){
document.getElementById('replytext'+id).style.display = 'none';
//document.getElementById('replytextbox'+id).value = '';
}

</script>

<div id="container">
<table cellpadding="0" cellspacing="0">
<tr>

<td width="209" valign="top"><?php include ("inc_leftbar.tpl.php"); ?></td>
<td width="791" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="0" id="general_table">
<tr>

<td>

<table cellpadding="0" cellspacing="0" style="width: 100%">
<tr>
<td width="86%"><h2>Project Details</h2></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_gen">
<tr>
<td><div class="bluefont"><?php echo $companyProject['project_name'] ?></div>
<div>Type: <?php echo $companyProject['project_type']?> </div></td>
</tr>
<tr>
<td width="685"><div class="comment">
<div class="comment_box_wide" style="width: 95%;">
<?php if(!empty($companyProject['companyId'])){ if(!empty($companyProject['logo'])) {?>
<img src="gallery/logos/thumbs/<?php echo $companyProject['logo'];?>" width="42" height="42" class="thumbs" />
<?php }else { ?>
<img src="gallery/logos/thumbs/default.png" width="42" height="42" class="thumbs" />
<?php }}?>
<?php if (!empty($companyProject['member_photo'])) {?>
<img src="gallery/photos/thumbs/<?php echo $companyProject['member_photo'];?>" width="42" height="42" class="thumbs"/>
<?php }else {?>
<img src="gallery/photos/thumbs/default.png" width="42" height="42" class="thumbs" />
<?php }?>
<a href="index.php?view=showMember&memberId=<?php echo $companyProject['project_owner']?>"><?php echo $companyProject['first_name']?> <?php echo $companyProject['last_name']?></a>, <a href="index.php?view=showCompany&companyId=<?php echo $companyProject['companyId'] ?>"><?php echo $companyProject['company_name'] ?></a><br />
<br />
<br />
<br />
Website: <a href="http://<?php echo $companyProject['website']?>" target="_blank"><?php echo $companyProject['website']?></a><br />
Location: <span class="bluefont_lower">
<?php  echo $companyProject['project_location'] ?>
, <img src="flags/<?php echo strtolower($companyProject['country_letter']) ?>.png"  /> <?php echo $companyProject['country'] ?></span><br />
Created On: <span class="bluefont_lower"><?php echo $companyProject['project_created']?></span><br />
Description: <?php echo $companyProject['project_description']?><br />
<br />
<div class="border">&nbsp;</div>
<?php if($checkOwner > 0) { ?>
<a href="index.php?view=project_invitee_list&joinproject=1&projectId=<?php echo $companyProject['project_id']?>" > <span class="btn_light">INVITE <img src="images/links-arrow.png" /></span> </a>
<?php }else if($ProjectMemberCount == 0) { ?>
<a href="index.php?view=showProject&amp;joinproject=1&amp;projectId=<?php echo $companyProject['project_id']?>" > <span class="btn_light">SHORTLIST <img src="images/links-arrow.png" /></span> </a>
<?php  }?>
</div>
</div></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="2" style="padding:0px; margin:0px;"><h2>PROJECT MEMBERS</h2>
<div id="groups">
<ul id="five">
<?php if(!empty($ProjectMembers)) { foreach($ProjectMembers as $ProjectMember) {?>
<li style="min-height:85px !important;"> <a href="index.php?view=showMember&memberId=<?php echo $ProjectMember['member_id'] ?>">
<?php if(!empty($ProjectMember['company_id'])) { if(!empty($ProjectMember['logo'])){?>
<img  src="gallery/logos/thumbs/<?php echo $ProjectMember['logo']?>" width="52" height="52" />
<? }else { ?>
<img  src="gallery/logos/thumbs/default.png" width="52" height="52" />
<?php }}?>
<?php if(!empty($ProjectMember['member_photo'])){?>
<img  src="gallery/photos/thumbs/<?php echo $ProjectMember['member_photo']?>" width="52" height="52" />
<? }else { ?>
<img  src="gallery/photos/thumbs/default.png" width="52" height="52" />
<?php }?>
</a>
<p><a href="index.php?view=showMember&memberId=<?php echo $ProjectMember['member_id'] ?>"><?php echo $ProjectMember['first_name']?> <?php echo $ProjectMember['last_name']?></a></p>
</li>
<?php }} ?>
</ul>
</div></td>
</tr>
<tr><td colspan="2"><div class="border" style="width:96%; height:5px;">&nbsp;</div></td></tr>
<tr>
<td colspan="2"><?php if($pmCount > 0) {?>
<a href="index.php?view=project_members&projectId=<?php echo $projectId?>"><span class="btn_light">Members List<img src="images/links-arrow.png" /></a>
<?php } ?>
<br /><br />
<?php 

if($checkOwner > 0 || $ProjectMemberCount >0){?>
<script type="text/javascript">
$('document').ready(function()
{
$('#projectComment').ajaxForm(  {
target: '#index',
success: function() {
//$('#formbox').slideUp('fast');

}

});

});
</script>
<form method="post" id="projectComment" enctype="multipart/form-data">
<input type="hidden" id="projectId" name="projectId" value="<?php echo $projectId ?>" />
<table cellpadding="0" cellspacing="0" border="0" width="50%" class="comment_box">
<tr>
<td colspan="3"><textarea name="comment" cols="83" rows="5" placeholder="Write a comment..."></textarea></td>
</tr>
<tr>
<td colspan="3"> Max number of words – 1000 </td>
</tr>
<tr>
<td width="8%"><input type="image" value="Post" src="images/post-btn.png" style="padding-top: 5px;" width="46" height="23" /></td>
<td width="9%"><input type="reset" value="Cancel" class="cancel_btn" /></td>
<td width="83%"><div id="FileUpload">
<input type="file" name="image" size="24" id="BrowserHidden" onchange="getElementById('FileField').value = getElementById('BrowserHidden').value; return disableForm(this),ajaxUpload(this.form,'imageUpload.html', '','UPLOAD2'); return false;" />
<div id="BrowserVisible">
<input type="text" id="FileField" />
</div>
</div></td>
</tr>
</table>
</form></td>
</tr>
<?php if(!empty($projectMessages)) { $co = 1; foreach($projectMessages as $projectMessage) {?>
<tr>

<td colspan="2">

<table width="100%">
<tr>
<td width="200" valign="top"><a href="index.php?view=showMember&memberId=<?php echo $projectMessage['member_id']?>">
<?php if(!empty($projectMessage['companyId'])) { if(!empty($projectMessage['logo'])) { ?>
<img src="gallery/logos/thumbs/<?php echo $projectMessage['logo'] ?>" width="52" height="52" class="thumbs"/>
<?php }else { ?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }}?>
<?php if(!empty($projectMessage['member_photo'])) { ?>
<img src="gallery/photos/thumbs/<?php echo $projectMessage['member_photo'] ?>" width="52" height="52" class="thumbs"/>
<?php }else { ?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }?>
</a></td>
<td width="563"><div class="commentareatwo">
<div class="clear"></div>
</li>
</ul>
<div> <a href="index.php?view=showMember&memberId=<?php echo $projectMessage['member_id']?>"> <?php echo $projectMessage['first_name']?> <?php echo $projectMessage['last_name']?> :</a> </div>
<?php if($memberId == $projectMessage['member_id']) {?>
<div class="commentwrappbbox"> <a href="index.php?view=showProject&delete=1&projectId=<?php echo $projectMessage['project_id'] ?>&msg_id=<?php echo $projectMessage['msg_id']?>"><span style="float: right;"><img src="images/close.gif" /></span> </a>
<?php } ?>
<div class="comment_box_groups"> <?php echo $projectMessage['message']?>
<?php if(!empty($projectMessage['attachment'])){ ?>
<a href="gallery/files/<?=$projectMessage['attachment']?>" target="_blank"><img src="images/icon_pdf.png" /></a>
<?php } ?>
<br />
</div>
<div>
<p class="smalltxt">
<?=compare_dates($projectMessage['curunixtime'],$projectMessage['createdunixtime'])?>
. <a href="javascript:void(0)" onclick="displayText('replytext<?php echo $projectMessage['msg_id'] ?>')">Reply</a></p>
</div>
</div>
<?php $msgId = $projectMessage['msg_id'];
$sql ="SELECT * from company_project_message_reply where msg_id=".$msgId;
$replyCount=$db->numrows($sql);

if($replyCount <3){

$sql="SELECT cpm.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,
DATE_FORMAT(cpm.created,'%d-%m-%Y %h:%i %p') AS date_time,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(cpm.created) AS createdunixtime FROM company_project_message_reply  AS cpm
LEFT JOIN members AS mem ON (mem.member_id = cpm.member_id)
LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
WHERE cpm.msg_id = '$msgId' 
ORDER BY cpm.created limit 2";
$replies = $db->select($sql);
if(!empty($replies)){
foreach($replies as $reply){?>
<div class="commentarea1">
<div class="imgareabox">
<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" width="40" height="40" class="thumbs"/>
<?php }else { ?>
<img src="gallery/logos/thumbs/default.png" width="40 " height="40" class="thumbs"/>
<?php }}?>
<?php if(!empty($reply['member_photo'])) { ?>
<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" height="40" class="thumbs"/>
<?php }else { ?>
<img src="gallery/photos/thumbs/default.png" width="40 " height="40" class="thumbs"/>
<?php }?>
</div>
<div class="messageareabox">
<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:<?php echo $reply['reply_message']?>
<?php if(!empty($reply['attachment'])){ ?>
<a href="gallery/files/<?=$reply['attachment']?>" target="_blank"><img src="images/icon_pdf.png" /></a>
<?php } ?>
<div style="width: 100%; padding-left: 0px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;">
<?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?>
</div>
</div>
<!--delete option-->
<?php if($memberId == $reply['member_id']) {?>
<a style="float:right;" href="index.php?view=showProject&delete=1&projectId=<?php echo $companyProject['project_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"> <span style="float: right;"><img src="<?=IMAGEURL?>icons/close.gif"></img></span> </a>
<?php } ?>

</div>
<br />
<?php }}}else{?>
<a href="javascript:void(0)" onclick="displayText('reply<?php echo $projectMessage['msg_id'] ?>')">View all <?php echo $replyCount?> Comments</a>
<div id="reply<?php echo $projectMessage['msg_id'] ?>" style="display:none">
<?php $sql="SELECT cpm.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,
comp.logo,DATE_FORMAT(cpm.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(cpm.created) AS createdunixtime FROM company_project_message_reply  AS cpm
LEFT JOIN members AS mem ON (mem.member_id = cpm.member_id)
LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)
WHERE cpm.msg_id = '$msgId' 
ORDER BY cpm.created ";
$replies = $db->select($sql);
if(!empty($replies)){
foreach($replies as $reply){?>
<?php if(!empty($reply['company_id'])) { if(!empty($reply['logo'])) { ?>
<div class="commentarea1">
<div class="imgareabox">
<img src="gallery/logos/thumbs/<?php echo $reply['logo'] ?>" height="40" width="40" class="thumbs"/>
<?php }else { ?>
<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs"/>
<?php }} ?>
<?php if(!empty($reply['member_photo'])) { ?>
<img src="gallery/photos/thumbs/<?php echo $reply['member_photo'] ?>" width="40" height="40" class="thumbs"/>
<?php }else { ?>
<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
<?php } ?>
</div>
<div class="messageareabox">
<a href="index.php?view=showMember&memberId=<?php echo $reply['member_id']?>"><?php echo $reply['first_name']?> <?php echo $reply['last_name']?></a>:
<?php	echo $reply['reply_message']?>
<?php if(!empty($reply['attachment'])){ ?>
<a href="gallery/files/<?=$reply['attachment']?>" target="_blank"><img src="images/icon_pdf.png" /></a>
<?php } ?>

<div style="padding-left: 0px; width:100%;float:left; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;">
<?=compare_dates($reply['curunixtime'],$reply['createdunixtime'])?>
</div>
</div>
<!--delete option-->
<?php if($memberId == $reply['member_id']) {?>
<a href="index.php?view=showProject&delete=1&projectId=<?php echo $companyProject['project_id'] ?>&reply_id=<?php echo $reply['reply_id']?>"> <span style="float: right;"><img src="<?=IMAGEURL?>icons/close.gif"></img></span> </a> </div>
</div>

<?php } ?>


<br />
<?php }}?>
</div>
</div>
</div>

<?php }?>
<div id="replytext<?php echo $projectMessage['msg_id'] ?>" style="width: 480px; background-color:#F3F3F3; border:1px solid #EBEBEB; display:none; float:left; padding:5px 15px 10px 15px;margin-top:15px;"> 
<script type="text/javascript">
$('document').ready(function()
{
$('#formProject<?=$co?>').ajaxForm(  {
target: '#index',
success: function() {
//$('#formbox').slideUp('fast');

}

});

});
</script>
<form method="post" enctype="multipart/form-data" id="formProject<?=$co++?>" action="">
<input type="hidden" id="msg_id" name="msg_id" value="<?php echo $projectMessage['msg_id'] ?>" />
<input type="hidden" name="aj" value="1" />
<table cellpadding="0" cellspacing="0" border="0" width="50%" class="comment_box" style="width:480px !important;">
<tr>
<td colspan="3"><textarea name="message" cols="55" rows="2" placeholder="Write a comment..." class="commentbox" style="padding-top: 5px;" id="replytextbox<?php echo $projectMessage['msg_id'] ?>"></textarea></td>
</tr>
<tr>
<td colspan="3"> Max number of words – 1000 </td>
</tr>
<tr>
<td width="10%"><input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23" onclick="hidebox('<?php echo $projectMessage['msg_id'] ?>')"/></td>
<td width="12%"><input type="reset" value="Cancel" class="cancel_btn" /></td>
<td width="78%"><div id="FileUpload">
<input type="file" name="file" size="24" id="BrowserHidden" onchange="getElementById('FileField').value = getElementById('BrowserHidden').value; return disableForm(this),ajaxUpload(this.form,'imageUpload.html', '','UPLOAD2'); return false;" />
<div id="BrowserVisible">
<input type="text" id="FileField" />
</div>
</div></td>
</tr>
</table>
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
