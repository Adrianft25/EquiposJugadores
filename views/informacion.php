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
?>

        <div class="card">
            <h2>Información del Equipo</h2>
            <div class="row">
                <span class="label">Nombre</span>
                <div class="value">
                    <span><?php echo $equipoObj->getNombre(); ?></span>
                </div>
            </div>
            <div class="row">
                <span class="label">Ciudad</span>
                <div class="value">
                    <span><?php echo $equipoObj->getCiudad(); ?></span>
                </div>
            </div>
            <div class="row">
                <span class="label">Deporte</span>
                <div class="value">
                    <span><?php echo $equipoObj->getDeporte(); ?></span>
                </div>
            </div>
            <div class="row">
                <span class="label">Descripción</span>
                <div class="value">
                    <span><?php echo $equipoObj->getDescripcion(); ?></span>            
                </div>
            </div>
            <div class="row">
                <span class="label">Fecha de Creación</span>
                <div class="value">
                    <span><?php echo $equipoObj->getFecha(); ?></span>
                </div>
            </div>
        </div>


<?php
        $jugadores = $equipoObj->getJugadores($pdo, $id);
        $capitanes = $equipoObj->getCapitanes($pdo, $id);

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

    <div class="formulario">
        <h2>Crear Jugador</h2>

        <form id="jugadorForm" method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="ciudad">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad">

            <label for="numero">Número</label>
            <input type="number" name="numero" id="Numero" min="1" max="99" required>
            
            <div class="capi">
                <input type="checkbox" name="capitan" id="capitan">
                <label for="capitan">Capitán</label>
            </div>
       
            <button type="submit">Crear</button>
        </form>
    </div>
    
    <?php if (count($jugadores) > 0) { ?>

    <h2>Listado de Jugadores</h2>
    
    <div class="table">
        <div class="thead">
            <div class="tr-6">
                <div class="th">ID</div>
                <div class="th">Nombre</div>
                <div class="th">Ciudad</div>
                <div class="th">Número</div>
                <div class="th">Capitán</div>
                <div class="th">Acciones</div>
            </div>
        </div>
        <div class="tbody">
            <?php foreach ($jugadores as $jugador) : ?>
                <div class="tr-6">
                    <div class="td"><?php echo $jugador['id']; ?></div>
                    <div class="td"><?php echo $jugador['nombre']; ?></div>
                    <div class="td"><?php echo $jugador['ciudad']; ?></div>
                    <div class="td"><?php echo $jugador['numero']; ?></div>
                    <div class="td"><?php echo $jugador['isCapitan'] ? 'Sí' : 'No'; ?></div>
                    <div class="td">
                        <div class="botones">
                            <a class="btn-editar" href="../views/add_jugador.php?id=<?php echo $jugador['id']; ?>">Editar</a>
                            <a class="btn-eliminar" href="../equipo/eliminar_jugador.php?id=<?php echo $jugador['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este jugador?')">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php } 
    
    if (count($capitanes) > 0) {?>
    <h2>Listado de Capitanes</h2>
    <div class="table">
        <div class="thead">
            <div class="tr-4">
                <div class="th">ID</div>
                <div class="th">Nombre</div>
                <div class="th">Ciudad</div>
                <div class="th">Número</div>
            </div>
        </div>
        <div class="tbody">
            <?php foreach ($capitanes as $capitan) : ?>
                <div class="tr-4">
                    <div class="td"><?php echo $capitan['id']; ?></div>
                    <div class="td"><?php echo $capitan['nombre']; ?></div>
                    <div class="td"><?php echo $capitan['ciudad']; ?></div>
                    <div class="td"><?php echo $capitan['numero']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php } ?>

    <a class="btn-volver" href="../equipo/index.php">Volver</a>

<?php include '../views/footer.php'; ?>