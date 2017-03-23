<?php
require_once('db_conn.php');

$username = $_POST["username-input"];
$password = $_POST["password-input"];
$email = $_POST["email-input"];

$stmt = $conn->prepare("INSERT INTO Constituent (username, password, email) VALUES (?, ?, ?)");
$new_db = new DbUtil();
$stmt->bind_param("sss", $username, $password, $email);
$stmt->execute();

header('Location: /home.html');
?>
