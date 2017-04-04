<?php
session_start();
require_once('db_conn.php');

$username = $_POST["username-input"];
$password = $_POST["password-input"];

$stmt = $conn->prepare("Select username, password, email FROM Constituent WHERE username = ? and  password = ?)");
$new_db = new DbUtil();
$stmt->bind_param("sss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  // Set session variables
  $_SESSION["username"] = $username;
  header('Location: /home.php');
}

?>
