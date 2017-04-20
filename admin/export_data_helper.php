<?php
require_once('../db_conn.php');

$post_data = $_POST['table'];

$db=DbUtil::create();

if($post_data == "Constituent"){
	$stmt = $db->prepare("SELECT username, email, state, district, is_admin, is_active FROM Constituent");
	$filename = "constituent.csv";
} elseif($post_data == "Congressperson"){
	$stmt = $db->prepare("SELECT * FROM Congressperson");
	$filename = "congresspeople.csv";
} elseif($post_data == "Bill"){
	$stmt = $db->prepare("SELECT * FROM Bill");
	$filename = "bills.csv";
} elseif($post_data == "Committees"){
	$stmt = $db->prepare("SELECT * FROM Committee");
	$filename = "committees.csv";
} else{
	$db->close();
	header("Location: export_data.php");
	exit();
}


if(!$stmt){
	echo 'prepare error';
	echo $db->error;
	exit();
}

$stmt->execute();

$f = fopen('php://temp', 'wt');


if($post_data == "Constituent"){
	fputcsv($f, array('username', 'email', 'state', 'district', 'is_admin', 'is_active'));
	$stmt -> bind_result($username, $email, $state, $district, $is_admin, $is_active);
} elseif($post_data == "Congressperson"){
	fputcsv($f, array('member_id', 'first_name', 'last_name', 'district', 'state', 'party', 'type'));
	$stmt -> bind_result($member_id, $first_name, $last_name, $district, $state, $party, $type);
} elseif($post_data == "Bill"){
	fputcsv($f, array('bill_id', 'member_id', 'title', 'committee_id'));
	$stmt -> bind_result($bill_id, $member_id, $title, $committee_id);
} elseif($post_data == "Committees"){
	fputcsv($f, array('committee_id', 'committee_name'));
	$stmt -> bind_result($committee_id, $committee_name);
} else{
	$db->close();
	header("Location: export_data.php");
	exit();
}

$stmt -> store_result();

while($stmt->fetch()){
	if($post_data == "Constituent"){
		fputcsv($f, array($username, $email, $state, $district, $is_admin, $is_active));
	} elseif($post_data == "Congressperson"){
		fputcsv($f, array($member_id, $first_name, $last_name, $district, $state, $party, $type));
	} elseif($post_data == "Bill"){
		fputcsv($f, array($bill_id, $member_id, $title, $committee_id));
	} elseif($post_data == "Committees"){
		fputcsv($f, array($committee_id, $committee_name));
	} else{
		$db->close();
		header("Location: export_data.php");
		exit();
	}
}


$size = ftell($f);
rewind($f);

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Length: $size");
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=" . $filename);
fpassthru($f);
?>