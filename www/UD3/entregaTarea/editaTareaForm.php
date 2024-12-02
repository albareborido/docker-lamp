<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
        $stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ?");
        $stmt->execute([$id]);
        $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al recuperar los datos de la tarea: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
</head>
<body>
    <h2>Editar Tarea</h2>
    <form action="editaTarea.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($tarea['id']) ?>">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($tarea['titulo']) ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" value="<?= htmlspecialchars($tarea['descripcion']) ?>" required><br>

        <label for="estado">Estado:</label>
        <select name="estado" required>
            <option value="Pendiente" <?= $tarea['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="En proceso" <?= $tarea['estado'] == 'En proceso' ? 'selected' : '' ?>>En proceso</option>
            <option value="Completada" <?= $tarea['estado'] == 'Completada' ? 'selected' : '' ?>>Completada</option>
        </select><br>

        <button type="submit">Actualizar Tarea</button>
    </form>
</body>
</html>
