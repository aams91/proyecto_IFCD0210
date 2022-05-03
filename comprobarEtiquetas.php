<?php
    include("funciones.php");
    session_start();

    $usuario = $_SESSION["usuario"];
    /* $etiquetasBruto = $_GET["etiquetas"];  */

    $etiqPrueba = "musica,adios,que,pasa,";
    $etiquetasArr = explode(",", $etiqPrueba, -1);
    /* var_dump($etiquetasArr); */
    foreach ($etiquetasArr as $etiqueta) {
        $accesoComprobacion = new ConectarDB;
        $consultaComprobacion = "SELECT COUNT(*) FROM etiquetas WHERE nombre = '$etiqueta'";
        $resultadoComprobacion = $accesoComprobacion->consultar($consultaComprobacion)->fetch_all(MYSQLI_ASSOC);
        if (count($resultadoComprobacion) == 0) {
        echo "<pre>";
        var_dump($resultadoComprobacion);
        echo "</pre>";
    } else {
        echo "Hola";
    }
        /* if (count($resultadoComprobacion) == 0) {
            $accesoInsertar = new ConectarDB;
            $consultaInsertar = "INSERT INTO etiquetas (nombre) VALUES ('$etiqueta')";
            $resultadoInsertar = $accesoInsertar->consultar($consultaInsertar);
            $accesoInsertar->cerrar();
        } */
        
    }

    


?>