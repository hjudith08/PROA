<?php
// EduSync
$conn_edusync = new mysqli("localhost", "root", "", "edusync", 3306);
if ($conn_edusync->connect_error) {
    die("Conexión fallida a EduSync: " . $conn_edusync->connect_error);
}
$conn_edusync->set_charset('utf8mb4');

// PROA
$conn_proa = new mysqli("localhost", "root", "", "proa", 3306);
if ($conn_proa->connect_error) {
    die("Conexión fallida a PROA: " . $conn_proa->connect_error);
}
$conn_proa->set_charset('utf8mb4');
?>