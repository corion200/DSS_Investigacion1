<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Productos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo">GestorProductos</a>
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <div class="nav-links">
            <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Inicio</a>
            <a href="agregar.php" class="<?php echo $current_page == 'agregar.php' ? 'active' : ''; ?>">Agregar</a>
            <a href="vender.php" class="<?php echo $current_page == 'vender.php' ? 'active' : ''; ?>">Ventas</a>
        </div>
    </nav>
    
    <div class="container">