<?php
// Configuración de la base de datos
$servername = "db";  
$dbusername = "root";  
$dbpassword = "test";  
$dbname = "tareas";          

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      

    // Consulta para obtener todos los usuarios
    $stmt = $conn->query("SELECT * FROM usuarios");
    // Recuperación de los resultados como un array asociativo
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!$usuarios) {
        $usuarios = [];  
    }

} catch (PDOException $e) {
    
    echo "Error: " . $e->getMessage();
    $usuarios = [];  
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2>Lista de Usuarios</h2>
                    </div>

                    


                    <div class="table-responsive">
                        
                        <table class="table table-striped table-hover">
                            
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($usuarios) > 0): ?>
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($usuario['id']) ?></td>
                                                <td><?= htmlspecialchars($usuario['username']) ?></td>
                                                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                                <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                                                <td>
                                                    <a href="editaUsuarioForm.php?id=<?= $usuario['id'] ?>">Editar</a>
                                                    <a href="borraUsuario.php?id=<?= $usuario['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta usuario?')">Borrar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No hay usuarios registrados.</td>
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
