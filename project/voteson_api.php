<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateVote(){
  echo 'starting';
  $data = getJSONPostData()['data'];
  
  $db = DbUtil::create();
  echo 'created';
  $stmt = $db->prepare("INSERT INTO VotesOn (member_id, bill_id, date) VALUES (?, ?, ?)");
  
  echo 'done prepare';
  if(!$stmt){
    echo $db->error;
  }
  
  $stmt->bind_param("sss", $member_id, $bill_id, $date);
  echo 'done binding';
  
  $senator_votes = $data['senate_votes'];
  $house_votes = $data['house_votes'];
  
  //  var_dump($house_votes);
  
  
  // senate array
  foreach ($senator_votes as $vote){
    $bill_id = $vote['bill_id'];
    $date = $vote['date'];
    $position = $vote['positions'];


    foreach($position as $member){
      $member_id = $member['member_id'];

      if(!$stmt->execute()){
	echo $stmt->error;
      }
    }
  }


  
  // house array
  foreach ($house_votes as $vote){
    $bill_id = $vote['bill_id'];
    $date = $vote['date'];
    $position = $vote['positions'];
    
    
    foreach($position as $member){
      $member_id = $member['member_id'];
   
      if(!$stmt->execute()){
       echo $stmt->error;
      }
      }
  }
  
}

  echo 'hello';
updateVote();

?>
