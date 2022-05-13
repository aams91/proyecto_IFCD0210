<?php 
$accesoCadaEtiqEntrada = new ConectarDB;
$consultaCadaEtiqEntrada = "SELECT etiquetas.nombre, etiquetas.id_etiqueta FROM etiquetas INNER JOIN etiq_entradas ON etiquetas.id_etiqueta = etiq_entradas.id_etiqueta INNER JOIN entradas ON entradas.id_entrada = etiq_entradas.id_entrada WHERE entradas.id_entrada = $entradaIDEntrada";
$resultadoCadaEtiqEntrada = $accesoCadaEtiqEntrada->consultar($consultaCadaEtiqEntrada)->fetch_all(MYSQLI_ASSOC);   
$accesoCadaEtiqEntrada->cerrar();     ?>

<div id="pagDivModalEnt_<?php echo $entrada["id_entrada"]?>" class="pagModal">
    <div class="pagContenidoModal pagContenidoModalEntradas">
        <span class="pagCerrarModal" onclick="pagCerrarModalEntrada(<?php echo $entrada['id_entrada'];?>)">X</span>
        <div id="pagContenidoModalDefecto_<?php echo $entrada["id_entrada"]?>" >
            <p class="pagContenidoModalMostrarEntrada"><?php echo $entrada["texto"];?></p>
            <p class="fechaCreacion">Entrada creada a fecha <span id="fechaCreacion_<?php echo $entrada['id_entrada']; ?>"><?php echo $entrada["fecha_creacion"]; ?></span></p>   
            <p class="pagContenidoModalEtiq"> <span class="pagContenidoModalSpanEtiq">Etiquetas:</span> 
                <?php 
                foreach ($resultadoCadaEtiqEntrada as $etiqEntrada) {      ?>
                    <span class="pagContenidoModalEtiqCadaEtiq" onclick="pagCerrarModalEntrada(<?php echo $entrada['id_entrada'];?>); pagAbrirModalEtiqueta(<?php echo $etiqEntrada['id_etiqueta'];?>)"><?php echo $etiqEntrada["nombre"];?></span> <br>
                    <?php 
                } ?>
            </p>
            <span id="pagSpanEditarEnt" onclick="pagInputEditarEntrada(<?php echo $entrada['id_entrada']?>)">Editar</span>
        </div>

        <!-- COMIENZO CONTENIDO ESCONDIDO POR DEFECTO -->
        <div id="contenidoModalInputEdicion_<?php echo $entrada['id_entrada']?>" style="display:none">                
            <form method="POST" id="pagFormularioEdicion_<?php echo $entrada['id_entrada'];?>">
                <textarea name="adicionEditada" class="adicionEditada" id="adicionEditada_<?php echo $entrada['id_entrada'];?>" cols="30" rows="10" maxlength="995" oninput="pagContarCarEdicion(<?php echo $entrada['id_entrada'];?>)"><?php echo $entrada["texto"];?></textarea>
                <div id="pagContadorCarEdicion_<?php echo $entrada['id_entrada'];?>">0/995</div>
                <button id="btnEnviarEditar" onclick="pagEditarEntradas(<?php echo $entrada['id_entrada'];?>)">Enviar</button>
            </form>
        </div>
        <!-- FIN CONTENIDO ESCONDIDO POR DEFECTO -->
    </div>
</div>
