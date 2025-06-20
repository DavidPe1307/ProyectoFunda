/**
 * Función para alternar la visibilidad de campos de contraseña
 * @param {string} inputId - ID del campo de contraseña
 */
function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById('eye-icon-' + inputId);
    
    if (!passwordInput || !eyeIcon) {
        console.error('No se encontró el input o el icono para ID:', inputId);
        return;
    }
    
    if (passwordInput.type === 'password') {
        // Mostrar contraseña
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path d="M12 4.5c-6.75 0-12 5.25-12 7.5s5.25 7.5 12 7.5 12-5.25 12-7.5-5.25-7.5-12-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5zm0-7c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"/>
            <path d="M2 2l20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        `;
        eyeIcon.parentElement.setAttribute('aria-label', 'Ocultar contraseña');
        eyeIcon.parentElement.setAttribute('title', 'Ocultar contraseña');
    } else {
        // Ocultar contraseña
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path d="M12 4.5c-6.75 0-12 5.25-12 7.5s5.25 7.5 12 7.5 12-5.25 12-7.5-5.25-7.5-12-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5zm0-7c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"/>
        `;
        eyeIcon.parentElement.setAttribute('aria-label', 'Mostrar contraseña');
        eyeIcon.parentElement.setAttribute('title', 'Mostrar contraseña');
    }
}

/**
 * Inicializar los atributos de accesibilidad cuando se carga la página
 */
document.addEventListener('DOMContentLoaded', function () {
  const toggles = document.querySelectorAll('.password-toggle');

  toggles.forEach(toggle => {
    toggle.addEventListener('click', function () {
      const container = toggle.closest('.password-container');
      const input = container.querySelector('input[type="password"], input[type="text"]');

      if (input) {
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        toggle.classList.toggle('fa-eye');
        toggle.classList.toggle('fa-eye-slash');
        toggle.title = type === 'password' ? 'Mostrar contraseña' : 'Ocultar contraseña';
      }
    });
  });
});

/**
 * Función alternativa que busca automáticamente el campo de contraseña
 * Útil si no quieres especificar IDs
 */
function togglePasswordByContainer(buttonElement) {
    const container = buttonElement.closest('.password-container');
    const passwordInput = container.querySelector('.password-input');
    const eyeIcon = buttonElement.querySelector('.eye-icon');
    
    if (!passwordInput || !eyeIcon) {
        console.error('No se encontró el input o el icono en el contenedor');
        return;
    }
    
    if (passwordInput.type === 'password') {
        // Mostrar contraseña
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
            <path d="M12 4.5c-6.75 0-12 5.25-12 7.5s5.25 7.5 12 7.5 12-5.25 12-7.5-5.25-7.5-12-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5zm0-7c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"/>
            <path d="M2 2l20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        `;
        buttonElement.setAttribute('aria-label', 'Ocultar contraseña');
    } else {
        // Ocultar contraseña
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
            <path d="M12 4.5c-6.75 0-12 5.25-12 7.5s5.25 7.5 12 7.5 12-5.25 12-7.5-5.25-7.5-12-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5zm0-7c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"/>
        `;
        buttonElement.setAttribute('aria-label', 'Mostrar contraseña');
    }
}