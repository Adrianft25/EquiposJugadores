<?php
require_once '../equipo/config.php';
require_once '../models/Equipo.php';

$equipo = new Equipo($pdo);
$equipos = $equipo->getAll($pdo);

?>


<h2>Listado de Equipos</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Deporte</th>
            <th>Descripcion</th>
            <th>Fecha de Fundación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($equipos as $equipo) : ?>
            <tr>
                <td><?php echo $equipo['id']; ?></td>
                <td><?php echo $equipo['nombre']; ?></td>
                <td><?php echo $equipo['ciudad']; ?></td>
                <td><?php echo $equipo['deporte']; ?></td>
                <td><?php echo $equipo['descripcion']; ?></td>
                <td><?php echo $equipo['fecha']; ?></td>
                <td><a href="<?php echo "../views/informacion.php?id=" . $equipo['id']; ?>">Ver</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../views/footer.php'; ?>
