<style>

</style>
<script type="text/javascript">
$().ready(function() {
	$("#search_company").autocomplete("index.php?view=companysearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
	});
});
</script>
<br  />
<table cellpadding="0" cellspacing="0" width="100%" align="center">
<tr>
	<td colspan="3" valign="top"><h2>Total Posted Banners <span class="count">(<?php echo $bannerCount ?>)</span></h2></td>
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

<table cellpadding="0" cellspacing="0" width="100%" align="center" id="table_all">
<tr>

<th>Title</th>
<th>Category</th>
<th>Link</th>
<th>Actions</th>
</tr>

<?php if(!empty($banners)){
	foreach($banners as $banner){?>
    <tr>
		<td><a href="index.php?view=showBanner&banner_id=<?php echo $banner['banner_id']?>"><?php echo $banner['banner_title'];?></a></td>
        <td><?php echo $banner['banner_category'];?></td>
        <td><?php echo $banner['link'];?></td>
        <td><a href="index.php?view=editBanner&banner_id=<?php echo $banner['banner_id']?>"><div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/edit.png"> Edit</span></div></a>
            <a href="index.php?view=viewBanners&action=delete&banner_id=<?php echo $banner['banner_id']?>" onclick="return confirm('Are you sure you want to delete?')"><div class="btn"><img class="icons" src="<?=IMAGEURL?>icons/delete.png"> Delete</span></div></a></td>
</tr>
<?php }	}?>

</table>
<!-- middle table end -->
</td>

<td width="200" valign="top">
<!-- right table start -->
<!-- right table end -->

</td>
</tr>
</table>

<div align="center" style="margin-top:20px"><?=$paginate?></div>