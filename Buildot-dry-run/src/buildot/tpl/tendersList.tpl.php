<script>

function displayText(id){
	document.getElementById(id).style.display="";
}

function openURL() {
 win1= window.open('member_list.html','Window1',
'menubar=no,width=430,height=450,scrollbars=yes');
}

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
<td width="88%"><h2>List of Tenders</h2></td>
<td width="12%"><span class="bluefont_lower">(<?php echo $projectCount ?> tenders)</span></td>
</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" width="100%" align="left" id="member_home">
 <ul class="bullets_left1">
<?php if(!empty($projects)) { foreach ($projects as $project) { 
?>
   <li>                          
    
    <a href="index.php?view=tendersReceived&projectId=<?php echo $project['project_id'] ?>"><?php echo $project['project_name'] ?> - (<?php echo $project['project_ref_no'] ?>)</a>


</li>
<?php } } ?>
</ul>
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



</td>

</tr>
</table>

</div>
