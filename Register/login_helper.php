<?php
require_once('db_conn.php');
session_start();

$db =DbUtil::create();
$stmt = $db->prepare("SELECT * FROM Constituent WHERE username = ? AND password = ?");

if(!$stmt){
  echo $db->error;
}

$stmt->bind_param("ss", $username, $password);
$username = $_POST["inputUsername"];
$password = $_POST["inputPassword"];
  
if(!$stmt->execute()){
  echo $stmt->error;
}

$stmt -> bind_result($user, $pass);
$stmt -> store_result();
if($stmt->num_rows == 1){
  $_SESSION['logged_in'] = true;
  $_SESSION['user'] = $username;
  header("Location: ../Main/main.html");
}else{
  $_SESSION['logged_in'] = false;
}

?>

