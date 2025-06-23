<?php
// Asegura que las cookies de sesión estén disponibles en todo el sitio
ini_set('session.cookie_path', '/');
ini_set('session.cookie_httponly', 1);

// Inicia la sesión
session_start();

// Cabeceras para evitar caché del navegador
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Validar sesión y tipo de usuario administrador
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'administrador') {
    // Redirige al login si no está logueado o no es administrador
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
	<title>Pagina de bienvenida | UTA</title>
	<link rel="stylesheet" href="../css/styleusersonline.css">
</head>
<body>
    <nav>
        <nav>
		<ul class="menu-horizontal">
			<li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg> Cuenta</a>
                    <ul class="menu-vertical">
					    <li><a href="#">Editar sesión</a></li>
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
					<li><a href="../frontend/usersonline.php">Usuarios conectados</a></li>
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
			<li><a href="/frontend/registercars.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                    <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
                    <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
                    </svg>
                    Registro de vehículos</a>
                    <ul class="menu-vertical">

				</ul></li>

		</ul>
	</nav>
    </nav>

    <div class="main-content">
        <div class="head">
            <h1>Administración de Usuarios</h1>
            <h2>Panel de Control - UTA</h2>
        </div>

        <div class="user-management-container">
            <!-- Estadísticas -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number" id="totalUsers"></div>
                    <div class="stat-label">Total Usuarios</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="activeUsers"></div>
                    <div class="stat-label">Usuarios Activos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="blockedUsers"></div>
                    <div class="stat-label">Usuarios Bloqueados</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="adminUsers"></div>
                    <div class="stat-label">Administradores</div>
                </div>
            </div>

            <!-- Barra de búsqueda y filtros -->
            <div class="search-bar">
                <input type="text" class="search-input" id="searchInput" placeholder="🔍 Buscar usuarios por nombre o email...">
                <select class="filter-select" id="statusFilter">
                    <option value="">Todos los estados</option>
                    <option value="active">Activos</option>
                    <option value="blocked">Bloqueados</option>
                    <option value="offline">Desconectados</option>
                </select>
                <select class="filter-select" id="roleFilter">
                    <option value="">Todos los roles</option>
                    <option value="admin">Administradores</option>
                    <option value="user">Usuarios</option>
                </select>
            </div>

            <!-- Tabla de usuarios -->
            <table class="users-table" id="usersTable">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Última Conexión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <!-- Los datos se cargarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para confirmación de acciones -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h3 id="modalTitle">Confirmar Acción</h3>
            <p id="modalMessage">¿Estás seguro de que quieres realizar esta acción?</p>
            <div class="modal-actions">
                <button class="btn btn-cancel" onclick="closeModal()">Cancelar</button>
                <button class="btn btn-confirm" id="confirmButton">Confirmar</button>
            </div>
        </div>
    </div>

    <script>
       let users = [];
     

async function fetchUsersFromServer() {
    try {
        const response = await fetch('../backend/get_users.php');
        const data = await response.json();

        if (data.success) {
            users = data.users;
            renderUsersTable();
        } else {
            showNotification('Error: ' + data.message, 'error');
        }
    } catch (error) {
        showNotification('Error al cargar usuarios', 'error');
        console.error(error);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    fetchUsersFromServer();
    ...
});

        // Función para renderizar la tabla de usuarios
        function renderUsersTable(filteredUsers = users) {
            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = '';

            filteredUsers.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><strong>${user.name}</strong></td>
                    <td>${user.email}</td>
                    <td><span class="role-badge role-${user.role}">${user.role === 'admin' ? 'Administrador' : 'Usuario'}</span></td>
                    <td><span class="status-badge status-${user.status}">${getStatusText(user.status)}</span></td>
                    <td>${formatDate(user.lastConnection)}</td>
                    <td>
                        <div class="action-buttons">
                            ${user.status === 'blocked' 
                                ? `<button class="btn btn-unblock" onclick="showModal('unblock', ${user.id})">🔓 Desbloquear</button>`
                                : `<button class="btn btn-block" onclick="showModal('block', ${user.id})">🚫 Bloquear</button>`
                            }
                            <button class="btn btn-role" onclick="showModal('changeRole', ${user.id})">🔄 Cambiar Rol</button>
                            <button class="btn btn-edit" onclick="editUser(${user.id})">✏️ Editar</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });

            updateStats();
        }

        // Función para obtener el texto del estado
        function getStatusText(status) {
            switch(status) {
                case 'active': return 'Activo';
                case 'blocked': return 'Bloqueado';
                case 'offline': return 'Desconectado';
                default: return status;
            }
        }

        // Función para formatear la fecha
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Función para actualizar estadísticas
        function updateStats() {
            document.getElementById('totalUsers').textContent = users.length;
            document.getElementById('activeUsers').textContent = users.filter(u => u.status === 'active').length;
            document.getElementById('blockedUsers').textContent = users.filter(u => u.status === 'blocked').length;
            document.getElementById('adminUsers').textContent = users.filter(u => u.role === 'admin').length;
        }

        // Función para mostrar modal de confirmación
        function showModal(action, userId) {
            currentAction = action;
            currentUserId = userId;
            const user = users.find(u => u.id === userId);
            const modal = document.getElementById('confirmModal');
            const title = document.getElementById('modalTitle');
            const message = document.getElementById('modalMessage');

            switch(action) {
                case 'block':
                    title.textContent = 'Bloquear Usuario';
                    message.textContent = `¿Estás seguro de que quieres bloquear a ${user.name}?`;
                    break;
                case 'unblock':
                    title.textContent = 'Desbloquear Usuario';
                    message.textContent = `¿Estás seguro de que quieres desbloquear a ${user.name}?`;
                    break;
                case 'changeRole':
                    title.textContent = 'Cambiar Rol';
                    const newRole = user.role === 'admin' ? 'Usuario' : 'Administrador';
                    message.textContent = `¿Estás seguro de que quieres cambiar el rol de ${user.name} a ${newRole}?`;
                    break;
            }

            modal.style.display = 'block';
        }

        // Función para cerrar modal
        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
            currentAction = null;
            currentUserId = null;
        }

        // Función para confirmar acción
        function confirmAction() {
            const user = users.find(u => u.id === currentUserId);
            
            switch(currentAction) {
                case 'block':
                    user.status = 'blocked';
                    showNotification(`Usuario ${user.name} ha sido bloqueado`, 'success');
                    break;
                case 'unblock':
                    user.status = 'active';
                    showNotification(`Usuario ${user.name} ha sido desbloqueado`, 'success');
                    break;
                case 'changeRole':
                    user.role = user.role === 'admin' ? 'user' : 'admin';
                    const newRoleText = user.role === 'admin' ? 'Administrador' : 'Usuario';
                    showNotification(`Rol de ${user.name} cambiado a ${newRoleText}`, 'success');
                    break;
            }
            
            renderUsersTable();
            closeModal();
        }

        // Función para editar usuario
        function editUser(userId) {
            const user = users.find(u => u.id === userId);
            const newName = prompt('Nuevo nombre:', user.name);
            const newEmail = prompt('Nuevo email:', user.email);
            
            if (newName && newEmail) {
                user.name = newName;
                user.email = newEmail;
                renderUsersTable();
                showNotification(`Usuario ${user.name} actualizado correctamente`, 'success');
            }
        }

        // Función para mostrar notificaciones
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 25px;
                border-radius: 10px;
                color: white;
                font-weight: 600;
                z-index: 10000;
                animation: slideIn 0.3s ease;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            `;
            
            switch(type) {
                case 'success':
                    notification.style.background = '#28a745';
                    break;
                case 'error':
                    notification.style.background = '#dc3545';
                    break;
                default:
                    notification.style.background = '#007bff';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Función para filtrar usuarios
        function filterUsers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const roleFilter = document.getElementById('roleFilter').value;

            let filteredUsers = users.filter(user => {
                const matchesSearch = user.name.toLowerCase().includes(searchTerm) || 
                                    user.email.toLowerCase().includes(searchTerm);
                const matchesStatus = !statusFilter || user.status === statusFilter;
                const matchesRole = !roleFilter || user.role === roleFilter;
                
                return matchesSearch && matchesStatus && matchesRole;
            });

            renderUsersTable(filteredUsers);
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            renderUsersTable();
            
            // Búsqueda en tiempo real
            document.getElementById('searchInput').addEventListener('input', filterUsers);
            document.getElementById('statusFilter').addEventListener('change', filterUsers);
            document.getElementById('roleFilter').addEventListener('change', filterUsers);
            
            // Confirmar acción en modal
            document.getElementById('confirmButton').addEventListener('click', confirmAction);
            
            // Cerrar modal al hacer clic fuera
            document.getElementById('confirmModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
            
            // Cerrar modal con tecla Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });

        // Agregar estilos para animaciones
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        `;
        document.head.appendChild(style);