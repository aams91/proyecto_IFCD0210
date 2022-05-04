<?php
session_start();
include("funciones.php");


    $usuario = $_SESSION["usuario"];
    $texto = $_POST["adicion"];
    $JsonEtiquetas = $_POST["arrayInput"]; //esto es un string
    var_dump($_POST);
/*     print_r($JsonEtiquetas);
    var_dump($texto); */

    // Sacar id_usuario
    $accesoAveriguarID = new ConectarDB;
    $consultaAveriguarID = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario';";
    $resultadoAveriguarID = $accesoAveriguarID->consultar($consultaAveriguarID)->fetch_all(MYSQLI_ASSOC);
    $idUsuario = $resultadoAveriguarID[0]["id_usuario"];
    $accesoAveriguarID->cerrar();

    // Sacar hora
    $accesoHoraCreacion = new ConectarDB;
    $consultaHoraCreacion = "SELECT CURRENT_TIME;";
    $resultadoHoraCreacion = $accesoHoraCreacion->consultar($consultaHoraCreacion)->fetch_all(MYSQLI_ASSOC);
    $horaCreacion = $resultadoHoraCreacion[0]["CURRENT_TIME"];
    $accesoHoraCreacion->cerrar();

    // Sacar fecha
    $accesoFechaCreacion = new ConectarDB;
    $consultaFechaCreacion = "SELECT CURRENT_DATE;";
    $resultadoFechaCreacion = $accesoFechaCreacion->consultar($consultaFechaCreacion)->fetch_all(MYSQLI_ASSOC);
    $fechaCreacion = $resultadoFechaCreacion[0]["CURRENT_DATE"];
    $accesoFechaCreacion->cerrar();

    // Insertar texto
    $accesoInsertar = new ConectarDB;
    $consultaInsertar = "INSERT INTO entradas (id_usuario, id_entrada, texto, hora_creacion, fecha_creacion, animo) VALUES ('$idUsuario', NULL, '$texto', '$horaCreacion', '$fechaCreacion', NULL);";
    $resultadoInsertar = $accesoInsertar->consultar($consultaInsertar);
    $accesoInsertar->cerrar();

    // Insertar etiquetas
    $etiquetasSeparadas = explode(",", $JsonEtiquetas, -1);
    /* var_dump($etiquetasSeparadas); */
    
    foreach ($etiquetasSeparadas as $etiqueta) {
        $accesoComprobacion = new ConectarDB;
        $consultaComprobacion = "SELECT COUNT(*) as repetida FROM etiquetas, usuarios WHERE etiquetas.nombre = '$etiqueta' AND usuarios.usuario = '$usuario';";
        $resultadoComprobacion = $accesoComprobacion->consultar($consultaComprobacion)->fetch_all(MYSQLI_ASSOC);
        var_dump($resultadoComprobacion);
        echo "<br><br><br>";
        if ($resultadoComprobacion[0]["repetida"] == 1) {
            $accesoSacarId = new ConectarDB;
            $consultaSacarId = "SELECT id_etiqueta FROM etiquetas WHERE nombre = '$etiqueta';";
            $resultadoSacarId = $accesoSacarId->consultar($consultaSacarId)->fetch_all(MYSQLI_ASSOC);
            foreach ($resultadoSacarId as $idEtiqueta) {
                // ACÁ TENGO EL ID DE LA ETIQUETA, QUE LO VOY A USAR PARA INSERTARLO DIRECTAMENTE EN ETIQ_ENTRADAS EMPAREJÁNDOLO CON EL ID DE LA ÚLTIMA ENTRADA
                $idEtiqueta = $idEtiqueta["id_etiqueta"];
                $consultaInsertarEtiqRepe = "INSERT INTO etiq_entradas (id_etiqueta, id_entrada) VALUES ('$idEtiqueta', (SELECT MAX(id_entrada) FROM entradas));";
                $resultadoInsertarEtiqRepe = $accesoSacarId->consultar($consultaInsertarEtiqRepe);                
            }
            echo "<pre>";
            var_dump($resultadoSacarId);
            echo "</pre>Hasta aquí<br>";
        } else {
            $accesoInsertarNuevaEtiq = new ConectarDB;
            $consultaInsertarNuevaEtiq = "INSERT INTO etiquetas (nombre) VALUES ('$etiqueta');";
            $resultadoInsertarNuevaEtiq = $accesoInsertarNuevaEtiq->consultar($consultaInsertarNuevaEtiq);
            $consultaInsertarEnTablaUnion = "INSERT INTO etiq_entradas (id_etiqueta, id_entrada) VALUES ((SELECT MAX(id_etiqueta) FROM etiquetas), (SELECT MAX(id_entrada) FROM entradas));";
            $resultadoInsertarEnTablaUnion = $accesoInsertarNuevaEtiq->consultar($consultaInsertarEnTablaUnion);
        }
        $accesoSacarId->cerrar();
        $accesoComprobacion->cerrar();
        $accesoInsertarNuevaEtiq->cerrar();
    }

    /* foreach ($etiquetasSeparadas as $etiqueta) {
        // Ver si etiqueta ya existe
        $accesoEtiquetaExiste = new ConectarDB;
        $consultaEtiquetaExiste = "SELECT COUNT(*) as numRepeticion FROM etiquetas WHERE etiquetas.nombre = '$etiqueta';";
        $resultadoEtiquetaExiste = $accesoEtiquetaExiste->consultar($consultaEtiquetaExiste)->fetch_all(MYSQLI_ASSOC);
        


        $conexion3 = new ConectarDB;
        $consulta3 = "INSERT INTO etiquetas (id_etiqueta, nombre) VALUES (NULL, '$etiqueta');";
        $resultado3 = $conexion3->consultar($consulta3);
        $conexion3->cerrar();
    
    
        $conexion4 = new ConectarDB;
        $consulta4 = "INSERT INTO etiq_entradas (id_etiq_entrada, id_entrada, id_etiqueta) VALUES (NULL, (SELECT MAX(id_entrada) FROM entradas), (SELECT MAX(id_etiqueta) FROM etiquetas));";
        $resultado4 = $conexion4->consultar($consulta4);
        $conexion4->cerrar();
    }  */
    /* header("Location: pagina.php"); */
    


?>
