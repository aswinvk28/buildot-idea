<?php

$user = '';
$_SESSION['user'] = '';
unset($_SESSION);
$date_of_expiry = time() - 60 ;
setcookie( "username", "", $date_of_expiry );
setcookie( "password", "", $date_of_expiry );
header("Location: home.html");
?>