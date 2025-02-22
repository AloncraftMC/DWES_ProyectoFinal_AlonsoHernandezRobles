<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <!-- Le añado lo del time() para que no se quede en cache -->
    <link rel="stylesheet" href="<?=BASE_URL?>assets/css/style.css?v=<?=time()?>" type="text/css">
</head>
<body>
    <header>
        <div class="header-izquierda">
            <a href="<?=BASE_URL?>"><img src="<?=BASE_URL?>assets/images/señal3.svg" alt="logo"></a>
            <a href="<?=BASE_URL?>"><h1>Tienda de Señales de Tráfico</h1></a>
        </div>
        
        <div class="header-derecha">

            <?php 
                $controlador_actual = $_GET['controller'] ?? null;
                $accion_actual = $_GET['action'] ?? null;
            ?>
            
            <!-- Si no hay sesión iniciada se muestran los botones de Registrarse e Iniciar Sesión -->

            <?php if (!isset($_SESSION['identity'])): ?>

                <?php if (!($controlador_actual === 'usuario' && $accion_actual === 'registrarse')): ?>
                    <a href="<?=BASE_URL?>usuario/registrarse"><button class="boton">Registrarse</button></a>
                <?php endif; ?>

                <?php if (!($controlador_actual === 'usuario' && $accion_actual === 'login')): ?>
                    <a href="<?=BASE_URL?>usuario/login"><button class="boton">Iniciar Sesión</button></a>
                <?php endif; ?>

            <?php else: ?>

                <?php 
                    // Se extrae el rol del usuario de la sesión
                    $rol = $_SESSION['identity']['rol'] ?? null;
                ?>
                
                <!-- Si el usuario es admin, se muestran los botones adicionales -->

                <?php if($rol === 'admin'): ?>

                    <?php if($controlador_actual !== 'categoria'): ?>
                        <a href="<?=BASE_URL?>categoria/admin">
                            <button class="boton">
                                <img src="<?=BASE_URL?>assets/images/categoria.svg">Categorías
                            </button>
                        </a>
                    <?php endif; ?>

                    <?php if($controlador_actual !== 'producto'): ?>
                        <a href="<?=BASE_URL?>producto/admin">
                            <button class="boton">
                                <img src="<?=BASE_URL?>assets/images/producto.svg">Productos
                            </button>
                        </a>
                    <?php endif; ?>

                    <?php if($controlador_actual !== 'pedido'): ?>
                        <a href="<?=BASE_URL?>pedido/admin">
                            <button class="boton">
                                <img src="<?=BASE_URL?>assets/images/pedido.svg">Pedidos
                            </button>
                        </a>
                    <?php endif; ?>

                    <!-- Botón de administración de usuarios para admin -->
                    <?php if (!($controlador_actual === 'usuario' && $accion_actual === 'admin')): ?>
                        <a href="<?=BASE_URL?>usuario/admin">
                            <button class="boton">
                                <img src="<?=BASE_URL?>assets/images/usuarios.svg">Usuarios
                            </button>
                        </a>
                    <?php endif; ?>

                <?php endif; ?>

                <!-- Botón para gestionar datos personales (aparece para todos los usuarios) -->
                <?php if (!($controlador_actual === 'usuario' && $accion_actual === 'gestion')): ?>
                    <a href="<?=BASE_URL?>usuario/gestion">
                        <button class="boton">
                            <img src="<?=BASE_URL?>assets/images/usuario.svg" class="no-margin-right">
                        </button>
                    </a>
                <?php endif; ?>
                
                <!-- Botón del carrito, mostrado solo si no estamos en la sección de carrito -->
                <?php 
                    // Contador del carrito, suponiendo que $_SESSION['carrito'] es un array con los productos
                    $contadorCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
                ?>

                <?php if($controlador_actual !== 'carrito'): ?>
                    <a href="<?=BASE_URL?>carrito/gestion">
                        <button class="boton">
                            <img src="<?=BASE_URL?>assets/images/carrito.svg">Carrito (<?=$contadorCarrito?>)
                        </button>
                    </a>
                <?php endif; ?>

                <!-- Botón para cerrar sesión -->
                <a href="<?=BASE_URL?>usuario/salir"><button class="boton">Cerrar Sesión</button></a>

            <?php endif; ?>

        </div>
    </header>
    <main>
