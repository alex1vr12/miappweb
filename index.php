<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Mascotas</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Veterinaria El Buen Amigo</h1>
    </header>

    <main>
        <form action="registrar.php" method="POST">
            <h2>Registrar Mascota</h2>
            <label>Nombre Mascota:</label>
            <input type="text" name="nombre" required><br>

            <label>Raza:</label>
            <input type="text" name="raza"><br>

            <label>Edad:</label>
            <input type="number" name="edad" min="0"><br>

            <label>Nombre del Dueño:</label>
            <input type="text" name="nombre_dueno" required><br>

            <label>Vacunado:</label>
            <select name="vacunado">
                <option value="SI">Sí</option>
                <option value="NO">No</option>
            </select><br>

            <input type="submit" value="Registrar">
        </form>

        <div class="acciones">
            <a href="listar.php">Ver Mascotas</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Veterinaria El Buen Amigo</p>
    </footer>
</body>
</html>
