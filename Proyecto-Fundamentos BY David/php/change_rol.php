<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'administrador') {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['user_id'], $data['new_role'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit();
}

$userId = intval($data['user_id']);
$newRole = $data['new_role'] === 'admin' ? 'admin' : 'user';

$host = "shuttle.proxy.rlwy.net";
$port = 52599;
$user = "root";
$password = "XHoGxnkbGUvXvlpOyxvvUAJXZkxOzbLp";
$database = "railway";

try {
    $conn = new mysqli($host, $user, $password, $database, $port);
    $conn->set_charset("utf8mb4");

    $stmt = $conn->prepare("UPDATE usuarios SET tipo = ? WHERE id = ?");
    $stmt->bind_param("si", $newRole, $userId);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Rol actualizado']);
} catch (Exception $e) {
    error_log("❌ Error cambiando rol: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error del servidor']);
}
?>
