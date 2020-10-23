<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?=PAGE_TITLE ?>
</title>
<meta name="keywords" content="<?=META_KEYWORDS ?>">
<meta name="description" content="<?=META_DESCRIPTION ?>">
<link rel="stylesheet" type="text/css" href="css/buildot_cp.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/nav_all.css" media="all" />
<script type="text/javascript" src="<?=JS?>jquery-1.6.4.min.js"></script>
<script type='text/javascript' src='<?=JS?>jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?=CSS?>jquery.autocomplete.css" />
<link href='http://fonts.googleapis.com/css?family=Voces|Imprima' rel='stylesheet' type='text/css'>
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
		<div id="index">
			<?php 
       	if (is_file("tpl/".$view.".tpl.php")) {
        	include ("tpl/".$view.".tpl.php");
      }
      ?>
		</div>
		<div>
			<?php include ("footer.tpl.php"); ?>
		</div>
	</div>
</div>
</body>
</html>
