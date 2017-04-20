<?php
session_start();
if(!isset($_SESSION['logged_in'])){
  $_SESSION['logged_in'] = false;
}

if($_SESSION['logged_in'] == false){
  header("Location: ../register/login.php");
}

?>