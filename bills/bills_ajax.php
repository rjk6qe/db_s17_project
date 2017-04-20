<?php
require_once('../db_conn.php');

$db = DbUtil::create();
if(isset($_GET['order_column'])){
	$order_column = $_GET['order_column'];
	if($order_column == 'bill_id'){
		$sql = "SELECT * FROM Bill WHERE bill_id LIKE ?";
	} elseif($order_column == 'committee_id'){
		$sql = "SELECT * FROM Bill WHERE committee_id LIKE ?";
	} else {
		$sql = "SELECT * FROM Bill WHERE title LIKE ?";
	}
} else{
	$sql = "SELECT * FROM Bill WHERE title LIKE ?";
}

$stmt = $db->prepare($sql);

if(!$stmt){
	echo $db->error;
	exit();
}

$stmt->bind_param("s", $query_string);

if( isset($_GET['query'] )){
	$query_string = '%' . $_GET['query'] . '%';
} else{
	$query_string = '%';
}

if(!$stmt->execute()){
	echo $stmt->error;
	exit();
}

$html_text = '';
$html_text = $html_text . '<table class="table table-striped">';
$html_text = $html_text . '<thead><tr><th>Bill ID</th><th>Chair ID</th><th>Title</th><th>Committee</th></tr></thead>';
$html_text = $html_text . '<tbody>';

$stmt -> bind_result($bill_id, $member_id, $title, $committee_id);
$stmt -> store_result();

$count = 0;

while($stmt->fetch()){
	$count = $count + 1;
	$html_text = $html_text . '<tr name="data_row">';
	$html_text = $html_text . '<td>' . $bill_id . '</td>';
	$html_text = $html_text . '<td>' . $member_id . '</td>';
	$html_text = $html_text . '<td>' . $title . '</td>';
	$html_text = $html_text . '<td>' . $committee_id . '</td>';
	$html_text = $html_text . '</tr>';
}
$html_text = $html_text . '</tbody>';
$html_text = $html_text . '</table>';


$return_dict = array('html' => $html_text, 'length' => $count);
echo json_encode($return_dict);
?>