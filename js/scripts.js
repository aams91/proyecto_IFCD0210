function pasarID (id) {
    document.getElementById("pagBotonModal").addEventListener("click", cambiarOrdenFecha(id));
    document.getElementById("pagBotonModal").addEventListener("click", pintarBtnsAntYSig(id));
    document.getElementById("pagBotonModal").addEventListener("click", pagAbrirModalEntrada(id)); 
}


function creUBorrar() {
    // Esta función borra los campos del formulario de creación de usuario
    document.getElementById("nombreUsuario").value = "";
    document.getElementById("clave").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("email").value = "";
}


function creUVaciarCrearOk() {
    // Esta función vacía los campos del formulario de creación de usuario una vez hemos creado el usuario
    document.getElementById("nombreUsuario").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("email").value = "";
    document.getElementById("mensajeCreacion").innerHTML = "Usuario creado con éxito."
}


function pagContarCar() {
    maxLong = document.getElementById("adicion").getAttribute("maxlength");
    longVerdad = document.getElementById("adicion").value.length;
    document.getElementById("pagContadorCar").innerHTML = longVerdad + "/" + maxLong;
}


function pagContarCarEdicion(id) {
    longVerdadEd = document.getElementById("adicionEditada_" + id).value.length;
    maxLongEd = document.getElementById("adicionEditada_" + id).getAttribute("maxlength");
    document.getElementById("pagContadorCarEdicion_" + id).innerHTML = longVerdadEd + "/" + maxLongEd;
}


/* COMIENZO MODALES */

function pagAbrirModalEntrada(id) {
    if (document.getElementById("contenidoModalInputEdicion_" + id).style.display = "inline-block") {
        document.getElementById("contenidoModalInputEdicion_" + id).style.display = "none";
    }

    document.getElementById("pagDivModalEnt_" + id).style.display = "block";
    document.getElementById("pagContenidoModalDefecto_" + id).style.display = "inline-block";
}


function pintarBtnsAntYSig(id) {
    if (document.getElementById("pagDivModalEnt_" + id).previousElementSibling.previousElementSibling.id.includes("pagDivModalEnt") === false) {
        // Primera entrada - comprobamos si el elemento anterior contiene "pagDivModalEnt" para mostrar el botón de siguiente:
        document.getElementById("btnAnteriorEntrada_" + id).style.display = "none"; 
        document.getElementById("btnSiguienteEntrada_" + id).style.display = "inline-block";
    } else if (document.getElementById("pagDivModalEnt_" + id).id === document.getElementById("todasEntradas").lastChild.previousElementSibling.id && document.getElementById("pagDivModalEnt_" + id).previousElementSibling.previousElementSibling.id.includes("pagDivModalEnt") === true) {
        // Última entrada - comprobamos si su id y el del último elemento coinciden para NO mostrar el botón de siguiente:
        document.getElementById("btnSiguienteEntrada_" + id).style.display = "none";
        document.getElementById("btnAnteriorEntrada_" + id).style.display = "inline-block";
    } else if (document.getElementById("pagDivModalEnt_" + id).previousElementSibling.previousElementSibling.id.includes("pagDivModalEnt") === true && document.getElementById("pagDivModalEnt_" + id).nextElementSibling.nextElementSibling.id.includes("pagDivModalEnt") === true) {
        // Entradas intermedias - comprobamos si los elementos previo y posterior contiene "pagDivModalEnt" para mostrar los botones:
        document.getElementById("btnAnteriorEntrada_" + id).style.display = "inline-block";
        document.getElementById("btnSiguienteEntrada_" + id).style.display = "inline-block";
    }
}


function anteriorEntrada(id) {
    // Sacar el id del elemento anterior (idMandar), llamar a la función pagCerrarModalEntrada() y llamar a la función pasarID();
    idMandar = document.getElementById("pagDivModalEnt_" + id).previousElementSibling.previousElementSibling.id.split("_")[1];
    console.log(idMandar);
    pagCerrarModalEntrada(id);
    pasarID(idMandar);
}


function siguienteEntrada(id) {
    // Sacar el id del elemento siguiente (idMandar2), llamar a la función pagCerrarModalEntrada() y llamar a la función pasarID();
        idMandar2 = document.getElementById("pagDivModalEnt_" + id).nextElementSibling.nextElementSibling.id.split("_")[1];
        pagCerrarModalEntrada(id);
        pasarID(idMandar2);    
}


function pagCerrarModalEntrada(id) {
    document.getElementById("pagDivModalEnt_" + id).style.display = "none";
}


function pagAbrirModalEtiqueta(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "block";
}

