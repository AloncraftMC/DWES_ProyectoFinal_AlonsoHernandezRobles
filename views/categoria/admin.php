<h1>Administración de Categorías</h1>

<a href="<?=BASE_URL?>categoria/crear">
    <button class="boton more-margin">
        Crear Categoría
    </button>
</a>

<?php if(count($categorias) == 0): ?>

    <h3>No hay categorías.</h3>

<?php else: ?>

    <table>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php foreach($categorias as $categoria): ?>

            <tr>

                <td><?=$categoria->getId()?></td>
                <td><?=$categoria->getNombre()?></td>

                <td class="acciones">
                    
                    <a href="<?=BASE_URL?>categoria/gestion&id=<?=$categoria->getId()?>">
                        Editar
                    </a>

                    <div class="separador"></div>

                    <a href="<?=BASE_URL?>categoria/eliminar&id=<?=$categoria->getId()?>">
                        Eliminar
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

    <div class="paginacion">

        <?php if($totalPag > 1): ?>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?= ($_SESSION['pag'] > 1) ? $_SESSION['pag'] - 1 : 1 ?>">

                <button class="boton <?php if($_SESSION['pag'] == 1) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/left.svg" alt="Página anterior">

                </button>
                
            </a>

            <h1>Pág. <?=$_SESSION['pag']?></h1>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?= ($_SESSION['pag'] < $totalPag) ? $_SESSION['pag'] + 1 : $totalPag ?>">
                
                <button class="boton <?php if($_SESSION['pag'] == $totalPag) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/right.svg" alt="Página siguiente">

                </button>
                
            </a>

        <?php endif; ?>

    </div>

<?php endif; ?>