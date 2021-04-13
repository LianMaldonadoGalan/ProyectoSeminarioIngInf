<?php
session_start();
include('./conexion.php');
if (!isset($_SESSION['carrito'])) {
  header('Location:../index.php');
}
$enviorapido = $_POST['c_entregarapida'];
$total = 0;

if($enviorapido != 1){
  $enviorapido = 0;
}

$arreglo = $_SESSION['carrito'];

for ($i = 0; $i < count($arreglo); $i++) {
  $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}
$password = "";

if (isset($_POST['c_account_password'])) {
  if ($_POST['c_account_password'] != "") {
    $password = $_POST['c_account_password'];
  }
}

$conexion->query("insert into usuarios (nombre,telefono,email,password,level) 
                      values ('" . $_POST['c_fname'] . " " . $_POST['c_lname'] ."',
                      '" . $_POST['c_phone'] . "',
                      '" . $_POST['c_email_address'] . "',
                      '" . sha1($password) . "',
                      'usuario'
                      )") or die($conexion->error);

$idusuario = $conexion->insert_id;

$fecha = date('Y-m-d');

$conexion->query("insert into ventas (iduser, total, fecha) values ($idusuario,$total,'$fecha')") or die($conexion->error);
$idven = $conexion->insert_id;
for ($i = 0; $i < count($arreglo); $i++) {
  $conexion->query("insert into productos_venta (idventa, idlibro, cantidad, precio, subtotal) 
    values ($idven," . $arreglo[$i]['Id'] . "," . $arreglo[$i]['Cantidad'] . "," . $arreglo[$i]['Precio'] . ",
    " . $arreglo[$i]['Cantidad'] * $arreglo[$i]['Precio'] . ")") or die($conexion->error);

  $conexion->query("update libros set inventario = inventario - ".$arreglo[$i]['Cantidad']." where idlibro =  ".$arreglo[$i]['Id']."")or die($conexion->error);
}


$conexion->query("insert into envios (pais,company,direccion,estado,cp,idventa,tipoenvio) 
  values ( '" . $_POST['c_country'] . "',
           '" . $_POST['c_companyname'] . "',
           '" . $_POST['c_address'] . "',
           '" . $_POST['c_state_country'] . "',
           '" . $_POST['c_postal_zip'] . "',
           $idven,
           $enviorapido
          )
          ") or die($conexion->error);

unset($_SESSION['carrito']);
header('Location: ../thankyou.php');
?>