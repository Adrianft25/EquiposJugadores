<?php
class Jugador {
    private $pdo;
    private $id;
    private $nombre;
    private $ciudad;
    private $numero;
    private $equipo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los jugadores
    public static function getAll($pdo) {
        $stmt = $pdo->query('SELECT * FROM jugadores');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un jugador por su ID
    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare('SELECT * FROM jugadores WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener jugadores por ID de equipo
    public static function getByEquipo($pdo, $equipoId) {
        $stmt = $pdo->prepare('SELECT * FROM jugadores WHERE equipo = ?');
        $stmt->execute([$equipoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Guardar un nuevo jugador en la base de datos
    public function save() {
        if ($this->id) {
            // El jugador ya existe, realizar actualización
            $stmt = $this->pdo->prepare('UPDATE jugadores SET nombre = ?, ciudad = ?, numero = ?, equipo = ? WHERE id = ?');
            $stmt->execute([$this->nombre, $this->ciudad, $this->numero, $this->equipo, $this->id]);
        } else {
            // El jugador es nuevo, realizar inserción
            $stmt = $this->pdo->prepare('INSERT INTO jugadores (nombre, ciudad, numero, equipo) VALUES (?, ?, ?, ?)');
            $stmt->execute([$this->nombre, $this->ciudad, $this->numero, $this->equipo]);
        }
    }

    // Eliminar un jugador de la base de datos por su ID
    public static function deleteById($pdo, $id) {
        $stmt = $pdo->prepare('DELETE FROM jugadores WHERE id = ?');
        $stmt->execute([$id]);
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

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getEquipo() {
        return $this->equipo;
    }

    public function setEquipo($equipo) {
        $this->equipo = $equipo;
    }
}
?>