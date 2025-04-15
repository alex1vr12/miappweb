<?php
include("db/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultado = $conexion->query("SELECT * FROM mascotas WHERE id = $id");
    $row = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];
    $nombre_dueno = $_POST['nombre_dueno'];
    $vacunado = $_POST['vacunado'];

    $sql = "UPDATE mascotas SET nombre='$nombre', raza='$raza', edad='$edad', nombre_dueno='$nombre_dueno', vacunado='$vacunado' WHERE id=$id";

    if ($conexion->query($sql)) {
        header("Location: listar.php");
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Mascota</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Modificar Mascota</h1>
</header>
<main>
    <form action="modificar.php" method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $row['nombre'] ?>" required><br>

        <label>Raza:</label>
        <input type="text" name="raza" value="<?= $row['raza'] ?>"><br>

        <label>Edad:</label>
        <input type="number" name="edad" value="<?= $row['edad'] ?>"><br>

        <label>Dueño:</label>
        <input type="text" name="nombre_dueno" value="<?= $row['nombre_dueno'] ?>" required><br>

        <label>Vacunado:</label>
        <select name="vacunado">
            <option value="SI" <?= $row['vacunado'] == 'SI' ? 'selected' : '' ?>>Sí</option>
            <option value="NO" <?= $row['vacunado'] == 'NO' ? 'selected' : '' ?>>No</option>
        </select><br>

        <input type="submit" value="Guardar Cambios">
    </form>
    <br>
    <a href="listar.php">← Cancelar</a>
</main>
</body>
</html>
