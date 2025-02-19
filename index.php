<?php

    session_start();

    // Importar controlador de errores

    use controllers\ErrorController;

    // Autoload , Configuración y Clase Utils

    require_once 'autoload.php';
    require_once 'config.php';
    require_once 'helpers/Utils.php';

    // Requiero el header

    require_once 'views/layout/header.php';

    // Función para mostrar errores

    function show_error(){
        (new ErrorController())->index();
    }

    // Si existe el controlador por la URL, golfo
    // Si no existe, se carga el controlador por defecto
    // Si no existe el controlador por defecto, se muestra un error (never)

    if(isset($_GET['controller'])){

        $nombre_controlador = 'controllers\\' . $_GET['controller'] . 'Controller';

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        
        $nombre_controlador = 'controllers\\' . controller_default . 'Controller';
        
    }else{

        echo "Controlador no encontrado";
        show_error();
        exit();

    }

    // Compruebo si existe la clase
    
    if(class_exists($nombre_controlador)){

        $controlador = new $nombre_controlador();

        // Si existe la acción por la URL, golfo
        // Si no existe, se carga la acción por defecto
        // Si no existe la acción por defecto, se muestra un error (never)

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){

            $action = $_GET['action'];
            $controlador->$action();

        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        
            $action_default = action_default;
            $controlador->$action_default();
            
        }else{

            echo "Acción por defecto no encontrada";
            show_error();

        }

    }else{

        echo "Controlador no encontrado";
        show_error();

    }

    // Requiero el footer
    
    require_once 'views/layout/footer.php';