<?php

use helpers\Utils;
use models\Producto;
use models\Categoria;
    $usuario = Producto::getById($_GET['id']);
?>

<h1><?=$producto->getNombre()?></h1>

<div class="row">
    <div class="col-md-6">
        <img src="<?=BASE_URL?>assets/images/uploads/productos/<?=$producto->getImagen()?>" alt="<?=$producto->getNombre()?>" class="img-responsive">
    </div>
    <div class="col-md-6">
        <p><strong>Categoría:</strong> <?=Categoria::getById($producto->getCategoriaId())->getNombre()?></p>
        <p><strong>Descripción:</strong> <?=$producto->getDescripcion()?></p>
        <p><strong>Precio:</strong> $<?=$producto->getPrecio()?></p>
    </div>
</div>

<?php if(isset($_SESSION['carrito']) && $_SESSION['carrito'] == 'failed'): ?>

    <div class="alert alert-danger">No se pudo añadir el producto al carrito.</div>
    <?php Utils::deleteSession('carrito'); ?>

<?php endif; ?>

<form method="post" action="<?=BASE_URL?>carrito/add&id=<?=$_GET['id']?>">

    <div class="form-group"></div>

        <label for="unidades">Unidades</label>
        <input type="number" name="unidades" required>

        <?php if(isset($_SESSION['carrito']) && $_SESSION['carrito'] == 'failed_unidades'): ?>

            <small class="error">Las unidades deben ser un número entero.</small>
            <?php Utils::deleteSession('carrito'); ?>

        <?php endif; ?>

    </div>

    <button type="submit" class="btn btn-primary">Añadir al carrito</button>
</form>
<?php Utils::deleteSession('form_data'); ?>
<?php Utils::deleteSession('gestion'); ?>
<?php Utils::deleteSession('carrito'); ?>