<?php
include("funciones.php");
session_start();
chequearSesion();

echo "<pre>";
var_dump($_POST);
echo "</pre>";

if ($_POST["adicionEditada"]) {

    $textoEditado = $_POST["adicionEditada"];
    $textoEditado = addslashes($textoEditado);
    echo $textoEditado;
    $idEntrada = $_POST["idEntrada"];

    $conexionEditar = new ConectarDB;
    $consultaEditarEntrada = "UPDATE entradas SET texto = '$textoEditado' WHERE entradas.id_entrada = '$idEntrada';";
    $resultadoEditar = $conexionEditar->consultar($consultaEditarEntrada);
    $conexionEditar->cerrar();

/*     header("Location: pagina.php");  */
}
?>

<!-- UPDATE etiquetas SET nombre = 'musical' WHERE id_etiqueta = (SELECT id_etiqueta FROM etiquetas WHERE nombre = 'musica'); -->