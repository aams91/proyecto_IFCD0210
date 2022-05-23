<?php
include("funciones.php");
session_start();
chequearSesion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de <?php echo $_SESSION["usuario"];?></title>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="pagina">
    <?php
    if (!$_SESSION["usuario"]) {
        header("Location: index.php");
    } else {
        include("header.php");

        $usuario = $_SESSION["usuario"];   ?>
        <div id="bodyIzq">
            <div id="todasEntradas">
                <div id="entTorcido" class="torcido">Entradas</div>
                <?php
                $accesoEntradas = new ConectarDB;
                $consultaAccesoEntradas = "SELECT entradas.texto, entradas.id_entrada, entradas.fecha_creacion FROM entradas, usuarios WHERE usuarios.usuario = '$usuario' AND usuarios.id_usuario = entradas.id_usuario;";
                $resultadoEntradas = $accesoEntradas->consultar($consultaAccesoEntradas)->fetch_all(MYSQLI_ASSOC);
                $accesoEntradas->cerrar(); 

                foreach ($resultadoEntradas as $entrada) { 
                    $entradaIDEntrada = $entrada['id_entrada'];   ?>
                    <div class="entrada" data-id-entrada="<?php echo $entrada["id_entrada"];?>"> <?php   
                        echo $entrada["texto"];   ?> 
                        <span class="pagSpanModales" onclick="pasarID(<?php echo $entrada['id_entrada'];?>)">Ver entrada.</span>
                    </div> <?php
                            include("modalEntradas.php");
                }   ?>
            </div>
            <br>
            <div id="pagFormularioPpal">
                <form action="entradasYEtiquetas.php" method="post"> 
                <textarea name="adicion" id="adicion"  cols="30" rows="5" placeholder="Escribe aquí tu entrada" maxlength="995" oninput="pagContarCar()"></textarea>
                <div id="pagContadorCar">0/995</div> 
                <br>    <?php

                $accesoEtiquetasInput = new ConectarDB;
                $consultaAccesoEtiquetasInput = "SELECT DISTINCT etiquetas.nombre, etiquetas.id_etiqueta FROM etiquetas INNER JOIN etiq_entradas ON etiquetas.id_etiqueta = etiq_entradas.id_etiqueta INNER JOIN entradas ON etiq_entradas.id_entrada = entradas.id_entrada INNER JOIN usuarios ON entradas.id_usuario = (SELECT id_usuario FROM usuarios WHERE usuario = '$usuario')";
                $resultadoEtiquetasInput = $accesoEtiquetasInput->consultar($consultaAccesoEtiquetasInput)->fetch_all(MYSQLI_ASSOC);
                $accesoEtiquetasInput->cerrar();     ?>

                <label for="inputEtiquetas">Etiquetas</label>
                <input type="text" name="inputEtiqueta" id="inputEtiqueta" placeholder="#etiqueta, #etiqueta"> <span id="pagBorrarEtiq" onclick="pagBorrarEtiq()">Borrar etiquetas</span>
                <br><br>
                <div id="todasEtiquetasInput">  <?php 
                    foreach ($resultadoEtiquetasInput as $etiqueta) {
                                ?>
                        <span class="cadaEtiqueta" onclick="pagPintarEtiquetaInput('<?php echo $etiqueta['nombre'];?>')" id="cadaEtiqueta_<?php echo $etiqueta['id_etiqueta'];?>" data-id-etiqueta="<?php echo $etiqueta['id_etiqueta'];?>">  <?php echo $etiqueta["nombre"];?></span>    <?php
                    }     ?>
                </div>
                <br>
                <input type="submit" value="Insertar" id="btnInsertar" onclick="pagManejarEtiquetas()">
                </form>
            </div>
        </div>
        <div id="bodyDcha">  
            <div id="todasEtiquetasRelacion"><?php
                    $accesoEtiquetasRelacion = new ConectarDB;
                    $consultaAccesoEtiquetasRelacion = "SELECT DISTINCT etiquetas.nombre, etiquetas.id_etiqueta FROM etiquetas INNER JOIN etiq_entradas ON etiquetas.id_etiqueta = etiq_entradas.id_etiqueta INNER JOIN entradas ON etiq_entradas.id_entrada = entradas.id_entrada INNER JOIN usuarios ON entradas.id_usuario = (SELECT id_usuario FROM usuarios WHERE usuario = '$usuario');";
                    $resultadoEtiquetasRelacion = $accesoEtiquetasRelacion->consultar($consultaAccesoEtiquetasRelacion)->fetch_all(MYSQLI_ASSOC);
                    $accesoEtiquetasRelacion->cerrar();    ?>
                    
                    <div id="etiqTorcido" class="torcido">Etiquetas</div> 
                        <?php
                        foreach ($resultadoEtiquetasRelacion as $etiqueta) {
                            ?>
                            <span class="cadaEtiquetaRelacion" onclick="pagAbrirModalEtiqueta(<?php echo $etiqueta['id_etiqueta'];?>)"><?php echo $etiqueta['nombre'];?></span> 
                            <?php
                        } ?>
                    <?php include("modalEtiquetas.php"); ?>
            </div>
        </div>
        <br>      <?php
    } ?>
</body>
</html>


