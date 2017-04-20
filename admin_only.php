<?php
session_start();
if(!isset($_SESSION['is_admin'])){
  $_SESSION['is_admin'] = false;
}

if($_SESSION['is_admin'] == false){
  header("Location: ../main/main.php");
}

?>