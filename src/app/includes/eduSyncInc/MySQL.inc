<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "test2";

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

$conn->set_charset('utf8mb4');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}