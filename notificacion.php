<?php
require 'vendor/autoload.php';
require_once 'credenciales.php';
MercadoPago\SDK::setAccessToken($access_token);

// Receive the JSON Post data in form of array
$data = json_decode( file_get_contents( 'php://input' ), true ); 


if (isset($_POST["type"])) {
    //http_response_code(200);
}

   switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        // Guardar en BD, pago procesado
       if (file_exists("datos.txt")){
        $archivo = fopen("tmp/datos.txt", "a");
        fwrite($archivo, PHP_EOL . $data );
        fclose($archivo);
        }
        else {
        $archivo = fopen("datos.txt", "w");
        fwrite($archivo, PHP_EOL . $data );
        fclose($archivo);
        }
        // Enviar mail al comprador, informado resultado
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