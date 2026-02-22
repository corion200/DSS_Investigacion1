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
    const productos = <?php echo json_encode($_SESSION['productos']); ?>;
    let carrito = [];
    let total = 0;

    function agregarAlCarrito(id) {

        let producto = productos.find(p => p.id == id);

        if (!producto) return;

        let objCarrito = carrito.find(i => i.id == id);

        if (objCarrito) {
            if (objCarrito.cantidad < producto.stock) {
                objCarrito.cantidad++;
            } else {
                alert("No hay suficiente stock disponible");
            }
        } else {
            carrito.push({
                id: producto.id,
                nombre: producto.nombre,
                precio: producto.precio,
                cantidad: 1
            });
        }

        actualizarCarrito();
    }

    function eliminarDelCarrito(id) {
        carrito = carrito.filter(p => p.id != id);
        actualizarCarrito();
    }

    function actualizarCarrito() {

        const tbody = document.getElementById("carrito-body");
        tbody.innerHTML = "";
        total = 0;

        if (carrito.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center">
                        No hay productos en el carrito
                    </td>
                </tr>
            `;
            document.getElementById("total").textContent = "0.00";
            return;
        }

        carrito.forEach(item => {

            let subtotal = item.precio * item.cantidad;
            total += subtotal;

            tbody.innerHTML += `
                <tr>
                    <td>${item.nombre}</td>
                    <td>${item.cantidad}</td>
                    <td>$${subtotal.toFixed(2)}</td>
                    <td>
                        <button onclick="eliminarDelCarrito('${item.id}')">
                            ❌
                        </button>
                    </td>
                </tr>
            `;
        });

        document.getElementById("total").textContent = total.toFixed(2);
    }

    function procesarVenta() {
        if (carrito.length === 0) {
            alert('No hay productos en el carrito');
            return;
        }

        if (confirm('¿Confirmar venta?')) {

            const boton = document.querySelector(".btn-success");
            boton.disabled = true; // Evita doble click

            fetch('procesar_venta.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(carrito),
                    cache: "no-store" // Evita cache
                })
                .then(response => response.text())
                .then(data => {
                    console.log("RESPUESTA CRUDA:", data);
                    try {
                        const json = JSON.parse(data);

                        if (json.success) {
                            alert("Venta realizada correctamente");
                            carrito = [];
                            actualizarCarrito();
                            window.location.reload();
                        } else {
                            alert("Error al procesar venta");
                        }

                    } catch (e) {
                        console.error("NO ES JSON VÁLIDO:", e);
                        alert("El servidor no devolvió JSON válido. Revisa consola.");
                    }
                })
                .then(data => {
                    if (data.success) {
                        alert("Venta realizada correctamente");

                        carrito = [];
                        actualizarCarrito();

                        // Recarga forzada sin cache
                        window.location.href = window.location.pathname + "?t=" + new Date().getTime();
                    } else {
                        alert("Error al procesar venta");
                        boton.disabled = false;
                    }
                })
                .catch(() => {
                    alert("Error en la conexión");
                    boton.disabled = false;
                });
        }
    }
</script>

<!-- FOOTER -->
</div> <!-- Cierra .container -->

<footer style="background: white; padding: 1rem; text-align: center; margin-top: 2rem; box-shadow: 0 -2px 10px rgba(0,0,0,0.1);">
    <p style="color: #212227; font-weight: 500;">
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