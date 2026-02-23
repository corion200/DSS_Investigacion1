<!--Eliminta Producto-->
<?php
require_once "config.php"; //sesion y array de productos

    $id = $_GET['id'] ?? '';

    if (!isset($_SESSION['productos'])) {
        header('Location: index.php');
        exit();
    }

    foreach ($_SESSION['productos'] as $index => $p) {
        if ($p['id'] == $id) {
            unset($_SESSION['productos'][$index]);
            break;
        }
    }

    header('Location: index.php');
    exit();




?>