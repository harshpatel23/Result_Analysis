<?php
include 'includes/header.html';
session_start();

$uname = $_POST['username'];
$pwd = $_POST['password'];

$_SESSION['uname'] = $uname;
$_SESSION['user_type'] = $pwd;

header("Location: index.php");

include 'includes/footer.html';
?>


