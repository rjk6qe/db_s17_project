<?php 
require_once('../db_conn.php');
session_start();
$username = $_SESSION['user'];
if(isset($_GET['id'])){
        $id = $_GET['id'];
}

$db =DbUtil::create();
$stmt = $db->prepare("INSERT INTO Follow(group_name, bill_id) VALUES (?,?)");
if(!$stmt){
  echo $db->error;
  $_SESSION['error_msg'] = "Failed to connect";
  exit();
}

$stmt->bind_param("ss", $groupname, $billid);
$groupname = $id;
$billid = $_POST["inputbillid"];


if(!$stmt->execute()){
  echo $stmt->error;
  $_SESSION['error_msg'] = "Failed to Follow Bill!";		
  header("Location: view_group.php?id=" . $id);
  exit();
}

$_SESSION['success_msg'] = "Followed Bill!";


header("Location: view_group.php?id=" . $id);

?>
