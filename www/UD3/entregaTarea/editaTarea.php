<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    try {
        $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE tareas SET titulo = ?, descripcion = ?, estado = ? WHERE id = ?");
        $stmt->execute([$titulo, $descripcion, $estado, $id]);

        echo "Tarea actualizada correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar la tarea: " . $e->getMessage();
    }
}
?>
