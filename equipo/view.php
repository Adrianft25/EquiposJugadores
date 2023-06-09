<?php
require_once 'config.php';
require_once '..\models\Equipo.php';

// Obtener el ID del equipo a mostrar
$id = $_GET['id'];

// Obtener el equipo por su ID
$equipo = Equipo::getById($pdo, $id);

// Incluir la vista de información del equipo
include '..\views\header.php';
include '..\views\list.php';
include '..\views\footer.php';
?>
