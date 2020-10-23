<style>

</style>

<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"><h2>Companies</h2></td>
	</tr>
<tr>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
<td width="200" valign="top">
<!-- left table start -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" align="center" id="co_left_recent">
				<tr>
					<th>Recent Added Companies</th>
				</tr>
				<tr>
					<td>
						<div class="co_all">
							<ul>
								<?php if(!empty($recentCompanies)) { foreach ($recentCompanies as $recentCompany) {  ?>
<li<?=($company_id == $recentCompany['company_id'])?' class="current"':''?>>
      <div> <a href="index.php?view=editCompany&companyId=<?php echo $recentCompany['company_id'] ?>"><?php echo $recentCompany['company_name'] ?></a> </div>
    </li>
 <?php } } ?>
							</ul>
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

	</tr>
</table>

<!-- left table end -->
</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">
<tr>
<th>Company Details</th>
</tr><tr>
<td>
<form method="post" action="" enctype="multipart/form-data">
<table cellpadding="5" cellspacing="0" width="95%" align="center">
								<tr>
									<td colspan="2">&nbsp;</td>
	<tr>							</tr>
<td><label>Company Name</label></td>
<td><input type="text" id="companyname" name="companyname" value="<?php echo $companyDetails['company_name'] ?>" /></td>
</tr><tr>
<td><label>Website</label></td>
<td><input type="text" id="website" name="website" value="<?php echo $companyDetails['website'] ?>" /></td>
</tr><tr>
<td><label>Logo</label></td>
<td><input id="logo" type="file" class="small" name="logo" /></td>
</tr><tr>
<td><label>Portfolio</label></td>
<td><input id="portfolio" type="file" class="small" name="portfolio" /></td>
</tr><tr>
<td>&nbsp;</td>
<td><input type="submit" value="edit" />
<input type="button" onClick="back()" value="cancel" /></td>
</tr>
</table>
</form>
</td>
</tr>
<tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
</table>
<!-- middle table end -->
</td>

<td width="200" valign="top">
<!-- right table start -->

<!-- right table end -->

</td>
</tr>
</table>