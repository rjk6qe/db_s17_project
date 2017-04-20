<?php
session_start();
require_once('../db_conn.php');

$db =DbUtil::create();
// $stmt = $db->prepare("UPDATE Constituent SET is_active='0' WHERE username=?");
$stmt = $db->prepare("DELETE FROM Constituent WHERE username=?");

if(!$stmt){
	echo $db->error;
}

$stmt->bind_param("s", $username);

foreach($_POST['deactivate_user'] as $username){
	if(!$stmt->execute()){
    	echo $stmt->error;
	}
}

header("Location: deactivate_users.php");
?>