<?php

function conectaPDO()
{
    $servername = $_ENV['DATABASE_HOST'];
    $username = $_ENV['DATABASE_USER'];
    $password = $_ENV['DATABASE_PASSWORD'];
    $dbname = $_ENV['DATABASE_NAME'];

    try {
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conPDO;
    } catch (PDOException $ex) {
        return null; // Devuelve null en caso de error
    }
}

// ✅ LISTA USUARIOS
function listaUsuarios()
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos, rol FROM usuarios');
        $stmt->execute();
        return [true, $stmt->fetchAll(PDO::FETCH_ASSOC)];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
}

// ✅ LISTA TAREAS - Ahora usa `bindParam()` para evitar SQL Injection
function listaTareasPDO($id_usuario, $estado = null)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM tareas WHERE id_usuario = :id_usuario';
        
        if (!is_null($estado)) {
            $sql .= " AND estado = :estado";
        }
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        
        if (!is_null($estado)) {
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Reemplazar id_usuario por el username real
        foreach ($tareas as &$tarea) {
            $usuario = buscaUsuario($tarea['id_usuario']);
            $tarea['id_usuario'] = $usuario['username'];
        }

        return [true, $tareas];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
}

// ✅ NUEVO USUARIO - Ahora almacena contraseñas con `password_hash()`
function nuevoUsuario($nombre, $apellidos, $username, $contrasena, $rol = 0)
{
    try {
        $con = conectaPDO();
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT); // Genera un hash seguro

        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, username, contrasena, rol) VALUES (:nombre, :apellidos, :username, :contrasena, :rol)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':contrasena', $contrasenaHash);
        $stmt->bindParam(':rol', $rol);

        $stmt->execute();
        return [true, "Usuario registrado con éxito."];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
}

// ✅ ACTUALIZAR USUARIO - Ahora maneja la contraseña de forma segura
function actualizaUsuario($id, $nombre, $apellidos, $username, $contrasena = null, $rol = null)
{
    try {
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username";

        if (!empty($contrasena)) {
            $sql .= ", contrasena = :contrasena";
        }
        if (!is_null($rol)) {
            $sql .= ", rol = :rol";
        }

        $sql .= " WHERE id = :id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);

        if (!empty($contrasena)) {
            $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
            $stmt->bindParam(':contrasena', $contrasenaHash);
        }
        if (!is_null($rol)) {
            $stmt->bindParam(':rol', $rol);
        }
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return [true, "Usuario actualizado correctamente."];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    }
}

// ✅ BORRAR USUARIO - Ahora usa `bindParam()` y maneja bien la transacción
function borraUsuario($id)
{
    try {
        $con = conectaPDO();
        $con->beginTransaction();

        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $con->commit();
        return [true, "Usuario eliminado correctamente."];
    } catch (PDOException $e) {
        $con->rollBack(); // Si falla, revierte los cambios
        return [false, $e->getMessage()];
    }
}

// ✅ BUSCAR USUARIO - Ahora usa `bindParam()`
function buscaUsuario($id)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    } catch (PDOException $e) {
        return null;
    }
}
