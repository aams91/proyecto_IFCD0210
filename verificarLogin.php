<?php 
session_start();
include ("funciones.php");

$mensajeError = "";

if ($_POST) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    if ($usuario !="" && $clave !="") {
        $acceso = new ConectarDB;
        $consultaAcceso = "SELECT COUNT(*) as numeroUsuarios FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
        $resultado = $acceso->consultar($consultaAcceso)->fetch_all(MYSQLI_ASSOC);

        if ($resultado[0]["numeroUsuarios"] == "1") {
            $_SESSION["usuario"] = $usuario;
            $_SESSION["clave"] = $clave;

            header('Location: pagina.php');
        }
        if ($resultado[0]["numeroUsuarios"] == "0"){
            $mensajeError = "Datos incorrectos.";
            ?>
            <div class="mensajeError">
                <?php echo $mensajeError; ?><br>
                <button onclick="history.back()">Volver</button>
            </div>
            <?php
        }
        
    } else {
        // Esto no va a ser nunca, puesto que los input del formulario tienen required y no se pueden dejar vacíos
        $mensajeError= "Los campos son obligatorios";
        echo $mensajeError;
    }
    $acceso->cerrar();
}


?>