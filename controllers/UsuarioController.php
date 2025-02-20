<?php

    namespace controllers;

    use models\Usuario;
    use PDOException;

    class UsuarioController{

        // Método index para probar el controlador

        public function index(): void{
            echo "Controlador Usuario, Acción index";
        }

        // Método para mostrar la vista de registrarse

        public function registrarse(): void{
            require_once 'views/usuario/registrarse.php';
        }

        // Método para guardar un usuario en la base de datos

        public function guardar(): void {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Recoger datos con trim() para evitar espacios adicionales

                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
                $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : false;
                $email = isset($_POST['email']) ? trim($_POST['email']) : false;
                $password = isset($_POST['password']) ? trim($_POST['password']) : false;
        
                if ($nombre && $apellidos && $email && $password) {
        
                    // Validar nombre (solo letras y espacios, mínimo 2 caracteres)

                    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $nombre)) {
                        $_SESSION['register'] = "failed_nombre";
                        header("Location:" . BASE_URL . "usuario/registrarse");
                        exit;
                    }
                    
                    // Validar apellidos (solo letras y espacios, mínimo 2 caracteres)
        
                    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,}$/u", $apellidos)) {
                        $_SESSION['register'] = "failed_apellidos";
                        header("Location:" . BASE_URL . "usuario/registrarse");
                        exit;
                    }
        
                    // Validar email

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['register'] = "failed_email";
                        header("Location:" . BASE_URL . "usuario/registrarse");
                        exit;
                    }
        
                    // Validar contraseña (mínimo 8 caracteres, al menos una letra y un número)

                    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
                        $_SESSION['register'] = "failed_password";
                        header("Location:" . BASE_URL . "usuario/registrarse");
                        exit;
                    }
        
                    // Crear objeto Usuario y guardar en BD

                    $usuario = new Usuario();
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
        
                    $_SESSION['register'] = $usuario->save() ? 'complete' : 'failed';
        
                } else {

                    $_SESSION['register'] = "failed";

                }
        
                header("Location:" . BASE_URL . "usuario/registrarse");
                exit;

            }
            
        }

        // Método para mostrar la vista de iniciar sesión

        public function login(): void{
            require_once 'views/usuario/login.php';
        }

        // Método para iniciar sesión

        public function entrar(): void{

            // Compruebo si se ha enviado el formulario

            if(isset($_POST)){

                // Compruebo si se han enviado los datos necesarios

                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;

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

                        $_SESSION['identity'] = [
                            'id' => $usuario->getId(),
                            'nombre' => $usuario->getNombre(),
                            'apellidos' => $usuario->getApellidos(),
                            'email' => $usuario->getEmail(),
                            'rol' => $usuario->getRol(),
                            'imagen' => $usuario->getImagen()
                        ];

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

                $_SESSION['login'] = "failed";

            }

            header("Location:" . BASE_URL . "usuario/login");

        }

        // Método para cerrar sesión

        public function salir(){

            if(isset($_SESSION['identity'])) unset($_SESSION['identity']);
            if(isset($_SESSION['admin'])) unset($_SESSION['admin']);

            header("Location:" . BASE_URL);

        }
        
    }

?>