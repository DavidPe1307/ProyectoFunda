
<?php
// Cabeceras para evitar caché
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-Type: application/json");

// Conexión a la base de datos Railway
$host = "shuttle.proxy.rlwy.net";
$port = 52599;
$database = "railway"; // Cambia si tu base tiene otro nombre
$user = "root";        // Cambia si tienes otro usuario
$password = "XHoGxnkbGUvXvlpOyxvvUAJXZkxOzbLp";

$conn = new mysqli($host, $user, $password, $database, $port);

// Verifica la conexión
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de conexión: ' . $conn->connect_error
    ]);
    exit();
}

// Consulta de usuarios
$sql = "SELECT id, nombre AS name, email, tipo AS role, estado AS status, ultima_conexion AS lastConnection FROM usuarios";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la consulta: ' . $conn->error
    ]);
    exit();
}

// Construcción del arreglo de usuarios
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Respuesta JSON
echo json_encode([
    'success' => true,
    'users' => $users
]);

$conn->close();
?>