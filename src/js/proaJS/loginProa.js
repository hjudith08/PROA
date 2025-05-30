const loginForm = document.getElementById('login');

function eliminarMensajesAnteriores() {
    const errores = document.querySelectorAll('.mensaje, .error-mensaje, .exito-mensaje');
    errores.forEach(el => el.remove());
}

function mostrarError(msg) {
    eliminarMensajesAnteriores();
    const panel = document.querySelector('.panel');
    const divError = document.createElement('div');
    divError.className = 'mensaje error-mensaje';
    divError.textContent = msg;
    panel.insertBefore(divError, loginForm);
}

function mostrarMensaje(msg) {
    eliminarMensajesAnteriores();
    const panel = document.querySelector('.panel');
    const divMsg = document.createElement('div');
    divMsg.className = 'mensaje exito-mensaje';
    divMsg.textContent = msg;
    panel.insertBefore(divMsg, loginForm);
}

loginForm.addEventListener("submit", async function(e) {
    e.preventDefault();

    eliminarMensajesAnteriores();

    const email = loginForm.querySelector("#email").value.trim();
    const password = loginForm.querySelector("#password").value.trim();

    if (!email || !password) {
        mostrarError("Por favor completa todos los campos.");
        return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    try {
        const response = await fetch('procesar-loginProa.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const data = await response.json();

        if (data.success) {
            mostrarMensaje("Inicio de sesión exitoso. Redirigiendo...");
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1000);
        } else {
            mostrarError(data.error || "Credenciales incorrectas");
        }
    } catch (error) {
        mostrarError("Error en el servidor");
        console.error(error);
    }
});