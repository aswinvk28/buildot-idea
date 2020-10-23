<?php
session_start();
ini_set("display_errors",0);
include_once('lib/global.inc.php');
include_once(LIBPATH.'common.inc.php');
include_once(LIBPATH.'db.inc.php');
include_once(LIBPATH.'session.inc.php');
include_once(LIBPATH.'upload.inc.php');
include_once(LIBPATH.'functions.inc.php');

//$s->checkAdmin();
$limit = 10;

$ref = $_SERVER['HTTP_REFERER'];

//debug($_SESSION);

if(empty($_SESSION['user']['email'])){
	rememberMe();
}
//debug($_SESSION);
$user = $_SESSION['user'];

$page = $_REQUEST['page'];

if($_REQUEST['view']){
	$view = $_REQUEST['view'];
}else{
	$view = "home";
}
if($_REQUEST['frame'] == 1){
	if(is_file("app/frames/" . $view.".php")){
		require_once("app/frames/" . $view.".php");
	} 
	include_once("tpl/frames/" . $view.".tpl.php");

}else if($_REQUEST["ajax"] == 1){ 
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
