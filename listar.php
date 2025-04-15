<?php
include("db/conexion.php");

$resultado = $conexion->query("SELECT * FROM mascotas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Mascotas</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Lista de Mascotas Registradas</h1>
</header>
<main>
    <form action="buscar.php" method="GET">
        <input type="text" name="buscar" placeholder="Buscar por nombre o ID" required>
        <input type="submit" value="Buscar">
    </form>

    <table border="1" width="100%" cellpadding="10">
        <tr>
            <th>ID</th><th>Nombre</th><th>Raza</th><th>Edad</th><th>Dueño</th><th>Vacunado</th><th>Acciones</th>
        </tr>
        <?php while($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['raza'] ?></td>
                <td><?= $row['edad'] ?></td>
                <td><?= $row['nombre_dueno'] ?></td>
                <td><?= $row['vacunado'] ?></td>
                <td>
                    <a href="modificar.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="eliminar.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php">← Volver al registro</a>
</main>
</body>
</html>
