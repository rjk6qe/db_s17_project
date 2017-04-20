<?php
require_once('../db_conn.php');
require_once('../login_required.php');
session_start();
$username = $_SESSION['user'];
$district = $_POST["district"];
$dbSEL =DbUtil::create();
// find user state and district
$stmtSEL = $dbSEL->prepare("SELECT state FROM Constituent WHERE username = '{$username}' LIMIT 1");
if(!$stmtSEL){
  echo $dbSEL->error;
}

if(!$stmtSEL->execute()){
  echo $stmtSEL->error;
}
$stmtSEL -> bind_result($state);
$stmtSEL -> store_result();
$stmtSEL -> fetch();
echo "state = {$state}";
echo "district = {$district}";
if(is_null($state)){
	$_SESSION['error_msg'] = "Set your state before setting your district!";
	header('Location: account.php');
	exit();
}else{
	echo "whatsy";
	$dbSELMAX =DbUtil::create();
	$stmtSELMAX = $dbSELMAX->prepare("SELECT MAX(district) FROM Congressperson WHERE state='{$state}'");
	echo "1";
	if(!$stmtSELMAX->execute()){
	  echo $stmtSELMAX->error;
  	  $_SESSION['error_msg'] = "Error updating district";
	}
	echo "2";
	$stmtSELMAX -> bind_result($maxDistrict);
	echo "3";
	$stmtSELMAX -> store_result();
	$stmtSELMAX -> fetch();
	echo "yessum";
	if($district > $maxDistrict || $district < 1){
	        $_SESSION['error_msg'] = "The district you chose is not a district in your state.";
		header('Location: account.php');
		echo "dont update";
		exit();
	}
}

$db = DbUtil::create();
$stmt = $db->prepare("UPDATE Constituent SET district='{$district }' WHERE username = '{$username}'");

if(!$stmt){
  echo $db->error;
  $_SESSION['error_msg'] = "Error updating district";
}

if(!$stmt->execute()){
  echo $stmt->error;
  $_SESSION['error_msg'] = "Error updating district";
}
$_SESSION['success_msg'] = "Successfully updated your district!";
header('Location: account.php');

?>
