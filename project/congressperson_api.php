<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateCongressperson(){
  $data = getJSONPostData()['data'];
  $db = DbUtil::create();
  echo 'created<br>';
  $stmt = $db->prepare("INSERT INTO Congressperson (member_id, first_name, last_name, district, state, party, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
  echo 'prepared';
  $stmt->bind_param("sssiss", $member_id, $first_name, $last_name, $district, $state, $party, $type);
  echo 'bound<br>';
  $senators = $data['senate'];
  $house_membs = $data['house'];
  echo 'split arrays';
  // senate array
  foreach ($senators as $senator){
    $member_id = $senator['member_id'];
    $first_name = $senator['first_name'];
    $last_name = $senator['last_name'];
    $district = NULL;
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

updateCongressperson();

?>
