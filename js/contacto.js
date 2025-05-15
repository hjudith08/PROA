
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const formularioContacto = document.querySelector('.formulario-contacto');
    const mensajeExito = document.getElementById('mensaje-exito');

    if (formularioContacto) {
        formularioContacto.addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar recarga de página
            const camposRequeridos = this.querySelectorAll('[required]');
            let esValido = true;

            camposRequeridos.forEach(campo => {
                if (!campo.value.trim()) {
                    campo.style.borderColor = 'red';
                    esValido = false;
                } else {
                    campo.style.borderColor = '#e2e8f0';
                }
            });

            if (!esValido) {
                alert('Por favor complete todos los campos requeridos.');
            } else {
                // Mostrar mensaje de éxito
                mensajeExito.style.display = 'block';

                // Opcional: limpiar el formulario
                this.reset();

                // Opcional: ocultar mensaje después de unos segundos
                setTimeout(() => {
                    mensajeExito.style.display = 'none';
                }, 5000);
            }
        });
    }
});