<?php
session_start();
require_once('../db_conn.php');

$db =DbUtil::create();
$stmt = $db->prepare("UPDATE Constituent SET is_active='1' WHERE username=?");

if(!$stmt){
	echo $db->error;
}

$stmt->bind_param("s", $username);

foreach($_POST['activate_user'] as $username){
	if(!$stmt->execute()){
    	echo $stmt->error;
	}
}

header("Location: deactivate_users.php");
?>