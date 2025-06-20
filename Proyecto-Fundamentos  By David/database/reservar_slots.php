<?php
// reservar_slot.php

// Incluir conexión
require 'database.php';

// Recibir datos JSON del frontend
$data = json_decode(file_get_contents('php://input'), true);

// Validar entrada
$slotId = isset($data['slotId']) ? intval($data['slotId']) : null;
$userId = isset($data['userId']) ? $data['userId'] : null;

if (!$slotId || !$userId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

// Consulta y actualización
$sql = "UPDATE slots 
        SET estado = 'ocupado', usuarioId = ? 
        WHERE id = ? AND estado = 'libre'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $userId, $slotId);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Slot reservado con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Slot ya ocupado o no existe']);
    }
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al reservar']);
}
?>