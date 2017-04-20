<?php
require_once('../db_conn.php');

session_start();
$db =DbUtil::create();
$check_logged_in_user_stmt = $db->prepare("SELECT password FROM Constituent WHERE username = ? LIMIT 1");
$update_stmt = $db->prepare("UPDATE Constituent SET password=?");

if(!$update_stmt){
  echo $db->error;
  exit();
}
if(!$check_logged_in_user_stmt){
  echo $db->error;
  exit();
}

if($_POST["new_password1"] != $_POST["new_password2"]){
  $_SESSION['error_msg'] = "Passwords do not match";
  header("Location: change_password.php");
  exit();
}

$check_logged_in_user_stmt->bind_param("s", $check_user_param);
$update_stmt->bind_param("s", $set_password);

$check_user_param = $_SESSION['user'];
if(!$check_logged_in_user_stmt->execute()){
  echo $check_logged_in_user_stmt->error;
  exit();
}

$check_logged_in_user_stmt->store_result();
$check_logged_in_user_stmt->bind_result($current_hashed_password);
$check_logged_in_user_stmt->fetch();

if($check_logged_in_user_stmt->num_rows == 0){
  $_SESSION['error_msg'] = "Couldn't find the logged in user";
} else {
  $input_password = $_POST['old_password'];
  if(password_verify($input_password, $current_hashed_password)){
    $set_password = password_hash($_POST['new_password1'], PASSWORD_DEFAULT);
    if(!$update_stmt->execute()){
      echo $update_stmt->error;
      exit();
    } else{
      echo "changed password to " . $_POST['new_password1'];
      $_SESSION['success_msg'] = "Successfully changed password";
      header("Location: account.php");
      exit();
    }
  } else{
    $_SESSION['error_msg'] = "Current password was incorrect";
  }
}

header("Location: change_password.php");
?>
