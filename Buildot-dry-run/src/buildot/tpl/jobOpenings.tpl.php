<style></style>
<script type="text/javascript">
$().ready(function() {
	$("#search_job").autocomplete("index.php?view=jobsearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
	});
});
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
<td width="90%"><h2>Job Openings</h2></td>
<td width="10%"><div class="bluefont_lower">(<?php echo $jobCount ?> jobs)</div></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="jobs">
<?php if(!empty($jobOpenings)) { foreach ($jobOpenings as $jobOpening) {  ?>
<tr>
<td width="674">
  <div class="comment">
    
    <div class="comment_box_groups">
<?php if($loggedmember == $jobOpening['created_by']) {?>
<a href="index.php?view=jobOpenings&delete=1&job_opening_id=<?php echo $jobOpening['job_opening_id']?>"><span style="float: right;"><img src="images/close.gif" /></span>  </a>
<?php } ?>  

      <a href="index.php?view=jobDetails&jobId=<?php echo $jobOpening['job_opening_id']?>">
       Position - <?php echo $jobOpening['title']?><br />
       <?php if(!empty($jobOpening['company_id'])) {?>
     <?php echo $jobOpening['company_name']?>
      <?php }else { ?>
      <?php echo $jobOpening['first_name']?> <?php echo $jobOpening['last_name']?>
      <?php } ?><br />
      Expiry date - <span class="bluefont_lower"><?php echo $jobOpening['expiryDate']?></span> <br />  </a>  
      </div>
  </div>
</td>
</tr>

<?php }} ?>

</table>      
    </td>
  </tr>
  <tr>
					<td align="left">
						<div>
							<?=$paginate?>
						</div>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
  
</table>



</td>

</tr>
</table>

</div>
