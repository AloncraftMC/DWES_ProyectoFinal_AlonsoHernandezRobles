<?php

    namespace controllers;

    use Utils;

    class PedidoController{

        public function admin(){

            Utils::isAdmin();
            require_once 'views/pedido/admin.php';

        }
        
    }

?>