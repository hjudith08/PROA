
    const formulario = document.getElementById('formularioRecuperacion');
    const campoCorreo = document.getElementById('correo');
    
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validación básica
        if (!campoCorreo.value.trim()) {
            alert('Por favor ingresa tu correo electrónico');
            campoCorreo.focus();
            return;
        }
        
        if (!validarCorreo(campoCorreo.value.trim())) {
            alert('Por favor ingresa un correo electrónico válido');
            campoCorreo.focus();
            return;
        }
        
        // Simular envío
        alert('Se han enviado instrucciones para recuperar tu contraseña al correo: ' + campoCorreo.value.trim());
        
        // Limpiar el formulario
        formulario.reset();
    });
    
    // Función para validar email
    function validarCorreo(correo) {
        const expresion = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return expresion.test(correo);
    }
