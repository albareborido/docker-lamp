<?php

/**MYSQL Orientado a objetos */
//1. Crear la conexión
$conexion = new mysqli('db', 'root', 'test', 'colegio');
//2. Comprobar la conexión
if($conexion->connect_error){
    die("Fallo en la conexión:".$conexion->connect_error);
}

echo "Conexión correcta <br>";
$conexion->close();

/**MYSQL Procedimental */
//1. Crear la conexión
$con = mysqli_connect('db', 'root', 'test', 'colegio');
//2. COmprobar la conexión
if(!$con){
    die("Fallo en la conexión".mysqli_connect_error());
}

echo "Conexión procedimental es correcta<br>";
mysqli_close($con);

/**PDO */
$servername = 'db';
$username = 'root';
$password = 'test';
$dbname = 'colegio';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  //  Forzar excepciones
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'Conexión correcta';
} catch(PDOException $e) {
  echo 'Fallo en conexión: ' . $e->getMessage();
}
//3. Cierre de conexión
$conPDO = null;

?>
