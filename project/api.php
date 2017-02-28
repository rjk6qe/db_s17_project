<?php

require_once('db_conn.php');


function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

$post_data = getJSONPostData();

$new_db = new DbUtil();
$result = $new_db->query("SELECT * from account");
$result_array = DbUtil::fetch_all($result);
var_dump($result_array);

?>


