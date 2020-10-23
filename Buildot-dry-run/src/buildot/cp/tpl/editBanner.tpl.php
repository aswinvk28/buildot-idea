
<table cellpadding="" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"></td>
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

<table cellpadding="0" cellspacing="0" width="95%" align="center" id="co_middle">
<tr>
<th>Edit Banner</th>
</tr><tr>
<td>
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" id="banner_id" name="banner_id" value="<?php echo $banner['banner_id']?>" />
<div id="inddiv">


<table cellpadding="10" cellspacing="0" width="95%" align="center">
<tr>
	<td width="241"><label for="title">Banner Title</label></td>
	<td><input type="text" name="title" id="title" value="<?php echo $banner['banner_title']?>"/> <br /> <span id="title_error" class="error_span"></span></td>
</tr>
<tr>
	<td><label for="category">Banner Category</label></td>
	
		<td width="957"><select name="category">
                              <?php foreach($banner_categories as $banner_category){ ?>
                              <option value="<?=$banner_category['banner_cat_id']?>" <?=($banner['banner_cat_id'] == $banner_category['banner_cat_id'])?'Selected':''?>>
                              <?=$banner_category['banner_category']?>
                              </option>
                              <?php } ?>
                            </select></td><br /> <span id="category_error" class="error_span"></span>
	
</tr>
<tr>
	<td><label for="link">Link</label></td>
	<td><input type="text" name="link" id="link" value="<?php echo $banner['link']?>"/>  <br /> <span id="link_error" class="error_span"></span></td>
</tr>

<tr>
<td><label>File</label></td>

<td valign="top"><input id="file" type="file" class="small" name="file" />
<br /><span class="comments">(jpg, png, gif files only)</span>
</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign="top">&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign="top">
	
<p>
<div align="left">
<input type="submit"  id="editBanner" name="editBanner" value="Edit Banner"/>
<input type="submit" id="cancel" name="cancel" value="cancel"/></div>
</p>	
	</td>
</tr>

</table>

</div>


</form>
				
</td>
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