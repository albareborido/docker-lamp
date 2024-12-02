<form action="tareas.php" method="GET">
    <label for="usuario">Usuario:</label>
    <input type="text" name="usuario" required><br>

    <label for="estado">Estado:</label>
    <select name="estado">
        <option value="">Todos</option>
        <option value="Pendiente">Pendiente</option>
        <option value="En proceso">En proceso</option>
        <option value="Completada">Completada</option>
    </select><br>

    <button type="submit">Buscar</button>
</form>
