<script type="text/javascript">
$().ready(function() {
	$("#search_invite").autocomplete("index.php?view=membersearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
	});
});
</script>

<div id="container">
  <table cellpadding="0" cellspacing="0">
    <tr>
      <td width="209" valign="top"><?php include ("inc_leftbar.tpl.php"); ?></td>
      <td width="791" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="general_table">
          <tr>
            <td>
            <table cellpadding="0" cellspacing="0" style="width: 100%">
                <tr>
                  <td colspan="3" valign="top"><h2>List of Members</h2></td>
                  <td width="14%"><span class="bluefont_lower">(<?php echo $memberCount ?>) members</span></td>
                </tr>
              </table>
              <br />
              <table cellpadding="0" cellspacing="0" width="100%" align="left">
                <tr>
                  <td><form method="post">
                      <input type="hidden" id="projectId" name="projectId" value="<?php echo $projectId?>" />
                      Enter the email:
                      <input type="text" id="email" name="email"/>
                      <input type="submit" value="send invite"/>
                    </form></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>

                      <?php if(!empty($members)) { foreach ($members as $member) {  ?>
                      
<div class="comment comment_box_groups" style="margin-bottom: 10px;">
<div style="float:left; padding-right: 10px;">
  <a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>">
  <table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
<?php if (!empty($member['member_photo'])) {?>
<img class="thumbs" src="gallery/photos/thumbs/<?php echo $member['member_photo'];?>" width="52" />
<?php }else {?>
<img class="thumbs" src="gallery/photos/thumbs/default.png" width="52" height="52" />
<?php }?>
</td></tr></table>
</a></div>
           <a href="index.php?view=showMember&memberId=<?php echo $member['member_id'] ?>"><?php echo $member['first_name'] ?> <?php echo $member['last_name'] ?></a> <br />
             Email:<a href="mailto:<?php echo $member['email'] ?>"><?php echo $member['email'] ?></a><br />
                        
                        <!--checking for tender details-->
                        
                        <?php if(!empty($projectId)) {
		$sql = "SELECT * FROM project_invites 
				WHERE from_member_id = $loggedmember  
				AND to_member_id = ".$member['member_id']." AND project_id ='$projectId'
		UNION 
				SELECT * FROM project_invites 
				WHERE `from_member_id` = ".$member['member_id']." AND `project_id` = '$projectId'";
				$project_Invites = $db->fetch($sql);
				$project_count = $db->numrows($sql);
		   if($project_count == 0) {?>

               <a href="index.php?view=project_invitee_list&projectId=<?php echo $projectId?>&joinrequest=1&to_member_id=<?php echo $member['member_id']?>" ><span class="btn_light" style="float:right;">Invite&nbsp;</span></a>
          <?php }else { ?>
               <a href="index.php?view=project_invitee_list&projectId=<?php echo $projectId?>&stoprequest=1&project_invite_id=<?php echo $project_Invites['project_invite_id']?>" ><span class="btn_light" style="float:right;">Block&nbsp;</span></a>

          <?php }} ?>
</div>   
                      <?php } }else{?>
                      No Records Found
                      <?php } ?>

                    </td>
                </tr>
                <tr>
                  <td align="center"><?=$paginate?></td>
                </tr>
                <tr>
                  <td style="float: right;">&nbsp; <a href="index.php?view=showProject&projectId=<?php echo $projectId ?>">
                    <div class="btn"> &laquo; go back</span></div>
                    </a></td>
                </tr>
              </table></td>
          </tr>
          
          
        </table></td>
    </tr>
  </table>
  </td>
  </tr>
  </table>
</div>
