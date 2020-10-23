<?php
session_start();
include_once('../lib/global.inc.php');
include_once(LIBPATH.'common.inc.php');
include_once(LIBPATH.'db.inc.php');
include_once(LIBPATH.'session.inc.php');
include_once(LIBPATH.'upload.inc.php');
include_once(LIBPATH.'functions.inc.php');

//ini_set("display_errors",0);
$s->checkAdminCP();
$limit = 10;

$ref = $_SERVER['HTTP_REFERER'];


//debug($_SESSION);
$user = $_SESSION['user'];

$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;

if($_REQUEST['view']){
	$view = $_REQUEST['view'];
}else{
	$view = "home";
}
if(isset($_REQUEST['frame']) && ($_REQUEST['frame'] == 1)){
	if(is_file("app/frames/" . $view.".php")){
		require_once("app/frames/" . $view.".php");
	} 
	include_once("tpl/frames/" . $view.".tpl.php");

}else if(isset($_REQUEST["ajax"]) && ($_REQUEST["ajax"] == 1)){ 
	if(is_file("ajax/" . $view.".php")){
		require_once("ajax/" . $view.".php");
	} 

}else{
	if(is_file("app/" . $view.".php")){
		require_once("app/" . $view.".php");
	} 
	include_once("site.php");
	session_write_close();
	include_once("site.tpl.php");
}
//$db->close();
exit;
?>
