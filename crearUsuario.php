<?php include("funciones.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
    <script src="js/scripts.js"></script>
</head>
<body>
    <p>Todos los campos son obligatorios.</p>
    <form action="" method="post">
        <label for="nombreUsuario">Nombre de usuario: </label> 
        <input type="text" name="nombreUsuario" id="nombreUsuario" required value="<?php if (isset($_POST["nombreUsuario"])) {echo $_POST["nombreUsuario"];}?>">
        <br>
        <label for="clave">Contraseña: </label>
        <input type="password" name="clave" id="clave" required >
        <br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" required value="<?php if (isset($_POST["nombre"])) {echo $_POST["nombre"];}?>">
        <br>
        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required value="<?php if (isset($_POST["email"])) {echo $_POST["email"];}?>">
        <br>
        <input type="submit" value="Aceptar"> <button onclick="creUBorrar()">Borrar campos</button> 
    </form>

    <a href="index.php"><button>Página de inicio de sesión</button></a>
        
    <div id="mensajeCreacion"></div>
</body>
</html>

<?php
if ($_POST) {
    $nombreUsuario = $_POST["nombreUsuario"];
    $clave = $_POST["clave"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensajeSi = "";
    $mensajeNo ="";
    

    $accesoComprobacion = new ConectarDB;
    $consultaComprobacion = "SELECT COUNT(*) as numeroUsuarios FROM usuarios WHERE usuario = '$nombreUsuario';";
    $resultadoComprobacion = $accesoComprobacion->consultar($consultaComprobacion)->fetch_all(MYSQLI_ASSOC);
    $accesoComprobacion->cerrar();

    $accesoSacarFecha = new ConectarDB;
    $consultaFecha = "SELECT CURRENT_DATE;";
    $resultadoFecha = $accesoSacarFecha->consultar($consultaFecha)->fetch_all(MYSQLI_ASSOC);
    $fecha = $resultadoFecha[0]["CURRENT_DATE"];
    $accesoSacarFecha->cerrar();

    if ($resultadoComprobacion[0]["numeroUsuarios"] == 1) { 
        ?>
        <script>document.getElementById("mensajeCreacion").innerHTML = "Este nombre de usuario ya existe"</script>
        <?php
    } if ($resultadoComprobacion[0]["numeroUsuarios"] == 0) {
            $accesoCrearUsuario = new ConectarDB;
            $consultaCrearUsuario = "INSERT INTO usuarios (usuario, nombre, clave, email, fecha_creacion, url_imagen) VALUES ('$nombreUsuario', '$nombre', '$clave', '$email', '$fecha', NULL);";
            $resultadoCrearUsuario = $accesoCrearUsuario->consultar($consultaCrearUsuario);
            $accesoCrearUsuario->cerrar();
            ?>
            <script>creUVaciarCrearOk();</script>
            <?php
        }
    }
    



?>