<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="index">

<?php include("funciones.php");?>

<div class="contenedorForm">
    <form method="POST" action="verificarLogin.php">
        <label for="usuario">Usuario</label>
        <br>
        <input type="text" name="usuario" required>
        <br>
        <label for="clave">Clave</label>
        <br>
        <input type="password" name="clave" required>
        <br>
        <input type="submit" value="Entrar">
    </form>
</div>
    
<div class="crearUsuario"><a href="crearUsuario.php">Crear usuario</a></div>
</body>
</html>