// A esta función debería haberle puesto pagCerrarModalEtiqueta pero no sé por qué no lo hice; alguna razón ha de haber
function pagCerrarModalEntSegunEtiq(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "none";
}

// Esta función cierra el modal "Entradas asociadas a (#etiqueta)" cuando damos click sobre la entrada que queremos abrir...*
function pagCerrarsito(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "none";
}

// *...y esta función abre el modal de la entrada que queremos abrir
function pagAbrirsito(id) {
    document.getElementById("pagDivModalEnt_" + id).style.display = "block";
}

/* FIN MODALES */


var arrayInput = new Array (); // no sirve de nada y está en la siguiente funciónm, que tampoco sirve para nada
function cambiarlenombre() {
    /* CON ESTO VOY AGARRANDO LO QUE MANDO CON "NUEVA ETIQUETA" EN EL INPUT Y LO VOY AGREGANDO A UN ARRAY
    var loDelInput = document.getElementById("inputEtiqueta").value;
    document.getElementById("etiquetasElegidas").innerHTML += "<span class='cadaEtiquetaInput'>" + loDelInput + "</span>";
    arrayInput.push(loDelInput);
    console.log(arrayInput); */

    /* 
    document.getElementById("etiquetasElegidas").innerHTML += "<span class='cadaEtiquetaInput'>" + loDelInput + "</span>";
    var etqs = document.getElementById("etiquetasElegidas").innerHTML.split('<span class="cadaEtiquetaInput">');
    var etq = "";
    for (i=1; i<etqs.length; i++) {
        etq += etqs[i];
        var etqSplit = etq.split("</span>");
        var etqCasiListo = etqSplit.join(","); 
        var JsonEtiquetas = JSON.stringify(etqCasiListo);
    } */
    document.getElementById("inputEtiqueta").value = "";
}


function pagSpanEliminarEnt(id) {
    var urlAJAX = "http://localhost:8080/pen_arb/eliminaciones.php";
    var llamadaAJAX = new XMLHttpRequest();

    llamadaAJAX.onreadystatechange = function() {
        if (llamadaAJAX.readyState == 4 ) {
            /* var respuesta = llamadaAJAX.responseText;
            document.getElementById("todasEntradas").innerHTML = respuesta; */
            window.location="pagina.php";
        }
     }

    llamadaAJAX.open( "GET", urlAJAX + "?idEntrada=" + id);
    llamadaAJAX.send();
} 

// Esta función pinta la etiqueta elegida en el input principal de agregar etiquetas
function pagPintarEtiquetaInput(etq) {
    document.getElementById("inputEtiqueta").value += etq + ", ";
}


function pagBorrarEtiq() {
    document.getElementById("inputEtiqueta").value = "";
}


function pagInputEditarEntrada(id) {
    document.getElementById("pagContenidoModalDefecto_" + id).style.display = "none";
    document.getElementById("contenidoModalInputEdicion_" + id).style.display = "inline-block";
}


function cambiarOrdenFecha(id) {
    fechaCreacion = document.getElementById("fechaCreacion_" + id).innerHTML.split("-");
    fechaCreacion = fechaCreacion[2] + "-" + fechaCreacion[1] + "-" + fechaCreacion[0];
    document.getElementById("fechaCreacion_" + id).innerHTML = fechaCreacion;
}

// Esta función hace que el modal de edición de entrada se "cierre" y vuelva al modal de la entrada en cuestión
function cerrarModalEdicion(id) {    
    document.getElementById("contenidoModalInputEdicion_" + id).style.display = "none";
    document.getElementById("pagContenidoModalDefecto_" + id).style.display = "inline-block";
}



function mostrarInputEdicionEtiq(id) {
    console.log(id);
    id = id.split("_");
    idF = id[0] + id[1];
    document.getElementById("etiquetaEdicion_" + idF).style.display = "inline-block";
    document.getElementById("signoCheck_" + idF).style.display = "inline-block";
}


function agregarEtiqEditInputEscond(id) {
    id = id.split("_");
    idF = id[0] + id[1];
    var etq = document.getElementById("etiquetaEdicion_" + idF).value;
    if (document.getElementById("etiquetaEdicion_" + idF).style.display = "inline-block") {
        document.getElementById("etiquetaEdicion_" + idF).style.display = "none";
    }
    if (document.getElementById("signoCheck_" + idF).style.display = "inline-block") {
        document.getElementById("signoCheck_" + idF).style.display = "none";
    }
    document.getElementById("etiquetasModalInputEdicion_" + id[0] + "_" + id[1]).innerHTML = etq;
}

function mostrarInputCrearEtiq(id) {
    document.getElementById("etiqInputCreacion_" + id).style.display = "inline-block";
}