<?php
require_once '../equipo/config.php';
require_once '../models/Jugador.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $jugadorId = $_POST['jugador_id'];
    $nombre = $_POST['nombre'];
    $ciudad = $_POST['ciudad'];
    $numero = $_POST['numero'];

    // Obtener el jugador por su ID
    $jugador = Jugador::getById($pdo, $jugadorId);

    if ($jugador) {
        // Actualizar los datos del jugador
        $jugador->setNombre($nombre);
        $jugador->setCiudad($ciudad);
        $jugador->setNumero($numero);
        $jugador->save();
    }

    // Redireccionar a la página de información del equipo
    header('Location: informacion.php?id=' . $jugador->getEquipo());
    exit();
} else {
    // Si se intenta acceder a este archivo directamente sin enviar datos del formulario, redireccionar a la página de inicio
    header('Location: ../equipo/index.php');
    exit();
}
?>