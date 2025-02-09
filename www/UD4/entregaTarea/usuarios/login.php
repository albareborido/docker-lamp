<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once('../vista/menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container pt-3 pb-2 mb-3 border-bottom">
                    <h2>Iniciar sesión</h2>

                    <?php
                    $redirect = isset($_GET['redirect']) ? true : false;
                    $error = isset($_GET['error']) ? true : false;
                    if ($redirect)
                    {
                        echo '<p class="error">Debes iniciar sesión para poder acceder.</p>';
                    }
                    elseif ($error)
                    {
                        echo '<p class="error">Usuario y contraseña incorrectos.</p>';

                    }
                    ?>



                    <form action="loginAuth.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>
