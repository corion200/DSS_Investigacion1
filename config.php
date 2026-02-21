<!--Aquí tenemos la sesión se llama en todo los archivos--->

<?php
// Iniciar sesión para almacenar los productos en la sesión
// Pero solo si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Crear array de productos si no existe
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

?>