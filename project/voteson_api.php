<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateVote(){
  $data = getJSONPostData()['data'];
  $db = DbUtil::create();
  $stmt = $db->prepare("INSERT INTO Vote (member_id, bill_id, date) VALUES (?, ?, ?)");
  if(!$stmt){
    echo $db->error;
  }
  $stmt->bind_param("sss", $member_id, $bill_id, $date);

  $senator_votes = $data['senate_votes'];
  $house__votes = $data['house_votes'];
  // senate array
  foreach ($senator_votes as $vote){
    $bill_id = $vote['bill_id'];
    $member_id = $vote['member_id'];
    $date = $bill['date'];
    if(!$stmt->execute()){
      echo $stmt->error;
    }
  }
  // house array
  foreach ($house__votes as $vote){
    $bill_id = $vote['bill_id'];
    $member_id = $vote['member_id'];
    $date = $bill['date'];
    if(!$stmt->execute()){
      echo $stmt->error;
    }
  }
}

updateVote();

?>
