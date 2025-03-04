<h1>Administración de Categorías</h1>

<a href="<?=BASE_URL?>categoria/crear">
    <button class="boton more-margin">
        Crear Categoría
    </button>
</a>

<?php if(count($categorias) == 0): ?>

    <h3>No hay categorías.</h3>

<?php else: ?>

    <div class="paginacion">

        <?php if($totalPag > 1): ?>

            <a href="<?=BASE_URL?>categoria/admin&pag=1" style="pointer-events: <?=($_SESSION['pag'] == 1) ? 'none' : 'auto'?>;">

                <button class="boton <?php if($_SESSION['pag'] == 1) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/doubleleft.png" alt="Primera página" style="width: 10px; padding: 5px;">

                </button>

            </a>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?= ($_SESSION['pag'] > 1) ? $_SESSION['pag'] - 1 : 1 ?>" style="pointer-events: <?=($_SESSION['pag'] == 1) ? 'none' : 'auto'?>;">

                <button class="boton <?php if($_SESSION['pag'] == 1) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/left.svg" alt="Página anterior">

                </button>
                
            </a>

            <h1>Pág. <?=$_SESSION['pag']?></h1>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?= ($_SESSION['pag'] < $totalPag) ? $_SESSION['pag'] + 1 : $totalPag ?>" style="pointer-events: <?=($_SESSION['pag'] == $totalPag) ? 'none' : 'auto'?>;">
                
                <button class="boton <?php if($_SESSION['pag'] == $totalPag) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/right.svg" alt="Página siguiente">

                </button>
                
            </a>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?=$totalPag?>" style="pointer-events: <?=($_SESSION['pag'] == $totalPag) ? 'none' : 'auto'?>;">

                <button class="boton <?php if($_SESSION['pag'] == $totalPag) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/doubleright.png" alt="Última página" style="width: 10px; padding: 5px;">

                </button>

            </a>

        <?php endif; ?>

    </div>

    <table>

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php foreach($categorias as $categoria): ?>

            <tr id="<?=$categoria->getId()?>">

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

            <a href="<?=BASE_URL?>categoria/admin&pag=1" style="pointer-events: <?=($_SESSION['pag'] == 1) ? 'none' : 'auto'?>;">

                <button class="boton <?php if($_SESSION['pag'] == 1) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/doubleleft.png" alt="Primera página" style="width: 10px; padding: 5px;">

                </button>

            </a>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?= ($_SESSION['pag'] > 1) ? $_SESSION['pag'] - 1 : 1 ?>" style="pointer-events: <?=($_SESSION['pag'] == 1) ? 'none' : 'auto'?>;">

                <button class="boton <?php if($_SESSION['pag'] == 1) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/left.svg" alt="Página anterior">

                </button>
                
            </a>

            <h1>Pág. <?=$_SESSION['pag']?></h1>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?= ($_SESSION['pag'] < $totalPag) ? $_SESSION['pag'] + 1 : $totalPag ?>" style="pointer-events: <?=($_SESSION['pag'] == $totalPag) ? 'none' : 'auto'?>;">
                
                <button class="boton <?php if($_SESSION['pag'] == $totalPag) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/right.svg" alt="Página siguiente">

                </button>
                
            </a>

            <a href="<?=BASE_URL?>categoria/admin&pag=<?=$totalPag?>" style="pointer-events: <?=($_SESSION['pag'] == $totalPag) ? 'none' : 'auto'?>;">

                <button class="boton <?php if($_SESSION['pag'] == $totalPag) echo 'disabled' ?>">

                    <img src="<?=BASE_URL?>assets/images/doubleright.png" alt="Última página" style="width: 10px; padding: 5px;">

                </button>

            </a>

        <?php endif; ?>

    </div>

<?php endif; ?>