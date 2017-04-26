<?php
require_once('../db_conn.php');
require_once('../login_required.php');
session_start();

$db = DbUtil::create();
$stmt_check = $db->prepare("SELECT username FROM Constituent WHERE username=?");
$stmt_check->bind_param("s", $new_username);
$stmt = $db->prepare("UPDATE Constituent SET username=? WHERE username=?");
$stmt->bind_param("ss", $new_username, $current_username);

$current_username = $_SESSION['user'];
$new_username = $_POST['username'];

if(strlen($new_username) < 1){
  $_SESSION['error_msg'] = "Please enter a username";
  header("Location: account.php");
  exit();
}

if(!$stmt_check->execute()){
  echo $stmt_check->error;
}

$stmt_check->store_result();

if($stmt_check->num_rows == 0){
  if(!$stmt->execute()){
    echo $stmt->error;
  } else{
    $_SESSION['user'] = $new_username;
    $_SESSION['success_msg'] = "Successfully changed username";
  }
} else {
  $_SESSION['error_msg'] = "This username already exists";
}


header("Location: account.php");


?>
