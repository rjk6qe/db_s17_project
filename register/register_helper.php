<?php
session_start();
require_once('../db_conn.php');
$db =DbUtil::create();
$stmt_check = $db->prepare("SELECT email FROM Constituent WHERE username = ?");
$stmt = $db->prepare("INSERT INTO Constituent (username, password, email, state, district) VALUES (?, ?, ?, ?, ?)");

if(!$stmt){
  echo $db->error;
}
if($stmt_check){
  echo $db->error;
}

if($_POST["inputUsername"] == ''){
  $_SESSION['error_msg'] = "Please enter a username!";
  header("Location: ../register/register.php");
  exit();

}

if($_POST["inputPassword1"] != $_POST["inputPassword2"]){
  $_SESSION['error_msg'] = "Passwords do not match";
  header("Location: ../register/register.php");
  exit();
}

$stmt_check->bind_param("s", $username);
$stmt->bind_param("ssssi", $username, $password, $email, $state, $district);
$username = $_POST['inputUsername'];

if(!$stmt_check->execute()){
  echo $stmt_check->error;
}

$stmt_check -> store_result();

if($stmt_check->num_rows != 0){
  $_SESSION['error_msg'] = "This username already exists";
  header("Location: ../register/register.php");
  exit();
}


$password = password_hash($_POST["inputPassword1"], PASSWORD_DEFAULT);
$email = $_POST["inputEmail"];

$state = NULL; //$_POST["inputState"];
$district = -1;//$_POST["inputDistrict"];
	
//$state = $_POST["inputState"];
//$district = $_POST["inputDistrict"];


//echo "Username is $username <br>";
//echo "Password is $password <br>";
//echo "Email is $email <br>";

if(!$stmt->execute()){
  echo $stmt->error;
}

header("Location: ../register/login.php");
?>
