<?php

// Calcular ruta relativa a autologin.php
$pathToAutologin = '';
$archivoActual = basename($_SERVER['PHP_SELF']);

switch ($archivoActual) {
    case 'loginProa.php':
        $pathToAutologin = 'autologin.php';
        break;
    case 'inicioGeneral.php':
        $pathToAutologin = '../../autologin.php';
        break;
    case 'PasInicio.php':
        $pathToAutologin = '../autologin.php';
        break;
    default:
        $pathToAutologin = 'autologin.php';
}

session_start(); // asegurarse de tener acceso a $_SESSION

$pagina_actual = basename($_SERVER['PHP_SELF']);

$userdata = $_SESSION ?? null;
// Cleinte simulado
$cliente = [
    'nombre' => 'Jose Luis',
    'apellido1' => 'Gimenez Lopez',
    'id' => 1,
];

// Asignatura simulada
$asignatura = [
    'nombre' => 'Matemáticas Avanzadas',
    'id' => 1,
];
?>

<?php if ($pagina_actual == 'loginProa.php') { ?>
<!-- Cabecera para login -->
<header class="header-selector-usuario">
    <a class="logo-edusync" href="../../"><img src="../../imagenes/LogoEduSyncAzulV3.png" alt="logo de EduSync"></a>
    <span> Hola <strong><?php echo $cliente['nombre'] . " " . $cliente['apellido1']; ?></strong>, selecciona la vista que desees.</span>

    <!-- Versión ordenador -->
    <div class="botones-selector-ordenador">
        <button onclick="location.href='autologin.php?rol=alumno'">Alumno</button>
        <button onclick="location.href='autologin.php?rol=profesor'">Profesor</button>
        <button onclick="location.href='autologin.php?rol=pas'">Pas</button>
    </div>

    <!-- Versión móvil -->
    <div class="botones-selector-movil">
        <select name="selector-vista" id="selector-vista" onchange="seleccionDeVista(this)">
            <option value="">Vistas</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
            <option value="pas">Pas</option>
        </select>

        <script>
        function seleccionDeVista(select) {
            const rol = select.value;
            if (rol) {
                window.location.href = `autologin.php?rol=${rol}`;
            }
        }
        </script>
    </div>
</header>

<?php } else { ?>
<!-- Cabecera cuando ya estás en sesión -->
<header class="header-selector-usuario">
    <a class="logo-edusync" href="../../../"><img src="../../../imagenes/LogoEduSyncAzulV3.png" alt="logo de EduSync"></a>
    <span> Hola <strong><?php echo $cliente['nombre'] . " " . $cliente['apellido1']; ?></strong>, selecciona la vista que desees.</span>

    <!-- Versión ordenador -->
    <div class="botones-selector-ordenador">
        <button <?php echo ($userdata['rol'] == 'alumno') ? 'class="vista-seleccionada" disabled' : ''; ?> onclick="location.href='../../../autologin.php?rol=alumno'">Alumno</button>
        <button <?php echo ($userdata['rol'] == 'profesor') ? 'class="vista-seleccionada" disabled' : ''; ?> onclick="location.href='../../../autologin.php?rol=profesor'">Profesor</button>
        <button <?php echo ($userdata['rol'] == 'pas') ? 'class="vista-seleccionada" disabled' : ''; ?> onclick="location.href='../../../autologin.php?rol=pas'">Pas</button>
    </div>

    <!-- Versión móvil -->
    <div class="botones-selector-movil">
        <select name="selector-vista" id="selector-vista" onchange="redirectToView(this)">
            <option value="">Vistas</option>
            <option value="alumno" <?php echo ($userdata['rol'] == 'alumno') ? 'selected disabled' : ''; ?>>Alumno</option>
            <option value="profesor" <?php echo ($userdata['rol'] == 'profesor') ? 'selected disabled' : ''; ?>>Profesor</option>
            <option value="pas" <?php echo ($userdata['rol'] == 'pas') ? 'selected disabled' : ''; ?>>Pas</option>
        </select>

        <script>
        function redirectToView(select) {
            const rol = select.value;
            if (rol && !select.options[select.selectedIndex].disabled) {
                window.location.href = `../../../autologin.php?rol=${rol}`;
            }
        }
        </script>
    </div>
</header>

<!-- Cabecera general -->
<header class="header-proa">
    <!-- Izquierda -->
    <div class="elementos-izquierda">
        <?php if ($userdata['rol'] == 'pas') { ?>
            <a class="logo-header" href="PasInicio.php"><img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"></a>
        <?php } else { ?>
            <a class="logo-header" href="inicioGeneral.php"><img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"></a>
        <?php } ?>

        <h3 class="titulo-asignatura"><?php echo $asignatura['nombre']; ?></h3>
    </div>

    <!-- Derecha -->
    <div class="elementos-derecha">
        <p class="bienvenido bnv-exterior">Bienvenido, <strong><?php echo $userdata['nombre'] . " " . $userdata['apellido1']; ?></strong> (<?php echo $userdata['rol']; ?>)</p>
        <button popovertarget="menu-usuario"><img src="../../../imagenes/user_1b.png" alt="Icono de Perfil"></button>

        <div id="menu-usuario" popover>
            <p class="bienvenido bnv-interior"><strong><?php echo $userdata['nombre'] . " " . $userdata['apellido1']; ?></strong> (<?php echo $userdata['rol']; ?>)</p>
            <hr>
            <button id="boton-cerrar-sesion">Salir</button>
        </div>
    </div>

    <!-- Pop-up de cierre -->
    <div id="fondo-popup" class="fondo-popup oculto"></div>
    <div id="popupCerrarSesion" class="popup oculto">
        <div class="popup-contenido-C">
            <p class="popup-texto">¿Estás seguro que quieres cerrar sesión?</p>
            <div class="popup-botones">
                <button id="btn-si" class="boton-si">Sí</button>
                <button id="btn-no" class="boton-no">No</button>
            </div>
        </div>
    </div>
</header>
<?php } ?>
