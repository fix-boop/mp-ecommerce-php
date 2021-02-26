<?php
require 'vendor/autoload.php';
require_once 'credenciales.php';

MercadoPago\SDK::setAccessToken($access_token);

if (isset($_POST["type"])) {
    http_response_code(200);
}

   switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["data.id"]);
        // Guardar en BD, pago procesado
        if (file_exists("datos.txt")){
        $archivo = fopen("tmp/datos.txt", "a");
        fwrite($archivo, PHP_EOL . $_POST );
        fclose($archivo);
        }
        else {
        $archivo = fopen("datos.txt", "w");
        fwrite($archivo, PHP_EOL . $_POST );
        fclose($archivo);
        }
        // Enviar mail al comprador, informado resultado


      $para = 'fixboop@gmail.com';
      $titulo = 'WebHook';
      $mensaje = json_encode($payment);
      $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
      $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $cabeceras .= 'From: fixboop.com <no-reply@yolobusko.com>' . "\r\n";

      mail($para, $titulo, $mensaje, $cabeceras);
        break;
    case "plan":
        $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
        break;
    }

?>