<?php
include("funciones.php");
session_start();
chequearSesion();

if ($_POST) {

    foreach ($_POST as $key => $value) {
        if (str_contains($key, "etiquetaInput")) { 
            $idEtiqueta = explode("_", $key)[1];
            $conexionEditarEtiq = new ConectarDB;
            $consultaEditarEtiq = "UPDATE etiquetas SET nombre = '$value' WHERE id_etiqueta =  '$idEtiqueta';";
            $resultadoEditarEtiq = $conexionEditarEtiq->consultar($consultaEditarEtiq);
            $conexionEditarEtiq->cerrar();
        }
    }

    if ($_POST["adicionEditada"]) {

        $textoEditado = $_POST["adicionEditada"];
        $textoEditado = addslashes($textoEditado);
        echo "3 " . $textoEditado;
        $idEntrada = $_POST["idEntrada"];

    

        $conexionEditarEntrada = new ConectarDB;
        $consultaEditarEntrada = "UPDATE entradas SET texto = '$textoEditado' WHERE entradas.id_entrada = '$idEntrada';";
        $resultadoEditar = $conexionEditarEntrada->consultar($consultaEditarEntrada);
        $conexionEditarEntrada->cerrar();

    }
    header("Location: pagina.php");
}
?>

<!-- UPDATE etiquetas SET nombre = 'musical' WHERE id_etiqueta = (SELECT id_etiqueta FROM etiquetas WHERE nombre = 'musica'); -->