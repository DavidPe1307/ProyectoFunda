<?php
require_once __DIR__ . '/database.php';

$token = $_POST['token'] ?? '';
$new_password = $_POST['new_password'] ?? '';

// Validar datos incompletos
if (!$token || !$new_password) {
    header("Location: reset_password.php?token=$token&status=incompleto");
    exit;
}

// Validar token
$stmt = $conn->prepare("SELECT * FROM PasswordRecovery WHERE token = ? AND used = 0 AND expiration > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: reset_password.php?token=$token&status=expirado");
    exit;
}

// Si todo está bien, actualizar contraseña
$row = $result->fetch_assoc();
$user_id = $row['user_id'];

$hashed = password_hash($new_password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE User_nat SET password_user = ? WHERE id = ?");
$stmt->bind_param("si", $hashed, $user_id);
$stmt->execute();

// Marcar el token como usado
$stmt = $conn->prepare("UPDATE PasswordRecovery SET used = 1 WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();

// Redirigir con éxito
header("Location: reset_password.php?status=exito");
exit;
