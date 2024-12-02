<?php
// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=db;dbname=tareas', 'root', 'test');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Variables de filtrado
    $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
    $estado = isset($_GET['estado']) ? $_GET['estado'] : '';

    // Filtrado de tareas
    $filters = [];
    $query = "SELECT tareas.id, tareas.titulo, tareas.descripcion, tareas.estado, usuarios.username
              FROM tareas
              INNER JOIN usuarios ON tareas.id_usuario = usuarios.id WHERE 1=1";

    // Si se pasa un usuario, filtrar por el nombre de usuario
    if ($usuario) {
        $query .= " AND usuarios.username LIKE :usuario";
        $filters['usuario'] = "%$usuario%";
    }

    // Si se pasa un estado, filtrar por el estado de la tarea
    if ($estado) {
        $query .= " AND tareas.estado = :estado";
        $filters['estado'] = $estado;
    }

    // Ejecutar la consulta
    $stmt = $pdo->prepare($query);
    $stmt->execute($filters);
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
} catch (PDOException $e) {
    echo "Error al recuperar las tareas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php'); ?>    
    
    
    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>
                        
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Lista de Tareas</h2>
                </div>
                
                
                <div class="container justify-content-between mb-3">
                    <form action="tareas.php" method="GET" class="row">
                        <div class="col-md-4">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" class="form-control" value="<?= htmlspecialchars($usuario ?? '') ?>" placeholder="Buscar por usuario">
                        </div>
                        <div class="col-md-4">
                            <label for="estado">Estado:</label>
                            <select name="estado" class="form-control">
                                <option value="">Todos</option>
                                <option value="Pendiente" <?= $estado == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="En proceso" <?= $estado == 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                                <option value="Completada" <?= $estado == 'Completada' ? 'selected' : '' ?>>Completada</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary mt-4">Buscar</button>
                        </div>
                    </form>
                </div>

                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tareas) > 0): ?>
                                <?php foreach ($tareas as $tarea): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($tarea['id']) ?></td>
                                        <td><?= htmlspecialchars($tarea['titulo']) ?></td>
                                        <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                                        <td><?= htmlspecialchars($tarea['estado']) ?></td>
                                        <td><?= htmlspecialchars($tarea['username']) ?></td>
                                        <td>
                                            <a href="editaTareaForm.php?id=<?= $tarea['id'] ?>" class="btn btn-primary">Editar</a>
                                            <a href="borraTarea.php?id=<?= $tarea['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">Borrar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No se encontraron tareas con los filtros aplicados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>


