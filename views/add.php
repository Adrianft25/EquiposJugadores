
<h2>Crear Equipo</h2>
<form id="equipoForm" method="POST" action="add.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad">

    <label for="deporte">Deporte:</label>
    <select name="deporte" id="deporte">
        <option value="Fútbol">Fútbol</option>
        <option value="Baloncesto">Baloncesto</option>
        <option value="Tenis">Tenis</option>
    </select>

    <label for="descripcion">Descripcion:</label>
    <input type="text" name="descripcion" id="descripcion">

    <label for="fecha">Fecha de fundación:</label>
    <input type="date" name="fecha" id="fecha" required>

    <button type="submit">Crear</button>
</form>
