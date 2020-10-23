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
<td width="84%"><h2>LIST OF EVENTS <span class="bluefont">(<?php echo $eventCount ?>)</span></h2></td>
<td width="16%"><a href="index.php?view=createEvent"><div class="createnew">+ Create Event</div></a></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($events)) { foreach ($events as $event) {  ?>
<tr>
<td width="80" valign="top">
<table border="0" cellpadding="0" cellspacing="0" style="width:60px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if (!empty($event['image'])) {
 
$info = explode(".",$event['image']);
if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){
	 ?>
 <a href="index.php?view=showEvent&eventId=<?php echo $event['event_id'] ?>"><img src="gallery/files/<?php echo $event['image'];?>" width="52" class="thumbs" /></a>
 <?php }else if($info[1] == 'pdf') { ?>
 <a href="gallery/files/<?=$event['image'];?>" target="_blank"><img src="images/icon_pdf.png" width="52" height="52" class="thumbs" /></a>
<?php } }else {?>
<a href="index.php?view=showEvent&eventId=<?php echo $event['event_id'] ?>"><img src="gallery/photos/thumbs/default.jpg" width="52" height="52" class="thumbs" /></a>
<?php }?>
</td></tr></table>
</td>
<td width="685">
<div class="comment">

	<div class="comment_box_events_page">
	<?php if($loggedmember == $event['created_by']) {?>
		<ul id="hide-report">
			<li><a href="index.php?view=events&delete=1&eventId=<?=$event['event_id']?>"><img  src="images/close.gif"></a>
							
			</li>
		</ul>
	<?php }?>

    <a href="index.php?view=showEvent&eventId=<?php echo $event['event_id'] ?>"><?php echo $event['event_title'] ?></a><br />
    Location: <span class="bluefont_lower"><?php echo $event['location']?>, <img src="flags/<?php echo strtolower($event['country_letter']) ?>.png"  />  <?php echo $event['country'] ?></span><br />
    Created by: <a href="index.php?view=showMember&memberId=<?php echo $event['created_by']?>"><?php echo $event['first_name']?> <?php echo $event['last_name']?></a><br />    
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
