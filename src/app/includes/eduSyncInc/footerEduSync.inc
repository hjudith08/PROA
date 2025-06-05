<?php

$pagina_actual = basename($_SERVER['PHP_SELF']);
?>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <p>Contáctanos: <a href="mailto:edusync@gti.com">edusync@gti.com </a></p>
        </div>
        <div class="footer-col">
            <p>© 2025 - EduSync | Matriz GTI</p>
        </div>
        <div class="footer-col">
            <?php
            if ($pagina_actual == 'index.php') {
                ?>
            <img src="imagenes/GTIBlancosdsds.png" alt="Logo GTI">
             <?php
            }
            else {
                ?>
                <img src="../../imagenes/GTIBlancosdsds.png" alt="Logo GTI">
             <?php
            }
                ?>
        </div>
    </div>
</footer>