<?php
// EduSync
$conn_edusync = new mysqli("localhost:3306", "fuseriv_edusync", "edusync4321", "fuseriv_edusync");
if ($conn_edusync->connect_error) {
    die("Conexión fallida a EduSync: " . $conn_edusync->connect_error);
}
$conn_edusync->set_charset('utf8mb4');

// PROA
$conn_proa = new mysqli("localhost:3306", "fuseriv_proa3", "123proa321", "fuseriv_proa");
if ($conn_proa->connect_error) {
    die("Conexión fallida a PROA: " . $conn_proa->connect_error);
}
$conn_proa->set_charset('utf8mb4');
?>