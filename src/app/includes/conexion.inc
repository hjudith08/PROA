<?php
// EduSync
$conn_edusync = new mysqli("localhost", "root", "", "proa");
if ($conn_edusync->connect_error) {
    die("Conexión fallida a EduSync: " . $conn_edusync->connect_error);
}
//edusync1234*
$conn_edusync->set_charset('utf8mb4');

// PROA
$conn_proa = new mysqli("localhost", "root", "", "proa");
if ($conn_proa->connect_error) {
    die("Conexión fallida a PROA: " . $conn_proa->connect_error);
}
//proa1234*
$conn_proa->set_charset('utf8mb4');
?>