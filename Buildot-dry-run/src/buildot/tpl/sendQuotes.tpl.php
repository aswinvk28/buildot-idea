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
<td width="88%"><h2>Quotation sent</h2></td>
<td width="12%"><span class="bluefont_lower">(<?php echo $tenderCount ?> tenders)</span></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($tendersSent)) { foreach ($tendersSent as $tenderSent) {  ?>
<tr>
<td width="197" valign="top">
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
	<div class="comment_box">
	<ul id="hide-report">
			<li><a href="index.php?view=sendQuotes&delete=1&tender_id=<?php echo $tenderSent['tender_id']?>"><img src="images/close.gif"></a>
							
				<div class="clear"></div>
			</li>
		</ul>
              
    <a href="index.php?view=sendQuoteDetails&project_id=<?php echo $tenderSent['project_id'] ?>&tenderId=<?php echo $tenderSent['tender_id']?>"><?php echo $tenderSent['project_name'] ?> (<?php echo $tenderSent['project_ref_no'] ?>)</a><br />
    Proposed Budget: <span class="red"><?php echo $tenderSent['currency'] ?> <?php echo number_format($tenderSent['proposed_budget']) ?></span><br />
    </div>

</div>
</td>
</tr>

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
