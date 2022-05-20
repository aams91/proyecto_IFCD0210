<?php
include("funciones.php");
session_start();
chequearSesion();

var_dump($_GET);

// ↓ Aquí función pagSpanEliminarEnt(id)
if (isset($_GET["idEntrada"])) {
    $idEntrada = $_GET["idEntrada"];

    $conexionEliminaciones = new ConectarDB;

    // Acá compruebo si la entrada a eliminar está vinculada a otra/s etiqueta/s...*
    $consultaSiEntTieneEtiq = "SELECT COUNT(*) as cuenta from etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada;";
    $resultadoSiEntTieneEtiq = $conexionEliminaciones->consultar($consultaSiEntTieneEtiq)->fetch_all(MYSQLI_ASSOC);

    if ($resultadoSiEntTieneEtiq[0]["cuenta"] == 0) {
        // *...si no está vinculada a ninguna etiqueta, la elimino
        $consultaEliminarEntrada = "DELETE FROM entradas WHERE entradas.id_entrada = $idEntrada";
        $resultadoEliminarEntrada = $conexionEliminaciones->consultar($consultaEliminarEntrada);
    } else {
        // *...si SÍ está vinculada, busco las etiquetas a las que está vinculada...**
        $consultaIDEtiqDeEntrada = "SELECT etiq_entradas.id_etiqueta, etiq_entradas.id_entrada FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada";
        $resultadoIDEtiqDeEntrada = $conexionEliminaciones->consultar($consultaIDEtiqDeEntrada)->fetch_all(MYSQLI_ASSOC);

        foreach ($resultadoIDEtiqDeEntrada as $cadaIDEtiq) {
            // **...busco las veces que la etiqueta está vinculada a otra/s entrada/s...***
            $idEtiqueta = $cadaIDEtiq["id_etiqueta"];
            $consultaEtiqEnMasEnt = "SELECT COUNT(*) as repeticiones, etiq_entradas.id_entrada FROM etiq_entradas WHERE etiq_entradas.id_etiqueta = $idEtiqueta";
            $resultadoEtiqEnMasEnt = $conexionEliminaciones->consultar($consultaEtiqEnMasEnt)->fetch_all(MYSQLI_ASSOC);

            if ($resultadoEtiqEnMasEnt[0]["repeticiones"] == 1) {
                // ***...si la etiqueta está vinculada a una sola entrada, averiguo qué otras etiquetas están vinculadas a dicha entrada...****
                $consultaEtiquetasVinculadas = "SELECT etiq_entradas.id_etiqueta FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada";
                $resultadoEtiquetasVinculadas = $conexionEliminaciones->consultar($consultaEtiquetasVinculadas)->fetch_all(MYSQLI_ASSOC);

                foreach ($resultadoEtiquetasVinculadas as $cadaEtiquetaVinculada) {
                    // ****...y por cada etiqueta, elimino la vinculación y la etiqueta
                    $consultaEliminarVinculacion = "DELETE FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada AND etiq_entradas.id_etiqueta = $idEtiqueta";
                    $resultadoEliminarVinculacion = $conexionEliminaciones->consultar($consultaEliminarVinculacion);
                    $consultaEliminarEtiqueta = "DELETE FROM etiquetas WHERE etiquetas.id_etiqueta = $idEtiqueta";
                    $resultadoEliminarEtiqueta = $conexionEliminaciones->consultar($consultaEliminarEtiqueta);
                }
            } if ($resultadoEtiqEnMasEnt[0]["repeticiones"] > 1) {
                // ***...si la etiqueta está vinculada a más entradas, elimino solamente el vínculo
                $consultaEliminarVinculacion = "DELETE FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada";
                $resultadoEliminarVinculacion = $conexionEliminaciones->consultar($consultaEliminarVinculacion); 
            } 
        }
        $consultaEliminarEntrada = "DELETE FROM entradas WHERE entradas.id_entrada = $idEntrada";
        $resultadoEliminarEntrada = $conexionEliminaciones->consultar($consultaEliminarEntrada); 
    }
}

// ↓ Aquí función desvincularEtiqEntrada(id)
if (isset($_GET['idEntradaEtiq'])) {
    $idEntrada = $_GET['idEntradaEtiq'];
    $idEtiqueta = $_GET['idEtiqueta'];

    // Averiguo a qué otras entradas está vinculada la etiqueta...*
    $conexionAveriguar = new ConectarDB;
    $consultaAveriguar = "SELECT COUNT(*) AS repeticion FROM etiq_entradas WHERE etiq_entradas.id_etiqueta = $idEtiqueta";
    $resultadoAveriguar = $conexionAveriguar->consultar($consultaAveriguar)->fetch_all(MYSQLI_ASSOC);

    var_dump($resultadoAveriguar);

    if ($resultadoAveriguar[0]['repeticion'] == 1) {
        // *...si no está vinculada a otra/s entrada/s, elimino dicha etiqueta
        $consultaDesvincularEtiq = "DELETE FROM etiq_entradas WHERE etiq_entradas.id_etiqueta = $idEtiqueta AND etiq_entradas.id_entrada = $idEntrada";
        $consultaEliminarEtiq = "DELETE FROM etiquetas WHERE etiquetas.id_etiqueta = $idEtiqueta";
        $resultadoDesvincularEtiq = $conexionAveriguar->consultar($consultaDesvincularEtiq);
        $resultadoEliminarEtiq = $conexionAveriguar->consultar($consultaEliminarEtiq);
    } elseif ($resultadoAveriguar[0]['repeticion'] > 1) {
        // *...si sí hay otra/s entrada/s, solo desvinculo
        $consultaDesvincularEtiq = "DELETE FROM etiq_entradas WHERE etiq_entradas.id_etiqueta = $idEtiqueta AND etiq_entradas.id_entrada = $idEntrada";
        $resultadoDesvincularEtiq = $conexionAveriguar->consultar($consultaDesvincularEtiq);
    }
}


?>