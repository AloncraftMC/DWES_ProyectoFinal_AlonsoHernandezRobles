<?php

    class Utils{

        // Método para eliminar sesiones

        public static function eliminarSesion($nombre): void{

            if(isset($_SESSION[$nombre])){

                $_SESSION[$nombre] = null;
                unset($_SESSION[$nombre]);

            }

        }

    }

?>