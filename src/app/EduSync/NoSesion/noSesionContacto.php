<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - EduSync</title>
    <link rel="icon" href="../../../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="/PROA/src/css/Edusync/estilo-contacto-sesion.css">
</head>
<body>
    <!-- Cabecera -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/PROA/includes/edusyncSesionHeaderInclude.php'; ?>

    <!-- Contenido Principal -->
    <main class="contenedor-principal">
        <div class="area-contenido">
            <!-- Tarjeta de Información de Contacto -->
            <div class="tarjeta-info-contacto">
                <div class="contenido-info-contacto">
                    <h2>CONTACTA CON NOSOTROS</h2>
                    <h1>Mantente en contacto</h1>
                    <p class="descripcion-contacto">Si tienes alguna pregunta, estaremos encantados de ayudarte.</p>

                    <h3>Datos de contacto:</h3>

                    <div class="tarjeta-info">
                        <div class="contenido-tarjeta-info">
                            <div class="icono-info">
                                <img src="/PROA/src/css/imagenes/letterb.png" alt="Email">
                            </div>
                            <div class="texto-info">
                                <p class="etiqueta-info">Correo:</p>
                                <p class="valor-info">correo@correo.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="tarjeta-info">
                        <div class="contenido-tarjeta-info">
                            <div class="icono-info">
                                <img src="/PROA/src/css/imagenes/telephoneb.png" alt="Teléfono">
                            </div>
                            <div class="texto-info">
                                <p class="etiqueta-info">Teléfono:</p>
                                <p class="valor-info">833271727</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Contacto -->
            <form class="formulario-contacto">
                <div class="grupo-filas-formulario">
                    <div class="grupo-formulario">
                        <label for="name" class="etiqueta-formulario">Nombre</label>
                        <input type="text" id="name" class="entrada-formulario" placeholder="Nombre" required>
                    </div>
                    <div class="grupo-formulario">
                        <label for="surname" class="etiqueta-formulario">Apellidos</label>
                        <input type="text" id="surname" class="entrada-formulario" placeholder="Apellidos" required>
                    </div>
                </div>

                <div class="grupo-formulario">
                    <label for="institution" class="etiqueta-formulario">Institución</label>
                    <input type="text" id="institution" class="entrada-formulario" placeholder="Nombre de la Institución" required>
                </div>

                <div class="grupo-formulario">
                    <label for="email" class="etiqueta-formulario">Correo Electrónico</label>
                    <input type="email" id="email" class="entrada-formulario" placeholder="ejemplo@ejemplo.com" required>
                </div>

                <div class="grupo-formulario">
                    <label for="message" class="etiqueta-formulario">Mensaje</label>
                    <textarea id="message" class="area-texto-formulario" placeholder="Escribe aquí tu consulta" required></textarea>
                </div>

                <button type="submit" class="boton-enviar">Enviar</button>
            </form>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="pie-pagina">
        <div class="contenedor-pie-pagina">
            <p>Contactamos: eclusync@git.com</p>
            <p>© 2025 - EduSync | Mairic de GTI</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
    </script>
</body>
</html>
