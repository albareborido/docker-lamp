<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tema'])) {
    $tema = $_POST['tema'];

    // Crear la cookie con duración de 30 días
    setcookie('tema', $tema, time() + (3600 * 24 * 30), '/'); 

    // Redirigir a la página anterior después de aplicar el tema
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

