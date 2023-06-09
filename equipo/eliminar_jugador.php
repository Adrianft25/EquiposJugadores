<?php
require_once '../equipo/config.php';
require_once '../models/Jugador.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener el ID del jugador desde la URL
    $jugadorId = $_GET['id'];

    // Obtener el jugador por su ID
    $jugador = Jugador::getById($pdo, $jugadorId);

    if ($jugador) {
        // Eliminar el jugador
        //$jugador->deleteById();
        Jugador::deleteById($pdo, $jugadorId);
    }

    // Redireccionar a la página de información del equipo
    header('Location: ../equipo/index.php');
    exit();
} else {
    // Si se intenta acceder a este archivo de otra manera que no sea a través de una solicitud GET, redireccionar a la página de inicio
    header('Location: ../equipo/index.php');
    exit();
}
?>