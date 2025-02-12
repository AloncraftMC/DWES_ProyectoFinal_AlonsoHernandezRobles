<?php

    namespace models;
    use lib\BaseDatos;

    class Categoria{

        private $id;
        private $nombre;
        private $baseDatos;

        public function __construct($id, $nombre){

            $this->id = $id;
            $this->nombre = $nombre;
            $this->baseDatos = new BaseDatos();

        }
        
        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

    }

?>