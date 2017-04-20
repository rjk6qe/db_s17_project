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

if($groupname == '' | $topic == ''){
  $_SESSION['error_msg'] = "Failed to Created New Group! Please make sure the group and topic descriptions are not blank.";
  header("Location: groups.php");
  exit();

}

if(!$stmt->execute()){
  echo $stmt->error;
  $_SESSION['error_msg'] = "Failed to Created New Group!";	
  header("Location: groups.php");
  exit();	
}

$_SESSION['success_msg'] = "New Group Created!";

$new_stmt = $db->prepare("INSERT INTO InterestedIn (username, group_name) VALUES (?, ?)");
if(!$new_stmt){
  echo $db->error;
}

$new_stmt->bind_param("ss", $username, $groupname);

$username = $_SESSION['user'];

if(!$new_stmt->execute()){
  echo $new_stmt->error;
}

header("Location: groups.php");
?>
