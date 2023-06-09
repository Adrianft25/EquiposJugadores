<?php
class Equipo {
    private $pdo;
    private $id;
    private $nombre;
    private $ciudad;
    private $deporte;
    private $descripcion;
    private $fecha;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los equipos
    public static function getAll($pdo) {
        $stmt = $pdo->query('SELECT * FROM equipos');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un equipo por su ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare('SELECT * FROM equipos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar un nuevo equipo en la base de datos
    public function save() {
        $stmt = $this->pdo->prepare('INSERT INTO equipos (id, nombre, ciudad, deporte, descripcion, fecha) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$this->nombre, $this->ciudad, $this->deporte, $this->descripcion, $this->fecha]);
    }

    // Getters y setters

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function getDeporte() {
        return $this->deporte;
    }

    public function setDeporte($deporte) {
        $this->deporte = $deporte;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
}
