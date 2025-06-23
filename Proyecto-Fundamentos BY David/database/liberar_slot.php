<?php
// liberar_slot.php

require 'database.php';

// Leer datos del frontend
$data = json_decode(file_get_contents('php://input'), true);

$slotId = isset($data['slotId']) ? intval($data['slotId']) : null;
$userId = $data['user_Id'] ?? null;
$rol = $data['rol'] ?? 'user'; // por defecto es "user"

if (!$slotId || !$userId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

// 1. Buscar el slot
$sql = "SELECT * FROM slots WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $slotId);
$stmt->execute();
$result = $stmt->get_result();
$slot = $result->fetch_assoc();

if (!$slot) {
    echo json_encode(['success' => false, 'message' => 'Slot no encontrado']);
    exit;
}

// 2. Validar si el usuario tiene permiso para liberar
$puedeLiberar = ($slot['usuarioId'] === $userId || $rol === 'admin');

if (!$puedeLiberar) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'No tienes permiso para liberar este slot']);
    exit;
}

// 3. Liberar el slot
$sql = "UPDATE slots SET estado = 'libre', usuarioId = NULL WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $slotId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Slot liberado correctamente']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al liberar el slot']);
}
?>