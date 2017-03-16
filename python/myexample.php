<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}


function updateCongressperson(){
  $data = getJSONPostData()['data'];
  $new_db = new DbUtil();
  $stmt = $conn->prepare("INSERT INTO Congressperson (member_id, first_name, last_name, district, state, party, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssiss", $member_id, $first_name, $last_name, $district, $state, $party, $type);

  $senators = $data['senate'];
  $house_membs = $data['house'];

  // senate array
  foreach ($senators as $senator){
    $member_id = $senator['member_id'];
    $first_name = $senator['first_name'];
    $last_name = $senator['last_name'];
    $district = null;
    $state = $senator['state'];
    $party = $senator['party'];
    $type = $senator['type'];
    $stmt->execute();
  }
  // house array
  foreach ($house_membs as $house_memb){
    $member_id = $house_memb['member_id'];
    $first_name = $house_memb['first_name'];
    $last_name = $house_memb['last_name'];
    $district = $house_memb['district'];
    $state = $house_memb['state'];
    $party = $house_memb['party'];
    $type = $house_memb['type'];
    $stmt->execute();
  }
}

function updateBill(){
  $data = getJSONPostData()['data'];
  $new_db = new DbUtil();
  $stmt = $conn->prepare("INSERT INTO Bill (ID, member_id, title, committee_name) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $bill_id, $member_id, $bill_title, $commitee_name);

  $senator_votes = $data['senate_votes'];
  $house__votes = $data['house_votes'];

  // senate array
  foreach ($senator_votes as $bill){
    $bill_id = $bill['bill_id'];
    $member_id = $bill['bill_sponsor_id'];
    $bill_title = $bill['bill_title'];
    $commitee_name = $bill['committee'];
    $stmt->execute();
  }
  // house array
  foreach ($house__votes as $bill){
    $bill_id = $bill['bill_id'];
    $member_id = $bill['bill_sponsor_id'];
    $bill_title = $bill['bill_title'];
    $commitee_name = $bill['committee'];
    $stmt->execute();
  }
}

?>
