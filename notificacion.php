<?php
require 'vendor/autoload.php';
require_once 'credenciales.php';
MercadoPago\SDK::setAccessToken($access_token);

// obtenemos el contenido del request
$notification = file_get_contents('php://input');

    //$dbHandler = new DbHandler();
    
    //$respuesta = $dbHandler->insertNotification($notification);
    
    $dbHandler = DbHandler::getInstancia();
    $respuesta = $dbHandler->insertNotification($notification);
    
    if($respuesta["status"] == 400) http_response_code(400);
    
    // devolvemos una respuesta con estado 200 al cliente
    http_response_code(200);
    
    var_dump(json_encode($respuesta));

if (isset($_POST["type"])) {
    //http_response_code(200);
}

   switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        // Guardar en BD, pago procesado
       if (file_exists("datos.txt")){
        $archivo = fopen("tmp/datos.txt", "a");
        fwrite($archivo, PHP_EOL . $respuesta );
        fclose($archivo);
        }
        else {
        $archivo = fopen("datos.txt", "w");
        fwrite($archivo, PHP_EOL . $respuesta );
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