

<?php
require_once('../db_conn.php');
session_start();

$db =DbUtil::create();
$stmt = $db->prepare("INSERT INTO InterestGroup(group_name, topic) VALUES (?,?)");

if(!$stmt){
  echo $db->error;
}

$stmt->bind_param("ss", $groupname, $topic);
$groupname = $_POST["inputGroupname"];
$topic = $_POST["inputTopic"];

if(!$stmt->execute()){
  echo $stmt->error;
}

echo "New records created succesfully\n";


?>
 <a type="button" class="btn btn-primary" href="groups.php">Back</a>

