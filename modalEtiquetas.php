<?php 
foreach ($resultadoEtiquetasRelacion as $etiqueta) {
    $etiquetaIDEtiqueta = $etiqueta['id_etiqueta'];
    $accesoTextoBien = new ConectarDB;
    $consultaTextoBien = "SELECT DISTINCT texto, entradas.id_entrada, etiquetas.id_etiqueta FROM entradas INNER JOIN etiq_entradas ON etiq_entradas.id_entrada = entradas.id_entrada INNER JOIN usuarios ON usuarios.id_usuario = entradas.id_usuario INNER JOIN etiquetas ON etiq_entradas.id_etiqueta = etiquetas.id_etiqueta WHERE usuarios.usuario = '$usuario' AND etiq_entradas.id_etiqueta = '$etiquetaIDEtiqueta';"; 
    $resultadoTextoBien = $accesoTextoBien->consultar($consultaTextoBien)->fetch_all(MYSQLI_ASSOC);  ?>

    <div id="pagDivModalEntSegunEtiq_<?php echo $etiqueta['id_etiqueta'];?>" class="pagModal">
        <div class="pagContenidoModal pagContenidoModalEntSegunEtiq">
            <span id="entradasAsoc">Entradas asociadas a <?php echo $etiqueta['nombre'];?>:</span>
            <span class="pagCerrarModal" onclick="pagCerrarModalEntSegunEtiq(<?php echo $etiqueta['id_etiqueta'];?>)">X</span>
            <p class="pagContenidoModalEntradaEtiq">   <?php 
                foreach ($resultadoTextoBien as $textoBien) {
                    $textito = $textoBien["texto"];
                    $consultaIDEnt = "SELECT entradas.id_entrada FROM entradas INNER JOIN etiq_entradas ON etiq_entradas.id_entrada = entradas.id_entrada INNER JOIN etiquetas ON etiq_entradas.id_etiqueta = etiquetas.id_etiqueta INNER JOIN usuarios ON usuarios.id_usuario = entradas.id_usuario WHERE entradas.texto = '$textito' AND usuarios.usuario = '$usuario';";
                    $resultadoIDEnt = $accesoTextoBien->consultar($consultaIDEnt)->fetch_all(MYSQLI_ASSOC);    ?>  
                    <span class="pagContenidoModalCadaEntrada" onclick="pagCerrarsito(<?php echo $etiqueta['id_etiqueta'];?>); <?php foreach ($resultadoIDEnt as $cadaIDEnt) {?> pagAbrirsito(<?php echo $cadaIDEnt['id_entrada'];?>)" <?php } ?>><?php echo $textoBien['texto'];?></span>
                        <?php    
                }   ?>
            </p>
        </div>
    </div>   <?php
}  ?>