<?php
require_once '../includes/MySQL.inc';
if(!isset($conn)) die();
$token = uniqid();
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, token, validez_token) 
VALUES (?, ?, ?, SHA2(?, 256), ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
$stmt->bind_param("sssss", $_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['password'], $token);
$stmt->execute();
$stmt->close();
$conn->close();

use PHPMailer\PHPMailer\PHPMailer;
require '../includes/PHPMailer.php';
require '../includes/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.ethereal.email';
$mail->SMTPAuth = true;
$mail->Username = 'david.gutmann@ethereal.email';
$mail->Password = 'EhG6yrE72R9k6KWyR1';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;


$mail->setFrom('registro@gti.com', 'GTI');
$mail->addAddress($_POST['email']);
$mail->isHTML(true);
$href = 'http://localhost/ejemplo-registro/src/validar-registro.php?token=' . $token;
$mail->Subject = 'Registro de usuario';
$mail->Body = 'Hola <b>' . $_POST['nombre'] . ' ' . $_POST['apellidos'] . '</b>, <br>Por favor confirma tu registro: <a href="' . $href . '">' . $href . '</a>';
$mail->AltBody = 'Hola ' . $_POST['nombre'] . ' ' . $_POST['apellidos'] . ', confirma tu registro en: ' . $href;
$mail->send();


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>

<pre>
    <?php var_dump($_POST); ?>
</pre>

</body>
</html>
