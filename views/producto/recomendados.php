<!-- Si se pasa una categoría por GET se pone "Productos Filtrados" -->

<?php
use models\Categoria;
use models\Producto;

// Recuperamos todos los productos
$todos = Producto::getAll();

// Bandera para saber si estamos en modo "por categoría"
$modoCategoria = false;

// Definimos el array final de productos a mostrar
$recomendados = [];

// Si se pasa una categoría por GET se filtra y se usa paginación

if (isset($_GET['categoria'])) {

    echo "<h1>Productos Filtrados</h1>";

    $categoria = Categoria::getById($_GET['categoria']);
    $modoCategoria = true;

    // Filtrar productos de la categoría indicada

    $productosFiltrados = [];

    foreach ($todos as $producto) {
        if ($producto->getCategoriaId() == $categoria->getId()) {
            $productosFiltrados[] = $producto;
        }
    }
    
    if (empty($productosFiltrados)) {

        $noHayProductos = true;

    } else {

        $noHayProductos = false;

        // Configuración de paginación (6 productos por página)

        $productosPorPagina = PRODUCTS_PER_PAGE;
        
        $pag = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
        $totalProductos = count($productosFiltrados);
        $totalPag = ceil($totalProductos / $productosPorPagina);

        if ($pag < 1) $pag = 1;
        if ($pag > $totalPag) $pag = $totalPag;

        $offset = ($pag - 1) * $productosPorPagina;
        $recomendados = array_slice($productosFiltrados, $offset, $productosPorPagina);
        
        // Mostrar header de categoría

        $mostrarHeader = true;

    }

} else {

    echo "<h1>Productos Recomendados</h1>";

    // Modo aleatorio sin categoría

    if (empty($todos)) {

        $bdVacia = true;

    } else {

        $bdVacia = false;

        $numProductos = min(6, count($todos));
        $shuffled = $todos;

        shuffle($shuffled);

        $recomendados = array_slice($shuffled, 0, $numProductos);

    }
    
}

if(isset($mostrarHeader) && $mostrarHeader){

    echo "<h2 style='margin-top: 0px; color: rgb(0,79,173);;'>Por categoría: " . $categoria->getNombre() . "</h2>";

}

?>

<!-- Mostrar barra de categorías solo si hay alguna -->

<?php
    $categorias = Categoria::getAll();
    if (!empty($categorias)):
?>

<div style="margin-top: 20px; margin-bottom: 20px; display: flex; flex-wrap: wrap; justify-content: center;">

    <?php foreach ($categorias as $cat): ?>

        <div style="margin: 10px;">
            <a href="<?= BASE_URL ?>producto/recomendados&categoria=<?= $cat->getId() ?>" class="boton">
                <button style="width: 200px;"><?= $cat->getNombre() ?></button>
            </a>
        </div>

    <?php endforeach; ?>

</div>

