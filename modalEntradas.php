<?php 
$accesoCadaEtiqEntrada = new ConectarDB;
$consultaCadaEtiqEntrada = "SELECT etiquetas.nombre, etiquetas.id_etiqueta FROM etiquetas INNER JOIN etiq_entradas ON etiquetas.id_etiqueta = etiq_entradas.id_etiqueta INNER JOIN entradas ON entradas.id_entrada = etiq_entradas.id_entrada WHERE entradas.id_entrada = $entradaIDEntrada";
$resultadoCadaEtiqEntrada = $accesoCadaEtiqEntrada->consultar($consultaCadaEtiqEntrada)->fetch_all(MYSQLI_ASSOC);   
$accesoCadaEtiqEntrada->cerrar();     ?>



<div id="pagDivModalEnt_<?php echo $entrada["id_entrada"]?>" class="pagModal">

    <a id="btnAnteriorEntrada" onclick="anteriorEntrada(<?php echo $entrada['id_entrada']?>)">&#8249;</a>
    <a id="btnSiguienteEntrada" onclick="siguienteEntrada(<?php echo $entrada['id_entrada']?>)">&#8250;</a>

    <div class="pagContenidoModal pagContenidoModalEntradas">
        <span class="pagCerrarModal" onclick="pagCerrarModalEntrada(<?php echo $entrada['id_entrada'];?>)">X</span>
        <div id="pagContenidoModalDefecto_<?php echo $entrada["id_entrada"]?>" >
            <p class="pagContenidoModalMostrarEntrada"><?php echo $entrada["texto"];?></p>
            <p class="fechaCreacion">Entrada creada a fecha <span id="fechaCreacion_<?php echo $entrada['id_entrada']; ?>"><?php echo $entrada["fecha_creacion"]; ?></span></p>   
            <p id="pagContenidoModalEtiq"> <span class="pagContenidoModalSpanEtiq">Etiquetas:</span> 
                <?php 
                foreach ($resultadoCadaEtiqEntrada as $etiqEntrada) {      ?>
                    <span class="cadaEtiqueta" onclick="pagCerrarModalEntrada(<?php echo $entrada['id_entrada'];?>); pagAbrirModalEtiqueta(<?php echo $etiqEntrada['id_etiqueta'];?>)"><?php echo $etiqEntrada["nombre"];?></span> <br>
                    <?php 
                } ?>
            </p>
            <span id="pagSpanEditarEnt" onclick="pagInputEditarEntrada(<?php echo $entrada['id_entrada']?>)">Editar</span>
            <span id="pagSpanEliminarEnt" onclick="pagSpanEliminarEnt(<?php echo $entrada['id_entrada']?>)">Eliminar entrada</span>
        </div>

        <!-- COMIENZO CONTENIDO ESCONDIDO POR DEFECTO -->
        <div class="contenidoModalInputEdicion" id="contenidoModalInputEdicion_<?php echo $entrada['id_entrada']?>" style="display:none">                
            <form action="ediciones.php" method="POST" id="pagFormularioEdicion_<?php echo $entrada['id_entrada'];?>">
                <div class="txtareaYBtns">
                    <textarea name="adicionEditada" class="adicionEditada" id="adicionEditada_<?php echo $entrada['id_entrada'];?>" cols="30" rows="10" maxlength="995" oninput="pagContarCarEdicion(<?php echo $entrada['id_entrada'];?>)"><?php echo $entrada["texto"];?></textarea>
                    <input type="hidden" name="idEntrada" id="idEntrada" value="<?php echo $entrada['id_entrada'];?>">
                    <div id="pagContadorCarEdicion_<?php echo $entrada['id_entrada'];?>">0/995</div>
                    <button id="btnEnviarEditar">Enviar</button> <span class="pagSpanModales" id="pagBotonModal" onclick="cerrarModalEdicion(<?php echo $entrada['id_entrada']?>)"><mark>Entrada</mark></span>  
                </div>    
                <div id="etiquetitas"> <?php 
                    foreach ($resultadoCadaEtiqEntrada as $etiqEntrada) {      ?>
                        <div class="etiquetasModalEdicion"> 
                            <span onclick="mostrarInputEdicionEtiq(<?php echo $etiqEntrada['id_etiqueta'];?>)" class="cadaEtiqueta" id="etiquetasModalInputEdicion_<?php echo $etiqEntrada['id_etiqueta'];?>"><?php echo $etiqEntrada['nombre'];?></span>
                                
                            <input style="display:none" type="text" name="etiquetaInputEdicion_<?php echo $etiqEntrada['id_etiqueta'];?>" id="etiquetaEdicion_<?php echo $etiqEntrada['id_etiqueta'];?>" value="<?php echo $etiqEntrada['nombre'];?>">  
                                
                            <span style="display:none" id="signoCheck_<?php echo $etiqEntrada['id_etiqueta'];?>" onclick="agregarEtiqEditInputEscond(<?php echo $etiqEntrada['id_etiqueta'];?>)">✓</span>
                        </div>
                        <?php 
                    } ?> 
                    <span>Haz click sobre la etiqueta para editarla</span>
            </div>     
            </form> 
            

        </div>
        <!-- FIN CONTENIDO ESCONDIDO POR DEFECTO -->
    </div>
</div>
