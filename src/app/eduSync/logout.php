<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
header("Location: /PROA/src/index.php");
exit;
?>