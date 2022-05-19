<?php
session_start();
include("funciones.php");


    $usuario = $_SESSION["usuario"];
    $texto = $_POST["adicion"];
    $etiqInput = $_POST["inputEtiqueta"]; //esto es un string
    $todasEtiquetasInput1 = trim($etiqInput);
    $todasEtiquetasInput = rtrim($todasEtiquetasInput1, ",");
    $todasEtiquetasInput = addslashes($todasEtiquetasInput);


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
    $texto = addslashes($texto);
    $accesoInsertar = new ConectarDB;
    $consultaInsertar = "INSERT INTO entradas (id_usuario, id_entrada, texto, hora_creacion, fecha_creacion, animo) VALUES ('$idUsuario', NULL, '$texto', '$horaCreacion', '$fechaCreacion', NULL);";
    $resultadoInsertar = $accesoInsertar->consultar($consultaInsertar);
    $accesoInsertar->cerrar();

    // Insertar etiquetas
    if ($etiqInput != "") {
        $arrayEtiqInput = explode(", ", $todasEtiquetasInput);
        $etiqApelotonadas = "";
        $accesoVerEtiquetas = new ConectarDB;
        $consultaVerEtiquetas = "SELECT * FROM etiquetas;";
        $resultadoVerEtiquetas = $accesoVerEtiquetas->consultar($consultaVerEtiquetas)->fetch_all(MYSQLI_ASSOC);
        foreach ($resultadoVerEtiquetas as $cadaResultado) {
            // Acá meto todas las etiquetas (tanto las que existen como las que no) juntas
            $etiqApelotonadas = $etiqApelotonadas . "," . $cadaResultado["nombre"] ; 
        }
        
        $arrayEtiqBD = explode(",", $etiqApelotonadas); 
        $accesoVerEtiquetas->cerrar();

        // Acá comparo los arrays para ver cuáles son las etiquetas que ya existen y cuáles las que no
        $lasEtiqQueNoEstan = array_diff($arrayEtiqInput, $arrayEtiqBD);
        $lasEtiqQueSiEstan = array_diff($arrayEtiqInput, $lasEtiqQueNoEstan);

        $accesoInsertarEtiquetas = new ConectarDB;
        foreach ($lasEtiqQueNoEstan as $cadaEtiqueta) {
            $consultaInsertarEtiquetas = "INSERT INTO etiquetas (id_etiqueta, nombre) VALUES (NULL, '$cadaEtiqueta');";
            $resultadoInsertarEtiquetas = $accesoInsertarEtiquetas->consultar($consultaInsertarEtiquetas);
            $consultaEmparejarNo = "INSERT INTO etiq_entradas (id_entrada, id_etiqueta) VALUES ((SELECT MAX(id_entrada) FROM entradas), (SELECT MAX(id_etiqueta) FROM etiquetas))";
            $resultadoEmparejarNo = $accesoInsertarEtiquetas->consultar($consultaEmparejarNo);
        }

        foreach ($lasEtiqQueSiEstan as $cadaEtiqueta) { 
            $consultaSacarId = "SELECT id_etiqueta FROM etiquetas WHERE nombre = '$cadaEtiqueta';";
            $resultadoSacarId = $accesoInsertarEtiquetas->consultar($consultaSacarId)->fetch_all(MYSQLI_ASSOC);
            $idEtiqueta = $resultadoSacarId[0]["id_etiqueta"];
            $consultaEmparejarNo = "INSERT INTO etiq_entradas (id_entrada, id_etiqueta) VALUES ((SELECT MAX(id_entrada) FROM entradas), '$idEtiqueta');";
            $resultadoEmparejarNo = $accesoInsertarEtiquetas->consultar($consultaEmparejarNo);
        }
    }

header("Location: pagina.php"); 


?>
