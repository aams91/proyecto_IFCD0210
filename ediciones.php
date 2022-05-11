<?php
include("funciones.php");
session_start();
chequearSesion();


echo $_POST["adicionEditada"];
/* SACAR TEXTO INTRODUCIDO
CONECTAR A LA BASE DE DATOS
HACER LA CONSULTA CON EL UPDATE
DEVOLVER BÚSQUEDA DE LA ENTRADA */

/* $textoEditado = $_POST["adicionEditada"];

$conexionEditar = new ConectarDB;
$consultaEditar = "UPDATE `entradas` SET `texto` = 'probando más de una entraditaa en una etiqueta' WHERE `entradas`.`id_entrada` = 305;"

 */



?>