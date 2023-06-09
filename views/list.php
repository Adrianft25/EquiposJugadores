<?php
require_once '../equipo/config.php';
require_once '../models/Equipo.php';

$equipo = new Equipo($pdo);
$equipos = $equipo->getAll();

?>

<?php include 'header.php'; ?>

<h2>Listado de Equipos</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Deporte</th>
            <th>Fecha de Fundación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipos as $equipo) : ?>
            <tr>
                <td><?php echo $equipo->getId(); ?></td>
                <td><?php echo $equipo->getNombre(); ?></td>
                <td><?php echo $equipo->getCiudad(); ?></td>
                <td><?php echo $equipo->getDeporte(); ?></td>
                <td><?php echo $equipo->getFecha(); ?></td>
                <td>
                    <a href="view.php?id=<?php echo $equipo->getId(); ?>">Ver</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
