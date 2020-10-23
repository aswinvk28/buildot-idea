<?php

$user = '';
$_SESSION['userInfo'] = '';
unset($_SESSION);
header("Location: login.php");
?>