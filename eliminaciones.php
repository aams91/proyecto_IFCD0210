<?php
include("funciones.php");
session_start();
chequearSesion();

var_dump($_GET);

if ($_GET["idEntrada"]) {
    $idEntrada = $_GET["idEntrada"];

    $conexionEliminaciones = new ConectarDB;

    $consultaSiEntTieneEtiq = "SELECT COUNT(*) as cuenta from etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada;";
    $resultadoSiEntTieneEtiq = $conexionEliminaciones->consultar($consultaSiEntTieneEtiq)->fetch_all(MYSQLI_ASSOC);

    if ($resultadoSiEntTieneEtiq[0]["cuenta"] == 0) {
        $consultaEliminarEntrada = "DELETE FROM entradas WHERE entradas.id_entrada = $idEntrada";
        $resultadoEliminarEntrada = $conexionEliminaciones->consultar($consultaEliminarEntrada);
    } else {
        $consultaIDEtiqDeEntrada = "SELECT etiq_entradas.id_etiqueta FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada";
        $resultadoIDEtiqDeEntrada = $conexionEliminaciones->consultar($consultaIDEtiqDeEntrada)->fetch_all(MYSQLI_ASSOC);
        foreach ($resultadoIDEtiqDeEntrada as $cadaIDEtiq) {
            $idEtiqueta = $cadaIDEtiq["id_etiqueta"];
            $consultaEtiqEnMasEnt = "SELECT COUNT(*) as repeticiones, etiq_entradas.id_entrada FROM etiq_entradas WHERE etiq_entradas.id_etiqueta = $idEtiqueta";
            $resultadoEtiqEnMasEnt = $conexionEliminaciones->consultar($consultaEtiqEnMasEnt)->fetch_all(MYSQLI_ASSOC);
            if ($resultadoEtiqEnMasEnt[0]["repeticiones"] == 1) {
                $consultaEliminarVinculacion = "DELETE FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada";
                $consultaEliminarEtiqueta = "DELETE FROM etiquetas WHERE etiquetas.id_etiqueta = $idEtiqueta";
                /* !!! $resultadoEliminarEtiqueta funciona pero da un Fatal Error --- ver más tarde */
                $resultadoEliminarVinculacion = $conexionEliminaciones->consultar($consultaEliminarVinculacion);
                $resultadoEliminarEtiqueta = $conexionEliminaciones->consultar($consultaEliminarEtiqueta);
            } elseif ($resultadoEtiqEnMasEnt[0]["repeticiones"] > 1) {
                $consultaEliminarVinculacion = "DELETE FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada";
                $resultadoEliminarVinculacion = $conexionEliminaciones->consultar($consultaEliminarVinculacion);
            }
            $consultaEliminarEntrada = "DELETE FROM entradas WHERE entradas.id_entrada = $idEntrada";
            $resultadoEliminarEntrada = $conexionEliminaciones->consultar($consultaEliminarEntrada);
        }
    }

}
?>