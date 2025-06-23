<?php
// Asegura que las cookies de sesión estén disponibles en todo el sitio
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);

// Inicia la sesión
session_start();
// Evitar caché
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Validar sesión
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'usuario') {
    header("Location: ../frontend/login.html");
    exit();
}
?>

<script>
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    if (!isLoggedIn) {
        window.location.href = '../frontend/login.html';
    }
</script>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de slots | UTA</title>
    <link rel="stylesheet" href="../css/stylesinterfaceslot.css">
    <style>
        .spot.available { background-color: #28a745; }
        .spot.occupied { background-color: #dc3545; }
        .spot.reserved { background-color: #6c757d; }
    </style>
</head>
<body>
    <header>
        <h1>Sistema de Control de Estacionamiento</h1>
        <div class="user-info">
            <span id="current-user">Usuario Conectado: <?php echo htmlspecialchars($_SESSION['usuario']); ?></span> |
            <span id="current-time"></span>
        </div>
    </header>

    <div class="container">
        <!-- Indicadores -->
        <div class="dashboard">
            <div class="stats"><h3>Disponibles</h3><div id="available-spaces">0</div></div>
            <div class="stats"><h3>Ocupados</h3><div id="occupied-spaces">0</div></div>
            <div class="stats"><h3>Mis Reservas</h3><div id="my-reservations">0</div></div>
        </div>

        <!-- Slots -->
        <div class="parking-area">
            <div class="spot" data-id="A1">A1</div>
            <div class="spot" data-id="A2">A2</div>
            <div class="spot" data-id="A3">A3</div>
            <div class="spot" data-id="A4">A4</div>
            <div class="spot" data-id="A5">A5</div>
            <div class="spot" data-id="B1">B1</div>
            <div class="spot" data-id="B2">B2</div>
            <div class="spot" data-id="B3">B3</div>
            <div class="spot" data-id="B4">B4</div>
            <div class="spot" data-id="B5">B5</div>
        </div>

        <!-- Última actualización -->
        <div>Última actualización: <span id="last-update">--:--</span></div>
    </div>

    <script>
        const userId = <?php echo json_encode($_SESSION['user_id']); ?>;

        function actualizarEstadoSlots() {
            fetch('../backend/get_slots_status.php')
                .then(res => res.json())
                .then(data => {
                    let disponibles = 0;
                    let ocupados = 0;
                    let misReservas = 0;

                    document.querySelectorAll('.spot').forEach(el => {
                        el.classList.remove('available', 'occupied', 'reserved');
                    });

                    data.forEach(slot => {
                        const el = document.querySelector(`.spot[data-id="${slot.id}"]`);
                        if (!el) return;

                        if (slot.estado === 'disponible') {
                            el.classList.add('available');
                            disponibles++;
                        } else if (slot.estado === 'ocupado') {
                            el.classList.add('occupied');
                            ocupados++;
                        } else if (slot.estado === 'reservado') {
                            if (slot.usuario == userId) {
                                el.classList.add('reserved');
                                misReservas++;
                            } else {
                                el.classList.add('occupied');
                                ocupados++;
                            }
                        }
                    });

                    document.getElementById('available-spaces').textContent = disponibles;
                    document.getElementById('occupied-spaces').textContent = ocupados;
                    document.getElementById('my-reservations').textContent = misReservas;
                    document.getElementById('last-update').textContent = new Date().toLocaleTimeString();
                });
        }

        setInterval(actualizarEstadoSlots, 5000);
        actualizarEstadoSlots();
    </script>
</body>
</html>
