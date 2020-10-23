<!-- right table start -->

<table width="180px;" border="0" cellspacing="0" cellpadding="0" align="right">
	<tr>
		<td align="right">
			<table cellpadding="0" cellspacing="0" align="left" class="widget">
				<tr>
					<td>
						<?php if(!empty($loginname)) { ?>
						<a href="index.php?view=groups">GROUPS</a>
						<?php }else { ?>
						<a href="index.php?view=login">GROUPS</a>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php foreach ($totalgroups as $totalgroup) { ?>
						<?php if (!empty($totalgroup['group_image'])) {?>
						<img src="gallery/logos/thumbs/<?php echo $totalgroup['group_image'] ?>" width="40px;" height="40px;" />
						<?php }else {?>
						<img src="gallery/logos/thumbs/default.png" width="40" height="40" />
						<?php }?>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<div align="right" class="more" style="margin-bottom: 10px;">
							<?php if(!empty($loginname)) {?>
							<a href="index.php?view=groups"><span class="button_more">more&raquo;</span></a>
							<?php } else {?>
							<a href="index.php?view=login"><span class="button_more">more&raquo;</span></a>
							<?php } ?>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #ccc;">&nbsp;</td>
	</tr>
	<tr>
		<td align="right">
			<table cellpadding="0" cellspacing="0" align="left" class="widget">
				<tr>
					<td>
						<?php if(!empty($loginname)) { ?>
						<a href="index.php?view=events"> EVENTS</a>
						<?php }else { ?>
						<a href="index.php?view=login">EVENTS</a>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php foreach ($totalevents as $totalevent) { ?>
						<?php if (!empty($totalevent['image'])) {
 
			$info = explode(".",$totalevent['image']);
			if($info[1] == 'jpg' || $info[1] == 'png' || $info[1] == 'gif'){
			 ?>
						<a href="index.php?view=showEvent&eventId=<?php echo $totalevent['event_id'] ?>"><img src="gallery/files/<?php echo $totalevent['image'];?>" width="40" height="40" /></a>
						<?php }else if($info[1] == 'pdf') { ?>
						<a href="gallery/files/<?=$totalevent['image'];?>" target="_blank"><img src="images/icon_pdf.png" /></a>
						<?php } }else {?>
						<img src="gallery/photos/thumbs/default.jpg" width="40" height="40" />
						<?php }}?>
					</td>
				</tr>
				<tr>
					<td>
						<div align="right" class="more" style="margin-bottom: 10px;">
							<?php if(!empty($loginname)) {?>
							<a href="index.php?view=events"><span class="button_more">more&raquo;</span></a>
							<?php } else {?>
							<a href="index.php?view=login"><span class="button_more">more&raquo;</span></a>
							<?php } ?>
						</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="right">
			<div class="_ads">
				<?php  //echo displayBanner(3); ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="right">
			<div class="_ads">
				<?php  //echo displayBanner(4); ?>
			</div>
		</td>
	</tr>
</table>
<!-- right table end --> 
