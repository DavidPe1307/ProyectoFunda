<?php
include '../dabase/database.php'; // Tu conexión a la base de datos

$query = "SELECT * FROM espacios"; // Asumo que así se llama tu tabla
$result = mysqli_query($conexion, $query);

$slots = [];
while ($row = mysqli_fetch_assoc($result)) {
    $slots[] = $row;
}

echo json_encode($slots); // Devuelve un JSON
?>