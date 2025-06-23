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
?>

<script>
    var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
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
</head>
<script>
function actualizarEstadoSlots() {
    fetch('../backend/get_slots_status.php')
        .then(response => response.json())
        .then(data => {
            let disponibles = 0;
            let ocupados = 0;
            let misReservas = 0;

            // Limpiar clases anteriores
            document.querySelectorAll('.spot').forEach(el => {
                el.classList.remove('available', 'ocupado', 'reservado');
            });

            data.forEach(slot => {
                const el = document.querySelector(`.spot[data-id="${slot.id}"]`);
                if (!el) return;

                if (slot.estado === 'disponible') {
                    el.classList.add('available');
                    disponibles++;
                } else if (slot.estado === 'ocupado') {
                    el.classList.add('ocupado');
                    ocupados++;
                } else if (slot.estado === 'reservado' && slot.usuario == <?php echo $_SESSION['user_id']; ?>) {
                    el.classList.add('reservado');
                    misReservas++;
                } else {
                    el.classList.add('ocupado'); // Otro usuario lo reservó
                    ocupados++;
                }
            });

            document.getElementById('available-spaces').innerText = disponibles;
            document.getElementById('occupied-spaces').innerText = ocupados;
            document.getElementById('my-reservations').innerText = misReservas;
            document.getElementById('last-update').innerText = new Date().toLocaleTimeString();
        });
}

// Actualiza cada 5 segundos
setInterval(actualizarEstadoSlots, 5000);
actualizarEstadoSlots(); // Primera carga inmediata
</script>
<body>
    <nav>
        <ul class="menu-horizontal">
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg> 
                    Cuenta
                </a>
                <ul class="menu-vertical">
                    <li><a href="../frontend/editaccount_user.html">Editar sesión</a></li>
					    <li><a href="../backend/logout.php">Cerrar sesión</a></li>   
                </ul>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                    </svg> 
                    Usuarios
                </a>
                <ul class="menu-vertical">
                    <li><a href="../frontend/useronline.html">Usuarios conectados</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-p-square" viewBox="0 0 16 16">
                        <path d="M5.5 4.002h2.962C10.045 4.002 11 5.104 11 6.586c0 1.494-.967 2.578-2.55 2.578H6.784V12H5.5zm2.77 4.072c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z"/>
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                    </svg>
                    Slots
                </a>
                <ul class="menu-vertical">
                    <li><a href="../frontend/admin_slots.php">Visualizar slots</a></li>
                </ul>
            </li>
            <li>
                <a href="../frontend/registercars_user.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                        <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
                    </svg>
                    Registro de vehículos
                </a>
            </li>
        </ul>
    </nav>

    <header>
        <h1>Sistema de Control de Estacionamiento</h1>
        <div class="user-info">
                <span id="current-user">Usuario Conectado: <?php echo htmlspecialchars($_SESSION['usuario']); ?></span> | <span id="current-time"></span>
        </div>
    </header>
    
    <div class="container">
        <div class="dashboard">
            <div class="stats">
                <h3>Total</h3>
                <div class="value total" id="total-spaces">10</div>
            </div>
            <div class="stats">
                <h3>Ocupados</h3>
                <div class="value ocupados" id="occupied-spaces">0</div>
            </div>
            <div class="stats">
                <h3>Disponibles</h3>
                <div class="value disponibles" id="available-spaces">10</div>
            </div>
            <div class="stats">
                <h3>Mis Reservas</h3>
                <div class="value reservados" id="my-reservations">0</div>
            </div>
        </div>
        
        <div class="parking-layout">
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #28a745;"></div>
                    <span>Disponible</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #dc3545;"></div>
                    <span>Ocupado</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #6c757d;"></div>
                    <span>Mi Reserva</span>
                </div>
            </div>
            
            <div class="floor">
                <h2>Espacios de Estacionamiento</h2>
                
                <div class="parking-area">
                    <div class="row">
                        <div class="spot available" data-id="A1" title="Clic para reservar">A1</div>
                        <div class="spot available" data-id="B1" title="Clic para reservar">B1</div>
                    </div>  
                    <div class="row">
                        <div class="spot available" data-id="A2" title="Clic para reservar">A2</div>                    
                        <div class="spot available" data-id="B2" title="Clic para reservar">B2</div>                    
                    </div>
                    <div class="row">
                        <div class="spot available" data-id="A3" title="Clic para reservar">A3</div>                    
                        <div class="spot available" data-id="B3" title="Clic para reservar">B3</div>                    
                    </div>
                    <div class="row">
                        <div class="spot available" data-id="A4" title="Clic para reservar">A4</div>                    
                        <div class="spot available" data-id="B4" title="Clic para reservar">B4</div>                    
                    </div>
                    <div class="row">
                        <div class="spot available" data-id="A5" title="Clic para reservar">A5</div>                    
                        <div class="spot available" data-id="B5" title="Clic para reservar">B5</div>                    
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Panel de control para usuarios -->
        <div class="controls">
            <h2>Mis Reservas</h2>
            <div class="reservation-info">
                <p>Haz clic en un espacio <span style="color: #28a745; font-weight: bold;">disponible</span> para reservarlo.</p>
                <p>Haz clic en <span style="color: #6c757d; font-weight: bold;">tu reserva</span> para cancelarla.</p>
            </div>
            
            <!-- Formulario de reserva rápida -->
            <div class="quick-reserve">
                <h3>Reserva Rápida</h3>
                <div class="form-group">
                    <label for="spot-select">Seleccionar lugar:</label>
                    <select id="spot-select">
                        <option value="">-- Seleccione un lugar disponible --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="duration-select">Duración:</label>
                    <select id="duration-select">
                        <option value="1">1 hora</option>
                        <option value="2">2 horas</option>
                        <option value="4">4 horas</option>
                        <option value="8">8 horas</option>
                    </select>
                </div>
                <button id="reserve-btn" class="btn-reserve">Reservar Espacio</button>
            </div>
            
            <!-- Lista de mis reservas -->
            <div class="my-reservations-list">
                <h3>Mis Reservas Activas</h3>
                <div id="reservations-container">
                    <p class="no-reservations">No tienes reservas activas</p>
                </div>
            </div>
        </div>
        
        <!-- Botón de actualización -->
        <div class="refresh-section">
            <button id="refresh-btn" class="btn-refresh">🔄 Actualizar Estado</button>
            <small>Última actualización: <span id="last-update">--:--</span></small>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="confirmModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h3>Confirmar Reserva</h3>
            <p id="confirm-message"></p>
            <div class="modal-buttons">
                <button id="confirm-yes" class="btn-confirm">Sí, Reservar</button>
                <button id="confirm-no" class="btn-cancel">Cancelar</button>
            </div>
        </div>
    </div>

    <style>
        /* Estilos adicionales para mejorar la interfaz */
        :root {
            --color-success: #28a745;
            --color-danger: #dc3545;
            --color-warning: #ffc107;
            --color-info: #17a2b8;
            --color-secondary: #6c757d;
        }

       
    </style>

    <script src="../js/parkingslots.js"></script>
</body>
</html>