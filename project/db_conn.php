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

  public static function fetch_all($result){
    $arr = array();
    while($row = $result->fetch_array(MYSQLI_NUM)){
      array_push($arr, $row);
    }
    return $arr;
  }

  public function query($query_string){
    $result = $this->db->query($query_string) or die(mysqli_error($this->db)); //fails and dumps error for bad input
    return $result;
  }

}

?>