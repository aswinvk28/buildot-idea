<?php

define('DS','/');
define('HOSTNAME','buildot.sample.com');  //machine name
define('SUBFOLDER','buildot/'); //website folder name
define('URL','http://'.$_SERVER['SERVER_NAME'].'/'.SUBFOLDER);
define('SITENAME','buildot.com'); //name of the website
define('SITEURL', DS.SUBFOLDER);
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'].DS.SUBFOLDER);
define('LIBPATH', ROOTPATH.'lib/');
define('IMAGEURL', DS.SUBFOLDER.'images/');
define('JS', DS.SUBFOLDER.'js/');
define('CSS', DS.SUBFOLDER.'css/');

$glob['dbdatabase'] = 'buildot';
$glob['dbhost'] = 'localhost';
$glob['dbusername'] = 'root';
$glob['dbpassword'] = '';
$glob['dbprefix'] = '';

?>