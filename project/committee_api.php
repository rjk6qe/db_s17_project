<?php
require_once('db_conn.php');
function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

function updateCommittee(){
  $data = getJSONPostData()['data'];
  $db = DbUtil::create();

  $stmt = $db->prepare("INSERT INTO Committee (committee_id, committee_name) VALUES (?,?)");
  if(!$stmt){
    echo $db->error;
  }

  $stmt->bind_param("ss", $committee_id, $name);

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
