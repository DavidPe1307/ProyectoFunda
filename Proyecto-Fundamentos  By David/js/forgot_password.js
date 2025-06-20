document.addEventListener("DOMContentLoaded", () => {
    const recoverForm = document.getElementById("recoverPasswordForm");

    if (recoverForm) {
        recoverForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            console.log("🧪 Formulario de recuperación enviado");

            const email = document.getElementById("recoverEmail").value.trim();

            if (!email) {
                mostrarMensaje("❌ Por favor ingrese su correo electrónico.", false, "recoverMessage");
                return;
            }

            if (!validarEmail(email)) {
                mostrarMensaje("❌ Correo electrónico inválido.", false, "recoverMessage");
                return;
            }

            mostrarMensaje("⏳ Enviando enlace de recuperación...", true, "recoverMessage");

            try {
    const response = await fetch("../database/send_reset.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "email=" + encodeURIComponent(email),
    });

    const text = await response.text(); // 👈 primero obtenemos como texto
    let data;

    try {
        data = JSON.parse(text); // 👈 intentamos convertir a JSON
    } catch (e) {
        console.error("❌ La respuesta no es JSON válido:", text);
        mostrarMensaje("❌ Error interno. Contacta al administrador.", false, "recoverMessage");
        return;
    }

    mostrarMensaje(data.message, data.success, "recoverMessage");

    if (data.success) {
        recoverForm.reset();
    }
} catch (error) {
    console.error("❌ Error al conectar:", error);
    mostrarMensaje("❌ Ocurrió un error al intentar enviar el enlace. Intenta de nuevo.", false, "recoverMessage");
}
        });
    }

    // Validar correo
    function validarEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Mostrar mensajes con estilo
    function mostrarMensaje(texto, success, destinoId) {
        const mensajeHTML = `<div class="form-alert ${success ? 'success' : 'error'}"
            style="background:${success ? '#e0ffe0' : '#ffe0e0'}; 
            color:${success ? '#0a0' : '#a00'}; 
            padding:10px; 
            border-radius:5px; 
            margin:10px 0; 
            text-align:center;
            transition: opacity 0.5s ease;">${texto}</div>`;

        const destino = document.getElementById(destinoId);
        if (destino) {
            destino.innerHTML = mensajeHTML;

            setTimeout(() => {
                const mensajeElement = destino.querySelector('.form-alert');
                if (mensajeElement) {
                    mensajeElement.style.opacity = '0';
                    setTimeout(() => mensajeElement.remove(), 500);
                }
            }, 5000);
        }
    }
});