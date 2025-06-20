<?php
session_start();
header('Content-Type: application/json');

// Seguridad básica: asegurarse de que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit();
}

// Conexión a base de datos (ajusta con tu propia configuración)
require_once 'database.php';

// Consulta de slots
$sql = "SELECT id_slot, estado, usuario_id FROM slots";
$result = $conn->query($sql);

$slots = [];
while ($row = $result->fetch_assoc()) {
    $slots[] = [
        'id' => $row['id_slot'],
        'estado' => $row['estado'],
        'usuarioId' => $row['usuario_id']
    ];
}

echo json_encode($slots);
$conn->close();
?>
