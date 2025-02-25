<h1>Administración de Usuarios</h1>

<!-- Botón de creación de usuario -->

<a href="<?=BASE_URL?>usuario/crear">
    <button class="boton more-margin">
        Crear Usuario
    </button>
</a>

<table>

    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>

    <?php foreach($usuarios as $usuario): ?>

        <tr>

            <td><?=$usuario->getId()?></td>
            <td><?=$usuario->getNombre()?></td>
            <td><?=$usuario->getApellidos()?></td>
            <td><?=$usuario->getEmail()?></td>
            
            <!-- Si el rol es 'user', mostrar 'Usuario', si es 'admin', mostrar 'Administrador' -->
            <td><?=($usuario->getRol() === 'user') ? 'Usuario' : 'Administrador'?></td>

            <!-- Imagen del Usuario -->
            <td>
                <?php if($usuario->getImagen()): ?>
                    <img src="<?=BASE_URL?>assets/images/uploads/usuarios/<?=$usuario->getImagen()?>?t=<?=time()?>" alt="Imagen de perfil de <?=$usuario->getNombre()?>" style="max-width: 100px; max-height: 100px; border-radius: 50%;">
                <?php else: ?>
                    <span>No disponible</span>
                <?php endif; ?>
            </td>

            <td class="acciones-especial">
                
                <a class="forzar-azul" href="<?=BASE_URL?>usuario/gestion&id=<?=$usuario->getId()?>">
                    Editar
                </a>

                <div class="separador especial"></div>

                <a href="<?=BASE_URL?>usuario/eliminar&id=<?=$usuario->getId()?>">
                    Eliminar
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<div class="paginacion">

    <?php if($totalPag > 1): ?>

        <a href="<?=BASE_URL?>usuario/admin&pag=<?= ($_SESSION['pag'] > 1) ? $_SESSION['pag'] - 1 : 1 ?>">
            
            <button class="boton <?php if($_SESSION['pag'] == 1) echo 'disabled' ?>">

                <img src="<?=BASE_URL?>assets/images/left.svg" alt="Página anterior">

            </button>

        </a>

        <h1>Pág. <?=$_SESSION['pag']?></h1>

        <a href="<?=BASE_URL?>usuario/admin&pag=<?= ($_SESSION['pag'] < $totalPag) ? $_SESSION['pag'] + 1 : $totalPag ?>">
            
            <button class="boton <?php if($_SESSION['pag'] == $totalPag) echo 'disabled' ?>">

                <img src="<?=BASE_URL?>assets/images/right.svg" alt="Página siguiente">

            </button>

        </a>

    <?php endif; ?>

</div>