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
<td width="88%"><h2>Received Quotation</h2></td>
<td width="12%"><span class="bluefont_lower">(<?php echo $tenderCount ?> tenders)</span></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_home">
<?php if(!empty($tendersReceived)) { foreach ($tendersReceived as $tenderReceived) { 
$sql = "SELECT * from read_tenders where member_id = '$memberId' AND tender_id = ".$tenderReceived['tender_id'];
$count = $db->numrows($sql);
?>
                             
<tr style="background-color: #f3f3f3;">
<td width="154" valign="top"<?=($count == 0)?' class="unread1"':''?>>
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

<td width="627"<?=($count == 0)?' class="unread2"':' class="co_cat"'?>>
<div class="comment">
	<div class="comment_box_read" >
<ul id="hide-report">
			<li><a href="index.php?view=tendersReceived&delete=1&tender_id=<?php echo $tenderReceived['tender_id']?>"><img src="images/close.gif"></a>
						
				<div class="clear"></div>
			</li>
		</ul>      
    <a href="index.php?view=tenderReceivedDetails&project_id=<?php echo $tenderReceived['project_id'] ?>&tenderId=<?php echo $tenderReceived['tender_id']?>"><?php echo $tenderReceived['project_name'] ?> - (<?php echo $tenderReceived['project_ref_no'] ?>)</a><br />
    Proposed Budget: <span class="red"><?php echo $tenderReceived['currency'] ?> <?php echo number_format($tenderReceived['proposed_budget']) ?></span><br />
    Quotted By: <a href="index.php?view=showMember&memberId=<?php echo $tenderReceived['member_id'] ?>"><?php echo $tenderReceived['first_name'] ?> <?php echo $tenderReceived['last_name'] ?></a> - <a href="index.php?view=showCompany&companyId=<?php echo $tenderReceived['company_id'] ?>"><?php echo $tenderReceived['company_name'] ?></a><br />
    </div>

</div>
</td>
</tr>
<tr><td style="line-height: 10px;">&nbsp;</td></tr>
<?php } } ?>

</table>    


    
    </td>
  </tr>
  <tr>
					<td align="center"><?=$paginate?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
</table>



</td>

</tr>
</table>

</div>
