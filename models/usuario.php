<?php

    namespace models;

    use lib\BaseDatos;

    class Usuario{

        private $id;
        private $nombre;
        private $apellidos;
        private $email;
        private $password;
        private $rol;
        private $baseDatos;

        public function __construct($id, $nombre, $apellidos, $email, $password, $rol){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->email = $email;
            $this->password = $password;
            $this->rol = $rol;
            $this->baseDatos = new BaseDatos();

        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getApellidos(){
            return $this->apellidos;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getRol(){
            return $this->rol;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setApellidos($apellidos){
            $this->apellidos = $apellidos;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setRol($rol){
            $this->rol = $rol;
        }
        
    }

?>