
<?php


require_once '../equipo/config.php';
require_once '../models/Equipo.php';
require_once '../models/Jugador.php';

    // Obtener el ID del equipo desde la URL
    $id = $_GET['id'];

    // Buscar el equipo por su ID
    $jugador = Jugador::getById($pdo, $id);

    if ($jugador) {
        $jugadorObj = new Jugador($pdo);
        $jugadorObj->setId($jugador['id']);
        $jugadorObj->setNombre($jugador['nombre']);
        $jugadorObj->setCiudad($jugador['ciudad']);
        $jugadorObj->setNumero($jugador['numero']);
        $jugadorObj->setEquipo($jugador['equipo']);

        echo "<h2>Nombre: " . $jugadorObj->getNombre() . "</h2>";
        echo "<p>Ciudad: " . $jugadorObj->getCiudad() . "</p>";
        echo "<p>Numero: " . $jugadorObj->getNumero() . "</p>"; 
        echo "<p>Equipo: " . $jugadorObj->getEquipo() . "</p>";

    } else {
        echo "<p>Equipo no encontrado.</p>";
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $ciudad = $_POST['ciudad'];
        $numero = $_POST['numero'];
        $equipo = $_POST['equipo'];

        // Crear el nuevo equipo
        $j = new Jugador($pdo);
        $j->setId($id);
        $j->setNombre($nombre);
        $j->setCiudad($ciudad);
        $j->setNumero($numero);

        $j->update($nombre, $ciudad, $numero);

        // Redireccionar a la página de inicio
        header('Location: ../views/informacion.php?id=' . $equipo);
        exit();
    }
    

    ?>

<h2>Editar Jugador</h2>
<form id="jugadorForm" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $jugadorObj->getNombre(); ?>" required>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad"  value="<?php echo $jugadorObj->getCiudad(); ?>">

    <label for="numero">Numero:</label>
    <input type="number" name="numero" id="Numero"  value="<?php echo $jugadorObj->getNumero(); ?>" required>

    <input type="hidden" name="equipo" id="equipo"  value="<?php echo $jugadorObj->getEquipo(); ?>">

    <button type="submit">Editar</button>
</form>

