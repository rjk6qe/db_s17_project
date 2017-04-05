<?php
require_once('db_conn.php');
session_start();

$db =DbUtil::create();
$stmt = $db->prepare("SELECT password FROM Constituent WHERE username = ? LIMIT 1");

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
$stmt->bind_result($pass);
$stmt->fetch();

if($stmt->num_rows == 1){
  if(password_verify($password, $pass)){
    $_SESSION['logged_in'] = true;
    $_SESSION['user'] = $username;
    header("Location: ../main/main.php");
    exit();
  }
}

$_SESSION['logged_in'] = false;
$_SESSION['error_msg'] = "Try again, username or password was incorrect";
header("Location: ../register/login.php");

?>

