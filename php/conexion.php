
<?php
    $servidor = "localhost";
    $usuario = "root";
    $pass = "";
    $bd = "tienda_libros";

    $conexion = new mysqli($servidor,$usuario,$pass,$bd);

    try {
        $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //connection successful
        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }

    if($conexion -> connect_error){
        die("No se puede conectar al servidor");
    }
?>
