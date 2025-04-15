<?php
include("db/conexion.php");

$buscar = $_GET['buscar'];

$query = "SELECT * FROM mascotas WHERE nombre LIKE '%$buscar%' OR id = '$buscar'";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Búsqueda</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<header>
    <h1>Resultado de Búsqueda</h1>
</header>
<main>
    <?php if ($resultado->num_rows > 0): ?>
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
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>
    <br>
    <a href="listar.php">← Volver</a>
</main>
</body>
</html>
