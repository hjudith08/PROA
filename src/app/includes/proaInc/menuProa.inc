<?php
// Calcular ruta relativa a autologin.php
$pathToAutologin = '';
$archivoActual = basename($_SERVER['PHP_SELF']);

switch ($archivoActual) {
    case 'LoginProa.php':
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

session_start();

$pagina_actual = basename($_SERVER['PHP_SELF']);
$userdata = $_SESSION ?? null;

// Mostrar nombre de asignatura solo si NO estamos en inicioGeneral ni tareas
$nombreAsignatura = '';
$noMostrar = ['inicioGeneral.php', 'tareas.php'];

if (!in_array($pagina_actual, $noMostrar)) {
    if (isset($_GET['codigo']) || isset($_GET['id'])) {
        // Ajusta la ruta a tu archivo de conexión real
        require_once __DIR__ . '../../conexion.inc';
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            $stmt = $conn_proa->prepare("SELECT nombre FROM asignaturas WHERE codigo = ?");
            $stmt->bind_param("s", $codigo);
        } else {
            $id = intval($_GET['id']);
            $stmt = $conn_proa->prepare("SELECT nombre FROM asignaturas WHERE id_asignatura = ?");
            $stmt->bind_param("i", $id);
        }
        $stmt->execute();
        $stmt->bind_result($nombreAsignatura);
        $stmt->fetch();
        $stmt->close();
    }
    // Si no hay asignatura encontrada, deja vacío
    if (!$nombreAsignatura) {
        $nombreAsignatura = '';
    }
}
?>

<?php if ($pagina_actual == 'LoginProa.php') { ?>
<!-- Cabecera para login -->
<header class="header-selector-usuario">
    <a class="logo-edusync" href="../../"><img src="../../imagenes/LogoEduSyncAzulV3.png" alt="logo de EduSync"></a>
    <span> Selecciona la vista que desees.</span>
    <div class="botones-selector-ordenador">
        <button onclick="location.href='autologin.php?rol=alumno'">Alumno</button>
        <button onclick="location.href='autologin.php?rol=profesor'">Profesor</button>
        <button onclick="location.href='autologin.php?rol=pas'">Pas</button>
    </div>
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
    <span> Selecciona la vista que desees.</span>
    <div class="botones-selector-ordenador">
        <button  <?php echo ($userdata['rol'] == 'alumno') ? 'class="vista-seleccionada" disabled' : ''; ?>onclick="location.href='../autologin.php?rol=alumno'">Alumno</button>
        <button <?php echo ($userdata['rol'] == 'profesor') ? 'class="vista-seleccionada" disabled' : ''; ?> onclick="location.href='../autologin.php?rol=profesor'">Profesor</button>
        <button <?php echo ($userdata['rol'] == 'pas') ? 'class="vista-seleccionada" disabled' : ''; ?> onclick="location.href='../autologin.php?rol=pas'">Pas</button>
    </div>
    <div class="botones-selector-movil">
        <select name="selector-vista" id="selector-vista" onchange="redirectToView(this)">
            <option value="">Vistas</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
            <option value="pas">Pas</option>
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
        <?php if (($userdata['rol'] ?? '') == 'pas') { ?>
            <a class="logo-header" href="PasInicio.php"><img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"></a>
        <?php } else { ?>
            <a class="logo-header" href="inicioGeneral.php"><img src="../../../imagenes/LogosProaBlanco.png" alt="Logotipo"></a>
        <?php } ?>
        <h3 class="titulo-asignatura" style="min-width:1em;"><?php echo htmlspecialchars($nombreAsignatura); ?></h3>
    </div>

    <!-- Derecha -->
    <div class="elementos-derecha">
        <p class="bienvenido bnv-exterior">Bienvenido, <strong><?php echo ($userdata['nombre'] ?? '') . " " . ($userdata['apellido1'] ?? ''); ?></strong> (<?php echo $userdata['rol'] ?? ''; ?>)</p>
        <button popovertarget="menu-usuario"><img src="../../../imagenes/user_1b.png" alt="Icono de Perfil"></button>

        <div id="menu-usuario" popover>
            <p class="bienvenido bnv-interior"><strong><?php echo ($userdata['nombre'] ?? '') . " " . ($userdata['apellido1'] ?? ''); ?></strong> (<?php echo $userdata['rol'] ?? ''; ?>)</p>
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