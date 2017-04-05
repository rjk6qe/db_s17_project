<?php
session_start();
require_once('db_conn.php');
$db =DbUtil::create();
$stmt = $db->prepare("INSERT INTO Constituent (username, password, email) VALUES (?, ?, ?)");

if(!stmt){
  echo $db->error;
}

if($_POST["inputPassword1"] != $_POST["inputPassword2"]){
  $_SESSION['error_msg'] = "Passwords do not match";
  header("Location: ../register/register.php");
  exit();
}


$stmt->bind_param("sss", $username, $password, $email);
$username = $_POST['inputUsername'];
$password = password_hash($_POST["inputPassword1"], PASSWORD_DEFAULT);
$email = $_POST["inputEmail"];
	
//echo "Username is $username <br>";
//echo "Password is $password <br>";
//echo "Email is $email <br>";

if(!$stmt->execute()){
  echo $stmt->error;
}

header("Location: ../register/login.php");
?>
