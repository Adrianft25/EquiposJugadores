<?php
require_once '../equipo/config.php';
require_once '../models/Equipo.php';
require_once '../models/Jugador.php';

include '../views/header.php';

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
        $capitan = isset($_POST['capitan']) ? 1 : 0;

        // Crear el nuevo jugador
        $j = new Jugador($pdo);
        $j->setNombre($nombre);
        $j->setCiudad($ciudad);
        $j->setNumero($numero);
        $j->setCapitan($capitan);
        $j->setEquipo($id);
        $j->save();

        // Redireccionar a la página de inicio
        header('Location: informacion.php?id=' . $id);
        exit();
    }
    

    ?>

    <h2>Información del Equipo</h2>

    <h3>Listado de Jugadores</h3>

    <div class="formulario">
        <h3>Crear Jugador</h3>

        <form id="jugadorForm" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad" id="ciudad">

            <label for="numero">Numero:</label>
            <input type="number" name="numero" id="Numero" min="1" max="99" required>

            <label for="capitan">Capitan</label>
            <input type="checkbox" name="capitan" id="capitan">

            <button type="submit">Crear</button>
        </form>
    </div>
    

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Numero</th>
                <th>Capitan</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jugadores as $jugador) : ?>
                <tr>
                    <td><?php echo $jugador['id']; ?></td>
                    <td><?php echo $jugador['nombre']; ?></td>
                    <td><?php echo $jugador['ciudad']; ?></td>
                    <td><?php echo $jugador['numero']; ?></td>
                    <td><?php echo $jugador['isCapitan'] ? 'Sí' : 'No'; ?></td>
                    <td>
                        <a href="../views/add_jugador.php?id=<?php echo $jugador['id']; ?>">Editar</a>
                        <a href="../equipo/eliminar_jugador.php?id=<?php echo $jugador['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este jugador?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="btn-volver" href="../equipo/index.php">Volver</a>

<?php include '../views/footer.php'; ?>