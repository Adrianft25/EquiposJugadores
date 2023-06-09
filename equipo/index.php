<?php
require_once 'config.php';
require_once '..\models\Equipo.php';

// Obtener todos los equipos
$equipos = Equipo::getAll($pdo);

// Incluir las vistas
include '..\views\header.php';
include '..\views\add.php';
include '..\views\list.php';
include '..\views\footer.php';
?>
