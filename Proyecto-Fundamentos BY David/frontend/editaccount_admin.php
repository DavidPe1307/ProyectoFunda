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

// Validar sesión correcta
if (!isset($_SESSION['user_id'])) {
    header("Location: ../frontend/login.html");
    exit();
}
?>
<script>
    if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
        window.location.href = '../frontend/login.html';
    }
</script>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar cuenta | UTA</title>
	<link rel="stylesheet" href="../css/styleeditaccount.css">
</head>
<body>
    <nav>
        <ul class="menu-horizontal">
            <li><a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg> Cuenta</a>
                <ul class="menu-vertical">
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
                    <li><a href="../usersonline.html">Usuarios conectados</a></li>    
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
                    <li><a href="../interfaceslots.html">Estado de slots</a></li>
                </ul>
            </li>
            <li><a href="../registercars.html">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                    <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
                </svg>
                Registro de vehículos</a>
            </li>
        </ul>
    </nav>

    <header>
        <h1>Editar perfil</h1>
    </header>

    <div class="container">
        <div class="profile-form">
            <form id="profileForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" value="Juan Carlos Pérez" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" value="juan.perez@uta.edu.ec" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group phone-group">
                        <label for="telefono">Número telefónico</label>
                        <input type="tel" id="telefono" name="telefono" value="" placeholder="Ingrese su número telefónico">
                        <span class="phone-status phone-not-registered">No registrado</span>
                    </div>
                </div>

                <div class="license-plates-section">
                    <div class="license-plates-header">
                        <h3>Placas vehiculares registradas</h3>
                        <button type="button" class="add-plate-btn" onclick="showAddPlateForm()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                            Agregar placa
                        </button>
                    </div>

                    <div class="add-plate-form" id="addPlateForm">
                        <div class="plate-input-group">
                            <div class="form-group">
                                <label for="newPlate">Nueva placa vehicular</label>
                                <input type="text" id="newPlate" placeholder="Ej: ABC-1234" maxlength="8">
                            </div>
                            <div class="plate-actions">
                                <button type="button" class="save-plate-btn" onclick="addPlate()">Guardar</button>
                                <button type="button" class="cancel-plate-btn" onclick="hideAddPlateForm()">Cancelar</button>
                            </div>
                        </div>
                    </div>

                    <div class="plates-list" id="platesList">
                        <div class="plate-item">
                            <span class="plate-number">ABC-1234</span>
                            <button type="button" class="remove-plate-btn" onclick="removePlate(this)">Eliminar</button>
                        </div>
                        <div class="plate-item">
                            <span class="plate-number">XYZ-5678</span>
                            <button type="button" class="remove-plate-btn" onclick="removePlate(this)">Eliminar</button>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelChanges()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Estado inicial del teléfono
        let hasPhone = false;
        
        // Función para mostrar el formulario de agregar placa
        function showAddPlateForm() {
            document.getElementById('addPlateForm').classList.add('active');
            document.getElementById('newPlate').focus();
        }

        // Función para ocultar el formulario de agregar placa
        function hideAddPlateForm() {
            document.getElementById('addPlateForm').classList.remove('active');
            document.getElementById('newPlate').value = '';
        }

        // Función para agregar una nueva placa
        function addPlate() {
            const plateInput = document.getElementById('newPlate');
            const plateValue = plateInput.value.trim().toUpperCase();
            
            if (!plateValue) {
                alert('Por favor ingrese una placa válida');
                return;
            }

            // Validar formato de placa (letras-números)
            const plateRegex = /^[A-Z]{3}-\d{4}$/;
            if (!plateRegex.test(plateValue)) {
                alert('El formato de placa debe ser ABC-1234 (3 letras, guión, 4 números)');
                return;
            }

            // Verificar que la placa no exista ya
            const existingPlates = Array.from(document.querySelectorAll('.plate-number'))
                .map(el => el.textContent);
            
            if (existingPlates.includes(plateValue)) {
                alert('Esta placa ya está registrada');
                return;
            }

            // Crear el elemento de la placa
            const platesList = document.getElementById('platesList');
            const plateItem = document.createElement('div');
            plateItem.className = 'plate-item';
            plateItem.innerHTML = `
                <span class="plate-number">${plateValue}</span>
                <button type="button" class="remove-plate-btn" onclick="removePlate(this)">Eliminar</button>
            `;

            // Remover mensaje de estado vacío si existe
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) {
                emptyState.remove();
            }

            platesList.appendChild(plateItem);
            hideAddPlateForm();
        }

        // Función para eliminar una placa
        function removePlate(button) {
            if (confirm('¿Está seguro de que desea eliminar esta placa?')) {
                const plateItem = button.parentElement;
                plateItem.remove();

                // Si no quedan placas, mostrar mensaje de estado vacío
                const platesList = document.getElementById('platesList');
                if (platesList.children.length === 0) {
                    platesList.innerHTML = `
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
                                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
                            </svg>
                            <p>No hay placas vehiculares registradas</p>
                            <small>Agregue una placa usando el botón de arriba</small>
                        </div>
                    `;
                }
            }
        }

        // Función para validar y actualizar el estado del teléfono
        function updatePhoneStatus() {
            const phoneInput = document.getElementById('telefono');
            const phoneStatus = document.querySelector('.phone-status');
            const phoneValue = phoneInput.value.trim();

            if (phoneValue) {
                // Validar formato de teléfono ecuatoriano
                const phoneRegex = /^(\+593|593|0)?[0-9]{9,10}$/;
                if (phoneRegex.test(phoneValue)) {
                    phoneStatus.textContent = 'Registrado';
                    phoneStatus.className = 'phone-status phone-registered';
                    hasPhone = true;
                } else {
                    phoneStatus.textContent = 'Formato inválido';
                    phoneStatus.className = 'phone-status phone-not-registered';
                    hasPhone = false;
                }
            } else {
                phoneStatus.textContent = 'No registrado';
                phoneStatus.className = 'phone-status phone-not-registered';
                hasPhone = false;
            }
        }

        // Función para cancelar cambios
        function cancelChanges() {
            if (confirm('¿Está seguro de que desea cancelar los cambios?')) {
                // Restaurar valores originales
                document.getElementById('nombre').value = 'Juan Carlos Pérez';
                document.getElementById('telefono').value = '';
                updatePhoneStatus();
                hideAddPlateForm();
            }
        }

        // Función para manejar el envío del formulario
        function handleFormSubmit(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const nombre = formData.get('nombre').trim();
            const telefono = formData.get('telefono').trim();

            // Validaciones
            if (!nombre) {
                alert('El nombre es obligatorio');
                return;
            }

            if (telefono && !hasPhone) {
                alert('Por favor ingrese un número telefónico válido');
                return;
            }

            // Recopilar placas
            const plates = Array.from(document.querySelectorAll('.plate-number'))
                .map(el => el.textContent);

            // Simular envío de datos
            console.log('Datos a enviar:', {
                nombre,
                telefono: telefono || null,
                placas: plates
            });

            alert('Perfil actualizado correctamente');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Listener para el campo de teléfono
            document.getElementById('telefono').addEventListener('input', updatePhoneStatus);
            
            // Listener para el formulario
            document.getElementById('profileForm').addEventListener('submit', handleFormSubmit);
            
            // Listener para Enter en el campo de nueva placa
            document.getElementById('newPlate').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addPlate();
                }
            });

            // Inicializar estado del teléfono
            updatePhoneStatus();
        });

        // Formatear automáticamente la placa mientras se escribe
        document.getElementById('newPlate').addEventListener('input', function(e) {
            let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            
            if (value.length > 3) {
                value = value.substring(0, 3) + '-' + value.substring(3, 7);
            }
            
            e.target.value = value;
        });
    </script>
</body>
</html>