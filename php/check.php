<?php
session_start();
include "conexion.php";
if (isset($_POST['email']) and isset($_POST['pass'])) {
    $resultado = $conexion->query("select * from usuarios where email = '" . $_POST['email'] . "' and 
        password = '" . sha1($_POST['pass']) . "' limit 1") or die($conexion->error);
    if (mysqli_num_rows($resultado) > 0) {
        $datos_usuario = mysqli_fetch_row($resultado);
        $iduser = $datos_usuario[0];
        $nombre = $datos_usuario[1];
        $email = $datos_usuario[3];
        $nivel = $datos_usuario[5];
        $_SESSION['datos_login'] = array(
            'nombre' => $nombre,
            'email' => $email,
            'id' => $iduser,
            'nivel' => $nivel
        );
        if ($nivel == "admin") {
            header('Location: ../admin/pedidos.php');
        } else {
            header('Location: ../admin/pedidosuser.php');
        }
    } else {
        header('Location: ../login.php?error=Credenciales incorrectas');
    }
} else {
    header('Location: ./php/login.php');
}
