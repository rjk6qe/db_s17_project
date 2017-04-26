<?php
require_once('../db_conn.php');
require_once('states.php');
require_once('../login_required.php');

session_start();
$username = $_SESSION['user'];
$state = $_POST["state"];
$states = getStates();
$abbr = array_search($state, $states);

if(!$abbr){
  $_SESSION['error_msg'] = "Please enter a valid state";
  header("Location: account.php");
  exit();
}


$db =DbUtil::create();
$stmt = $db->prepare("UPDATE Constituent SET state=? WHERE username = ?");

if(!$stmt){
  $_SESSION['error_msg'] = "Error updating state";
  echo $db->error;
  header("Location: account.php");
  exit();
}

$stmt->bind_param('ss', $abbr, $username);

if(!$stmt->execute()){
  $_SESSION['error_msg'] = "Error updating state";
  echo $stmt->error;
  header("Location: account.php");
  exit();
}

$_SESSION['success_msg'] = "Updated your state!";
header('Location: account.php');
?>
