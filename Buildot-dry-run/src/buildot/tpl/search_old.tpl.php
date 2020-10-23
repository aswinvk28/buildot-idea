<div id="container", "text">

<!-- middle table start -->
<table cellpadding="0" cellspacing="0" width="95%" align="center">

<td>
<table cellpadding="0" cellspacing="0" width="100%" align="center" id="table_search">
<tr>
	<th>&nbsp;</th>
</tr>
<tr>
<th>
<div class="box"><span class="count">(<?php echo $resultCount?>)</span> Search Result for "<?php echo $key?>"</div>
</th>
</tr>
<?php if(!empty($results)){ foreach($results as $result){ ?>
<tr <?=($i++ %2 == 1)?' class="odd"':''?>>
	<td>&nbsp;</td>
</tr>
<tr <?=($i++ %2 == 1)?' class="odd"':''?>>
<td>
<div class="search_title">
<?php if(!empty($loginname)) { if($search == 1) {?>
<a href="index.php?view=tenderDetails&project_id=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }else if($search == 2){?>
<a href="index.php?view=showCompany&companyId=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }else if($search == 3){?>
<a href="index.php?view=showMember&memberId=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }else if($search == 4){?>
<a href="index.php?view=showGroup&groupId=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }else if($search == 5){?>
<a href="index.php?view=showEvent&eventId=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }else if($search == 6){?>
<a href="index.php?view=jobDetails&jobId=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }else if($search == 7){?>
<a href="index.php?view=showProject&projectId=<?=$result['id']?>">
<?=$result['name']?>
</a>
<?php }}else{?>
<a href="index.php?view=login">
<?=$result['name']?>
</a>
<?php }?>
</div>
</td>
</tr>
<?php } } ?>
<?php if(!is_array($results)){ ?>
<tr>
	<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left">
<h2>No Record Found</h2>
<h3 style="color: #c10000">Please try another Search Keyword</h3>
</td>
</tr>
<?php } ?>
</table>
</div>
</td>
</tr>
<tr>
<td align="center">
<?=$paginate?>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
<!-- middle table end --> 

</div>