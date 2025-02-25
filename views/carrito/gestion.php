<h1>Carrito (<?=(isset($_SESSION['carrito'])) ? count($_SESSION['carrito']) : 0?> productos)</h1>

<!-- Si no hay productos en el carrito -->

<?php use helpers\Utils;

if(!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0): ?>

    <h3>No hay productos en el carrito.</h3>

    <!-- Botón para volver a la tienda -->

    <a href="<?=BASE_URL?>" class="boton">
        <button class="boton">Empieza a comprar</button>
    </a>

<?php else: ?>

    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php
        foreach($_SESSION['carrito'] as $indice => $elemento):
            $producto = $elemento['producto'];
            ?>
            <tr>
                <td>
                    <?php if($producto->imagen != null): ?>
                        <img src="<?=BASE_URL?>uploads/images/<?=$producto->imagen?>" class="img_carrito" />
                    <?php else: ?>
                        <img src="<?=BASE_URL?>assets/img/camiseta.png" class="img_carrito" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?=BASE_URL?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
                </td>
                <td>
                    <?=$producto->precio?>
                </td>
                <td>
                    <?=$elemento['unidades']?>
                    <div class="updown-unidades">
                        <a href="<?=BASE_URL?>carrito/up&index=<?=$indice?>" class="button">+</a>
                        <a href="<?=BASE_URL?>carrito/down&index=<?=$indice?>" class="button">-</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br/>
    <div class="delete-carrito">
        <a href="<?=BASE_URL?>carrito/delete_all" class="button button-delete button-red">Vaciar carrito</a>
    </div>

    <div class="total-carrito">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3>Precio total: <?=$stats['total']?> $</h3>
        <a href="<?=BASE_URL?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
    </div>

<?php endif; ?>