<?php
require_once('../db_conn.php');
require_once('../login_required.php');
session_start();
$username = $_SESSION['user'];
$district = $_POST["district"];
$dbSEL =DbUtil::create();
// find user state and district
$stmtSEL = $dbSEL->prepare("SELECT state FROM Constituent WHERE username = ? LIMIT 1");
$stmtSEL ->bind_param('s', $username);

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
	$dbSELMAX =DbUtil::create();
	$stmtSELMAX = $dbSELMAX->prepare("SELECT MAX(district) FROM Congressperson WHERE state=?");
	$stmtSELMAX ->bind_param('s', $state);
	if(!$stmtSELMAX->execute()){
	  echo $stmtSELMAX->error;
  	  $_SESSION['error_msg'] = "Error updating district";
	  header('Location: account.php');
	  exit();
	}
	$stmtSELMAX -> bind_result($maxDistrict);
	$stmtSELMAX -> store_result();
	$stmtSELMAX -> fetch();
	if($district > $maxDistrict || $district < 1){
	        $_SESSION['error_msg'] = "The district you chose is not a district in your state.";
		header('Location: account.php');
		exit();
	}
}

$db = DbUtil::create();
$stmt = $db->prepare("UPDATE Constituent SET district=? WHERE username = ?");

if(!$stmt){
  echo $db->error;
  $_SESSION['error_msg'] = "Error updating district. Statement error";
  header('Location: account.php');
  exit();
}

$stmt->bind_param("is", intval($district), $username);

if(!$stmt->execute()){
  echo $stmt->error;
  $_SESSION['error_msg'] = $stmt->error;
  header('Location: account.php');
  exit();
}
$_SESSION['success_msg'] = "Successfully updated your district!";
header('Location: account.php');

?>
