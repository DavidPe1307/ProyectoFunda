<?php
require_once __DIR__ . '/database.php'; // Conecta usando tu archivo database.php

// Obtener datos del formulario
$usuario = $_POST['usuario'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validar que los campos no estén vacíos
if (empty($usuario) || empty($email) || empty($password)) {
    die("❌ Todos los campos son obligatorios.");
}

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar la sentencia SQL
$stmt = $conn->prepare("INSERT INTO User_nat (name_user, email_user, password_user) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $email, $hashed_password);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: index.html");
    exit();
} else {
    echo "❌ Error al registrar usuario: " . $conn->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
