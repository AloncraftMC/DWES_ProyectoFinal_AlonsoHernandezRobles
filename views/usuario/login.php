<h1>Iniciar Sesión</h1>

<form method="post" action="<?=BASE_URL?>usuario/entrar">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Iniciar Sesión</button>

</form>

<?php if(isset($_SESSION['login']) && $_SESSION['login'] == 'failed'): ?>

    <strong class="red">Login fallido, introduce bien los datos.</strong>

<?php endif; ?>

<?php Utils::eliminarSesion('login'); ?>