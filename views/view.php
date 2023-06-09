<!DOCTYPE html>
<html>
<head>
    <title>Listado de Equipos</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <h1>Listado de Equipos</h1>

    <?php
    // Obtener todos los equipos
    $equipos = Equipo::getAll();

    if (!empty($equipos)) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Ciudad</th>";
        echo "<th>Deporte</th>";
        echo "<th>Fecha de Creación</th>";
        echo "</tr>";

        foreach ($equipos as $equipo) {
            echo "<tr>";
            echo "<td>" . $equipo->getId() . "</td>";
            echo "<td>" . $equipo->getNombre() . "</td>";
            echo "<td>" . $equipo->getCiudad() . "</td>";
            echo "<td>" . $equipo->getDeporte() . "</td>";
            echo "<td>" . $equipo->getFechaCreacion() . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No se encontraron equipos.</p>";
    }
    ?>

    <a href="index.php">Volver</a>
</body>
</html>
