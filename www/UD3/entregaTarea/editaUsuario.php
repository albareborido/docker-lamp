<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    try {
        $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE usuarios SET username = ?, nombre = ?, apellidos = ?, contrasena = ? WHERE id = ?");
        $stmt->execute([$username, $nombre, $apellidos, $contrasena, $id]);

        echo "Usuario actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
}
?>
