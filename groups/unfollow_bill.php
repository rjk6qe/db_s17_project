<?php 
require_once('../db_conn.php');
require_once('../login_required.php');
session_start();
$username = $_SESSION['user'];
if(isset($_GET['id'])){
        $id = $_GET['id'];
}
if(isset($_GET['group'])){
        $group = $_GET['group'];
}

$db =DbUtil::create();
$stmt = $db->prepare("DELETE FROM Follow WHERE group_name = '{$group}' AND bill_id = '{$id}'");
if(!$stmt){
  echo $db->error;
  $_SESSION['error_msg'] = "Failed to connect";
  header("Location: view_group.php?={$group}");
  exit();
}

if(!$stmt->execute()){
  echo $stmt->error;
  $_SESSION['error_msg'] = "Failed to Unfollow Bill!";		
  header("Location: view_group.php?id={$group}");
  exit();
}


$_SESSION['success_msg'] = "Unfollowed Bill!";


header("Location: view_group.php?id={$group}");

?>
