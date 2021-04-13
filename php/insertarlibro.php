<?php
    include "./conexion.php";
    if(isset($_POST['nombre']) and isset($_POST['descripcion']) and isset($_POST['precio'])
    and isset($_POST['editorial']) and isset($_POST['autor']) and isset($_POST['categoria'])
    and isset($_POST['inventario'])){
        $carpeta = "../images/";
        $nombreimg = $_FILES['imagen']['name'];
        $temp = explode('.',$nombreimg);
        $extension = end($temp);
        $nombrefinal = time().'.'.$extension;
        if($extension == "jpg" or $extension == "png"){
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombrefinal)){
                $conexion -> query("insert into libros 
                (nombre,descripcion,precio,autor,editorial,imagen,idcategoria,inventario) values
                (
                    '".$_POST['nombre']."',
                    '".$_POST['descripcion']."',
                    ".$_POST['precio'].",
                    '".$_POST['autor']."',
                    '".$_POST['editorial']."',
                    '$nombrefinal',
                    ".$_POST['categoria'].",
                    ".$_POST['inventario']."
                )") or die($conexion->error);
                header('Location: ../admin/libros.php?success');
            }else{
                header('Location: ../admin/libros.php?error=No se pudo subir el archivo');
            }
        }else{
            header('Location: ../admin/libros.php?error=Tipo de archivo no compatible');
        }
    }else{
        header('Location: ../admin/libros.php?error=Favor de llenar todos los campos');

    }

?>