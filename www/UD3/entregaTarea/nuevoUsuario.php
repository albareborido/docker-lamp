<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 

    
    if (!isset($_POST['username']) || !isset($_POST['nombre']) || !isset($_POST['apellidos']) || !isset($_POST['contrasena'])) {
        die("Faltan datos en el formulario.");
    }

    // Extraer los datos del formulario
    $username = $_POST['username'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

//COnfiguración de la base de datos
    $servername = "db";  
    $dbusername = "root";  
    $dbpassword = "test";  
    $dbname = "tareas";    

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión a la base de datos exitosa.<br>";  

        $stmt = $conn->prepare("INSERT INTO usuarios (username, nombre, apellidos, contrasena) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $nombre, $apellidos, $contrasena]);

        echo "Usuario creado correctamente.";
    } catch (PDOException $e) {
        echo "Error al crear el usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2>Nuevo Usuario</h2>
                    </div>

                    <div class="container justify-content-between ">
                        
                            <form action="nuevoUsuario.php" method="POST" class="mb-5 w-50"> 
                                <div class="col-md-3">  
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" name="username" required><br>
                                </div>
                                <div class="col-md-3">   
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" name="nombre" required><br>
                                </div>
                                <div class="col-md-3" >  
                                    <label for="apellidos" class="form-label">Apellidos:</label>
                                    <input type="text" name="apellidos" required><br>
                                </div>  
                                <div class="col-md-3">   

                                    <label for="contrasena" class="form-label">Contraseña:</label>
                                    <input type="password" name="contrasena" required><br>
                                </div>
                                <div class="col-md-4">   
                                    <button type="submit" class="btn btn-primary mt-4">Crear Usuario</button>
                                </div>
                            </form>
                        
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>

