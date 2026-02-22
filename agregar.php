<!--Procesa agregar-->
<?php
require_once "config.php";
$error = ""; //sesion y array de productos
?>

<?php include 'header.php'; ?>

<div class="card">

<?php if ($error): ?>
   <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

    <div class="page-header">
        <h2>Agregar Nuevo Producto</h2>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </div>

    <form method="POST" action="agregar_func.php">
        <div class="form-group">
            <label>ID del Producto:</label>
            <input type="text" name="id" class="form-control" placeholder="Ej: PROD001" required>
        </div>

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción del producto" required></textarea>
        </div>

        <div class="form-group">
            <label>Precio:</label>
            <input type="number" name="precio" step="0.01" min="0.01" class="form-control" placeholder="0.00" required>
        </div>

        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" min="0" class="form-control" placeholder="0" required>
        </div>

        <div class="form-group">
            <label>Categoría:</label>
            <select name="categoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                <option value="Electrónica">Electrónica</option>
                <option value="Accesorios">Accesorios</option>
                <option value="Ropa">Ropa</option>
                <option value="Hogar">Hogar</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <button type="submit" class="btn btn-success">Guardar Producto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

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