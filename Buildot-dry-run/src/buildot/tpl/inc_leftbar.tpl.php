<table cellpadding="0" cellspacing="0" width="209" id="inc_leftbar_simple">
  <tr>
    <td style="padding-right: 10px">
    <?php if(!empty($memDetails['company_id'])) {if(!empty($memDetails['logo'])) { ?>
		<img src="gallery/logos/thumbs/<?php echo $memDetails['logo'] ?>" class="thumbs maxHeight86" width="86" />
	<?php } else { ?>
		<img src="gallery/logos/thumbs/default.png" class="thumbs maxHeight86" width="86" />
	<?php }} ?>
    </td>

    <td>
    <?php if(!empty($memDetails['member_photo'])) { ?>
		<img src="gallery/photos/thumbs/<?php echo $memDetails['member_photo'] ?>" class="thumbs maxHeight86" width="86" />
	<?php }else { ?>
		<img src="gallery/photos/thumbs/default.png" width="86" class="thumbs maxHeight86"/>
	<?php } ?>
    </td>
  </tr>
<tr><td colspan="2" style="padding-top: 10px;">
<div class="bluefont"><?php echo $memDetails['first_name'];?> <?php echo $memDetails['last_name'];?></div>
<div class="blackfont"><?php echo $memDetails['designation'];?></div>
<div class="greyfont"><?php echo $memDetails['company_name'];?></div>
</td></tr> 

<?php if($_REQUEST['view'] == 'companies' ) {?>
<tr>
  <th>&nbsp;</th>
</tr>
				<tr>
					<td colspan="2">
<form method="post" action="index.php?view=companies">
<div class="search-left">
<input class="search-left-box" type="text" id="search_company" name="search_company" />
<input type="submit" value="" class="search-leftbtn" style="padding:0px;" />
</div>
</form>

					</td>
				</tr>
<?php }else if($_REQUEST['view'] == 'members' ){?>
					<tr>
					  <td colspan="2">&nbsp;</td>
  </tr>
					<td colspan="2">
<form method="post" action="index.php?view=members">
<div class="search-left">
<input class="search-left-box" type="text" id="search_mem" name="search_mem" />
<input type="submit" value="" class="search-leftbtn" style="padding:0px;" />
</div>
</form>

					</td>
				</tr>

<?php }else if($_REQUEST['view'] == 'member_list'){?>
				<tr>
					<td colspan="2">
            <?php if(!empty($tenderId)) {?>
				<form method="post" action="index.php?view=member_list&from_page=<?php echo $fromPage?>&tenderId=<?php echo $tenderId ?>">
            <?php } ?>
            <?php if(!empty($projectId)) { ?>
            	<form method="post" action="index.php?view=member_list&from_page=<?php echo $fromPage?>&projectId=<?php echo $projectId ?>">
            <?php } ?>
            <?php if(!empty($project)) { ?>
            	<form method="post" action="index.php?view=member_list&from_page=<?php echo $fromPage?>&project=<?php echo $project ?>">
            <?php } ?>
            <?php if(!empty($companyId)) { ?>
            	<form method="post" action="index.php?view=member_list&from_page=<?php echo $fromPage?>&companyId=<?php echo $companyId ?>">
            <?php } ?>
            <?php if(!empty($sharememberId)){ ?>
            	<form method="post" action="index.php?view=member_list&from_page=<?php echo $fromPage?>&memberId=<?php echo $sharememberId?>">
            <?php } ?>
<div class="search-left">
<input class="search-left-box" type="text" id="search_mem" name="search_mem" />
<input type="submit" value="" class="search-leftbtn" style="padding:0px;" />
</div>
			</form>

					</td>
				</tr>
<?php }else if($_REQUEST['view'] == 'company_projects') { ?>
				<tr>
				  <td colspan="2">&nbsp;</td>
  </tr>
				<tr>
<td colspan="2">
<form method="post" action="index.php?view=company_projects">
<div class="search-left">
<input class="search-left-box" type="text" id="search_prj" name="search_prj" />
<input type="submit" value="" class="search-leftbtn" style="padding:0px;" />
</div>
</form>
</td>
				</tr>
<?php }else if($_REQUEST['view'] == 'project_invitee_list') { ?>
				<tr>
				  <td colspan="2">&nbsp;</td>
  </tr>
				<tr>
<td colspan="2">
<form method="post" action="">
<div class="search-left">
<input class="search-left-box" type="text" id="search_invite" name="search_invite" />
<input type="submit" value="" class="search-leftbtn" style="padding:0px;" />
</div>
</form>
</td>
				</tr>
<?php } ?>
<tr>
<td colspan="2">
<h3>Companies</h3>
<ul class="bullets_left">
<li><a href="index.php?view=companies">View Companies</a></li>
<li><a href="index.php?view=projectInvites">View Project Invites</a></li>
</ul>
</td>
</tr>
<tr>
<td colspan="2">
<h3>Tenders <span class="count_red"><?php if($totalTenders > 0) { ?>(<?php echo $totalTenders ?>)<?php } ?></span></h3>
<ul class="bullets_left">
<li><a href="index.php?view=inviteTenders">Invite Quotation</a></li>
<li><a href="index.php?view=tendersReceived">Received Quotation</a></li>
<li><a href="index.php?view=tendersPublished">Tenders published</a></li>
<li><a href="index.php?view=tenders">My tender list</a></li>
<li><a href="index.php?view=sendQuotes">Quotation sent</a></li>
</ul>
</td>
</tr>

