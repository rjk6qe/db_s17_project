

<?php
require_once('../db_conn.php');
session_start();

$db =DbUtil::create();

$stmt = $db->prepare("DELETE FROM InterestedIn WHERE username = ? AND group_name=?");
$stmt->bind_param("ss", $username, $groupname);
$username = $_SESSION['user'];
$groupname = $_POST["group"];

//print_r($_POST);


if(!$stmt){
  echo $db->error;
}



if(!$stmt->execute()){
  echo $stmt->error;
  $_SESSION['error_msg'] = "Something went wrong and you were not removed from the group.";
}
  $_SESSION['success_msg'] = "Removed from group!";
//echo "Removed group succesfully";

header("Location: groups.php");
?>
 <a type="button" class="btn btn-primary" href="groups.php">Back</a>

