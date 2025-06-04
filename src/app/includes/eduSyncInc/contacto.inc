<!-- Contenido Principal -->
<main class="contenido">
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
                            <img src="../../imagenes/letterb.png" alt="Email">
                        </div>
                        <div class="texto-info">
                            <p class="etiqueta-info">Correo:</p>
                            <a href="mailto:correo@correo.com">correo@correo.com</a>
                        </div>
                    </div>
                </div>

                <div class="tarjeta-info">
                    <div class="contenido-tarjeta-info">
                        <div class="icono-info">
                            <img src="../../imagenes/telephoneb.png" alt="Teléfono">
                        </div>
                        <div class="texto-info">
                            <p class="etiqueta-info">Teléfono:</p>
                            <a href="tel:833271727">833271727</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        /* Sesion no iniciada*/
        if (!isset($dataEdu['id'])) {
            ?>
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
                    <input type="text" id="institution" class="entrada-formulario" placeholder="Nombre de la Institución"
                        required>
                </div>

                <div class="grupo-formulario">
                    <label for="email" class="etiqueta-formulario">Correo Electrónico</label>
                    <input type="email" id="email" class="entrada-formulario" placeholder="ejemplo@ejemplo.com" required>
                </div>
                <div class="grupo-formulario">
                    <label for="message" class="etiqueta-formulario">Mensaje</label>
                    <textarea id="message" class="area-texto-formulario" placeholder="Escribe aquí tu consulta"></textarea>
                </div>
                <button type="submit" class="boton-enviar">Enviar</button>
                <div id="mensaje-exito" class="mensaje-exito">
                    ¡Formulario enviado correctamente!
                </div>
            </form>


            <?php
            /* Sesion iniciada*/
        } else {
            ?>
            <!-- Formulario de Contacto -->
            <form class="formulario-contacto">


                <div class="grupo-formulario">
                    <label for="message" class="etiqueta-formulario">Mensaje</label>
                    <textarea id="message" class="area-texto-formulario" placeholder="Escribe aquí tu consulta"
                        required></textarea>
                </div>

                <button type="submit" class="boton-enviar">Enviar</button>
                <div id="mensaje-exito" class="mensaje-exito">
                    ¡Formulario enviado correctamente!
                </div>
            </form>


            <?php
        }
        ?>
    </div>
</main>