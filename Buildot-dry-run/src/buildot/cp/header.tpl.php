<div id="header_member">
<table cellpadding="0" cellspacing="0" width="980px" align="center">
<tr>
<td width="16%" style="padding-top: 5px;"><a href="index.php?view=home"><img src="images/logo.png" /></a></td>
<td width="58%" class="logo_member">
<div class="wrap">
<ul class="menu">
<?php
if(empty($loginname)){?>
	<li><a href="index.php?view=home" class="active">Home</a></li>
	<li><a href="index.php?view=login">Banners</a></li>
    <li><a href="index.php?view=login">Manage Companies</a></li>
	<li><a href="index.php?view=login">Manage Members</a></li>
	
    <?php } else { ?>
   	<li><a href="index.php?view=home">Dashboard</a></li>
	<li><a href="index.php?view=viewBanners">Banners</a>
    	<ul>
        	<li><a href="index.php?view=addBanner">Add New Banner</a></li>
            <li><a href="index.php?view=viewBanners">View Posted Banners</a></li>
        </ul>
    </li>
    <li><a href="index.php?view=companies">Companies</a></li>
	<li><a href="index.php?view=members">Members</a></li>
    <li><a href="index.php?view=reportedUpdates">Reports</a>
    	<ul>
        	 <li><a href="index.php?view=reportedUpdates">Reported Updates</a>
        	 <li><a href="index.php?view=reportedMembers">Reported Members</a>
        </ul>
    </li>
    <li><a href="index.php?view=profile">Profile</a>	 
	 <?php if(!empty($loginname)) {?> <li><a href="index.php?view=logout">Logout</a></li> <?php } ?>
    <?php } ?>	
	
   
</ul>
</div>
<script type="text/javascript">
$(document).ready(function() {	
	$('#nav li').hover(function() {
		$('ul', this).slideDown(200);
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul', this).slideUp(100);
		$(this).children('a:first').removeClass("hov");		
	});
});
</script>

</td>
<td width="26%" class="logo_member">
<div style="font-size: 20px; color: #e1f1f1; text-align: right;">
<strong><em>Website Control Panel</em></strong>
</div>

</td>
</tr>
</table>
</div>