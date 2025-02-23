<!DOCTYPE html>
<html lang="es">
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
                <a href="<?=BASE_URL?>usuario/registrarse"><button class="boton">
                    <img src="<?=BASE_URL?>assets/images/registrarse.svg">Registrarse
                </button></a>
                <a href="<?=BASE_URL?>usuario/login"><button class="boton">
                    <img src="<?=BASE_URL?>assets/images/login.svg">Iniciar Sesión
                </button></a>
            <?php else: ?>
                <?php 
                    // Se extrae el rol del usuario de la sesión
                    $rol = $_SESSION['identity']['rol'] ?? null;
                ?>
                
                <!-- Si el usuario es admin, se muestran los botones adicionales -->
                <?php if($rol === 'admin'): ?>
                    <a href="<?=BASE_URL?>categoria/admin">
                        <button class="boton">
                            <img src="<?=BASE_URL?>assets/images/categoria.svg">Categorías
                        </button>
                    </a>
                    <a href="<?=BASE_URL?>producto/admin">
                        <button class="boton">
                            <img src="<?=BASE_URL?>assets/images/producto.svg">Productos
                        </button>
                    </a>
                    <a href="<?=BASE_URL?>pedido/admin">
                        <button class="boton">
                            <img src="<?=BASE_URL?>assets/images/pedido.svg">Pedidos
                        </button>
                    </a>
                    <!-- Botón de administración de usuarios para admin -->
                    <a href="<?=BASE_URL?>usuario/admin">
                        <button class="boton">
                            <img src="<?=BASE_URL?>assets/images/usuarios.svg">Usuarios
                        </button>
                    </a>
                    <div class="separador"></div>
                <?php endif; ?>

                <!-- Botón para gestionar datos personales (aparece para todos los usuarios) -->
                <a href="<?=BASE_URL?>usuario/gestion">
                    <button class="boton">
                        <img src="<?=BASE_URL?>assets/images/usuario.svg"> <?= $_SESSION['identity']['nombre'] ?>
                    </button>
                </a>
                
                <!-- Botón del carrito -->
                <?php 
                    // Contador del carrito, suponiendo que $_SESSION['carrito'] es un array con los productos
                    $contadorCarrito = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
                ?>
                <a href="<?=BASE_URL?>carrito/gestion">
                    <button class="boton">
                        <img src="<?=BASE_URL?>assets/images/carrito.svg">Carrito (<?=$contadorCarrito?>)
                    </button>
                </a>

                <!-- Botón para cerrar sesión -->
                <a href="<?=BASE_URL?>usuario/salir"><button class="boton">
                    <img src="<?=BASE_URL?>assets/images/logout.svg">Cerrar Sesión
                </button></a>
            <?php endif; ?>
        </div>
    </header>
    <main>
