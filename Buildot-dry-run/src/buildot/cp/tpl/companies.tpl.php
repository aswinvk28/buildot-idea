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
<td width="200" valign="top">&nbsp;</td>

<td width="100%" valign="top">
<!-- middle table start -->

<table cellpadding="0" cellspacing="0" width="100%" align="center" id="co_middle">
<tr>
<th>List of Companies<span style="float: right; padding-right: 10px">(<?php echo $companyCount ?>) Companies</span></th>
</tr>
<tr>
<td>
<div align="left" style="background: #f1f1f1; padding: 5px; box-shadow: 1px 1px 1px 1px #e1e1e1;">
<form name="form" action="" method="post" style="text-align:left">
<label for="search_company"><span style="font-size: 13pt; color: #999; padding-right: 10px;">SEARCH COMPANY</span></label>
<input placeholder="Enter the company" type="text" name="search_company" id="search_company" autocomplete="off" style="color: #aaa; font-size: 14pt; width: 30%; background: #f1f1f1; text-align:left; box-shadow: none; padding: 3px;" />
<input type="submit" name="Go" id="Go"  value="Go"/>
</form>
</div>
</td>
</tr>
<tr>
<td>

<ul class="cp_members" style="padding-left: 0px;">
<?php if(!empty($companies)) { foreach ($companies as $company) {  ?>
<li>
<div style="float: left; margin-right: 20px;"><a href="index.php?view=editCompany&companyId=<?php echo $company['company_id'] ?>"><?php if (!empty($company['logo'])) {?>
 <img src="../gallery/logos/thumbs/<?php echo $company['logo'];?>" width="40" height="40" />
<?php }else {?>
<img src="../gallery/logos/thumbs/default.png" width="40" height="40" />
<?php }?>
</a></div>
<?php if($company['company_status'] == 1){ ?>

<a href="index.php?view=companies&disabled=1&companyId=<?=$company['company_id']?>">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/disable.png"> Disable</span></div></a> 
<?php }else{ ?>
<a href="index.php?view=companies&enabled=1&companyId=<?=$company['company_id']?>">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/enable.png"> Enable</span></div></a> 
<?php } ?>
<a href="index.php?view=companies&delete=1&companyId=<?=$company['company_id']?>" onclick="return confirm('Are you sure you want to delete?')">
<div style="float: right;" class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png">Delete</span></div></a> 
<span class="co_title"> <a href="index.php?view=editCompany&companyId=<?php echo $company['company_id'] ?>"><?php echo $company['company_name'] ?></a></span> <br />
<span class="co_cat">Website:<a href="http://<?php echo $company['website']?>" target="_blank"><?php echo $company['website'] ?></a></span> | 
<span class="co_cat">Portfolio:<?php if(!empty($company['portfolio'])){ ?><a href="../gallery/files/<?=$company['portfolio']?>" target="_blank"><img src="images/icon_pdf.png" /></a><?php }else{ echo "Not Available"; } ?></span><br />
</li>
<?php } }?>

</ul>

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
<!-- right table start --><!-- right table end -->

</td>
</tr>
</table>