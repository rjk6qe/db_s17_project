<?php
session_start();
$_SESSION['logged_in'] = false;
unset($_SESSION['user']);
unset($_SESSION['user_email']);
unset($_SESSION['is_admin']);
header("Location: ../register/login.php");
?>