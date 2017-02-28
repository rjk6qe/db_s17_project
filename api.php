<?php

class DbUtil{
  private static $user = "cs4750s17rjk6qe";
  private static $pass = "richard";
  private static $host = "stardock.cs.virginia.edu";
  private static $schema = "cs4750s17rjk6qe";
  private $db;

  public function __construct() {
    $this->db = new mysqli(DbUtil::$host, DbUtil::$user, DbUtil::$pass, DbUtil::$schema);
    if($this->db->connect_errno) {
      echo 'db connection failed';
      $this->db->close();
      exit();
    }
  }

  private function fetch_all($result){
    $arr = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      array_push($arr, $row);
    }
    return $arr;
  }

  public function query($query_string){
    $result = $this->db->query($query_string);
    if($result==True){
      return True;
    } elif($result==False){
      return False;
    } else{
      return $this->fetch_all($result);
    }
  }  

  public function query_test(){
    $query_text = "SELECT * FROM account";
    return $this->query($query_text);
  }
}

function getJSONPostData(){
  $form_data = file_get_contents('php://input');
  return json_decode($form_data, true);
}

$new_db = new DbUtil();
print_r($new_db->query_test());

?>
