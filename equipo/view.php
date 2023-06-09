<?php
require_once 'config.php';
require_once 'C:\xampp\htdocs\EquiposJugadores\models\Equipo.php';

// Obtener el ID del equipo a mostrar
$id = $_GET['id'];

// Obtener el equipo por su ID
$equipo = Equipo::getById($pdo, $id);

// Incluir la vista de información del equipo
include 'C:\xampp\htdocs\EquiposJugadores\views\header.php';
include 'C:\xampp\htdocs\EquiposJugadores\views\list.php';
include 'C:\xampp\htdocs\EquiposJugadores\views\footer.php';
?>
