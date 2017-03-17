<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateBill(){
  $data = getJSONPostData()['data'];
  $db = DbUtil::create();
  $stmt = $db->prepare("INSERT INTO Bill (ID, member_id, title, committee_name) VALUES (?, ?, ?, ?)");
  if(!$stmt){
    echo $db->error;
  }
  $stmt->bind_param("ssss", $bill_id, $member_id, $bill_title, $commitee_name);
  echo 'done binding<br>';
  $senator_votes = $data['senate_bills'];
  $house__votes = $data['house_bills'];
  var_dump($senator_votes);
  // senate array
  foreach ($senator_votes as $bill){
    $bill_id = $bill['bill_id'];
    $member_id = $bill['bill_sponsor_id'];
    $bill_title = $bill['bill_title'];
    $commitee_name = $bill['committee'];
    if(!$stmt->execute()){
      echo $stmt->error;
    }
  }
  // house array
  foreach ($house__votes as $bill){
    $bill_id = $bill['bill_id'];
    $member_id = $bill['bill_sponsor_id'];
    $bill_title = $bill['bill_title'];
    $commitee_name = $bill['committee'];
    if(!$stmt->execute()){
      echo $stmt->error;
    }
  }
}

updateBill();

?>
