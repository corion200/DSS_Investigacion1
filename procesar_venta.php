<!--Resta stock-->
<?php
require_once "config.php"; //sesion y array de productos

ob_clean(); // Limpia cualquier salida previa
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($_SESSION['productos'])) {
    echo json_encode(["success" => false]);
    exit;
}

foreach ($data as $itemCarrito) {
    foreach ($_SESSION['productos'] as &$producto) {
        if ($producto['id'] == $itemCarrito['id']) {

            if ($producto['stock'] >= $itemCarrito['cantidad']) {
                $producto['stock'] -= $itemCarrito['cantidad'];
            } else {
                echo json_encode(["success" => false]);
                exit;
            }
        }
    }
}

echo json_encode(["success" => true]);
exit;