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

function openURL() {
 win1= window.open('member_list.html','Window1',
'menubar=no,width=430,height=450,scrollbars=yes');
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
<td width="88%"><h2>Received Tender Details</h2></td></tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">

<tr>
<td width="192" valign="top">
<a href="index.php?view=showMember&memberId=<?php echo $tenderReceived['member_id']?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
									<?php if(!empty($tenderReceived['company_id'])) { if(!empty($tenderReceived['logo'])){?>
									<img src="gallery/logos/thumbs/<?php echo $tenderReceived['logo'];?>" width="52" class="thumbs" />
									<?php } else { ?>
									<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
									<?php }} ?></td><td style="padding-top:0px;border:hidden;">
									<?php if(!empty($tenderReceived['member_photo'])){?>
									<img src="gallery/photos/thumbs/<?php echo $tenderReceived['member_photo'];?>" width="52" class="thumbs" />
									<?php } else { ?>
									<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
									<?php } ?>
                                    </td></tr></table>
									</a>

</td>
<td>
<div class="comment">

	
	<div class="comment_box">
    Quotation For: <a href="index.php?view=tenderDetails&project_id=<?php echo $tenderReceived['project_id'] ?>&tenderId=<?php echo $tenderReceived['tender_id']?>"><?php echo $tenderReceived['project_name'] ?> - (<?php echo $tenderReceived['project_ref_no'] ?>)</a><br />
    Proposed Budget: <span class="red"><?php echo $tenderReceived['currency'] ?> <?php echo number_format($tenderReceived['proposed_budget']) ?></span><br />
    Sector: <?php echo $tenderReceived['sector'] ?><br />
    Quotation Received: <?php if(!empty($tenderReceived['attachment'])){ ?>
								<a href="gallery/files/<?=$tenderReceived['attachment']?>" target="_blank"><img src="images/icon_attach.png" width="24px;" />view the attachment</a>
								<?php } ?><br />
    Remarks: <?php echo $tenderReceived['remarks'] ?> <br />
    </div>
    <div>
    <p class="smalltxt"><a href="javascript:void(0)" onclick="displayText('replytext<?php echo $tenderReceived['tender_id'] ?>')">Reply</a>. <a href="index.php?view=member_list&from_page=tenderReceivedDetails&tenderId=<?php echo $tenderReceived['tender_id']?>"> Share (<?php echo $tenderReceived['count']?>)</a></p></div>
    
    <br /><br /><br /><br /><br /><br /><br />
    <?php  $tenderid = $tenderReceived['tender_id'];
 $sql ="SELECT * from tender_comments where tender_id = '$tenderid'";
$tenderCommentsCount = $db->numrows($sql);

if($tenderCommentsCount <3){
$sql = "SELECT tc.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(tc.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(tc.created) AS createdunixtime from tender_comments AS tc
		LEFT JOIN members as mem ON (mem.member_id = tc.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)  where tc.tender_id ='$tenderid'";
$tenderComments= $db->select($sql);
if(!empty($tenderComments)) {
foreach($tenderComments as $tenderComment) { ?>
<div class="replys">
								<span class="co_cat"> <a href="index.php?view=showMember&memberId=<?php echo $tenderComment['member_id']?>">
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
								</a> 
                                <?php if( $tenderComment['member_id'] == $memberId) {?>
								<a href="index.php?view=tenderReceivedDetails&delete=1&tenderId=<?php echo $tenderReceived['tender_id'] ?>&tender_comment_id=<?php echo $tenderComment['tender_comment_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/close.gif" /></span></a>
								<?php } ?>
                                <a href="index.php?view=showMember&memberId=<?php echo $tenderComment['member_id']?>"><?php echo $tenderComment['first_name'] ?>
								<?= $tenderComment['last_name']?>
								</a>:
								<?= $tenderComment['comment']?>
								<div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;">
									<?=compare_dates($tenderComment['curunixtime'],$tenderComment['createdunixtime'])?>
								</div>
								
								</span> <br />
                                <br />
                                </div>
								<?php } }}else{ ?>
								<img src="images/icons/comment.gif" /> <a href="javascript:void(0)" onclick="displayText('reply<?php echo $tenderid ?>')">View all <?php echo $tenderCommentsCount?> Comments</a>
								<div id="reply<?php echo $tenderid ?>" style="display:none">
									<?php	$sql = "SELECT tc.*,mem.first_name,mem.last_name,mem.member_photo,mem.company_id,comp.logo,DATE_FORMAT(tc.created,'%d-%m-%Y %h:%i %p') AS datetime,UNIX_TIMESTAMP() AS curunixtime, UNIX_TIMESTAMP(tc.created) AS createdunixtime from tender_comments AS tc
		LEFT JOIN members as mem ON (mem.member_id = tc.member_id)
		LEFT JOIN company AS comp ON (comp.company_id = mem.company_id)  where tc.tender_id ='$tenderid'";
$tenderComments= $db->select($sql);
if(!empty($tenderComments)) {
foreach($tenderComments as $tenderComment) { ?>
<div class="replys">
									<span class="co_cat"> <a href="index.php?view=showMember&memberId=<?php echo $tenderComment['member_id']?>">
                                    <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
									<?php if(!empty($tenderComment['company_id'])) { ?>
									<?php if(!empty($tenderComment['logo'])){?>
									<img src="gallery/logos/thumbs/<?php echo $tenderComment['logo'];?>" width="40" class="thumbs" />
									<?php } else { ?>
									<img src="gallery/logos/thumbs/default.png" width="40" height="40" class="thumbs"/>
									<?php } }?></td><td style="padding:0px;border:hidden;">
									<?php if(!empty($tenderComment['member_photo'])){?>
									<img src="gallery/photos/thumbs/<?php echo $tenderComment['member_photo'];?>" width="40" class="thumbs"/>
									<?php } else { ?>
									<img src="gallery/photos/thumbs/default.png" width="40" height="40" class="thumbs" />
									<?php } ?>
                                    </td></tr></table>
                                    </a>
                                   <?php if( $tenderComment['member_id'] == $memberId) {?>
                                    <a href="index.php?view=tenderReceivedDetails&delete=1&tenderId=<?php echo $tenderReceived['tender_id'] ?>&tender_comment_id=<?php echo $tenderComment['tender_comment_id']?>"><span class="btn" style="float: right;"><img class="icons" src="<?=IMAGEURL?>icons/close.gif" /></span></a>
                                    	<?php } ?>
									 <a href="index.php?view=showMember&memberId=<?php echo $tenderComment['member_id']?>"><?php echo $tenderComment['first_name'] ?>
									<?= $tenderComment['last_name']?>
									</a>:
									<?= $tenderComment['comment']?>
									<div style="padding-left: 88px; font-size:8pt; color: #999; background: url(images/icons/time.png) no-repeat 70px;">
										<?=compare_dates($tenderComment['curunixtime'],$tenderComment['createdunixtime'])?>
									</div>
									
									</span><br /><br />
								</div>
									<?php }}?>
								</div>
								<?php }?>
                                
								<div id="replytext<?php echo $tenderReceived['tender_id'] ?>" style="width: 520px; background-color:#F3F3F3; border:1px solid #EBEBEB; display:none; float:left; padding:5px 15px 10px 15px;">
					<form method="post">
						<input type="hidden" id="tender_id" name="tender_id" value="<?php echo $tenderReceived['tender_id'] ?>" />
						<textarea name="replytext" cols="50" rows="2" placeholder="Write a comment..." class="commentbox"></textarea><br />
                         <input type="image" value="Post" style="padding-top: 5px;" src="images/post-btn.png" width="46" height="23" >
					</form>
								</div>
</div>
</div>




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
