document.addEventListener("DOMContentLoaded", () => {
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    const mobileSignUp = document.getElementById('mobileSignUp');
    const mobileSignIn = document.getElementById('mobileSignIn');

    // Cambiar entre formularios (modo escritorio)
    if (signUpButton) {
        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });
    }

    if (signInButton) {
        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    }

    // Cambiar entre formularios (modo móvil)
    if (mobileSignUp) {
        mobileSignUp.addEventListener('click', () => {
            container.classList.add("mobile-signup");
            mobileSignUp.classList.add("active");
            mobileSignIn.classList.remove("active");
        });
    }

    if (mobileSignIn) {
        mobileSignIn.addEventListener('click', () => {
            container.classList.remove("mobile-signup");
            mobileSignIn.classList.add("active");
            mobileSignUp.classList.remove("active");
        });
    }

    // Adaptar al tamaño de pantalla
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            container.classList.remove("mobile-signup");
        }
    });

   // Mostrar formulario de recuperación
    document.getElementById("forgot-link").addEventListener("click", function (e) {
    e.preventDefault();
    document.querySelector(".sign-in-container").style.display = "none";
    document.querySelector(".sign-up-container").style.display = "none";
    document.querySelector(".overlay-container").style.display = "none";
    document.getElementById("forgotForm").style.display = "block";
    });

// Volver al login desde recuperar contraseña
    document.getElementById("backToLogin").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("forgotForm").style.display = "none";
    document.querySelector(".sign-in-container").style.display = "block";
    document.querySelector(".sign-up-container").style.display = window.innerWidth > 768 ? "block" : "none";
    document.querySelector(".overlay-container").style.display = "block";
    });

    // Mostrar errores pasados por URL al login
    const params = new URLSearchParams(window.location.search);
    if (params.has("error")) {
        const errorType = params.get("error");
        let message = "";
        switch (errorType) {
            case "campos":
                message = "❌ Por favor completa todos los campos.";
                break;
            case "correo_invalido":
                message = "❌ Correo electrónico inválido.";
                break;
            case "correo_existe":
                message = "❌ Este correo ya está registrado.";
                break;
            case "contrasena":
                message = "❌ Contraseña incorrecta.";
                break;
            case "usuario":
                message = "❌ Usuario o email no encontrado. Verifica tus datos.";
                break;
            default:
                message = "❌ Ocurrió un error inesperado.";
        }
        mostrarMensaje(message, false, "loginMessage");
    }

    // Envío del formulario de registro
    document.getElementById("registerForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const usuario = formData.get("usuario").trim();
        const email = formData.get("email").trim();
        const password = formData.get("password").trim();

        // Validaciones básicas
        if (!usuario || !email || !password) {
            mostrarMensaje("❌ Por favor completa todos los campos.", false, "registerMessage");
            return;
        }

        if (!validarEmail(email)) {
            mostrarMensaje("❌ Correo electrónico inválido.", false, "registerMessage");
            return;
        }

        if (password.length < 6) {
            mostrarMensaje("❌ La contraseña debe tener al menos 6 caracteres.", false, "registerMessage");
            return;
        }

        mostrarMensaje("⏳ Procesando...", true, "registerMessage");

        try {
    const response = await fetch("../database/registro.php", {
        method: "POST",
        body: formData
    });

    // LÍNEAS NUEVAS PARA DEBUG
    console.log("Estado de la respuesta:", response.status);
    const responseText = await response.text();
    console.log("Respuesta completa del servidor:", responseText);
    
    const data = JSON.parse(responseText);
    mostrarMensaje(data.message, data.success, "registerMessage");
            if (data.success) {
                form.reset();
            }

        } catch (error) {
            mostrarMensaje("❌ Error en el servidor.", false, "registerMessage");
        }
    });

    // Función para validar email
    function validarEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Función para mostrar mensajes y ocultarlos
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

    // Mejorar UX del input de usuario/email en el formulario de login
    const usuarioInput = document.querySelector('.sign-in-container input[name="usuario"]');
    const helpText = document.querySelector('.help-text');
    
    if (usuarioInput && helpText) {
        usuarioInput.addEventListener('input', function() {
            const value = this.value.trim();
            
            if (value.includes('@')) {
                // Es un email
                this.setAttribute('placeholder', 'usuario@ejemplo.com');
                helpText.textContent = '📧 Ingresando como: Correo electrónico';
                helpText.style.color = '#007bff';
            } else if (value.length > 0) {
                // Es un username
                this.setAttribute('placeholder', 'tu_usuario');
                helpText.textContent = '👤 Ingresando como: Nombre de usuario';
                helpText.style.color = '#28a745';
            } else {
                // Campo vacío
                this.setAttribute('placeholder', 'Usuario o Email');
                helpText.textContent = 'Puedes usar tu nombre de usuario o correo electrónico';
                helpText.style.color = '#666';
            }
        });
        
        // Validación cuando pierde el foco
        usuarioInput.addEventListener('blur', function() {
            const value = this.value.trim();
            
            if (value.includes('@')) {
                // Validar formato de email
                if (!validarEmail(value)) {
                    helpText.textContent = '⚠️ Formato de email inválido';
                    helpText.style.color = '#dc3545';
                } else {
                    helpText.textContent = '✓ Email válido';
                    helpText.style.color = '#28a745';
                }
            } else if (value.length > 0) {
                // Validar username (letras, números, puntos, guiones)
                const usernameRegex = /^[a-zA-Z0-9_.-]+$/;
                if (!usernameRegex.test(value)) {
                    helpText.textContent = '⚠️ Usuario solo puede contener letras, números, guiones y puntos';
                    helpText.style.color = '#dc3545';
                } else if (value.length < 3) {
                    helpText.textContent = '⚠️ Usuario debe tener al menos 3 caracteres';
                    helpText.style.color = '#dc3545';
                } else {
                    helpText.textContent = '✓ Usuario válido';
                    helpText.style.color = '#28a745';
                }
            }
        });
        
        // Resetear cuando recupera el foco
        usuarioInput.addEventListener('focus', function() {
            if (helpText.textContent.includes('⚠️') || helpText.textContent.includes('✓')) {
                helpText.textContent = 'Puedes usar tu nombre de usuario o correo electrónico';
                helpText.style.color = '#666';
            }
        });
    }
});