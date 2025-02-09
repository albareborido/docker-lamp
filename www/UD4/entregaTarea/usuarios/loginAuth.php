<?php
session_start();

function conecta()
{
    $servername = $_ENV['DATABASE_HOST'];
    $username = $_ENV['DATABASE_USER'];
    $password = $_ENV['DATABASE_PASSWORD'];
    $dbname = $_ENV['DATABASE_NAME'];

    try {
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conPDO;
    } catch (PDOException $ex) {
        return $ex->getMessage();
    }
}

function comprobarUsuario($username, $contrasena, $conPDO)
{
    $consulta = "SELECT username, contrasena FROM usuarios WHERE username=:username";
    $stmt = $conPDO->prepare($consulta);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($contrasena, $user['contrasena'])) {
        return $user['username'];
    } else {
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["usuario"];
    $contrasena = $_POST["pass"];

    if (empty($username) || empty($contrasena)) {
        header('Location: login.php?error=true&message=Debe cubrir los datos solicitados.');
        exit();
    }

    $conPDO = conecta();
    if (is_string($conPDO)) {
        header('Location: login.php?error=true&message=' . $conPDO);
        exit();
    }

    $user = comprobarUsuario($username, $contrasena, $conPDO);

    if (!$user) {
        header('Location: login.php?error=true&message=Usuario o contraseña incorrectos');
        exit();
    } else {
        $_SESSION['username'] = $user;
        header('Location: index.php'); 
        exit();
    }
}
?>
