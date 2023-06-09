<?php
require_once '../equipo/config.php';
require_once '../models/Equipo.php';
require_once '../models/Jugador.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Información del Equipo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <h1>Información del Equipo</h1>

    <?php
    // Obtener el ID del equipo desde la URL
    $id = $_GET['id'];

    // Buscar el equipo por su ID
    $equipo = Equipo::getById($pdo, $id);

    if ($equipo) {
        $equipoObj = new Equipo($pdo);
        $equipoObj->setId($equipo['id']);
        $equipoObj->setNombre($equipo['nombre']);
        $equipoObj->setCiudad($equipo['ciudad']);
        $equipoObj->setDeporte($equipo['deporte']);
        $equipoObj->setDescripcion($equipo['descripcion']);
        $equipoObj->setFecha($equipo['fecha']);

        echo "<h2>Nombre: " . $equipoObj->getNombre() . "</h2>";
        echo "<p>Ciudad: " . $equipoObj->getCiudad() . "</p>";
        echo "<p>Deporte: " . $equipoObj->getDeporte() . "</p>";
        echo "<p>Descripcion: " . $equipoObj->getDescripcion() . "</p>";
        echo "<p>Fecha de Creación: " . $equipoObj->getFecha() . "</p>";

        $jugadores = $equipoObj->getJugadores($pdo, $id);
    } else {
        echo "<p>Equipo no encontrado.</p>";
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $ciudad = $_POST['ciudad'];
        $numero = $_POST['numero'];

        // Crear el nuevo equipo
        $j = new Jugador($pdo);
        $j->setNombre($nombre);
        $j->setCiudad($ciudad);
        $j->setNumero($numero);
        $j->setEquipo($id);
        $j->save();

        // Redireccionar a la página de inicio
        header('Location: informacion.php?id=' . $id);
        exit();
    }
    

    ?>

    <h2>Listado de Jugadores</h2>

    <h2>Crear Jugador</h2>
<form id="jugadorForm" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad">

    <label for="numero">Numero:</label>
    <input type="text" name="numero" id="Numero" required>

    <button type="submit">Crear</button>
</form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Numero</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jugadores as $jugador) : ?>
                <tr>
                    <td><?php echo $jugador['id']; ?></td>
                    <td><?php echo $jugador['nombre']; ?></td>
                    <td><?php echo $jugador['ciudad']; ?></td>
                    <td><?php echo $jugador['numero']; ?></td>
                    <td>
                        <a href="../equipo/editar_jugador.php?id=<?php echo $jugador['id']; ?>">Editar</a>
                        <a href="../equipo/eliminar_jugador.php?id=<?php echo $jugador['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este jugador?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../equipo/index.php">Volver</a>

</body>
</html>