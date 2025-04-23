<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "martinsi";

$conexion =mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>