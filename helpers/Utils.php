<?php

    namespace helpers;

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

        // Método para comprobar si el usuario está identificado

        public static function isIdentity(): void{
            
            if(!isset($_SESSION['identity'])){

                header('Location:'.BASE_URL);

            }

        }

        // Método para mostrar estadísticas del carrito

        public static function statsCarrito(): array{

            $stats = array(
                'count' => 0
            );

            if(isset($_SESSION['carrito'])){

                $stats['count'] = count($_SESSION['carrito']);

            }

            return $stats;

        }

        // Método para guardar la cookie del carrito. La cookie se guardará durante 3 días.

        public static function saveCookieCarrito(): void{

            if(isset($_SESSION['carrito'])){

                $carrito = json_encode($_SESSION['carrito']);

                setcookie('carrito', $carrito, time() + 60*60*24*3, '/');

            }

        }

        // Método para cargar la cookie del carrito

        public static function loadCookieCarrito(): void{

            if(isset($_COOKIE['carrito'])){

                $_SESSION['carrito'] = json_decode($_COOKIE['carrito'], true);

            }

        }

        // Método para eliminar la cookie del carrito

        public static function deleteCookieCarrito(): void {
            setcookie('carrito', '', time() - 3600, '/');
        }        

    }

?>