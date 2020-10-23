<script type="text/javascript">
$().ready(function() {
	$("#search_company").autocomplete("index.php?view=companysearch&ajax=1", {
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
<td width="85%"><h2>list of companies</h2></td>
<td width="15%"><div class="bluefont_lower">(<?php echo $companyCount ?> companies)</div></a></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="97%" align="left" id="member_home">
<?php if(!empty($companies)) { foreach ($companies as $company) {  ?>
<tr>
<td width="81" valign="middle">
<a href="index.php?view=showCompany&companyId=<?php echo $company['company_id'] ?>">
<table border="0" cellpadding="0" cellspacing="0" style="width:100px; float:left;"><tr><td style="padding:0px;border:hidden;">
<?php if(!empty($company['logo'])) { ?>
	<img class="thumbs" src="gallery/logos/thumbs/<?php echo $company['logo']?>" width="52" />
<?php }else { ?>
	<img src="gallery/logos/thumbs/default.png" width="52" height="52" class="thumbs" />
<?php } ?>

</td></tr></table>
</a>
</td>
<td width="684">
<div class="comment">


	<div class="comment_box_companies_page" style="widows:100%;">
    <a href="index.php?view=showCompany&companyId=<?php echo $company['company_id'] ?>"><?php echo $company['company_name']?></a><br />
    Website: <a href="http://<?php echo $company['website']?>" target="_blank"><?php echo $company['website']?></a><br />
    Job openings: <a href="index.php?view=jobOpenings&companyId=<?php echo $company['company_id']?>">(<?php echo $company['jobCount']?>)</a><br />
    </div>
</div>
</td>
</tr>

<?php }} ?>

</table>       
    </td>
  </tr>
  
  <tr>
      <td align="center"><div><?=$paginate?></div></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>

</table>

</td>

</tr>
</table>

</div>
