<?php include('./php/conexion.php');
    if(isset($_GET['id'])){
      $resultado = $conexion ->query("SELECT * FROM libros where idlibro = ".$_GET['id'])or die($conexion-> error);
      if(mysqli_num_rows($resultado) > 0){
        $row = mysqli_fetch_row($resultado);
      }else{
        header("Location: ./index.php");
      }
    }else{
      header("Location: ./index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="images/<?php echo $row[6]?>" alt="<?php echo $row[1]?>" class="img-fluid">
          </div>
          <div class="col-lg-6">
            <h2 class="text-center"><?php echo $row[1]?></h2>
            <p class="mb-4"><?php echo $row[2]?></p>
            <p><strong class="text-success h4"><?php echo $row[3]?></strong></p>

            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div>
            <p><a href="cart.php?id=<?php echo $row[0]?>" class="buy-now btn btn-sm btn-primary">Agregar al carrito</a></p>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Libros recomendados</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              <!-- item recomendado -->

              <?php

              $res1 = $conexion -> query("select * from libros where idcategoria = ".$row[7]. " and idlibro != ".$row[0]) or die($conexion->error);

              while($row2 = mysqli_fetch_array($res1)){
              ?>
              <div class="item">
                <div class="block-4 text-center">
                  <figure class="block-4-image">
                    <img src="images/<?php echo $row2[6]?>" alt="<?php echo $row2[6]?>" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="./shop-single.php?id=<?php echo $row2[0]?>"><?php echo $row2[1]?></a></h3>
                    <p class="mb-0"><?php echo $row2[4]?></p>
                    <p class="text-primary font-weight-bold">$<?php echo $row2[3]?></p>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("./layouts/footer.php"); ?> 
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>