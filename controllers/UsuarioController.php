<?php

    namespace controllers;

    use models\Usuario;

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

        public function guardar(){
            
            // Comprobar si se ha enviado el formulario

            if(isset($_POST)){

                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                
                // Si los campos no están vacíos

                if($nombre && $apellidos && $email && $password){

                    $usuario = new Usuario(null, $nombre, $apellidos, $email, $password, 'user', null);
                    
                    $_SESSION['registrarse'] = ($usuario->guardar()) ? "complete" : "failed";

                }else{

                    $_SESSION['registrarse'] = "failed";
                    
                }

            }else{

                $_SESSION['registrarse'] = "failed";

            }

            // Redirigir a la vista de registrarse

            header("Location:" . base_url . 'usuario/registrarse');
        
        }

        // Método para iniciar sesión

        public function login(){

            // Comprobar si se ha enviado el formulario

            if(isset($_POST)){

                $usuario = new Usuario(null, null, null, $_POST['email'], $_POST['password'], null, null);
                
                $usuario->login();

            }

            // Redirigir a la vista de registrarse

            header("Location:" . base_url);

        }

        public function logout(){



        }
        
    }

?>