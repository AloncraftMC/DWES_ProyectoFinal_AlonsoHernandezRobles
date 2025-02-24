<?php use helpers\Utils; ?>

<h1>Crear Usuario</h1>

<form method="post" action="<?=BASE_URL?>usuario/guardar">

    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="<?=isset($_SESSION['form_data']['nombre']) ? $_SESSION['form_data']['nombre'] : ''?>">

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_nombre'): ?>

            <small class="error">El nombre, de al menos 2 caracteres, solo puede contener letras y espacios.</small>
            <?php Utils::deleteSession('register'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required value="<?=isset($_SESSION['form_data']['apellidos']) ? $_SESSION['form_data']['apellidos'] : ''?>">

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_apellidos'): ?>

            <small class="error">Los apellidos, de al menos 2 caracteres, solo pueden contener letras y espacios.</small>
            <?php Utils::deleteSession('register'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="email">Email</label>
        <input type="email" name="email" required value="<?=isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''?>">

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_email'): ?>

            <small class="error">Introduce un email válido.</small>
            <?php Utils::deleteSession('register'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="password">Contraseña</label>
        <input type="password" name="password" required value="<?=isset($_SESSION['form_data']['password']) ? $_SESSION['form_data']['password'] : ''?>">

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_password'): ?>

            <small class="error">La contraseña debe tener mínimo 8 caracteres, una letra y un número.</small>
            <?php Utils::deleteSession('register'); ?>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="rol">Rol</label>

        <select name="rol" required>

            <option value="user" <?=isset($_SESSION['form_data']['rol']) && $_SESSION['form_data']['rol'] == 'user' ? 'selected' : ''?>>Usuario</option>
            <option value="admin" <?=isset($_SESSION['form_data']['rol']) && $_SESSION['form_data']['rol'] == 'admin' ? 'selected' : ''?>>Administrador</option>
        
        </select>

    </div>

    <button type="submit">Crear Usuario</button>

</form>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>

    <strong class="red">Registro fallido, introduce bien los datos.</strong>

<?php endif; ?>

<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('form_data'); ?>