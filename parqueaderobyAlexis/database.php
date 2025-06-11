<?php
// Detalles de conexión
$host = "shuttle.proxy.rlwy.net";
$port = 52599;
$user = "root";
$password = "XHoGxnkbGUvXvlpOyxvvUAJXZkxOzbLp";
$database = "railway";

// Mostrar errores detallados solo durante el desarrollo
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Crear conexión
    $conn = new mysqli($host, $user, $password, $database, $port);
    $conn->set_charset("utf8mb4"); // Establecer codificación recomendada

    echo "✅ Conexión exitosa a la base de datos.";
} catch (Exception $e) {
    // Manejo de error más elegante
    error_log("❌ Error de conexión: " . $e->getMessage());
    echo "❌ No se pudo conectar a la base de datos.";
}
?>
