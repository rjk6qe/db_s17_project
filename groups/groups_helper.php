

<?php
require_once('../db_conn.php');
session_start();

$db =DbUtil::create();
$stmt = $db->prepare("INSERT INTO InterestGroup(group_name, topic) VALUES (?,?)");

if(!$stmt){
  echo $db->error;
}

$stmt->bind_param("ss", $groupname, $topic);
$groupname = $_POST["inputGroupname"];
$topic = $_POST["inputTopic"];

if(!$stmt->execute()){
  echo $stmt->error;
}

echo "New records created succesfully\n";


/*$stmt -> bind_result($user, $pass);
$stmt -> store_result();
if($stmt->num_rows == 1){
  echo 'login successful';
  $_SESSION['logged_in'] = true;
  $_SESSION['user'] = $username;
  //  header("Location: ../Main/main.html");
  var_dump($_SESSION['logged_in']);
}else{
  echo "result not found!";
}*/
//header("Location: ../index.html");

?>
 <a type="button" class="btn btn-primary" href="groups.php">Back</a>

