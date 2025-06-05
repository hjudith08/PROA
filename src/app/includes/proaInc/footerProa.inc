<!-- Pie de página de las páginas de proa-->

<?php
$pagina_actual = basename($_SERVER['PHP_SELF']);

if ($pagina_actual == 'LoginProa.php') {

echo '<footer class="footer-proa">
        <span class="footer-texto">Powered by</span>
        <!-- logo de la empresa creadora de Proa (EduSync)-->
        <a href="../../"><img class="footer-imagen-proa" src="../../imagenes/LogoEduSyncBlanco.png" alt="Logo Edusync" class="footer-logo"></a>
</footer>';
}

else{

echo '<footer class="footer-proa">
        <span class="footer-texto">Powered by</span>
        <!-- logo de la empresa creadora de Proa (EduSync)-->
        <a href="../../../"><img class="footer-imagen-proa" src="../../../imagenes/LogoEduSyncBlanco.png" alt="Logo Edusync" class="footer-logo"></a>
    </footer>';
}