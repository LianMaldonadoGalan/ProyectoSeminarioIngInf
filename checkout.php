<?php
session_start();
if (!isset($_SESSION['carrito'])) {
  header('Location:./index.php');
}
$arreglo = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Comprar &mdash; Tienda de Libros</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <script src="https://www.paypal.com/sdk/js?client-id=AfneNdme1FtogeRtDSDgTv5fuTUing6Kcmac_T1j-skm56QyzDOaC2geW03sWkQqdXhNeZXnS589nN_s&currency=MXN">
    // Replace YOUR_CLIENT_ID with your sandbox client ID
  </script>

  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?>
    <form action="./php/insertarpedido.php" method="POST">
      <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Detalles de compra</h2>
              <div class="p-3 p-lg-5 border">
                <div class="form-group">
                  <label for="c_country" class="text-black">Pais <span class="text-danger">*</span></label>
                  <select id="c_country" class="form-control" name="c_country">
                    <option value="Nospecified">Seleccione pais</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Algeria">Algeria</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Albania">Albania</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Peru">Peru</option>
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                    <option value="Brasil">Brasil</option>
                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="c_fname" required>
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Apellidos <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="c_lname" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_companyname" class="text-black">Compania</label>
                    <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_address" class="text-black">Direccion <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Calles" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_state_country" class="text-black">Estado <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_state_country" name="c_state_country" required>
                  </div>

                  <div class="col-md-6">
                    <label for="c_postal_zip" class="text-black">Codigo Postal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" required>
                  </div>
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-6">
                    <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_email_address" name="c_email_address" required>
                  </div>
                  <div class="col-md-6">
                    <label for="c_phone" class="text-black">Telefono <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_phone" name="c_phone" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_entregarapida" class="text-black">
                    <input type="checkbox" value = "1" id="c_entregarapida" name = "c_entregarapida"> Entrega inmediata + ($100 MXN)</label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Crear cuenta?</label>
                  <div class="collapse" id="create_an_account">
                    <div class="py-2">
                      <p class="mb-3">Crear una cuenta llenado el formulario debajo, si ya tiene una cuenta por favor ingresar en la parte superior</p>
                      <div class="form-group">
                        <label for="c_account_password" class="text-black"></label>
                        <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                <label for="c_entregarapida" class="text-black">
                
                </div>

                <div class="form-group">
                  <label for="c_order_notes" class="text-black">Notas de la orden</label>
                  <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Notas..."></textarea>
                </div>

              </div>
            </div>
            <div class="col-md-6">

              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Cupón</h2>
                  <div class="p-3 p-lg-5 border">

                    <label for="c_code" class="text-black mb-3">Ingresa el cupón</label>
                    <div class="input-group w-75">
                      <input type="text" class="form-control" id="c_code" placeholder="Cupón" aria-label="Coupon Code" aria-describedby="button-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Canejar</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Tu orden</h2>
                  <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Productos</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                        <div id="datoscarro">
                          <?php
                          $total = 0;
                          for ($i = 0; $i < count($arreglo); $i++) {
                            $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);

                          ?>
                            <tr>
                              <td><?php echo $arreglo[$i]['Nombre'] ?> <strong class="mx-2">x</strong><?php echo $arreglo[$i]['Cantidad'] ?> </td>
                              <td>$<?php echo ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']) ?></td>
                            </tr>

                          <?php
                          }
                          ?>
                          <tr>
                            <td class="text-black font-weight-bold"><strong>Subtotal del carro</strong></td>
                            <td class="text-black">$<?php echo $total; ?></td>
                          </tr>
                          <tr>
                            <td class="text-black font-weight-bold"><strong>Orden Total</strong></td>
                            <td class="text-black font-weight-bold"><strong>$<?php echo $total; ?></strong></td>
                          </tr>
                        </div>
                      </tbody>
                    </table>

                    <!--  Pagos
                    <div class="border p-3 mb-3">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Pago con tarjeta</a></h3>

                        
                      <div class="collapse" id="collapsebank">
                      
                        <div class="py-2">
                          <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                        </div>
                      </div>
                    </div>

                    <div class="border p-3 mb-3">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Pago mediante cheque</a></h3>

                      <div class="collapse" id="collapsecheque">
                        <div class="py-2">
                          <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                        </div>
                      </div>
                    </div>-->

                    <div class="border p-3 mb-5">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                      <div class="collapse" id="collapsepaypal">
                        <div class="py-2">
                          <p class="mb-0">Ingresa tus datos para proceder con el pago:</p>
                        </div>
                        <div id="paypal-button-container" require_once></div>
                      </div>
                    </div>


                    <div class="form-group">
                      <button class="btn btn-primary btn-lg py-3" type="submit" id="completapago">Finalizar compra</button>
                    </div>

                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>
    </form>
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

 

  <script>
    
    var checkBox = document.getElementById("c_entregarapida");

    if (checkBox.checked == true) {
       <?php $total = $total + 100 ?>
      }

    var  montofinal = <?php echo $total; ?>;

    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: montofinal
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Transaction completed by ' + details.payer.name.given_name);
        });
      }
    }).render('#paypal-button-container'); // Display payment options on your web page
  </script>

</body>

</html>