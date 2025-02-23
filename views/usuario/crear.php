<h1>Crear Usuario</h1>

<form method="post" action="<?=BASE_URL?>usuario/guardar">

    <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_nombre'): ?>

            <small class="error">El nombre, de al menos 2 caracteres, solo puede contener letras y espacios.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_apellidos'): ?>

            <small class="error">Los apellidos, de al menos 2 caracteres, solo pueden contener letras y espacios.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_email'): ?>

            <small class="error">Introduce un email válido.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="password">Contraseña</label>
        <input type="password" name="password" required>

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'failed_password'): ?>

            <small class="error">La contraseña debe tener mínimo 8 caracteres, una letra y un número.</small>

        <?php endif; ?>

    </div>

    <div class="form-group">

        <label for="rol">Rol</label>
        <select name="rol" required>
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
        </select>

    </div>

    <button type="submit">Crear Usuario</button>

</form>