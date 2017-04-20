

<?php
require_once('../db_conn.php');
session_start();

$db =DbUtil::create();
$stmt = $db->prepare("INSERT INTO InterestedIn(username, group_name ) VALUES (?, ?)");

//print_r($_POST);


if(!$stmt){
  echo $db->error;
}

$username = $_SESSION['user'];
$stmt->bind_param("ss", $username, $groupname);
$groupname = $_POST["group"];
//$username = $_SESSION['user'];


if(!$stmt->execute()){
  //echo $stmt->error;
  $_SESSION['error_msg'] = "Something went wrong when you tried to join that group.";
}
$_SESSION['success_msg'] = "Joined Group!";
//echo "Joined group succesfully";
header("Location: groups.php");

?>
 <a type="button" class="btn btn-primary" href="groups.php">Back</a>

