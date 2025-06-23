let currentUser = window.currentUser;


// Carga y actualización de slots
async function fetchSlotsFromServer() {
    try {
        const response = await fetch(`../backend/obtener_slots.php?userId=${currentUser}`);
        const slots = await response.json();

        slots.forEach(slot => {
            const spot = document.querySelector(`.spot[data-id="${slot.id}"]`);
            if (!spot) return;

            spot.classList.remove('available', 'occupied', 'my-reservation');

            if (slot.estado === 'libre' || slot.estado === 'disponible') {
                spot.classList.add('available');
                spot.title = `Espacio ${slot.id} disponible - Clic para reservar`;
            } else if (slot.estado === 'ocupado') {
                if (slot.usuarioId == currentUser) {
                    spot.classList.add('my-reservation');
                    spot.title = `Tu reserva en espacio ${slot.id} - Clic para cancelar`;
                } else {
                    spot.classList.add('occupied');
                    spot.title = `Espacio ${slot.id} ocupado`;
                }
            }
        });

        updateCounters();
        updateAvailableSpots();
        updateMyReservationsList();
        updateLastUpdate();

        // Re-asignar eventos click a spots
        assignSpotClickHandlers();

    } catch (error) {
        console.error('Error al cargar los slots:', error);
        alert('No se pudo cargar el estado actual de los slots');
    }
}

function assignSpotClickHandlers() {
    document.querySelectorAll('.spot').forEach(spot => {
        spot.onclick = () => {
            const spotId = spot.dataset.id;

            if (spot.classList.contains('available')) {
                showConfirmModal(`¿Deseas reservar el espacio ${spotId}?`, () => reserveSpot(spotId));
            } else if (spot.classList.contains('my-reservation')) {
                showConfirmModal(`¿Deseas cancelar tu reserva del espacio ${spotId}?`, () => cancelReservation(spotId));
            } else {
                alert(`El espacio ${spotId} no está disponible.`);
            }
        };
    });
}

// Funciones para reservar y cancelar con fetch POST
async function reserveSpot(spotId, duration = 2) {
    try {
        const response = await fetch('../backend/reservar_slot.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ slotId: spotId, userId: currentUser, duration })
        });
        const result = await response.json();

        if (result.success) {
            alert(result.message);
            await fetchSlotsFromServer();
        } else {
            alert('No se pudo reservar el espacio: ' + result.message);
        }
    } catch (error) {
        alert('Error al reservar el espacio');
        console.error(error);
    }
}

async function cancelReservation(spotId) {
    try {
        const response = await fetch('../backend/liberar_slot.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ slotId: spotId, userId: currentUser })
        });
        const result = await response.json();

        if (result.success) {
            alert(result.message);
            await fetchSlotsFromServer();
        } else {
            alert('No se pudo cancelar la reserva: ' + result.message);
        }
    } catch (error) {
        alert('Error al cancelar la reserva');
        console.error(error);
    }
}

function updateCounters() {
    const spots = document.querySelectorAll('.spot');
    const total = spots.length;
    const occupied = document.querySelectorAll('.spot.occupied').length;
    const myReservations = document.querySelectorAll('.spot.my-reservation').length;
    const available = total - occupied - myReservations;

    document.getElementById('total-spaces').textContent = total;
    document.getElementById('occupied-spaces').textContent = occupied;
    document.getElementById('available-spaces').textContent = available;
    document.getElementById('my-reservations').textContent = myReservations;
}

function updateAvailableSpots() {
    const spotSelect = document.getElementById('spot-select');
    spotSelect.innerHTML = '<option value="">-- Seleccione un lugar disponible --</option>';
    document.querySelectorAll('.spot.available').forEach(spot => {
        const option = document.createElement('option');
        option.value = spot.dataset.id;
        option.textContent = spot.dataset.id;
        spotSelect.appendChild(option);
    });
}

function updateMyReservationsList() {
    const container = document.getElementById('reservations-container');
    const myReservedSpots = Array.from(document.querySelectorAll('.spot.my-reservation'));

    if (myReservedSpots.length === 0) {
        container.innerHTML = '<p class="no-reservations">No tienes reservas activas</p>';
        return;
    }

    container.innerHTML = myReservedSpots.map(spot => `
        <div class="reservation-item">
            <strong>${spot.dataset.id}</strong>
            <button class="cancel-btn" onclick="showConfirmModal('¿Cancelar reserva del espacio ${spot.dataset.id}?', () => cancelReservation('${spot.dataset.id}'));">Cancelar</button>
        </div>
    `).join('');
}

function updateLastUpdate() {
    document.getElementById('last-update').textContent = new Date().toLocaleTimeString();
}

function showConfirmModal(message, onConfirm) {
    document.getElementById('confirm-message').textContent = message;
    document.getElementById('confirmModal').style.display = 'block';
    window.currentConfirmAction = onConfirm;
}

// Modal botones
document.getElementById('confirm-yes').onclick = () => {
    if (window.currentConfirmAction) window.currentConfirmAction();
    document.getElementById('confirmModal').style.display = 'none';
};
document.getElementById('confirm-no').onclick = () => {
    document.getElementById('confirmModal').style.display = 'none';
};

// Botón reserva rápida
document.getElementById('reserve-btn').onclick = () => {
    const spotSelect = document.getElementById('spot-select');
    const durationSelect = document.getElementById('duration-select');
    const spotId = spotSelect.value;
    const duration = parseInt(durationSelect.value) || 2;

    if (!spotId) {
        alert('Por favor selecciona un espacio disponible');
        return;
    }

    showConfirmModal(`¿Deseas reservar el espacio ${spotId} por ${duration} hora(s)?`, () => reserveSpot(spotId, duration));
};

// Botón refrescar manual
document.getElementById('refresh-btn').onclick = fetchSlotsFromServer;

// Inicializar la carga y eventos
fetchSlotsFromServer();