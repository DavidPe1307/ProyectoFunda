<?php
ob_clean();
require_once __DIR__ . '/database.php'; // Conecta usando tu archivo database.php

header('Content-Type: application/json');

// Obtener datos del formulario
$usuario = strtolower(trim($_POST['usuario'] ?? '')); 
$email = strtolower(trim($_POST['email'] ?? '')); // Convertir a minúsculas y quitar espacios
$password = $_POST['password'] ?? '';

// Validar que los campos no estén vacíos
if (empty($usuario) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => '❌ Por favor completa todos los campos.']);
    exit;
}

// Validar formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => '❌ Correo electrónico inválido.']);
    exit;
}

// Verificar si el correo ya existe
$stmt = $conn->prepare("SELECT id FROM User_nat WHERE LOWER(email_user) = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => '❌ Este correo ya está registrado.']);
    exit;
}
$stmt->close();

//Verificar que la contraseña tenga 6 caracteres 
if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => '❌ La contraseña debe tener al menos 6 caracteres.']);
    exit;
}

// Verificar si el usuario ya existe
$stmt = $conn->prepare("SELECT id FROM User_nat WHERE LOWER(name_user) = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => '❌ El nombre de usuario ya existe.']);
    exit;
}
$stmt->close();

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar la sentencia SQL
$stmt = $conn->prepare("INSERT INTO User_nat (name_user, email_user, password_user) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $email, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '✅ Registro exitoso. Ahora puedes iniciar sesión.']);
} else {
    echo json_encode(['success' => false, 'message' => '❌ Error al registrar usuario.']);
}

// Cerrar conexiones
$stmt->close(); 
$conn->close();
?>