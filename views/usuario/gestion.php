<h1 style="margin-bottom: 0px">Gestión de Usuario</h1>
<h3><?=$_SESSION['identity']['nombre']?> <?=$_SESSION['identity']['apellidos']?></h3>

<form method="post" action="<?=BASE_URL?>usuario/editar">

    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=$_SESSION['identity']['nombre']?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_nombre'): ?>

            <small class="error">El nombre, de al menos 2 caracteres, solo puede contener letras y espacios.</small>

        <?php endif; ?>

    </div>


    <div class="form-group">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" value="<?=$_SESSION['identity']['apellidos']?>">

        <?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed_apellidos'): ?>

            <small class="error">Los apellidos, de al menos 2 caracteres, solo pueden contener letras y espacios.</small>

        <?php endif; ?>

    </div>


    <div class="form-group">

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['identity']['email']?>">

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

    <button type="submit">Guardar Cambios</button>

    <!-- Eliminar Usuario -->

    <a href="<?=BASE_URL?>usuario/eliminar" class="btn-delete">Eliminar Usuario <span class="hover-text"></span></a>

</form>

<?php if(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'complete'): ?>

    <strong class="green">Datos editados correctamente.</strong>

<?php elseif(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'nothing'): ?>

    <strong class="yellow">No se ha modificado ningún dato.</strong>

<?php elseif(isset($_SESSION['gestion']) && $_SESSION['gestion'] == 'failed'): ?>

    <strong class="red">Edición de datos fallida, introduce bien los datos.</strong>

<?php endif; ?>

<?php Utils::eliminarSesion('gestion'); ?>