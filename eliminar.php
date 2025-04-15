<?php
include("db/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conexion->query("DELETE FROM mascotas WHERE id = $id");
}

header("Location: listar.php");
?>
