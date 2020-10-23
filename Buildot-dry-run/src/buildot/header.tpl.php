<script type="text/javascript">
$().ready(function() {
	$("#key").autocomplete("index.php?view=headersearch&ajax=1", {
		width: 260,
		matchContains: true,
		selectFirst: true
	});
});
</script>

<!--  -->

<script type="text/javascript">
	$(document).ready(function(){	

		if (!$.browser.opera) {
    
			// select element styling
			$('select.select').each(function(){
				var title = $(this).attr('title');
				if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
				$(this)
					.css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
					.after('<span class="select">' + title + '</span>')
					.change(function(){
						val = $('option:selected',this).text();
						$(this).next().text(val);
						})
			});

		};
		
	});
</script>

<style>

img{border:none;}

/* */

/* all form DIVs have position property set to relative so we can easily position newly created SPAN */
form div{position:relative;} 

/* setting the width and height of the SELECT element to match the replacing graphics */
select.select{
		position:relative;
		z-index:10;
		width:121px !important;
		height:27px !important;
		line-height:26px;
}

/* dynamically created SPAN, placed below the SELECT */
span.select{
	position:absolute;
	bottom:0;
	float:left;
	left:0;
	width:121px;
	height:27px;
	line-height:26px;
	text-indent:10px;
	background:url(images/arrow.png) no-repeat 0 0;
	cursor:default;
	z-index:1;
	}
.select option {
	background: #ebebeb;
	border:none;
	padding: 5px 5px;
	color:#005aae;	
}
/* first variation (LABEL is above the SELECT) */	
form div.variation1 label{display:block;line-height:26px;}

/* second variation (LABEL is placed on the left of the SELECT) */	
form div.variation2 label{float:left;width:100px;line-height:26px;}
form div.variation2 span.select{left:100px;}

</style>
</head>

</head>


<!-- -->
<div id="menubox"><table width="980" border="0" cellspacing="0" cellpadding="0" align="center" id="header_home">
	<tr>
		<td width="217"><a href="index.php?view=member_home"><img src="images/logo.png" /></a></td>
		<td width="371">&nbsp;</td>
		<td width="391" valign="bottom">
<form action="search.html" method="post">
<table cellpadding="0" cellspacing="0" width="300px" align="right">
<tr>
<td width="7%">
<div style="height:27px;">
<select name="search" id="search" class="select">
<option value="1"<?=($search == 1)?' Selected':''?>>Tenders</option>
<option value="2"<?=($search == 2)?' Selected':''?>>Companies</option>
<option value="3"<?=($search == 3)?' Selected':''?>>Members</option>
<option value="4"<?=($search == 4)?' Selected':''?>>Groups</option>
<option value="5"<?=($search == 5)?' Selected':''?>>Events</option>
<option value="6"<?=($search == 6)?' Selected':''?>>Job Openings</option>
<option value="7"<?=($search == 7)?' Selected':''?>>Projects</option>
</select>
</div>
</td>

<td width="93%" align="right">
<div class="search-right">
<input style="border: none;" type="text" name="key" id="key" placeholder="Search" class="search-right-box" value="<?=$key?>" />
<input type="submit" value="" class="search-rightbtn" style="padding:0px;" />
</div>
</td>

</tr>
</table>

</form>
</div>
        </td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">
<div class="menu">
        
        <div class="tab">
<div class="chromestyle" id="chromemenu">
<ul>
<?php
if(empty($loginname)){?>
	<li><a href="index.php?view=home" class="active">Home</a></li>
    <li><a href="index.php?view=login">Tenders</a></li>
	<li><a href="index.php?view=login">Companies</a></li>
	<li><a href="index.php?view=login">Members</a></li>
	<li><a href="index.php?view=login">Groups</a></li>
	<li><a href="index.php?view=login">Events</a></li>
    <?php } else { ?>
<li><a href="index.php?view=member_home">Home</a></li>
<li><a href="index.php?view=tenders" rel="dropmenu1">Tenders <span class="count_red"><?php if($totalTenders > 0) { ?>(<?php echo $totalTenders ?>)<?php } ?></span></a></li>
<li><a href="index.php?view=companies" rel="dropmenu2">Companies  <span class="count_red"><?php if($projectInvitesCount > 0) { ?>(<?php echo $projectInvitesCount ?>)<?php } ?></span></a></li>
<li><a href="index.php?view=members">Members <span class="count_red"><?php if($friendRequests > 0) { ?>(<?php echo $friendRequests ?>) <?php } ?></span></a></li>
<li><a href="index.php?view=groups" rel="dropmenu3">Groups</a></li>
<li><a href="index.php?view=events" rel="dropmenu4">Events</a></li>	

<li style="float:right; padding-right: 20px;"><a style="border-left: 1px solid #dadada; border-right:none;" href="index.php?view=member_home" rel="dropmenu5"><?php echo $member['first_name']?> <?php echo $member['last_name']?></a></li>	
<?php } ?>
</ul>
</div>

<!--1st drop down menu -->                                                   
<div id="dropmenu1" class="dropmenudiv">
<a href="index.php?view=inviteTenders">Invite Quotation</a>
<a href="index.php?view=tendersReceived">Received Quotation  <span class="count_red"><?php if($unread_receivedtendercount > 0) { ?>(<?php echo $unread_receivedtendercount ?>) <?php } ?></span></a>
<a href="index.php?view=tendersPublished">Tenders published  <span class="count_red"><?php if($unread_projectcount > 0) { ?>(<?php echo $unread_projectcount ?>) <?php } ?></span></a>
<a href="index.php?view=tenders">My tender list</a>
<a href="index.php?view=sendQuotes">Quotation sent</a>
</div>


<!--2nd drop down menu -->                                                
<div id="dropmenu2" class="dropmenudiv">
<a href="index.php?view=companies">View Companies</a>
<a href="index.php?view=projectInvites">Project Invites  <span class="count_red"><?php if($projectInvitesCount > 0) { ?>(<?php echo $projectInvitesCount ?>) <?php } ?></span></a>
<a href="index.php?view=postJob">Post A Job</a>
<a href="index.php?view=jobOpenings">View Job Openings</a>
</div>

<!--3rd drop down menu -->                                                   
<div id="dropmenu3" class="dropmenudiv">
<a href="index.php?view=createGroup">Create a Group</a>
<a href="index.php?view=groups">View Groups</a>
</div>

<!--4th drop down menu -->                                                   
<div id="dropmenu4" class="dropmenudiv">
<a href="index.php?view=createEvent">Create an Event</a>
<a href="index.php?view=events">View Events</a>
</div>


<div id="dropmenu5" class="dropmenudiv_narrow">
<a href="index.php?view=profile">Profile</a>
<?php if(!empty($loginname)) {?> <li><a href="index.php?view=logout">Logout</a></li> <?php } ?>
</div>
<script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>
        </div>
        
        
        </div>		
		</td>
	</tr>
	
</table></div>
