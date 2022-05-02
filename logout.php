<?php session_start();
$_SESSION["usuario"] = "";
$_SESSION["clave"] = "";
unset($_SESSION);
header('Location: index.php'); 
?>