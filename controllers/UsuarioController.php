<?php

    namespace controllers;

    use models\Usuario;
    use helpers\Utils;

    class UsuarioController{

        // Método para mostrar la vista de registrarse

        public function registrarse(): void{
            require_once 'views/usuario/registrarse.php';
        }

        // Método para guardar un usuario en la base de datos

        public function guardar(): void {

            Utils::isIdentity();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Recoger datos con trim() para evitar espacios adicionales

                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
                $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
                $email = isset($_POST['email']) ? trim($_POST['email']) : false;
                $password = isset($_POST['password']) ? trim($_POST['password']) : false;
                $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

                $_SESSION['form_data'] = [
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'password' => $password,
                    'rol' => $rol
                ];

                if ($nombre && $apellidos && $email && $password) {
        
                    // Validar nombre (solo letras y espacios, mínimo 2 caracteres)

                    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $nombre)) {

                        $_SESSION['register'] = "failed_nombre";
                        header("Location:" . BASE_URL . "usuario/" . (isset($_SESSION['admin']) ? 'crear' : 'registrarse'));
                        exit;

                    }
                    
                    // Validar apellidos (solo letras y espacios, mínimo 2 caracteres)
        
                    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $apellidos)) {
                        $_SESSION['register'] = "failed_apellidos";
                        header("Location:" . BASE_URL . "usuario/" . (isset($_SESSION['admin']) ? 'crear' : 'registrarse'));
                        exit;
                    }
        
                    // Validar email

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['register'] = "failed_email";
                        header("Location:" . BASE_URL . "usuario/" . (isset($_SESSION['admin']) ? 'crear' : 'registrarse'));
                        exit;
                    }
        
                    // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)

                    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
                        $_SESSION['register'] = "failed_password";
                        header("Location:" . BASE_URL . "usuario/" . (isset($_SESSION['admin']) ? 'crear' : 'registrarse'));
                        exit;
                    }
        
                    // Crear objeto Usuario y guardar en BD

                    $usuario = new Usuario();
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
                    $usuario->setRol($rol);
        
                    $_SESSION['register'] = $usuario->save() ? 'complete' : 'failed';
        
                } else {

                    $_SESSION['register'] = "failed";

                }
        
                // Redirigir al formulario de registro o de creación de usuario según lo que se haya hecho

                if($_SESSION['register'] == 'complete'){

                    // Si no somos administradores, vamos a registrarse
                    // Pero si somos administradores, vamos a la administración de usuarios, primero comprobando si $_SESSION['pag'] está seteado

                    Utils::deleteSession('form_data');

                    if(isset($_SESSION['admin'])){

                        header("Location:" . BASE_URL . "usuario/admin" . (isset($_SESSION['pag']) ? "&pag=" . $_SESSION['pag'] : ""));
                        
                    }else{
                        
                        header("Location:" . BASE_URL . "usuario/registrarse");

                    }

                }else{
                    
                    header("Location:" . BASE_URL . "usuario/" . (isset($_SESSION['admin']) ? 'crear' : 'registrarse'));

                }

            }else{

                header("Location:" . BASE_URL);

            }
            
        }

        // Método para mostrar la vista de iniciar sesión

        public function login(): void{

            // Si ya estamos identificados, nos redirige a la página principal
            
            if(isset($_SESSION['identity'])){

                header("Location:" . BASE_URL);

            }

            // Cargar cookies

            if (isset($_COOKIE['recuerdame'])) {
                
                $email = $_COOKIE['recuerdame'];
                
                $usuario = Usuario::getByEmail($email);
                
                if ($usuario) {

                    $_SESSION['identity'] = [
                        'id' => $usuario->getId(),
                        'nombre' => $usuario->getNombre(),
                        'apellidos' => $usuario->getApellidos(),
                        'email' => $usuario->getEmail(),
                        'rol' => $usuario->getRol()
                    ];
            
                    if ($usuario->getRol() == 'admin') $_SESSION['admin'] = true;
            
                    header("Location:" . BASE_URL);
                    exit;

                }

            }

            require_once 'views/usuario/login.php';

        }

        // Método para iniciar sesión

        public function entrar(): void{

            // Compruebo si se ha enviado el formulario
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                // Compruebo si se han enviado los datos necesarios

                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                $remember = isset($_POST['remember']);

                $_SESSION['form_data'] = [
                    'email' => $email,
                    'password' => $password,
                    'remember' => $remember
                ];

                // Si se han enviado los datos necesarios

                if($email && $password){

                    // Creo un objeto de la clase Usuario

                    $usuario = new Usuario();
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);

                    // Compruebo si el usuario existe

                    $usuario = $usuario->login();

                    // Si el usuario existe

                    if($usuario){

                        Utils::deleteSession('form_data');

                        $_SESSION['identity'] = [
                            'id' => $usuario->getId(),
                            'nombre' => $usuario->getNombre(),
                            'apellidos' => $usuario->getApellidos(),
                            'email' => $usuario->getEmail(),
                            'rol' => $usuario->getRol()
                        ];

                        // Remember es un checkbox. Si se ha marcado, se guarda una cookie con el email durante 7 días

                        if($remember){

                            setcookie('recuerdame', $email, time() + 60 * 60 * 24 * 7);

                        }else{

                            if(isset($_COOKIE['recuerdame'])){

                                setcookie('recuerdame', $email, time() - 1);

                            }

                        }

                        if ($usuario->getRol() == 'admin') $_SESSION['admin'] = true;
                    
                        header("Location:" . BASE_URL);
                        exit;

                    }else{

                        $_SESSION['login'] = "failed";

                    }

                }else{

                    $_SESSION['login'] = "failed";

                }

            }else{
                
                header("Location:" . BASE_URL);
                exit;

            }
            
            header("Location:" . BASE_URL . "usuario/login");
            exit;

        }

        // Método para cerrar sesión

        public function salir(): void{

            Utils::isIdentity();

            Utils::deleteSession('identity');
            Utils::deleteSession('admin');

            if (isset($_COOKIE['recuerdame'])) {
                setcookie('recuerdame', '', time() - 1);
            }

            header("Location:" . BASE_URL);

        }

        // Método para gestionar el usuario.
        // Si no hay ninguna id en el GET, se requiere la vista de gestión del usuario. (gestion.php)
        // Si hay una id en el GET, se muestra la vista de edición del usuario (acción de Admins). (editar.php)

        public function gestion(): void{

            Utils::isIdentity();
            
            if(isset($_GET['id'])){

                $id = $_GET['id'];

                Utils::isAdmin();

                if(Usuario::getById($id)){

                    require_once 'views/usuario/editar.php';

                }else{

                    require_once 'views/usuario/gestion.php';

                }

            }else{

                require_once 'views/usuario/gestion.php';

            }

        }

        // Método para editar el usuario.
        // Al igual que el guardar, vamos a contemplar los casos del administrador y del propio usuario.

        public function editar(): void {

            Utils::isIdentity();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                // Recoger datos con trim() para evitar espacios adicionales

                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
                $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : null;
                $email = isset($_POST['email']) ? trim($_POST['email']) : null;
                $password = isset($_POST['password']) ? trim($_POST['password']) : null;
                $rol = isset($_POST['rol']) ? $_POST['rol'] : null;

                $_SESSION['form_data'] = [
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'password' => $password,
                    'rol' => $rol
                ];
                
                // Contemplamos dos casos:
                // 1. Se ha enviado la id por GET y modificamos los datos de ese usuario.
                // 2. No se ha enviado la id por GET y modificamos los datos del usuario con la sesión iniciada.

                if(isset($_GET['id'])){

                    Utils::isAdmin();

                    $id = $_GET['id'];
                    $dummyUsuario = Usuario::getById($id);
                    
                    if($nombre != $dummyUsuario->getNombre() || $apellidos != $dummyUsuario->getApellidos() || $email != $dummyUsuario->getEmail() || strlen($password) > 0 || $rol != $dummyUsuario->getRol()){

                        // Validar nombre (solo letras y espacios, mínimo 2 caracteres)
    
                        if ($nombre && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $nombre)) {
                            $_SESSION['gestion'] = "failed_nombre";
                            header("Location:" . BASE_URL . "usuario/gestion&id=" . $id);
                            exit;
                        }
                        
                        // Validar apellidos (solo letras y espacios, mínimo 2 caracteres)
            
                        if ($apellidos && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $apellidos)) {
                            $_SESSION['gestion'] = "failed_apellidos";
                            header("Location:" . BASE_URL . "usuario/gestion&id=" . $id);
                            exit;
                        }
            
                        // Validar email
    
                        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $_SESSION['gestion'] = "failed_email";
                            header("Location:" . BASE_URL . "usuario/gestion&id=" . $id);
                            exit;
                        }
            
                        // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)
    
                        if (strlen($password) > 0 && !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
                            $_SESSION['gestion'] = "failed_password";
                            header("Location:" . BASE_URL . "usuario/gestion&id=" . $id);
                            exit;
                        }
    
                        // Crear objeto Usuario y guardar en BD
    
                        $usuario = new Usuario();
                        $usuario->setId($id);
                        $usuario->setNombre($nombre);
                        $usuario->setApellidos($apellidos);
                        $usuario->setEmail($email);
                        $usuario->setPassword($password);
                        $usuario->setRol($rol);
    
                        if($usuario->update()){
    
                            $_SESSION['gestion'] = "complete";

                            Utils::deleteSession('form_data');
                            
                            if($_SESSION['identity']['id'] == $id){

                                $_SESSION['identity']['nombre'] = $nombre;
                                $_SESSION['identity']['apellidos'] = $apellidos;
                                $_SESSION['identity']['email'] = $email;
                                $_SESSION['identity']['rol'] = $rol;

                                Utils::isAdmin();

                            }
                            
                            header("Location:" . BASE_URL . "usuario/admin" . (isset($_SESSION['pag']) ? "&pag=" . $_SESSION['pag'] : ""));
                            exit;
    
                        }else{
    
                            $_SESSION['gestion'] = "failed";

                        }

                    }else{

                        $_SESSION['gestion'] = "nothing";

                    }

                    header("Location:" . BASE_URL . "usuario/gestion&id=" . $id);
                    exit;

                }else{

                    if($nombre != $_SESSION['identity']['nombre'] || $apellidos != $_SESSION['identity']['apellidos'] || $email != $_SESSION['identity']['email'] || strlen($password) > 0){

                        // Validar nombre (solo letras y espacios, mínimo 2 caracteres)
    
                        if ($nombre && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $nombre)) {
                            $_SESSION['gestion'] = "failed_nombre";
                            header("Location:" . BASE_URL . "usuario/gestion");
                            exit;
                        }
                        
                        // Validar apellidos (solo letras y espacios, mínimo 2 caracteres)
            
                        if ($apellidos && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $apellidos)) {
                            $_SESSION['gestion'] = "failed_apellidos";
                            header("Location:" . BASE_URL . "usuario/gestion");
                            exit;
                        }
            
                        // Validar email
    
                        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $_SESSION['gestion'] = "failed_email";
                            header("Location:" . BASE_URL . "usuario/gestion");
                            exit;
                        }
            
                        // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)
    
                        if (strlen($password) > 0 && !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
                            $_SESSION['gestion'] = "failed_password";
                            header("Location:" . BASE_URL . "usuario/gestion");
                            exit;
                        }
    
                        // Crear objeto Usuario y guardar en BD
    
                        $usuario = new Usuario();
                        $usuario->setId($_SESSION['identity']['id']);
                        $usuario->setNombre($nombre);
                        $usuario->setApellidos($apellidos);
                        $usuario->setEmail($email);
                        $usuario->setPassword($password);
    
                        if($usuario->update()){
    
                            $_SESSION['gestion'] = "complete";

                            Utils::deleteSession('form_data');
    
                            $_SESSION['identity']['nombre'] = $nombre;
                            $_SESSION['identity']['apellidos'] = $apellidos;
                            $_SESSION['identity']['email'] = $email;
    
                        }else{
    
                            $_SESSION['gestion'] = "failed";
    
                        }
    
                    }else{
    
                        $_SESSION['gestion'] = "nothing";
    
                    }
                    
                    header("Location:" . BASE_URL . "usuario/gestion");
                    exit;

                }

            }

        }

        // Método para eliminar un usuario.
        // Si no hay id en el GET, se elimina el usuario con la sesión iniciada.
        // Si hay id en el GET, se elimina el usuario con ese id.

        // En el caso de que el propio admin elimine su cuenta, mediante la tabla, se le redirige a la página de inicio.

        public function eliminar(): void {

            Utils::isIdentity();

            if(isset($_GET['id'])){

                Utils::isAdmin();

                $id = $_GET['id'];

                $usuario = new Usuario();
                $usuario->setId($id);

                if($usuario->delete()){

                    $_SESSION['delete'] = "complete";

                    if($_SESSION['identity']['id'] == $id){

                        Utils::deleteSession('identity');
                        Utils::deleteSession('admin');

                        header("Location:" . BASE_URL);

                    }

                }else{

                    $_SESSION['delete'] = "failed";

                }

                header("Location:" . BASE_URL . "usuario/admin" . (isset($_SESSION['pag']) ? "&pag=" . $_SESSION['pag'] : ""));

            }else{

                $usuario = new Usuario();
                $usuario->setId($_SESSION['identity']['id']);

                if($usuario->delete()){

                    $_SESSION['delete'] = "complete";

                    Utils::deleteSession('identity');
                    Utils::deleteSession('admin');

                }else{

                    $_SESSION['delete'] = "failed";

                }

                header("Location:" . BASE_URL);

            }

            exit;

        }

        // Método para mostrar la vista de administración de usuarios

        public function admin(): void {
            
            Utils::isAdmin();

            $usuariosPorPagina = ITEMS_PER_PAGE;

            // Aqui seteamos el numero de pagina, y abajo redirigimos a 1 o la última página si la página es menor que 1 o mayor que el total de páginas

            $_SESSION['pag'] = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;

            $usuarios = Usuario::getAll();

            $totalPag = ceil(count($usuarios) / $usuariosPorPagina);
            $usuarios = array_slice($usuarios, ($_SESSION['pag'] - 1) * $usuariosPorPagina, $usuariosPorPagina);

            // Ahora redirigimos a la primera o última página si la página es menor que 1 o mayor que el total de páginas

            if($_SESSION['pag'] < 1) header("Location:" . BASE_URL . "usuario/admin&pag=1");
            if($_SESSION['pag'] > $totalPag) header("Location:" . BASE_URL . "usuario/admin&pag=" . $totalPag);

            require_once 'views/usuario/admin.php';

        }

        // Método para crear un usuario

        public function crear(): void {

            Utils::isAdmin();
            require_once 'views/usuario/crear.php';

        }
        
    }

?>