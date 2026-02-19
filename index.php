<!--Pagina Principal-->

<?php
require_once "config.php";

echo "Cantidad de productos registrados: " . count($_SESSION['productos']) . "\n\n";

if (empty($_SESSION['productos'])) {
    echo "No hay productos registrados.\n";
} else {

    echo "LISTA DE PRODUCTOS:\n\n";

    foreach ($_SESSION['productos'] as $producto) {

        echo "ID: " . $producto['id'] . "\n";
        echo "Nombre: " . $producto['nombre'] . "\n";
        echo "Descripción: " . $producto['descripcion'] . "\n";
        echo "Precio: $" . $producto['precio'] . "\n";
        echo "Stock: " . $producto['stock'] . "\n";
        echo "Categoría: " . $producto['categoria'] . "\n";

        echo '<a href="editar.php?id=' . $producto['id'] . '">Editar</a> ';
        echo '<a href="eliminar.php?id=' . $producto['id'] . '">Eliminar</a>';

        echo "\n-----------------------------\n";
    }
}

echo "\n";
echo '<a href="agregar.php">Agregar Producto</a>';
?>
