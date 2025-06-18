<?php
session_start();
// Incluir archivo de conexión a base de datos
require_once __DIR__ . '/database.php';

$identifier = $_POST['usuario']; // Puede ser username o email
$password = $_POST['password'];

if (empty($identifier) || empty($password)) {
    header("Location: ../frontend/login.html?error=campos");
    exit();
}

// Determinar si el identifier es un email o username
if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
    // Es un email - buscar por email
    $stmt = $conn->prepare("SELECT * FROM User_nat WHERE email_user = ? AND state = true");
} else {
    // Es un username - buscar por nombre de usuario
    $stmt = $conn->prepare("SELECT * FROM User_nat WHERE name_user = ? AND state = true");
}

$stmt->bind_param("s", $identifier);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    
    // Verificar la contraseña
    if (password_verify($password, $fila['password_user'])) {
        $_SESSION['usuario'] = $fila['name_user'];
        $_SESSION['email'] = $fila['email_user'];
        $_SESSION['tipo'] = $fila['type'];
        $_SESSION['user_id'] = $fila['id']; // Asumiendo que tienes un campo id
    
        if ($fila['type'] === 'administrador') {
            header("Location: ../frontend/interfacemain_admin.html");
        } else if ($fila['type'] === 'cliente') {
            header("Location: ../frontend/interfacemain_user.html"); // ← CAMBIO CLAVE
        } else {
            // Fallback por seguridad
            header("Location: ../frontend/interfacemain_user.html");
        }
        exit();
    } else {
        header("Location: ../frontend/login.html?error=contrasena");
        exit();
    }
} else {
    header("Location: ../frontend/login.html?error=usuario");
    exit();
}

$stmt->close();
$conn->close();
?>