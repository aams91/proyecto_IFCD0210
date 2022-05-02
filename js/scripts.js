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

function pagAbrirModal(id) {
    document.getElementById("pagDivModal_" + id).style.display = "block";
}

function pagCerrarModal(id) {
    document.getElementById("pagDivModal_" + id).style.display = "none";
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