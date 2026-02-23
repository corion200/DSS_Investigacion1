<?php
require_once "config.php"; //sesion y array de productos

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ID (solo números)
    if (!preg_match("/^[0-9]+$/", $_POST["id"])) {
        $error = "El id no ha sido escrito correctamente, solo se permiten números";
        header('Location: editar.php?id=' . $_POST['id_original'] . '&error=' . urlencode($error));
        exit();
    }

    // Nombre (letras y espacios)
    if (!preg_match("/^[a-zA-ZñÑ ]+$/", $_POST["nombre"])) {
        $error = "El nombre no ha sido escrito correctamente, solo se permiten letras";
        header('Location: editar.php?id=' . $_POST['id_original'] . '&error=' . urlencode($error));
        exit();
    }

    // Precio
    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_POST["precio"])) {
        $error = "El precio no es válido (ej: 10 o 10.50)";
        header('Location: editar.php?id=' . $_POST['id_original'] . '&error=' . urlencode($error));
        exit();
    }

    // Stock
    if (!preg_match("/^[0-9]+$/", $_POST["stock"])) {
        $error = "El stock solo permite números positivos";
        header('Location: editar.php?id=' . $_POST['id_original'] . '&error=' . urlencode($error));
        exit();
    }

    // Categoría
    if (!preg_match("/^[a-zA-ZñÑ ]+$/", $_POST["categoria"])) {
        $error = "La categoría solo permite letras";
        header('Location: editar.php?id=' . $_POST['id_original'] . '&error=' . urlencode($error));
        exit();
    }

    // Actualizar producto en sesión
    $idOriginal = $_POST['id_original'];

    foreach ($_SESSION['productos'] as &$p) {
        if ($p['id'] == $idOriginal) {

            $p['id'] = $_POST['id'];
            $p['nombre'] = $_POST['nombre'];
            $p['descripcion'] = $_POST['descripcion'];
            $p['precio'] = $_POST['precio'];
            $p['stock'] = $_POST['stock'];
            $p['categoria'] = $_POST['categoria'];

            break;
        }
    }

    unset($p);

    header("Location: index.php");
    exit;
}
?>