<?php

class DbUtil{
  private static $user = "cs4750s17fac3hc";
  private static $pass = "LadyGoats";
  private static $host = "stardock.cs.virginia.edu";
  private static $schema = "cs4750s17fac3hc";
  private $db;

  public static function create() {
    $db = new mysqli(DbUtil::$host, DbUtil::$user, DbUtil::$pass, DbUtil::$schema);
    if($db->connect_errno) {
      echo 'db connection failed';
      $db->close();
      exit();
    }
    return $db;
  }

}

?>