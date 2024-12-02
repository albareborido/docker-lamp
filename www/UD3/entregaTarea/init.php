<?php

try {
    // Crear conexión a MySQL (sin especificar la base de datos)
    $conn = new mysqli('db', 'root', 'test');
    echo "Conexión correcta.<br>";

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        echo "Conexión fallida: " . $conn->connect_error;
    }
    echo "Conexión exitosa al servidor de base de datos.<br>";

    // Intentar crear la base de datos si no existe
    $sql = "CREATE DATABASE IF NOT EXISTS tareas";
    if ($conn->query($sql) === TRUE) {
        echo "Base de datos creada.<br>";
    } else {
        echo "Error al crear la base de datos: " . $conn->error;
    }

    // Cambiar a la base de datos 'tareas'
    if (!$conn->select_db('tareas')) {
        throw new Exception("Error al seleccionar la base de datos 'tareas': " . $conn->error);
    }

    // Crear la tabla 'usuarios' si no existe
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        nombre VARCHAR(50),
        apellidos VARCHAR(100),
        contrasena VARCHAR(100) NOT NULL
    )";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada o ya existe.<br>";
} else {
    // Mostrar error más detallado
    echo "Error al crear la tabla 'usuarios': " . $conn->error . "<br>";
}

    // Crear la tabla 'tareas' si no existe
    $sql = "CREATE TABLE IF NOT EXISTS tareas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        descripcion VARCHAR(250),
        estado VARCHAR(50),
        id_usuario INT,
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Tabla 'tareas' creada o ya existe.<br>";
    } else {
        throw new Exception("Error al crear la tabla 'tareas': " . $conn->error);
    }

    // Cerrar la conexión
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
