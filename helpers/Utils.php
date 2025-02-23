<?php

    class Utils{

        // Método para eliminar sesiones

        public static function deleteSession($nombre): void{

            if(isset($_SESSION[$nombre])){

                $_SESSION[$nombre] = null;
                unset($_SESSION[$nombre]);

            }

        }

        // Método para comprobar si el usuario es administrador

        public static function isAdmin(): void{

            if(!isset($_SESSION['identity']) || $_SESSION['identity']['rol'] !== 'admin'){

                header('Location:'.BASE_URL);

            }

        }

    }

?>