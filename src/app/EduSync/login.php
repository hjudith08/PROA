<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync | Venta de Modulos Educativos</title>
    <!-- imagen de pestaña -->
    <link rel="icon" href="../../../imagenes/LogoEduSyncBlancoV3.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>
<body>
    <header>
        <a href="../../../index.php" class="logo">
            <img src="../../../imagenes/LogoEduSyncAzul.png" alt="Logotipo">
        </a>
        <nav>
            <ul>
                <input type="button" value="CONTACTO" onclick="location.href='../EduSync/contacto.php'">
            </ul>
        </nav>
    </header>

    <div>
        <h1>Iniciar Sesión</h1>
        <form action="login.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Iniciar Sesión">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Aquí iría la lógica de autenticación
            if ($username == "admin" && $password == "admin") {
                echo "<p>Bienvenido, $username!</p>";
            } else {    
                echo "<p>Usuario o contraseña incorrectos.</p>";
            }
        }
        ?>
    </div>

</body>
</html>