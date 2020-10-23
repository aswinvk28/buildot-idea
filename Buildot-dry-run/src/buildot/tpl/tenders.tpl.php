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
<td width="87%"><h2>MY TENDER LIST</h2></td>
<td width="13%"><span class="bluefont_lower">(<?php echo $tenderCount ?> tenders)</span></a></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="my_tender_list">
<?php if(!empty($tenders))  { foreach ($tenders as $tender) {  ?>
<tr>
<td width="155" height="94" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
<?php  if(!empty($tender['company_id'])) { if(!empty($tender['logo'])){?>
<img src="gallery/logos/thumbs/<?php echo $tender['logo'];?>" width="52" class="thumbs" />
<?php } else { ?>
<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php }} ?></td><td style="padding:0px;border:hidden;">
<?php if(!empty($tender['member_photo'])){?>
<img src="gallery/photos/thumbs/<?php echo $tender['member_photo'];?>" width="52" class="thumbs" />
<?php } else { ?>
<img src="gallery/photos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php } ?></td></tr></table>
</td>
<td width="610" valign="top">
<div class="comment">
	<div class="comment_box_tenders_page">
    
<table cellpadding="0" cellspacing="0" width="100%" align="center">

<tr>
<td width="240" valign="top" style="padding:10px 0;border-right:1px solid #ebebeb">
<a href="index.php?view=tenderDetails&project_id=<?php echo $tender['project_id'] ?>"><?php echo $tender['project_name'] ?></a><br />
<?php echo $tender['company_name'] ?>
</td>
<td width="336" valign="top" style="padding:10px 0 20px 10px;">
Opening date:<span class="bluefont"><?php echo $tender['opening_date'] ?></span><br />
Closing date:<span class="bluefont"><?php echo $tender['closing_date'] ?></span><br />
Location:<span class="bluefont"><?php echo $tender['project_location'] ?>, <?php echo $tender['country'] ?></span></a><br />
</td>

<td width="30" align="right" valign="top" style="border-left:1px solid #ebebeb;">
<span style="margin-bottom:15px;display:block"><a href="index.php?view=tenders&delete=1&project_id=<?php echo $tender['project_id']?>"><img src="images/close.gif" /></a></span>    
<br class="clear" />
<img src="flags/<?php echo strtolower($tender['country_letter']) ?>.png"/> 
</td>
</tr>

</table>



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
