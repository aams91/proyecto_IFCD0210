<?php
    include("funciones.php");
    session_start();

    $usuario = $_SESSION["usuario"];
    /* $etiquetasBruto = $_GET["etiquetas"];  */

    $etiqPrueba = "musica,adios,que,pasa,";
    echo $etiqPrueba;
    $etiquetasArr = explode(",", $etiqPrueba, -1);
    var_dump($etiquetasArr);
    foreach ($etiquetasArr as $etiqueta) {
        $accesoComprobacion = new ConectarDB;
        $consultaComprobacion = "SELECT COUNT(*) FROM etiquetas, usuarios WHERE etiequeta.nombre = '$etiqueta' AND usuarios.usuario = '$usuario';";
        $resultadoComprobacion = $accesoComprobacion->consultar($consultaComprobacion)->fetch_all(MYSQLI_ASSOC);
        var_dump($resultadoComprobacion);
        if (count($resultadoComprobacion) == 1) {
        echo "<pre>";
        var_dump($resultadoComprobacion);
        echo "</pre>";
    } else {
        echo "Homa";
    }
        /* if (count($resultadoComprobacion) == 0) {
            $accesoInsertar = new ConectarDB;
            $consultaInsertar = "INSERT INTO etiquetas (nombre) VALUES ('$etiqueta')";
            $resultadoInsertar = $accesoInsertar->consultar($consultaInsertar);
            $accesoInsertar->cerrar();
        } */
        
    }

    


?>