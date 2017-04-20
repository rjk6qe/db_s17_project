<?php

session_start();

class DbUtil{
  private static $host = "stardock.cs.virginia.edu";
  private static $schema = "cs4750s17rjk6qe";

  public static function create() {
    if(isset($_SESSION['is_admin'])){
      $is_admin = $_SESSION['is_admin'];
    } else{
      $is_admin = false;
    }
    if($is_admin  == true){
      $user = 'cs4750s17rjk6qeb';
      $pass = 'AdminLadyGoats';
    } else{
      $user = 'cs4750s17rjk6qea';
      $pass = 'LadyGoats';
    }

    $db = new mysqli(self::$host, $user, $pass, self::$schema);
    if($db->connect_errno) {
      echo 'db connection failed';
      $db->close();
      exit();
    }
    return $db;
  }

}

?>