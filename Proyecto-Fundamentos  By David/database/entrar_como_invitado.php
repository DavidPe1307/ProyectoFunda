<?php
session_start();

// Asignar datos de sesión para invitado
$_SESSION['usuario'] = 'Invitado';
$_SESSION['tipo'] = 'guest';
$_SESSION['user_id'] = null; // Puedes usar 0 si tu código espera un número

// Redirigir a la interfaz del invitado
header("Location: ../frontend/interfacemain_invitate.php");
exit();
?>
