<!--Aquie tenemos la sesión se llama en todo los archivos--->

<?php
//Iniciar sesión para almacenar los productos en la sesión
session_start();

// Crear array de productos si no existe
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

?>