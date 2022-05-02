<?php
session_start();
include("funciones.php");


    $usuario = $_SESSION["usuario"];
    $texto = $_POST["adicion"];
    $JsonEtiquetas = $_POST["inputEtiquetas"]; //esto es un string
    var_dump($JsonEtiquetas);
    var_dump($texto);

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
    $etiquetasSeparadas = explode("/ ", $JsonEtiquetas);
    

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
    header("Location: pagina.php");
    


?>
