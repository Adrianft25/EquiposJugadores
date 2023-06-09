<?php
require_once 'config.php';
require_once '..\models\Equipo.php';

// Si se envió el formulario de creación de equipo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $ciudad = $_POST['ciudad'];
    $deporte = $_POST['deporte'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    // Crear el nuevo equipo
    $equipo = new Equipo($pdo);
    $equipo->setNombre($nombre);
    $equipo->setCiudad($ciudad);
    $equipo->setDeporte($deporte);
    $equipo->setDescripcion($descripcion);
    $equipo->setFecha($fecha);
    $equipo->save();

    // Redireccionar a la página de inicio
    header('Location: index.php');
    exit();
}

// Incluir la vista de creación de equipo
include '..\views\header.php';
include '..\views\list.php';
include '..\views\footer.php';
?>