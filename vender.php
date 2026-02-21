<?php 
require_once "config.php"; //sesion y array de productos
?>

<?php include 'header.php'; ?>

<div class="card">
    <div class="page-header">
        <h2>Registrar Venta</h2>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </div>

    <div class="ventas-grid">
        <!-- Productos Disponibles -->
        <div>
            <h3>Productos Disponibles</h3>
            <div style="margin-top: 1rem;">
                <?php
                if (!empty($_SESSION['productos'])) {
                    foreach ($_SESSION['productos'] as $producto) {
                        // Solo mostrar productos con stock > 0
                        if ($producto['stock'] > 0) {
                            echo "<div class='producto-item' onclick='agregarAlCarrito(\"" . $producto['id'] . "\")'>";
                            echo "<strong>" . $producto['nombre'] . "</strong> - $" . $producto['precio'] . "<br>";
                            
                            // Badge de stock
                            $stockClass = 'badge-success';
                            if ($producto['stock'] < 5) {
                                $stockClass = 'badge-warning';
                            }
                            echo "<small>Stock: <span class='badge $stockClass'>" . $producto['stock'] . "</span></small>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "<p class='text-center'>No hay productos disponibles</p>";
                }
                ?>
            </div>
        </div>

        <!-- Carrito de Venta -->
        <div>
            <h3>Productos en Venta</h3>
            <div id="carrito" style="margin-top: 1rem;">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="carrito-body">
                        <tr>
                            <td colspan="4" class="text-center">No hay productos en el carrito</td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="total-venta">
                    <h3>Total: $<span id="total">0.00</span></h3>
                    <button class="btn btn-success w-100" style="margin-top: 1rem;" onclick="procesarVenta()">
                        Completar Venta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let carrito = [];
let total = 0;

function agregarAlCarrito(id) {
    // Aquí puedes implementar la lógica del carrito
    // Por ahora solo un alert
    alert('Producto ' + id + ' agregado al carrito');
    
    // Ejemplo de cómo podría funcionar:
    // Buscar producto en la sesión (esto sería con AJAX idealmente)
    // Agregar al array carrito
    // Actualizar tabla
}

function procesarVenta() {
    if (carrito.length === 0) {
        alert('No hay productos en el carrito');
        return;
    }
    
    // Aquí enviarías los datos a procesar_venta.php
    // Por ahora solo redirige
    if (confirm('¿Confirmar venta?')) {
        window.location.href = 'procesar_venta.php';
    }
}

function actualizarCarrito() {
    // Función para actualizar la tabla del carrito
    // y calcular totales
}
</script>

<!-- FOOTER -->
    </div> <!-- Cierra .container -->

    <footer style="background: white; padding: 1rem; text-align: center; margin-top: 2rem; box-shadow: 0 -2px 10px rgba(0,0,0,0.1);">
        <p style="color: #667eea; font-weight: 500;">
            &copy; 2026 - Sistema de Gestión de Productos | Desarrollo Aplicaciones Web
        </p>
    </footer>

    <script>
    function toggleMenu() {
        document.querySelector('.nav-links').classList.toggle('show');
    }
    </script>
</body>
</html>