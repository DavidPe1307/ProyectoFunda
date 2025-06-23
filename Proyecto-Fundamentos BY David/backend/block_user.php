<?php
session_start();
header('Content-Type: application/json');

// Validación de sesión y permisos
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'administrador') {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit();
}

// Verifica si se envió el ID y el estado
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['user_id'], $data['block'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit();
}

$userId = intval($data['user_id']);
$newStatus = $data['block'] ? 'blocked' : 'active';

// Conexión DB
$host = "shuttle.proxy.rlwy.net";
$port = 52599;
$user = "root";
$password = "XHoGxnkbGUvXvlpOyxvvUAJXZkxOzbLp";
$database = "railway";

try {
    $conn = new mysqli($host, $user, $password, $database, $port);
    $conn->set_charset("utf8mb4");

    $stmt = $conn->prepare("UPDATE usuarios SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $newStatus, $userId);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Estado actualizado']);
} catch (Exception $e) {
    error_log("❌ Error bloqueando usuario: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error del servidor']);
}
?>
