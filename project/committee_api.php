<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateCommittee(){
  $data = getJSONPostData()['data'];
  $new_db = DbUtil::create();

  $stmt = $new_db->prepare("INSERT INTO Committee (name) VALUES (?)");
  if(!$stmt){
    echo $new_db->error;
  }

  $stmt->bind_param("s", $name);

  $senate_com = $data['senate_committees'];
  $house_com = $data['house_committees'];

  foreach ($senate_com as $s){
    var_dump($s);
    $name = $s['name'];
    $stmt->execute();
  }

  foreach($house_com as $h){
    var_dump($h);
    $name = $h['name'];
    $stmt->execute();
  }
  
}

updateCommittee();

?>
