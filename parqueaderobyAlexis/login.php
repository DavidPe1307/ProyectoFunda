<?php
session_start();

// Incluir archivo de conexión a base de datos
require_once __DIR__ . '/database.php';
 // Asegúrate de que database.php esté en el mismo directorio

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Evitar inyección SQL con sentencias preparadas
$stmt = $conn->prepare("SELECT * FROM User_nat WHERE name_user = ? AND state = true");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($password, $fila['password_user'])) {
        $_SESSION['usuario'] = $fila['name_user'];
        $_SESSION['tipo'] = $fila['type'];

        header("Location: interface.html");
        exit;
    } else {
        echo "❌ Contraseña incorrecta.";
    }
} else {
    echo "❌ Usuario no encontrado o desactivado.";
}

$stmt->close();
$conn->close();
?>