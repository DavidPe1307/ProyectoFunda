<?php
// get_slots_status.php
session_start();
header('Content-Type: application/json');

// Simulación de datos desde la base de datos (aquí debes usar tu lógica real)
$slots = [
    ['id' => 'A1', 'estado' => 'disponible'],
    ['id' => 'A2', 'estado' => 'ocupado'],
    ['id' => 'A3', 'estado' => 'reservado', 'usuario' => $_SESSION['user_id']],
    ['id' => 'A4', 'estado' => 'disponible'],
    ['id' => 'A5', 'estado' => 'disponible'],
    ['id' => 'B1', 'estado' => 'ocupado'],
    ['id' => 'B2', 'estado' => 'disponible'],
    ['id' => 'B3', 'estado' => 'reservado', 'usuario' => $_SESSION['user_id']],
    ['id' => 'B4', 'estado' => 'disponible'],
    ['id' => 'B5', 'estado' => 'disponible'],
];

echo json_encode($slots);
exit;
?>