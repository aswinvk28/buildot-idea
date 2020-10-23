<table cellpadding="0" cellspacing="0" width="100%" align="center">
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

<table cellpadding="0" cellspacing="0" width="100%" align="center" id="co_middle">
<tr>
<th>Add a Banner</th>
</tr><tr>
<td>
<form action="" method="post" enctype="multipart/form-data">

<div>


<table cellpadding="10" cellspacing="0" width="100%" align="center" style="padding: 5px 30px 5px 30px;">
<tr>
	<td width="16%"><label for="title">Banner Title</label></td>
	<td width="84%"><input type="text" name="title" id="title" /> <br /> <span id="title_error" class="error_span"></span></td>
</tr>
<tr>
	<td><label for="category">Banner Category</label></td>
	
		<td><select name="category" id="category">
        <option value="">Select A Category</option>
		<?php foreach($bannerCategories as $bannerCategory){ ?>
		<option value="<?php echo $bannerCategory['banner_cat_id'] ?>"><?php echo $bannerCategory['banner_category'] ?></option>
				 <?php } ?>
		</select>
	</td> <br /> <span id="category_error" class="error_span"></span>
	
</tr>
<tr>
	<td><label for="link">Link</label></td>
	<td><input type="text" name="link" id="link" />  <br /> <span id="link_error" class="error_span"></span></td>
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
	<td valign="top"><span>
		<input type="submit"  id="addBanner" name="addBanner" value="Add Banner"/>
	</span></td>
</tr>

</table>

</div>

<p>
<div style="margin-left: 20px;" align="center"></div>
</p>
</form>
				
</td>
</tr>
<tr>
      <td align="left"><div><?=$paginate?></div></td>
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