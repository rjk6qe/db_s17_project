<?php
class DbUtil{
	public static $loginUser = "cs4750s17fac3hc"; 
	public static $loginPass = "LadyGoats";
	public static $host = "stardock.cs.virginia.edu"; // DB Host
	public static $schema = "cs4750s17fac3hc"; // DB Schema
	
	public static function loginConnection(){
		$db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);
	
		if($db->connect_errno){
			echo("Could not connect to db");
			$db->close();
			exit();
		}
		
		return $db;
	}
	
}
?>

