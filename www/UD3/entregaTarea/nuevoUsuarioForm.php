<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('header.php'); ?>
    
    <div class="container justify-content-between mb-3">
   
                    
        <form action="nuevoUsuario.php" method="POST" class="mb-5 w-50"> 
            <div class="col-md-3">  
                <label for="username" class="form-label">Username</label>
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

    <?php include_once('footer.php'); ?>

</body>
</html>
