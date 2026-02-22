<?php

require_once "config.php"; //sesión y array de productos
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if ($error == "" && !preg_match("/^[0-9]+$/", $_POST["id"])) {
        $error = "El id no ha sido escrito correctamente, solo se permiten números";
    }

    if ($error == "" && !preg_match("/^[a-zA-ZñÑ ]+$/", $_POST["nombre"])) {
        $error = "El nombre no ha sido escrito correctamente, solo se permiten letras";
    }

    if ($error == "" && !preg_match("/^[a-zA-ZñÑ ]{10,}$/", $_POST["descripcion"])) {
        $error = "La descripción debe tener mínimo 10 letras";
    }

    if ($error == "" && !preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_POST["precio"])) {
        $error = "El precio no es válido";
    }

    if ($error == "" && !preg_match("/^[0-9]+$/", $_POST["stock"])) {
        $error = "El stock solo permite números positivos";
    }

    if ($error == "") {

        $producto = [
            "id" => $_POST["id"],
            "nombre" => $_POST["nombre"],
            "descripcion" => $_POST["descripcion"],
            "precio" => $_POST["precio"],
            "stock" => $_POST["stock"],
            "categoria" => $_POST["categoria"],
        ];

        $_SESSION['productos'][] = $producto;

        header("Location: agregar.php?error=" . urlencode($error));
exit();
    }
}
?>