<tr>
<td colspan="2">
<?php if($_REQUEST['view'] == 'tendersReceived'){ ?>
<h3>PROJECTS</h3>
<ul class="bullets_left">
<?php if(!empty($projects)) { foreach ($projects as $project) {  ?>
	<li<?=($project_id == $project['project_id'])?' class="current"':''?>>
	 <div> <a href="index.php?view=tendersReceived&projectId=<?php echo $project['project_id'] ?>">
		<?php   echo $project['project_name'] ?></a></div>
	</li>
<?php } } ?>
<li><span style="float:right"><a href="index.php?view=tendersList">More...</a></span></li>

</ul>
<?php }else if($_REQUEST['view'] == 'tendersPublished' || $_REQUEST['view'] == 'tenders' ) { ?>
<h3>Companies Opening Tenders</h3>
<ul class="bullets_left">
<?php if(!empty($companyTenders)) { foreach ($companyTenders as $companyTender) {  ?>
	<li<?=($company_id == $companyTender['company_id'])?' class="current"':''?>>
	 <div> <a href="index.php?view=tendersPublished&companyId=<?php echo $companyTender['company_id'] ?>"><?php 
	  $company_id = $companyTender['company_id'];
	   if(!empty($company_id)){
	  $sql = "SELECT company_name FROM company 
		WHERE company_id = $company_id";
	  $tenderCompany = $db->fetch($sql);
	  echo $tenderCompany['company_name'] ?> <span class="count">(<?php echo $companyTender['COUNT']?>)</span></a><?php } ?></div>
	</li>
<?php  }} ?>
<li><span style="float:right"><a href="index.php?view=companyTendersList">More...</a></span></li>

</ul>
<?php }else if($_REQUEST['view'] == 'sendQuotes') { ?>
<h3>Projects</h3>
<ul class="bullets_left">
<?php if(!empty($projects)) { foreach ($projects as $project) {  ?>
	<li<?=($project_id == $project['project_id'])?' class="current"':''?>>
	 <div> <a href="index.php?view=sendQuotes&projectId=<?php echo $project['project_id'] ?>"><?php 
	  echo $project['project_name'] ?> </a></div>
	</li>
<?php  }} ?>
<li><span style="float:right"><a href="index.php?view=tendersPublishedList">More...</a></span></li>

</ul>

<?php } else { ?>
<h3>LATEST COMPANIES</h3>
<ul class="bullets_left">
<?php if(!empty($totalcompanies)) { foreach ($totalcompanies as $totalcompany) {  ?>
	<li<?=($company_id == $totalcompany['company_id'])?' class="current"':''?>>
	 <div> <a href="index.php?view=showCompany&companyId=<?php echo $totalcompany['company_id'] ?>"><?php echo $totalcompany['company_name'] ?></a> </div>
	</li>
<?php } ?>
<li><span style="float:right"><a href="index.php?view=companies">More...</a></span></li>

</ul>
<?php }} ?>
</td>
</tr>
</table>
