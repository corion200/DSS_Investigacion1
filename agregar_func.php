<?php

require_once "config.php"; // sesión y array de productos


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$error = "";

// ID (solo números)
    if (!preg_match("/^[0-9]+$/", $_POST["id"])) {
        $error = ("El id no ha sido escrito correctamente, solo se permiten números");
        header('Location: agregar.php?error=' . urlencode($error));

    }

    // Nombre (letras y espacios)
    if (!preg_match("/^[a-zA-ZñÑ ]+$/", $_POST["nombre"])) {
        $error = ("El nombre no ha sido escrito correctamente, solo se permiten letras");
        header('Location: agregar.php?error=' . urlencode($error));
        exit();
        }

    // Descripción (mínimo 10 caracteres, permite más cosas)
    if (!preg_match("/^[a-zA-ZñÑ., ]{10,}$/", $_POST["descripcion"])) {
        $error = ("La descripción debe tener mínimo 10 caracteres");
        header('Location: agregar.php?error=' . urlencode($error));
        exit();    
        }

    // Precio (números con opcional decimal)
    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_POST["precio"])) {
        $error = ("El precio no es válido (ej: 10 o 10.50)");
        header('Location: agregar.php?error=' . urlencode($error));
        exit();
        }

    // Stock (números positivos)
    if (!preg_match("/^[0-9]+$/", $_POST["stock"])) {
        $error = ("El stock solo permite números positivos");
        header('Location: agregar.php?error=' . urlencode($error));
        exit();
        }

    // Categoría (solo letras y espacios)
    if (!preg_match("/^[a-zA-ZñÑ ]+$/", $_POST["categoria"])) {
        $error = ("La categoría solo permite letras");
        header('Location: agregar.php?error=' . urlencode($error));
        exit();
    }

    // Inicializar sesión si no existe el array
    if (!isset($_SESSION['productos'])) {
        $_SESSION['productos'] = [];
    }

    $producto = [
        "id" => $_POST["id"],
        "nombre" => $_POST["nombre"],
        "descripcion" => $_POST["descripcion"],
        "precio" => $_POST["precio"],
        "stock" => $_POST["stock"],
        "categoria" => $_POST["categoria"],
    ];

    $_SESSION['productos'][] = $producto;
//redireccionar a index.php con mensaje de éxito
    header('Location: index.php?mensaje=Producto agregado correctamente');
    exit();
   
}

 