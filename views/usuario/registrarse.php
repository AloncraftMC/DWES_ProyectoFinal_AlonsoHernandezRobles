<h1>Registrarse</h1>

<!-- Comprobar si se ha registrado correctamente -->

<?php if(isset($_SESSION['registrarse']) && $_SESSION['registrarse'] == "complete"): ?>
    
    <strong class="alert_green">Registro completado correctamente</strong>

<?php elseif(isset($_SESSION['registrarse']) && $_SESSION['registrarse'] == "failed"): ?>

    <strong class="alert_red">Registro fallido, introduce bien los datos</strong>

<?php endif; 

    // Eliminar la sesión
    Utils::eliminarSesion('registrarse');

?>

<form action="<?=base_url?>usuario/guardar" method="POST">
    
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
    
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>
    
        <label for="email">Email</label>
        <input type="email" name="email" required>
    
        <label for="password">Contraseña</label>
        <input type="password" name="password" required>
    
        <input type="submit" value="Registrarse">

</form>