<?php
// obtener_slots.php

// 1. Incluir la conexión a la base de datos
require 'database.php';

// 2. Obtener el userId desde la URL (ej. ?userId=u1)
$userId = $_GET['userId'] ?? null;

// 3. Consulta todos los slots
$sql = "SELECT * FROM slots";
$result = $conn->query($sql);

// 4. Crear arreglo de respuesta
$slots = [];

while ($row = $result->fetch_assoc()) {
    // 5. Agregar campo "esMio" (si pertenece al usuario actual)
    $row['esMio'] = ($row['usuarioId'] == $userId);
    $slots[] = $row;
}

// 6. Enviar respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($slots);
?>