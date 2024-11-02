<?php
include "utils.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    if (guardarTarea($descripcion, $estado)) {
        $message = "Tarea guardada con éxito.";
    } else {
        $message = "Error: Verifica que todos los campos sean válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2><?php echo $message; ?></h2>
        <a href="nuevaForm.php" class="btn btn-primary">Volver a crear tarea</a>
        <a href="listaTareas.php" class="btn btn-secondary">Ver lista de tareas</a>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>



