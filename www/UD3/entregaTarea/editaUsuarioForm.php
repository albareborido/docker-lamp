<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al recuperar los datos: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="editaUsuario.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($usuario['username']) ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <button type="submit">Actualizar Usuario</button>
    </form>
</body>
</html>
