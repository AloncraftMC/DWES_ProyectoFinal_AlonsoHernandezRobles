<?php

    namespace controllers;

    use helpers\Utils;

    class ProductoController{

        public function recomendados(){
            require_once 'views/producto/recomendados.php';
        }

        public function admin(){
            
            Utils::isAdmin();
            require_once 'views/producto/admin.php';

        }
        
    }

?>