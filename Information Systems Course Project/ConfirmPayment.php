<?php
session_start();
$_SESSION['confirmed'] = "true";
$_SESSION['alert'] = "<h1 class='warn'>Order Processed! Thank You</h1>";

header('Location:order.php');
?>