<h1>Productos Recomendados</h1>

<?php

    use models\Categoria;
    use models\Producto;

    // Vamos a mostrar 6 productos aleatorios

    $todos = Producto::getAll();

    // Pero antes necesitamos saber si filtrar por categoría o no, mediante el parámetro GET

    if (isset($_GET['categoria'])) {

        // Si se ha pasado un parámetro GET, filtramos por categoría

        $categoria = Categoria::getById($_GET['categoria']);

        // Generamos un array con los productos de la categoría seleccionada asegurando que no se repitan

        $recomendados = [];

        // Miramos primero si hay productos de la categoría seleccionada

        foreach ($todos as $producto) {

            if ($producto->getCategoriaId() == $categoria->getId()) {
                $recomendados[] = $producto;
            }

        }

        // Si no hay suficientes productos de la categoría seleccionada, establecemos null los últimos elementos
        
        while (count($recomendados) < 6) {

            $producto = $todos[array_rand($todos)];
            if (!in_array($producto, $recomendados)) array_push($recomendados, $producto);
        
        }

    } else {

        // Si no se ha pasado un parámetro GET, mostramos productos aleatorios sin filtrar

        $recomendados = [];

        while (count($recomendados) < 6) {

            $producto = $todos[array_rand($todos)];
            if (!in_array($producto, $recomendados)) array_push($recomendados, $producto);
        }

    }

?>

<!-- Si hay categoría seleccionada mostrar un h2 -->

<?php if (isset($categoria)): ?>

    <h2 style="margin-top: 0px; color: rgb(0, 79, 173);;">Por categoría: <?=$categoria->getNombre()?></h2>

<?php endif; ?>

<!-- Mostrar una barra con las categorías tal que Cat 1 | Cat 2 | Cat 3 | ... -->

<div style="margin-top: 20px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">

    <?php foreach (Categoria::getAll() as $categoria): ?>

        <a href="<?=BASE_URL?>producto/recomendados&categoria=<?=$categoria->getId()?>" class="boton" style="margin: 0px 20px;">
            <button style="width: 200px;"><?=$categoria->getNombre()?></button>
        </a>

    <?php endforeach; ?>

</div>

<table>

    <!-- Mostrar primero 3 productos -->

    <tr style="background-color: white;">

        <?php for ($i = 0; $i < 3; $i++): ?>

            <td style="width: 33%; padding: 30px;">

                <img style="max-height: 200px; min-height: 200px; margin-top: 20px;" src="<?=BASE_URL?>assets/images/uploads/productos/<?=$recomendados[$i]->getImagen()?>" alt="<?=$recomendados[$i]->getNombre()?>">
                    
                <h2 style="margin-bottom: 0px;"><?=$recomendados[$i]->getNombre()?></h2>
                
                <p style="margin: 4px; margin-bottom: 10px; color: gray"><?=Categoria::getById($recomendados[$i]->getCategoriaId())->getNombre()?></p>
            
                <?php if ($recomendados[$i]->getOferta() > 0): ?>

                    <h3 style="margin: 4px; color: red; text-decoration: line-through;"><?=$recomendados[$i]->getPrecio()?> €</h3>
                    <h1 style="margin: 4px;"><?=round($recomendados[$i]->getPrecio() * (1 - $recomendados[$i]->getOferta() / 100), 2)?> € <span style="font-size: 70%; opacity: 0.3">(-<?=$recomendados[$i]->getOferta()?>%)</span></h1>

                <?php else: ?>

                    <h1 style="margin: 4px;"><?=$recomendados[$i]->getPrecio()?> €</h1>

                <?php endif; ?>
                
                <a href="<?=BASE_URL?>producto/ver&id=<?=$recomendados[$i]->getId()?>" class="boton">
                    <button style="margin-top: 20px;">Ver Producto</button>
                </a>

            </td>

        <?php endfor; ?>

    </tr>

    <!-- Mostrar los otros 3 productos -->

    <tr style="background-color: #f2f2f2;">

        <?php for ($i = 3; $i < 6; $i++): ?>

            <td style="width: 33%; padding: 30px;">

                <img style="max-height: 200px; min-height: 200px; margin-top: 20px;" src="<?=BASE_URL?>assets/images/uploads/productos/<?=$recomendados[$i]->getImagen()?>" alt="<?=$recomendados[$i]->getNombre()?>">
                    
                <h2 style="margin-bottom: 0px;"><?=$recomendados[$i]->getNombre()?></h2>
                
                <p style="margin: 4px; margin-bottom: 10px; color: gray"><?=Categoria::getById($recomendados[$i]->getCategoriaId())->getNombre()?></p>
            
                <?php if ($recomendados[$i]->getOferta() > 0): ?>

                    <h3 style="margin: 4px; color: red; text-decoration: line-through;"><?=$recomendados[$i]->getPrecio()?> €</h3>
                    <h1 style="margin: 4px;"><?=round($recomendados[$i]->getPrecio() * (1 - $recomendados[$i]->getOferta() / 100), 2)?> € <span style="font-size: 70%; opacity: 0.3">(-<?=$recomendados[$i]->getOferta()?>%)</span></h1>

                <?php else: ?>

                    <h1 style="margin: 4px;"><?=$recomendados[$i]->getPrecio()?> €</h1>

                <?php endif; ?>
                
                <a href="<?=BASE_URL?>producto/ver&id=<?=$recomendados[$i]->getId()?>" class="boton">
                    <button style="margin-top: 20px;">Ver Producto</button>
                </a>

            </td>

        <?php endfor; ?>

    </tr>

</table>