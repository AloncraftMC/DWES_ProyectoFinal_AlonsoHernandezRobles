<?php

    session_start();

    // Requiero el autoload para cargar las clases y el header y sidebar

    use controllers\ErrorController;

    require_once 'autoload.php';
    require_once 'lib/BaseDatos.php';
    require_once 'config/parameters.php';
    require_once 'helpers/Utils.php';
    require_once 'views/layout/header.php';
    require_once 'views/layout/sidebar.php';

    // Función para mostrar errores

    function show_error(){

        $error = new ErrorController();
        $error->index();
    
    }

    // Compruebo si existe el controlador y la acción en la URL

    if(isset($_GET['controller'])){

        $nombre_controlador = 'controllers\\' . $_GET['controller'] . 'Controller';

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        
        $nombre_controlador = controller_default;
        
    }else{

        show_error();
        exit();

    }

    // Compruebo si existe la clase

    if(class_exists($nombre_controlador)){

        $controlador = new $nombre_controlador();

        // Compruebo si existe la acción

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){

            $action = $_GET['action'];
            $controlador->$action();

        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        
            $action_default = action_default;
            $controlador->$action_default();
            
        }else{

            show_error();

        }

    }else{

        show_error();

    }

    // Requiero el footer
    
    require_once 'views/layout/footer.php';