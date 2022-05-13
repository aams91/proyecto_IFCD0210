function creUBorrar() {
    document.getElementById("nombreUsuario").value = "";
    document.getElementById("clave").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("email").value = "";
}


function creUVaciarCrearOk() {
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
    document.getElementById("pagDivModalEnt_" + id).style.display = "block";
}

function pagCerrarModalEntrada(id) {
    document.getElementById("pagDivModalEnt_" + id).style.display = "none";
}

function pagAbrirModalEtiqueta(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "block";
}

function pagCerrarModalEntSegunEtiq(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "none";
}

function pagCerrarsito(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "none";
}

function pagAbrirsito(id) {
    document.getElementById("pagDivModalEnt_" + id).style.display = "block";
}

/* FIN MOODALES */

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


// AGARRAR EL ARRAYINPUT Y PASARLO A JSON PARA MANDARLO

function pagManejarEtiquetas() { // pa ná
    var ajaxURL = "entradasYEtiquetas.php";
    var solicitudAjax = new XMLHttpRequest();
    solicitudAjax.onreadystatechange = function() {
        if (solicitudAjax.readyState == 4 && solicitudAjax.status == 200) {
            respuesta = solicitudAjax.responseText;                   
        }
        var JSONAMandar = JSON.stringify(arrayInput);
        solicitudAjax.open("POST", ajaxURL, true);
        
        solicitudAjax.send(JSONAMandar);
    }        
}

function pagEditarEntradas(id) {
    var ajaxURL = "ediciones.php";
    var solicitudAjax = new XMLHttpRequest();
    solicitudAjax.onreadystatechange = function() {
        if (solicitudAjax.readyState == 4 && solicitudAjax.status == 200) {
            respuesta = solicitudAjax.responseText;     
            document.getElementById("contenidoModalInputEdicion_" + id).style.display = "block";
            document.getElementById("contenidoModalInputEdicion_" + id).innerHTML = respuesta;

        }
    
    solicitudAjax.open("GET", ajaxURL, true);
    solicitudAjax.send(id);
    }
}

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

