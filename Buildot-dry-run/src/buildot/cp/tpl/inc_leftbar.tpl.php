<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left" id="widget_companies">
				<tr>
					<th> COMPANIES </th>
				</tr>
				<tr>
					<td>
						<div class="companies">
							<ul style="width: 179px;">
								<?php foreach ($companies as $company) {  ?>
								<li<?=($company_id == $company['company_id'])?' class="current"':''?>>
									<div> <a href="index.php?view=showCompany&companyId=<?php echo $company['company_id'] ?>"><?php echo $company['company_name'] ?></a> </div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div align="right" class="more">
                        <?php if(!empty($loginname)) {?>
                        <a href="index.php?view=companies">more&raquo;</a>
                        <?php } else {?>
                        <a href="index.php?view=login">more&raquo;</a>
                        <?php } ?>
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
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left" id="widget_members">
				<tr>
					<th> MEMBERS </th>
				</tr>
				<tr>
					<td>
						<?php foreach ($members as $member) {  ?>
                        <?php if (!empty($member['member_photo'])) {?>
						<img src="gallery/photos/thumbs/<?php echo $member['member_photo'] ?>" width="40px;" height="40px;" />
                        <?php }else {?>
						<img src="gallery/photos/thumbs/default.png" width="40" height="40" />
							<?php }?>
						<?php  } ?>
					</td>
				</tr>
				<tr>
					<td>
						<div align="right" class="more">
                        <?php if(!empty($loginname)) {?>
                        <a href="index.php?view=members">more&raquo;</a>
                        <?php } else {?>
                        <a href="index.php?view=login">more&raquo;</a>
                        <?php } ?>
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
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left" id="widget_groups">
				<tr>
					<th> GROUPS </th>
				</tr>
				<tr>
					<td>
						<?php foreach ($groups as $group) { ?>
                        <?php if (!empty($group['group_image'])) {?>
						<img src="gallery/logos/thumbs/<?php echo $group['group_image'] ?>" width="40px;" height="40px;" />
                        <?php }else {?>
							<img src="gallery/logos/thumbs/default.png" width="40" height="40" />
							<?php }?>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td>
						<div align="right" class="more">
                        <?php if(!empty($loginname)) {?>
                        <a href="index.php?view=groups">more&raquo;</a>
                        <?php } else {?>
                        <a href="index.php?view=login">more&raquo;</a>
                        <?php } ?></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="left" id="widget_events">
				<tr>
					<th> EVENTS </th>
				</tr>
				<tr>
					<td>
						<?php foreach ($events as $event) { ?>
                        <?php if (!empty($event['image'])) {?>
						<img src="gallery/photos/thumbs/<?php echo $event['image'] ?>" width="40px;" height="40px;" />
                        <?php }else {?>
							<img src="gallery/photos/thumbs/default.png" width="40" height="40" />
							<?php }?>
						<?php  } ?>
					</td>
				</tr>
				<tr>
					<td>
						<div align="right" class="more">
                        <?php if(!empty($loginname)) {?>
                        <a href="index.php?view=events">more&raquo;</a>
                        <?php } else {?>
                        <a href="index.php?view=login">more&raquo;</a>
                        <?php } ?></div></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
