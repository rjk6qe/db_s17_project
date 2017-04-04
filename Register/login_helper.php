<?php
/*require_once('db_conn.php');
  echo "0";
  $db =DbUtil::create();
  $stmt = $db->prepare("select * from Constituent where username = ? AND password = ?)")
  if(!stmt){
        echo $db->error;
  }

  $stmt->bind_param("ss", $username, $password);
  $username = $_POST["inputUsername"];
  $password = $_POST["inputPassword"];

  if(!$stmt->execute()){
        echo $stmt->error;
  }

  $query->bind_result($result);
  $query->fetch();
  if($result){
	echo "login succes";
  }
  
  echo "login not successful"; */

require_once('db_conn.php');
  echo "0";
  $db =DbUtil::create();
  $stmt = $db->prepare("SELECT * FROM Constituent WHERE username = ? AND password = ?");
  echo "1";
  if(!$stmt){
        echo $db->error;
  }

  echo "2";
  $stmt->bind_param("ss", $username, $password);
  $username = $_POST["inputUsername"];
  $password = $_POST["inputPassword"];
  
  echo "Username is $username <br>";
  echo "Password is $password <br>";


  if(!$stmt->execute()){
        echo $stmt->error;
  }

  $stmt -> bind_result($user, $pass);
  $stmt -> store_result();
  if($stmt->num_rows == 1){
   echo "result found! <br>";
   header("Location: ../Main/main.html");
  }else{
   echo "result not found!";
  }
  //header("Location: ../index.html");

?>

