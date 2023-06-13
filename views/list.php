<?php
require_once '../equipo/config.php';
require_once '../models/Equipo.php';

$equipo = new Equipo($pdo);
$equipos = $equipo->getAll($pdo);

?>


<h2>Listado de Equipos</h2>

<div class="table">
    <div class="thead">
        <div class="tr-7">
            <div class="th">ID</div>
            <div class="th">Nombre</div>
            <div class="th">Ciudad</div>
            <div class="th">Deporte</div>
            <div class="th">Descripción</div>
            <div class="th">Fecha de Fundación</div>
            <div class="th">Acciones</div>
       </div>
    </div>
    <div class="tbody">
        <?php 
        foreach ($equipos as $equipo) : ?>
            <div class="tr-7">
                <div class="td"><?php echo $equipo['id']; ?></div>
                <div class="td"><?php echo $equipo['nombre']; ?></div>
                <div class="td"><?php echo $equipo['ciudad']; ?></div>
                <div class="td"><?php echo $equipo['deporte']; ?></div>
                <div class="td"><?php echo $equipo['descripcion']; ?></div>
                <div class="td"><?php echo $equipo['fecha']; ?></div>
                <div class="td"><a class="btn-ver" href="<?php echo "../views/informacion.php?id=" . $equipo['id']; ?>">Ver</a></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../views/footer.php'; ?>
