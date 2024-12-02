<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Borrar la tarea
        $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ?");
        $stmt->execute([$id]);

        echo "Tarea eliminada correctamente.";
    } catch (PDOException $e) {
        echo "Error al eliminar la tarea: " . $e->getMessage();
    }
} else {
    echo "No se ha proporcionado un ID de tarea.";
}
?>
