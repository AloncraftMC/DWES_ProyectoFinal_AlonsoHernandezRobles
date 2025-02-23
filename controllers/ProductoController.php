<?php

    namespace controllers;

    use Utils;

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