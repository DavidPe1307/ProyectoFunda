<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'administrador') {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['user_id'], $data['name'], $data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit();
}

$userId = intval($data['user_id']);
$name = trim($data['name']);
$email = trim($data['email']);

$host = "shuttle.proxy.rlwy.net";
$port = 52599;
$user = "root";
$password = "XHoGxnkbGUvXvlpOyxvvUAJXZkxOzbLp";
$database = "railway";

try {
    $conn = new mysqli($host, $user, $password, $database, $port);
    $conn->set_charset("utf8mb4");

    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $userId);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Usuario actualizado']);
} catch (Exception $e) {
    error_log("❌ Error editando usuario: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error del servidor']);
}
?>
