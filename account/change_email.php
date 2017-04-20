<?php
require_once('../db_conn.php');
require_once('../login_required.php');
session_start();

$db = DbUtil::create();
$stmt_check = $db->prepare("SELECT email FROM Constituent WHERE email=?");
$stmt_check->bind_param("s", $new_username);
$stmt = $db->prepare("UPDATE Constituent SET email=? WHERE email=?");
$stmt->bind_param("ss", $new_email, $current_email);


$current_email = $_SESSION['user_email'];
$new_email = $_POST['email'];

if(strlen($new_email) < 1){
  $_SESSION['error_msg'] = "Please enter an email address";
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
    $_SESSION['user'] = $new_email;
    $_SESSION['success_msg'] = "Email successfully changed";
  }
} else {
  $_SESSION['error_msg'] = "This email already exists";
}


header("Location: account.php");


?>
