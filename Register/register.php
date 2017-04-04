<?php
require_once('db_conn.php');
  echo "0";
  $db =DbUtil::create();
  $stmt = $db->prepare("INSERT INTO Constituent (username, password, email) VALUES (?, ?, ?)");

  if(!stmt){
  	echo $db->error;
  }
	
  $stmt->bind_param("sss", $username, $password, $email);
  $username = $_POST[inputUsername];
  $password = $_POST["inputPassword"];
  $email = $_POST["inputEmail"];
	
  //echo "Username is $username <br>";
  //echo "Password is $password <br>";
  //echo "Email is $email <br>";

  if(!$stmt->execute()){
	echo $stmt->error;
  }

  header("Location: ../index.html");
?>
