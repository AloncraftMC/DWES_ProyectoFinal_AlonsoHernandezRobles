<h1 style="margin-bottom: 0px">Editar Usuario</h1>

<?php
    use models\Usuario;
    $usuario = Usuario::getById($_GET['id']);
?>

<h3><?=$usuario->getNombre()?> <?=$usuario->getApellidos()?></h3>

<form method="post" action="<?=BASE_URL?>usuario/editar&id=<?=$_GET['id']?>">
    
    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=$usuario->getNombre()?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_nombre'): ?>

            <small class="error">El nombre, de al menos 2 caracteres, solo puede contener letras y espacios.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?=$usuario->getApellidos()?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_apellidos'): ?>

            <small class="error">Los apellidos, de al menos 2 caracteres, solo pueden contener letras y espacios.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$usuario->getEmail()?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_email'): ?>

            <small class="error">Introduce un email válido.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="password">Contraseña</label>
        <input type="password" name="password">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_password'): ?>

            <small class="error">La contraseña debe tener mínimo 8 caracteres, una letra y un número.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="rol">Rol</label>
        <select name="rol">
            <option value="user" <?=($usuario->getRol() === 'user') ? 'selected' : ''?>>Usuario</option>
            <option value="admin" <?=($usuario->getRol() === 'admin') ? 'selected' : ''?>>Administrador</option>
        </select>

    </div>

    <button type="submit">Guardar Cambios</button>

</form>

<?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'nothing'): ?>

<strong class="yellow">No se ha modificado ningún dato.</strong>

<?php elseif(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed'): ?>

<strong class="red">Edición de datos fallida, introduce bien los datos.</strong>

<?php endif; ?>

<?php Utils::deleteSession('gestion'); ?>