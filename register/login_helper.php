<?php
require_once('../db_conn.php');
session_start();

$db =DbUtil::create();
$stmt = $db->prepare("SELECT email, password, is_admin, is_active FROM Constituent WHERE username = ? LIMIT 1");

if(!$stmt){
  echo $db->error;
}

$stmt->bind_param("s", $username);
$username = $_POST["inputUsername"];
$password = $_POST["inputPassword"];
  
if(!$stmt->execute()){
  echo $stmt->error;
}

$stmt -> store_result();
$stmt->bind_result($email, $pass, $admin, $is_active);
$stmt->fetch();

$_SESSION['error_msg'] = "Try again, username or password was incorrect";

if($stmt->num_rows == 1){
  if(password_verify($password, $pass)){
    if($is_active){
      $_SESSION['logged_in'] = true;
      $_SESSION['user'] = $username;
      $_SESSION['user_email'] = $email;
      $_SESSION['is_admin'] = $admin;
      unset($_SESSION['error_msg']);
      header("Location: ../main/main.php");
      exit();
    } else {
      $_SESSION['error_msg'] = "You account has been deactivated, please contact your administrator";
    }
  }
}

$_SESSION['logged_in'] = false;
header("Location: ../register/login.php");

?>

