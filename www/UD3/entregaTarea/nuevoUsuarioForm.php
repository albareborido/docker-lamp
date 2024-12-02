<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
</head>
<body>
    <h2>Nuevo Usuario</h2>
    <form action="nuevoUsuario.php" method="POST"> 
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <button type="submit">Crear Usuario</button>
    </form>
</body>
</html>
