<?php

    namespace controllers;

    class UsuarioController{



        public function index(){
            echo "Controlador Usuario, Acción index";
        }

        public function registrarse(){
            require_once 'views/usuario/registrarse.php';
        }

        public function guardar(){
            if(isset($_POST)) var_dump($_POST);
        }

        public function login(){

            

        }

        public function logout(){



        }
        
    }

?>