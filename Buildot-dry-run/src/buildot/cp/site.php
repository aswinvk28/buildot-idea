<?php
$page = isset($_GET['page']) ? $_GET['page'] : null;
$limit = 10;

$loginname = $_SESSION['user']['email'];
?>