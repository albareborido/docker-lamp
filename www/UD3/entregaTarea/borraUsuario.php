<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Borrar las tareas asociadas al usuario
        $stmt = $pdo->prepare("DELETE FROM tareas WHERE id_usuario = ?");
        $stmt->execute([$id]);

        // Borrar el usuario
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        echo "Usuario y sus tareas eliminados correctamente.";
    } catch (PDOException $e) {
        echo "Error al eliminar el usuario: " . $e->getMessage();
    }
} else {
    echo "No se ha proporcionado un ID de usuario.";
}
?>

