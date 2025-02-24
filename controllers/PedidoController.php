<?php

    namespace controllers;

    use helpers\Utils;

    class PedidoController{

        public function admin(){

            Utils::isAdmin();
            require_once 'views/pedido/admin.php';

        }
        
    }

?>