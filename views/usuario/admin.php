<?php use models\Usuario; ?>

<h1>Administración de Usuarios</h1>

<!-- Botón de creación de usuario -->

<a href="<?=BASE_URL?>usuario/crear">
    <button class="boton">
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
        <th>Acciones</th>
    </tr>

    <?php foreach(Usuario::getAll() as $usuario): ?>

        <tr>

            <td><?=$usuario->getId()?></td>
            <td><?=$usuario->getNombre()?></td>
            <td><?=$usuario->getApellidos()?></td>
            <td><?=$usuario->getEmail()?></td>
            <td><?=$usuario->getRol()?></td>

            <td class="acciones">
                
                <a href="<?=BASE_URL?>usuario/gestion&id=<?=$usuario->getId()?>">
                    Editar
                </a>

                <div class="separador"></div>

                <a href="<?=BASE_URL?>usuario/eliminar&id=<?=$usuario->getId()?>">
                    Eliminar
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>