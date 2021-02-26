<?php

    $json = file_get_contents('php://input');

    $json_url = json_decode($json);

    $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n\n".date("d/m/Y H:i:s")."JSON_URL: ".print_r( $json_url )) or die("Error escribiendo en el archivo");
    fclose($logFile);

require 'vendor/autoload.php';
require_once 'credenciales.php';

MercadoPago\SDK::setAccessToken($access_token);

if (isset($_POST["type"])) {
    //http_response_code(200);
}

   switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        // Guardar en BD, pago procesado
       /* if (file_exists("datos.txt")){
        $archivo = fopen("tmp/datos.txt", "a");
        fwrite($archivo, PHP_EOL . $payment );
        fclose($archivo);
        }
        else {
        $archivo = fopen("datos.txt", "w");
        fwrite($archivo, PHP_EOL . $payment );
        fclose($archivo);
        }*/
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
    if (isset($payment)) {
        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, "\n".date("d/m/Y H:i:s")."JSON_payment: ".print_r($payment)) or die("Error escribiendo en el archivo");
        fclose($logFile);
    }

?>