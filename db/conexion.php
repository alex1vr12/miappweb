<?php
$conexion = new mysqli("localhost", "root", "", "veterinaria");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
