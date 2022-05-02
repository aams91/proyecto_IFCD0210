<?php
session_start();
include("funciones.php");

    // Sacar hora
    $accesoHoraCreacion = new ConectarDB;
    $consultaHoraCreacion = "SELECT CURRENT_TIME;";
    $resultadoHoraCreacion =
$accesoHoraCreacion->consultar($consultaHoraCreacion)->fetch_all(MYSQLI_ASSOC);
    $horaCreacion = $resultadoHoraCreacion[0]["CURRENT_TIME"];

    // Sacar fecha
    $accesoFechaCreacion = new ConectarDB;
    $consultaFechaCreacion = "SELECT CURRENT_DATE;";
    $resultadoFechaCreacion =
$accesoFechaCreacion->consultar($consultaFechaCreacion)->fetch_all(MYSQLI_ASSOC);
    $fechaCreacion = $resultadoFechaCreacion[0]["CURRENT_DATE"];




$usuario = $_SESSION["usuario"];
if isset $algo = $_GET["algo"];
print_r($algo);
/* 

$conexion1 = new ConectarDB;
$consulta1 = "SELECT id_usuario FROM usuarios WHERE usuario='$usuario';";
$resultado1 = $conexion1->consultar($consulta1)->fetch_all(MYSQLI_ASSOC);
$idUsuario = $resultado1[0]["id_usuario"];

$conexion2 = new ConectarDB;
$consulta2 = "INSERT INTO entradas (id_entrada, id_usuario, texto,
hora_creacion, fecha_creacion, animo) VALUES (NULL, '$idUsuario', 'a
ver si funciona con código', '$horaCreacion', '$fechaCreacion',
NULL);";
$resultado2 = $conexion2->consultar($consulta2);

foreach ($etiquetas as $etiqueta) {
    $conexion3 = new ConectarDB;
    $consulta3 = "INSERT INTO etiquetas (id_etiqueta, nombre) VALUES
    (NULL, '$etiqueta');";
    $resultado3 = $conexion3->consultar($consulta3);


    $conexion4 = new ConectarDB;
    $consulta4 = "INSERT INTO etiq_entradas (id_etiq_entrada, id_entrada,
    id_etiqueta) VALUES (NULL, (SELECT MAX(id_entrada) FROM entradas),
    (SELECT MAX(id_etiqueta) FROM etiquetas));";
    $resultado4 = $conexion4->consultar($consulta4);
} */

?>



<form action="" method="GET">
    <input type="text" name="algo" id="algo">
    <button onclick="aVer()">dale</button>
</form>

<div id="devuelto"></div>


<script>

   function aVer() {

        var algo = document.getElementById("algo").value;
        sinEsp = algo.replace(/, /g, ",");
        arrAlgo = sinEsp.split(",");
        jsonarr = JSON.stringify(arrAlgo);
        console.log(jsonarr);
        jsondco= JSON.parse(jsonarr);
        document.getElementById("devuelto").innerHTML += jsondco + "<br>";  
        window.location.href = "canvas.php?algo=" + jasondco;
            
    } 

        for (i=0; i<arrAlgo.length; i++) {
            document.getElementById("devuelto").innerHTML +=
arrAlgo[i] + "<br>";
        } 

</script>  
