<?php
session_start();

include "../php/conexion.php";

if (!isset($_SESSION['datos_login'])) {
    header('Location: ../index.php');
}
$arreglo_usuario = $_SESSION['datos_login'];

$resultado = $conexion->query("select ventas.*, envios.*, usuarios.nombre, usuarios.email, usuarios.telefono from ventas
    inner join usuarios on ventas.iduser  = usuarios.iduser
    inner join envios on ventas.idventa = envios.idventa"
    ) or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda Libros</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="./dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?php
        include "./layouts/header.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Pedidos</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 text-right">
                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <?php
                if (isset($_GET['error'])) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php } ?>

                <?php
                if (isset($_GET['success'])) {
                ?>
                    <div class="alert alert-success" role="alert">
                        Se ha insertado correctamente
                    </div>
                <?php } ?>
                <?php
                $encontrado = false;
                $enviorapido  = "";
                while ($f = mysqli_fetch_array($resultado)) {
                    if($f['nombre'] == $arreglo_usuario['nombre']){
                        $encontrado = true;
                        if($f['tipoenvio'] == 1){
                            $enviorapido = "Entrega inmediata";
                        }else{
                            $enviorapido = "Entrega normal";
                        }
                ?>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="heading<?php echo $f['idventa']; ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['idventa']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $f['idventa']; ?>">
                                        <?php echo $f['fecha'] . '-' . $f['nombre'] . '-' . $f['status']; ?>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse<?php echo $f['idventa']; ?>" class="collapse" aria-labelledby="heading<?php echo $f['idventa']; ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Nombre del cliente: <?php echo $f['nombre'] ?></p>
                                    <p>Email del cliente: <?php echo $f['email'] ?></p>
                                    <p>Telefono del cliente: <?php echo $f['telefono'] ?></p>
                                    <p>Estatus del pedido: <b><?php echo $f['status'] ?></p></b>
                                    <p>Tipo de envio: <b><?php echo $enviorapido ?></p></b>
                                    <p>Lugar actual del envio: <b><?php echo $f['lugaractual'] ?></p></b><br>
                                    <p class="h6">Datos de envio:</p><br>
                                    <?php
                                    $re = $conexion->query("select * from envios where idventa = "
                                        . $f['idventa']) or die($conexion->error);
                                    $fila = mysqli_fetch_row($re)
                                    ?>
                                    <p>Pais: <?php echo $fila[1] ?></p>
                                    <p>Estado: <?php echo $fila[4] ?></p>
                                    <p>Direccion: <?php echo $fila[3] ?></p>
                                    <p>Codigo Postal: <?php echo $fila[5] ?></p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>AUTOR</th>
                                                <th>EDITORIAL</th>
                                                <th>PRECIO</th>
                                                <th>CANTIDAD</th>
                                                <th>SUBTOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $re = $conexion->query("select productos_venta.*, libros.nombre, libros.autor, libros.editorial
                                                from productos_venta inner join libros on productos_venta.idlibro = libros.idlibro
                                                where productos_venta.idventa = ".$f['idventa']) or die($conexion->error);
                                                while ($f2 = mysqli_fetch_array($re)) {
                                                ?>
                                                    <td><?php echo $f2['nombre'] ?></td>
                                                    <td><?php echo $f2['autor'] ?></td>
                                                    <td><?php echo $f2['editorial'] ?></td>
                                                    <td><?php echo $f2['precio'] ?></td>
                                                    <td><?php echo $f2['cantidad'] ?></td>
                                                    <td><?php echo $f2['subtotal'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} if($encontrado == false){echo '<h2>No hay pedidos</h2>';}?>
            </section>
            <!-- /.content -->
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="../php/insertarlibro.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insertar produto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" required>
                                <label for="descripcion">Descripcion</label>
                                <input type="text" name="descripcion" placeholder="descripcion" id="descripcion" class="form-control" required>
                                <label for="precio">Precio</label>
                                <input type="number" min="1" step="0.01" name="precio" placeholder="precio" id="precio" class="form-control" required>
                                <label for="autor">Autor</label>
                                <input type="text" name="autor" placeholder="autor" id="autor" class="form-control" required>
                                <label for="editorial">Editorial</label>
                                <input type="text" name="editorial" placeholder="editorial" id="editorial" class="form-control" required>
                                <label for="imagen">Imagen</label>
                                <input type="file" name="imagen" id="imagen" class="form-control" required>
                                <label for="inventario">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control" required>
                                    <?php
                                    $consult = $conexion->query("select * from categorias") or die($conexion->error);
                                    while ($f = mysqli_fetch_array($consult)) {
                                        echo '<option value = "' . $f['id'] . '">' . $f['tipo'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <label for="inventario">Inventario</label>
                                <input type="number" min="1" name="inventario" placeholder="inventario" id="inventario" class="form-control" required>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="modaleliminarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="../php/insertarlibro.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modaleliminarLabel">Eliminar produto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar este libro? Esto no se puede deshacer!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "./layouts/footer.php";
        ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="./dashboard/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="./dashboard/plugins/moment/moment.min.js"></script>
    <script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dashboard/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dashboard/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./dashboard/dist/js/pages/dashboard.js"></script>

    <script>
        $(document).ready(function() {
            var ideliminar = -1;
            var fila;
            $(".btnEliminar").click(function() {
                ideliminar = ($(this).data('id'));
                fila = $(this).parent('td').parent('tr');
            });
            $(".eliminar").click(function() {
                $.ajax({
                    url: '../php/eliminarLibro.php',
                    method: 'POST',
                    data: {
                        id: ideliminar
                    }

                }).done(function(res) {
                    $(fila).fadeOut(1000);
                });
            });
        });
    </script>

</body>

</html>