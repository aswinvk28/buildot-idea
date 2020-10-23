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
<td><h2>send Quote Details</h2></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_gen">

<?php if(!empty($tendersSent)) { foreach ($tendersSent as $tenderSent) {  ?>
<tr>
<td width="218" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($tenderSent['company_id'])) { if(!empty($tenderSent['logo'])){?>
<img src="gallery/logos/thumbs/<?php echo $tenderSent['logo'];?>" width="52" class="thumbs" />
<?php } else { ?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }} ?></td><td style="padding-top:0px;border:hidden;">
<?php if(!empty($tenderSent['member_photo'])){?>
<img src="gallery/photos/thumbs/<?php echo $tenderSent['member_photo'];?>" width="52" class="thumbs" />
<?php } else { ?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php } ?></td></tr></table>
</td>
<td>
<div class="comment">

	<div class="comment_box" style="height:95px;">
    <div class="bluefont"><a href="index.php?view=tenderDetails&project_id=<?php echo $tenderSent['project_id'] ?>"><?php echo $tenderSent['project_name'] ?> - (<?php echo $tenderSent['project_ref_no'] ?>)</a></div>
    Proposed Budget: <span class="red"><?php echo $tenderSent['currency'] ?> <?php echo number_format($tenderSent['proposed_budget']) ?></span><br />
    Sector:<?php echo $tenderSent['sector'] ?><br />
    Quotation Sent: <?php if(!empty($tenderSent['attachment'])){ ?><a href="gallery/files/<?=$tenderSent['attachment']?>" target="_blank">View the attachment:<img src="images/icon_attach.png" width="24" /></a>
								<?php } ?><br />
    Remarks:
<?php echo $tenderSent['remarks'] ?>     

    </div>
<div style="padding:5px;">
<p class="smalltxt"><a href="javascript:void(0)" onclick="displayText('replytext<?php echo $tenderSent['tender_id'] ?>')">Reply</a> 
</p>
</div>
<br /><br /><br /><br /><br /><br />
<?php $tender_id= $tenderSent['tender_id'];
$sql ="SELECT * from tender_comments where tender_id = '$tender_id'";
$tenderCommentsCount = $db->numrows($sql);

if($tenderCommentsCount <3){
$sql = "SELECT tc.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(tc.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(tc.created) AS createdunixtime from tender_comments AS tc
		LEFT JOIN members as mem ON (mem.member_id = tc.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)  where tc.tender_id ='$tender_id'";
$tenderComments= $db->select($sql);
if(!empty($tenderComments)) {
foreach($tenderComments as $tenderComment) { ?>
<div class="replys">
<span class="co_cat">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
<?php if(!empty($tenderComment['company_id'])) { ?>
	<?php if(!empty($tenderComment['logo'])){?>
		<img src="gallery/logos/thumbs/<?php echo $tenderComment['logo'];?>" width="40" class="thumbs" />
	<?php } else { ?>
		<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
	<?php } }?></td><td style="padding:0px;border:hidden;">
	<?php if(!empty($tenderComment['member_photo'])){?>
		<img src="gallery/photos/thumbs/<?php echo $tenderComment['member_photo'];?>" width="40" class="thumbs"/>
	<?php } else { ?>
		<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
	<?php } ?>
    </td></tr></table>
    <?php if( $tenderComment['member_id'] == $memberId) {?>
<a href="index.php?view=sendQuoteDetails&delete=1&tenderId=<?php echo $tenderSent['tender_id'] ?>&tender_comment_id=<?php echo $tenderComment['tender_comment_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/close.gif" /></span></a>
	<?php } ?>
                    
<a href="index.php?view=showMember&memberId=<?php echo $tenderComment['member_id']?>"><?php echo $tenderComment['first_name'] ?> <?= $tenderComment['last_name']?></a>:<?= $tenderComment['comment']?>       
<div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($tenderComment['curunixtime'],$tenderComment['createdunixtime'])?></div>

</span> <br /><br />
</div>
<?php } }}else{ ?>
	<img src="images/icons/comment.gif" /> <a href="javascript:void(0)" onclick="displayText('reply<?php echo $tenderid ?>')">View all <?php echo $tenderCommentsCount?> Comments</a>

	<div id="reply<?php echo $tenderid ?>" style="display:none">
<?php	$sql = "SELECT tc.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(tc.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(tc.created) AS createdunixtime from tender_comments AS tc
		LEFT JOIN members as mem ON (mem.member_id = tc.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)  where tc.tender_id ='$tender_id'";
$tenderComments= $db->select($sql);
if(!empty($tenderComments)) {
foreach($tenderComments as $tenderComment) { ?>
<div class="replys">
<span class="co_cat">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
<?php if(!empty($tenderComment['company_id'])) { ?>
	<?php if(!empty($tenderComment['logo'])){?>
		<img src="gallery/logos/thumbs/<?php echo $tenderComment['logo'];?>" width="40" class="thumbs" />
	<?php } else { ?>
		<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs" />
	<?php } }?></td><td style="padding:0px;border:hidden;">
	<?php if(!empty($tenderComment['member_photo'])){?>
		<img src="gallery/photos/thumbs/<?php echo $tenderComment['member_photo'];?>" width="40" class="thumbs" />
	<?php } else { ?>
		<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
	<?php } ?>
    </td></tr></table>
     <?php if( $tenderComment['member_id'] == $memberId) {?>
<a href="index.php?view=sendQuoteDetails&delete=1&tenderId=<?php echo $tenderSent['tender_id'] ?>&tender_comment_id=<?php echo $tenderComment['tender_comment_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/close.gif" /></span></a>

<a href="index.php?view=showMember&memberId=<?php echo $tenderComment['member_id']?>"><?php echo $tenderComment['first_name'] ?> <?= $tenderComment['last_name']?></a>:<?= $tenderComment['comment']?>       
<div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;"><?=compare_dates($tenderComment['curunixtime'],$tenderComment['createdunixtime'])?></div> 
	
   
					<?php } ?></span> <br /> <br />
	</div>
	<?php }}?>
    </div>
    <?php }?>

<div id="replytext<?php echo $tenderSent['tender_id'] ?>" style="width: 520px; background-color:#F3F3F3; border:1px solid #EBEBEB; display:none; float:left; padding:5px 15px 10px 15px;">
<form method="post">
<input type="hidden" id="tender_id" name="tender_id" value="<?php echo $tenderSent['tender_id'] ?>" />

			<textarea name="comment" cols="50" rows="2" placeholder="Write a comment..." class="commentbox"></textarea><br />
		
			<input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23">
	
</form>
</div>
</div>
</div>

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
