<?php
function verificarSesion($tipoEsperado = null) {
    session_start();

    // Validar que exista sesión
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../frontend/login.html");
        exit();
    }

    // Si se espera un tipo (admin, usuario, etc.)
    if ($tipoEsperado !== null && $_SESSION['tipo'] !== $tipoEsperado) {
        header("Location: ../frontend/acceso_denegado.html");
        exit();
    }
}
?>