<?php
include("funciones.php");


if ($_POST) {

    // Editar etiquetas   
    foreach ($_POST as $key => $value) {
        if (str_contains($key, "etiquetaInput")) { 
            $idEtiqueta = explode("_", $key)[1];
            $conexionEditarEtiq = new ConectarDB;
            $consultaEditarEtiq = "UPDATE etiquetas SET nombre = '$value' WHERE id_etiqueta =  '$idEtiqueta';";
            $resultadoEditarEtiq = $conexionEditarEtiq->consultar($consultaEditarEtiq);
        }
    }

    // Editar texto
    if ($_POST["adicionEditada"]) {
        $textoEditado = $_POST["adicionEditada"];
        $textoEditado = addslashes($textoEditado);
        echo "3 " . $textoEditado;
        $idEntrada = $_POST["idEntrada"];

        $conexionEditarEntrada = new ConectarDB;
        $consultaEditarEntrada = "UPDATE entradas SET texto = '$textoEditado' WHERE entradas.id_entrada = '$idEntrada';";
        $resultadoEditar = $conexionEditarEntrada->consultar($consultaEditarEntrada);
        
    } 

    // Crear etiquetas
    if ($_POST["etiqInputCreacion"]) {
        $idEntrada = $_POST["idEntrada"];
        $todasEtiquetasInput = $_POST["etiqInputCreacion"];
        $arrayEtiqInput = explode(", ", $todasEtiquetasInput);
        $etiqApelotonadas = "";
        $accesoVerEtiquetas = new ConectarDB;
        $consultaVerEtiquetas = "SELECT * FROM etiquetas;";
        $resultadoVerEtiquetas = $accesoVerEtiquetas->consultar($consultaVerEtiquetas)->fetch_all(MYSQLI_ASSOC);
        foreach ($resultadoVerEtiquetas as $cadaResultado) {
            // Acá meto todas las etiquetas (tanto las que existen como las que no) juntas...*
            $etiqApelotonadas = $etiqApelotonadas . "," . $cadaResultado["nombre"] ; 
        }
        
        $arrayEtiqBD = explode(",", $etiqApelotonadas); 
        
        // *...para luego crear dos arrays: uno con las etiquetas que existen y otro con las que no.
        $lasEtiqQueNoEstan = array_diff($arrayEtiqInput, $arrayEtiqBD);
        $lasEtiqQueSiEstan = array_diff($arrayEtiqInput, $lasEtiqQueNoEstan);

        $accesoInsertarEtiquetas = new ConectarDB;
        foreach ($lasEtiqQueNoEstan as $cadaEtiqueta) {
            $consultaInsertarEtiquetas = "INSERT INTO etiquetas (id_etiqueta, nombre) VALUES (NULL, '$cadaEtiqueta');";
            $resultadoInsertarEtiquetas = $accesoInsertarEtiquetas->consultar($consultaInsertarEtiquetas);
            $consultaEmparejarNo = "INSERT INTO etiq_entradas (id_entrada, id_etiqueta) VALUES ('$idEntrada', (SELECT MAX(id_etiqueta) FROM etiquetas));";
            $resultadoEmparejarNo = $accesoInsertarEtiquetas->consultar($consultaEmparejarNo);
        }
           
        foreach ($lasEtiqQueSiEstan as $cadaEtiqueta) {
            // Compruebo la cantidad de veces que la etiqueta está vinculada a la entada a la que se agrega...**
            $consultaVecesEtiqVinculada = "SELECT COUNT(*) AS repeticiones FROM etiq_entradas WHERE etiq_entradas.id_entrada = $idEntrada AND etiq_entradas.id_etiqueta = (SELECT id_etiqueta FROM etiquetas WHERE etiquetas.nombre = '$cadaEtiqueta');";
            $resultadoVecesEtiqVinculada = $accesoInsertarEtiquetas->consultar($consultaVecesEtiqVinculada)->fetch_assoc();

            if ($resultadoVecesEtiqVinculada['repeticiones'] == 0) {
                // **... y si no está vinculada, la vinculo.
                $consultaSacarId = "SELECT id_etiqueta FROM etiquetas WHERE nombre = '$cadaEtiqueta';";
                $resultadoSacarId = $accesoInsertarEtiquetas->consultar($consultaSacarId)->fetch_all(MYSQLI_ASSOC);
                $idEtiqueta = $resultadoSacarId[0]["id_etiqueta"];
                $consultaEmparejarNo = "INSERT INTO etiq_entradas (id_entrada, id_etiqueta) VALUES ('$idEntrada', '$idEtiqueta');";
                $resultadoEmparejarNo = $accesoInsertarEtiquetas->consultar($consultaEmparejarNo);
            }
        }
    } 
    $conexionEditarEntrada->cerrar();
    $conexionEditarEtiq->cerrar();
    $accesoVerEtiquetas->cerrar();
    $accesoInsertarEtiquetas->cerrar();
    header("Location: pagina.php");
} 
?>