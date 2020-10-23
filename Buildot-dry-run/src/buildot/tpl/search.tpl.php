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

<table cellpadding="0" cellspacing="0" width="100%" align="center" id="table_search">
<tr>
<th>
<div class="box"><span class="count">(<?php echo $resultCount?>)</span> Search Result for "<?php echo $key?>"</div>
</th>


</tr>
<?php if(!empty($results)){ foreach($results as $result){ ?>
<tr <?=($i++ %2 == 1)?' class="odd"':''?>>
<td>
<div class="search_title">

<?php if(!empty($loginname)) { if($search == 1) {?>
<a href="index.php?view=tenderDetails&project_id=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }else if($search == 2){?>
<a href="index.php?view=showCompany&companyId=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }else if($search == 3){?>
<a href="index.php?view=showMember&memberId=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }else if($search == 4){?>
<a href="index.php?view=showGroup&groupId=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }else if($search == 5){?>
<a href="index.php?view=showEvent&eventId=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }else if($search == 6){?>
<a href="index.php?view=jobDetails&jobId=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }else if($search == 7){?>
<a href="index.php?view=showProject&projectId=<?=$result['id']?>"><?=$result['name']?></a> 
<?php }}else{?>
<a href="index.php?view=login"><?=$result['name']?></a> 

<?php }?>
</div>
</td>
</tr>
<?php } } ?>
<?php if(!is_array($results)){ ?>
<tr>
<td align="left">
<h1>No Record Found</h1>
<h1 style="color: #c10000">Please try another Search Keyword</h1>
</td>
</tr>
<?php } ?>
</table>    


    
    </td>
  </tr>
</table>



</td>

</tr>
<tr>
      <td align="center"><?=$paginate?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
</table>

</div>
