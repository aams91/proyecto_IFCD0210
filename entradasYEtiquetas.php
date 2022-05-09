<?php
session_start();
include("funciones.php");


    $usuario = $_SESSION["usuario"];
    $texto = $_POST["adicion"];
    $etiqInput = $_POST["inputEtiqueta"]; //esto es un string
    echo "La variable post:";
    var_dump($_POST);
    $todasEtiquetasInput1 = trim($etiqInput);
    $todasEtiquetasInput = rtrim($todasEtiquetasInput1, ",");
    echo "<br><br><br>Las etiquetas sin espacios:";
    var_dump($todasEtiquetasInput);


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
    $arrayEtiqInput = explode(", ", $todasEtiquetasInput);
    echo "<br><br><br>Las etiquetas en array: <pre>";
    var_dump($arrayEtiqInput);
    echo "</pre>";

    $etiqApelotonadas = "";
    $accesoVerEtiquetas = new ConectarDB;
    $consultaVerEtiquetas = "SELECT * FROM etiquetas;";
    $resultadoVerEtiquetas = $accesoVerEtiquetas->consultar($consultaVerEtiquetas)->fetch_all(MYSQLI_ASSOC);
    foreach ($resultadoVerEtiquetas as $cadaResultado) {
        $etiqApelotonadas = $etiqApelotonadas . "," . $cadaResultado["nombre"] ; 
    }
    
    $arrayEtiqBD = explode(",", $etiqApelotonadas); 
    echo "<br><br><br>ñññe<pre>";
    var_dump($arrayEtiqBD);
    echo "</pre>";
    $accesoVerEtiquetas->cerrar();

    $lasEtiqQueNoEstan = array_diff($arrayEtiqInput, $arrayEtiqBD);
    echo "<br><br><br>Diferencias:<pre>";
    var_dump($lasEtiqQueNoEstan);


    $lasEtiqQueSiEstan = array_diff($arrayEtiqInput, $lasEtiqQueNoEstan);
    echo "<br><br><br>Diferencias:<pre>";
    var_dump($lasEtiqQueSiEstan);

    $accesoInsertarEtiquetas = new ConectarDB;
    foreach ($lasEtiqQueNoEstan as $cadaEtiqueta) {
        $consultaInsertarEtiquetas = "INSERT INTO etiquetas (id_etiqueta, nombre) VALUES (NULL, '$cadaEtiqueta');";
        $resultadoInsertarEtiquetas = $accesoInsertarEtiquetas->consultar($consultaInsertarEtiquetas);
        $consultaEmparejarNo = "INSERT INTO etiq_entradas (id_etiqueta, id_entrada) VALUES ((SELECT MAX(id_etiqueta) FROM etiquetas), (SELECT MAX(id_entrada) FROM entradas))";
        $resultadoEmparejarNo = $accesoInsertarEtiquetas->consultar($consultaEmparejarNo);
    }

    foreach ($lasEtiqQueSiEstan as $cadaEtiqueta) { 
        $consultaSacarId = "SELECT id_etiqueta FROM etiquetas WHERE nombre = '$cadaEtiqueta';";
        $resultadoSacarId = $accesoInsertarEtiquetas->consultar($consultaSacarId)->fetch_all(MYSQLI_ASSOC);
        $idEtiqueta = $resultadoSacarId[0]["id_etiqueta"];
        $consultaEmparejarNo = "INSERT INTO etiq_entradas (id_entrada, id_etiqueta) VALUES ((SELECT MAX(id_entrada) FROM entradas), '$idEtiqueta');";
        $resultadoEmparejarNo = $accesoInsertarEtiquetas->consultar($consultaEmparejarNo);
    }

header("Location: pagina.php"); 


?>
