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
<td><h2>COMPANY DETAILS</h2></td>
</tr>
</table>

<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_gen">
<tr><td colspan="2" style="line-height: 1px;">&nbsp;</td></tr>
<tr>
<td width="153" valign="middle">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px;height:90px; float:left;"><tr><td style="padding-top:0px;border:hidden;">
<?php if(!empty($companyDetails['logo'])){?>
<img class="thumbs" src="gallery/logos/thumbs/<?php echo $companyDetails['logo']?>" width="100"  />
<? }else { ?>
<img class="thumbs" src="gallery/logos/thumbs/default.png" width="100" height="100" />
<?php }?>
</td></tr></table>
</td>
<td width="612">
<div class="comment">


	<div>
    <div class="bluefont"><?php echo $companyDetails['company_name']?></div>
   <a href="http://<?php echo $companyDetails['website']?>" target="_blank"><?php echo $companyDetails['website']?><br />    
    </div>
</div>
</td>
</tr>
<tr>
<td colspan="2">
<div class="comment_box_companies">
<a href="index.php?view=showCompany&friendrequest=1&companyId=<?php echo $companyDetails['company_id']?>">Short List</a> / <?php if(!empty($companyDetails['portfolio'])) {?><a href="gallery/files/<?=$companyDetails['portfolio']?>" target="_blank">View Portfolio</a><?php }else{?>View Porfolio <?php }?> / <a href="index.php?view=member_list&from_page=showCompany&companyId=<?php echo $companyDetails['company_id']?>">Share</a>  <?php if($loggedcompany == $companyId) {?>
<a href="index.php?view=createProject&companyId=<?php echo $companyDetails['company_id']?>"> / Create New Project</a>
<?php } ?>
</div>
</td>
</tr>
</table>    

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
  <td valign="top"><h4>Members</h4></td>
  <td valign="top"><h5>Projects</h5></td>
</tr>

<tr>
<td width="65%" valign="top">
<div id="companies">
<ul id="triple">
<?php if(!empty($companyMembers)) { foreach($companyMembers as $companyMember) { ?>
<li>
<a href="index.php?view=showMember&amp;memberId=<?php echo $companyMember['member_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px;height:90px; float:left;"><tr><td style="padding:0px;border:hidden;">
<?php if(!empty($companyMember['company_id'])) { if(!empty($companyMember['logo'])){?>
<img class="thumbs" src="gallery/logos/thumbs/<?php echo $companyMember['logo']?>" width="52" />
<?php }else { ?>
<img class="thumbs" src="gallery/logos/thumbs/default.png" width="52" height="52" />
<?php }}?></td><td style="padding:0px;border:hidden;">
<?php if(!empty($companyMember['member_photo'])){?>
<img class="thumbs" src="gallery/photos/thumbs/<?php echo $companyMember['member_photo']?>" width="52" />
<?php }else { ?>
<img class="thumbs" src="gallery/photos/thumbs/default.png" width="52" height="52" />
<?php }?>
</td></tr></table>
</a>
<div style="width: 100%; text-align:left;">
<a href="index.php?view=showMember&amp;memberId=<?php echo $companyMember['member_id'] ?>"><?php echo $companyMember['first_name']?> <?php echo $companyMember['last_name']?></a>
        <?php $sql = "SELECT * FROM friend_requests 
WHERE (from_member_id = $loggedmember OR to_member_id= $loggedmember) 
AND( from_member_id = ".$companyMember['member_id']." OR to_member_id =".$companyMember['member_id'].")";
$count = $db->numrows($sql);
if($count == 0){
?>
<a href="index.php?view=members&amp;friendrequest=1&amp;memberId=<?php echo $companyMember['member_id']?>" title="Add Contact"><img src="images/icons/add.gif" /> </a></div>
<?php } ?>                   
</li>

<?php } }?>
</ul>
</div>
<br />
<?php if($companyMemberCount > 0) {?>
<div class="btn_light" style="width: 100px;">
<a href="index.php?view=company_members&companyId=<?php echo $companyId?>">Members List <img src="images/links-arrow.png" /></a>
</div>
<?php }?>

</td>
<td width="35%" valign="top" >
<div id="projects">
<ul>
<?php if(!empty($companyProjects)) { foreach($companyProjects as $companyProject) {?>
<li><a href="index.php?view=showProject&companyId=<?php echo $companyProject['companyId']?>&projectId=<?php echo $companyProject['project_id']?>"><?php echo $companyProject['project_name']?></a></li>
<?php }} ?>
</ul>
</div>
<br />

<?php if($companyProjectsCount > 0) {?>
<div class="btn_light" style="width: 100px;">
<a href="index.php?view=company_projects&companyId=<?php echo $companyId?>">Projects List <img src="images/links-arrow.png" /></a>
</div>
<?php }?>
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
