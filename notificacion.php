<?php
require 'vendor/autoload.php';
require_once 'credenciales.php';

MercadoPago\SDK::setAccessToken($access_token);

//header("HTTP/1.1 200 OK");
    /*header('Content-type: application/json');

   
   $fp = fopen("notification.log","w");
   $json = file_get_contents('php://input');

   // Converts it into a PHP object
   chmod("notification.log", 0777);
   fwrite($fp, $json);
   fclose($fp);
   switch(isset($json["type"])) {
       case "payment":
           $payment = MercadoPago\Payment.find_by_id($json["id"]);
           break;
       case "plan":
           $plan = MercadoPago\Plan.find_by_id($json["id"]);
           break;
       case "subscription":
           $plan = MercadoPago\Subscription.find_by_id($json["id"]);
           break;
       case "invoice":
           $plan = MercadoPago\Invoice.find_by_id($json["id"]);
           break;
   }*/

if (isset($_POST["type"])) {
    http_response_code(200);
}
header('Content-type: application/json');
$json = file_get_contents('php://input');
   switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        // Guardar en BD, pago procesado
        if (file_exists("datos.txt")){
        $archivo = fopen("tmp/datos.txt", "a");
        fwrite($archivo, PHP_EOL . $payment.$json );
        fclose($archivo);
        }
        else {
        $archivo = fopen("datos.txt", "w");
        fwrite($archivo, PHP_EOL . $payment.$json );
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