<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    echo json_encode([
        'success' => true,
        'id' => $_SESSION['usuario_id'],
        'nombre' => $_SESSION['usuario_nombre']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'No hay sesión activa']);
}
?>