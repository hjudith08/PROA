<?php
// Importaciones al principio
use PHPMailer\PHPMailer\PHPMailer;
require '../includes/eduSyncInc/PHPMailer.php';
require '../includes/eduSyncInc/SMTP.php';
require_once '../includes/conexion.inc';

// Verificar conexión
if (!isset($conn_edusync))
    die("Error de conexión");

// Verificar si el correo ya existe
$email = $_POST['email'] ?? '';
$check_email = $conn_edusync->prepare("SELECT id FROM usuarios WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    // El correo ya existe, redirigir con error
    header("Location: loginRegistro.php?error=El correo electrónico ya está registrado");
    exit();
}
$check_email->close();

// Generar token
$token = uniqid();

// Preparar inserción en base de datos
$stmt = $conn_edusync->prepare("INSERT INTO usuarios (nombre, apellidos, email, password, token, validez_token) 
VALUES (?, ?, ?, SHA2(?, 256), ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
$stmt->bind_param("sssss", $_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['password'], $token);
$stmt->execute();
$stmt->close();
$conn_edusync->close();
// Enviar correo
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.ethereal.email';
$mail->SMTPAuth = true;
$mail->Username = 'lavinia71@ethereal.email';
$mail->Password = 'J1DUwV2GrtnSbKcDS7';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('registro@gti.com', 'GTI');
$mail->addAddress($_POST['email']);
$mail->isHTML(true);
$base_url = 'http://localhost/PROA/src/';
$href = $base_url . 'validar-registro.php?token=' . $token;
$mail->Subject = 'Registro de usuario';
$mail->Body = '
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #333;">Hola <b>' . htmlspecialchars($_POST['nombre']) . ' ' . htmlspecialchars($_POST['apellidos']) . '</b>,</h2>
        <p style="font-size: 16px; color: #555;">
            Gracias por registrarte en <strong>EduSync</strong>. Para completar tu registro, por favor haz clic en el boton de abajo:
        </p>
        <p style="text-align: center; margin: 30px 0;">
            <a href="' . $href . '" style="background-color: #0D273D; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                Confirmar Registro
            </a>
        </p>
        <p style="font-size: 14px; color: #999;">
            Si no te registraste, puedes ignorar este mensaje.
        </p>
    </div>
';
$mail->AltBody = 'Hola ' . $_POST['nombre'] . ' ' . $_POST['apellidos'] . ', confirma tu registro en: ' . $href;

// Enviar el correo
$mail->send();
header("Location: mensaje.php?tipo=registro_enviado&email=" . urlencode($_POST['email']));
exit;
?>