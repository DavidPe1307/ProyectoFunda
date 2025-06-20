// Solo para visualización de invitados
document.addEventListener('DOMContentLoaded', () => {
    const refreshBtn = document.getElementById('refresh-btn');

    // Función para obtener y mostrar estado
    async function fetchSlotStates() {
        try {
            const response = await fetch('http://localhost/Proyecto-Fundamentos/database/obtener_slots.php');
            const slots = await response.json();

            slots.forEach(slot => {
                const spot = document.querySelector(`.spot[data-id="${slot.id}"]`);
                if (!spot) return;

                spot.classList.remove('available', 'occupied', 'my-reservation');
                spot.textContent = slot.id;

                if (slot.estado === 'libre') {
                    spot.classList.add('available');
                    spot.title = 'Disponible';
                } else {
                    spot.classList.add('occupied');
                    spot.title = `Ocupado por ${slot.usuario}`;
                }
            });

            updateCounters();
            updateLastUpdate();

        } catch (err) {
            console.error('Error al cargar los slots:', err);
        }
    }

    // Contadores básicos
    function updateCounters() {
        const spots = document.querySelectorAll('.spot');
        const total = spots.length;
        const occupied = document.querySelectorAll('.spot.occupied').length;
        const available = document.querySelectorAll('.spot.available').length;

        document.getElementById('total-spaces').textContent = total;
        document.getElementById('occupied-spaces').textContent = occupied;
        document.getElementById('available-spaces').textContent = available;
        document.getElementById('my-reservations').textContent = 0;
    }

    function updateLastUpdate() {
        const now = new Date();
        const lastUpdate = document.getElementById('last-update');
        if (lastUpdate) {
            lastUpdate.textContent = now.toLocaleTimeString('es-ES');
        }
    }

    refreshBtn.addEventListener('click', fetchSlotStates);

    // Actualización inicial
    fetchSlotStates();
});
