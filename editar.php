<?php 

require_once "config.php"; //sesion y array de productos

$id = $_GET['id'] ?? '';
$producto = null;

// Buscar el producto en la sesión
if (!empty($_SESSION['productos'])) {
    foreach ($_SESSION['productos'] as $p) {
        if ($p['id'] == $id) {
            $producto = $p;
            break;
        }
    }
}
 
// Si no encuentra el producto, redirige
if (!$producto) {
    header('Location: index.php');
    exit;
}

$error = $_GET['error'] ?? null;

include 'header.php'; 
?>

<div class="card">
    <div class="page-header">
        <h2>Editar Producto</h2>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </div>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="actualizar1.php">
        <input type="hidden" name="id_original" value="<?php echo $producto['id']; ?>">
        
        <div class="form-group">
            <label>ID del Producto:</label>
            <input type="text" name="id" class="form-control" value="<?php echo $producto['id']; ?>" readonly style="background: #f5f5f5;">
        </div>

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $producto['nombre']; ?>" required>
        </div>

        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3" required><?php echo $producto['descripcion']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Precio:</label>
            <input type="number" name="precio" step="0.01" min="0.01" class="form-control" value="<?php echo $producto['precio']; ?>" required>
        </div>

        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" min="0" class="form-control" value="<?php echo $producto['stock']; ?>" required>
        </div>

        <div class="form-group">
            <label>Categoría:</label>
            <select name="categoria" class="form-control" required>
                <option value="Electrónica" <?php echo $producto['categoria'] == 'Electrónica' ? 'selected' : ''; ?>>Electrónica</option>
                <option value="Accesorios" <?php echo $producto['categoria'] == 'Accesorios' ? 'selected' : ''; ?>>Accesorios</option>
                <option value="Ropa" <?php echo $producto['categoria'] == 'Ropa' ? 'selected' : ''; ?>>Ropa</option>
                <option value="Hogar" <?php echo $producto['categoria'] == 'Hogar' ? 'selected' : ''; ?>>Hogar</option>
            </select>
        </div>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <button type="submit" class="btn btn-warning">Actualizar Producto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>