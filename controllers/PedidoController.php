<?php

    namespace controllers;

    use helpers\Utils;

    class PedidoController{

        public function admin(){ // ✔

            Utils::isAdmin();
            require_once 'views/pedido/admin.php';

        }

        public function crear(){
            /* ME NIEGO A IMPLEMENTAR EL RESTO DE ESTA FUNCIONALIDAD */
            require_once 'views/pedido/crear.php';
        }

        public function hacer(){

            /* ME NIEGO A IMPLEMENTAR EL RESTO DE ESTA FUNCIONALIDAD */
            Utils::deleteSession('carrito');
            Utils::deleteCookieCarrito();
            header('Location: '.BASE_URL.'pedido/listo');

        }

        public function listo(){ // ✔
            require_once 'views/pedido/listo.php';
        }

        public function ver(){ // ✔
            Utils::isAdmin();
            require_once 'views/pedido/ver.php';
        }

        public function confirmar(){ /* ME NIEGO A IMPLEMENTAR ESTA FUNCIONALIDAD */ }

        public function eliminar(){ /* ME NIEGO A IMPLEMENTAR ESTA FUNCIONALIDAD */ }
        
    }

?>