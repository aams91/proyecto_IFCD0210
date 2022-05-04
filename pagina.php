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
<body>
    <?php
    if (!$_SESSION["usuario"]) {
        header("Location: index.php");
    } else {
        include("header.php");

        $usuario = $_SESSION["usuario"];

        $accesoEntradas = new ConectarDB;
        $consultaAccesoEntradas = "SELECT texto, id_entrada FROM entradas, usuarios WHERE usuario = '$usuario' AND usuarios.id_usuario = entradas.id_usuario;";
        $resultadoEntradas = $accesoEntradas->consultar($consultaAccesoEntradas)->fetch_all(MYSQLI_ASSOC);
        ?>
        <div id="todasEntradas">
            <?php
            foreach ($resultadoEntradas as $entrada) {
            ?>
                <div class="entrada" data-id-entrada="<?php echo $entrada["id_entrada"]?>">
                    <?php echo $entrada["texto"];?> 
                    <span class="pagSpanModales" id="pagBotonModal" onclick="pagAbrirModal(<?php echo $entrada['id_entrada'];?>)">
                        <mark>Abrir modal</mark>
                    </span>
                </div> 

                <!-- MODAL -->
                <div id="pagDivModal_<?php echo $entrada["id_entrada"]?>" class="pagModal">
                    <div class="pagContenidoModal">
                        <span class="pagCerrarModal" onclick="pagCerrarModal(<?php echo $entrada['id_entrada'];?>)">X</span>
                        <p><?php echo $entrada["texto"];?></p>
                    </div>
                </div>
                <!-- FIN MODAL -->
            <?php
            }
        $accesoEntradas->cerrar();
            ?>
            
        </div>

        <form action="entradasYEtiquetas.php" method="post"> 
            <textarea name="adicion" id="adicion"  cols="30" rows="5" placeholder="Escribe aquí" maxlength="995" oninput="pagContarCar()"></textarea>
            <div id="pagContadorCar">0/995</div> 
            <br>
            <!-- <div name="etiquetasElegidas" id="etiquetasElegidas">Etiquetas </div> -->
            <br>
            <?php
                $accesoEtiquetas = new ConectarDB;
                $consultaAccesoEtiquetas = "SELECT DISTINCT etiquetas.nombre, etiquetas.id_etiqueta FROM etiquetas INNER JOIN etiq_entradas ON etiquetas.id_etiqueta = etiq_entradas.id_etiqueta INNER JOIN entradas ON etiq_entradas.id_entrada = entradas.id_entrada INNER JOIN usuarios ON entradas.id_usuario = (SELECT id_usuario FROM usuarios WHERE usuario = '$usuario')";
                $resultadoEtiquetas = $accesoEtiquetas->consultar($consultaAccesoEtiquetas)->fetch_all(MYSQLI_ASSOC);
            ?>
            <div id="todasEtiquetas">
                <?php 
                    foreach ($resultadoEtiquetas as $etiqueta) {   
                    ?>
                        <span class="cadaEtiquetaInput" onclick="cambiarFondo(<?php echo $etiqueta['id_etiqueta'];?>)" id="cadaEtiqueta_<?php echo $etiqueta['id_etiqueta'];?>" data-id-etiqueta="<?php echo $etiqueta['id_etiqueta'];?>">
                            <?php echo $etiqueta["nombre"];?>
                    </span>
                    <?php
                    }
                }
                ?>
            </div>
            <br>
            <label for="inputEtiquetas">Etiquetas</label>
            <input type="text" name="inputEtiqueta" id="inputEtiqueta" placeholder="etiqueta" >
<!--             <span id="pintarEtiqueta" onclick="pintarEtiqueta()">Nueva etiqueta</span> -->
            <br>
            <input type="submit" value="Insertar" id="btnInsertar" onclick="manejarEtiquetas()">
        </form>

        
        <?php
        $accesoEtiquetas->cerrar();

        ?>
</body>
</html>


