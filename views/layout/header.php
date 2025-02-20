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

            <a href="<?=BASE_URL?>usuario/registrarse"><button class="boton">Registrarse</button></a>

            <!-- Mostrar botón de Iniciar Sesión si no hay sesión iniciada y además la acción no es login del controlador de usuario -->

            <?php 
                $controlador_actual = $_GET['controller'] ?? null;
                $accion_actual = $_GET['action'] ?? null;
            ?>

            <?php if (!isset($_SESSION['identity'])): ?>

                <!-- Mostrar botón solo si NO estoy en la página de login -->

                <?php if (!($controlador_actual === 'usuario' && $accion_actual === 'login')): ?>

                    <a href="<?=BASE_URL?>usuario/login"><button class="boton">Iniciar Sesión</button></a>

                <?php endif; ?>

            <?php else: ?>
                
                <a href="<?=BASE_URL?>usuario/salir"><button class="boton">Cerrar Sesión<br>(<?= $_SESSION['identity']['nombre'] ?>)</button></a>

            <?php endif; ?>

        </div>
    </header>
    <main>