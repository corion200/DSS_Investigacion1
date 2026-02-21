<?php include 'header.php'; ?>

<div class="card">
    <div class="page-header">
        <h2>Listado de Productos</h2>
        <a href="agregar.php" class="btn btn-primary">+ Nuevo Producto</a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ===== PARTE DE VALERIA =====
                require_once "config.php";

                if (empty($_SESSION['productos'])) {
                    echo "<tr><td colspan='7' class='text-center'>No hay productos registrados.</td></tr>";
                } else {
                    foreach ($_SESSION['productos'] as $producto) {
                        echo "<tr>";
                        echo "<td>" . $producto['id'] . "</td>";
                        echo "<td>" . $producto['nombre'] . "</td>";
                        echo "<td>" . $producto['descripcion'] . "</td>";
                        echo "<td>$" . $producto['precio'] . "</td>";
                        
                        // Badge de stock según cantidad
                        $stockClass = 'badge-success';
                        if ($producto['stock'] == 0) {
                            $stockClass = 'badge-danger';
                        } elseif ($producto['stock'] < 5) {
                            $stockClass = 'badge-warning';
                        }
                        echo "<td><span class='badge $stockClass'>" . $producto['stock'] . "</span></td>";
                        
                        echo "<td>" . $producto['categoria'] . "</td>";
                        echo "<td>
                                <a href='editar.php?id=" . $producto['id'] . "' class='btn btn-warning'>Editar</a>
                                <button class='btn btn-danger' onclick='confirmarEliminacion(\"" . $producto['id'] . "\")'>Eliminar</button>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmación -->
<div id="modalEliminar" class="modal">
    <div class="modal-content">
        <h3>¿Confirmar eliminación?</h3>
        <p>Esta acción no se puede deshacer</p>
        <div class="modal-buttons">
            <button class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
            <button class="btn btn-danger" onclick="eliminarProducto()">Eliminar</button>
        </div>
    </div>
</div>

<script>
let productoEliminar = '';

function confirmarEliminacion(id) {
    productoEliminar = id;
    document.getElementById('modalEliminar').style.display = 'block';
}

function cerrarModal() {
    document.getElementById('modalEliminar').style.display = 'none';
}

function eliminarProducto() {
    window.location.href = 'eliminar.php?id=' + productoEliminar;
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