<aside id="lateral">

    <div id="login" class="block_aside">
        <h3>Entrar a la web</h3>
        <form action="<?=base_url?>usuario/login" method="post">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <input type="submit" value="Enviar">
        </form>

        <ul>
            <li><a href="#">Mis Pedidos</a></li>
            <li><a href="#">Gestionar Pedidos</a></li>
            <li><a href="#">Gestionar Categorías</a></li>
        </ul>
    
    </div>

</aside>

<!-- Contenido Central -->

<div id="central">