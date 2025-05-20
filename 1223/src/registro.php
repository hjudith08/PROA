<?php

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registro</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/app.js" defer></script>
</head>
<body>

<form action="app/registro-usuario.php" method="post">
  <label for="nombre">Nombre</label>
  <input type="text" name="nombre" id="nombre">
  <label for="apellidos">Apellidos</label>
  <input type="text" name="apellidos" id="apellidos">
  <label for="email">Email</label>
  <input type="email" name="email" id="email">
  <label for="password">Password</label>
  <input type="password" name="password" id="password">
  <input type="submit" value="Registrarse">
</form>

</body>
</html>