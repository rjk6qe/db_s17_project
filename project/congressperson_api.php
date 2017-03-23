<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateCongressperson(){
  $data = getJSONPostData()['data'];
  $db = DbUtil::create();
  echo 'creating';
  $stmt = $db->prepare("INSERT INTO Congressperson (member_id, first_name, last_name, district, state, party, type) VALUES (?, ?, ?, ?, ?, ?, ?)");
  echo 'stmt one';
  $serves_stmt = $db->prepare("INSERT INTO ServesOn (member_id, committee_id) VALUES (?, ?)");
  echo 'stmt two';
  if(!$stmt){
    echo $db->error;  
  }
  echo 'binding one';
  $stmt->bind_param("sssisss", $member_id, $first_name, $last_name, $district, $state, $party, $type);
  echo 'binding two';
  $serves_stmt->bind_param("ss", $member_id, $committee_id);
  echo 'done binding';
  
  $senators = $data['senate'];
  $house_membs = $data['house'];

  // senate array
  foreach ($senators as $senator){
   
    $member_id = $senator['member_id'];
    $first_name = $senator['first_name'];
    $last_name = $senator['last_name'];
    $district = -1;
    $state = $senator['state'];
    $party = $senator['party'];
    $type = $senator['type'];
    
    $committees = $senator['committees'];
    var_dump($committees);

    foreach($committees as $com){
      $committee_id = $com['id'];
      
      if(!$serves_stmt->execute()){
	echo $serves_stmt->error;
      }
      
    }

    if(!$stmt->execute()){
      echo $stmt->error;
    }
  }
 
  
  // house array
  foreach ($house_membs as $house_memb){
    $member_id = $house_memb['member_id'];
    $first_name = $house_memb['first_name'];
    $last_name = $house_memb['last_name'];
    $district = intval($house_memb['district']);
    $state = $house_memb['state'];
    $party = $house_memb['party'];
    $type = $house_memb['type'];
    
    $committees = $senator['committees'];
    var_dump($committees);

    foreach($committees as $com){
      $committee_id = $com['id'];


      if(!$serves_stmt->execute()){
        echo $serves_stmt->error;
      }

    }

    if(!$stmt->execute()){
      echo $stmt->error;
    }
  }
  
}

updateCongressperson();

?>
