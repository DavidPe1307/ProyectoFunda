<?php
session_start();

header("Content-Type: application/json");
echo json_encode([
    'logeado' => isset($_SESSION['user_id']),
    'tipo' => $_SESSION['tipo'] ?? null
]);
?>