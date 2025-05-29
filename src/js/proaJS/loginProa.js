loginForm.addEventListener("submit", async function(e) {
    e.preventDefault();

    eliminarMensajesAnteriores();

    const email = loginForm.querySelector("#email").value.trim();
    const password = loginForm.querySelector("#password").value.trim();

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    try {
        const response = await fetch('procesar-loginProa.php', {
            method: 'POST',
            body: formData
        });

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
    }
});


fetch('procesar-loginProa.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: new URLSearchParams(new FormData(loginForm))
})
.then(res => res.json())
.then(data => {
    if (data.success) {
        window.location.href = data.redirect;
    } else {
        mostrarError(data.error);
    }
});