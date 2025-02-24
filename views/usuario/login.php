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

    <!-- Casilla para recordar el usuario con una cookie que dura 7 días -->
    <div class="form-group checkbox-group">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Recordar usuario durante 7 días</label>
    </div>

    <button type="submit">Iniciar Sesión</button>

</form>

<?php if(isset($_SESSION['login']) && $_SESSION['login'] == 'failed'): ?>

    <strong class="red">Login fallido, introduce bien los datos.</strong>

<?php endif; ?>

<?php Utils::deleteSession('login'); ?>