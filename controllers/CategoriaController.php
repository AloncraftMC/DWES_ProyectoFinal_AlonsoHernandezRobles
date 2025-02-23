<?php

    namespace controllers;

    use Utils;

    class CategoriaController{

        public function admin(){

            Utils::isAdmin();
            require_once 'views/categoria/admin.php';

        }
        
    }

?>