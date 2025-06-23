<?php
session_start();

// Cabeceras para evitar cache
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Validar sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../frontend/login.html");
    exit();
}

require_once __DIR__ . '/../database/database.php';

$user_id = $_SESSION['user_id'];

// Obtener datos del usuario
$stmt = $conn->prepare("SELECT name_user, email_user FROM User_nat WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    header("Location: ../frontend/login.html");
    exit();
}
$stmt->close();

// Obtener placas del usuario
$placas = [];
$stmt = $conn->prepare("SELECT placa FROM Placas WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $placas[] = $row['placa'];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cuenta | UTA</title>
    <link rel="stylesheet" href="../css/styleeditaccount.css">
</head>
<body>
    <header>
        <h1>Editar perfil</h1>
    </header>

    <div class="container">
        <div class="profile-form">
            <form id="profileForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($user['name_user']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email_user']); ?>" disabled>
                    </div>
                </div>

                <div class="license-plates-section">
                    <div class="license-plates-header">
                        <h3>Placas vehiculares registradas</h3>
                        <button type="button" class="add-plate-btn" onclick="showAddPlateForm()">Agregar placa</button>
                    </div>

                    <div class="add-plate-form" id="addPlateForm">
                        <input type="text" id="newPlate" placeholder="Ej: ABC-1234" maxlength="8">
                        <button type="button" onclick="addPlate()">Guardar</button>
                        <button type="button" onclick="hideAddPlateForm()">Cancelar</button>
                    </div>

                    <div class="plates-list" id="platesList">
                        <?php foreach ($placas as $placa): ?>
                            <div class="plate-item">
                                <span class="plate-number"><?php echo htmlspecialchars($placa); ?></span>
                                <button type="button" onclick="removePlate(this)">Eliminar</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit">Guardar cambios</button>
                    <button type="button" onclick="cancelChanges()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showAddPlateForm() {
            document.getElementById('addPlateForm').style.display = 'block';
        }

        function hideAddPlateForm() {
            document.getElementById('addPlateForm').style.display = 'none';
            document.getElementById('newPlate').value = '';
        }

        function addPlate() {
            const plateInput = document.getElementById('newPlate');
            const plateValue = plateInput.value.trim().toUpperCase();
            const plateRegex = /^[A-Z]{3}-\d{4}$/;

            if (!plateRegex.test(plateValue)) {
                alert('El formato de placa debe ser ABC-1234');
                return;
            }

            const existingPlates = Array.from(document.querySelectorAll('.plate-number')).map(el => el.textContent);
            if (existingPlates.includes(plateValue)) {
                alert('Esta placa ya está registrada');
                return;
            }

            const plateItem = document.createElement('div');
            plateItem.className = 'plate-item';
            plateItem.innerHTML = `
                <span class="plate-number">${plateValue}</span>
                <button type="button" onclick="removePlate(this)">Eliminar</button>
            `;

            document.getElementById('platesList').appendChild(plateItem);
            hideAddPlateForm();
        }

        function removePlate(button) {
            if (confirm('¿Eliminar esta placa?')) {
                button.parentElement.remove();
            }
        }

        function cancelChanges() {
            location.reload();
        }

        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Cambios guardados (simulado)');
            // Aquí se puede hacer un fetch/AJAX para guardar en backend
        });
    </script>
</body>
</html>
