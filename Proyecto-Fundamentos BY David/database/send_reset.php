<?php
ob_start();
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/src/SMTP.php';

$email = $_POST['email'] ?? '';

if (empty($email)) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => 'El correo es obligatorio.']);
    exit;
}

// Buscar usuario
$stmt = $conn->prepare("SELECT * FROM User_nat WHERE email_user = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => '❌ Correo no encontrado.']);
    exit;
}

$user = $result->fetch_assoc();
$userId = $user['id'];

// Generar token y expiración
$token = bin2hex(random_bytes(32));
$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Guardar token
$stmt = $conn->prepare("INSERT INTO PasswordRecovery (user_id, token, expiration) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $userId, $token, $expiration);
$stmt->execute();

// Enviar correo
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';          // Servidor SMTP de Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'parkinguta@gmail.com';  // <-- Cambia esto
    $mail->Password = 'atkg kbfs mnnl vire';          // <-- O una contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('parkinguta@gmail.com', 'Parking App');
    $mail->addAddress($email);

    $link = 'http://localhost/ProyectoSW/database/reset_password.php?token=' . $token;

    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de contraseña';
    $mail->Body = "Hola <b>{$user['name_user']}</b>,<br><br>
                   Has solicitado recuperar tu contraseña. Haz clic en el siguiente enlace para restablecerla:<br><br>
                   <a href='$link'>Recuperar contraseña</a><br><br>
                   Este enlace expirará en 1 hora.";

    $mail->send();
    ob_clean();
    echo json_encode(['success' => true, 'message' => '✅ Se envió el enlace de recuperación a tu correo.']);
    exit;
} catch (Exception $e) {
    ob_clean();
    echo json_encode(['success' => false, 'message' => "❌ Error al enviar: {$mail->ErrorInfo}"]);
}
exit;