<?php if(isset($noHayProductos) && $noHayProductos): ?>

    <h2 style="color: gray">Aún no hay productos en esta categoría...</h2>

    <h1 style="font-size: 500%">:(</h1>

<?php endif; ?>

<?php if(isset($bdVacia) && $bdVacia): ?>

    <h2 style="color: rgb(180, 180, 180)">¡Vaya! Parece que nuestra base de datos está vacía...</h2>

<?php endif; ?>

<?php endif; ?>

<!-- Si estamos en modo categoría y hay paginación, mostramos la barra superior -->

<?php if ($modoCategoria && !empty($recomendados) && $totalPag > 1): 
        $prev = ($pag > 1) ? $pag - 1 : 1;
        $next = ($pag < $totalPag) ? $pag + 1 : $totalPag;
?>

    <div class="paginacion" style="text-align: center; margin-bottom: 20px;">

        <a href="<?= BASE_URL ?>producto/recomendados&categoria=<?= $categoria->getId() ?>&pag=<?= $prev ?>">
            <button class="boton <?= ($pag == 1) ? 'disabled' : '' ?>">
                <img src="<?= BASE_URL ?>assets/images/left.svg" alt="Página anterior">
            </button>
        </a>

        <h1>Pág. <?= $pag ?></h1>

        <a href="<?= BASE_URL ?>producto/recomendados&categoria=<?= $categoria->getId() ?>&pag=<?= $next ?>">
            <button class="boton <?= ($pag == $totalPag) ? 'disabled' : '' ?>">
                <img src="<?= BASE_URL ?>assets/images/right.svg" alt="Página siguiente">
            </button>
        </a>

    </div>

<?php endif; ?>

<?php if (!empty($recomendados)): ?>

    <table style="width:100%;">

        <?php 

        // Dividir los productos en filas de 3

        $chunks = array_chunk($recomendados, 3);

        // Alternar colores de fila
        
        $bgColors = ["white", "#f2f2f2"];
        $rowIndex = 0;

        foreach ($chunks as $row):
            $bg = $bgColors[$rowIndex % 2];
        ?>

        <tr style="background-color: <?= $bg ?>;">

            <?php foreach ($row as $producto): ?>

            <td style="width: 33%; padding: 30px; vertical-align: top;">

                <img style="max-height: 200px; min-height: 200px; margin-top: 20px;" 
                    src="<?= BASE_URL ?>assets/images/uploads/productos/<?= $producto->getImagen() ?>" 
                    alt="<?= $producto->getNombre() ?>">

                <h2 style="margin-bottom: 0px;"><?= $producto->getNombre() ?></h2>

                <p style="margin: 4px; margin-bottom: 10px; color: gray;">
                    <?= Categoria::getById($producto->getCategoriaId())->getNombre() ?>
                </p>

                <?php if ($producto->getOferta() > 0): ?>

                    <h3 style="margin: 4px; color: red; text-decoration: line-through;">
                        <?= $producto->getPrecio() ?> €
                    </h3>

                    <h1 style="margin: 4px;">
                        <?= round($producto->getPrecio() * (1 - $producto->getOferta() / 100), 2) ?> €
                        <span style="font-size: 70%; opacity: 0.3">(-<?= $producto->getOferta() ?>%)</span>
                    </h1>
                    
                <?php else: ?>

                    <h1 style="margin: 4px;"><?= $producto->getPrecio() ?> €</h1>

                <?php endif; ?>

                <a href="<?= BASE_URL ?>producto/ver&id=<?= $producto->getId() ?>" class="boton">
                    <button style="margin-top: 20px;">Ver Producto</button>
                </a>

            </td>

            <?php endforeach; ?>

            <?php 

            // Rellenar celdas vacías si la fila tiene menos de 3 elementos

            $faltantes = 3 - count($row);

            for ($i = 0; $i < $faltantes; $i++):
            ?>
                <td style="width: 33%; padding: 30px;"></td>

            <?php endfor; ?>

        </tr>

        <?php 
            $rowIndex++;
        endforeach; 
        ?>
        
    </table>

<?php endif; ?>

<!-- Mostrar de nuevo la paginación inferior en modo categoría -->

<?php if ($modoCategoria && !empty($recomendados) && $totalPag > 1): ?>

    <div class="paginacion" style="text-align: center; margin-top: 20px;">

        <a href="<?= BASE_URL ?>producto/recomendados&categoria=<?= $categoria->getId() ?>&pag=<?= $prev ?>">
            <button class="boton <?= ($pag == 1) ? 'disabled' : '' ?>">
                <img src="<?= BASE_URL ?>assets/images/left.svg" alt="Página anterior">
            </button>
        </a>

        <h1>Pág. <?= $pag ?></h1>

        <a href="<?= BASE_URL ?>producto/recomendados&categoria=<?= $categoria->getId() ?>&pag=<?= $next ?>">
            <button class="boton <?= ($pag == $totalPag) ? 'disabled' : '' ?>">
                <img src="<?= BASE_URL ?>assets/images/right.svg" alt="Página siguiente">
            </button>
        </a>
        
    </div>

<?php endif; ?>
