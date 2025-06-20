<?php
session_start();
require_once __DIR__ . '/database.php';

// Verificar que los datos estén enviados
if (!isset($_POST['usuario'], $_POST['password'])) {
    die("Datos no recibidos");
}

$identifier = trim($_POST['usuario']);
$password = trim($_POST['password']);

// Validación de campos vacíos
if (empty($identifier) || empty($password)) {
    header("Location: ../frontend/login.html?error=campos");
    exit();
}

// Verificar si es email o usuario
if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
    $stmt = $conn->prepare("SELECT * FROM User_nat WHERE email_user = ? AND state = true");
} else {
    $stmt = $conn->prepare("SELECT * FROM User_nat WHERE name_user = ? AND state = true");
}

$stmt->bind_param("s", $identifier);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    if (password_verify($password, $fila['password_user'])) {
        // Guardar sesión
        $_SESSION['usuario'] = $fila['name_user'];
        $_SESSION['email'] = $fila['email_user'];
        $_SESSION['tipo'] = $fila['type'];
        $_SESSION['user_id'] = $fila['id'];

        // Redirección según tipo de usuario
        if ($fila['type'] === 'administrador') {
            header("Location: ../frontend/interfacemain_admin.php");
        } else {
            header("Location: ../frontend/interfacemain_user.php");
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