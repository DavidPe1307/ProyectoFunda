<?php
session_start();
header('Content-Type: application/json');
require_once 'database.php'; // Asegúrate de tener esto correctamente configurado

$userId = $_SESSION['user_id'];

// Consulta real desde la tabla de slots
$sql = "SELECT id_slot AS id, estado, usuario_id AS usuario FROM espacios";
$result = $conn->query($sql);

$slots = [];

while ($row = $result->fetch_assoc()) {
    $slots[] = [
        'id' => $row['id'],
        'estado' => $row['estado'],
        'usuario' => $row['usuario'] // solo relevante si está reservado
    ];
}

echo json_encode($slots);
$conn->close();
?>