<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - EduSync</title>
    <link rel="icon" href="../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/edusyncCSS/estilosBaseEduSync.css">
    <link rel="stylesheet" href="../../css/edusyncCSS/contactoEduSync.css"> 
    <script src="../../js/eduSyncJS/funcionesBaseEduSync.js" defer></script>
     <script src="../../js/eduSyncJS/contacto.js" defer></script>
</head>
<body>
    
    <!-- Cabecera -->
    <?php include '../includes/eduSyncInc/menuEduSync.inc'; ?>

    <!-- Contenido del Contacto -->
    <?php include '../includes/eduSyncInc/contacto.inc'; ?>

    <!-- Pie de página -->
    <?php include '../includes/eduSyncInc/footerEduSync.inc'; ?>

    <script>
        const botonMenu = document.querySelector('.boton-menu-movil');
        const nav = document.querySelector('header nav ul');

        if (botonMenu && nav) {
            botonMenu.addEventListener('click', function() {
                nav.classList.toggle('mostrar');
            });
        }

        const formularioContacto = document.querySelector('.formulario-contacto');
        if (formularioContacto) {
            formularioContacto.addEventListener('submit', function(e) {
                const camposRequeridos = this.querySelectorAll('[required]');
                let esValido = true;

                camposRequeridos.forEach(campo => {
                    if (!campo.value.trim()) {
                        campo.style.borderColor = 'var(--color-required, red)';
                        esValido = false;
                    } else {
                        campo.style.borderColor = '#e2e8f0';
                    }
                });

                if (!esValido) {
                    e.preventDefault();
                    alert('Por favor complete todos los campos requeridos.');
                }
            });
        }
    </script>
</body>
</html>