<?php if($_REQUEST['aj'] != 1){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?=PAGE_TITLE ?>
</title>
<meta name="keywords" content="<?=META_KEYWORDS ?>">
<meta name="description" content="<?=META_DESCRIPTION ?>">

<link re<link rel="stylesheet" href="css/ie_buildot.css" type="text/css" media="all" />

<!--
<link rel="stylesheet" href="css/style-001.css" type="text/css" media="all" />
l="stylesheet" href="css/style-001.css" type="text/css" media="all" />
-->

<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
<script type="text/javascript" src="chromejs/chrome.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/modren.js"></script>
<script type="text/javascript" src="js/buildot-dropdown.js"></script>
<script type="text/javascript" src="<?=JS?>jquery-1.6.4.min.js"></script>
<script type='text/javascript' src='<?=JS?>jquery.autocomplete.js'></script>
<script src="<?=JS?>jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	if(!Modernizr.input.placeholder){
		$("input").each(
			function(){
				if($(this).val()=="" && $(this).attr("placeholder")!=""){
					$(this).val($(this).attr("placeholder"));
					$(this).focus(function(){
						if($(this).val()==$(this).attr("placeholder")) $(this).val("");
					});
					$(this).blur(function(){
						if($(this).val()=="") $(this).val($(this).attr("placeholder"));
					});
				}
		});
	}
});
</script>
<link rel="stylesheet" type="text/css" href="<?=CSS?>jquery.autocomplete.css" />





<?php if($view != "login"){ ?>
<script type="text/javascript">
function disableCompany(){
	// Disable Code Here
}
</script>
<?php } ?>
</head>
<body>
<div align="center">
	<div>
		<?php
		if($view == 'home'){
			include ("header_home.tpl.php");
		}else{
			include ("header.tpl.php");
		}
	 ?>
	</div>
	<div>
		<div id="notification">
			<?php showAdminMessages(); ?>
		</div>
        <div id="wrappermain">
		<div id="index">
		<?php } ?>
			<?php 
       	if (is_file("tpl/".$view.".tpl.php")) {
        	include ("tpl/".$view.".tpl.php");
      	}
      	?>
		<?php if($_REQUEST['aj'] != 1){ ?>
		</div>
		<div>
			<?php include ("footer.tpl.php"); ?>
		</div>
        </div>
	</div>
</div>
</body>
</html>
<?php } ?>