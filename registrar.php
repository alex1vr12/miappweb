<?php
include("db/conexion.php");

$nombre = $_POST['nombre'];
$raza = $_POST['raza'];
$edad = $_POST['edad'];
$nombre_dueno = $_POST['nombre_dueno'];
$vacunado = $_POST['vacunado'];

$sql = "INSERT INTO mascotas (nombre, raza, edad, nombre_dueno, vacunado)
VALUES ('$nombre', '$raza', '$edad', '$nombre_dueno', '$vacunado')";

if ($conexion->query($sql) === TRUE) {
    echo "Mascota registrada correctamente. <a href='index.php'>Volver</a>";
} else {
    echo "Error: " . $conexion->error;
}
?>
