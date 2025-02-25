<?php

    // Inicio la sesión

    session_start();
    
    // Importar controlador de errores y modelo de usuario

    use controllers\ErrorController;
    use models\Usuario;

    // Autoload, Configuración y Clase Utils

    require_once 'autoload.php';
    require_once 'config.php';
    require_once 'helpers/Utils.php';
    
    // Verificar si el usuario está en la sesión y actualizar sus datos desde la base de datos

    if (isset($_SESSION['identity']) && isset($_SESSION['identity']['id'])) {

        $usuario = Usuario::getById($_SESSION['identity']['id']);

        if ($usuario) {

            $_SESSION['identity'] = [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'apellidos' => $usuario->getApellidos(),
                'email' => $usuario->getEmail(),
                'rol' => $usuario->getRol()
            ];

        }
        
    }

    // Requiero el header

    require_once 'views/layout/header.php';

    // 1. Si existe el controlador en la URL, se ejecuta ese
    // 2. Si no existe el controlador en la URL, ejecutamos el controlador por defecto
    // 3. Si el controlador no existe, mostramos un error

    if(isset($_GET['controller'])){

        $nombre_controlador = 'controllers\\' . $_GET['controller'] . 'Controller';

    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        
        $nombre_controlador = 'controllers\\' . CONTROLLER_DEFAULT . 'Controller';
        
    }else{  // Realmente este else no es necesario, pero quizá lo hace más claro el código

        echo "Controlador no encontrado";
        (new ErrorController())->index();

    }

    // Compruebo si existe la clase
    
    if(class_exists($nombre_controlador)){

        $controlador = new $nombre_controlador();

        // 1. Si existe la acción en la URL, se ejecuta esa
        // 2. Si no existe la acción en la URL, ejecutamos la acción por defecto
        // 3. Si la acción no existe, mostramos un error

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){

            $action = $_GET['action'];
            $controlador->$action();

        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        
            $action_default = ACTION_DEFAULT;
            $controlador->$action_default();
            
        }else{

            echo "Acción no encontrada";
            (new ErrorController())->index();

        }

    }else{

        echo "Controlador no encontrado";
        (new ErrorController())->index();

    }

    // Requiero el footer
    
    require_once 'views/layout/footer.php';

?>