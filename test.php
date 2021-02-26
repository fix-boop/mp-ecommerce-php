<?php
    require 'vendor/autoload.php';
    require_once 'credenciales.php';
    if (isset($_POST["type"])) {
        http_response_code(200);
    }
    
    MercadoPago\SDK::setAccessToken($access_token);
  $payment = MercadoPago\Payment::find_by_id($_GET['id']);
  echo '<pre>';
  //var_dump($payment);
  var_dump(json_encode($payment));
  echo '</pre>';
?>