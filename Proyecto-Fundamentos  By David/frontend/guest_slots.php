    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Estado de slots | UTA</title>
        <link rel="stylesheet" href="../css/stylesinterfaceslot.css">
    </head>
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
                        <li><a href="login.html">Iniciar sesión</a></li>
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
                        <li><a href="guest-slots.html">Visualizar slots</a></li>
                    </ul>
                </li>
                
            </ul>
        </nav>

        <header>
            <h1>Sistema de Control de Estacionamiento</h1>
            <div class="user-info">
                <span id="current-user">Invitado </span> | 
                <span id="current-time"></span>
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
    <script src="../js/guest_slots.js"></script>
    </body>
    </html>