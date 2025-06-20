const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const app = express();
const port = process.env.PORT || 3000;

app.use(cors()); // Para permitir peticiones desde tu frontend
app.use(bodyParser.json()); // Para leer JSON en POST

// Simular base de datos en memoria
let slots = [
  { id: 'A1', estado: 'libre', usuarioId: null },
  { id: 'B1', estado: 'libre', usuarioId: null },
  { id: 'A2', estado: 'libre', usuarioId: null },
  { id: 'B2', estado: 'libre', usuarioId: null },
  // Agrega más slots según tu diseño
];

// Obtener estado de slots
app.get('/obtener_slots', (req, res) => {
  const userId = req.query.userId;
  // Puedes filtrar o modificar respuesta según userId si quieres
  res.json(slots);
});

// Reservar un slot
app.post('/reservar_slot', (req, res) => {
  const { slotId, userId, duration } = req.body;

  const slot = slots.find(s => s.id === slotId);
  if (!slot) {
    return res.json({ success: false, message: 'Espacio no encontrado' });
  }
  if (slot.estado === 'ocupado') {
    return res.json({ success: false, message: 'Espacio ya ocupado' });
  }

  slot.estado = 'ocupado';
  slot.usuarioId = userId;
  // duration lo puedes usar para manejar expiración si quieres

  return res.json({ success: true, message: `Espacio ${slotId} reservado` });
});

// Liberar un slot
app.post('/liberar_slot', (req, res) => {
  const { slotId, userId } = req.body;

  const slot = slots.find(s => s.id === slotId);
  if (!slot) {
    return res.json({ success: false, message: 'Espacio no encontrado' });
  }
  if (slot.usuarioId !== userId) {
    return res.json({ success: false, message: 'No tienes permiso para liberar este espacio' });
  }

  slot.estado = 'libre';
  slot.usuarioId = null;

  return res.json({ success: true, message: `Reserva del espacio ${slotId} cancelada` });
});

app.listen(port, () => {
  console.log(`Servidor corriendo en http://localhost:${port}`);
});