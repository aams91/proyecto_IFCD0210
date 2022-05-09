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

function pagContarCarEdicion() {
    maxLongEd = document.getElementById("adicionEditada").getAttribute("maxlength");
    longVerdadEd = document.getElementById("adicionEditada").value.length;
    document.getElementById("pagContadorCarEdicion").innerHTML = longVerdadEd + "/" + maxLongEd;
}

/* MODAL */

function pagAbrirModalEnt(id) {
    document.getElementById("pagDivModalEnt_" + id).style.display = "block";
}

function pagCerrarModalEnt(id) {
    document.getElementById("pagDivModalEnt_" + id).style.display = "none";
}

function pagAbrirModalEntrada(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "block";
}

function pagCerrarModalEntEtiq(id) {
    document.getElementById("pagDivModalEntSegunEtiq_" + id).style.display = "none";
}

var arrayInput = new Array ();
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

function pagManejarEtiquetas() {
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


function pagPintarEtiquetaInput(etq) {
    document.getElementById("inputEtiqueta").value += etq + ", ";
}


/* window.onclick = function (event) {
    if (event.target == document.getElementById("pagDivModal")) {
        document.getElementById("pagDivModal").style.display = "none";
    }
}  */

function pagBorrarEtiq() {
    document.getElementById("inputEtiqueta").value = "";
}

function pagInputEditarEntrada() {
    console.log(2+8);
    if (document.getElementById("pagContenidoModalDefecto").style.display === "block") {
        document.getElementById("pagContenidoModalDefecto").style.display = "none";
    }
    if (document.getElementById("contenidoModalInputEdicion").style.display === "block") {
        document.getElementById("contenidoModalInputEdicion").style.display = "block";
    }
}