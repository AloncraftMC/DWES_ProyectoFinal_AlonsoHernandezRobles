<?php
    use helpers\Utils;
    use models\Producto;
?>

<!-- Si productos = 0, mostramos Carrito Vacío
 Si productos = 1, mostramos (1 producto)
 Si productos > 0, mostramos (x productos)"

 Todo esto respecto al siguiente h1
-->

<h1>Carrito <?php if (Utils::statsCarrito()['count'] == 0): ?>Vacío<?php elseif (Utils::statsCarrito()['count'] == 1): ?>(1 producto)<?php else: ?>(<?= Utils::statsCarrito()['count'] ?> productos)<?php endif; ?></h1>

<?php if (!isset($_SESSION['carrito']) || Utils::statsCarrito()['count'] == 0): ?>

    <h3>No hay productos en el carrito.</h3>

    <a href="<?= BASE_URL ?>" class="boton">
        <button class="boton">Empieza a comprar</button>
    </a>

<?php else: ?>

    <a href="<?=BASE_URL?>carrito/clear">
        <button class="boton more-margin btn-del">
            Vaciar carrito
        </button>
    </a>

    <table class="tabla-carrito">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalCarrito = 0;
            foreach ($_SESSION['carrito'] as $indice => $producto):
                $prod = Producto::getById($producto['id_producto']); // Obtiene la información del producto
                $precioTotal = $prod->getPrecio() * (1 - $prod->getOferta() / 100) * $producto['unidades'];
                $totalCarrito += $precioTotal;
            ?>
                <tr>
                    <td>
                        <?php if ($prod->getImagen() != null): ?>
                            <a href="<?= BASE_URL ?>producto/ver&id=<?= $prod->getId() ?>"><img src="<?= BASE_URL ?>assets/images/uploads/productos/<?= $prod->getImagen() ?>" alt="<?= $prod->getNombre() ?>"></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>producto/ver&id=<?= $prod->getId() ?>" class="enlace-producto"><?= $prod->getNombre() ?></a>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>carrito/down&index=<?= $indice ?>" class="boton boton-carrito boton-down">-</a>
                        <h3 style="display: inline"><?= $producto['unidades'] ?></h3>
                        <a href="<?= BASE_URL ?>carrito/up&index=<?= $indice ?>" class="boton boton-carrito boton-up">+</a>

                    </td>
                    <td>
                        <?php if ($prod->getOferta() > 0): ?>
                            <span style="color: red; text-decoration: line-through; font-size: 80%;"><?= $prod->getPrecio() ?> €</span>
                            <br>
                            <span style="color: rgb(0, 0, 0); font-weight: bold;"><?= round($prod->getPrecio() * (1 - $prod->getOferta() / 100), 2) ?> €</span>
                            <br>
                            <span style="font-size: 80%; opacity: 0.5">(-<?= $prod->getOferta() ?>%)</span>
                        <?php else: ?>
                            <span style="color: rgb(0, 0, 0); font-weight: bold;"><?= $prod->getPrecio() ?> €</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $precioTotal ?> €</td>
                    <td class="acciones-especial">
                        <a href="<?= BASE_URL ?>carrito/delete&index=<?= $indice ?>" class="boton btn-delete">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="resumen-carrito" style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 20px;">
        <h2 style="color: green"><span style="color: black; font-weight: normal;">Total:</span> <?= $totalCarrito ?> €</h2>

        <!-- Botón para proceder a la compra -->
        <a href="<?= BASE_URL ?>pedido/crear">
            <button class="boton">Hacer pedido</button>
        </a>
    </div>

<?php endif; ?>

<?php if(isset($_SESSION['carritoResultado']) && $_SESSION['carritoResultado'] == 'failed_stock'): ?>

    <strong class="red">No tenemos el stock solicitado para este producto.</strong>

<?php endif; ?>

<?php Utils::deleteSession('carritoResultado'); ?>