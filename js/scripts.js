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
    console.log(etq);
    document.getElementById("inputEtiqueta").value += etq + ", ";
    /* document.getElementById("cadaEtiqueta_" + id).style.color = "red"; */
    // ESTO YA FUNCIONA, AHORA HACER UN IF PARA CAMBIARLE EL COLOR SI SE SELECCIONA Y OTRO IF PARA QUE SE INCLUYA EN EL ARRAY SI ESTÁ SELECCIONADA
}





/* window.onlick = function (event) {
    if (event.target == document.getElementById("pagDivModal")) {
        document.getElementById("pagDivModal").style.display = "none";
    }
} */



/* 
function editar() {
    console.log(4+9);
   
}


function insertarYRepintar() {
    console.log(5+9);
    var adicion = document.getElementById("adicion").value;
    var etiquetas = document.getElementById("inputEtiquetas").value;
    var JsonEtiquetas = JSON.stringify(etiquetas);
    
    var ajaxURL = "insertarYRepintar.php";
    var solicitudAjax = new XMLHttpRequest();
    solicitudAjax.onreadystatechange = function() {
    if (solicitudAjax.readyState == 4 && solicitudAjax.status == 200) {
            respuesta = solicitudAjax.responseText;
            document.getElementById("todasEntradas").innerHTML = respuesta; 
           
    }
    solicitudAjax.open("GET", ajaxURL + "?adicion=" + adicion + "&etiquetas=" + JsonEtiquetas);

    solicitudAjax.send(); 
    


}}


 */