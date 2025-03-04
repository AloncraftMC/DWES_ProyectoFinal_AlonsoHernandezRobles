<?php
    use helpers\Utils;
    use models\Producto;
    use models\Categoria;
    $producto = Producto::getById($_GET['id']);
?>

<div class="container">
    
    <img src="<?=BASE_URL?>assets/images/uploads/productos/<?=$producto->getImagen()?>" alt="<?=$producto->getNombre()?>">

    <script>

        document.addEventListener("DOMContentLoaded", () => {

            document.querySelectorAll("img").forEach(img => {
                
                if (img.complete) {
                    applyStyles(img);
                } else {
                    img.onload = () => applyStyles(img);
                }

            });

            function applyStyles(img) {
                let aspectRatio = img.naturalWidth / img.naturalHeight;
                console.log("Aspect Ratio:", aspectRatio);

                if (aspectRatio > 2) {
                    
                    img.style.minHeight = "unset";
                    img.style.maxHeight = "unset";

                    img.style.width = img.naturalWidth / 2 + "px";
                    img.style.height = img.naturalHeight / 2 + "px";

                    if(img.width < 300) {
                        img.style.width = "300px";
                        img.style.height = "auto";
                    }
                }

                if(aspectRatio > 2.7) {
                    img.style.width = "300px";
                    img.style.height = "auto";
                }

            }

        });

    </script>

    <div class="product-info">
        
        <h1><?=$producto->getNombre()?></h1>

        <div style="padding: 1px; background-color: lightgray;"></div>

        <div class="product-info-more">
            
            <ul>

                <li><h2>Categoría: <span class="value"><?=Categoria::getById($producto->getCategoriaId())->getNombre()?></span></h2></li>

                <?php if ($producto->getOferta() > 0): ?>
                    <li>
                        <h2>Precio: 
                            <span class="value">
                                <span style="color: red; text-decoration: line-through; font-size: 80%;"><?=$producto->getPrecio()?> €</span>
                                <span style="color: rgb(0, 0, 0); font-weight: bold;"><?=round($producto->getPrecio() * (1 - $producto->getOferta() / 100), 2)?> €</span>
                                <span style="font-size: 80%; opacity: 0.5">(-<?=$producto->getOferta()?>%)</span>
                            </span>
                        </h2>
                    </li>
                <?php else: ?>
                    <li>
                        <h2>Precio: <span class="value" style="font-weight: bold;"><?=$producto->getPrecio()?> €</span></h2>
                    </li>
                <?php endif; ?>

                <li>
                    <h2>Descripción: <span class="value desc"><?=(strlen($producto->getDescripcion()) > 0) ? $producto->getDescripcion() : 'Sin descripción'?></span></h2>
                </li>

            </ul>
        
        </div>

    </div>

</div>

<!-- Este div aparece si stock es mayor que 0, si no, aparece un mensaje en rojo "Producto agotado" -->

<?php if ($producto->getStock() > 0): ?>

    <div class="add-to-cart">
        <form action="<?=BASE_URL?>carrito/add" method="POST">
            <input type="hidden" name="producto_id" value="<?=$producto->getId()?>">
            <label for="cantidad"><h2 style="margin-top: 40px; font-weight: normal;">Cantidad: </h2></label>
            <input type="number" name="cantidad" min="1" value="1" class="quantity-input">
            <button type="submit" class="boton">Añadir al carrito</button>
        </form>
    </div>

<?php else: ?>

    <strong class="yellow">Este producto está agotado.</strong>

<?php endif; ?>

<?php if(isset($_SESSION['carritoResultado']) && $_SESSION['carritoResultado'] == 'failed_stock'): ?>

    <strong class="red">No tenemos el stock solicitado para este producto.</strong>

<?php elseif(isset($_SESSION['carritoResultado']) && $_SESSION['carritoResultado'] == 'complete'): ?>

    <strong class="green">¡Producto añadido al carrito!</strong>

<?php elseif(isset($_SESSION['carritoResultado']) && $_SESSION['carritoResultado'] == 'failed'): ?>

    <strong class="red">Error al añadir el producto al carrito.</strong>

<?php endif; ?>

<?php Utils::deleteSession('carritoResultado'); ?>